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


class AppointmentsController extends Controller
{
    
    public function index(){
        return view('Admin.Appointments.index'); 
    }

    public function add(){
        $branches = Branch::where('status','active')->get();
        $refereeDoctors = RefereeDoctor::where('status','active')->get();
        $pets = Pet::with('petParent')->where('status','active')->get();
        
        $tests = Test::with(['parameters'])
            ->where('status', 'active')
            ->orderBy('id', 'DESC')
            ->paginate(8); // Add pagination

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
            'discount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $appointmentInput = [
            'lab_id' => $request->lab_id,
            'referee_doctor_id' => $request->referee_doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'pet_id' => $request->pet_id,
            'petowner_id' => $request->petowner_id,
            'notes' => $request->notes,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'total' => $request->total,
            'status' => 'active',
            'created_by' => Auth::guard('master_admins')->user()->id,
            'created_ip_address' => $request->ip(),
        ];

        return DB::transaction(function () use ($request, $appointmentInput) {
            $appointment = Appointment::create($appointmentInput);

            $appointment->appointment_code = 'APT' . str_pad($appointment->id, 3, '0', STR_PAD_LEFT);
            $appointment->save();

            $appointment->tests()->sync($request->tests);

            return redirect('admin/appointments/receipt')->with('success', 'Appointment created successfully!');
        });
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


    

    public function viewReciept(){
        return view('Admin.Appointments.reciept_view');
    }
    


 

}
