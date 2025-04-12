
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Add User</title>
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
<h4 class="mb-sm-0">Create New User</h4>

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
<form action="{{route('store.users')}}" method="POST" class="custom-validation">
    @csrf
    <div class="row">

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">First Name</label>
               
                <input class="form-control" value="{{old('fname')}}" name="fname" type="text" placeholder="Firstname" id="validationCustom01">                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
                

            </div>
            
        </div>
 
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Surname</label>
                
                <input class="form-control" value="{{old('lname')}}" name="lname" type="text" placeholder="Surname" id="example-text-input">
                @error('lname') <span class="text-danger">{{$message}}</span> @enderror

            </div>
            
        </div>

    
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Gender</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="gender" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            
                            </select>

            </div>
            
        </div><br><p><hr>
 
        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Email</label>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" value="{{old('email')}}" name="email" type="email" placeholder="Email" id="example-text-input">
            </div>
            
        </div>


        
        <div class="col-lg-6">
            @php 
            $roles = DB::table('roles')->orderBy('name', 'asc')->get()           
            @endphp
                <label class="form-label">Roles</label> 
                @error('role') <span class="text-danger">{{$message}}</span> @enderror 
                <select class="form-control select2" name="role">
                    <option value="">-- select --</option>
                    @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                    @endforeach
                       
                </select>
             </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Department</label>
                @php 
                $department = App\Models\Department::all()
                @endphp
                @error('department') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-control select2" name="department">
                    <option value="0">-- None --</option>
                    @foreach($department as $depart)
                        <option value="{{$depart->id}}">{{$depart->department_name}} - 
                        @if($depart->campus_id==1) LL @endif
                        @if($depart->campus_id==2) BT @endif
                        @if($depart->campus_id==3) ZA @endif
                    @endforeach  
                </select>

            </div>
 
            
 </div>

        <div class="col-lg-6">
            <div class="mb-0">
                <label class="form-label">Campus(es)</label>
                @error('campus_id') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-control select2" name="campus_id">
                    <option value="">-- select --</option>
                        <option value="Lilongwe">Lilongwe</option>
                        <option value="Blantyre">Blantyre</option>
                        <option value="Zomba">Zomba</option>
                        <option value="Central Office"> Central Office</option>

                </select>
            </div>
            
        </div>

        <p>

        <hr>

        
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Password</label>
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="password" name="password"  placeholder="" id="example-text-input">

            </div>
            
        </div>
 
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Confirm Password</label>
                @error('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="password" name="password_confirmation" placeholder="" id="example-text-input">

            </div>
            
        </div>
    </div>
  <div class="form-group">
&nbsp;&nbsp;<button class="btn btn-secondary" type="submit">Create</button> &nbsp;&nbsp;
</form>
<a href="{{route('list.users')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a><br><br>
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