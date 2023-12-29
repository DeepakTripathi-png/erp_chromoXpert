@section('meta_title') Add Roles & Privileges | Construction Inventory @endsection
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
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('roles-previllages.store') }}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($role_privileges) ? $role_privileges->id : '' }}">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="mb-2">
                                            <label for="role_name" class="form-label"> Role Name </label>
                                            <input type="text" name="role_name" id="role_name" class="form-control" value="{{ !empty($role_privileges->role_name) ? $role_privileges->role_name : old('role_name') }}">
                                            <span class="text-danger d-none" id="role_existence_message"></span>
                                            @if($errors->has('role_name'))
                                                <span class="text-danger"><b>* {{$errors->first('role_name')}}</b></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label> Privileges </label>
                                        @if($errors->has('privileges'))
                                            <span class="text-danger"><b>* {{$errors->first('privileges')}}</b></span>
                                        @endif
                                        <label style="float:right;"><span style="padding-right:5px;">Select All</span>
                                            <input value="select_all" id="select_all" class="select_all" type="checkbox">
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <table class="table color-table info-table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10%" class="text-center">Sr. No.</th>
                                                    <th width="30%">Pages</th>
                                                    <th width="10%" class="text-center">View</th>
                                                    <th width="10%" class="text-center">Add</th>
                                                    <th width="10%" class="text-center">Edit</th>
                                                    <th width="10%" class="text-center">Delete</th>
                                                    <th width="10%" class="text-center">Active/Inactive</th>
                                                    <th width="10%" class="text-center">Other</th>
                                                </tr>
                                            </thead>

                                            <tbody id="role-privileges-table">
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Select All</td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-view"></td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-add"></td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-edit"></td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-delete"></td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-status"></td>
                                                    <td class="text-center"><input type="checkbox" class="ccheckbox all-other"></td>
                                                </tr>
                                                <!-- dashboard -->
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>Dashboard</td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dashboard_view" class="ccheckbox view" value="dashboard_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dashboard_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Master -->
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td> Master </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="master_view" class="ccheckbox view" value="master_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'master_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Site Master -->
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td> Master >> Site </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_view" class="ccheckbox view" value="site_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_add" class="ccheckbox add" value="site_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_edit" class="ccheckbox edit" value="site_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_delete" class="ccheckbox deletes" value="site_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_status" class="ccheckbox status" value="site_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Department Master -->
                                                <tr>
                                                    <td class="text-center">5</td>
                                                    <td> Master >> Department </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="department_view" class="ccheckbox view" value="department_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'department_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="department_add" class="ccheckbox add" value="department_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'department_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="department_edit" class="ccheckbox edit" value="department_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'department_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="department_delete" class="ccheckbox deletes" value="department_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'department_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="department_status" class="ccheckbox status" value="department_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'department_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Designation Master -->
                                                <tr>
                                                    <td class="text-center">6</td>
                                                    <td> Master >> Designation </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="designation_view" class="ccheckbox view" value="designation_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'designation_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="designation_add" class="ccheckbox add" value="designation_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'designation_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="designation_edit" class="ccheckbox edit" value="designation_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'designation_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="designation_delete" class="ccheckbox deletes" value="designation_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'designation_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="designation_status" class="ccheckbox status" value="designation_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'designation_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Category Master -->
                                                <tr>
                                                    <td class="text-center">7</td>
                                                    <td> Master >> Category </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="category_view" class="ccheckbox view" value="category_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'category_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="category_add" class="ccheckbox add" value="category_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'category_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="category_edit" class="ccheckbox edit" value="category_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'category_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="category_delete" class="ccheckbox deletes" value="category_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'category_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="category_status" class="ccheckbox status" value="category_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'category_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Sub Category Master -->
                                                <tr>
                                                    <td class="text-center">8</td>
                                                    <td> Master >> Sub Category </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="sub_categories_view" class="ccheckbox view" value="sub_categories_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'sub_categories_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="sub_categories_add" class="ccheckbox add" value="sub_categories_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'sub_categories_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="sub_categories_edit" class="ccheckbox edit" value="sub_categories_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'sub_categories_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="sub_categories_delete" class="ccheckbox deletes" value="sub_categories_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'sub_categories_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="sub_categories_status" class="ccheckbox status" value="sub_categories_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'sub_categories_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Unit Master -->
                                                <tr>
                                                    <td class="text-center">9</td>
                                                    <td> Master >> Unit </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="unit_view" class="ccheckbox view" value="unit_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'unit_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="unit_add" class="ccheckbox add" value="unit_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'unit_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="unit_edit" class="ccheckbox edit" value="unit_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'unit_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="unit_delete" class="ccheckbox deletes" value="unit_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'unit_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="unit_status" class="ccheckbox status" value="unit_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'unit_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Item Master -->
                                                <tr>
                                                    <td class="text-center">10</td>
                                                    <td> Master >> Item </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_view" class="ccheckbox view" value="item_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_add" class="ccheckbox add" value="item_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_edit" class="ccheckbox edit" value="item_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_delete" class="ccheckbox deletes" value="item_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_status" class="ccheckbox status" value="item_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Document Categories Master -->
                                                <tr>
                                                    <td class="text-center">11</td>
                                                    <td> Master >> Document Categories </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_category_view" class="ccheckbox view" value="document_category_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_category_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_category_add" class="ccheckbox add" value="document_category_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_category_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_category_edit" class="ccheckbox edit" value="document_category_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_category_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_category_delete" class="ccheckbox deletes" value="document_category_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_category_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_category_status" class="ccheckbox status" value="document_category_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_category_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Document Sub Categories Master -->
                                                <tr>
                                                    <td class="text-center">11</td>
                                                    <td> Master >> Document Sub Categories </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_sub_categories_view" class="ccheckbox view" value="document_sub_categories_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_sub_categories_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_sub_categories_add" class="ccheckbox add" value="document_sub_categories_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_sub_categories_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_sub_categories_edit" class="ccheckbox edit" value="document_sub_categories_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_sub_categories_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_sub_categories_delete" class="ccheckbox deletes" value="document_sub_categories_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_sub_categories_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="document_sub_categories_status" class="ccheckbox status" value="document_sub_categories_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'document_sub_categories_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Warehouse Master -->
                                                <tr>
                                                    <td class="text-center">12</td>
                                                    <td> Master >> Warehouse </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="warehouse_view" class="ccheckbox view" value="warehouse_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'warehouse_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="warehouse_add" class="ccheckbox add" value="warehouse_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'warehouse_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="warehouse_edit" class="ccheckbox edit" value="warehouse_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'warehouse_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="warehouse_delete" class="ccheckbox deletes" value="warehouse_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'warehouse_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="warehouse_status" class="ccheckbox status" value="warehouse_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'warehouse_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Configuration Master -->
                                                <tr>
                                                    <td class="text-center">13</td>
                                                    <td> Master >> Configuration </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="configuration_view" class="ccheckbox view" value="configuration_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'configuration_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="configuration_add" class="ccheckbox add" value="configuration_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'configuration_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="configuration_edit" class="ccheckbox edit" value="configuration_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'configuration_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="configuration_delete" class="ccheckbox deletes" value="configuration_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'configuration_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="configuration_status" class="ccheckbox status" value="configuration_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'configuration_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Employee Master -->
                                                <tr>
                                                    <td class="text-center">14</td>
                                                    <td> Master >> Employee </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_view" class="ccheckbox view" value="employee_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_add" class="ccheckbox add" value="employee_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_edit" class="ccheckbox edit" value="employee_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_delete" class="ccheckbox deletes" value="employee_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_status" class="ccheckbox status" value="employee_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="employee_other" class="ccheckbox other" value="employee_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'employee_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Vendor -->
                                                <tr>
                                                    <td class="text-center">15</td>
                                                    <td> Vendor </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="vendor_view" class="ccheckbox view" value="vendor_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'vendor_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="vendor_add" class="ccheckbox add" value="vendor_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'vendor_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="vendor_edit" class="ccheckbox edit" value="vendor_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'vendor_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="vendor_delete" class="ccheckbox deletes" value="vendor_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'vendor_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="vendor_status" class="ccheckbox status" value="vendor_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'vendor_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Main Inventory -->
                                                <tr>
                                                    <td class="text-center">16</td>
                                                    <td> Main Inventory </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_view" class="ccheckbox view" value="main_inventory_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_add" class="ccheckbox add" value="main_inventory_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_edit" class="ccheckbox edit" value="main_inventory_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_delete" class="ccheckbox deletes" value="main_inventory_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_status" class="ccheckbox status" value="main_inventory_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="main_inventory_other" class="ccheckbox other" value="main_inventory_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'main_inventory_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Site Inventory -->
                                                <tr>
                                                    <td class="text-center">17</td>
                                                    <td> Site Inventory </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_inventory_view" class="ccheckbox view" value="site_inventory_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_inventory_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="site_inventory_other" class="ccheckbox other" value="site_inventory_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'site_inventory_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Item Requisition -->
                                                <tr>
                                                    <td class="text-center">18</td>
                                                    <td> Item Requisition </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_requisition_view" class="ccheckbox view" value="item_requisition_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_requisition_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_requisition_add" class="ccheckbox add" value="item_requisition_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_requisition_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_requisition_edit" class="ccheckbox edit" value="item_requisition_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_requisition_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="item_requisition_delete" class="ccheckbox deletes" value="item_requisition_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'item_requisition_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Utilized Item -->
                                                <tr>
                                                    <td class="text-center">17</td>
                                                    <td> Utilized Item </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_view" class="ccheckbox view" value="utilized_item_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_add" class="ccheckbox add" value="utilized_item_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_edit" class="ccheckbox edit" value="utilized_item_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_delete" class="ccheckbox deletes" value="utilized_item_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_status" class="ccheckbox status" value="utilized_item_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="utilized_item_other" class="ccheckbox other" value="utilized_item_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'utilized_item_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- All Documents -->
                                                <tr>
                                                    <td class="text-center">19</td>
                                                    <td> All Documents </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="all_document_view" class="ccheckbox view" value="all_document_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'all_document_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="all_document_add" class="ccheckbox add" value="all_document_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'all_document_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="all_document_edit" class="ccheckbox edit" value="all_document_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'all_document_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="all_document_delete" class="ccheckbox deletes" value="all_document_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'all_document_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Support Ticket -->
                                                <tr>
                                                    <td class="text-center">20</td>
                                                    <td> Support Ticket </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="support_ticket_view" class="ccheckbox view" value="support_ticket_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'support_ticket_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="support_ticket_add" class="ccheckbox add" value="support_ticket_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'support_ticket_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="support_ticket_edit" class="ccheckbox edit" value="support_ticket_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'support_ticket_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- DPR -->
                                                <tr>
                                                    <td class="text-center">21</td>
                                                    <td> DPR (Daily Progress Report) </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_view" class="ccheckbox view" value="dpr_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_add" class="ccheckbox add" value="dpr_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_edit" class="ccheckbox edit" value="dpr_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_delete" class="ccheckbox deletes" value="dpr_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_status" class="ccheckbox status" value="dpr_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="dpr_other" class="ccheckbox other" value="dpr_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'dpr_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Attendance -->
                                                <tr>
                                                    <td class="text-center">22</td>
                                                    <td> Attendance </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_view" class="ccheckbox view" value="attendance_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_add" class="ccheckbox add" value="attendance_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_edit" class="ccheckbox edit" value="attendance_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_delete" class="ccheckbox deletes" value="attendance_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_status" class="ccheckbox status" value="attendance_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="attendance_other" class="ccheckbox other" value="attendance_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'attendance_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Training -->
                                                <tr>
                                                    <td class="text-center">23</td>
                                                    <td> Training </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_view" class="ccheckbox view" value="training_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_add" class="ccheckbox add" value="training_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_edit" class="ccheckbox edit" value="training_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_delete" class="ccheckbox deletes" value="training_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_status" class="ccheckbox status" value="training_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="training_other" class="ccheckbox other" value="training_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'training_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- Report -->
                                                <tr>
                                                    <td class="text-center">24</td>
                                                    <td> Report </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_view" class="ccheckbox view" value="report_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_add" class="ccheckbox add" value="report_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_edit" class="ccheckbox edit" value="report_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_delete" class="ccheckbox deletes" value="report_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_status" class="ccheckbox status" value="report_status" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_status') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="report_other" class="ccheckbox other" value="report_other" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'report_other') ? 'checked' : '' }}></td>
                                                </tr>
                                                <!-- System User -->
                                                <tr>
                                                    <td class="text-center">25</td>
                                                    <td>System User </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="system_users_view"  class="ccheckbox view" value="system_users_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'system_users_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- User List -->
                                                <tr>
                                                    <td class="text-center">26</td>
                                                    <td>System User >> User List </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="user_view" class="ccheckbox view" value="user_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'user_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="user_add" class="ccheckbox add" value="user_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'user_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="user_edit" class="ccheckbox edit" value="user_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'user_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="user_delete" class="ccheckbox deletes" value="user_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'user_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="user_status_change" class="ccheckbox status" value="user_status_change" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'user_status_change') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Role Privileges -->
                                                <tr>
                                                    <td class="text-center">27</td>
                                                    <td>System User >> Role & Privileges </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="role_privileges_view" class="ccheckbox view" value="role_privileges_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'role_privileges_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="role_privileges_add" class="ccheckbox add" value="role_privileges_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'role_privileges_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="role_privileges_edit" class="ccheckbox edit" value="role_privileges_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'role_privileges_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="role_privileges_delete" class="ccheckbox deletes" value="role_privileges_delete" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'role_privileges_delete') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="role_privileges_status_change" class="ccheckbox status" value="role_privileges_status_change" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'role_privileges_status_change') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- Settings -->
                                                <tr>
                                                    <td class="text-center">28</td>
                                                    <td>Settings </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="settings_view"  class="ccheckbox view" value="settings_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'settings_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- General Setting -->
                                                <tr>
                                                    <td class="text-center">29</td>
                                                    <td> Settings >> General Settings </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="general_setting_view" class="ccheckbox view" value="general_setting_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'general_setting_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="general_setting_add" class="ccheckbox add" value="general_setting_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'general_setting_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="general_setting_edit" class="ccheckbox edit" value="general_setting_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'general_setting_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <!-- visual Setting -->
                                                <tr>
                                                    <td class="text-center">30</td>
                                                    <td> Settings >> Visual Settings </td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="visual_setting_view" class="ccheckbox view" value="visual_setting_view" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'visual_setting_view') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="visual_setting_add" class="ccheckbox add" value="visual_setting_add" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'visual_setting_add') ? 'checked' : '' }}></td>
                                                    <td class="text-center"><input type="checkbox" name="privileges[]" id="visual_setting_edit" class="ccheckbox edit" value="visual_setting_edit" {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges,'visual_setting_edit') ? 'checked' : '' }}></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit" id="submit-btn"> {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
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
    $(".role-privileges").addClass("menuitem-active");
