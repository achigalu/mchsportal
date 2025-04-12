<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS | User - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Andy Chigalu" name="mchsportal" />
        <meta content="Andy Chigalu" name="Andy Chigalu" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <style>
        .auth-body-bg {
         background-image: url('assets/images/auth-bg1.jpg');
         }
        </style>
    

    </head>

    <body class="auth-body-bg">

        <div class="bg-overlay"></div>
        <div class="wrapper-page" style="width: 90%; max-width: 500px; margin: 7.5% auto;">
            <div class="container-fluid p-0">
                <div class="card" style="background-color:#d8e7f7;">
                    <div class="card-body">

                        <div class="text-center mt-0">
                            <div class="mb-1">
                                <a href="" class="auth-logo">
                                <img src="{{asset('assets/images/plogoLOGIN.jpg')}}" alt="logo-light" height="50" widith="50">
                                </a>
                            </div>
                        </div>
                        <div class="p-3">
@if(session()->has('status'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('status')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('invalid'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('invalid')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
                        @if($errors->get('login'))
                        <div class="alert alert-warning alert-dismissible fade show text-center mt-0" role="alert">
                                     <div style="color: #ed686f">
                                    <x-input-error :messages="$errors->get('login')" class="mt-2" />
                                    </div>
                        </div>
                        @endif
                            <form class="form-horizontal mt-0" method="POST" action="{{ route('login') }}">
                                 @csrf
    
                                <div class="form-group mb-1 row">
                                    <div class="col-12">
                                    <x-input-label for="login" :value="__('UserName or Email or Registration #')" />
                                        <input id="login" class="form-control" type="text" name="login" required autofocus>
                                     
                                    </div>
                                </div>

                                <div class="form-group mb-4 row">
                                    <div class="col-12">
                                    <x-input-label for="password" :value="__('Password')" />
                                        <input id="password" class="form-control" type="password" name="password" required autofocus>
                                        <div style="color: #ed9968;">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>


    
                                <div class="form-group mb-0 row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" value="true" class="custom-control-input" id="customCheck1">
                                            <label class="form-label ms-1" for="customCheck1">Remember me</label>
                                        </div>
                                    </div>
                                </div>

 
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-warning w-100 waves-effect waves-light" style="background-color:#7196be;" type="submit">Log In</button>
                                    </div>
                                </div>
    
                                <div class="form-group mb-0 row mt-0">
                                    <div class="col-sm-7 mt-1">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock text-info"></i> Forgot your password?</a>
                                    @endif
                                    </div>
                                    <div class="col-sm-5 mt-1">
                                        <a href="" class="text-muted"><i class="mdi mdi-account-circle text-info"></i> Apply for a Course</a>
                                       <!-- <a href="{{route('register')}}" class="text-muted"><i class="mdi mdi-account-circle text-info"></i> Apply for a Course</a> -->
                                    </div>
                                </div>

                                <br>
                            <div class="col-sm-8 text-left">
                            <i class="mdi mdi-heart text-info text-center"></i> 2025 MCHS - ICT 
                            </div>

                            </form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>
</html>
