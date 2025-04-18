
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | {{$title}}</title>
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
                                     @php
                                    $campus = App\Models\Campus::where('id', $campus)->first()
                                    @endphp
                       
 <!-- start page title -->
 <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Program Classes</h4>

                                    <div class="page-title-right">
<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" 
aria-expanded="false"><i class="fas fa-download"></i>&nbsp;&nbsp;Download &nbsp;&nbsp;<i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a>
    <a class="dropdown-item" href="#">PDF</a>
   
</div>


                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('view.program')}}">
                                        <li class="btn btn-secondary"><i class="fas fa-angle-left"></i>&nbsp;&nbsp;Back</li>&nbsp;&nbsp;
                                        </a>
                                        </ul>


                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('add.program.class', ['pclass' => $class_program->id, 'pcampus' => $campus->id])}}">
                                        <li class="btn btn-secondary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Program Class</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                
                                    <div class="card-body">
                                   
                                    <h3 class="card-title mb-4">Classes for: {{$class_program->program_name}} -<b> {{$campus->campus}}</b></h3>
              
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Year/Class Name</th>
                                                        <th style="width: 120px;">Year</th>
                                                        <th>Coordinator</th>
                                                        <th>Fees Category</th>
                                                        <th>Fees (MK)</th>
                                                        <th>Fees ($)</th>
                                                        <th>Actions</th>
                                                       
                                                    </tr>
                                                </thead><!-- end thead -->
                                                
                                                <tbody>
                                                    @foreach($classeslist as $list) 
                                                    <tr>
                                                        <td><h6 class="mb-0">{{$list->classcode}}</h6></td>
                                                        <td>{{$list->classname}}</td>
                                                        <td>{{$list->classyear}}</td>
                                                        @php
                                                        $coordinator = App\Models\User::find($list->coordinator);
                                                        $feecategory = App\Models\Feecategory::find($list->feecategory_id);
                                                        @endphp
                                                        <td>{{$coordinator->fname}} {{$coordinator->lname}}</td>
                                                        <td>{{$feecategory->feename}}</td>
                                                        <td>{{$feecategory->local_fee}}</td>
                                                        <td>{{$feecategory->foreign_fee}}</td>
                                                        <td>
                                                            <a href="{{route('edit.program.class', ['pclassid' => $list->id])}}"><button class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></button></a>
                                                            <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                   
                                                 
                                                   
                                                     <!-- end -->
                                                     
                                                     <!-- end -->
                                                     
                                                     <!-- end -->
                                                     
                                                     <!-- end -->
                                                    
                                                     <!-- end -->
                                                     
                                                     <!-- end -->
                                                </tbody><!-- end tbody -->
                                            </table> <!-- end table -->
                                        </div>
                                    </div><!-- end card -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                            
                        </div>
                        <!-- end row -->





                    
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