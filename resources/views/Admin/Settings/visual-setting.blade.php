@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">Visual Settings</h4>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">
                            <form action="{{ route('visual.settings.store') }}" method="post" id="visual_settings_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ !empty($visual_settings->id) ? $visual_settings->id : '' }}">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mt-1">
                                            <input type="file" data-plugins="dropify" name="logo_image_path" size="40" accept="image/*" data-default-file="{{ !empty($visual_settings->logo_image_path) && Storage::exists($visual_settings->logo_image_path) ? url('/').Storage::url($visual_settings->logo_image_path) : '' }}" alt="{{ !empty($visual_settings->logo_image_name) ? $visual_settings->logo_image_name : '' }}" />
                                            <p class="text-center mt-2 mb-0">Full Logo ( logo with text )</p>
                                            @if($errors->has('logo_image_path'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('logo_image_path')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mt-1">
                                            <input type="file" data-plugins="dropify" name="mini_logo_image_path" size="40" accept="image/*" data-default-file="{{ !empty($visual_settings->mini_logo_image_path) && Storage::exists($visual_settings->mini_logo_image_path) ? url('/').Storage::url($visual_settings->mini_logo_image_path) : '' }}" alt="{{ !empty($visual_settings->mini_logo_image_path) ? $visual_settings->mini_logo_image_path : '' }}" />
                                            <p class="text-center mt-2 mb-0">Mini Logo ( logo without text )</p>
                                            @if($errors->has('mini_logo_image_path'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('mini_logo_image_path')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mt-1">
                                            <input type="file" data-plugins="dropify" name="favicon_image_path" size="40" accept="image/*" data-default-file="{{ !empty($visual_settings->favicon_image_path) && Storage::exists($visual_settings->favicon_image_path) ? url('/').Storage::url($visual_settings->favicon_image_path) : '' }}" alt="{{ !empty($visual_settings->favicon_image_path) ? $visual_settings->favicon_image_path : '' }}" />
                                            <p class="text-center mt-2 mb-0">Favicon Logo ( logo for browser tab )</p>
                                            @if($errors->has('favicon_image_path'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('favicon_image_path')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mt-1">
                                            <input type="file" data-plugins="dropify" name="logo_email_image_path" size="40" accept="image/*" data-default-file="{{ !empty($visual_settings->logo_email_image_path) && Storage::exists($visual_settings->logo_email_image_path) ? url('/').Storage::url($visual_settings->logo_email_image_path) : '' }}" alt="{{ !empty($visual_settings->logo_email_image_path) ? $visual_settings->logo_email_image_path : '' }}" />
                                            <p class="text-center mt-2 mb-0">Email Logo ( logo appear in mails )</p>
                                            @if($errors->has('logo_email_image_path'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('logo_email_image_path')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn  btn-success mt-4" type="submit"> {{ !empty($visual_settings) ? 'Update' : 'Submit' }} </button>
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
    $(".setting").addClass("menuitem-active");
    $(".visual-setting").addClass("menuitem-active");
</script>
@endsection