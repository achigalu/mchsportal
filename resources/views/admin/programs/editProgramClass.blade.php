
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Edit Program</title>
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
<h4 class="mb-sm-0">Edit Program Class</h4>

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

<h4 class="card-title">Edit Program Class: Certificate in Clinical Medicine 2</h4>
<p class="card-title-desc">Fill in the spaces provided below</p>

<form>
    <div class="row">
        <div class="col-lg-12">

        <div class="row mb-3">
            <label class="form-label">Code/Short Name</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" type="text" placeholder="CCM 1" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Class Name</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" type="text" placeholder="Certificate in Clinical Medicine 1" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Year of Study</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" type="number" value="1" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Is Clinical</label>
                    <div class="col-sm-12">
                        <select class="form-select" aria-label="Default select example">
                            <option selected="">-- select --</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            </select>
                    </div>

                </div>

            <div class="mb-3">
                <label class="form-label">Coordinator</label>
                <select class="form-control select2">
                    <option>-- select --</option>
                   
                        <option value="AK">Jane Chalera</option>
                        <option value="HI">Odala Banda</option>
                 
                        <option value="CA">Sylvester Chawala</option>
                        <option value="NV">Thomas Muha</option>
                        <option value="OR">Grace Misanjo</option>
                        <option value="WA">Charles Valeta</option>
                   
                </select>
            </div>

            <div class="row mb-3">
            <label class="form-label">Local Fees</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" type="number" value="1" id="example-text-input">
                    </div>
            </div>


            <div class="row mb-3">
            <label class="form-label">Foreign Fees</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" type="number" value="0" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Fee Category</label>
                    <div class="col-sm-12">
                        <select class="form-select" aria-label="Default select example">
                            <option selected="">-- select --</option>
                            <option value="1">Basic</option>
                            <option value="2">Post Basic</option>
                            <option value="2">ODL</option>
                            </select>
                    </div>

            </div>




        </div>

        
    </div>

</form>

</div>
</div>
<!-- end select2 -->

</div>


</div>
<!-- end row -->

<!-- end row -->










&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary">Submit</button> &nbsp;&nbsp;
<a href="{{route('view.program.class')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>

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