
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Student Profile</title>
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
   
<h4 class="mb-sm-0">
    <span class="badge rounded-pill bg-info fs-6">
    Profle for: 
        <span class="badge rounded-pill bg-secondary fs-6">
        {{$student->fname}} {{$student->lname}}
        </span>
</span>
</h4>

<div class="page-title-right">


</div>


</div>
</div>
</div>
<!--- start row -->

<div class="row">
<div class="col-lg-12">
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
<form action="{{route('update.student.details', ['studentID'=>$student->id])}}" method="POST" class="custom-validation">
    @csrf
    <h5>Bio Information</h5><p></p>
    <div class="row">

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">FirstName</label>
                <input class="form-control" name="fname" type="text" value="{{$student->fname}}" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Initials</label>
                <input class="form-control" name="initials" type="text" value="{{$student->initials}}" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">SurName</label>
                <input class="form-control" name="lname" type="text" value="{{$student->lname}}" id="validationCustom01">
                @error('lname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    
    <div class="col-lg-4">
        
            <div class="mb-3">
                <label class="form-label">Registration Number</label>
               
                <input class="form-control" name="reg_num" type="text" value="{{$student->reg_num}}" id="validationCustom01">
                @error('reg_num') <span class="text-danger">{{$message}}</span> @enderror

            </div>
            
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input class="form-control" name="phone" type="text" value="{{$student->phone}}" id="validationCustom01">
                @error('phone') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>
 
    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Date of birth*</label>
                
                <input class="form-control" name="dbirth" type="date" value="{{$student->dob}}" id="example-text-input">
                @error('dbirth') <span class="text-danger">{{$message}}</span> @enderror

            </div>
            
    </div>

    
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" type="text" value="{{$student->email}}" id="example-text-input">
                @error('email') <span class="text-danger">{{$message}}</span> @enderror

            </div>  
        </div>


    </div>
  <div class="form-group">
&nbsp;&nbsp;<button class="btn btn-outline-info" type="submit">Update</button> &nbsp;&nbsp;
</form>
<a href="{{route('all.students.list')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a><br><br>
</div>  


</div>
</div>


<!-- end page title -->

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

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- validation -->
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

    </body>

</html>