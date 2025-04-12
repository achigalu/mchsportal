
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | View Campuses</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
<!-- DataTables -->
        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

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
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mchs Management</h4> 

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Home</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- start page title -->
                        <div class="row">    
                            <div class="col-md-6 col-xl-4">
        
                                <!-- Simple card -->
                                <div class="card">
                                        @php 
                                        $users =1;
                                        @endphp
                                
                                        @if($users = 1)
                                        <img src="{{ url('uploads/ed.jpg') }}" 
                                        style="width: 100px; height: 100px; margin-top: 20px;" 
                                        class="avatar-md rounded-circle mx-auto d-block">

                                        @else
                                        <img src="{{ url('uploads/ed.jpg') }}" 
                                        style="width: 50px; height: 50px;" class="avatar-md rounded-circle; align-center">
                                        @endif

                                    <div class="card-body" style="text-align: center;">
                                        <div class="card" style="background-color:AliceBlue; padding:10px;"><br>
                                        <h4 class="card-title;">Dr Alice Kadango</h4>
                                        <p class="card-text">Executive Director.</p>
                                       &nbsp;
                                    </div>
                                        <!--
                                        <a href="#" class="btn btn-info waves-effect waves-light">Edit page</a>
                                    -->
                                    </div>
                                </div>
        
                            </div><!-- end col -->
        
                            <div class="col-md-6 col-xl-4">
        
                                <div class="card">
                                   
                                    <div class="card-body" style="text-align: left;">
                                        <div class="card" style="background-color:AliceBlue; padding:10px;">
                                        <h4 class="card-title;">Central Office</h4>
                                        <strong class="card-text">PO BOX 30368</strong>
                                        <strong class="card-text">Lilongwe 3.</strong><p></p>
                                        CELL:  (+265) 988 640 880 / 881 <br>
                                        EMAIL: registrar@mchs.mw <hr>
                                      
                                        <h4 class="card-title;">Lilongwe Campus</h4>
                                        <strong class="card-text">PO BOX 30368</strong>
                                        <strong class="card-text">Lilongwe 3.</strong><p></p>
                                        CELL:  (+265) 988 640 880 / 881 <br>
                                        EMAIL: lilongwecampus@mchs.mw 

                                       
                                    </div>

                                    </div>

                                  
                                </div>
        
                            </div><!-- end col -->

                            <div class="col-md-6 col-xl-4">
        
    
                            <div class="card">
            <div class="card-body" style="text-align: left;">
                <div class="card" style="background-color:AliceBlue; padding:10px;">
               

                <h4 class="card-title;">Blantyre Campus</h4>
                <strong class="card-text">P/BAG 396</strong>
                <strong class="card-text">Blantyre.</strong><p></p>
                CELL:  (+265) 988 640 880 / 881 <br>
                EMAIL: blantyrecampus@mchs.mw <hr>

                <h4 class="card-title;">Zomba Campus</h4>
                <strong class="card-text">P.O BOX 144</strong>
                <strong class="card-text">Zomba.</strong><p></p>
                CELL:  (+265) 988 640 880 / 881 <br>
                EMAIL: zombaprincipal@mchs.mw
            </div>

            </div>
       
        </div>

    </div><!-- end col -->
                        
                        <!-- end row-->
                        
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


        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
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