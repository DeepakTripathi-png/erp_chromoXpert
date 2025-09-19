@extends('Admin.Layouts.layout')

@section('meta_title', isset($department) ? 'Edit Department | ChromoXpert' : 'Add Department | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">{{ isset($department) ? 'Edit Department' : 'Add New Department' }}</h2>
                <p class="mb-0">{{ isset($department) ? 'Update the department details' : 'Fill in the details to create a new department record' }}</p>
                <a href="{{ url()->previous() }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-arrow-left me-2"></i> Back
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-medical-bag"></i>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="card border-0 shadow-lg rounded-4" 
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-4">
                    <form action="{{ url('admin/departments/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $department?->id ?? '' }}">

                        <div class="row g-3">
                            {{-- Department Code (auto-generated, readonly) --}}
                            @if(!empty($department))
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="code" 
                                           name="code" placeholder=" " value="{{ old('code', $department?->code ?? '') }}" 
                                           {{ isset($department) ? 'readonly' : '' }}
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="code" style="color: #6267ae;">Department Code</label>
                                    @error('code')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            {{-- Department Name --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="department_name" 
                                           name="department_name" placeholder=" "
                                           value="{{ old('department_name', $department?->department_name ?? '') }}"
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="department_name" style="color: #6267ae;">Department Name*</label>
                                    @error('department_name')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Department Head Name --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select rounded-3" id="head_name" name="head_name"
                                            style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <option value="" {{ !isset($department) ? 'selected' : '' }} disabled>Select Department Head</option>
                                        @if(!empty($department_heads))
                                            @foreach($department_heads as $head)
                                                <option value="{{ $head->id }}" 
                                                        {{ old('head_name', $department?->department_head ?? '') == $head->id ? 'selected' : '' }}>
                                                    {{ $head->user_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="head_name" style="color: #6267ae;">Department Head Name*</label>
                                    @error('head_name')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Mobile Number --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control rounded-3" id="mobile" 
                                           name="mobile" placeholder="+91XXXXXXXXXX"
                                           value="{{ old('mobile', $department?->mobile ?? '') }}"
                                           pattern="\+91[0-9]{10}" 
                                           title="Mobile number must start with +91 followed by 10 digits"
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="mobile" style="color: #6267ae;">Mobile Number</label>
                                    @error('mobile')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email Address --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control rounded-3" id="email" 
                                           name="email" placeholder=" "
                                           value="{{ old('email', $department?->email ?? '') }}"
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="email" style="color: #6267ae;">Email Address</label>
                                    @error('email')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-3" id="description" name="description" 
                                              rows="3" placeholder=" " 
                                              style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">{{ old('description', $department?->description ?? '') }}</textarea>
                                    <label for="description" style="color: #6267ae;">Description</label>
                                    @error('description')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm px-4"
                                    style="background: #6267ae; color: #fff; border: none;">
                                <i class="mdi mdi-content-save me-2"></i> {{ isset($department) ? 'Update Department' : 'Save Department' }}
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg rounded-pill shadow-sm px-4"
                                    style="background: #ac7fb6; color: #fff; border: none;">
                                <i class="mdi mdi-refresh me-2"></i> Reset
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .form-floating>.form-control, 
    .form-floating>.form-select {
        height: calc(3.5rem + 2px);
    }
</style>
@endsection

@section('scripts')
{{-- <script>
    $(document).ready(function () {
        // Mobile number formatting
        $('#mobile').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, ''); // Remove non-digits
            if (value.length > 10) {
                value = value.slice(0, 10); // Limit to 10 digits
            }
            if (value.length > 0) {
                $(this).val('+91' + value); // Prepend +91
            } else {
                $(this).val(''); // Clear if no digits
            }
        });
    });
</script> --}}
@endsection