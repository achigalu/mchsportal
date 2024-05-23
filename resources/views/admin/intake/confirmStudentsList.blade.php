
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Uploaded List</title>
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
                                    <h4 class="mb-sm-0"></h4>

                                    <div class="page-title-right">
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('single.admission.student')}}">
                                        <li class="btn btn-secondary"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add Single Student</li> &nbsp;
                                        </a>
                                        <a href="{{route('upload.students')}}">
                                        <li class="btn btn-secondary"><i class="fas fa-upload"></i>&nbsp;&nbsp;Upload Intake list</li> &nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h5>STEP 2: Confirm  {{$upload_name}} Selection List Upload</h5><br>
                                        <div class="card col-12">
  <div class="card-header">
  
  <h4><i class="fa fa-times" style="font-size:30px;color:#de7c7c"></i> Upload has errors: correct errors in the excel sheet and upload again</h4>

  <ul class="list-group list-group-flush">
    <li class="list-group-item" style="color: red;">Your class CCM1 not defined in Academic programs class</li>
    <li class="list-group-item" style="color: red;">Your fee category not defined in Fee category settings</li>
    <li class="list-group-item" style="color: red;">Your Campus not defined in the system</li>
  </ul>
</div>
         
<div class="card-header">
  <h4><i class="fas fa-check" style="font-size:30px;color:green"></i> Everything is good.</h4>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item" style="color: green;">Click save list to proceed.</li>
    
  </ul>
</div>
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Class</th>
                                                <th>Entry type</th>
                                                <th>Fee category</th>
                                                <th>Campus</th>
                                                
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
<form action="">
                                               
                                        @foreach($admissions as $student)
                                            <tr>
                                                <td>{{$student->lname}}</td>
                                                <td>{{$student->fname}}</td>
                                                <td>
                                                <input class="form-control" type="text" value="{{$student->campus}}" disabled>
                                                </td>
                                                <td>
                                                <input class="form-control" type="text" value="Basic " disabled>
                                                </td>
                                                <td>
                                                <input class="form-control" type="text" value="Basic Entry" disabled>
                                                
                                                </td>
                                                <td>
                                                <input class="form-control" type="text" value="{{$student->campus}}" disabled>
                                                <option selected></option>
                                       
                                                </td>
                                               
                                            </tr>
                                      @endforeach
                                           
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                            <a href="{{route('admission.student')}}">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-angle-left"></i>&nbsp;&nbsp;Back</button>&nbsp;&nbsp;
                        </a>

                        <a href="{{route('admission.student')}}">
                        <li class="btn btn-warning"> <i class="fas fa-trash"></i>&nbsp;&nbsp;Discard list</li>
                        </a>
                        </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                               
                        
                        <button type="submit" class="btn btn-info"> <i class="fas fa-save"></i>&nbsp;&nbsp;Save list</button>
                        </a><br><br><p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                    </form>            <!-- end row-->


                       
                        <!-- end row-->


                       
                        <!-- end row-->

                        
                        <!-- end row-->


                        
                        <!-- end row-->

                       
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