@extends('Admin.Layouts.layout')
@section('meta_title', 'Invoice | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Invoice</h2>
                <p class="mb-0">Pet Test & Billing Details</p>
                <a href="{{ url('admin/appointments') }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-arrow-left me-2"></i> Back
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-receipt"></i>
                </div>
            </div>

            {{-- Invoice Card --}}
            <div class="card border-0 shadow-lg rounded-4 mb-4"
                 style="background: rgba(255,255,255,0.9); backdrop-filter: blur(12px);">
                <div class="card-body p-4">

                    {{-- Invoice Info --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <p><strong style="color: #6267ae;">Animal Code:</strong> 1630857328155</p>
                            <p><strong style="color: #6267ae;">Owner Code:</strong> 1593914720</p>
                            <p><strong style="color: #6267ae;">Age:</strong> 3 Years</p>
                            <p><strong style="color: #6267ae;">Doctor:</strong> Pedro</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong style="color: #6267ae;">Animal Name:</strong> Dog</p>
                            <p><strong style="color: #6267ae;">Owner Name:</strong> Text</p>
                            <p><strong style="color: #6267ae;">Gender:</strong> Male</p>
                            <p><strong style="color: #6267ae;">Date:</strong> {{ date('d-m-Y h:i A') }}</p>
                        </div>
                    </div>

                    <p class="fw-semibold mb-3" style="color: #cc235e;">Due Date: {{ date('d/m/Y') }}</p>

                    {{-- Invoice Table --}}
                    <div class="table-responsive rounded-3 shadow-sm mb-4">
                        <table class="table table-bordered align-middle mb-0">
                            <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start">DeepTest</td>
                                    <td>600 ₹</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Totals --}}
                    <div class="d-flex justify-content-end">
                        <div class="p-3 rounded-3 shadow-sm"
                             style="background: rgba(98,103,174,0.1); min-width: 250px;">
                            <p class="d-flex justify-content-between mb-1">
                                <span><strong>Subtotal</strong></span><span>600 ₹</span>
                            </p>
                            <p class="d-flex justify-content-between mb-1">
                                <span><strong>Discount</strong></span><span>0 ₹</span>
                            </p>
                            <p class="d-flex justify-content-between mb-1">
                                <span><strong>Total</strong></span><span>600 ₹</span>
                            </p>
                            <p class="d-flex justify-content-between mb-1">
                                <span><strong>Paid</strong></span><span>0 ₹</span>
                            </p>
                            <p class="d-flex justify-content-between text-danger fw-bold">
                                <span>Due</span><span>600 ₹</span>
                            </p>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="mt-4 d-flex gap-2">
                        <!-- Print Receipt Button -->
                        <a href="{{ asset('package_assets/samplepdf/chromoxpert_receipt.pdf') }}" 
                           target="_blank" 
                           class="btn btn-primary btn-lg rounded-pill shadow-sm px-4"
                           style="background: #5e5e9d; border-color: #5e5e9d; color: #fff;">
                            <i class="mdi mdi-printer me-2"></i> Print Receipt
                        </a>

                        <!-- Print Barcode Button (modal trigger) -->
                        <button class="btn btn-secondary btn-lg rounded-pill shadow-sm px-4"
                                style="background: #a86b9a; border-color: #a86b9a; color: #fff;"
                                data-bs-toggle="modal" data-bs-target="#barcodeModal">
                            <i class="mdi mdi-barcode me-2"></i> Print Barcode
                        </button>
                    </div>

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
    .table th, .table td {
        vertical-align: middle;
    }
    .table-bordered th, .table-bordered td {
        border-color: #f6b51d !important;
    }
    .btn-lg {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
    }
    .btn-warning {
        background: #f6b51d;
        border-color: #f6b51d;
        color: #1f2937;
    }
    .btn-warning:hover {
        background: #e0a21a;
        border-color: #e0a21a;
    }

    /* --- Fix Modal Overlap Issue --- */
    .modal-backdrop {
        z-index: 1040 !important;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal {
        z-index: 1055 !important; /* Increased z-index to ensure modal appears above backdrop */
    }
    
    /* Ensure modal content is properly positioned */
    .modal-content {
        position: relative;
        z-index: 1060;
    }
</style>
@endsection

@section('script')
<script>
    // Print Barcode functionality
    document.getElementById('printBarcodeBtn').addEventListener('click', function() {
        const sampleCount = document.getElementById('sampleCount').value;
        const cloneCount = document.getElementById('cloneCount').value;
        
        // Here you would typically make an AJAX request to generate the barcode
        // For demonstration, we'll just show an alert
        alert(`Printing ${sampleCount} samples with ${cloneCount} clones`);
        
        // Close the modal after printing
        var modal = bootstrap.Modal.getInstance(document.getElementById('barcodeModal'));
        modal.hide();
    });
</script>
@endsection