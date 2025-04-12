
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Apply for a program</title>
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

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- phone flags -->
       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/css/intlTelInput.css">
       
        <link href="{{asset('css/intlTelInput.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
<style>
    
    /* File status container */
.file-status {
    margin-top: 10px;
}

/* Style for the status text and icon */
.status-icon {
    font-size: 18px;
    margin-right: 5px;
}

.status-text {
    font-weight: bold;
}

.success {
    color: green;
}

.error {
    color: red;
}

/* Thumbnail styling */
.thumbnail {
    max-width: 120px;
    max-height: 120px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

/* View file button styling */
.view-file-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background-color:rgb(58, 58, 58);
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 4px;
}

.view-file-btn:hover {
    background-color:rgb(247, 144, 103);
}

/* Optional: Make the thumbnail and button more visually appealing */
.thumbnail:hover {
    cursor: pointer;
    opacity: 0.8;
}

.view-file-btn:hover {
    background-color:rgb(238, 175, 120);
    text-decoration: underline;
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <h4 class="mb-sm-0" style="color:#7196be;">Course Application Form

                                    </h4>

                                    
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        
                        <!-- end page title -->
                        
                       

<div class="container mt-0">
    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session()->has('invalid'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-block-helper me-2"></i>
            {{session()->get('invalid')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">UPLOAD DOCUMENTS &nbsp;&nbsp; - &nbsp;&nbsp;Step:&nbsp;&nbsp; 
                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next3.jpg')}}" alt="logo-light" height="50">
                    </span>
                    </h4>

                    <form action="{{route('applicant.post.form3')}}" method="POST" class="custom-validation" enctype="multipart/form-data">
    @csrf
    <h5><span style="color: red;">*Make sure the documents you are to upload are clear and visible, each image should be of maximum size of 2mb*</span></h5><p></p>
    <div class="row">

    <div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">COPY OF MSCE or EQUIVALENT<span style="color: red;">*</span></label>
        @error('msce_copy') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('msce_copy'))
            @php
                $filePath = asset(session('msce_copy'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="msce_copy" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
          
        @endif
        <input class="form-control" type="file" name="msce_copy" id="msce_copy">
    </div>
</div>

 

<div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">CURRICULUM VITAE<span style="color: red;">*</span></label>
        @error('cv') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('cv'))
            @php
                $filePath = asset(session('cv'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="cv" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
           
        @endif
        <input class="form-control" type="file" name="cv" id="cv">
    </div>
</div>

<div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">COPY OF BANK DEPOSIT SLIP<span style="color: red;">*</span></label>
        @error('bank_slip') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('bank_slip'))
            @php
                $filePath = asset(session('bank_slip'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="bank_slip" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
           
        @endif
        <input class="form-control" type="file" name="bank_slip" id="bank_slip">
    </div>
</div>



<div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">Copy of Recognized ID<span style="color: red;">*</span></label>
        @error('copy_id') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('copy_id'))
            @php
                $filePath = asset(session('copy_id'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="copy_id" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
         
        @endif
        <input class="form-control" type="file" name="copy_id" id="copy_id">
    </div>
</div>
<br><br>
<hr><br>

<div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">COPY OF PROFESSIONAL BODY REGISTRATION<span style="color: red;">( for post-basic candidates only )</span></label>
        <br>
        @error('pregistration') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('pregistration'))
            @php
                $filePath = asset(session('pregistration'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="pregistration" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
          
        @endif
        <input class="form-control" type="file" name="pregistration" id="pregistration">
    </div>
</div>


<div class="col-lg-12">
    <div class="mb-4">
        <label class="form-label">COPY OF PROFESSIONAL CERTIFICATE(s)<span style="color: red;">( for post basic-candidates only )</span></label>
        @error('copy_pcertificate') <span class="text-danger">{{$message}}</span> @enderror

        @if(session('copy_pcertificate'))
            @php
                $filePath = asset(session('copy_pcertificate'));
                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            @endphp
            <div class="file-status">
                <p><strong>Uploaded:</strong> <span class="status-icon success">✔</span> <span class="status-text">Yes</span></p>
                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                    <img src="{{ $filePath }}" alt="MSCE Thumbnail" class="thumbnail">
                @else
                    <a href="{{ $filePath }}" class="view-file-btn" target="_blank">View File</a>
                @endif
                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm delete-file" 
                        data-field="copy_pcertificate" 
                        data-url="{{ route('applicant.delete-file') }}"
                        style="margin-top: 10px;">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @else
           
        @endif
        <input class="form-control" type="file" name="copy_pcertificate" id="copy_pcertificate">
    </div>
</div>



    </div>
  <div class="form-group">
&nbsp;&nbsp;
<style>
  .float-right {
    float: right;
  }
</style>

<!-- <button class="btn btn-outline-info float-right" type="submit">Next 
    <i class="far fa-arrow-alt-circle-right"></i><i class="far fa-paper-plane"></i></button> -->

<button class="btn btn-outline-info float-right" type="submit">
<i class="far fa-newspaper"></i> Review</button>


&nbsp;&nbsp;
</form>

 <!-- Back Button (Navigate to Dashboard) -->

&nbsp;&nbsp; <!-- Adds space between the buttons -->


<!-- Back Button (Navigate to Dashboard) -->
<a href="{{ route('applicant.get.form2') }}" class="btn btn-outline-secondary float-right">
  Back <i class="far fa-arrow-alt-circle-left"></i>
</a>

<!-- Add some spacing with CSS -->
<style>
  /* Add space between the buttons by applying margin to <a> tags */
  a {
    margin-right: 10px; /* Adjust the spacing as necessary */
  }
</style>
                </div>
            </div>
        </div>
    </div>
</div>






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


        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- twitter-bootstrap-wizard js -->
        <script src="{{asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>



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
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
      

        <script src="{{asset('assets/js/app.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/intlTelInput.min.js"></script>


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Add this JavaScript at the bottom of your page -->

    

    </body>

<script>
$(document).ready(function() {
    $('.delete-file').click(function(e) {
        e.preventDefault();
        const fieldName = $(this).data('field');
        const deleteUrl = $(this).data('url');
        
        if (confirm('Are you sure you want to remove this file?')) {
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    field: fieldName
                },
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh to show changes
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error: Could not delete file');
                }
            });
        }
    });
});
</script>


</html>