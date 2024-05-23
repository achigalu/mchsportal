
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
            <h4 class="mb-sm-0">Tuition Fee Category</h4>

 <div class="page-title-right">

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
<form action="{{route('add.feecategory')}}" method="post">
    @csrf
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Add Tuition Fee Category</h4>
                <p class="card-title-desc">Setting up category in which fee structure can be assigned to.</p>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Fee Category Name</label>
                    <div class="col-sm-10">
                    @error('feename') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="feename" type="text" placeholder="Enter Category name" id="example-text-input">
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-3">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Fee Category Code</label>
                    <div class="col-sm-10">
                    @error('feecode') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="feecode" type="text" placeholder="Enter category code" id="example-search-input">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Local fee(MK)</label>
                    <div class="col-sm-10">
                    @error('localfee') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="localfee" type="number" placeholder="0" id="example-search-input">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-search-input" class="col-sm-2 col-form-label">Foreign fee($)</label>
                    <div class="col-sm-10">
                    @error('foreignfee') <span class="text-danger">{{$message}}</span> @enderror
                        <input class="form-control" name="foreignfee" type="number" min=0 id="example-search-input">
                    </div>
                </div>
 
             
            </div>
        </div>
    </div> <!-- end col -->
    
</div>

</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-secondary">Submit</button> &nbsp;&nbsp;
<!-- end row -->
</form>
<a href="{{route('view.fee.categories')}}"><button class="btn btn-outline-secondary">Cancel</button></a>
</div>

<div>



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

        <script src="{{asset('assets/js/pages/form-element.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- JAVASCRIPT -->
        

    </body>

</html>