@extends('Admin.Layouts.layout')

@section('meta_title', 'Add Branches | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Add New Branch</h2>
                <p class="mb-0">Fill in the details to create a new branch record</p>
                <a href="{{ url()->previous() }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-arrow-left me-2"></i> Back
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-hospital-building"></i>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="card border-0 shadow-lg rounded-4" 
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-4">
                    
                   <form action="{{ route('branch.store') }}"  method="post" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="id" value="{{ $branch->id??'' }}">
                     

                            <div class="row">
                                {{-- Left Column --}}
                                <div class="col-md-8">
                                    <div class="row g-3">

                                        {{-- Branch Name --}}
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-3" id="branch_name" 
                                                    name="branch_name" value="{{ old('branch_name', $branch->branch_name ?? '') }}" placeholder=" " >
                                                <label for="branch_name" style="color: #6267ae;">Branch Name*</label>
                                                @error('branch_name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- Branch Code (auto-generated, keep readonly for update) --}}
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-3" id="branch_code" 
                                                    name="branch_code" value="{{ old('branch_code', $branch->branch_code ?? '') }}" placeholder=" " >
                                                <label for="branch_code" style="color: #6267ae;">Branch Code</label>
                                            </div>
                                        </div>

                                        {{-- Mobile --}}
                                      <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control rounded-3" id="mobile" 
                                                    name="mobile" value="{{ old('mobile', $branch->mobile ?? '') }}" 
                                                    placeholder="+91XXXXXXXXXX" pattern="\+91[0-9]{10}" 
                                                    title="Mobile number must start with +91 followed by 10 digits">
                                                <label for="mobile" style="color: #6267ae;">Mobile*</label>
                                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                      </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control rounded-3" id="email" 
                                                    name="email" value="{{ old('email', $branch->email ?? '') }}" placeholder=" " >
                                                <label for="email" style="color: #6267ae;">Email*</label>
                                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-3" id="address" 
                                                    name="address" value="{{ old('address', $branch->address ?? '') }}" placeholder=" " >
                                                <label for="address" style="color: #6267ae;">Address*</label>
                                                @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- Country --}}
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-select rounded-3" id="country" name="country_id" >
                                                    <option value="">Select Country</option>
                                                    <option value="1" {{ old('country_id', $branch->country_id ?? '') == '1' ? 'selected' : '' }}>India</option>
                                                </select>
                                                <label for="country" style="color: #6267ae;">Country*</label>
                                                @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- State --}}
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-select rounded-3" id="state" name="state_id" >
                                                    <option value="">Select State</option>
                                                </select>
                                                <label for="state" style="color: #6267ae;">State*</label>
                                                @error('state_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- City --}}
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-select rounded-3" id="city" name="city_id" >
                                                    <option value="">Select City</option>
                                                </select>
                                                <label for="city" style="color: #6267ae;">City*</label>
                                                @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- Pincode --}}
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control rounded-3" id="pincode" 
                                                    name="pincode" value="{{ old('pincode', $branch->pincode ?? '') }}" placeholder=" " >
                                                <label for="pincode" style="color: #6267ae;">Pincode*</label>
                                                @error('pincode')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                        {{-- Lab Incharge --}}
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-select rounded-3" id="lab_incharge" name="lab_incharge" >
                                                    <option value="">Select Lab Incharge</option>
                                                    @foreach ($labincharge as $data)
                                                        <option value="{{ $data->id }}" 
                                                            {{ old('lab_incharge', $branch->lab_incharge ?? '') == $data->id ? 'selected' : '' }}>
                                                            {{ $data->user_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="lab_incharge" style="color: #6267ae;">Lab Incharge*</label>
                                                @error('lab_incharge')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- Right Column: Lab Logo --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold" style="color: #6267ae;">Lab Logo</label>
                                    <input type="file" data-plugins="dropify" name="branch_logo_path" id="branch_logo_path" accept="image/*"
                                        data-default-file="{{ !empty($branch->branch_logo_path) ? asset('storage/'.$branch->branch_logo_path) : '' }}">
                                    @error('branch_logo_path')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            {{-- Description (optional column, not in DB) --}}
                            {{-- <div class="mt-4">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-3" id="description" name="description" 
                                            rows="3" placeholder=" ">{{ old('description') }}</textarea>
                                    <label for="description" style="color: #6267ae;">Description</label>
                                </div>
                            </div> --}}

                            {{-- Buttons --}}
                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm px-4"
                                        style="background: #6267ae; color: #fff; border: none;">
                                    <i class="mdi mdi-content-save me-2"></i> {{ !empty($branch) ? 'Update Branch' : 'Save Branch' }}
                                </button>
                                <button type="reset" class="btn btn-secondary btn-lg rounded-pill shadow-sm px-4">
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
    .dropify-wrapper {
        border-radius: 1rem !important;
        background: #fff;
        color: #6267ae;
        border: 1px solid #f6b51d;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[data-plugins="dropify"]').dropify();
    });
</script>
<script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[data-plugins="dropify"]').dropify();

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

        // Handle country change to load states
        $('#country').change(function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: '/admin/get-states/' + countryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#state').empty();
                        $('#state').append('<option value="">Select State</option>');
                        $.each(data, function(key, value) {
                            $('#state').append('<option value="' + value.state_id + '">' + value.name + '</option>');
                        });
                        $('#city').val('');
                    }
                });
            } else {
                $('#state').empty();
                $('#state').append('<option value="">Select State</option>');
                $('#city').val('');
            }
        });

        // Handle state change to load cities
        $('#state').change(function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '/admin/get-cities/' + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.city_id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        });
    });
</script>
@endsection