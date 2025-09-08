<?php

namespace App\Http\Controllers\Admin\Testcase;

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
class TestcaseController extends Controller
{
    public function index()
    {

        return view('Admin.Testcases.index'); 
    }

    public function add()
    {
        return view('Admin.Testcases.testcase-add'); 
    }


    public function edit($id)
    {
        $test = Test::with(['parameters.options'])
            ->where('status', '!=', 'delete')
            ->findOrFail($id);

        return view('Admin.Testcases.testcase-add', compact('test'));
    }

    public function view($id)
    {
        $test = Test::with(['parameters.options'])
            ->where('status', '!=', 'delete')
            ->find($id);

        if (!$test) {
            return redirect()->route('admin.testcases')->with('error', 'Test case not found.');
        }

        return view('Admin.Testcases.textcase-view', compact('test'));
    }

 

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'short_name' => 'nullable|string|max:100',
    //         'sample_type' => 'nullable|string|max:255',
    //         'base_price' => 'required|numeric|min:0',
    //         'precautions' => 'nullable|string',
    //         'parameters' => 'required|array',
    //         'parameters.*.row_type' => 'required|in:component,title',
    //         'parameters.*.name' => 'required_if:parameters.*.row_type,component|string|nullable|max:255',
    //         'parameters.*.title' => 'required_if:parameters.*.row_type,title|string|nullable|max:255',
    //         'parameters.*.unit' => 'nullable|string|max:255',
    //         'parameters.*.result_type' => 'required_if:parameters.*.row_type,component|in:text,select',
    //         'parameters.*.reference_range' => 'nullable|string',
    //         'parameters.*.options' => 'nullable|array',
    //         'parameters.*.options.*' => 'nullable|string|max:255',
    //     ]);

    //     $userIp = $request->ip();
    //     $userId = Auth::id();

    //     DB::beginTransaction();

    //     try {
    //         $test = Test::create([
    //             'name' => $request->name,
    //             'short_name' => $request->short_name ?? null,
    //             'sample_type' => $request->sample_type ?? null,
    //             'base_price' => $request->base_price,
    //             'precautions' => $request->precautions ?? null,
    //             'created_ip_address' => $userIp,
    //             'modified_ip_address' => $userIp,
    //             'created_by' => $userId,
    //             'modified_by' => $userId,
    //             'status' => 'active',
    //         ]);

    //         $testCode = 'TC' . str_pad($test->id, 3, '0', STR_PAD_LEFT);

    //         $test->update([
    //             'test_code' => $testCode
    //         ]);

    //         foreach ($request->parameters as $index => $param) {
    //             $status = isset($param['status']) ? $param['status'] : 'active';

    //             $parameter = TestParameters::create([
    //                 'test_id' => $test->id,
    //                 'row_type' => $param['row_type'],
    //                 'name' => $param['row_type'] === 'component' ? ($param['name'] ?? null) : null,
    //                 'title' => $param['row_type'] === 'title' ? ($param['title'] ?? null) : null,
    //                 'unit' => $param['unit'] ?? null,
    //                 'result_type' => $param['row_type'] === 'component' ? ($param['result_type'] ?? 'text') : 'text',
    //                 'reference_range' => $param['reference_range'] ?? null,
    //                 'sort_order' => $index,
    //                 'created_ip_address' => $userIp,
    //                 'modified_ip_address' => $userIp,
    //                 'created_by' => $userId,
    //                 'modified_by' => $userId,
    //                 'status' => $status,
    //             ]);

    //             if ($param['row_type'] === 'component' &&
    //                 ($param['result_type'] ?? 'text') === 'select' &&
    //                 !empty($param['options'])) {

    //                 foreach ($param['options'] as $optionIndex => $optionValue) {
    //                     if (!empty(trim($optionValue))) {
    //                         ParameterOptions::create([
    //                             'parameter_id' => $parameter->id,
    //                             'option_value' => trim($optionValue),
    //                             'sort_order' => $optionIndex,
    //                             'created_ip_address' => $userIp,
    //                             'modified_ip_address' => $userIp,
    //                             'created_by' => $userId,
    //                             'modified_by' => $userId,
    //                             'status' => 'active',
    //                         ]);
    //                     }
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         return redirect()->route('admin.test_case')
    //             ->with('success', 'Test created successfully.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Test creation failed: ' . $e->getMessage(), [
    //             'request' => $request->all(),
    //             'exception' => $e,
    //         ]);
    //         return back()->withInput()
    //             ->with('error', 'Error creating test: ' . $e->getMessage());
    //     }
    // }



