<?php

namespace App\Http\Controllers\Admin\Petparent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petparent;
use App\Models\Master\Role_privilege;
use App\Models\Master\Master_admin;
use App\Traits\MediaTrait;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use Yajra\DataTables\DataTables;
use Storage;
use Crypt;
use Session;
use App\Models\Pet;

class PetparentController extends Controller
{
    public function index(){
        return view('Admin.Petparent.index'); 
    }

    public function add(){
        return view('Admin.Petparent.add-petparent'); 
    }

   

    // public function store(Request $request)
    // {
    //     $role_id = Auth::guard('master_admins')->user()->role_id;
    //     $RolesPrivileges = Role_privilege::where('id', $role_id)
    //         ->where('status', 'active')
    //         ->select('privileges')
    //         ->first();

    //     $masterAdminId = null;
    //     if (!empty($request->id)) {
    //         $petParent = Petparent::find($request->id);
    //         if ($petParent) {
    //             $masterAdmin = Master_admin::where('email', $petParent->email)->first();
    //             $masterAdminId = $masterAdmin ? $masterAdmin->id : null;
    //         }
    //     }

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'gender' => 'required|in:Male,Female,Other',
    //         'email' => 'required|email|max:255|unique:petparents,email,' . ($request->id ?? 'NULL') . ',id|unique:master_admins,email,' . ($masterAdminId ?? 'NULL') . ',id',
    //         'mobile' => 'required|string|max:255|min:4', 
    //         'address' => 'nullable|string|max:255',
    //     ]);

    //     $petparentInput = [
    //         'name' => $request->name,
    //         'gender' => $request->gender,
    //         'email' => $request->email,
    //         'mobile' => $request->mobile,
    //         'address' => $request->address,
    //         'status' => 'active',
    //     ];

    //     $lastFourDigits = substr($request->mobile, -4); 
    //     $passwordRaw = strtolower(str_replace(' ', '', $request->name)) . '@' . $lastFourDigits;
    //     $passwordHashed = Hash::make($passwordRaw);

    //     $masterAdminInput = [
    //         'user_type' => 'customer',
    //         'user_name' => $request->name,
    //         'email' => $request->email,
    //         'mobile_no' => $request->mobile,
    //         'password' => $passwordHashed,
    //         'address' => $request->address,
    //         'status' => 'active',
    //     ];

    //     return DB::transaction(function () use ($request, $RolesPrivileges, $petparentInput, $masterAdminInput, $masterAdminId) {
    //         if (!empty($request->id)) {
    //             // UPDATE logic
    //             if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_edit')) {
    //                 $petparentInput['modified_by'] = Auth::guard('master_admins')->user()->id;
    //                 $petparentInput['modified_ip_address'] = $request->ip();
    //                 $masterAdminInput['modified_by'] = Auth::guard('master_admins')->user()->id;
    //                 $masterAdminInput['modified_ip_address'] = $request->ip();

    //                 Petparent::where('id', $request->id)->update($petparentInput);

    //                 if ($masterAdminId) {
    //                     Master_admin::where('id', $masterAdminId)->update($masterAdminInput);
    //                 } else {
    //                     Master_admin::where('email', $request->old_email)->update($masterAdminInput);
    //                 }

    //                 return redirect('admin/parent')->with('success', 'Pet Parent updated successfully!');
    //             } else {
    //                 return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
    //             }
    //         } else {
    //             // CREATE logic
    //             if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_add')) {
    //                 $petparentInput['created_by'] = Auth::guard('master_admins')->user()->id;
    //                 $petparentInput['created_ip_address'] = $request->ip();
    //                 $masterAdminInput['created_by'] = Auth::guard('master_admins')->user()->id;
    //                 $masterAdminInput['created_ip_address'] = $request->ip();

    //                 // 1. Create Petparent
    //                 $petParent = Petparent::create($petparentInput);

    //                 // 2. Generate code using ID
    //                 $petParent->code = 'PP' . str_pad($petParent->id, 4, '0', STR_PAD_LEFT); // PP0001
    //                 $petParent->save();

    //                 // 3. Create Master_admin
    //                 Master_admin::create($masterAdminInput);

    //                 return redirect('admin/parent')->with('success', 'Pet Parent added successfully!');
    //             } else {
    //                 return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
    //             }
    //         }
    //     });
    // }



