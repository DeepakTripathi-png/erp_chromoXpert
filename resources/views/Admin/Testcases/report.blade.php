@extends('Admin.Layouts.layout')

@section('meta_title', 'Manage Report Formats | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Manage Report Formats</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ url('admin/tests') }}" class="btn btn-secondary waves-effect waves-light">
                                <span class="btn-label"><i class="fas fa-long-arrow-alt-left"></i></span>Back to Tests
                            </a>
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addReportFormatModal">
                                <span class="btn-label"><i class="fas fa-plus"></i></span>Add Report Format
                            </button>
                        </div>
                    </div>

                    <!-- Success and Error Messages -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body table-responsive">
                            <table id="report_formats_table" class="table table-bordered dt-responsive w-100 dataTable no-footer">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sorting sorting_asc" tabindex="0" aria-sort="ascending">Sr No</th>
                                        <th class="sorting">Format Name</th>
                                        <th class="sorting">Layout Type</th>
                                        <th class="sorting">Fields Included</th>
                                        <th class="sorting">Status</th>
                                        <th class="sorting_disabled">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="sorting_1">1</td>
                                        <td>Veterinary Allergy Report</td>
                                        <td>PDF</td>
                                        <td>Pet Name, Species, Owner, ChromoXpertID, Parameters</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="1" data-table="report_formats" data-flash="Status Changed Successfully!" class="change-status">
                                                <i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title="Active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-info btn-xs edit-format" data-id="1" title="Edit" data-bs-toggle="modal" data-bs-target="#editReportFormatModal">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-id="1" data-table="report_formats" data-flash="Format Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete">
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="sorting_1">2</td>
                                        <td>Basic Veterinary Report</td>
                                        <td>Word</td>
                                        <td>Pet Name, Owner, Date, Result</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="2" data-table="report_formats" data-flash="Status Changed Successfully!" class="change-status">
                                                <i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title="Active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-info btn-xs edit-format" data-id="2" title="Edit" data-bs-toggle="modal" data-bs-target="#editReportFormatModal">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-id="2" data-table="report_formats" data-flash="Format Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete">
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Report Format Modal -->
    <div class="modal fade" id="addReportFormatModal" tabindex="-1" aria-labelledby="addReportFormatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReportFormatModalLabel">Add Report Format</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addReportFormatForm">
                        <ul class="nav nav-tabs nav-justified mb-3" id="formatTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="fields-tab" data-bs-toggle="tab" href="#fields" role="tab" aria-controls="fields" aria-selected="true">Fields</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="styling-tab" data-bs-toggle="tab" href="#styling" role="tab" aria-controls="styling" aria-selected="false">Styling</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="preview-tab" data-bs-toggle="tab" href="#preview" role="tab" aria-controls="preview" aria-selected="false">Preview</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="formatTabsContent">
                            <!-- Fields Tab -->
                            <div class="tab-pane fade show active" id="fields" role="tabpanel" aria-labelledby="fields-tab">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="format_name" class="form-label">Format Name</label>
                                        <input type="text" class="form-control" id="format_name" name="format_name" value="Veterinary Allergy Report">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="layout_type" class="form-label">Layout Type</label>
                                        <select class="form-select" id="layout_type" name="layout_type">
                                            <option value="PDF" selected>PDF</option>
                                            <option value="Word">Word</option>
                                            <option value="HTML">HTML</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="fields_included" class="form-label">Fields to Include</label>
                                        <select class="form-select" id="fields_included" name="fields_included[]" multiple>
                                            <option value="Pet Name" selected>Pet Name</option>
                                            <option value="Owner" selected>Owner</option>
                                            <option value="Address">Address</option>
                                            <option value="Species" selected>Species</option>
                                            <option value="Breed">Breed</option>
                                            <option value="Age" selected>Age</option>
                                            <option value="Sex" selected>Sex</option>
                                            <option value="Dr. Name" selected>Dr. Name</option>
                                            <option value="Date" selected>Date</option>
                                            <option value="ChromoXpertID" selected>ChromoXpertID</option>
                                            <option value="Parameters">Parameters</option>
                                            <option value="Clinical/Genetic History">Clinical/Genetic History</option>
                                            <option value="Result">Result</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="decimal_places" class="form-label">Decimal Places</label>
                                        <input type="number" class="form-control" id="decimal_places" name="decimal_places" value="2">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="active" class="form-label">Active</label>
                                        <select class="form-select" id="active" name="active">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Styling Tab -->
                            <div class="tab-pane fade" id="styling" role="tabpanel" aria-labelledby="styling-tab">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="font_style" class="form-label">Font Style</label>
                                        <select class="form-select" id="font_style" name="font_style">
                                            <option value="Arial" selected>Arial</option>
                                            <option value="Times New Roman">Times New Roman</option>
                                            <option value="Helvetica">Helvetica</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="header_color" class="form-label">Header Color</label>
                                        <input type="color" class="form-control form-control-color" id="header_color" name="header_color" value="#007bff">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="logo_upload" class="form-label">Header Logo</label>
                                        <input type="file" class="form-control" id="logo_upload" name="logo_upload" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <!-- Preview Tab -->
                            <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                                <div class="card">
                                    <div class="card-body" id="preview-content">
                                        <!-- Preview will be dynamically updated -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save Format</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Report Format Modal -->
    <div class="modal fade" id="editReportFormatModal" tabindex="-1" aria-labelledby="editReportFormatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReportFormatModalLabel">Edit Report Format</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editReportFormatForm">
                        <input type="hidden" id="edit_format_id" name="format_id">
                        <ul class="nav nav-tabs nav-justified mb-3" id="editFormatTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="edit-fields-tab" data-bs-toggle="tab" href="#edit-fields" role="tab" aria-controls="edit-fields" aria-selected="true">Fields</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="edit-styling-tab" data-bs-toggle="tab" href="#edit-styling" role="tab" aria-controls="edit-styling" aria-selected="false">Styling</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="edit-preview-tab" data-bs-toggle="tab" href="#edit-preview" role="tab" aria-controls="edit-preview" aria-selected="false">Preview</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="editFormatTabsContent">
                            <!-- Fields Tab -->
                            <div class="tab-pane fade show active" id="edit-fields" role="tabpanel" aria-labelledby="edit-fields-tab">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_format_name" class="form-label">Format Name</label>
                                        <input type="text" class="form-control" id="edit_format_name" name="format_name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_layout_type" class="form-label">Layout Type</label>
                                        <select class="form-select" id="edit_layout_type" name="layout_type">
                                            <option value="PDF">PDF</option>
                                            <option value="Word">Word</option>
                                            <option value="HTML">HTML</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="edit_fields_included" class="form-label">Fields to Include</label>
                                        <select class="form-select" id="edit_fields_included" name="fields_included[]" multiple>
                                            <option value="Pet Name">Pet Name</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Address">Address</option>
                                            <option value="Species">Species</option>
                                            <option value="Breed">Breed</option>
                                            <option value="Age">Age</option>
                                            <option value="Sex">Sex</option>
                                            <option value="Dr. Name">Dr. Name</option>
                                            <option value="Date">Date</option>
                                            <option value="ChromoXpertID">ChromoXpertID</option>
                                            <option value="Parameters">Parameters</option>
                                            <option value="Clinical/Genetic History">Clinical/Genetic History</option>
                                            <option value="Result">Result</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_decimal_places" class="form-label">Decimal Places</label>
                                        <input type="number" class="form-control" id="edit_decimal_places" name="decimal_places">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_active" class="form-label">Active</label>
                                        <select class="form-select" id="edit_active" name="active">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Styling Tab -->
                            <div class="tab-pane fade" id="edit-styling" role="tabpanel" aria-labelledby="edit-styling-tab">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_font_style" class="form-label">Font Style</label>
                                        <select class="form-select" id="edit_font_style" name="font_style">
                                            <option value="Arial">Arial</option>
                                            <option value="Times New Roman">Times New Roman</option>
                                            <option value="Helvetica">Helvetica</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_header_color" class="form-label">Header Color</label>
                                        <input type="color" class="form-control form-control-color" id="edit_header_color" name="header_color">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="edit_logo_upload" class="form-label">Header Logo</label>
                                        <input type="file" class="form-control" id="edit_logo_upload" name="logo_upload" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <!-- Preview Tab -->
                            <div class="tab-pane fade" id="edit-preview" role="tabpanel" aria-labelledby="edit-preview-tab">
                                <div class="card">
                                    <div class="card-body" id="edit-preview-content">
                                        <!-- Preview will be dynamically updated -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Format</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::asset('admin_panel/controller_js/cn_test.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#report_formats_table').DataTable({
        responsive: true,
        processing: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        order: [[0, 'asc']],
        language: {
            processing: '<div class="dataTables_processing card">Processing...</div>'
        }
    });

    // Static test data for preview
    const testData = {
        pet_name: "Skittles",
        owner: "Yadav",
        address: "Mumbai",
        species: "Canine",
        breed: "-",
        age: "1.5",
        sex: "F",
        dr_name: "Blue Cross Clinic",
        date: "26-06-2025",
        chromoxpert_id: "21150178",
        parameters: [
            { name: "IgE Levels", value: "150 IU/mL", range: "50-100 IU/mL", status: "High" },
            { name: "Allergen Sensitivity", value: "Positive", range: "Negative", status: "Abnormal" }
        ],
        clinical_genetic_history: "None",
        result: "Allergy detected; consult veterinarian."
    };

    // Function to generate preview
    function generatePreview(formId, previewContentId) {
        const form = $(`#${formId}`);
        const fields = form.find('[name="fields_included[]"]').val() || [];
        const fontStyle = form.find('[name="font_style"]').val();
        const headerColor = form.find('[name="header_color"]').val();

        let previewHtml = `<div style="font-family: ${fontStyle}; color: #000;">`;
        previewHtml += `<h5 style="color: ${headerColor}; text-align: center;">ChromoXpert Allergy Test Report</h5>`;
        previewHtml += `<p style="text-align: center;">234, Silver Springs, Taloja MIDC, Plot 6, Taloja, Navi Mumbai, 410208</p>`;
        previewHtml += `<p style="text-align: center;">Email: info@chromoxpert.com | Website: www.chromoxpert.com</p>`;

        fields.forEach(field => {
            if (field === "Parameters" && testData.parameters) {
                previewHtml += `<h6>Parameters</h6>`;
                previewHtml += `<table class="table table-bordered"><thead><tr><th>Parameter</th><th>Value</th><th>Range</th><th>Status</th></tr></thead><tbody>`;
                testData.parameters.forEach(param => {
                    previewHtml += `<tr><td>${param.name}</td><td>${param.value}</td><td>${param.range}</td><td>${param.status}</td></tr>`;
                });
                previewHtml += `</tbody></table>`;
            } else if (testData[field.toLowerCase().replace(/ /g, '_')]) {
                previewHtml += `<p><strong>${field}:</strong> ${testData[field.toLowerCase().replace(/ /g, '_')]}</p>`;
            }
        });

        previewHtml += `</div>`;
        $(`#${previewContentId}`).html(previewHtml);
    }

    // Preview on tab switch
    $('#formatTabs a[href="#preview"]').on('shown.bs.tab', function() {
        generatePreview('addReportFormatForm', 'preview-content');
    });
    $('#editFormatTabs a[href="#edit-preview"]').on('shown.bs.tab', function() {
        generatePreview('editReportFormatForm', 'edit-preview-content');
    });

    // Status toggle functionality
    $(document).on('click', '.change-status', function() {
        var id = $(this).data('id');
        var table = $(this).data('table');
        var flash_message = $(this).data('flash');
        var _token = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: "{{ url('admin/change-status') }}",
            type: "POST",
            data: { id: id, table: table, _token: _token },
            success: function(response) {
                if(response.success) {
                    toastr.success(flash_message);
                    var icon = $('.change-status[data-id="'+id+'"]').find('i');
                    if(icon.hasClass('fa-toggle-on')) {
                        icon.removeClass('fa-toggle-on tgle-on').addClass('fa-toggle-off tgle-off');
                        icon.attr('title', 'Inactive');
                    } else {
                        icon.removeClass('fa-toggle-off tgle-off').addClass('fa-toggle-on tgle-on');
                        icon.attr('title', 'Active');
                    }
                }
            },
            error: function(xhr) {
                toastr.error('Error changing status');
            }
        });
    });

    // Delete functionality
    $(document).on('click', '.delete', function() {
        if(confirm('Are you sure you want to delete this report format?')) {
            var id = $(this).data('id');
            var table = $(this).data('table');
            var flash_message = $(this).data('flash');
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                url: "{{ url('admin/delete-record') }}",
                type: "POST",
                data: { id: id, table: table, _token: _token },
                success: function(response) {
                    if(response.success) {
                        toastr.success(flash_message);
                        $('.delete[data-id="'+id+'"]').closest('tr').remove();
                        $('#report_formats_table tbody tr').each(function(index) {
                            $(this).find('td.sorting_1').text(index + 1);
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error('Error deleting report format');
                }
            });
        }
    });

    // Edit format modal population
    $(document).on('click', '.edit-format', function() {
        var id = $(this).data('id');
        var formats = {
            1: {
                format_name: 'Veterinary Allergy Report',
                layout_type: 'PDF',
                fields_included: ['Pet Name', 'Species', 'Owner', 'ChromoXpertID', 'Parameters'],
                font_style: 'Arial',
                header_color: '#007bff',
                decimal_places: 2,
                active: 1
            },
            2: {
                format_name: 'Basic Veterinary Report',
                layout_type: 'Word',
                fields_included: ['Pet Name', 'Owner', 'Date', 'Result'],
                font_style: 'Times New Roman',
                header_color: '#28a745',
                decimal_places: 1,
                active: 1
            }
        };

        var format = formats[id];
        $('#edit_format_id').val(id);
        $('#edit_format_name').val(format.format_name);
        $('#edit_layout_type').val(format.layout_type);
        $('#edit_fields_included').val(format.fields_included);
        $('#edit_font_style').val(format.font_style);
        $('#edit_header_color').val(format.header_color);
        $('#edit_decimal_places').val(format.decimal_places);
        $('#edit_active').val(format.active);
        generatePreview('editReportFormatForm', 'edit-preview-content');
    });

    // Form submission (static simulation)
    $('#addReportFormatForm, #editReportFormatForm').on('submit', function(e) {
        e.preventDefault();
        toastr.success('Report format saved successfully!');
        $(this).closest('.modal').modal('hide');
    });
});
</script>
@endsection