    public function store(Request $request)
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)
            ->where('status', 'active')
            ->select('privileges')
            ->first();

        $validated = $request->validate([
            'id' => 'nullable|exists:tests,id',
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'sample_type' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'precautions' => 'nullable|string',
            'parameters' => 'required|array',
            'parameters.*.row_type' => 'required|in:component,title',
            'parameters.*.id' => 'nullable|exists:test_parameters,id',
            'parameters.*.name' => 'required_if:parameters.*.row_type,component|string|nullable|max:255',
            'parameters.*.title' => 'required_if:parameters.*.row_type,title|string|nullable|max:255',
            'parameters.*.unit' => 'nullable|string|max:255',
            'parameters.*.result_type' => 'required_if:parameters.*.row_type,component|in:text,select',
            'parameters.*.reference_range' => 'nullable|string',
            'parameters.*.options' => 'nullable|array',
            'parameters.*.options.*' => 'nullable|string|max:255',
            'parameters.*.option_ids' => 'nullable|array',
            'parameters.*.option_ids.*' => 'nullable|exists:parameter_options,id',
        ]);

        $userIp = $request->ip();
        $userId = Auth::id();

        try {
            DB::transaction(function () use ($request, $RolesPrivileges, $userId, $userIp) {
                $testInput = [
                    'name' => $request->name,
                    'short_name' => $request->short_name ?? null,
                    'sample_type' => $request->sample_type ?? null,
                    'base_price' => $request->base_price,
                    'precautions' => $request->precautions ?? null,
                    'status' => 'active',
                ];

                if (!empty($request->id)) {
                    // Update mode
                    if (!str_contains($RolesPrivileges->privileges, 'test_edit')) {
                        throw new \Exception('Sorry, You Have No Permission For This Request!');
                    }

                    $testInput['modified_ip_address'] = $userIp;
                    $testInput['modified_by'] = $userId;

                    $test = Test::findOrFail($request->id);
                    $test->update($testInput);
                } else {
                    // Add mode
                    if (!str_contains($RolesPrivileges->privileges, 'test_add')) {
                        throw new \Exception('Sorry, You Have No Permission For This Request!');
                    }

                    $testInput['created_ip_address'] = $userIp;
                    $testInput['created_by'] = $userId;
                    $testInput['modified_ip_address'] = $userIp;
                    $testInput['modified_by'] = $userId;

                    $test = Test::create($testInput);
                    $test->test_code = 'TC' . str_pad($test->id, 3, '0', STR_PAD_LEFT);
                    $test->save();
                }

                // Handle parameters
                $existingParameterIds = $test->parameters()->pluck('id')->toArray();
                $submittedParameterIds = array_filter(array_column($request->parameters, 'id') ?? []);

                // Delete parameters that are not in the submitted list
                TestParameters::where('test_id', $test->id)
                    ->whereNotIn('id', $submittedParameterIds)
                    ->delete();

                foreach ($request->parameters as $index => $param) {
                    $status = isset($param['status']) && $param['status'] == '1' ? 'active' : 'inactive';

                    $parameterInput = [
                        'test_id' => $test->id,
                        'row_type' => $param['row_type'],
                        'name' => $param['row_type'] === 'component' ? ($param['name'] ?? null) : null,
                        'title' => $param['row_type'] === 'title' ? ($param['title'] ?? null) : null,
                        'unit' => $param['unit'] ?? null,
                        'result_type' => $param['row_type'] === 'component' ? ($param['result_type'] ?? 'text') : 'text',
                        'reference_range' => $param['reference_range'] ?? null,
                        'sort_order' => $index,
                        'created_ip_address' => $userIp,
                        'modified_ip_address' => $userIp,
                        'created_by' => $userId,
                        'modified_by' => $userId,
                        'status' => $status,
                    ];

                    if (!empty($param['id'])) {
                        // Update existing parameter
                        TestParameters::where('id', $param['id'])->update($parameterInput);
                        $parameter = TestParameters::find($param['id']);
                    } else {
                        // Create new parameter
                        $parameter = TestParameters::create($parameterInput);
                    }

                    if ($param['row_type'] === 'component' && $param['result_type'] === 'select' && !empty($param['options'])) {
                        // Handle options
                        $existingOptionIds = $parameter->options()->pluck('id')->toArray();
                        $submittedOptionIds = array_filter($param['option_ids'] ?? []);

                        // Delete options that are not in the submitted list
                        ParameterOptions::where('parameter_id', $parameter->id)
                            ->whereNotIn('id', $submittedOptionIds)
                            ->delete();

                        foreach ($param['options'] as $optionIndex => $optionValue) {
                            if (!empty(trim($optionValue))) {
                                $optionInput = [
                                    'parameter_id' => $parameter->id,
                                    'option_value' => trim($optionValue),
                                    'sort_order' => $optionIndex,
                                    'created_ip_address' => $userIp,
                                    'modified_ip_address' => $userIp,
                                    'created_by' => $userId,
                                    'modified_by' => $userId,
                                    'status' => 'active',
                                ];

                                if (!empty($param['option_ids'][$optionIndex])) {
                                    // Update existing option
                                    ParameterOptions::where('id', $param['option_ids'][$optionIndex])
                                        ->update($optionInput);
                                } else {
                                    // Create new option
                                    ParameterOptions::create($optionInput);
                                }
                            }
                        }
                    } else {
                        // Delete all options if result_type is not select
                        ParameterOptions::where('parameter_id', $parameter->id)->delete();
                    }
                }

                // Return true to indicate successful transaction
                return true;
            });

            // Redirect after successful transaction
            return redirect()->route('admin.testcases')
                ->with('success', !empty($request->id) ? 'Test updated successfully.' : 'Test created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Test creation/update failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e,
            ]);
            return back()->withInput()->with('error', 'Error processing test: ' . $e->getMessage());
        }
    }



    public function data_table(Request $request)
    {
        $tests = Test::with(['parameters'])
            ->where('status', '!=', 'delete')
            ->orderBy('id', 'DESC')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($tests)
                ->addIndexColumn()

                ->addColumn('test_code', function ($row) {
                    return !empty($row->test_code) ? $row->test_code : '';
                })

                ->addColumn('name', function ($row) {
                    return !empty($row->name) ? $row->name : '';
                })
                ->addColumn('short_name', function ($row) {
                    return !empty($row->short_name) ? $row->short_name : '';
                })

                ->addColumn('sample_type', function ($row) {
                    return !empty($row->sample_type) ? $row->sample_type : '';
                })

                ->addColumn('base_price', function ($row) {
                    return !empty($row->base_price) ? number_format($row->base_price, 2) : '0.00';
                })

                ->addColumn('parameters_count', function ($row) {
                    return $row->parameters->count();
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                    $isChecked = $row->status == 'active' ? 'checked' : '';

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'test_status_change')) {
                        return '<input type="checkbox" class="change-status" data-id="' . $row->id . '" data-table="tests" data-flash="Status Changed Successfully!" ' . $isChecked . '>';
                    } else {
                        return '<input type="checkbox" disabled ' . $isChecked . '>';
                    }
                })
                
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();

                   
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'test_view')) {
                        $actionBtn .= '<a href="' . url('admin/test-case/view/' . $row->id) . '" 
                                    class="btn btn-icon btn-info me-1" 
                                    title="View Test" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#6267ae; border:1px solid #6267ae;">
                                    <i class="mdi mdi-eye"></i>
                                </a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'test_edit')) {
                        $actionBtn .= '<a href="' . url('admin/test-case/edit/' . $row->id) . '" 
                                        class="btn btn-icon btn-warning me-1" 
                                        title="Edit Test" 
                                        data-bs-toggle="tooltip" 
                                        style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>';
                    }

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'test_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" 
                                    data-id="' . $row->id . '" 
                                    data-table="tests" 
                                    data-flash="Test Deleted Successfully!" 
                                    class="btn btn-icon btn-danger delete me-1" 
                                    title="Delete Test" 
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







}