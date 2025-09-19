<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\RefereeDoctor;
use App\Models\Pet;
use App\Models\Master\Master_admin;
use App\Models\Master\Role_privilege;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Test;
use App\Models\Appointment;
use App\Models\Petparent;
use App\Models\AppointmentTest;
use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Mail;



class AppointmentsController extends Controller
{
    
    public function index(){
        $appointments = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                    ->where('status', '!=', 'deleted')
                    ->get();
        // dd($appointments);
        return view('Admin.Appointments.index'); 
    }


    public function add(){
        $branches = Branch::where('status','active')->get();
        $refereeDoctors = RefereeDoctor::where('status','active')->get();
        $pets = Pet::with('petParent')->where('status','active')->get();
        
        $tests = Test::with(['parameters'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->paginate(8);


        return view('Admin.Appointments.add-aapontments', compact('branches','refereeDoctors','pets','tests')); 
    }



    public function getPetDetails($pet_id)
    {
        $pet = Pet::with('petParent')->findOrFail($pet_id);

        return response()->json([
            'pet_id' => $pet->id,
            'pet_code' => $pet->pet_code,
            'pet_type' => $pet->type . ' ' . $pet->breed,
            'pet_gender' => $pet->gender,
            'pet_dob' => $pet->dob,
            'owner_name' => $pet->petParent->name,
            'owner_phone' => $pet->petParent->mobile,
        ]);
    }

    public function getPetDetailsByCode($pet_code)
    {
        $pet = Pet::with('petParent')->where('pet_code', $pet_code)->firstOrFail();
        return response()->json([
            'pet_id' => $pet->id,
            'pet_code' => $pet->pet_code,
            'pet_type' => $pet->type . ' ' . $pet->breed,
            'pet_gender' => $pet->gender,
            'pet_dob' => $pet->dob,
            'owner_name' => $pet->petParent->name,
            'owner_phone' => $pet->petParent->mobile,
        ]);
    }


    public function store(Request $request)
    {

            $role_id = Auth::guard('master_admins')->user()->role_id;
            $rolesPrivileges = Role_privilege::where('id', $role_id)
                ->where('status', 'active')
                ->select('privileges')
                ->first();

            if (empty($rolesPrivileges) || !str_contains($rolesPrivileges->privileges, 'appointments_add')) {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }

            $phone = $request->phone;
            if (!str_starts_with($phone, '+91') && preg_match('/^[0-9]{10}$/', $phone)) {
                $phone = '+91' . $phone;
                $request->merge(['phone' => $phone]);
            }

            
            $pet = Pet::find($request->pet_id);
            if (!$pet) {
                return redirect()->back()->with('error', 'Invalid pet ID provided.');
            }
            $request->merge(['petowner_id' => $pet->pet_parent_id]);

            $request->validate([
                'lab_id' => 'required|exists:branches,id',
                'referee_doctor_id' => 'required|exists:referee_doctors,id',
                'appointment_date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required|date_format:H:i',
                'pet_id' => 'required|exists:pets,id',
                'pet_code' => 'required|string|max:50',
                'pet_type' => 'required|string|max:100',
                'pet_gender' => 'required|in:Male,Female,Other',
                'pet_dob' => 'required|date|before:today',
                'pet_owner_name' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^\+91[0-9]{10}$/',
                'petowner_id' => 'required|exists:petparents,id',
                'notes' => 'nullable|string|max:1000',
                'tests' => 'required|array|min:1',
                'tests.*' => 'exists:tests,id',
                'subtotal' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'payment_mode' => 'required|in:Cash,Card,UPI,Bank Transfer',
                'transaction_id' => 'nullable|string|max:255',
                'payment_status' => 'required|in:Pending,Completed,Failed',
                'payment_date' => 'nullable|date',
            ]);


            $appointmentInput = [
                    'lab_id'               => $request->lab_id,
                    'referee_doctor_id'    => $request->referee_doctor_id,
                    'appointment_date'     => $request->appointment_date,
                    'appointment_time'     => $request->appointment_time,
                    'pet_id'               => $request->pet_id,
                    'petowner_id'          => $request->petowner_id,
                    'notes'                => $request->notes,
                    'subtotal'             => $request->subtotal,
                    'discount'             => $request->discount,
                    'total'                => $request->total,
                    'payment_mode'         => $request->payment_mode,
                    'transaction_id'       => $request->transaction_id,
                    'payment_status'       => $request->payment_status,
                    'payment_date'         => $request->payment_date,
                    'status'               => 'active',
                    'created_by'           => Auth::guard('master_admins')->user()->id,
                    'created_ip_address'   => $request->ip(),
                ];

                // Create appointment
                $appointment = Appointment::create($appointmentInput);

                // Generate and update appointment code
                $appointment->appointment_code = 'APT' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
                $appointment->save();

                // Link tests to the appointment
                $testIdArray = $request->tests;

                if (!empty($testIdArray) && is_array($testIdArray)) {
                    foreach ($testIdArray as $testId) {
                        AppointmentTest::create([
                            'appointment_id' => $appointment->id,
                            'test_id'       => $testId,
                        ]);
                    }
                }

                $appointmentDetails = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                    ->where('id', $appointment->id)
                    ->first();


                  // Send email to pet owner
                if ($appointmentDetails->pet->petParent->email) {
                    Mail::to($appointmentDetails->pet->petParent->email)
                        ->send(new AppointmentConfirmation($appointmentDetails));
                }    


               if ($appointmentDetails->pet->petParent->mobile) {
                $token = env('WHATSAPP_API_TOKEN'); // Fetch token from .env
                $phone = $appointmentDetails->pet->petParent->mobile; // Ensure phone number is stored with country code, e.g., 919xxxxxxxxx
                $message = urlencode("Dear {$appointmentDetails->pet->petParent->name}, your appointment (Code: {$appointmentDetails->appointment_code}) is confirmed for {$appointmentDetails->appointment_date} at {$appointmentDetails->appointment_time}. Thank you!");

                $url = "https://wts.vision360solutions.co.in/api/sendText?token={$token}&phone={$phone}&message={$message}";

                $client = new \GuzzleHttp\Client();
                $response = $client->get($url);

                $result = json_decode($response->getBody(), true);
                if ($result['status'] === 'success') {
                    // Optionally log success
                } else {
                    // Optionally log error (e.g., insufficient credits)
                }
             }

             

            return view('Admin.Appointments.reciept_view',compact('appointmentDetails'))->with('success', 'Appointment created successfully!');
    }
    


    public function petAndPetparentStore(Request $request)
    {

            $role_id = Auth::guard('master_admins')->user()->role_id;
            $rolesPrivileges = Role_privilege::where('id', $role_id)
                ->where('status', 'active')
                ->select('privileges')
                ->first();

            if (!$rolesPrivileges || !str_contains($rolesPrivileges->privileges, 'pet_owners_add') || !str_contains($rolesPrivileges->privileges, 'pet_add')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, You Have No Permission For This Request!'
                ], 403);
            }

            
            $request->validate([
                'owner_name' => 'required|string|max:255',
                'owner_gender' => 'required|in:Male,Female,Other',
                'owner_email' => 'required|email|max:255|unique:petparents,email|unique:master_admins,email',
                'owner_mobile' => 'required|string|regex:/^\+91[0-9]{10}$/',
                'owner_address' => 'nullable|string|max:255',
                'pet_name' => 'required|string|max:255',
                'pet_code' => 'nullable|string|max:255',
                'pet_species' => 'required|in:Canine,Feline,Avian,Other',
                'pet_breed' => 'nullable|string|max:255',
                'pet_type' => 'required|in:Dog,Cat,Bird,Other',
                'pet_gender' => 'required|in:Male,Female',
                'pet_dob' => 'nullable|date|before_or_equal:today',
                'pet_age' => 'nullable|string|max:255',
                'pet_weight' => 'nullable|numeric|min:0',
                'pet_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            try {
                return DB::transaction(function () use ($request) {
                    $petparentInput = [
                        'name' => $request->owner_name,
                        'gender' => $request->owner_gender,
                        'email' => $request->owner_email,
                        'mobile' => $request->owner_mobile,
                        'address' => $request->owner_address,
                        'status' => 'active',
                        'created_by' => Auth::guard('master_admins')->user()->id,
                        'created_ip_address' => $request->ip(),
                    ];

                    $petParent = Petparent::create($petparentInput);

                    $petParent->code = 'PP' . str_pad($petParent->id, 4, '0', STR_PAD_LEFT);
                    $petParent->save();

            
                    $lastFourDigits = substr($request->owner_mobile, -4);
                    $passwordRaw = strtolower(str_replace(' ', '', $request->owner_name)) . '@' . $lastFourDigits;
                    $masterAdminInput = [
                        'user_type' => 'customer',
                        'user_name' => $request->owner_name,
                        'email' => $request->owner_email,
                        'mobile_no' => $request->owner_mobile,
                        'password' => Hash::make($passwordRaw),
                        'address' => $request->owner_address,
                        'status' => 'active',
                        'created_by' => Auth::guard('master_admins')->user()->id,
                        'created_ip_address' => $request->ip(),
                    ];

                    
                    Master_admin::create($masterAdminInput);

                    
                    $petInput = [
                        'pet_parent_id' => $petParent->id,
                        'name' => $request->pet_name,
                        'species' => $request->pet_species,
                        'breed' => $request->pet_breed,
                        'type' => $request->pet_type,
                        'gender' => $request->pet_gender,
                        'dob' => $request->pet_dob,
                        'age' => $request->pet_age,
                        'weight' => $request->pet_weight,
                        'status' => 'active',
                        'created_by' => Auth::guard('master_admins')->user()->id,
                        'created_ip_address' => $request->ip(),
                    ];

                    
                    if ($request->hasFile('pet_image')) {
                        $file = $request->file('pet_image');
                        $petInput['image_name'] = $file->getClientOriginalName();
                        $petInput['image_path'] = $file->store('images/pets', 'public');
                    }

                    $pet = Pet::create($petInput);

                    
                    $pet->pet_code = 'PET' . str_pad($pet->id, 3, '0', STR_PAD_LEFT);
                    $pet->save();

                    
                    $petData = [
                        'id' => $pet->id,
                        'name' => $pet->name,
                        'pet_code' => $pet->pet_code,
                        'species' => $pet->species,
                        'breed' => $pet->breed,
                        'type' => $pet->type,
                        'gender' => $pet->gender,
                        'dob' => $pet->dob,
                        'age' => $pet->age,
                        'weight' => $pet->weight,
                        'image_path' => $pet->image_path ? asset('storage/' . $pet->image_path) : null,
                    ];

                    $petParentData = [
                        'id' => $petParent->id,
                        'name' => $petParent->name,
                        'gender' => $petParent->gender,
                        'email' => $petParent->email,
                        'mobile' => $petParent->mobile,
                        'address' => $petParent->address,
                        'code' => $petParent->code,
                    ];

                    return response()->json([
                        'success' => true,
                        'message' => 'Pet and Pet Parent added successfully!',
                        'pet' => $petData,
                        'pet_parent' => $petParentData,
                    ], 200);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while adding the pet and owner.',
                    'errors' => ['general' => [$e->getMessage()]],
                ], 500);
            }
    }



    public function data_table(Request $request)
    {
        
        $appointments = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                ->where('status', '!=', 'deleted')
                ->get();

        if ($request->ajax()) {
            return DataTables::of($appointments)
                ->addIndexColumn()

                ->addColumn('appointment_code', function ($row) {
                    return !empty($row->appointment_code) ? $row->appointment_code : '';
                })

                ->addColumn('pet_code', function ($row) {
                    return !empty($row->pet->pet_code ) ? $row->pet->pet_code : '';
                })


                ->addColumn('pet_name', function ($row) {
                    return !empty($row->pet->name) ? $row->pet->name: '';
                })

                ->addColumn('pet_parent_code', function ($row) {
                    return !empty($row->pet->petParent->code) ? $row->pet->petParent->code: '';
                })

                ->addColumn('pet_parent', function ($row) {
                    return !empty($row->pet->petParent->name) ? $row->pet->petParent->name: '';
                })


                ->addColumn('subtotal', function ($row) {
                    return !empty($row->subtotal) ? $row->subtotal : '';
                })

                ->addColumn('discount', function ($row) {
                    return !empty($row->discount) ? $row->discount : '';
                })

                ->addColumn('total', function ($row) {
                    return !empty($row->total) ? $row->total : '';
                })

                ->addColumn('date', function ($row) {
                    if (!empty($row->appointment_date) && !empty($row->appointment_time)) {
                        return \Carbon\Carbon::parse($row->appointment_date . ' ' . $row->appointment_time)
                            ->format('d F Y h:i A');
                    }
                    return '';
                })

                ->addColumn('payment_status', function ($row) {
                    return !empty($row->payment_status) ? $row->payment_status : '';
                })


                // ->addColumn('status', function ($row) {
                //     $role_id = Auth::guard('master_admins')->user()->role_id;
                //     $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                //     $isChecked = $row->status == 'active' ? 'checked' : '';

                //     if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'appointments_status_change')) {
                //         return '<input type="checkbox" class="change-status" data-id="' . $row->id . '" data-table="appointments" data-flash="Status Changed Successfully!" ' . $isChecked . '>';
                //     } else {
                //         // Disabled checkbox for users without permission
                //         return '<input type="checkbox" disabled ' . $isChecked . '>';
                //     }
                // })




                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    // View button
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'appointments_view')) {
                        $actionBtn .= '<a href="' . url('admin/appointments/reciept/' . $row->id) . '" 
                                    class="btn btn-icon btn-info me-1" 
                                    title="View Appointment Reciept" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#6267ae; border:1px solid #6267ae;">
                                    <i class="mdi mdi-eye"></i>
                                </a>';
                    }

            
                    // if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'appointments_edit')) {
                    //     $actionBtn .= '<a href="' . url('admin/appointment/edit/' . $row->id) . '" 
                    //                     class="btn btn-icon btn-warning me-1" 
                    //                     title="Edit Appointment" 
                    //                     data-bs-toggle="tooltip" 
                    //                     style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                    //                     <i class="mdi mdi-pencil"></i>
                    //                 </a>';
                    // } 


                // if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'appointments_delete')) {
                //     $actionBtn .= '<a href="javascript:void(0)" 
                //                     data-id="' . $row->id . '" 
                //                     data-table="appointments" 
                //                     data-flash="Appointment Deleted Successfully!" 
                //                     class="btn btn-icon btn-danger delete me-1" 
                //                     title="Delete Branch" 
                //                     data-bs-toggle="tooltip" 
                //                     style="background:#fff; color:#cc235e; border:1px solid #cc235e;">
                //                     <i class="mdi mdi-trash-can"></i>
                //                 </a>';
                // } 

                    return $actionBtn;
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }




    public function viewReciept($id){
        $appointmentDetails = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                    ->where('id', $id)
                    ->first();
        return view('Admin.Appointments.reciept_view',compact('appointmentDetails'));
    }
        
    
    public function edit($id){
        $branches = Branch::where('status','active')->get();
        $refereeDoctors = RefereeDoctor::where('status','active')->get();
        $pets = Pet::with('petParent')->where('status','active')->get();
        
        $tests = Test::with(['parameters'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->paginate(8);

        $appointmentDetails = Appointment::with(['branch', 'refereeDoctor', 'pet', 'pet.petParent', 'tests'])
                    ->where('id', $id)
                    ->first();

        return view('Admin.Appointments.add-aapontments', compact('branches','refereeDoctors','pets','tests','appointmentDetails')); 
    }

    

}
