
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

         <!-- twitter-bootstrap-wizard css -->
         <link rel="stylesheet" href="{{asset('assets/libs/twitter-bootstrap-wizard/prettify.css')}}">

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

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ACADEMIC QUALIFICATIONS &nbsp;&nbsp; - &nbsp;&nbsp;Step:&nbsp;&nbsp; 

                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next2.jpg')}}" alt="logo-light" height="50">
                    </span>
                    </h4>

                    <form action="{{route('applicant.post.form2')}}" method="POST" class="custom-validation" enctype="multipart/form-data">
    @csrf
    <h4>Academics</h4><p></p>
    <hr style="color:#dcccc8">
    <div class="row">

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Academic qualification(s):<span style="color: red;"> MSCE, GCE or Other (please specify)</span>  </label>
                @error('qualification') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="qualification" value="{{session('qualification')}}" type="text" placeholder="" required>
               
            </div>   
    </div>
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Certificate Number<span style="color: red;">*</span>  </label>
                @error('certificate_no') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="certificate_no" value="{{session('certificate_no')}}" type="text" placeholder="" required>
               
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Year Obtained<span style="color: red;">*</span>  </label>
                @error('msce_year') <span class="text-danger">{{$message}}</span> @enderror
                <select name="msce_year" id="msce_year" class="form-control" required>
                    <option value="">Select Year</option>
                    @for ($year = 1997; $year <= date('Y'); $year++)
                <option value="{{ $year }}" 
                    {{ session('msce_year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
                @endfor
            </select>
               
               
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">School Attended<span style="color: red;">*</span>  </label>
                @error('school_attended') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="school_attended" value="{{session('school_attended')}}" type="text" placeholder="" required>
               
            </div>   
    </div>

    <div class="col-lg-7">
            <div class="mb-4">
                <label class="form-label">Postal/Physical Address<span style="color: red;">*</span></label><br>
                @error('school_address') <span class="text-danger">{{$message}}</span> @enderror
                <textarea id="comments" class="form-control" name="school_address" rows="2" cols="2" 
                placeholder="" maxlength="200" required>{{session('school_address')}}</textarea>
                
            </div>   
    </div>
 
    <p> <h4>Subjects</h4></p>
    <hr style="color:#dcccc8">

    <br><p></p>
    <div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">English <span style="color: red;"></span></label>
        @error('english_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="english_grade" required>
        <option value="">Select Grade</option>
            <option value="1" {{ session('english_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('english_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('english_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('english_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('english_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('english_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('english_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('english_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('english_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Mathematics <span style="color: red;"></span></label>
        @error('maths_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="maths_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('maths_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('maths_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('maths_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('maths_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('maths_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('maths_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('maths_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('maths_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('maths_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

    <div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Biology <span style="color: red;"></span></label>
        @error('biology_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="biology_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('biology_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('biology_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('biology_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('biology_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('biology_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('biology_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('biology_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('biology_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('biology_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Physical Science <span style="color: red;"></span></label>
        @error('pscience_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="pscience_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('pscience_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('pscience_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('pscience_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('pscience_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('pscience_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('pscience_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('pscience_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('pscience_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('pscience_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Physics <span style="color: red;"></span></label>
        @error('physics_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="physics_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('physics_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('physics_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('physics_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('physics_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('physics_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('physics_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('physics_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('physics_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('physics_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Chemistry <span style="color: red;"></span></label>
        @error('chemistry_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="chemistry_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('chemistry_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('chemistry_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('chemistry_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('chemistry_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('chemistry_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('chemistry_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('chemistry_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('chemistry_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('chemistry_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Agriculture <span style="color: red;"></span></label>
        @error('agriculture_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="agriculture_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('agriculture_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('agriculture_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('agriculture_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('agriculture_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('agriculture_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('agriculture_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('agriculture_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('agriculture_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('agriculture_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Geography <span style="color: red;"></span></label>
        @error('geography_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="geography_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('geography_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('geography_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('geography_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('geography_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('geography_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('geography_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('geography_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('geography_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('geography_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Chichewa <span style="color: red;"></span></label>
        @error('chichewa_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="chichewa_grade">
        <option value="">Select Grade</option>
        <option value="1" {{ session('chichewa_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('chichewa_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('chichewa_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('chichewa_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('chichewa_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('chichewa_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('chichewa_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('chichewa_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('chichewa_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">History <span style="color: red;"></span></label>
        @error('history_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="history_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('history_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('history_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('history_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('history_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('history_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('history_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('history_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('history_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('history_grade') == '9' ? 'selected' : '' }}>9</option>
        </select>
    </div>
</div>

<!-- ADDITIONAL FIVE SUBJECTS -->
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">General Science <span style="color: red;"></span></label>
        @error('gs_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="gs_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('gs_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('gs_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('gs_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('gs_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('gs_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('gs_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('gs_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('gs_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('gs_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Home Economics <span style="color: red;"></span></label>
        @error('home_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="home_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('home_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('home_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('home_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('home_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('home_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('home_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('home_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('home_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('home_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Social Studies <span style="color: red;"></span></label>
        @error('social_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="social_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('social_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('social_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('social_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('social_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('social_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('social_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('social_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('social_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('social_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Life Skills <span style="color: red;"></span></label>
        @error('lifes_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="lifes_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('lifes_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('lifes_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('lifes_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('lifes_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('lifes_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('lifes_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('lifes_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('lifes_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('lifes_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Business Studies <span style="color: red;"></span></label>
        @error('bs_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="bs_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('bs_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('bs_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('bs_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('bs_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('bs_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('bs_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('bs_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('bs_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('bs_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>
<!-- END OF ADDITIONAL SUBJECTS -->


<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Bible Knowledge <span style="color: red;"></span></label>
        @error('bk_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="bk_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('bk_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('bk_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('bk_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('bk_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('bk_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('bk_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('bk_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('bk_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('bk_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>



<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Computer Studies <span style="color: red;"></span></label>
        @error('computer_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="computer_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('computer_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('computer_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('computer_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('computer_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('computer_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('computer_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('computer_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('computer_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('computer_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Additional Mathematics <span style="color: red;"></span></label>
        @error('admath_grade') <span class="text-danger">{{$message}}</span> @enderror
        <select class="form-control" name="admath_grade">
            <option value="">Select Grade</option>
            <option value="1" {{ session('admath_grade') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ session('admath_grade') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ session('admath_grade') == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ session('admath_grade') == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ session('admath_grade') == '5' ? 'selected' : '' }}>5</option>
            <option value="6" {{ session('admath_grade') == '6' ? 'selected' : '' }}>6</option>
            <option value="7" {{ session('admath_grade') == '7' ? 'selected' : '' }}>7</option>
            <option value="8" {{ session('admath_grade') == '8' ? 'selected' : '' }}>8</option>
            <option value="9" {{ session('admath_grade') == '9' ? 'selected' : '' }}>9</option>
            <!-- Add other grades as needed -->
        </select>
    </div>
</div>

<div class="col-lg-5">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Other Subjects<span style="color: red;">(Specify)</span></label>
        @error('other_subjects') <span class="text-danger">{{$message}}</span> @enderror
        <textarea id="comments" class="form-control" value="{{session('other_subjects')}}" name="other_subjects" rows="2" cols="40" 
        placeholder="" maxlength="400">{{session('other_subjects')}}</textarea>
    </div>
</div>


<br>
<p></p>
<h5 style="display: inline;">Profession and Certification
<p style="display: inline; margin: 0;">
    
        <small style="color: red; display: inline;">(Only for those applying for Mature entry programmes)</small>
    </h5>
</p> <hr style="color:#dcccc8">

<br>
    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Professional Certificates<span style="color: red;"></span></label>
                @error('pcertificate') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="pcertificate" value="{{session('pcertificate')}}" type="text" placeholder="">
            </div>    
    </div>

    <div class="col-lg-2">
            <div class="mb-3">
                <label class="form-label">Year Obtained<span style="color: red;"></span>  </label>
                @error('pyear') <span class="text-danger">{{$message}}</span> @enderror
                <select name="pyear" id="pyear" class="form-control">
                    <option value="">-- Select --</option>
                    @for ($year = 1997; $year <= date('Y'); $year++)
                <option value="{{ $year }}" 
                    {{ session('pyear') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
                @endfor
            </select>    
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">College<span style="color: red;"></span></label>
                @error('pcollege') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="pcollege" value="{{session('pcollege')}}" type="text" placeholder="">
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Occupation ( Current )<span style="color: red;"></span></label>
                @error('occupation') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="occupation" value="{{session('occupation')}}" type="text" placeholder="">
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Employer<span style="color: red;"></span></label>
                @error('employer') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="employer" value="{{session('employer')}}" type="text" placeholder="">
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Workplace<span style="color: red;"></span></label>
                @error('workplace') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="workplace" value="{{session('workplace')}}" type="text" placeholder="">
            </div>    
    </div>

<br>
<p></p>
<h5 style="display: inline;">Courses of Admission
<p style="display: inline; margin: 0;">
    
        <small style="color: red; display: inline;">(indicate the appropriate programme:)</small>
    </h5>
</p> <hr style="color:#dcccc8">

@php 
$programs = App\Models\Program::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 22])->get();
@endphp
    
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">First Choice<span style="color: red;">*</span></label>
                @error('choice1_program_id') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="choice1_program_id" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" 
                                    {{ session('choice1_program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                </select>

            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Second Choice<span style="color: red;">*</span></label>
                @error('choice2_program_id') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="choice2_program_id" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" 
                                    {{ session('choice2_program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                </select>

            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Third Choice<span style="color: red;">*</span></label>
                @error('choice3_program_id') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="choice3_program_id" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" 
                                    {{ session('choice3_program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                </select>

            </div>  
        </div>

        <br>
<p></p>
<h5 style="display: inline;">How do you intend to pay fees? 
<p style="display: inline; margin: 0;">
    
        <small style="color: red; display: inline;">( fill the appropriate option )</small>
    </h5>
</p> <hr style="color:#dcccc8">

<div class="col-lg-4">
    <div class="mb-3">
        <label class="form-label">Choose<span style="color: red;">*</span></label><br>
        
        @error('status') <span class="text-danger">{{$message}}</span> @enderror

        <div>
                <input type="radio" id="parents_guardians" name="parent_guardian" value="Parents/Guardians" {{ session('parent_guardian') == 'Parents/Guardians' ? 'checked' : '' }} required>
                <label for="parents_guardians">Parents/Guardians</label>
            </div>

            <div>
                <input type="radio" id="self" name="parent_guardian" value="Self" {{ session('parent_guardian') == 'Self' ? 'checked' : '' }} required>
                <label for="self">Self</label>
            </div>
                </div>
            </div>

<div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Sponsor <span style="color: red;">( name of sponsor )</span></label><br>
                @error('school_address') <span class="text-danger">{{$message}}</span> @enderror
                <textarea id="comments" class="form-control"  name="fee_sponsor" rows="2" cols="" 
                placeholder="" maxlength="200">{{session('fee_sponsor')}}</textarea>
                
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Any other<span style="color: red;">( Specify )</span></label><br>
                @error('school_address') <span class="text-danger">{{$message}}</span> @enderror
                <textarea id="comments" class="form-control" name="fee_other" rows="2" cols="" 
                placeholder="" maxlength="200">{{session('fee_other')}}</textarea>
                
            </div>   
    </div>
    <p>
    <hr>
    </div>
  <div class="form-group">
&nbsp;&nbsp;
<style>
  .float-right {
    float: right;
    margin-left: 10px;  /* Add space between buttons */
  }
</style>


  <!-- Next Button -->
  <button class="btn btn-outline-info float-right" type="submit">Next 
    <i class="far fa-arrow-alt-circle-right"></i>
  </button>
</form>
  <!-- Back Button (Navigate to Dashboard) -->
<a href="{{ route('applicant.dashboard') }}" class="btn btn-outline-secondary float-right">
  Back <i class="far fa-arrow-alt-circle-left"></i>
</a>


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

        <script src="{{asset('assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

        <!-- form wizard init -->
        <script src="{{asset('assets/js/pages/form-wizard.init.js')}}"></script>

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

      
    

    </body>

</html>