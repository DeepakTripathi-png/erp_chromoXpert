<?php

namespace App\Http\Controllers\Admin\Testcase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestParameters;
use App\Models\ParameterOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestcaseController extends Controller
{
    public function index(){
        
        return view('Admin.Testcases.index'); 
    }

    public function add(){
        return view('Admin.Testcases.testcase-add'); 
    }

    public function view(){
        
        return view('Admin.Testcases.textcase-view'); 
    }

    public function report(){
        return view('Admin.Testcases.report');
    }

    public function store(Request $request)
    {

        // dd($request->all());

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'sample_type' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'precautions' => 'nullable|string',
            'parameters' => 'required|array',
            'parameters.*.row_type' => 'required|in:component,title',
            'parameters.*.name' => 'required_if:parameters.*.row_type,component',
            'parameters.*.title' => 'required_if:parameters.*.row_type,title',
            'parameters.*.unit' => 'nullable|string',
            'parameters.*.result_type' => 'required_if:parameters.*.row_type,component|in:text,select',
            'parameters.*.reference_range' => 'nullable|string',
            'parameters.*.status' => 'nullable|boolean', // Your form uses 0/1 for status
            'parameters.*.options' => 'nullable|array',
        ]);

        // Get user IP address
        $userIp = $request->ip();
        $userId = Auth::id();

        DB::beginTransaction();
        
        try {
            // Create the test
            $test = Test::create([
                'name' => $validated['name'],
                'short_name' => $validated['short_name'] ?? null,
                'sample_type' => $validated['sample_type'] ?? null,
                'base_price' => $validated['base_price'],
                'precautions' => $validated['precautions'] ?? null,
                'created_ip_address' => $userIp,
                'modified_ip_address' => $userIp,
                'created_by' => $userId,
                'modified_by' => $userId,
                'status' => 'active',
            ]);
            
            // Process parameters
            foreach ($request->parameters as $index => $param) {
                // Convert checkbox status (0/1) to enum value
                $status = isset($param['status']) && $param['status'] == 1 ? 'active' : 'inactive';
                
                $parameter = TestParameters::create([
                    'test_id' => $test->id,
                    'row_type' => $param['row_type'],
                    'name' => $param['row_type'] === 'component' ? ($param['name'] ?? null) : null,
                    'title' => $param['row_type'] === 'title' ? ($param['title'] ?? null) : null,
                    'unit' => $param['unit'] ?? null,
                    'result_type' => $param['row_type'] === 'component' ? ($param['result_type'] ?? 'text') : null,
                    'reference_range' => $param['reference_range'] ?? null,
                    'sort_order' => $index,
                    'created_ip_address' => $userIp,
                    'modified_ip_address' => $userIp,
                    'created_by' => $userId,
                    'modified_by' => $userId,
                    'status' => $status,
                ]);
                
                // Process options for select type parameters
                if ($param['row_type'] === 'component' && 
                    ($param['result_type'] ?? 'text') === 'select' && 
                    !empty($param['options'])) {
                    
                    foreach ($param['options'] as $optionIndex => $optionValue) {
                        if (!empty(trim($optionValue))) {
                            ParameterOptions::create([
                                'parameter_id' => $parameter->id,
                                'option_value' => trim($optionValue),
                                'sort_order' => $optionIndex,
                                'created_ip_address' => $userIp,
                                'modified_ip_address' => $userIp,
                                'created_by' => $userId,
                                'modified_by' => $userId,
                                'status' => 'active',
                            ]);
                        }
                    }
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.tests.index')
                ->with('success', 'Test created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error creating test: ' . $e->getMessage());
        }
    }




}
