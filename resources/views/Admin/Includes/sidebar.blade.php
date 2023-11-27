	@php
		$role_id = Auth::guard('master_admins')->user()->role_id;
		$RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
	@endphp
	
	<aside class="main-sidebar scrollbar" id="style-7">
		<section class="sidebar">
			<ul class="sidebar-menu" data-widget="tree">
				<!-- Dashboard start-->
				@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'dashboard_view'))
				<li class="s_meun dashboard_active ">
					<a href="{{url('admin/dashboard')}}">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
					</a>
				</li>
				@endif

				<!-- CMS (CONTENT MANAGEMENT SYSTEM) -->
				@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view'))
				<li class="treeview s_meun master_active ">
					<a href="javascript:;">
						<i class="fa fa-newspaper-o" aria-hidden="true"></i><span>CMS</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'category_view'))
					<ul class="treeview-menu">
						<li class="s_meun master_category_active"><a href="{{url('/admin/category')}}"><i class="fa fa-list-alt" aria-hidden="true"></i><span>Homepage</span></a></li>
					</ul>
					@endif
				</li>
				@endif

				<!-- Master start-->
				@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'master_view'))
				<li class="s_meun master_active ">
					<a href="{{url('admin/master')}}">
						<i class="fa fa-user"></i> <span>Master</span>
					</a>
				</li>
				@endif

				<!--System User start-->
				@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'system_user_view'))
				<li class="treeview s_meun system_user_active ">
					<a href="javascript:;">
						<i class="fa fa-users" aria-hidden="true"></i> <span>System User</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_view'))
							<li class="s_meun user_list_active"><a href="{{url('admin/system-user-list')}}"><i class="fa fa-envelope"></i>User List</a></li>
						@endif
						@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view'))
							<li class="s_meun roles_privileges_active"><a href="{{url('/admin/roles-privileges')}}"><i class="fa fa-bars"></i>Roles & Privileges</a></li>
						@endif
					</ul>
				</li>
				@endif
				<!--System User end-->

				<!--Settings start-->
				<li class="treeview s_meun settings_active ">
					<a href="javascript:;">
						<i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'general_setting_view'))
							<li class="s_meun general_settings_active"><a href="{{url('admin/general-settings-contact')}}"><i class="fa fa-bars"></i>General Settings</a></li>
						@endif
						@if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'visual_setting_view'))
							<li class="s_meun visual_settings_active"><a href="{{url('admin/visual-settings')}}"><i class="fa fa-eye"></i>Visual Settings</a></li>
						@endif
						<li class="s_meun change_password_active"><a href="{{url('admin/change-password')}}"><i class="fa fa-key"></i>Change Password</a></li>
						<li class="s_meun logout_active"><a href="{{url('admin/logout')}}"><i class="fa fa-power-off"></i>Logout</a></li>
					</ul>
				</li>
				<!--Settings end-->
			</ul>
		</section>
	</aside>