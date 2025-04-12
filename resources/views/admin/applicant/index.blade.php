
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

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><b>PERSONAL DETAILS &nbsp;&nbsp; - &nbsp;&nbsp;Step:&nbsp;&nbsp; </b>
                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next1.jpg')}}" alt="logo-light" height="50">
                    </span>
                    </h4>

    <form action="{{route('applicant.post.form1')}}" method="POST" class="custom-validation" enctype="multipart/form-data">
    @csrf
    <h5>Bio Information</h5><p></p>
    <div class="row">
    
<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">FirstName<span style="color: red;">*</span></label>
            @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            <input class="form-control" name="fname" value="{{session('fname')}}" type="text" placeholder="" required>
           
        </div>   
</div>

<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">Initials/MiddleName<span style="color: red;"></span></label>
            @error('initials') <span class="text-danger">{{$message}}</span> @enderror
            <input class="form-control" name="initials" value="{{session('initials')}}" type="text" placeholder="">
           
        </div>   
</div>

<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">SurName<span style="color: red;">*</span></label>
            @error('lname') <span class="text-danger">{{$message}}</span> @enderror
            <input class="form-control" name="lname" value="{{session('lname')}}" type="text" placeholder="" required>
           
        </div>   
</div>

<!--- input row end-->
    
    <div class="col-lg-4">
        
            <div class="mb-3">
                <label class="form-label">Sex<span style="color: red;">*</span></label>
                @error('sex') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="sex" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            <option value="Male" {{session('sex') == 'Male' ? 'selected' : ''}}>Male</option>
                            <option value="Female" {{session('sex') == 'Female' ? 'selected' : ''}}>Female</option>
                            </select>
             
                

            </div>
            
    </div>


    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Age<span style="color: red;">*</span></label>
                @error('age') <span class="text-danger">{{$message}}</span> @enderror
                

                <select name="age" class="form-control" required>
                    <option value="">-- Select --</option>
                    @for ($age = 14; $age <= 70; $age++)
                <option value="{{ $age }}" 
                    {{ session('age') == $age ? 'selected' : '' }}>
                    {{ $age }}
                </option>
                @endfor
            </select>
               
            </div>   
    </div>
 
    <div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Date of birth<span style="color: red;">*</span></label>
                @error('dbirth') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="dbirth" value="{{session('dbirth')}}" type="date" placeholder="" required>
              

            </div>
            
    </div>

   <!--- input row end--> 


        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Marital Status<span style="color: red;">*</span></label>
                @error('marital') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="marital" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            <option value="Single" {{session('marital') == 'Single' ? 'selected' : ''}}>Single</option>
                            <option value="Married" {{session('marital') == 'Married' ? 'selected' : ''}}>Married</option>
                            <option value="Divorced" {{session('marital') == 'Divorced' ? 'selected' : ''}}>Divorced</option>
                            </select>

            </div>  
        </div>

 

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Home District<span style="color: red;">*</span></label>
                @error('district') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="district" aria-label="Default select example" required>
                            <option value="">-- select --</option>
                            <option value="BT" {{session('district') == 'BT' ? 'selected' : ''}}>Blantyre</option>
                            <option value="BLK" {{session('district') == 'BLK' ? 'selected' : ''}}>Balaka</option>
                            <option value="CK" {{session('district') == 'CK' ? 'selected' : ''}}>Chikwawa</option>
                            <option value="CP" {{session('district') == 'CP' ? 'selected' : ''}}>Chitipa</option>
                            <option value="DA" {{session('district') == 'DA' ? 'selected' : ''}}>Dowa</option>
                            <option value="DZ" {{session('district') == 'DZ' ? 'selected' : ''}}>Dedza</option>
                            <option value="KU" {{session('district') == 'KU' ? 'selected' : ''}}>Kasungu</option>
                            <option value="KA" {{session('district') == 'KA' ? 'selected' : ''}}>Karonga</option>
                            <option value="LL" {{session('district') == 'LL' ? 'selected' : ''}}>Lilongwe</option>
                            <option value="LA" {{session('district') == 'LA' ? 'selected' : ''}}>Likoma</option>
                            <option value="MGH" {{session('district') == 'MHG' ? 'selected' : ''}}>Mangochi</option>
                            <option value="MJ" {{session('district') == 'MJ' ? 'selected' : ''}}>Mulanje</option>
                            <option value="MHG" {{session('district') == 'MHG' ? 'selected' : ''}}>Machinga</option>
                            <option value="MZ" {{session('district') == 'MZ' ? 'selected' : ''}}>Mwanza</option>
                            <option value="MC" {{session('district') == 'MC' ? 'selected' : ''}}>Mchinji</option>
                            <option value="MZ" {{session('district') == 'MZ' ? 'selected' : ''}}>Mzimba</option>
                            <option value="KK" {{session('district') == 'KK' ? 'selected' : ''}}>Nkhotakota</option>
                            <option value="NB" {{session('district') == 'NB' ? 'selected' : ''}}>Nkhatabay</option>
                            <option value="NS" {{session('district') == 'NS' ? 'selected' : ''}}>Ntchisi</option>
                            <option value="NN" {{session('district') == 'NN' ? 'selected' : ''}}>Neno</option>
                            <option value="NU" {{session('district') == 'NU' ? 'selected' : ''}}>Ntcheu</option>
                            <option value="NE" {{session('district') == 'NE' ? 'selected' : ''}}>Nsanje</option>
                            <option value="RU" {{session('district') == 'RU' ? 'selected' : ''}}>Rumphi</option>
                            <option value="SA" {{session('district') == 'SA' ? 'selected' : ''}}>Salima</option>
                            <option value="TO" {{session('district') == 'TO' ? 'selected' : ''}}>Thyolo</option>
                            <option value="ZA" {{session('district') == 'ZA' ? 'selected' : ''}}>Zomba</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">T/A<span style="color: red;">*</span></label>
                @error('traditional') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="traditional" value="{{session('traditional')}}" type="text" required>
               

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Village<span style="color: red;">*</span></label>
                @error('village') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="village" value="{{session('village')}}" type="text" placeholder="" required>
             

            </div>  
        </div>

        <br><br><p>
            <h5>Contact Information</h5>
            <hr>
            <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone<span style="color: red;">*</span></label>
                @error('student_phone1') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="student_phone1" value="{{session('student_phone1')}}" type="text" placeholder="" required>
               
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone (Optional)</label>
                @error('student_phone2') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="student_phone2" value="{{session('student_phone2')}}" type="text">
               
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email (Optional)</label>
                @error('student_email') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" name="student_email" value="{{session('student_email')}}" type="email">
                
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Contact Address<span style="color: red;">*</span></label><br>
                @error('student_address') <span class="text-danger">{{$message}}</span> @enderror
                <textarea id="comments" class="form-control"  name="student_address" rows="4" cols="41" 
                placeholder="" maxlength="200" required>{{session('student_address')}}</textarea>
               
            </div>   
    </div>

    <br><br><p>
            <h5>Next of KIN</h5>
            <hr>
    
        <div class="col-lg-6">
                <label class="form-label">Full Name<span style="color: red;">*</span></label> 
                @error('kin_fullname') <span class="text-danger">{{$message}}</span> @enderror 
                <input class="form-control" name="kin_fullname" value="{{session('kin_fullname')}}" type="text" placeholder="" required>
             </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Relationship<span style="color: red;">*</span></label>
                @error('relationship') <span class="text-danger">{{$message}}</span> @enderror 
                <select class="form-select" name="relationship" aria-label="Default select example" required>
                            <option selected=""  value="">-- select --</option>
                            <option value="Mother" {{session('relationship') == 'Mother' ? 'selected' : ''}}>Mother</option>
                            <option value="Father" {{session('relationship') == 'Father' ? 'selected' : ''}}>Father</option>
                            <option value="Uncle" {{session('relationship') == 'Uncle' ? 'selected' : ''}}>Uncle</option>
                            <option value="Brother" {{session('relationship') == 'Brother' ? 'selected' : ''}}>Brother</option>
                            <option value="Sister" {{session('relationship') == 'Sister' ? 'selected' : ''}}>Sister</option>
                            <option value="Brother" {{session('relationship') == 'Brother' ? 'selected' : ''}}>Brother</option>
                            <option value="Aunt" {{session('relationship') == 'Aunt' ? 'selected' : ''}}>Aunt</option>
                            </select>
            </div>
 
            
 </div>


        <p>

        <hr>

        
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Phone</label>
                @error('kin_phone') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="text" value="{{session('kin_phone')}}" name="kin_phone" placeholder="" required>

            </div>
            
        </div>
 
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Email (Optional)</label>
                @error('kin_email') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="email" value="{{session('kin_email')}}" name="kin_email" placeholder="" >

            </div>
            
        </div>
        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Postal Address<span style="color: red;">*</span></label><br>
                @error('kin_address') <span class="text-danger">{{$message}}</span> @enderror
                <textarea id="comments" class="form-control" name="kin_address" rows="4" cols="40" 
                placeholder="" maxlength="200" required>{{session('kin_address')}}</textarea>
                
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Occupation<span style="color: red;">*</span></label>
                @error('kin_occupation') <span class="text-danger">{{$message}}</span> @enderror

                <input class="form-control" type="text" value="{{session('kin_occupation')}}" name="kin_occupation" required>
               
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

 <button class="btn btn-outline-info float-right" type="submit">Next 
    <i class="far fa-arrow-alt-circle-right"></i></button> 
&nbsp;&nbsp;
</form>
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