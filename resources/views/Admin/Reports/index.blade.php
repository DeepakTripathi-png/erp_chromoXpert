@extends('Admin.Layouts.layout')

@section('meta_title', 'Test Reports | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Test Reports</h2>
                <p class="mb-0">Manage and view all laboratory test reports</p>
                {{-- <a href="{{ url('admin/generate-reports') }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-plus me-2"></i> Generate Report
                </a> --}}
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-file-document"></i>
                </div>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Search + Filter --}}
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <div class="input-group rounded-pill shadow-sm" style="max-width: 300px; background: #fff; border: 1px solid #f6b51d;">
                    <span class="input-group-text bg-transparent border-0 pe-1">
                        <i class="mdi mdi-magnify" style="color: #6267ae;"></i>
                    </span>
                    <input type="search" id="searchInput" class="form-control border-0 ps-1" placeholder="Search reports..." style="color: #6267ae;">
                </div>
                
                <select id="statusFilter" class="form-select rounded-pill shadow-sm" style="max-width: 200px; background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                    <option value="all">All Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            {{-- Glassmorphic Table Card --}}
           <div class="card border-0 shadow-lg rounded-4"
                style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="reports_data_table" class="table align-middle table-hover">
                            <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Barcode</th>
                                    <th>Animal Code</th>
                                    <th>Animal Name</th>
                                    <th>Owner Code</th>
                                    <th>Owner Name</th>
                                    <th>Tests</th>
                                    <th>Date</th>
                                    <th>Done</th>
                                    <th>Signed</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="fade-in-row">
                                    <td>135</td>
                                    <td>987739580884</td>
                                    <td>1632984040827</td>
                                    <td>Roay</td>
                                    <td>1632983960487</td>
                                    <td>Michael Maged</td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            <li>TEST</li>
                                            <li>test compo</li>
                                        </ul>
                                    </td>
                                    <td>26-08-2025 09:21</td>
                                    <td>-</td>
                                    <td>-</td>
                                  <td class="text-center">
                                        <a href="{{ url('admin/reports/view') }}" class="btn btn-icon btn-info me-1" title="Show"
                                        style="background: #fff; color: #6267ae; border: 1px solid #6267ae;">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/generate-reports') }}" class="btn btn-icon btn-warning me-1" title="Edit Report"
                                        style="background: #fff; color: #f6b51d; border: 1px solid #f6b51d;">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="{{ url('admin/test-report/sign/135') }}" class="btn btn-icon btn-success me-1" title="Sign Report"
                                        style="background: #fff; color: #28a745; border: 1px solid #28a745;">
                                            <i class="mdi mdi-signature-text"></i>
                                        </a>
                                        <a href="{{ url('admin/test-report/barcode/135') }}" class="btn btn-icon btn-primary" title="Print Barcode"
                                        style="background: #fff; color: #000; border: 1px solid #000;" data-bs-toggle="modal" data-bs-target="#barcodeModal">
                                            <i class="mdi mdi-barcode"></i>
                                        </a>
                                    </td>

                                </tr>

                                <tr class="fade-in-row">
                                    <td>134</td>
                                    <td>351821746260</td>
                                    <td>1630857328155</td>
                                    <td>dog</td>
                                    <td>1593914720</td>
                                    <td>text</td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            <li>DeepTest</li>
                                        </ul>
                                    </td>
                                    <td>26-08-2025 05:06</td>
                                    <td>-</td>
                                    <td>-</td>
                                   <td class="text-center">
                                        <a href="{{ url('admin/reports/view') }}" class="btn btn-icon btn-info me-1" title="Show"
                                        style="background: #fff; color: #6267ae; border: 1px solid #6267ae;">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ url('admin/generate-reports') }}" class="btn btn-icon btn-warning me-1" title="Edit Report"
                                        style="background: #fff; color: #f6b51d; border: 1px solid #f6b51d;">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="{{ url('admin/test-report/sign/135') }}" class="btn btn-icon btn-success me-1" title="Sign Report"
                                        style="background: #fff; color: #28a745; border: 1px solid #28a745;">
                                            <i class="mdi mdi-signature-text"></i>
                                        </a>
                                        <a href="{{ url('admin/test-report/barcode/135') }}" class="btn btn-icon btn-primary" 
                                        style="background: #fff; color: #000; border: 1px solid #000;" data-bs-toggle="modal" data-bs-target="#barcodeModal">
                                            <i class="mdi mdi-barcode"></i>
                                        </a>
                                    </td>

                                </tr>

                                {{-- Add more rows dynamically here --}}
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



<!-- Barcode Modal - Moved outside the main content to prevent z-index issues -->
<div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg" style="border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h5 class="modal-title fw-bold" id="barcodeModalLabel">Print Barcode</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label for="sampleCount" class="form-label fw-semibold" style="color:#6267ae;">Number of samples</label>
                    <input type="number" id="sampleCount" class="form-control rounded-3 shadow-sm" min="1" value="1">
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-danger rounded-pill shadow-sm px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning rounded-pill shadow-sm px-4" id="printBarcodeBtn">
                    <i class="mdi mdi-printer me-1"></i> Print
                </button>
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

    .custom-pagination .page-link {
        border-radius: 50%;
        margin: 0 4px;
        padding: 8px 14px;
        color: #6267ae;
        font-weight: 600;
        border: none;
        background: rgba(255,255,255,0.9);
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

    .table > thead th {
        border-bottom: none;
        font-weight: 600;
    }

    .alert {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('scripts')
<script src="{{ URL::asset('admin_panel/controller_js/cn_report.js') }}"></script>
<script>
$(document).ready(function() {
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#reports_data_table tbody tr').forEach(function(row) {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#reports_data_table tbody tr').forEach(function(row) {
            let status = row.querySelector('.badge').innerText.toLowerCase();
            row.style.display = (filter === 'all' || status === filter) ? '' : 'none';
        });
    });

    // Delete functionality
    $(document).on('click', '.btn-danger', function() {
        if(confirm('Are you sure you want to delete this report?')) {
            var id = $(this).data('id');
            var table = $(this).data('table');
            var flash_message = $(this).data('flash');
            var _token = $('meta[name="csrf-token"]').attr('content');
            
            // Simulate AJAX for static demo
            toastr.success(flash_message);
            $(this).closest('tr').remove();
            
            // Update row numbers
            $('#reports_data_table tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
        }
    });

    // Download report (simulated for static demo)
    $(document).on('click', '.btn-primary', function(e) {
        e.preventDefault();
        var reportId = $(this).closest('tr').find('td:nth-child(2)').text();
        toastr.info('Downloading report: ' + reportId + '.pdf');
    });
});
</script>
@endsection