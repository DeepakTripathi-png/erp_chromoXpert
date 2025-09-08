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
                    <!-- Basic Info -->
                    <div class="row fade-in-row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Test Code</label>
                            <p class="form-control-static">{{ $test->test_code ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Test Name</label>
                            <p class="form-control-static">{{ $test->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Short Name</label>
                            <p class="form-control-static">{{ $test->short_name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sample Type</label>
                            <p class="form-control-static">{{ $test->sample_type ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Base Price</label>
                            <p class="form-control-static">{{ number_format($test->base_price, 2) ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-static">{{ ucfirst($test->status) ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Precautions</label>
                            <p class="form-control-static">{{ $test->precautions ?? 'N/A' }}</p>
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

    .bg-light {
        background: #f8f9fa !important;
        border: none;
    }

    @media (max-width: 768px) {
        .btn-lg { font-size: 0.9rem; padding: 0.5rem 1rem; }
        .form-label { font-size: 0.9rem; }
        .p-3 { padding: 1rem !important; }
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Bootstrap tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endsection