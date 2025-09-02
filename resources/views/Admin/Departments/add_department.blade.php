@extends('Admin.Layouts.layout')

@section('meta_title', 'Add Department | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Add New Department</h2>
                <p class="mb-0">Fill in the details to create a new department record</p>
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
                        <div class="row g-3">
                            {{-- Department Name --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="department_name" 
                                           name="department_name" placeholder=" " required
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
                                    <select class="form-select rounded-3" id="head_name" name="head_name" required
                                            style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <option value="" selected disabled>Select Department Head</option>
                                        <option value="Dr. Sanjay Verma">Dr. Sanjay Verma</option>
                                        <option value="Dr. Priya Sharma">Dr. Priya Sharma</option>
                                        <option value="Prof. Rajesh Kumar">Prof. Rajesh Kumar</option>
                                    </select>
                                    <label for="head_name" style="color: #6267ae;">Department Head Name*</label>
                                    @error('head_name')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone Number --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control rounded-3" id="phone" 
                                           name="phone" placeholder=" " required
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="phone" style="color: #6267ae;">Phone Number*</label>
                                    @error('phone')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email Address --}}
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control rounded-3" id="email" 
                                           name="email" placeholder=" " required
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="email" style="color: #6267ae;">Email Address*</label>
                                    @error('email')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-3" id="description" name="description" 
                                              rows="3" placeholder=" " style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;"></textarea>
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
                                <i class="mdi mdi-content-save me-2"></i> Save Department
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
<!-- No Dropify script needed as there's no file input -->
@endsection