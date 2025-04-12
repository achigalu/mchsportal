
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Cohorts List</title>
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
<h4 class="mb-sm-0">Cohorts/Academic Years List</h4>

<div class="page-title-right">
<div class="btn-group">
<button type="button" class="btn btn-secondary"><i class="fas fa-download"></i>&nbsp;&nbsp;Download</button>
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="mdi mdi-chevron-down"></i>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a>
    <a class="dropdown-item" href="#">PDF</a>
   
</div>


<ul class="breadcrumb m-0">

<a href="{{route('all.intake.categories')}}">
<li class="btn btn-secondary"><i class="fas fa-bars"></i>&nbsp;&nbsp;Intake Categories Description</li> &nbsp;
</a>
@can('add academic session')
<a href="{{route('add.cohort')}}">
<li class="btn btn-secondary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Intake/Cohort</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a>
@endcan
</ul>
</div>

</div>
</div>
</div>
<!-- end page title -->@php 
                        $i = 1;
                        @endphp
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>#</th>
                                                <th>Intake Year</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Intake Month</th>
                                                <th>Intake Description</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                                @foreach($allcohorts as $cohorts)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$cohorts->ayear}}</td>
                                                <td>
                                                {{ Carbon\Carbon::parse($cohorts->sdate)->toFormattedDateString()}}
                                                </td>
                                                <td>
                                                {{ Carbon\Carbon::parse($cohorts->edate)->toFormattedDateString()}}  
                                                </td>
                                                <td>
                                                @switch($cohorts->month)
                                                @case('January')
                                                    <span class="text-info">January</span>
                                                    @break

                                                @case('February')
                                                    <span class="text-info">February</span>
                                                    @break

                                                @case('March')
                                                    <span class="text-info">March</span>
                                                    @break

                                                @case('April')
                                                    <span class="text-info">April</span>
                                                    @break

                                                @case('May')
                                                    <span class="text-info">May</span>
                                                    @break

                                                @case('June')
                                                    <span class="text-info">June</span>
                                                    @break

                                                @case('July')
                                                    <span class="text-info">July</span>
                                                    @break

                                                @case('August')
                                                    <span class="text-info">August</span>
                                                    @break

                                                @case('Semester')
                                                    <span class="text-info">September</span>
                                                    @break

                                                @case('October')
                                                    <span class="text-info">October</span>
                                                    @break

                                                @case('November')
                                                    <span class="text-info">November</span>
                                                    @break

                                                @case('December')
                                                    <span class="text-info">December</span>
                                                    @break

                                                @default
                                                    <span class="text-muted">Unknown</span>
                                                @endswitch

                                                </td>
                                                <td>{{$cohorts->description}}</td>
  
                                                <td>

                                                    @if(Carbon\Carbon::now()->isBetween(Carbon\Carbon::parse($cohorts->sdate), Carbon\Carbon::parse($cohorts->edate)))
                                                    <span class="badge rounded-pill bg-success">
                                                        IN SESSION
                                                    </span>
                                                   
                                                    @elseif(Carbon\Carbon::now()->isBefore(Carbon\Carbon::parse($cohorts->sdate)))
                                                    <span class="badge rounded-pill bg-info">
                                                        PENDING
                                                    </span>

                                                    @elseif(Carbon\Carbon::now()->isAfter(Carbon\Carbon::parse($cohorts->edate)))
                                                    <span class="badge rounded-pill bg-secondary">
                                                        COMPLETED
                                                    </span>
                                                    @endif
        
                                                </td>
                                                <td>
                                                    @can('edit academic session')
                                                <a href="{{route('edit.cohort', $cohorts->id )}}"><button class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></button></a>
                                                    @endcan
                                                    
                                                <a href="{{route('all.cohort.semesters', $cohorts->id )}}"><button class="btn btn-outline-secondary"><i class="fas fa-bars"></i></button> </a>  
                                                   
                                                    @can('delete academic session')
                                                 <button class="btn btn-outline-warning"><i class="fas fa-trash"></i></button>
                                                 @endcan
                                                </td>
                                            </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                      

                      


                      


                      


                       

                        
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