
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | {{$title}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="MCHS>COM, add faculty" name="description" />
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
<h4 class="mb-sm-0">COHORTS/ACADEMIC YEAR</h4>

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

<h4 class="card-title">Add Cohort/Academic Year</h4>
<br>

@if(session()->has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
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
<form action="{{route('create.academicyear')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-12">

        <div class="row mb-2">
            <label class="form-label">Intake Year</label>
                    
                    <div class="col-sm-12">
                    @error('ayear') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="number" name="ayear" placeholder="2024" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-2">
                    <label class="col-sm-2 col-form-label">Intake (Month)</label>
                    <div class="col-sm-12">
                    @error('month') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="month" aria-label="Default select example">
                            <option value="" selected="">-- select --</option>
                            <option value="January">January </option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July </option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                            </select>
                    </div>

        </div>

            <div class="row mb-2">
            <label class="form-label">Intake Description</label>
                    
                    <div class="col-sm-12">
                    @error('description') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="description" type="text" placeholder="HSA - March 2024 intake" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-2">
            <label class="form-label">Start Date</label>
                    
                    <div class="col-sm-12">
                    @error('sdate') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="sdate" type="date" placeholder="2024" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-2">
            <label class="form-label">End Date</label>
                    
                    <div class="col-sm-12">
                    @error('edate') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="edate" type="date" placeholder="2024" id="example-text-input">
                    </div>
            </div>


            <div class="row mb-2">
                    <label class="col-sm-2 col-form-label">Intake Category</label>
                    <div class="col-sm-12">
                    @error('category') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="category" aria-label="Default select example">
                            <option value="" selected="">-- select --</option>
                            <option value="1">GENERIC </option>
                            <option value="2">SPECIAL INTAKE</option>
                            </select>
                    </div>

        </div>

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










&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary">Create</button> &nbsp;&nbsp;
</form>
<a href="{{route('view.cohorts')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>

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