
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
                                        <form action="{{route('save.confirmed.students', $upload_id)}}" method="POST">
                                        @csrf
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Class</th>
                                                <th>Entry type</th>
                                                
                                                <th>Campus</th>
                                                
                                            </tr>
                                            </thead>
                                            @foreach($admissions as $admission)
                                            <tr>
                                            
                                            <input type="text" name="acy[]" value="{{$admission->academicyear}}" hidden>
                                            <input type="text" name="fname[]" value="{{$admission->fname}}" hidden>
                                            <input type="text" name="dob[]" value="{{$admission->dob}}" hidden>
                                            <input type="text" name="initials[]" value="{{$admission->initials}}" hidden>
                                            <input type="text" name="gender[]" value="{{$admission->gender}}" hidden>
                                            <input type="text" name="semester[]" value="{{$admission->semester}}" hidden>
                                            <input type="text" name="reg_num[]" value="{{$admission->reg_num}}" hidden>
                                            <input type="text" name="role[]" value="{{$admission->role}}" hidden>
                                            <td>{{$admission->lname}}</td>
                                            <input type="text" name="lname[]" value="{{$admission->lname}}" hidden>
                                            <td>{{$admission->fname}}</td>
                                            <td>
                                                @php 
                                                $my_class = App\Models\Admission::where('campus', $admission->campus)
                                                @endphp
                                            <select name="class[]" id="" required>
                                                <option value="" >--select--</option>
                                                @foreach($myclass as $classes)
                                                <option {{($classes->classcode == $admission->class)? 'selected' : ''}} value="{{$classes->classcode}}">{{$classes->classcode}}
                                            
                                                </option>
                                                @endforeach
                                            </select></td>
                                            <td>
                                            <select name="entry_type[]" id="" required>
                                                <option value="">--select--</option>
                                                <option {{ ($admission->entry_level)? 'selected' : '' }} value="{{ $admission->entry_level }}">
                                                {{ $admission->entry_level }}
                                                </option>
                                                <option value="Basic">Basic</option>
                                                <option value="Post Basic">Post Basic</option>
                                                 
                                            </select></td>


                                            </td>
                                            <td>
                                            <select name="campus[]" id="" required>
                                                <option value="">--select--</option>
                                                @foreach($campus as $campuses)
                                                <option {{($campuses->campus==$admission->campus)? 'selected' : ''}} value="{{$campuses->campus}}">{{$campuses->campus}}</option>
                                                @endforeach
                                              
                                            </select></td>
                                            </td>
                                           
                                            </tr>
                                            @endforeach
        
        
                                            <tbody>

                                           
                                    </tbody>
                                        </table><p><br><hr>
                                        <button class="btn btn-secondary" type="submit" name="action" value="back"><i class="fas fa-angle-left"></i>&nbsp;&nbsp;Back</button>&nbsp;&nbsp;
                                        @if($admissions->isNotEmpty())
                                        <button class="btn btn-warning" type="submit" name="action" value="discardlist"><i class="fas fa-trash"></i>&nbsp;&nbsp;Discard list</button>&nbsp;&nbsp;
                                        @endif
                                        @if($admissions->isNotEmpty())
                                        <button class="btn btn-info float-end" type="submit" name="action" value="savelist"><i class="fas fa-save"></i>&nbsp;&nbsp;Save list</button>&nbsp;&nbsp;
                                        @endif
                                        </form><p></p>
                                       
                                    </div>
                                </div>
                               
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                       
                              <!-- end row-->


                       
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