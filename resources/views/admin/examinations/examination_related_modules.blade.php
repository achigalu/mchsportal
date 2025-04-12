
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | Examination Modules</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
<!-- DataTables -->
        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
        <!-- Responsive datatable examples -->
        <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />     

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
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h4 class="card-title"><b>Examination Modules</b></h4><br>

<div class="row">
                   
                            <div class="col-lg-4">
                                <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                    <a href="{{ route('student.exam.numbers') }}">
                                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3" style="font-size: 2rem;"></i>EXAMINATION NUMBERS</h5>
                                    </div>
                                    <div class="card-body">
                                        <p style="color: gray;">Generate class examination numbers, view already generated examination numbers</p>
                                    </a>
                                    </div>
                                </div>
                            </div>
                    

                    
                            <div class="col-lg-4">
                                <div class="card border border-danger">
                                    <div class="card-header bg-transparent border-danger">
                                    <a href="{{route('class.aggregated.grades')}}">
                                        <h5 class="my-0 text-danger"><i class="mdi mdi-alarm-panel-outline me-3" style="font-size: 2rem;"></i>AGGREGATED CLASS GRADES</h5>
                                    </div>
                                    <div class="card-body">
                                        <p style="color: gray;">Aggregate class grades for all students in a class, aggregation can be done anytime.</p>
                                    </a>
                                    </div>
                                </div>
                            </div>
                   

                    
                            <div class="col-lg-4">
                                <div class="card border border-success">
                                    <div class="card-header bg-transparent border-success">
                                    <a href="{{ route('grade.old.students') }}">
                                        <h5 class="my-0 text-success"><i class="mdi mdi-account-plus-outline me-3 " style="font-size: 2rem;"></i>GRADE OLD STUDENTS</h5>
                                    </div>
                                    <div class="card-body">
                                        <p style="color: gray;">Grade old students who graduated before the system was implemented.</p>
                                    </a>
                                    </div>
                                </div>
                            </div>
                   
         </div> <!-- end row-->

         
         <div class="row"> 
            
                            <div class="col-lg-4">
                                <div class="card border border-info">
                                    <div class="card-header bg-transparent border-info">
                                    <a href="{{route('all.students.list')}}">
                                        <h5 class="my-0 text-info"><i class="mdi mdi-alpha-t-box me-3" style="font-size: 2rem;"></i>STUDENT TRANSCRIPT</h5>
                                    </div>
                                    <div class="card-body">
                                        <p style="color: gray;">Generate student transcript, view already generated student transcript</p>
                                    </a>
                                    </div>
                                </div>
                            </div>


                    
        
        </div>  <!-- end row -->




</div>
</div>
</div>
<!-- end select2 -->

</div>






<!-- end row -->

<!-- end row -->










   <!-- start page title -->


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

        <!-- Required datatable js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <script src="{{asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
        
        <!-- Responsive examples -->
        <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
        

        <!-- Datatable init js -->
        <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>


        

    </body>

</html>