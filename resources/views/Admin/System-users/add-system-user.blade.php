@section('meta_title') Add System User | Construction Inventory @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Add System User</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">
                            <form action="{{ route('system-user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($system_user) ? $system_user->id : '' }}">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="mb-2 col-6">
                                                <label for="role" class="form-label"> Role </label>
                                                <select class="form-select" id="role" name="role">
                                                    <option value="">Select Role</option>
                                                    @if(!empty($all_roles))
                                                    @foreach($all_roles as $role)
                                                    <option value="{{ $role->id }}" {{ !empty($system_user->role_id) && ($system_user->role_id == $role->id) ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                @if($errors->has('role'))
                                                <span class="text-danger"><b>* {{$errors->first('role')}}</b></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-2 col-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ !empty($system_user) ? $system_user->user_name : old('name') }}">
                                                @if($errors->has('name'))
                                                <span class="text-danger"><b>* {{$errors->first('name')}}</b></span>
                                                @endif
                                            </div>
                                            <div class="mb-2 col-6">
                                                <label for="mobile_no" class="form-label">Mobile</label>
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ !empty($system_user) ? $system_user->mobile_no : old('mobile_no') }}">
                                                @if($errors->has('mobile_no'))
                                                <span class="text-danger"><b>* {{$errors->first('mobile_no')}}</b></span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="row">
                                        <div class="mb-2 col-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{ !empty($system_user) ? $system_user->email : old('email') }}">
                                                <span class="text-danger d-none" id="email_existence_message"></span>
                                                @if($errors->has('email'))
                                                <span class="text-danger"><b>* {{$errors->first('email')}}</b></span>
                                                @endif
                                            </div>
                                            @if(empty($system_user->id))
                                            <div class="mb-2 col-6">
                                                <label for="password" class="form-label"> Password </label>
                                                <input type="text" class="form-control" id="password" name="password">
                                                @if($errors->has('password'))
                                                <span class="text-danger"><b>* {{$errors->first('password')}}</b></span>
                                                @endif
                                            </div>
                                            @endif
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea type="text" class="form-control" id="address" name="address" value="{{ !empty($system_user) ? $system_user->address : old('address') }}"></textarea>
                                            @if($errors->has('address'))
                                            <span class="text-danger"><b>* {{$errors->first('address')}}</b></span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-3 add-ticket-image-upload">
                                        <div class="mt-3">
                                            <input type="file" data-plugins="dropify" name="user_profile_image_path" size="40" accept="image/*" data-default-file="{{ !empty($system_user->user_profile_image_path) && Storage::exists($system_user->user_profile_image_path) ? url('/').Storage::url($system_user->user_profile_image_path) : '' }}" />
                                            <p class="text-center mt-2 mb-0"> Profile Image </p>
                                            @if($errors->has('user_profile_image_path'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('user_profile_image_path')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                @if(empty($system_user)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".system-user").addClass("menuitem-active");
    $(".system-user-list").addClass("menuitem-active");
</script>

<script>
    $(document).ready(function() {
        $("#email").on("keyup", function() {
            $.ajax({
                type: "get",
                url: "{{ url('/admin/system-user/check-user-exist') }}",
                data: {
                    email: $(this).val(),
                    user_id: $("#id").val()
                },
                success: function(response) {
                    if (response.trim() == "true") {
                        $("#submit-btn").attr("disabled", true);
                        $("#email_existence_message").removeClass("d-none");
                        $("#email_existence_message").html("<b>*</b> This Email has already been taken");
                    } else {
                        $("#email_existence_message").addClass("d-none");
                        $("#email_existence_message").html("");
                        $("#submit-btn").removeAttr("disabled");
                    }
                }
            })
        })
    })
</script>
@endsection