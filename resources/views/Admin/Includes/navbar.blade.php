<style>
    #sidebar-menu #side-menu li a{
    display: flex !important;
}
#sidebar-menu>ul>li>a i {
    line-height:unset;
}
 </style>
{{-- statrt Topbar --}}
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        {{-- <li class="d-none d-lg-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-home me-1"></i>
                            <span>Analytics Report</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-aperture me-1"></i>
                            <span>How can I help you?</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>User profile settings</span>
                        </a>
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                        </div>
                        <div class="notification-list">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{URL::asset('package_assets/images/users/user-2.jpg')}}" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                        <span class="font-12 mb-0">UI Designer</span>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{URL::asset('package_assets/images/users/user-5.jpg')}}" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                        <span class="font-12 mb-0">Developer</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </li> --}}

        {{-- <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li> --}}

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
            </a>
            {{-- <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="#" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                        <div class="notify-icon">
                            <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Cristina Pride</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Hi, How are you? What about our next meeting</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Karen Robinson</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Wow ! this admin looks good and awesome design</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <p class="notify-details">New user registered.
                            <small class="text-muted">5 hours ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">4 days ago</small>
                        </p>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-secondary">
                            <i class="mdi mdi-heart"></i>
                        </div>
                        <p class="notify-details">Carlos Crouch liked
                            <b>Admin</b>
                            <small class="text-muted">13 days ago</small>
                        </p>
                    </a>
                </div>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    View all
                    <i class="fe-arrow-right"></i>
                </a>

            </div> --}}
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ !empty(Auth::guard('master_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('master_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('master_admins')->user()->user_profile_image_path) : URL::asset('package_assets/images/default-images/profile-image.png')}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1"> {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }} <i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }}!</h6>
                    <div class="text-center mt-1" style="background-color: #f3f9ff;"><span>{{ App\Helpers\Helpers\Helper::getRoleName() }}</span></div>
                </div>

                <a href="Javascript:;" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>

                {{-- <a href="javascript:;" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Lock Screen</span>
                </a> --}}

                <div class="dropdown-divider"></div>

                <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
    </ul>

    <div class="logo-box">
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{URL::asset('package_assets/images/construction_inventory.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{URL::asset('package_assets/images/construction_inventory.png')}}" alt="" height="16">
            </span>
        </a>
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{URL::asset('package_assets/images/construction_inventory.png')}}" alt="" height="22">

            </span>
            <span class="logo-lg text-dark fs-4">
                <img src="{{URL::asset('package_assets/images/construction_inventory.png')}}" alt="" height="35">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>

</div>
<!-- end Topbar -->

<!-- ========== Left Sidebar Start ========== -->
@php
$role_id = Auth::guard('master_admins')->user()->role_id;
$RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
@endphp
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'dashboard_view'))
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @endif

                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'master_view'))
                <li class="master">
                    <a href="#master" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Master </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="master">
                        <ul class="nav-second-level">
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_view'))
                            <li class="site-master">
                                <a href="{{ url('admin/master/site') }}">Site Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'department_view'))
                            <li class="department-master">
                                <a href="{{ url('admin/master/department') }}">Department Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'designation_view'))
                            <li class="designation-master">
                                <a href="{{ url('admin/master/designation') }}">Designation Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_view'))
                            <li class="category-master">
                                <a href="{{ url('admin/master/category') }}">Item Category Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'sub_categories_view'))
                            <li class="sub-category-master">
                                <a href="{{ url('admin/master/sub-category') }}">Item Sub Category Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'unit_view'))
                            <li class="unit-master">
                                <a href="{{ url('admin/master/unit') }}">Unit Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'item_view'))
                            <li class="item-master">
                                <a href="{{ url('admin/master/item') }}">Item Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'document_category_view'))
                            <li class="document-category-master">
                                <a href="{{ url('admin/master/document-category') }}">Document Category Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'document_sub_categories_view'))
                            <li class="document-sub-category-master">
                                <a href="{{ url('admin/master/document-sub-category') }}">Document Sub Category Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'warehouse_view'))
                            <li class="warehouse-master">
                                <a href="{{ url('admin/master/warehouse') }}">Warehouse Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'configuration_view'))
                            <li class="configuration-master">
                                <a href="{{ url('admin/master/configuration') }}">Configuration Master</a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'employee_view'))
                            <li class="employee">
                                <a href="{{ url('admin/master/employee') }}">Employee</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'vendor_view'))
                <li class="vendor">
                    <a href="{{ url('admin/vendor') }}">
                        <i class="mdi mdi-account"></i>
                        <span> Vendor </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'main_inventory_view'))
                <li class="main-inventory">
                    <a href="{{ url('admin/inventory/main') }}">
                        <i class="mdi mdi-clipboard-list"></i>
                        <span> Main Inventory </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_inventory_view'))
                <li class ="site-inventory">
                    <a href="{{ url('admin/inventory/site') }}">
                        <i class="mdi mdi-clipboard-list"></i>
                        <span> Site Inventory </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'item_requisition_view'))
                <li class="item-requisition">
                    <a href="{{ url('admin/requisitions/pending') }}">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        <span> Item Requisition </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'utilized_item_view'))
                <li class="utilized-item">
                    <a href="{{ url('admin/utilized-item') }}">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        <span> Utilized Item </span>
                    </a>
                </li>

                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'all_document_view'))
                <li class="documents">
                    <a href="{{ url('admin/document') }}">
                        <i class="mdi mdi-file-document"></i>
                        <span>Documents </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'support_ticket_view'))
                <li class="support-ticket">
                    <a href="{{ url('admin/support-tickets/pending') }}">
                        <i class="mdi mdi-ticket-confirmation"></i>
                        <span>Support Ticket </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'dpr_view'))
                <li class="dpr">
                    <a href="{{ url('admin/dpr') }}" class="d-flex">
                        <i class="mdi mdi-file-document-edit"></i>
                        <span> DPR (Daily Progress Report) </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'attendance_view'))
                <li class="attendance">
                    <a href="{{ url('admin/attendance') }}">
                        <i class="mdi mdi-account-check"></i>
                        <span>Attendance</span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'training_view'))
                <li class="training">
                    <a href="{{ url('admin/training') }}">
                        <i class="mdi mdi-briefcase-variant-outline"></i>
                        <span>Training</span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_view'))
                <li>
                    <a href="#">
                        <i class="mdi mdi-clipboard-edit"></i>
                        <span> Reports </span>
                    </a>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'system_users_view'))
                <li class="system-user">
                    <a href="#system-user" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle"></i>
                        <span> System Users</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="system-user">
                        <ul class="nav-second-level">
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_view'))
                            <li class="system-user-list">
                                <a href="{{ url('admin/system-user') }}">
                                    <span> System Users </span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view'))
                            <li class="role-privileges">
                                <a href="{{ url('/admin/roles-privileges') }}">
                                    <span> Role Privileges </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'settings_view'))
                <li class="setting">
                    <a href="#setting" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="nav-second-level">
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_view'))
                            <li class="general-setting">
                                <a href="{{ url('/admin/general-setting') }}">
                                    <span> General Settings</span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'visual_setting_view'))
                            <li class="visual-setting">
                                <a href="{{ url('/admin/visual-setting') }}">
                                    <span> Visual Settings</span>
                                </a>
                            </li>
                            @endif
                            <li class="change-password">
                                <a href="{{ url('/admin/change-password') }}">
                                    <span> Change Password</span>
                                </a>
                            </li>
                            <li class="logout">
                                <a href="{{ url('admin/logout') }}">
                                    <span> Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>