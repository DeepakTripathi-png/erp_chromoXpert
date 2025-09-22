<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestParameters;
use App\Models\ParameterOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Master\Role_privilege;
use App\Models\Department;
use App\Models\TestResults;

class ReportController extends Controller
{
      public function index(){
        //  $reports=  TestResults::with(['test', 'appointment.pet','appointment.petparent'])->get();
        // dd($reports);
        return view('Admin.Reports.index'); 
    }

    public function getGenerateReport(){
        return view('Admin.Reports.report-generate');
    }

    public function viewReport(){
        return view('Admin.Reports.report-view');
    }

     


    public function data_table(Request $request)
    {
       
        $reports=  TestResults::with(['test', 'appointment.pet'])->get();

        if ($request->ajax()) {
            return DataTables::of($reports)
                ->addIndexColumn()

                ->addColumn('test_result_code', function ($row) {
                    return !empty($row->test_result_code) ? $row->test_result_code : '';
                })



                // ->addColumn('branch_name', function ($row) {
                //     return !empty($row->branch_name) ? $row->branch_name : '';
                // })

                // ->addColumn('branch_logo', function ($row) {
                //     return $row->branch_logo_path 
                //         ? '<img src="' . asset('storage/' . $row->branch_logo_path) . '" alt="' . $row->branch_name . '" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">'
                //         : 'N/A';
                // })

                // ->addColumn('address', function ($row) {
                //     return !empty($row->address) ? $row->address : '';
                // })
                // ->addColumn('lab_incharge', function ($row) {
                //     return $row->labIncharge ? $row->labIncharge->user_name : 'N/A';
                // })
                // ->addColumn('mobile', function ($row) {
                //     return !empty($row->mobile) ? $row->mobile : '';
                // })
                // ->addColumn('email', function ($row) {
                //     return !empty($row->email) ? $row->email : '';
                // })




                // ->addColumn('status', function ($row) {
                //     $role_id = Auth::guard('master_admins')->user()->role_id;
                //     $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                //     $isChecked = $row->status == 'active' ? 'checked' : '';

                //     if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'branch_status_change')) {
                //         return '<input type="checkbox" class="change-status" data-id="' . $row->id . '" data-table="branches" data-flash="Status Changed Successfully!" ' . $isChecked . '>';
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
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'branch_view')) {
                        $actionBtn .= '<a href="' . url('admin/branches/view/' . $row->id) . '" 
                                    class="btn btn-icon btn-info me-1" 
                                    title="View Branch" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#6267ae; border:1px solid #6267ae;">
                                    <i class="mdi mdi-eye"></i>
                                </a>';
                    }

            
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'branch_edit')) {
                        $actionBtn .= '<a href="' . url('admin/branches/edit/' . $row->id) . '" 
                                        class="btn btn-icon btn-warning me-1" 
                                        title="Edit Pet Parent" 
                                        data-bs-toggle="tooltip" 
                                        style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>';
                    } 


                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'branch_delete')) {
                    $actionBtn .= '<a href="javascript:void(0)" 
                                    data-id="' . $row->id . '" 
                                    data-table="branches" 
                                    data-flash="Branch Deleted Successfully!" 
                                    class="btn btn-icon btn-danger delete me-1" 
                                    title="Delete Branch" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#cc235e; border:1px solid #cc235e;">
                                    <i class="mdi mdi-trash-can"></i>
                                </a>';
                } 

                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }

     



}
