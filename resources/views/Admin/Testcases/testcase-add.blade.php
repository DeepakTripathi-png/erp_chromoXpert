@extends('Admin.Layouts.layout')
@section('meta_title') Add Test | ChromoXpert @endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Header Section --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Create New Test</h2>
                <p class="mb-0">Configure your test details below</p>
                <a href="{{ url()->previous() }}" 
                   class="btn btn-light mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none; transition: transform 0.2s;">
                    <i class="mdi mdi-arrow-left me-2"></i> Back
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-test-tube"></i>
                </div>
            </div>

            {{-- Messages --}}
            @if(session('success'))
            <div class="alert alert-success rounded-3 mb-4" style="background: #6267ae; color: #fff;">
                <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger rounded-3 mb-4" style="background: #cc235e; color: #fff;">
                <i class="mdi mdi-alert me-2"></i> Please correct the following errors:
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form --}}
            <div class="card border-0 shadow-lg rounded-4" style="background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <form action="{{ url('admin/tests/store') }}" method="POST" id="testForm">
                        @csrf

                        {{-- Basic Test Info --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="test_name" name="name" required placeholder=" ">
                                    <label for="test_name" style="color: #6267ae;">Test Name <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="short_name" name="short_name" placeholder=" ">
                                    <label for="short_name" style="color: #6267ae;">Short Name</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="sample_type" name="sample_type" placeholder=" ">
                                    <label for="sample_type" style="color: #6267ae;">Sample Type</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control rounded-3" id="base_price" name="base_price" required placeholder=" " step="0.01">
                                    <label for="base_price" style="color: #6267ae;">Price (₹) <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        {{-- Precautions --}}
                        <div class="form-floating mb-4">
                            <textarea class="form-control rounded-3" id="precautions" name="precautions" placeholder=" " style="height:80px;"></textarea>
                            <label for="precautions" style="color:#6267ae;">Precautions</label>
                        </div>

                        {{-- Test Components Section --}}
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold" style="color: #6267ae;">Test Components</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn fw-bold rounded-pill add-btn" id="addTitle"
                                            style="background: #6267ae; color: #fff; border: none; padding: 8px 16px; transition: background 0.2s, transform 0.2s;">
                                        <i class="mdi mdi-plus me-1"></i> Title
                                    </button>
                                    <button type="button" class="btn fw-bold rounded-pill add-btn" id="addComponent"
                                            style="background: #6267ae; color: #fff; border: none; padding: 8px 16px; transition: background 0.2s, transform 0.2s;">
                                        <i class="mdi mdi-plus me-1"></i> Component
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle rounded-3" style="border-color: #e5e7eb;">
                                    <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                        <tr>
                                            <th style="min-width:220px;">Name</th>
                                            <th style="min-width:110px;">Unit</th>
                                            <th style="min-width:210px;">Result</th>
                                            <th style="min-width:180px;">Reference Range</th>
                                            <th class="text-center">Status</th>
                                            <th style="width:90px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="parametersTableBody">
                                        <!-- Rows added by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success rounded-pill"
                                        style="background: #6267ae; color: #fff; border: none; padding: 10px 24px; transition: background 0.2s;">
                                    <i class="mdi mdi-content-save me-2"></i> Save Test
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.getElementById('parametersTableBody');
    let rowCount = 0;

    const optionInputHTML = (rowIdx) => `
        <div class="d-flex align-items-center mb-2 option-item">
            <input type="text" class="form-control form-control-sm rounded-3" name="parameters[${rowIdx}][options][]" placeholder="Enter option">
            <button type="button" class="btn btn-sm btn-outline-danger ms-2 remove-option rounded-circle" title="Remove option">
                <i class="mdi mdi-minus"></i>
            </button>
        </div>`;

    const componentRowHTML = (i) => `
        <tr data-row="${i}" class="component-row">
            <td>
                <input type="hidden" name="parameters[${i}][row_type]" value="component">
                <input type="text" class="form-control rounded-3" name="parameters[${i}][name]" placeholder="Component" required>
            </td>
            <td>
                <input type="text" class="form-control rounded-3" name="parameters[${i}][unit]" placeholder="Unit">
            </td>
            <td>
                <div class="result-container" data-row-index="${i}">
                    <div class="d-flex flex-column gap-1 result-type-section">
                        <div class="form-check">
                            <input class="form-check-input result-type" type="radio" data-row-index="${i}"
                                   name="parameters[${i}][result_type]" value="text" id="text_${i}" checked>
                            <label class="form-check-label" for="text_${i}">Text</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input result-type" type="radio" data-row-index="${i}"
                                   name="parameters[${i}][result_type]" value="select" id="select_${i}">
                            <label class="form-check-label" for="select_${i}">Select</label>
                        </div>
                    </div>
                    <!-- Textarea visible by default -->
                    <div class="text-area-section mt-2">
                       <!-- <textarea class="form-control rounded-3" name="parameters[${i}][text_result]" placeholder="Enter text result" style="height: 80px;"></textarea>-->
                    </div>
                    <!-- Options hidden by default -->
                    <div class="select-options mt-2 p-2 border rounded-3 d-none" data-options-for="${i}">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="fw-semibold text-muted">Options</small>
                            <button type="button" class="btn btn-sm add-option-btn rounded-pill" data-row-index="${i}" title="Add option"
                                    style="background: #6267ae; color: #fff; border: none; padding: 6px 12px;">
                                <i class="mdi mdi-plus"></i>
                            </button>
                        </div>
                        <div class="options-list">
                            ${optionInputHTML(i)}
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <input type="text" class="form-control rounded-3" name="parameters[${i}][reference_range]" placeholder="Reference Range">
            </td>
            <td class="text-center">
                <input type="hidden" name="parameters[${i}][status]" value="0">
                <input type="checkbox" class="form-check-input" name="parameters[${i}][status]" value="1" checked>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-row rounded-circle" title="Remove" style="background-color: #dc3545; border: none; width: 32px; height: 32px;">
                    <i class="mdi mdi-trash-can" style="color: #fff;"></i>
                </button>
            </td>
        </tr>`;

    const titleRowHTML = (i) => `
        <tr data-row="${i}" class="title-row" style="background-color: #f8f9fa;">
            <td colspan="5">
                <input type="hidden" name="parameters[${i}][row_type]" value="title">
                <input type="text" class="form-control fw-bold title-input rounded-3" name="parameters[${i}][title]" placeholder="Title" required style="background: transparent; border: 1px dashed #ccc;" value="Title">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-row rounded-circle" title="Remove" style="background-color: #dc3545; border: none; width: 32px; height: 32px;">
                    <i class="mdi mdi-trash-can" style="color: #fff;"></i>
                </button>
            </td>
        </tr>`;

    // Add Component Row
    document.getElementById('addComponent').addEventListener('click', () => {
        tbody.insertAdjacentHTML('beforeend', componentRowHTML(rowCount));
        rowCount++;
    });

    // Add Title Row
    document.getElementById('addTitle').addEventListener('click', () => {
        tbody.insertAdjacentHTML('beforeend', titleRowHTML(rowCount));
        rowCount++;
    });

    // Toggle Text / Select
    tbody.addEventListener('change', (e) => {
        if (e.target.classList.contains('result-type')) {
            const idx = e.target.getAttribute('data-row-index');
            const textAreaBox = tbody.querySelector(`tr[data-row="${idx}"] .text-area-section`);
            const selectBox = tbody.querySelector(`.select-options[data-options-for="${idx}"]`);
            
            if (e.target.value === 'select') {
                textAreaBox.classList.add('d-none');
                selectBox.classList.remove('d-none');
            } else if (e.target.value === 'text') {
                selectBox.classList.add('d-none');
                textAreaBox.classList.remove('d-none');
            }
        }
    });

    // Options & Remove handlers
    tbody.addEventListener('click', (e) => {
        if (e.target.closest('.remove-row')) {
            e.preventDefault();
            e.target.closest('tr').remove();
            return;
        }
        if (e.target.closest('.add-option-btn')) {
            const btn = e.target.closest('.add-option-btn');
            const idx = btn.getAttribute('data-row-index');
            const box = tbody.querySelector(`.select-options[data-options-for="${idx}"]`);
            const list = box.querySelector('.options-list');
            list.insertAdjacentHTML('beforeend', optionInputHTML(idx));
            return;
        }
        if (e.target.closest('.remove-option')) {
            e.preventDefault();
            const item = e.target.closest('.option-item');
            if (item) item.remove();
        }
    });
});
</script>

<style>
.title-input {
    font-weight: bold;
    background-color: transparent;
    border: 1px dashed #ccc;
    transition: border-color 0.2s;
}
.title-input:focus {
    border-color: #6267ae;
}
.option-item {
    margin-bottom: 8px;
}
.remove-option, .remove-row {
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s;
}
.remove-option:hover, .remove-row:hover {
    background-color: #dc3545;
}
.select-options {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 12px;
    margin-top: 8px;
}
.add-btn:hover {
    background: #4b5194 !important;
    transform: translateY(-2px);
}
.form-control, .btn {
    transition: all 0.2s;
}
.table th, .table td {
    vertical-align: middle;
    padding: 12px;
    border-color: #e5e7eb;
}
.table-bordered {
    border-radius: 8px;
    overflow: hidden;
}
.table thead {
    background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%);
    color: #fff;
    border: none;
}
</style>
@endsection
