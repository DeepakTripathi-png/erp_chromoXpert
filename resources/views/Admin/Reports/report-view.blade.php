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
            <div id="testContainer"></div>

        </div>
    </div>
</div>

{{-- Animal Info Modal --}}
<div class="modal fade" id="animalInfoModal" tabindex="-1" aria-labelledby="animalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4"
             style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(14px);">
            <div class="modal-header" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h5 class="modal-title" id="animalInfoModalLabel">Animal Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-2"><strong>Name:</strong> Dog</p>
                <p class="mb-2"><strong>Gender:</strong> Male</p>
                <p class="mb-2"><strong>Date of Birth:</strong> 03-09-2021</p>
                <p class="mb-2"><strong>Age:</strong> 3 Years</p>
                <p class="mb-2"><strong>Owner Name:</strong> John Doe</p>
                <p class="mb-2"><strong>Phone:</strong> +91 9876543210</p>
                <p class="mb-2"><strong>Email:</strong> owner@test.com</p>
                <p class="mb-2"><strong>Address:</strong> Pet Street, City</p>
            </div>
            <div class="modal-footer" style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%);">
                <button type="button" class="btn btn-light rounded-pill shadow-sm"
                        style="background: #fff; color: #6267ae; border: none;" data-bs-dismiss="modal">Close</button>
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
    }
    .test-item .d-flex {
        align-items: center;
        justify-content: space-between;
    }
    .test-item label {
        font-weight: 600;
        font-size: 1.1rem;
        user-select: none;
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
    }
    .controls button:hover {
        color: #f6b51d;
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
    }
    .test-content {
        display: none;
    }
    .test-item.open .test-content {
        display: block;
    }
    .comment {
        margin-top: 10px;
        font-style: italic;
        color: #6267ae;
        font-size: 0.9rem;
    }
    /* Table */
    table.table {
        margin-bottom: 0;
    }
    table.table td, table.table th {
        padding: 8px 10px !important;
        vertical-align: middle !important;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('scripts')
<script>
    const tests = [
        { id: "test1", title: "Complete Blood Count", components: [
            { test: "Hemoglobin", result: "13.5", unit: "g/dL", range: "12.0-16.0", status: "Normal", comment: "Within normal limits" },
            { test: "WBC Count", result: "7.2", unit: "x10³/µL", range: "4.0-11.0", status: "Normal", comment: "" }
        ]},
        { id: "test2", title: "Platelet Profile", components: [
            { test: "Platelet Count", result: "300", unit: "x10³/µL", range: "150-400", status: "Normal", comment: "Stable" }
        ]}
    ];

    function addTest(test) {
        const container = document.getElementById('testContainer');
        const div = document.createElement('div');
        div.className = 'test-item';
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <label><input type="checkbox" > ${test.title}</label>
                <div class="controls">
                    <button class="toggle-btn" onclick="toggleDrawer(this)">+</button>
                    <button class="close-btn" onclick="this.closest('.test-item').remove()">×</button>
                </div>
            </div>
            
            <div class="test-content">
                <div class="test-title">${test.title}</div>
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
                        ${test.components.map(comp => `
                            <tr>
                                <td>${comp.test}</td>
                                <td>${comp.result}</td>
                                <td>${comp.unit}</td>
                                <td>${comp.range}</td>
                                <td>${comp.status}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
                <div class="comment">Comment: ${test.components[0].comment}</div>
            </div>
        `;
        container.appendChild(div);
    }

    function toggleDrawer(button) {
        const testItem = button.closest('.test-item');
        testItem.classList.toggle('open');
        button.textContent = testItem.classList.contains('open') ? '−' : '+';
    }

    function selectAllTests(check) {
        const checkboxes = document.querySelectorAll('#testContainer input[type="checkbox"]');
        checkboxes.forEach(checkbox => checkbox.checked = check);
    }

    tests.forEach(addTest);

    // Print functionality
    document.querySelector('.print-report').addEventListener('click', function() {
        window.print();
    });
</script>
@endsection