@extends('Admin.Layouts.layout')
@section('meta_title') Doctors | ChromoXpert @endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            {{-- Hero Header with Gradient Background --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Doctors</h2>
                <p class="mb-0">Manage all doctor details and commission statuses</p>
              
                <a href="{{ url('admin/internal-doctors/add') }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-plus me-2"></i> Add Doctor
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-doctor"></i>
                </div>
            </div>

            {{-- Search and Filter Inputs --}}
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                <input type="text" id="searchInput" class="form-control rounded-pill shadow-sm" 
                       placeholder="Search doctors..." style="max-width: 250px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;padding-top:9px; padding-bottom:9px;">
                <select id="statusFilter" class="form-select rounded-pill shadow-sm" style="max-width: 200px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;padding-top:9px; padding-bottom:9px;">
                    <option value="">All Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            {{-- Glassmorphic Table Card --}}
            <div class="card border-0 shadow-lg rounded-4"
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-4">
                    <div class="table-responsive">

             

                        <table id="cims_data_table" class="table align-middle table-hover">
                            <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                <tr>
                                    <th style="width: 5%;">Sr No</th>
                                    <th style="width: 8%;">Code</th>
                                    <th style="width: 12%;">Name</th>
                                    <th style="width: 10%;">Gender</th>
                                    <th style="width: 12%;">Email</th>
                                    <th style="width: 10%;">Phone</th>
                                    <th style="width: 20%;">Address</th>
                                    <th style="width: 6%;">Status</th>
                                    <th style="width: 10%;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>

                    </div>

                  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .btn-icon {
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
    }
    .btn-icon:hover { transform: scale(1.15); }

    .fade-in-row { animation: fadeInUp 0.6s ease-in-out; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc; transition: .4s; border-radius: 24px;
    }
    .slider:before {
        position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px;
        background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider {
        background: linear-gradient(135deg, #6267ae 0%, #f6b51d 100%);
        box-shadow: 0 0 10px #f6b51d;
    }
    input:checked + .slider:before { transform: translateX(20px); }

    .custom-pagination .page-link {
        border-radius: 50%;
        margin: 0 4px; padding: 8px 14px;
        color: #6267ae; font-weight: 600;
        border: none; background: rgba(255,255,255,0.9);
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .custom-pagination .page-link:hover {
        background: #f6b51d;
        color: #fff;
    }
    .custom-pagination .active .page-link {
        background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);
        color: #fff;
    }

    .form-control:focus, .form-select:focus {
        border-color: #f6b51d;
        box-shadow: 0 0 8px rgba(246, 181, 29, 0.5);
    }

    .spinner-border { vertical-align: middle; }

    @media (max-width: 768px) {
        .table-responsive { overflow-x: auto; }
        .table { font-size: 0.9rem; }
        .btn-icon { width: 34px; height: 34px; }
        .form-control, .form-select { font-size: 0.9rem; }
    }
</style>
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_internal-doctor.js') }}"></script>
<script>
    // Debounce function to limit search input processing
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Search functionality with debounce
    document.getElementById('searchInput').addEventListener('keyup', debounce(function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#cims_data_table tbody tr').forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }, 300));

    // Status filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#cims_data_table tbody tr').forEach(function(row) {
            let status = row.querySelector('.change-status').checked ? 'active' : 'inactive';
            row.style.display = (filter === '' || status === filter) ? '' : 'none';
        });
    });

    // Status toggle with AJAX and loading spinner
    $(document).on('click', '.change-status', function() {
        var $this = $(this);
        var $spinner = $('#loadingSpinner').removeClass('d-none');
        var id = $this.data('id');
        var table = $this.data('table');
        var flash_message = $this.data('flash');
        var _token = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: "{{ url('admin/change-status') }}",
            type: "POST",
            data: {
                id: id,
                table: table,
                _token: _token
            },
            success: function(response) {
                $spinner.addClass('d-none');
                if(response.success) {
                    toastr.success(flash_message);
                }
            },
            error: function(xhr) {
                $spinner.addClass('d-none');
                toastr.error('Error changing status');
            }
        });
    });

    // Delete functionality with confirmation and loading spinner
    $(document).on('click', '.delete', function() {
        if(confirm('Are you sure you want to delete this doctor?')) {
            var $this = $(this);
            var $spinner = $('#loadingSpinner').removeClass('d-none');
            var id = $this.data('id');
            var table = $this.data('table');
            var flash_message = $this.data('flash');
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                url: "{{ url('admin/delete-record') }}",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    _token: _token
                },
                success: function(response) {
                    $spinner.addClass('d-none');
                    if(response.success) {
                        toastr.success(flash_message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    $spinner.addClass('d-none');
                    toastr.error('Error deleting record');
                }
            });
        }
    });

    // Initialize Bootstrap tooltips
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@endsection