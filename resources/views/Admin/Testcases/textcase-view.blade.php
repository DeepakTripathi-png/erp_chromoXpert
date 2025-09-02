@extends('Admin.Layouts.layout')
@section('meta_title') View Test | ChromoXpert @endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            {{-- Hero Header with Gradient Background --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">View Laboratory Test</h2>
                <p class="mb-0">Review the details and configurations of the laboratory test</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ url()->previous() }}" 
                       class="btn btn-lg fw-semibold rounded-pill shadow-sm"
                       style="background: #f6b51d; color: #1f2937; border: none;" 
                       data-bs-toggle="tooltip" title="Return to previous page">
                        <i class="mdi mdi-arrow-left me-2"></i> Back
                    </a>
                    <a href="{{ url('admin/tests/edit/' . $test->id) }}" 
                       class="btn btn-lg fw-semibold rounded-pill shadow-sm"
                       style="background: #ac7fb6; color: #fff; border: none;" 
                       data-bs-toggle="tooltip" title="Edit this test">
                        <i class="mdi mdi-pencil me-2"></i> Edit Test
                    </a>
                </div>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-test-tube"></i>
                </div>
            </div>

            {{-- Success and Error Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert"
                 style="background: #6267ae; color: #fff; border: none;">
                <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert"
                 style="background: #cc235e; color: #fff; border: none;">
                <i class="mdi mdi-alert me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Glassmorphic Card with Fade-in Animation --}}
            <div class="card border-0 shadow-lg rounded-4 fade-in"
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-4">
                    <!-- Main Tabs -->
                    <ul class="nav nav-tabs nav-justified mb-4" id="mainTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="basic-tab" data-bs-toggle="tab" href="#basic" role="tab" 
                               aria-controls="basic" aria-selected="true" style="color: #6267ae;">
                                <i class="mdi mdi-test-tube me-1"></i> Basic Info
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sample-tab" data-bs-toggle="tab" href="#sample" role="tab" 
                               aria-controls="sample" aria-selected="false" style="color: #6267ae;">
                                <i class="mdi mdi-vial me-1"></i> Sample
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="reporting-tab" data-bs-toggle="tab" href="#reporting" role="tab" 
                               aria-controls="reporting" aria-selected="false" style="color: #6267ae;">
                                <i class="mdi mdi-file-document me-1"></i> Reporting
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="parameters-tab" data-bs-toggle="tab" href="#parameters" role="tab" 
                               aria-controls="parameters" aria-selected="false" style="color: #6267ae;">
                                <i class="mdi mdi-format-list-numbered me-1"></i> Parameters
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="additional-tab" data-bs-toggle="tab" href="#additional" role="tab" 
                               aria-controls="additional" aria-selected="false" style="color: #6267ae;">
                                <i class="mdi mdi-information me-1"></i> Additional
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="mainTabsContent">
                        <!-- Basic Information Tab -->
                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Test Name</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->test_name ?? 'N/A' }}</div>
                                    <small class="text-muted">Full name of the laboratory test</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Short Name</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->short_name ?? 'N/A' }}</div>
                                    <small class="text-muted">Abbreviated name for quick reference</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Test Code</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->test_code ?? 'N/A' }}</div>
                                    <small class="text-muted">Unique code for the test</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Department</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->department ?? 'N/A' }}</div>
                                    <small class="text-muted">Department responsible for this test</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Test Category</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->test_category ?? 'N/A' }}</div>
                                    <small class="text-muted">Type of test (e.g., routine, special)</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Methodology</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->test_methodology ?? 'N/A' }}</div>
                                    <small class="text-muted">Testing method or technique used</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Description</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->test_description ?? 'N/A' }}</div>
                                    <small class="text-muted">Brief description of the test</small>
                                </div>
                            </div>
                        </div>

                        <!-- Sample Requirements Tab -->
                        <div class="tab-pane fade" id="sample" role="tabpanel" aria-labelledby="sample-tab">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Sample Type</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->sample_type ?? 'N/A' }}</div>
                                    <small class="text-muted">Type of sample required (e.g., blood, urine)</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Volume</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->sample_volume ?? 'N/A' }}</div>
                                    <small class="text-muted">Required sample volume (e.g., 5 mL)</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Container Type</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->container_type ?? 'N/A' }}</div>
                                    <small class="text-muted">Type of container for the sample</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Storage Temp</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->storage_temp ?? 'N/A' }}</div>
                                    <small class="text-muted">Required storage temperature (e.g., 2-8°C)</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Sample Stability</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->sample_stability ?? 'N/A' }}</div>
                                    <small class="text-muted">Stability duration of the sample</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Special Instructions</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->special_instructions ?? 'N/A' }}</div>
                                    <small class="text-muted">Any special handling instructions</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Biohazardous Sample</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->is_hazardous ? 'Yes' : 'No' }}</div>
                                    <small class="text-muted">Indicates if the sample is biohazardous</small>
                                </div>
                            </div>
                        </div>

                        <!-- Reporting Tab -->
                        <div class="tab-pane fade" id="reporting" role="tabpanel" aria-labelledby="reporting-tab">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Report Type</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->report_type ?? 'N/A' }}</div>
                                    <small class="text-muted">Type of result reporting</small>
                                </div>
                                @if($test->report_type == 'quantitative')
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Decimal Places</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->decimal_places ?? 'N/A' }}</div>
                                    <small class="text-muted">Number of decimal places for results</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Result Format</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->result_format ?? 'N/A' }}</div>
                                    <small class="text-muted">Format for displaying results</small>
                                </div>
                                @elseif($test->report_type == 'qualitative' || $test->report_type == 'semi_quantitative')
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Possible Results</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">
                                        @if($test->report_type == 'qualitative' && $test->qualitative_options)
                                            {{ implode(', ', $test->qualitative_options) }}
                                        @elseif($test->report_type == 'semi_quantitative' && $test->semi_quantitative_options)
                                            {{ implode(', ', $test->semi_quantitative_options) }}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                    <small class="text-muted">Possible results for the test</small>
                                </div>
                                @if($test->report_type == 'semi_quantitative')
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Display Format</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->semi_quantitative_format ?? 'N/A' }}</div>
                                    <small class="text-muted">Format for displaying semi-quantitative results</small>
                                </div>
                                @endif
                                @elseif($test->report_type == 'descriptive')
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Report Template</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->descriptive_template ?? 'N/A' }}</div>
                                    <small class="text-muted">Template for descriptive reports</small>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Report Template</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->report_template ?? 'N/A' }}</div>
                                    <small class="text-muted">Selected report template</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Interpretation Notes</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->interpretation_notes ?? 'N/A' }}</div>
                                    <small class="text-muted">Notes for interpreting results</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Critical Results</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->is_critical ? 'Yes' : 'No' }}</div>
                                    <small class="text-muted">Indicates if the test may have critical results</small>
                                </div>
                            </div>
                        </div>

                        <!-- Parameters Tab -->
                        <div class="tab-pane fade" id="parameters" role="tabpanel" aria-labelledby="parameters-tab">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="mb-3" style="color: #6267ae;">Test Parameters</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                                <tr>
                                                    <th width="25%">Parameter</th>
                                                    <th width="15%">Unit</th>
                                                    <th width="20%">Reference Range</th>
                                                    <th width="20%">Critical Values</th>
                                                    <th width="10%">Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($test->parameters ?? [] as $parameter)
                                                <tr class="fade-in-row">
                                                    <td>{{ $parameter->name ?? 'N/A' }}</td>
                                                    <td>{{ $parameter->unit ?? 'N/A' }}</td>
                                                    <td>{{ $parameter->reference_range ?? 'N/A' }}</td>
                                                    <td>{{ $parameter->critical_values ?? 'N/A' }}</td>
                                                    <td>{{ $parameter->order ?? 'N/A' }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No parameters available</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Tab -->
                        <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Pre-Test Instructions</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->pre_test_instructions ?? 'N/A' }}</div>
                                    <small class="text-muted">Instructions before taking the test</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Post-Test Instructions</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->post_test_instructions ?? 'N/A' }}</div>
                                    <small class="text-muted">Instructions after taking the test</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Clinical Notes</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->clinical_notes ?? 'N/A' }}</div>
                                    <small class="text-muted">Additional clinical information</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Base Price (₹)</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ number_format($test->base_price ?? 0, 2) }}</div>
                                    <small class="text-muted">Base price for the test</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Urgent Charge (₹)</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ number_format($test->urgent_charge ?? 0, 2) }}</div>
                                    <small class="text-muted">Additional charge for urgent processing</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Active Test</label>
                                    <div class="p-3 bg-light rounded-3 shadow-sm">{{ $test->is_active ? 'Yes' : 'No' }}</div>
                                    <small class="text-muted">Status of the test (enabled/disabled)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .fade-in { animation: fadeIn 0.6s ease-in-out; }
    .fade-in-row { animation: fadeInUp 0.6s ease-in-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .alert { border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }

    .nav-tabs .nav-link {
        background: rgba(255,255,255,0.85);
        border: none;
        border-radius: 0.5rem 0.5rem 0 0;
        font-weight: 600;
    }
    .nav-tabs .nav-link.active {
        background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);
        color: white;
    }

    .bg-light {
        background: #f8f9fa !important;
        border: none;
    }

    @media (max-width: 768px) {
        .btn-lg { font-size: 0.9rem; padding: 0.5rem 1rem; }
        .form-label { font-size: 0.9rem; }
        .table-responsive { overflow-x: auto; }
        .table { font-size: 0.9rem; }
        .p-3 { padding: 1rem !important; }
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Handle tab switching
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        $('[data-bs-toggle="tooltip"]').tooltip(); // Reinitialize tooltips when switching tabs
    });
});
</script>
@endsection