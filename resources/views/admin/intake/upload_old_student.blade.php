
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Upload Students</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
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
            <h4 class="mb-sm-0">Upload Old Students</h4>

           

        </div>
    </div>
</div>



<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
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
               <form action="{{route('uploaded.old.students')}}" method="POST" enctype="multipart/form-data">
               @csrf
                    <div class="row mb-3">
                    
                    <label for="example-text-input" class="col-sm-2 col-form-label">Class Upload Name</label>
                    <div class="col-sm-10">
                    @error('intake_name') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="text" name="intake_name" placeholder="2024 - CCM Upload list" id="example-text-input">
                    </div>
                    </div>
                <!-- end row -->



             
                <!-- end row -->
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Cohort/Intake Category</label>
                    <div class="col-sm-10">
                    @error('academic_yr_id') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-control select2" name="academic_yr_id" aria-label="Default select example">
                            
                        <option value="">-- select --</option>
                        @foreach($academicy as $academic)
                            
                            <option value="{{$academic->id}}"> {{$academic->ayear}} - {{$academic->month}} | {{$academic->description}}</option>
                           
                        @endforeach
                            </select>
                    </div>

                </div>
            @php 
            $program = App\Models\Program::all()
            @endphp
                    <!-- end row -->
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Program</label>
                    <div class="col-sm-10">
                    @error('academic_yr_id') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-control select2" name="program_id" aria-label="Default select example">
                            
                        <option value="">-- select --</option>
                        @foreach($program as $programs)
                            
                                <option value="{{$programs->id}}"> {{$programs->program_code}} - 
                                @if($programs->campus_id==1) LL @endif
                                @if($programs->campus_id==2) BT @endif
                                @if($programs->campus_id==3) ZA @endif
                                </option>
                        @endforeach
                        
                            </select>
                    </div>

                </div>
           
            
            <hr>
               

                <div class="row mb-3">
                  
                    <label for="example-email-input" class="col-sm-2 col-form-label">Class File Upload</label>
                    <div class="col-sm-10">
                    @error('students_upload') <span class="text-danger">{{$message}}</span> @enderror
                    <div class="input-group">
                    
                        <input type="file" name="students_upload" class="form-control" id="customFile">
                  </div>
                    </div>
                </div>

               
                <!-- end row -->
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
<div class="form-group">
<button class="btn btn-secondary" type="submit">Upload</button>&nbsp;&nbsp;
</form>

    <a href="{{route('admission.student')}}">
        <li class="btn btn-secondary"> <i class="fas fa-angle-left"></i>&nbsp;&nbsp;Cancel</li>
        </a>
</div>              
       




                                         
        
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

    

        

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- JAVASCRIPT -->
        

    </body>

</html>