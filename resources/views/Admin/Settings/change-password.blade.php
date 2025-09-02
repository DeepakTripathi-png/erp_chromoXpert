@extends('Admin.Layouts.layout')

@section('meta_title', 'Change Password | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="row">
                <div class="col-12">
                    <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                         style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                        <h2 class="fw-bold mb-1">Change Password</h2>
                        <p class="mb-0">Update your account password</p>
                        <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                            <i class="mdi mdi-key"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg rounded-4" 
                         style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                        <div class="card-body p-4">
                            <form action="{{ url('/admin/change-password') }}" method="post" id="changePasswordForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ !empty($general_settings->id) ? $general_settings->id : '' }}">
                                
                                {{-- Old Password --}}
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" name="old_password" id="old_password" 
                                               class="form-control rounded-3" placeholder=" "
                                               style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <label for="old_password" style="color: #6267ae;">Old Password <i class="mdi mdi-information-outline ms-1" data-bs-toggle="tooltip" title="Enter your current password"></i></label>
                                        @if($errors->has('old_password'))
                                        <div class="text-danger mt-1"><i class="mdi mdi-alert-circle me-1"></i> {{ $errors->first('old_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- New Password --}}
                                <div class="mb-3">
                                    <div class="form-floating position-relative">
                                        <input type="password" name="new_password" id="new_password" 
                                               class="form-control rounded-3" placeholder=" "
                                               style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <label for="new_password" style="color: #6267ae;">New Password <i class="mdi mdi-information-outline ms-1" data-bs-toggle="tooltip" title="Enter your new password"></i></label>
                                        <span class="pass-show position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; color: #6267ae;">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </span>
                                        @if($errors->has('new_password'))
                                        <div class="text-danger mt-1"><i class="mdi mdi-alert-circle me-1"></i> {{ $errors->first('new_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Confirm Password --}}
                                <div class="mb-4">
                                    <div class="form-floating position-relative">
                                        <input type="password" name="confirm_password" id="confirm_password" 
                                               class="form-control rounded-3" placeholder=" "
                                               style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <label for="confirm_password" style="color: #6267ae;">Confirm Password <i class="mdi mdi-information-outline ms-1" data-bs-toggle="tooltip" title="Confirm your new password"></i></label>
                                        <span class="pass-show position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; color: #6267ae;">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </span>
                                        @if($errors->has('confirm_password'))
                                        <div class="text-danger mt-1"><i class="mdi mdi-alert-circle me-1"></i> {{ $errors->first('confirm_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                {{-- Buttons --}}
                                <div class="d-flex gap-2 mt-4 justify-content-end">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm px-4"
                                            style="background: #6267ae; color: #fff; border: none;">
                                        <i class="mdi mdi-content-save me-2"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary btn-lg rounded-pill shadow-sm px-4"
                                            style="background: #ac7fb6; color: #fff; border: none;">
                                        <i class="mdi mdi-refresh me-2"></i> Cancel
                                    </button>
                                </div>
                            </form>
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
    .form-floating>.form-control {
        height: calc(3.5rem + 2px);
        background: #fff;
        color: #6267ae;
        border: 1px solid #f6b51d;
    }
    .form-floating>label {
        color: #6267ae;
        font-weight: 500;
    }
    .form-control:focus {
        border-color: #f6b51d;
        box-shadow: 0 0 0 0.25rem rgba(246, 181, 29, 0.25);
    }
</style>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".setting").addClass("menuitem-active");
        $(".change-password").addClass("menuitem-active");

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Password show/hide functionality
        $(".pass-show").on('click', function() {
            var passwordInput = $(this).closest('.position-relative').find('input');
            var icon = $(this).find('i');

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("mdi-eye-outline").addClass("mdi-eye-off-outline");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("mdi-eye-off-outline").addClass("mdi-eye-outline");
            }
        });
    });
</script>
@endsection