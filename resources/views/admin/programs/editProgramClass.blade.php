
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Edit Program Class</title>
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
<h4 class="mb-sm-0">Edit Program Class</h4>

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
<h4 class="card-title">Edit Program Class: {{$pclass->classcode}} - {{$pclass->classname}} | 
<b> @if($pclass->campus_id==1) Lilongwe @endif
@if($pclass->campus_id==2) Blantyre @endif
@if($pclass->campus_id==3) Zomba @endif </b>
</h4>

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
<form action="{{route('store.edited.program.class', $pclass->id)}}" method="post">
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">

        <div class="row mb-3">
            <label class="form-label">Code/Short Name</label>
            <input type="text" name="program_id" value="{{$pclass->program_id}}" hidden>
            <input type="text" name="campus_id" value="{{$pclass->campus_id}}" hidden>
                    
                    <div class="col-sm-12">
                        <input class="form-control" name="scode" type="text" value="{{$pclass->classcode}}" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Class Name</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" name="cname" type="text" value="{{$pclass->classname}}" id="example-text-input">
                    </div>
            </div>

            <div class="row mb-3">
            <label class="form-label">Year of Study</label>
                    
                    <div class="col-sm-12">
                        <input class="form-control" name="cyear" type="number" value="{{$pclass->classyear}}" id="example-text-input">
                    </div>
            </div>

           
            @php 
            $lecturers = App\Models\User::whereIn('role', ['lecturer', 'Principal', 'Dean', 'HOD', 'HOD BASIC BT', 'HOD BASIC LL'])->get();
            @endphp
            <div class="mb-3">
                <label class="form-label">Coordinator</label>
                <select class="form-control select2" name="coordinator">
                    
                        @foreach($lecturers as $lecturer)
                        <option {{($lecturer->id==$pclass->coordinator)? 'selected' : ""}} value="{{$lecturer->id}}">{{$lecturer->fname}} {{$lecturer->lname}}</option>
                       
                        @endforeach
                </select>
            </div>

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Under Basic Department?</label>
                    <div class="col-sm-12">
                    @error('basic') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="basic" aria-label="Default select example">
                            <option value="" selected="">-- select --</option>
                            <option {{($pclass->under_basic==0)? "selected" : ""}} value="0">No</option>
                            <option {{($pclass->under_basic==1)? "selected" : ""}} value="1">Yes</option>
                            </select>
                    </div>

                </div>

        @php 
        $cfees = App\Models\Feecategory::all()
        @endphp

            <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Fee Category</label>
                    <div class="col-sm-12">
                        <select class="form-select" name="fcategory" aria-label="Default select example">
                           
                            @foreach($cfees as $cfee)
                            <option {{($cfee->id==$pclass->feecategory_id)? 'selected' : ""}} value="{{$cfee->id}}">{{$cfee->feecode}} | {{$cfee->feename}}</option>

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
<!-- end row -->

<!-- end row -->


&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary" type="submit">Submit</button> &nbsp;&nbsp;
    </form>
<a href="{{route('view.program')}}"><button class="btn btn-outline-secondary" type="button">Cancel</button></a><br><br>










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