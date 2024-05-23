
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Add Campus</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
            </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
           @include('admin.layout.top_bar')

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!-- User details -->
                   

                    <!--- Sidemenu -->
                    @include('admin.layout.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
           
            
            <div class="main-content">

            <div class="page-content">
            <div class="container-fluid">

<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0">Add Campus</h4>

<div class="page-title-right">


</div>


</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('message')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{route('campus.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">

        <div class="row mb-3">
            <label class="form-label">Campus Name</label>
                    
                    <div class="col-sm-12">
                    @error('campus') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="text" name="campus" placeholder="Campus Name" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Campus Email</label>         
                    <div class="col-sm-12">
                    @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="email" type="text" placeholder="Email address" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Phone</label>
                    
                    <div class="col-sm-12">
                    @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="phone" type="text" placeholder="Enter Phone" id="example-text-input">
                    </div>
            </div>

            <div class="mb-3">
                <label class="form-label">District</label><br>
                @error('district') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-control select2" name="district">
                    <option value="">Select</option>
                        <option value="Kasungu">Kasungu</option>
                        <option value="Lilongwe">Lilongwe</option>
                        <option value="Dowa">Dowa</option>
                        <option value="Neno">Neno</option>
                        <option value="Balaka">Balaka</option>
                        <option value="Nsanje">Nsanje</option>
                        <option value="Mzimba">Mzimba</option>
                        <option value="Karonga">Karonga</option>
                        <option value="Chitipa">Chitipa</option>
                    
                </select>

            </div>
           
    

            
        </div>

        
    </div>



</div>
</div>
<!-- end select2 -->

</div>


</div>
<!-- end row -->

<!-- end row -->


&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-secondary">Submit</button> &nbsp;&nbsp;
</form>
<a href="{{route('all.campuses')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>

<!-- end row -->

</div> <!-- container-fluid -->
                    
            </div>
                    <!-- End Page-content -->
                    @include('admin.layout.footer')

                    </div>

            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        

    </body>

</html>