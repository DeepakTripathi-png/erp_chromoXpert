@extends('Admin.Layouts.layout')
@section('meta_title', 'Pets | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            {{-- Hero Header with Gradient Background --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Pet Management</h2>
                <p class="mb-0">View and manage all registered pets</p>
                <a href="{{ url('admin/pet/add') }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-plus me-2"></i> Add Pet
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-paw"></i>
                </div>
            </div>

            {{-- Search and Filter Inputs --}}
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
                <div class="input-group rounded-pill shadow-sm" style="max-width: 250px;">
                    <span class="input-group-text bg-white border-0 pe-1" style="background: #fff !important; border: 1px solid #f6b51d !important;">
                        <i class="mdi mdi-magnify text-muted"></i>
                    </span>
                    <input type="search" id="searchInput" class="form-control border-0 ps-1" placeholder="Search pets..."
                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                </div>
                <select id="statusFilter" class="form-select rounded-pill shadow-sm" style="max-width: 200px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
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
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 10%;">Code</th>
                                    <th style="width: 20%;">Pet Parent</th>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 15%;">Gender</th>
                                    <th style="width: 15%;">DOB</th>
                                    <th style="width: 10%;" class="text-center">Status</th>
                                    <th style="width: 15%;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach([
                                    ['id' => 1, 'code' => 'PET001', 'pet_parent' => 'Rahul Sharma', 'name' => 'Max', 'gender' => 'Male', 'dob' => '2020-05-15', 'status' => 'Active'],
                                    ['id' => 2, 'code' => 'PET002', 'pet_parent' => 'Priya Patel', 'name' => 'Bella', 'gender' => 'Female', 'dob' => '2019-11-22', 'status' => 'Inactive']
                                ] as $index => $pet)
                                <tr class="fade-in-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $pet['code'] }}</strong></td>
                                    <td>{{ $pet['pet_parent'] }}</td>
                                    <td>{{ $pet['name'] }}</td>
                                    <td>{{ $pet['gender'] }}</td>
                                    <td>{{ $pet['dob'] }}</td>
                                    <td class="text-center">
                                        <label class="switch">
                                            <input type="checkbox" class="change-status" 
                                                   data-id="{{ $pet['id'] }}" 
                                                   data-table="pets" 
                                                   data-flash="Status Changed Successfully!" 
                                                   {{ $pet['status'] == 'Active' ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                        <span class="spinner-border spinner-border-sm text-primary ms-2 d-none" id="loadingSpinner" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/pet/view/' . $pet['id']) }}" 
                                           class="btn btn-icon btn-info me-1" 
                                           title="View Pet" 
                                           data-bs-toggle="tooltip" 
                                           style="background: #fff; color: #6267ae; border: 1px solid #6267ae;">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/pet/edit/' . $pet['id']) }}" 
                                           class="btn btn-icon btn-warning me-1" 
                                           title="Edit Pet" 
                                           data-bs-toggle="tooltip" 
                                           style="background: #fff; color: #f6b51d; border: 1px solid #f6b51d;">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" 
                                           data-id="{{ $pet['id'] }}" 
                                           data-table="pets" 
                                           data-flash="Pet Deleted Successfully!" 
                                           class="btn btn-icon btn-danger delete" 
                                           title="Delete Pet" 
                                           data-bs-toggle="tooltip" 
                                           style="background: #fff; color: #cc235e; border: 1px solid #cc235e;">
                                            <i class="mdi mdi-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Custom Pagination with Consistent Styling --}}
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center custom-pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </nav>
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

    .table > thead th {
        border-bottom: none;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .table-responsive { overflow-x: auto; }
        .table { font-size: 0.9rem; }
        .btn-icon { width: 34px; height: 34px; }
        .form-control, .form-select { font-size: 0.9rem; }
    }
</style>
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_pet.js') }}"></script>
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
        if(confirm('Are you sure you want to delete this pet?')) {
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