@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="header-title ">General Settings</h4>
                    </div>
                </div>


                <div class="col-6">
                    <div class="card department-card">
                        <div class="card-body">
                            <div class="mb-3 justify-content-between d-flex align-items-center">
                                <h4 class="header-title ">Add Contact Details</h4>
                            </div>
                            <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" value="{{!empty($general_settings->email) ? $general_settings->email : ''}}" style="text-transform:lowercase">
                                        @if($errors->has('email'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="mobile" class="form-label">Mobile No.</label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{{!empty($general_settings->mobile) ? $general_settings->mobile : ''}}">
                                        @if($errors->has('mobile'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('mobile')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{!empty($general_settings->address) ? $general_settings->address : ''}}">
                                        @if($errors->has('address'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('address')}}</span>
                                        @endif
                                    </div>
                                </div>


                                <button type="submit" name="contact_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                                @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card department-card">
                        <div class="card-body">
                            <div class="mb-3 justify-content-between d-flex align-items-center">
                                <h4 class="header-title ">Add Social Media Details</h4>
                            </div>
                            <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="facebook_url" class="form-label">Facebook Url</label>
                                        <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook URL" value="{{!empty($general_settings->facebook_url) ? $general_settings->facebook_url : ''}}">
                                        @if($errors->has('facebook_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('facebook_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="linkedin_url" class="form-label">LinkedIn Url</label>
                                        <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="LinkedIn URL" value="{{!empty($general_settings->linkedin_url) ? $general_settings->linkedin_url : ''}}">
                                        @if($errors->has('linkedin_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('linkedin_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="instagram_url" class="form-label">Instagram Url</label>
                                        <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Instagram URL" value="{{!empty($general_settings->instagram_url) ? $general_settings->instagram_url : ''}}">
                                        @if($errors->has('instagram_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('instagram_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="twitter_url" class="form-label">Twitter Url</label>
                                        <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="Twitter URL" value="{{!empty($general_settings->twitter_url) ? $general_settings->twitter_url : ''}}">
                                        @if($errors->has('twitter_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('twitter_url')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-12">
                                        <label for="skype_url" class="form-label">Skype Url</label>
                                        <input type="text" class="form-control" name="skype_url" id="skype_url" placeholder="Skype URL" value="{{!empty($general_settings->skype_url) ? $general_settings->skype_url : ''}}">
                                        @if($errors->has('skype_url'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('skype_url')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" name="social_media_settings" id="submit_btn" class="btn btn-success"> {{ !empty($general_settings) ? 'Update' : 'Submit' }} </button>
                                @if(empty($general_settings)) <button type="reset" class="btn btn-danger"> Cancel </button> @endif
                            </form>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $(".setting").addClass("menuitem-active");
        $(".general-setting").addClass("menuitem-active");
    </script>
    @endsection