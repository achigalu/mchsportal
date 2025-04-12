
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

<!-- end page title -->

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<h4 class="card-title">Edit program: {{$program->short_name}} {{$program->program_name}} | <b>@if($program->campus->id==1) Lilongwe @endif
@if($program->campus->id==2) Blantyre @endif
@if($program->campus->id==3) Zomba @endif</b></h4>



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
<form action="{{route('update.program', $program->id)}}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-12">


        <div class="row mb-3">
            <label class="form-label">Program Code</label>
                    
            <div class="col-sm-12">
                    @error('program_code') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="program_code" value="{{$program->program_code}}" type="text"  id="example-text-input">
                    </div>
        </div>

        
        <div class="row mb-3">
            <label class="form-label">Program Name</label>
                    
                    <div class="col-sm-12">
                    @error('program_name') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="program_name" type="text" value="{{$program->program_name}}" id="example-text-input">
                    </div>
        </div>

        
        <div class="row mb-3">
            <label class="form-label">Duration (in Months)</label>
                    
                    <div class="col-sm-12">
                    @error('duration') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="duration" value="{{$program->duration}}" type="number"  id="example-text-input">
                    </div>
        </div>

        <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Program Level</label>
                    <div class="col-sm-12">
                    @error('entry_level') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" name="entry_level" aria-label="Default select example">
                           
                            <option {{($program->entry_level==1)? "selected" : ""}} value="1">Basic</option>
                            <option {{($program->entry_level==2)? "selected" : ""}} value="2">Post Basic</option>
                            </select>
                    </div>

        </div>


            <div class="mb-3">
            @php 
            $lecturers = App\Models\User::whereIn('role', ['lecturer', 'Principal', 'Dean', 'HOD', 'HOD BASIC BT', 'HOD BASIC LL'])->get();
            @endphp
                <label class="form-label">Program Coordinator</label><br>
                @error('coordinator') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-control select2" name="coordinator">
                    
                    @foreach($lecturers as $user)
                        <option {{($program->user_id==$user->id)? 'selected' : ""}} value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                    @endforeach
                    </select>

            </div>

            <div class="mb-2">
                <label class="form-label">Department</label><br>
                @error('department') <span class="text-danger">{{$message}}</span> @enderror 
                <select class="form-control select2" name="department_id">
                    
                @foreach($departments as $department)

                <option {{($program->department->id==$department->id)? 'selected' : ""}} value="{{$department->id}}">{{$department->department_name}}
                    @if($department->campus_id==1) - LL @endif
                    @if($department->campus_id==2) - BT @endif
                    @if($department->campus_id==3) - ZA @endif
                </option>
                @endforeach
                </select>

            </div>


            <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Award</label>
                    <div class="col-sm-12">
                    @error('award') <span class="text-danger">{{$message}}</span> @enderror
                        <select class="form-select" aria-label="Default select example" name="award">
                            <option {{($program->award=='Cerificate')? "selected" : ""}} value="Certificate">Certificate</option>
                            <option {{($program->award=='Diploma')? "selected" : ""}} value="Diploma">Diploma</option>
                            <option {{($program->award=='Degree')? "selected" : ""}} value="Degree">Degree</option>
                            <option {{($program->award=='Masters')? "selected" : ""}} value="Masters">Masters</option>
                           
                            </select>
                    </div>

                </div>

                
                <div>
                <label class="form-label">Campuses Offered</label><br>
                @error('campus_offered') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" aria-label="Default select example" name="campus_offered">
                @foreach($campuses as $campus)
                    <option {{ $campus->id == $program->campus_id ? 'selected' : '' }} value="{{ $campus->id }}">
                        {{ $campus->campus }}
                    </option>
                @endforeach
                </select>
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


&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-secondary">Update</button> &nbsp;&nbsp;
</form>
<a href="{{route('view.program')}}"><button class="btn btn-outline-secondary">Cancel</button></a><br><br>









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