{{-- @include('Admin.Includes.header')
@include('Admin.Includes.navbar')
@include('Admin.Includes.sidebar')

@yield('content')

@include('Admin.Includes.footer')
@include('Admin.Includes.js-files')

@yield('script') --}}

@include('Admin.Includes.header')
<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>
<input type="hidden" value="{{url('/')}}" id="base_url"/>      
<div id="wrapper">
        @include('Admin.Includes.navbar')
        @yield('content')
    </div>
    @include('Admin.Includes.footer')
</body>
</html>
