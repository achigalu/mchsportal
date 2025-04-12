<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS | User - Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/css/intlTelInput.css">
       
        <link href="{{asset('css/intlTelInput.css')}}" rel="stylesheet" type="text/css" />

        <style>
        .auth-body-bg {
         background-image: url('assets/images/auth-bg1.jpg');
         }
        </style>
    </head>

    <body class="auth-body-bg">

        <div class="bg-overlay"></div>
        <div class="wrapper-page">
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
                        <div style="text-align:center;"><h4 style="color: #7196be;"></h4>
                        @if(session()->has('invalid'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session()->get('invalid')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    
                    </div> 
    
                        <div class="p-3">
                       
                            <form class="form-horizontal mt-0" method="POST" action="{{ route('register') }}">
                              
                                {{ csrf_field() }}
                                <div class="form-group mb-1 row">
                                    <div class="col-6">
                                    <x-input-label for="login" :value="__('FirstName *')" />
                                        <input id="login" class="form-control" type="text" name="fname" required value="{{ old('fname') }}" autofocus>
                                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                                    </div>

                                    <div class="col-6">
                                    <x-input-label for="login" :value="__('LastName *')" />
                                        <input id="login" class="form-control" type="text" name="lname" required value="{{ old('lname') }}" autofocus>
                                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="form-group mb-1 row">
                                    <div class="col-12">
                                    <x-input-label for="username" :value="__('UserName *')" />
                                        <input id="username" class="form-control" type="text" name="username" value="{{old('username')}}" required>
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>
                                </div>


                                <div class="form-group mb-1 row">
                                    <div class="col-12">
                                    <x-input-label for="email" :value="__('Email *')" />
                                        <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="form-group mb-1 row">
                                    <div class="col-6">
                                    <x-input-label for="login" :value="__('Password *')" />
                                        <input id="login" class="form-control" type="password" name="password" required>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div class="col-6">
                                    <x-input-label for="login" :value="__('Confirm Password *')" />
                                        <input id="login" class="form-control" type="password" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>


                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" style="background-color:#7196be;" type="submit">Create Account</button>
                                    </div>
                                </div>

                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                        <div class="col-12" style="width: 900px;">
                            <!-- Existing link -->
                            <a href="{{route('userLogin')}}" class="text-muted">
                           <h4>already have account:
                            
                            <!-- New button -->
                            <button type="button" class="btn btn-outline-danger mt-2"><i class="fas fa-sign-in-alt"></i>
                                Login here
                            </button>
                            </h4> </a>
                        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/intlTelInput.min.js"></script>
<script>
  var input = document.querySelector("#phone");
  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/utils.js",
  });
</script>

    </body>
</html>