    public function store(Request $request)
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)
            ->where('status', 'active')
            ->select('privileges')
            ->first();

        $masterAdminId = null;
        if (!empty($request->id)) {
            $petParent = Petparent::find($request->id);
            if ($petParent) {
                $masterAdmin = Master_admin::where('email', $petParent->email)->first();
                $masterAdminId = $masterAdmin ? $masterAdmin->id : null;
            }
        }

        // Normalize phone (remove '+91' if exists)
        $normalizedPhone = preg_replace('/^\+91/', '', $request->mobile);

        // Custom validation logic
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|max:255|unique:petparents,email,' . ($request->id ?? 'NULL') . ',id|unique:master_admins,email,' . ($masterAdminId ?? 'NULL') . ',id',
            'mobile' => [
                'required',
                'string',
                'max:255',
                'min:4',
                function ($attribute, $value, $fail) use ($request, $normalizedPhone) {
                    $existingPetParent = Petparent::where(function ($q) use ($normalizedPhone) {
                        $q->where('mobile', $normalizedPhone)
                        ->orWhere('mobile', '+91' . $normalizedPhone);
                    });

                    if ($request->id) {
                        $existingPetParent->where('id', '!=', $request->id);
                    }

                    $existingPetParent = $existingPetParent->first();

                    $existingMasterAdmin = Master_admin::where(function ($q) use ($normalizedPhone) {
                        $q->where('mobile_no', $normalizedPhone)
                        ->orWhere('mobile_no', '+91' . $normalizedPhone);
                    })->first();

                    if ($existingPetParent || $existingMasterAdmin) {
                        $fail('This mobile number is already in use.');
                    }
                },
            ],
            'address' => 'nullable|string|max:255',
        ]);

        $petparentInput = [
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'mobile' => $normalizedPhone,  // Store normalized version
            'address' => $request->address,
            'status' => 'active',
        ];

        $lastFourDigits = substr($normalizedPhone, -4);
        $passwordRaw = strtolower(str_replace(' ', '', $request->name)) . '@' . $lastFourDigits;
        $passwordHashed = Hash::make($passwordRaw);

        $masterAdminInput = [
            'user_type' => 'customer',
            'user_name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $normalizedPhone,  // Store normalized version
            'password' => $passwordHashed,
            'address' => $request->address,
            'status' => 'active',
        ];

        return DB::transaction(function () use ($request, $RolesPrivileges, $petparentInput, $masterAdminInput, $masterAdminId) {
            if (!empty($request->id)) {
                // UPDATE logic
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_edit')) {
                    $petparentInput['modified_by'] = Auth::guard('master_admins')->user()->id;
                    $petparentInput['modified_ip_address'] = $request->ip();
                    $masterAdminInput['modified_by'] = Auth::guard('master_admins')->user()->id;
                    $masterAdminInput['modified_ip_address'] = $request->ip();

                    Petparent::where('id', $request->id)->update($petparentInput);

                    if ($masterAdminId) {
                        Master_admin::where('id', $masterAdminId)->update($masterAdminInput);
                    } else {
                        Master_admin::where('email', $request->old_email)->update($masterAdminInput);
                    }

                    return redirect('admin/parent')->with('success', 'Pet Parent updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                // CREATE logic
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_add')) {
                    $petparentInput['created_by'] = Auth::guard('master_admins')->user()->id;
                    $petparentInput['created_ip_address'] = $request->ip();
                    $masterAdminInput['created_by'] = Auth::guard('master_admins')->user()->id;
                    $masterAdminInput['created_ip_address'] = $request->ip();

                    // 1. Create Petparent
                    $petParent = Petparent::create($petparentInput);

                    // 2. Generate code using ID
                    $petParent->code = 'PP' . str_pad($petParent->id, 4, '0', STR_PAD_LEFT);
                    $petParent->save();

                    // 3. Create Master_admin
                    Master_admin::create($masterAdminInput);

                    return redirect('admin/parent')->with('success', 'Pet Parent added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        });
    }




    public function data_table(Request $request)
    {
        
        $petparents = Petparent::where('status', '!=', 'delete')
            ->orderBy('id', 'DESC')
            ->select('id', 'code', 'name', 'gender', 'email', 'mobile', 'status')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($petparents)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return !empty($row->code) ? $row->code : '';
                })
                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '';
                })
                ->addColumn('gender', function ($row) {
                    return !empty($row->gender) ? $row->gender : '';
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '';
                })
                ->addColumn('mobile', function ($row) {
                    return !empty($row->mobile) ? $row->mobile : '';
                })


                ->addColumn('action', function ($row) {
                $actionBtn = '';
                $role_id = Auth::guard('master_admins')->user()->role_id;
                $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                // Edit button
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_edit')) {
                    $actionBtn .= '<a href="' . url('admin/parent/edit/' . $row->id) . '" 
                                    class="btn btn-icon btn-warning me-1" 
                                    title="Edit Pet Parent" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                                    <i class="mdi mdi-pencil"></i>
                                </a>';
                } 

                // Delete button
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_delete')) {
                    $actionBtn .= '<a href="javascript:void(0)" 
                                    data-id="' . $row->id . '" 
                                    data-table="petparents" 
                                    data-flash="Pet Parent Deleted Successfully!" 
                                    class="btn btn-icon btn-danger delete me-1" 
                                    title="Delete Pet Parent" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#cc235e; border:1px solid #cc235e;">
                                    <i class="mdi mdi-trash-can"></i>
                                </a>';
                } 
                return $actionBtn;
            })


                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    $isChecked = $row->status == 'active' ? 'checked' : '';

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'pet_owners_status_change')) {
                        return '<input type="checkbox" class="change-status" data-id="' . $row->id . '" data-table="petparents" data-flash="Status Changed Successfully!" ' . $isChecked . '>';
                    } else {
                        // Disabled checkbox for users without permission
                        return '<input type="checkbox" disabled ' . $isChecked . '>';
                    }
                })


                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }


    public function edit($id)
    {
       
        $petparent = Petparent::find($id);

        if (!$petparent) {
            return redirect('admin/parent')->with('error', 'Pet Parent not found!');
        }

        return view('Admin.Petparent.add-petparent', compact('petparent'));
    }



    public function getOwnerPetsByPhone($phone)
    {
        try {
           
            if (substr($phone, 0, 3) === '+91') {
                $phone = substr($phone, 3);
            }

       
            $owner = Petparent::where('status','active')->where('mobile', $phone)
                    ->orWhere('mobile', '+91' . $phone)
                    ->first();

            if (!$owner) {
                return response()->json([
                    'success' => false,
                    'message' => 'No owner found with this phone number.'
                ], 404);
            }

            $pets = Pet::where('status','active')->where('pet_parent_id', $owner->id)
                    ->select('id', 'name', 'pet_code', 'type', 'gender', 'dob')
                    ->get();
                

            return response()->json([
                'success' => true,
                'owner' => [
                    'name' => $owner->name,
                    'mobile' => $owner->mobile
                ],
                'pets' => $pets
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching owner details: ' . $e->getMessage()
            ], 500);
        }
    }




}
