
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Single Student Add</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- Plugins -->
        <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
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
            <h4 class="mb-sm-0">Add Single Student Form</h4>

           

        </div>
    </div>
</div>



<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

               
               
                    <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Student Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="2024 - CCM Upload list" id="example-text-input">
                    </div>
                </div>
                <!-- end row -->
               
                <!-- end row -->
              
               
                
                <!-- end row -->
              
                
             
                <!-- end row -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Cohort/Intake Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example">
                        
                            <option selected="">-- select --</option>
                            <option value="1">GENERIC-ALL </option>
                            <option value="2">SPECIAL-HSA</option>
                            <option value="2">SPECIAL-UDCM-UDPH</option>
                            <option value="2">SPECIAL-URN</option>
                            <option value="2">SPECIAL-CBMS</option>
                            </select>
                    </div>

                </div>
                <hr>
               

                <div class="row mb-3">
                  
                    <label for="example-email-input" class="col-sm-2 col-form-label">Intake File Upload</label>
                    <div class="col-sm-10">
                   
                    <div class="input-group">
                        <input type="file" class="form-control" id="customFile">
                

                </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

<button class="btn btn-secondary">Submit</button>&nbsp;&nbsp;


    <a href="{{route('admission.student')}}">
        <li class="btn btn-secondary"> <i class="fas fa-angle-left"></i>&nbsp;&nbsp;Back</li>
        </a>
                


<br><br><p>
        
<!-- end row -->


<!-- end row -->


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

        <!-- bs custom file input plugin -->
        <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
        <script src="{{asset('assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-element.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- JAVASCRIPT -->
        

    </body>

</html>