</script>

<script>
    $(document).ready(function(){
        $('#role-privileges-table tr').each(function(index) {
            $(this).find('td:first').html(index+1);
        });
    })
</script>

<script>
    $(document).ready(function(){
        $("#role_name").on("keyup", function(){
            $.ajax({
                type: "get",
                url: "{{ url('/admin/roles-privileges/check-role-exist') }}",
                data: {
                    role_name: $(this).val(),
                    role_id: $("#id").val()
                },
                success: function(response){
                    if(response.trim() == "true"){
                        $("#submit-btn").attr("disabled", true);
                        $("#role_existence_message").removeClass("d-none");
                        $("#role_existence_message").html("<b>*</b> This Role has already been taken");
                    } else {
                        $("#role_existence_message").addClass("d-none");
                        $("#role_existence_message").html("");
                        $("#submit-btn").removeAttr("disabled");
                    }
                }
            })
        })
    })
</script>

<script>
    // all view select
    $('.all-view').on('change', function(){
        if($('.all-view').is(":checked")){
            $('.view').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.view').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.view').on('change', function(){
        $('.view').each(function(){
            if($(this).is(":checked")){
                $('.all-view').prop('checked',true);
            }else{
                $('.all-view').prop('checked',false);
                return false;
            }
        })
    })

    // all add select
    $('.all-add').on('change', function(){
        if($('.all-add').is(":checked")){
            $('.add').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.add').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.add').on('change', function(){
        $('.add').each(function(){
            if($(this).is(":checked")){
                $('.all-add').prop('checked',true);
            }else{
                $('.all-add').prop('checked',false);
                return false;
            }
        })
    })

    // all edit select
    $('.all-edit').on('change', function(){
        if($('.all-edit').is(":checked")){
            $('.edit').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.edit').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.edit').on('change', function(){
        $('.edit').each(function(){
            if($(this).is(":checked")){
                $('.all-edit').prop('checked',true);
            }else{
                $('.all-edit').prop('checked',false);
                return false;
            }
        })
    })

    // all deletes select
    $('.all-delete').on('change', function(){
        if($('.all-delete').is(":checked")){
            $('.deletes').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.deletes').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.delete-privilege').on('change', function(){
        $('.delete-privilege').each(function(){
            if($(this).is(":checked")){
                $('.all-delete').prop('checked',true);
            }else{
                $('.all-delete').prop('checked',false);
                return false;
            }
        })
    })

    // all status select
    $('.all-status').on('change', function(){
        if($('.all-status').is(":checked")){
            $('.status').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.status').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.status').on('change', function(){
        $('.status').each(function(){
            if($(this).is(":checked")){
                $('.all-status').prop('checked',true);
            }else{
                $('.all-status').prop('checked',false);
                return false;
            }
        })
    })

    // all other select
    $('.all-other').on('change', function(){
        if($('.all-other').is(":checked")){
            $('.other').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.other').each(function(){
                $(this).prop('checked',false);
            });
        }
    })

    $('.other').on('change', function(){
        $('.other').each(function(){
            if($(this).is(":checked")){
                $('.all-other').prop('checked',true);
            }else{
                $('.all-other').prop('checked',false);
                return false;
            }
        })
    })

    // Select All
    $('.select_all').on('change', function(){
        if($('.select_all').is(":checked")){
            $('.ccheckbox').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.ccheckbox').each(function(){
                $(this).prop('checked',false);
            });
        }
    })
</script>

@endsection