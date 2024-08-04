
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Configure class subjects</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

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


<div class="page-title-right">


</div>


</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<h4 class="card-title">Subject Configurations. <br>
<br> Class: {{$class->classcode}} | @if($class->campus_id==1)Lilongwe  @elseif($class->campus_id==2)Blantyre
@elseif($class->campus_id==3)Zomba @endif</h4>Subject: {{$subject->code}} | {{$subject->name}} <br><br>


@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('message')}}
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

<form action="{{route('configured.subject')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-12">
        <input class="form-control" type="text" value="{{$class->id}}" name="class_id" id="example-text-input" hidden>
        <input class="form-control" type="text" value="{{$class->campus_id}}" name="campus" id="example-text-input" hidden>
        <input class="form-control" type="text" value="{{$subject->id}}" name="subject_id" id="example-text-input" hidden>
        <input class="form-control" type="text" value="{{$ay}}" name="ay" id="example-text-input" hidden>
        <div class="row mb-3">
            <label class="form-label">Semester</label>
                    <div class="col-sm-12">
                    @error('semester') <span class="text-danger">{{$message}}</span> @enderror
                    <select class="form-select" name="semester" aria-label="Default select example" required>
                            <option value="" selected="">-- select --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            
                            </select>
                    </div>
            </div>

            
        <div class="row mb-3">
            <label class="form-label">Exam Weight(%)</label>
                    
                    <div class="col-sm-12">
                    @error('exam_weight') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="number" name="exam_weight" id="example-text-input" required>
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">CA Weight(%)</label>
                    
                    <div class="col-sm-12">
                    @error('ca_weight') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="number" name="ca_weight" id="example-text-input" required>
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Pass Mark(%)</label>
                    
                    <div class="col-sm-12">
                    @error('pass_mark') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" type="number" name="pass_mark" id="example-text-input" required>
                    </div>
            </div>



            <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Is Major</label>
                    <div class="col-sm-12">
                    @error('is_major') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="is_major" aria-label="Default select example" required>
                            <option value="" selected="">-- select --</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            
                            </select>
                    </div>

                </div>

                
            <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Is Project</label>
                    <div class="col-sm-12">
                    @error('is_project') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="is_project" aria-label="Default select example" required>
                            <option value="" selected="">-- select --</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>
                            
                            </select>
                    </div>

                </div>

                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-12">
                    @error('category') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="category" aria-label="Default select example" required>
                            <option value="" selected="">-- select --</option>
                            <option value="1">Active</option>
                            <option value="2">Archieved</option>
                            
                            </select>
                    </div>

                </div>
            

            

            
        </div>

        
    </div>



</div>
</div>
<!-- end select2 -->

</div>


</div>
<!-- end row -->

<!-- end row -->










&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary">Create</button> &nbsp;&nbsp;
</form>
<a href="{{route('add.subject.to.class')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>

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

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        

    </body>

</html>