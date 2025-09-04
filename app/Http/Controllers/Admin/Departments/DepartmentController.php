<?php

namespace App\Http\Controllers\Admin\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Master_admin;
use App\Models\Master\Role_privilege;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('Admin.Departments.index');
    }

    public function add()
    {
        $department = null;
        $department_heads = Master_admin::where('status', 'active')->where('role_id', 3)->get();
        return view('Admin.Departments.add_department', compact('department_heads', 'department'));
    }

    public function edit($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return redirect('admin/departments')->with('error', 'Department not found!');
        }
        $department_heads = Master_admin::where('status', 'active')->where('role_id', 3)->get();
        return view('Admin.Departments.add_department', compact('department_heads', 'department'));
    }

    public function store(Request $request)
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)
            ->where('status', 'active')
            ->select('privileges')
            ->first();

        // Normalize mobile number
        $mobile = $request->mobile;
        if (!str_starts_with($mobile, '+91') && preg_match('/^[0-9]{10}$/', $mobile)) {
            $mobile = '+91' . $mobile; // Prepend +91 if it's a 10-digit number
            $request->merge(['mobile' => $mobile]);
        }

        $request->validate([
            'code' => 'nullable|string|max:255',
            'department_name' => 'required|string|max:255|unique:departments,department_name,' . ($request->id ?? 'NULL') . ',id',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|regex:/^\+91[0-9]{10}$/',
            'head_name' => 'required|exists:master_admins,id',
            'description' => 'nullable|string',
        ]);

        $departmentInput = [
            'department_name' => $request->department_name,
            'description' => $request->description,
            'email' => $request->email,
            'mobile' => $request->mobile, // Use normalized mobile
            'department_head' => $request->head_name,
            'status' => 'active',
        ];

        return DB::transaction(function () use ($request, $RolesPrivileges, $departmentInput) {
            if (!empty($request->id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_edit')) {
                    $departmentInput['modified_by'] = Auth::guard('master_admins')->user()->id;
                    $departmentInput['modified_ip_address'] = $request->ip();

                    $department = Department::where('id', $request->id)->first();
                    if ($request->code) {
                        $departmentInput['code'] = $request->code;
                    } else {
                        $departmentInput['code'] = $department->code ?? null;
                    }

                    Department::where('id', $request->id)->update($departmentInput);

                    return redirect('admin/departments')->with('success', 'Department updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_add')) {
                    $departmentInput['created_by'] = Auth::guard('master_admins')->user()->id;
                    $departmentInput['created_ip_address'] = $request->ip();

                    $department = Department::create($departmentInput);

                    $department->code = 'DEPT' . str_pad($department->id, 3, '0', STR_PAD_LEFT);
                    $department->save();

                    return redirect('admin/departments')->with('success', 'Department added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                }
            }
        });
    }

    public function data_table(Request $request)
    {
        $departments = Department::with(['head'])
            ->where('status', '!=', 'delete')
            ->orderBy('id', 'DESC')
            ->select('id', 'code', 'department_name', 'description','email', 'mobile', 'department_head', 'status')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('code', function ($row) {
                    return !empty($row->code) ? $row->code : '';
                })
                ->addColumn('department_name', function ($row) {
                    return !empty($row->department_name) ? $row->department_name : '';
                })

                 ->addColumn('description', function ($row) {
                    return !empty($row->description) ? $row->description : '';
                })
                ->addColumn('email', function ($row) {
                    return !empty($row->email) ? $row->email : '';
                })
                ->addColumn('mobile', function ($row) {
                    return !empty($row->mobile) ? $row->mobile : '';
                })
                ->addColumn('department_head', function ($row) {
                    return $row->head ? $row->head->user_name : 'N/A';
                })
                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    $isChecked = $row->status == 'active' ? 'checked' : '';

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_status_change')) {
                        return '<input type="checkbox" class="change-status" data-id="' . $row->id . '" data-table="departments" data-flash="Status Changed Successfully!" ' . $isChecked . '>';
                    } else {
                        return '<input type="checkbox" disabled ' . $isChecked . '>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_view')) {
                        $actionBtn .= '<a href="' . url('admin/departments/view/' . $row->id) . '" 
                                    class="btn btn-icon btn-info me-1" 
                                    title="View Department" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#6267ae; border:1px solid #6267ae;">
                                    <i class="mdi mdi-eye"></i>
                                </a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_edit')) {
                        $actionBtn .= '<a href="' . url('admin/departments/edit/' . $row->id) . '" 
                                        class="btn btn-icon btn-warning me-1" 
                                        title="Edit Department" 
                                        data-bs-toggle="tooltip" 
                                        style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" 
                                    data-id="' . $row->id . '" 
                                    data-table="departments" 
                                    data-flash="Department Deleted Successfully!" 
                                    class="btn btn-icon btn-danger delete me-1" 
                                    title="Delete Department" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#cc235e; border:1px solid #cc235e;">
                                    <i class="mdi mdi-trash-can"></i>
                                </a>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function view($id)
    {
        $department = Department::with(['head'])->find($id);
        if (!$department) {
            return redirect('admin/departments')->with('error', 'Department not found!');
        }
        return view('Admin.Departments.view_department', compact('department'));
    }

    public function delete($id)
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'departments_delete')) {
            Department::where('id', $id)->update(['status' => 'delete']);
            return redirect('admin/departments')->with('success', 'Department deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }
}