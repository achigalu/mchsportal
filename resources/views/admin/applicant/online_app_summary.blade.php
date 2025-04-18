
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Student Information</title>
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
            @if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ session()->get('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('invalid'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ session()->get('invalid') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Start Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Programs applied online <span style="color: #439ecf;"> ( total applicants : {{$programcount}} ) </span></h4>
                        <div class="page-title-right">
                            <a href="" class="btn btn-outline-secondary">
                                <i class="far fa-arrow-alt-circle-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->
             @php 
             $i=1;
             $allprograms = App\Models\Program::all();
             @endphp

             <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="text-align: left;">
                        <div class="card" style="background-color:AliceBlue; padding:10px;">
                            <!-- Responsive Table -->
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="text-align: center;">S/N</th>
                                            <th>PROGRAM NAME</th>
                                            <th style="text-align: center;">TOTAL APPLICANTS</th>
                                            <th style="text-align: center;">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allprograms as $programInstance)
                                    @php
                                    $applicationsCount = App\Models\courseApplication::where('choice1_program_id', $programInstance->id )->get();
                                    $program = App\Models\Program::findOrFail($programInstance->id);
                                    @endphp
                                    @if($applicationsCount->count() > 0)
                                        <tr>
                                            <td style="text-align: center;"><h6 class="mb-0">{{$i++}}</h6></td>
                                            <td><i class="ri-checkbox-blank-circle-fill font-size-10 
                                            text-success align-middle me-2"></i><b>{{$programInstance->program_name}}</b></td>
                                            <td style="text-align: center;">
                                            <div class="font-size-15">
                                                <span class="badge rounded-pill bg-info float-center fs-6 py-1 px-2">
                                                    {{$applicationsCount->count()}}
                                                </span>
                                                </div>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="{{route('download.online.applicants', ['program_id'=>$programInstance->id])}}" class="btn btn-outline-info">
                                                    <i class="far fa-file-excel"></i> download
                                                </a>
                                                <a href="{{route('online.applications.program.list',['program_id'=>$programInstance->id])}}" class="btn btn-outline-secondary">
                                                    <i class="fas fa-bars"></i> View list
                                                </a>
                                            </td>
                                        </tr>
                                       @endif
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Responsive Table -->
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
           
           

            <!-- Start page content -->
           

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
    @include('admin.layout.footer')
</div><!-- end main content -->

<!-- Right Sidebar -->
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