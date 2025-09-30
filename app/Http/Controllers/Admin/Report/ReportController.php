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
use App\Models\Appointment;
use App\Models\TestResultComponent;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{


    public function index(){
        return view('Admin.Reports.index'); 
    }




    public function getGenerateReport($id)
    {
        $testIdArray = TestResults::where('test_result_code', $id)->pluck('test_id')->toArray();
        $appointmentId = TestResults::where('test_result_code', $id)->value('appointment_id');
        $tests = Test::whereIn('id', $testIdArray)->with('parameters.options')->get();
        $appointment = Appointment::with('pet.petparent')->where('id', $appointmentId)->first();
        $report = TestResults::with(['test.parameters.options', 'components'])->where('test_result_code', $id)->get();

        return view('Admin.Reports.report-generate', compact('report', 'tests', 'appointment', 'id'));
    }



    public function viewReport($id){
        
        $testIdArray = TestResults::where('test_result_code', $id)->pluck('test_id')->toArray();
        $appointmentId = TestResults::where('test_result_code', $id)->value('appointment_id');

        $tests = Test::whereIn('id', $testIdArray)->with('parameters')->get();

        $appointment = Appointment::with('pet.petparent')->where('id', $appointmentId)->first();
        $report = TestResults::with(['test.parameters', 'components'])->where('test_result_code', $id)->get();

        return view('Admin.Reports.report-view',compact('report', 'tests', 'appointment','id'));
    }

     

    public function data_table(Request $request)
    {
        $reports = TestResults::with([
                'appointment.pet.petparent',
                'test'
            ])
            ->select('test_results.*') 
            ->join('appointments', 'test_results.appointment_id', '=', 'appointments.id') 
            ->orderByRaw("CONCAT(appointments.appointment_date, ' ', appointments.appointment_time) DESC") 
            ->get()
            ->groupBy('test_result_code')
            ->map(function($group) {
                $first = $group->first();
                $tests = $group->pluck('test')->filter()->values();

                return (object)[
                    'test_result_code' => $first->test_result_code,
                    'appointment'      => $first->appointment,
                    'tests'            => $tests,
                    'status'           => $first->status,
                ];
            })
            ->values();

        if ($request->ajax()) {
            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('test_result_code', function ($row) {
                    return $row->test_result_code ?? '';
                })
                ->addColumn('pet_code', function ($row) {
                    return $row->appointment->pet->pet_code ?? '';
                })
                ->addColumn('pet_name', function ($row) {
                    return $row->appointment->pet->name ?? '';
                })
                ->addColumn('pet_parent', function ($row) {
                    return $row->appointment->pet->petparent->name ?? '';
                })
                ->addColumn('pet_parent_mobile', function ($row) {
                    return $row->appointment->pet->petparent->mobile ?? '';
                })
                ->addColumn('tests', function ($row) {
                    $tests = $row->tests->map(function($test) {
                        return '<li>' . ($test->name ?? '') . '</li>';
                    })->implode('');

                    return '<ul style="padding-left: 20px; margin:0;">' . $tests . '</ul>';
                })
                ->addColumn('appointment_datetime', function ($row) {
                    if (!empty($row->appointment->appointment_date) && !empty($row->appointment->appointment_time)) {
                        $datetime = $row->appointment->appointment_date . ' ' . $row->appointment->appointment_time;
                        return \Carbon\Carbon::parse($datetime)->format('d M Y h:i A');
                    }
                    return '';
                })
                ->addColumn('status', function ($row) {
                    return !empty($row->status) ? ucfirst($row->status) : '-';
                })
                ->addColumn('done', function ($row) {
                    return $row->done ?? '-';
                })
                ->addColumn('signed', function ($row) {
                    return !empty($row->signed_by_id) ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('status', 'active')
                        ->where('id', $role_id)
                        ->select('privileges')
                        ->first();

                    $id = $row->test_result_code; // use test_result_code as identifier

                    // View button
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'reports_view')) {
                        $actionBtn .= '<a href="' . url('admin/reports/view/' . $id) . '" 
                                    class="btn btn-icon btn-info me-1" 
                                    title="View Branch" 
                                    data-bs-toggle="tooltip" 
                                    style="background:#fff; color:#6267ae; border:1px solid #6267ae;">
                                    <i class="mdi mdi-eye"></i>
                                </a>';
                    }

                    // Edit button
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'reports_view')) {
                        $actionBtn .= '<a href="' . url('admin/generate-reports/' . $id) . '" 
                                        class="btn btn-icon btn-warning me-1" 
                                        title="Edit Pet Parent" 
                                        data-bs-toggle="tooltip" 
                                        style="background:#fff; color:#f6b51d; border:1px solid #f6b51d;">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>';
                    }

                    // Sign Report button
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'reports_view')) {
                        $actionBtn .= '<a href="' . url('admin/test-report/sign/' . $id) . '" 
                                        class="btn btn-icon btn-success me-1" 
                                        title="Sign Report" 
                                        style="background:#fff; color:#28a745; border:1px solid #28a745;">
                                        <i class="mdi mdi-signature-text"></i>
                                    </a>';
                    }

                    // Print Barcode button
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'reports_view')) {
                        $actionBtn .= '<a href="' . url('admin/test-report/barcode/' . $id) . '" 
                                        class="btn btn-icon btn-primary" 
                                        title="Print Barcode" 
                                        style="background:#fff; color:#000; border:1px solid #000;" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#barcodeModal">
                                        <i class="mdi mdi-barcode"></i>
                                    </a>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action', 'tests'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'test_id' => 'required|exists:tests,id',
            'appointment_id' => 'required|exists:appointments,id',
            'test_result_code' => 'required|string',
            'results' => 'required|array',
            'results.*' => 'array',
            'results.*.*' => 'nullable|string', // Allow nullable string for result values
            'status' => 'required|array',
            'status.*' => 'array',
            'status.*.*' => 'nullable|in:normal,abnormal', // Restrict status to valid values
            'comments' => 'required|array',
            'comments.*' => 'nullable|string', // Allow nullable comments
        ]);

        // Find or create the TestResults record
        $testResult = TestResults::firstOrCreate(
            [
                'test_id' => $validated['test_id'],
                'appointment_id' => $validated['appointment_id'],
                'test_result_code' => $validated['test_result_code'],
            ],
            [
                'status' => 'pending',
                'done' => 'no',
                'created_by' => Auth::id(),
                'created_ip_address' => $request->ip(),
            ]
        );

        // Prepare result data for TestResults
        $resultData = [];
        foreach ($validated['results'][$validated['test_id']] as $paramId => $resultValue) {
            $status = $validated['status'][$validated['test_id']][$paramId] ?? null;
            if ($resultValue || $status) {
                $resultData[$paramId] = [
                    'result' => $resultValue,
                    'status' => $status,
                ];

                // Store or update individual test result component
                TestResultComponent::updateOrCreate(
                    [
                        'test_result_id' => $testResult->id,
                        'component_id' => $paramId,
                    ],
                    [
                        'result' => $resultValue,
                        'result_status' => $status,
                    ]
                );
            }
        }

        // Update TestResults with aggregated data
        $testResult->update([
            'comment' => $validated['comments'][$validated['test_id']] ?? null,
            'status' => 'completed',
            'done' => 'yes',
            'modified_by' => Auth::id(),
            'modified_ip_address' => $request->ip(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Test results updated successfully.');
    }




    public function reportPdf(Request $request)
    {
        
        $request->validate([
            'selected_test_results' => 'required|array',
            'selected_test_results.*' => 'exists:test_results,id',
        ]);

        // Fetch selected test result IDs
        $testResultIds = $request->input('selected_test_results', []);

        // Initialize an array to hold data for each test result
        $reportsData = [];

        foreach ($testResultIds as $testResultId) {
            // Fetch test result with related components
            $testResult = TestResults::with(['components'])
                ->where('id', $testResultId)
                ->first();

            if (!$testResult) {
                continue;
            }

            // Fetch related test with parameters
            $test = Test::where('id', $testResult->test_id)
                ->with(['parameters'])
                ->first();

            // Fetch related appointment with pet and pet parent
            $appointment = Appointment::with(['pet.petParent', 'branch', 'refereeDoctor'])
                ->where('id', $testResult->appointment_id)
                ->first();

            // Prepare data for the view
            $reportsData[] = [
                'testResult' => $testResult,
                'test' => $test,
                'appointment' => $appointment,
            ];
        }

        // Load the Blade view and generate PDF
        $pdf = Pdf::loadView('Admin.Reports.report_pdf', [
            'reports' => $reportsData,
        ])
        ->setPaper('a4')
        ->setOption('margin-top', '0.5cm')
        ->setOption('margin-bottom', '0.5cm')
        ->setOption('margin-left', '0.5cm')
        ->setOption('margin-right', '0.5cm');

        // Get the PDF content as base64
        $pdfContent = base64_encode($pdf->output());

        // Return JSON response
        return response()->json([
            'reports' => [
                [
                    'content' => $pdfContent,
                    'filename' => 'test_results_report_' . now()->format('YmdHis') . '.pdf',
                ]
            ]
        ]);
    }

     



}
