
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
<h4 class="mb-sm-0"></h4>

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
@php
$ccampus = App\Models\Campus::find($pcampus)
@endphp
<h4 class="card-title">Add Program Class for: {{$program_class->program_name}} - {{$ccampus->campus}}</h4>
<p class="card-title-desc"></p>
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
<form action="{{route('create.programclass', $program_class->id)}}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-12">

        <div class="row mb-3">
            <label class="form-label">Class Code</label>
                    
                    <div class="col-sm-12">
                    <input class="form-control" value="{{$ccampus->id}}" name="ccampus" type="text" hidden>
                    <input class="form-control" value="{{$ccampus->id}}" name="ccampus" type="text" hidden>
                    @error('classcode') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="classcode" type="text" placeholder="i.e CCM1" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Class Name</label>
                    
                    <div class="col-sm-12">
                    @error('classname') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="classname" type="text" placeholder="i.e  Certificate in Clinical Medicine 1" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Year</label>
                    
                    <div class="col-sm-12">
                    @error('classyear') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="classyear" type="number" value="1" id="example-text-input">
                    </div>
            </div>
            @php 
            $lecturers = App\Models\User::whereIn('role', ['HOD'])->get();
            @endphp
            <div class="mb-3">
                <label class="form-label">Class coordinator</label><br>
                @error('class_coordinator') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-control select2" name="class_coordinator">
                <option value="" selected>-- Select --</option>
                @if($lecturers)
                    @foreach($lecturers as $coordinator)
                        <option value="{{$coordinator->id}}">{{$coordinator->fname}} {{$coordinator->lname}}
                        </option>
                    @endforeach
                @endif
                </select>

            </div>

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Under Basic Department?</label>
                    <div class="col-sm-12">
                    @error('basic') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="basic" aria-label="Default select example">
                            <option value="" selected="">-- select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            </select>
                    </div>

                </div>
            <input type="text" name="campus" value="{{$pcampus}}" hidden>

               

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Fee Category</label>
                    <div class="col-sm-12">
                    @error('feecategory') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="feecategory" aria-label="Default select example">
                            <option value="" selected="">-- select --</option>
                            @foreach($feecategory as $fees)
                            <option value="{{$fees->id}}">{{$fees->feename}}</option>
                            @endforeach
                          
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
&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary">Submit</button> &nbsp;&nbsp;
</form>
<a href="{{url('view/program')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>

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