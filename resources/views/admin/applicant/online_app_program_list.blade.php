
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Online Applications</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="andy chigalu" name="description" />
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
                                    <h4 class="mb-sm-0">Online applications for - {{$program->program_name}} <span style="color: #439ecf;">( Total applicants: {{ $appCount}} )</span>   </h4>

                                    
                                    <div class="page-title-right">    
                                    <a href="{{route('download.online.applicants', ['program_id'=>$program->id])}}" class="btn btn-outline-info">
                                        <i class="far fa-file-excel"></i> Download
                                    </a>
                                    <a href="{{ route('online.application.summary') }}" class="btn btn-outline-secondary">
                                        <i class="far fa-arrow-alt-circle-left"></i> Back
                                    </a>
                                </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
@if(session()->has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('status')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('invalid'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<i class="mdi mdi-block-helper me-2"></i>
{{session()->get('invalid')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f1f5f7; font-weight: bold; text-align: center;">
                                            <th>S/N</th>
                                                    <th>FIRSTNAME</th>
                                                    <th>INITIALS</th>
                                                    <th>SURNAME</th>
                                                    <th>GENDER</th>
                                                    <th>QUALIFIED</th>
                                                    <th>DISTRICT</th>
                                                   
                                                    <th style="text-align: center;">ZIPPED FILES</th>
                                            </tr>
                                            </thead>
                                           
                                    <tbody>
                                    @php $i=1 @endphp
                                    @if($allapplications->count() > 0 )
                                    @foreach($allapplications as $applicant)
                                    
                                    <tr>
                                                    <td style="text-align: center;"><h6 class="mb-0">{{$i++}}</h6></td>
                                                    <td>{{$applicant->fname}}</td>
                                                    <td style="text-align: left;">{{$applicant->initials}}</td>
                                                    <td style="text-align: left;">{{$applicant->lname}}</td>
                                                    <td style="text-align: center;">
                                                        @if($applicant->sex=='Female') F @endif
                                                        @if($applicant->sex=='Male') M @endif
                                                    </td>
                                                    <td style="text-align: center;">N/A</td>
                                                    <td style="text-align: center;">{{$applicant->district}}</td>

                                                   
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="{{route('zipped.applicant.files', ['applicant_id'=> $applicant->id])}}" class="btn btn-outline-info" target="_blank">
                                                        <i class="fas fa-file-archive"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                               
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> 
                        </div> 
        
                      
                        <style>
    /* Modal Button Hover Effects */
.modal-footer .btn:hover {
    opacity: 0.85;
    transform: scale(1.05);
    transition: all 0.3s ease;
}

/* Enhance the modal title */
.modal-title {
    font-weight: bold;
    font-size: 1.25rem;
}

/* Optional: Add a subtle gradient to the modal body */
.modal-body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
}

/* Optional: Add custom font for the modal */
body {
    font-family: 'Arial', sans-serif;
}
</style>
                      


                      


                      


                       

                        
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