<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Construction Inventory | Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('package_assets/images/construction_inventory.png')}}">

    <!-- third party css -->
    <link href="{{URL::asset('package_assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('package_assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('package_assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('package_assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link rel="stylesheet" href="{{URL::asset('package_assets/css/app.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('package_assets/css/style.css')}}"/>

    <!-- icons -->
    <link rel="stylesheet" href="{{URL::asset('package_assets/css/icons.min.css')}}" />

    <!-- Toastr Css -->
    <link rel="stylesheet" href="{{URL::asset('package_assets/libs/toastr/build/toastr.min.css')}}" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">
    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <a href="">
                            <img src="{{URL::asset('package_assets/images/construction_inventory.png')}}" alt="" height="25" class="mx-auto">
                        </a>
                        <p class="text-muted mt-2 mb-2">Constuction Inventory</p>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Forgot Password</h4>
                                <p class="mb-40px">Enter the email associated with your account and we'll send OTP to reset your password</p>
                            </div>

                            <form action="{{ route('forget.password.post') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email">
                                    @if($errors->has('email'))
                                        <span class="text-danger"><b>* {{$errors->first('email')}}</b></span>
                                    @endif
                                </div>

                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" type="submit"> Send Link </button>
                                </div>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor -->
    <script src="{{ URL::asset('package_assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('package_assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('package_assets/js/app.min.js') }}"></script>

    <!-- Toaster Js -->
    <script src="{{ URL::asset('package_assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- Custom Js -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }  

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif 
    </script>

</body>
</html>