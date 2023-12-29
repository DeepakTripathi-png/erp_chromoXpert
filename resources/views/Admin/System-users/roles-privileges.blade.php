@section('meta_title') Roles & Privileges | Construction Inventory @endsection
@extends('Admin.Layouts.layout')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Roles & Privileges</h4>
                        <a href="{{ url('admin/roles-privileges/add') }}" class="btn btn-success waves-effect waves-light add-btn" ><span class="btn-label"> <i class="fas fa-plus "></i></span>Add</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive department-card">
                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th max-width="10%">Sr. No.</th>
                                        <th max-width="15%">Name</th>
                                        <th max-width="45%">Privileges</th>
                                        <th max-width="10%">Status</th>
                                        <th max-width="10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div> 
</div>
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_roles_previllages.js')}}"></script>
@endsection