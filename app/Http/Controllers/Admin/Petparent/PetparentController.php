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


class PetparentController extends Controller
{
    public function index(){
        return view('Admin.Petparent.index'); 
    }

    public function add(){
        return view('Admin.Petparent.add-petparent'); 
    }

   

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

        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|max:255|unique:petparents,email,' . ($request->id ?? 'NULL') . ',id|unique:master_admins,email,' . ($masterAdminId ?? 'NULL') . ',id',
            'mobile' => 'required|string|max:255|min:4', 
            'address' => 'nullable|string|max:255',
        ]);

        $petparentInput = [
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'status' => 'active',
        ];

        $lastFourDigits = substr($request->mobile, -4); 
        $passwordRaw = strtolower(str_replace(' ', '', $request->name)) . '@' . $lastFourDigits;
        $passwordHashed = Hash::make($passwordRaw);

        $masterAdminInput = [
            'user_type' => 'customer',
            'user_name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile,
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
                    $petParent->code = 'PP' . str_pad($petParent->id, 4, '0', STR_PAD_LEFT); // PP0001
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
                } else {
                    $actionBtn .= '<a href="javascript:;" 
                                    class="btn btn-icon btn-warning me-1" 
                                    title="Edit Disabled" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;" disabled>
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
                } else {
                    $actionBtn .= '<a href="javascript:;" 
                                    class="btn btn-icon btn-danger me-1" 
                                    title="Delete Disabled" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#cc235e; border:1px solid #cc235e;" disabled>
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

}
