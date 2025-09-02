@extends('Admin.Layouts.layout')
@section('meta_title') Departments | ChromoXpert @endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Departments</h2>
                <p class="mb-0">Manage all department details and statuses</p>
                <a href="{{ url('admin/departments/add') }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-plus me-2"></i> Add Department
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-medical-bag"></i>
                </div>
            </div>

            {{-- Search + Filter --}}
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <input type="text" id="searchInput" class="form-control rounded-pill shadow-sm" 
                       placeholder="Search departments..." style="max-width: 250px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                <select id="statusFilter" class="form-select rounded-pill shadow-sm" style="max-width: 200px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                    <option value="">All Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            {{-- Glassmorphic Table Card --}}
            <div class="card border-0 shadow-lg rounded-4"
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="cims_data_table" class="table align-middle table-hover">
                            <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Department Name</th>
                                    <th>Description</th>
                                    <th>Department Head</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach([
                                    ['id' => 1, 'code' => 'DEPT001', 'name' => 'Pathology', 'description' => 'Handles all pathology tests including blood tests, urine analysis, and tissue examinations', 'head' => 'Dr. Sanjay Verma', 'phone' => '+91 9876543210', 'email' => 'pathology@example.com', 'status' => 'Active'],
                                    ['id' => 2, 'code' => 'DEPT002', 'name' => 'Radiology', 'description' => 'Specializes in X-rays, CT scans, MRIs and other imaging diagnostics', 'head' => 'Dr. Priya Sharma', 'phone' => '+91 8765432109', 'email' => 'radiology@example.com', 'status' => 'Active'],
                                    ['id' => 3, 'code' => 'DEPT003', 'name' => 'Cardiology', 'description' => 'Cardiac tests, ECG, stress tests and heart-related diagnostics', 'head' => 'Dr. Rajesh Kumar', 'phone' => '+91 7654321098', 'email' => 'cardiology@example.com', 'status' => 'Inactive'],
                                    ['id' => 4, 'code' => 'DEPT004', 'name' => 'Neurology', 'description' => 'Specialized tests for nervous system disorders and brain conditions', 'head' => 'Dr. Ananya Reddy', 'phone' => '+91 6543210987', 'email' => 'neurology@example.com', 'status' => 'Active'],
                                    ['id' => 5, 'code' => 'DEPT005', 'name' => 'Oncology', 'description' => 'Cancer screening, tumor markers and related diagnostic tests', 'head' => 'Dr. Suman Das', 'phone' => '+91 9432109876', 'email' => 'oncology@example.com', 'status' => 'Active']
                                ] as $index => $dept)
                                <tr class="fade-in-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $dept['code'] }}</strong></td>
                                    <td>{{ $dept['name'] }}</td>
                                    <td>{{ $dept['description'] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>{{ $dept['head'] }}</span>
                                            <img src="https://i.pinimg.com/280x280_RS/79/dd/11/79dd11a9452a92a1accceec38a45e16a.jpg" 
                                                 alt="{{ $dept['head'] }}" 
                                                 class="rounded-circle ms-2" width="30" height="30">
                                        </div>
                                    </td>
                                    <td>{{ $dept['phone'] }}</td>
                                    <td>{{ $dept['email'] }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="change-status" 
                                                   data-id="{{ $dept['id'] }}" 
                                                   data-table="departments" 
                                                   data-flash="Status Changed Successfully!" 
                                                   {{ $dept['status'] == 'Active' ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/departments/view/' . $dept['id']) }}" 
                                           class="btn btn-icon btn-info me-1" title="View" 
                                           style="background: #fff; color: #6267ae; border: 1px solid #6267ae;">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/departments/edit/' . $dept['id']) }}" 
                                           class="btn btn-icon btn-warning me-1" title="Edit" 
                                           style="background: #fff; color: #f6b51d; border: 1px solid #f6b51d;">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="javascript:void(0)" 
                                           data-id="{{ $dept['id'] }}" 
                                           data-table="departments" 
                                           data-flash="Department Deleted Successfully!" 
                                           class="btn btn-icon btn-danger delete" title="Delete" 
                                           style="background: #fff; color: #cc235e; border: 1px solid #cc235e;">
                                            <i class="mdi mdi-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Custom Pagination --}}
                    <nav class="mt-3">
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
</style>
@endsection

@section('script')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#cims_data_table tbody tr').forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Status filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#cims_data_table tbody tr').forEach(function(row) {
            let status = row.querySelector('.change-status').checked ? 'active' : 'inactive';
            row.style.display = (filter === '' || status === filter) ? '' : 'none';
        });
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
            data: {
                id: id,
                table: table,
                _token: _token
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(flash_message);
                }
            },
            error: function(xhr) {
                toastr.error('Error changing status');
            }
        });
    });

    // Delete functionality
    $(document).on('click', '.delete', function() {
        if(confirm('Are you sure you want to delete this department?')) {
            var id = $(this).data('id');
            var table = $(this).data('table');
            var flash_message = $(this).data('flash');
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
                    if(response.success) {
                        toastr.success(flash_message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    toastr.error('Error deleting record');
                }
            });
        }
    });
</script>
@endsection