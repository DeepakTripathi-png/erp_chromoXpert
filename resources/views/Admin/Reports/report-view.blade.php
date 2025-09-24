@extends('Admin.Layouts.layout')

@section('meta_title', 'View Test Report | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid mt-3">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Tests & Components</h2>
                <p class="mb-0">Manage test results and component details</p>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-flask"></i>
                </div>
            </div>

            {{-- Controls --}}
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <span class="text-secondary fw-semibold">Select tests and cultures to be printed in the report</span>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm"
                            style="background: #28a745; color: #fff; border: none;"
                            onclick="selectAllTests(true)">
                        <i class="fas fa-check-double me-2"></i> Select all
                    </button>
                    <button class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm"
                            style="background: #dc3545; color: #fff; border: none;"
                            onclick="selectAllTests(false)">
                        <i class="fas fa-times me-2"></i> Deselect all
                    </button>
                    <button class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm print-report"
                            style="background: #f6b51d; color: #1f2937; border: none;">
                        <i class="fas fa-print me-2"></i> Print
                    </button>
                    <button id="animalInfo" class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm ms-2"
                            style="background: #cc235e; color: #fff; border: none;"
                            data-bs-toggle="modal" data-bs-target="#animalInfoModal">
                        <i class="mdi mdi-paw me-2"></i> Animal info
                    </button>
                </div>
            </div>

            {{-- Tests --}}
            <div class="mb-3 px-3 py-2 rounded-3"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff; font-weight: 600;">
                Tests
            </div>

                   <div id="testContainer">

                    <!-- Test 1 -->
                   @if(!empty($tests))
                    @foreach($tests as $index => $test)
                        <div class="test-item" id="test{{ $test->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <label>
                                    <input type="checkbox" class="test-checkbox">
                                    {{ $test->name ?? 'Test Name' }}
                                </label>
                                <div class="controls">
                                    <button class="toggle-btn" onclick="toggleDrawer(this)">+</button>
                                    <button class="close-btn" onclick="removeTest('test{{ $test->id }}')">×</button>
                                </div>
                            </div>

                            <div class="test-content">
                                <div class="test-title">{{ $test->name ?? 'Complete Blood Count' }}</div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>Result</th>
                                            <th>Unit</th>
                                            <th>Normal Range</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($test->parameters as $parameter)
                                            @if($parameter->row_type === 'title')
                                                <tr>
                                                    <td colspan="5" style="text-align: left; font-weight: bold;">
                                                        {{ $parameter->title ?? $parameter->name ?? 'Parameter Title' }}
                                                    </td>
                                                </tr>
                                            @elseif($parameter->row_type === 'component')
                                                @php
                                                    $testResult = $report->where('test_id', $test->id)->first();
                                                    $component = $testResult ? $testResult->components->where('component_id', $parameter->id)->first() : null;
                                                @endphp
                                                <tr>
                                                    <td>{{ $parameter->name ?? 'Parameter Name' }}</td>
                                                    <td>{{ $component ? $component->result : 'N/A' }}</td>
                                                    <td>{{ $parameter->unit ?? 'Unit' }}</td>
                                                    <td>{{ $parameter->reference_range ?? $parameter->normal_range ?? 'Normal Range' }}</td>
                                                    <td>{{ $component ? $component->result_status : 'N/A' }}</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    No parameters found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                @php
                                    $testResult = $report->where('test_id', $test->id)->first();
                                @endphp
                                <div class="comment">Comment: {{ $testResult ? $testResult->comment : 'No comment available' }}</div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>


        </div>
    </div>
</div>

<!-- Animal Info Modal -->
<div class="modal fade" id="animalInfoModal" tabindex="-1" aria-labelledby="animalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
            <div class="modal-header" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h5 class="modal-title" id="animalInfoModalLabel">Animal Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-2"><strong>Name:</strong> {{ $appointment->pet->name ?? '' }}</p>
                <p class="mb-2"><strong>Gender:</strong> {{ $appointment->pet->gender ?? '' }}</p>
                <p class="mb-2"><strong>Date of birth:</strong> {{ $appointment->pet->dob ?? '' }}</p>
                <p class="mb-2"><strong>Age:</strong> {{ $appointment->pet->age ?? '' }}</p>
                <p class="mb-2"><strong>Owner name:</strong> {{ $appointment->pet->petparent->name ?? '' }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $appointment->pet->petparent->mobile ?? '' }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $appointment->pet->petparent->email ?? '' }}</p>
                <p class="mb-2"><strong>Address:</strong> {{ $appointment->pet->petparent->address ?? '' }}</p>
            </div>
            <div class="modal-footer" style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%);">
                <button type="button" class="btn btn-light rounded-pill shadow-sm" style="background: #fff; color: #6267ae; border: none;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
    /* Test Item Card */
    .test-item {
        border: 2px solid #ac7fb6;
        margin-bottom: 15px;
        padding: 10px 15px;
        border-radius: 1rem;
        position: relative;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
        transition: all 0.3s ease;
    }
    
    .test-item:hover {
        box-shadow: 0 6px 12px rgb(0 0 0 / 0.15);
    }
    
    .test-item .d-flex {
        align-items: center;
        justify-content: space-between;
    }
    
    .test-item label {
        font-weight: 600;
        font-size: 1.1rem;
        user-select: none;
        cursor: pointer;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .test-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .controls button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.25rem;
        line-height: 1;
        padding: 0 5px;
        color: #cc235e;
        transition: color 0.2s ease-in-out;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .controls button:hover {
        color: #f6b51d;
        background-color: rgba(204, 35, 94, 0.1);
    }
    
    .test-title {
        background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%);
        color: #fff;
        padding: 8px 12px;
        margin: 10px -15px 10px -15px;
        text-align: center;
        cursor: pointer;
        border-radius: 1rem 1rem 0 0;
        font-weight: 600;
        user-select: none;
        transition: all 0.3s ease;
    }
    
    .test-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }
    
    .test-item.open .test-content {
        display: block;
    }
    
    .comment {
        margin-top: 10px;
        font-style: italic;
        color: #6267ae;
        font-size: 0.9rem;
        padding: 8px 12px;
        background-color: rgba(172, 127, 182, 0.1);
        border-radius: 0.5rem;
    }
    
    /* Table */
    table.table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    table.table thead th {
        /* background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); */
        /* color: white; */
        /* border: none; */
        font-weight: 600;
    }
    
    table.table td, table.table th {
        padding: 8px 10px !important;
        vertical-align: middle !important;
        font-size: 0.9rem;
        border: 1px solid #dee2e6;
    }
    
    table.table tbody tr:nth-child(even) {
        background-color: rgba(172, 127, 182, 0.05);
    }
    
    table.table tbody tr:hover {
        background-color: rgba(172, 127, 182, 0.1);
    }
    
    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Print Styles */
    @media print {
        .btn, .controls, .modal {
            display: none !important;
        }
        
        .test-item {
            border: 1px solid #000;
            break-inside: avoid;
        }
        
        .test-content {
            display: block !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function toggleDrawer(button) {
        const testItem = button.closest('.test-item');
        testItem.classList.toggle('open');
        button.textContent = testItem.classList.contains('open') ? '−' : '+';
    }

    function removeTest(testId) {
        const testElement = document.getElementById(testId);
        if (testElement) {
            testElement.remove();
        }
    }

    function selectAllTests(check) {
        const checkboxes = document.querySelectorAll('#testContainer .test-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = check);
    }

    // Print functionality
    document.querySelector('.print-report').addEventListener('click', function() {
        window.print();
    });

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+A to select all tests
        if (e.ctrlKey && e.key === 'a') {
            e.preventDefault();
            selectAllTests(true);
        }
        
        // Ctrl+D to deselect all tests
        if (e.ctrlKey && e.key === 'd') {
            e.preventDefault();
            selectAllTests(false);
        }
        
        // Ctrl+P to print
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            window.print();
        }
    });
</script>
@endsection