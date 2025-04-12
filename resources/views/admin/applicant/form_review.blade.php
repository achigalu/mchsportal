
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
                                    <h4 class="mb-sm-0" style="color:#7196be;">Course Application Review

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
                    <h4 class="card-title mb-4"><b>PERSONAL DETAILS &nbsp;&nbsp; - &nbsp;&nbsp;Form:&nbsp;&nbsp; </b>
                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next1.jpg')}}" alt="logo-light" height="50">
                    </span>
                    </h4>

    <h5>Bio Information</h5><p></p>
    <div class="row">
    
<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">FirstName: &nbsp; </label>  <br>
            <b style="color: black;">{{session('fname')}}</b>     
        </div>   
</div>

<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">Initials/MiddleName<span style="color: red;"></span></label><br>
            <b style="color: black;">{{session('initials')}}</b>
           
        </div>   
</div>

<div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label">SurName<span style="color: red;"></label><br>
           <b style="color: black;">{{session('lname')}}</b>
           
        </div>   
</div>

<!--- input row end-->
    
    <div class="col-lg-4">
        
            <div class="mb-3">
                <label class="form-label">Sex<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('sex')}}</b>
            </div>
            
    </div>


    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Age<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('age')}}</b>
               
            </div>   
    </div>
 
    <div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Date of birth<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('dbirth')}}</b>
            </div>
            
    </div>

   <!--- input row end--> 


        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Marital Status: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('marital')}}</b>

            </div>  
        </div>

 

        <div class="col-lg-8">
            <div class="mb-3">
                <label class="form-label">Home District: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('district')}}</b>

            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">T/A: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('traditional')}}</b>
            </div>  
        </div>

        <div class="col-lg-8">
            <div class="mb-4">
                <label class="form-label">Village: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('village')}}</b>
            </div>  
        </div>

        <br><br><p>
            <h5>Contact Information</h5>
            <hr style="color:skyblue">
            <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('student_phone1')}}</b>
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone (Optional): </label>
                <b style="color: black;">{{session('student_phone2')}}</b>
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email (Optional): </label>
                <b style="color: black;">{{session('student_email')}}</b>
          </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Contact Address <span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('student_address')}}</b>
        </div>   
    </div>

    <br><br><p>
            <h5>Next of KIN</h5>
            <hr style="color:skyblue">
    
        <div class="col-lg-6">
                <label class="form-label">Full Name: <span style="color: red;"></span></label> 
                <b style="color: black;">{{session('kin_fullname')}}</b>
             </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Relationship: <span style="color: red;"></span></label>
                <b style="color: black;">{{session('relationship')}}</b>
            </div>       
 </div>


        <p>
 
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Phone: </label>
                <b style="color: black;">{{session('kin_phone')}}</b>
            </div>
            
        </div>
 
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Email (Optional): </label>
                <b style="color: black;">{{session('kin_email')}}</b>
            </div>
            
        </div>
        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Postal Address: <span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('kin_address')}}</b>   
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Occupation<span style="color: red;"></span></label>
                <b style="color: black;">{{session('kin_occupation')}}</b>
            </div>
            
    </div><br><br>

    <h4 class="card-title mb-4">ACADEMIC QUALIFICATIONS &nbsp;&nbsp; - &nbsp;&nbsp;Form:&nbsp;&nbsp; 

                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next2.jpg')}}" alt="logo-light" height="50">
                    </span>
    </h4>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Academic qualification(s): <span style="color: red;"> MSCE, GCE or Other (please specify)</span>  </label>
                <b style="color: black;">{{session('qualification')}}</b>
            </div>   
    </div>
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Certificate Number: <span style="color: red;"></span>  </label>
                <b style="color: black;">{{session('certificate_no')}}</b>  
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Year Obtained<span style="color: red;"></span>  </label>
                <b style="color: black;">{{session('msce_year')}}</b>     
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">School Attended<span style="color: red;"></span>  </label>
                <b style="color: black;">{{session('school_attended')}}</b> 
            </div>   
    </div>

    <div class="col-lg-7">
            <div class="mb-4">
                <label class="form-label">Postal/Physical Address<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('school_address')}}</b>                
            </div>   
    </div>
 
    <p> <h5>Subjects</h5></p>
    <hr style="color:#dcccc8">

    <br><p></p>
    <div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">English: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('english_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Mathematics: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('maths_grade')}}</b>  
    </div>
</div>

    <div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Biology: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('biology_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Physical Science: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('pscience_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Physics: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('physics_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Chemistry: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('chemistry_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Agriculture: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('agriculture_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Geography: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('geography_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Chichewa: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('chichewa_grade')}}</b>  
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">History: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('history_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Bible Knowledge: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('bk_grade')}}</b>  
    </div>
</div>
<!-- added subjects -->
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">General Science: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('gs_grade')}}</b>  
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Home Economics: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('home_grade')}}</b>  
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Social Studies: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('social_grade')}}</b>  
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Life Skills: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('lifes_grade')}}</b>  
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Business Studies: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('bs_grade')}}</b>  
    </div>
</div>
<!-- end of added subjects -->

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Computer Studies: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('computer_grade')}}</b>  
    </div>
</div>

<div class="col-lg-3">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Additional Mathematics: <span style="color: red;"></span></label>
         <b style="color: black;">{{session('admath_grade')}}</b>  
    </div>
</div>

<div class="col-lg-5">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">Other Subjects:<span style="color: red;"></span></label>
        <b style="color: black;">{{session('other_subjects')}}</b> 
    </div>
</div>

<div class="col-lg-4">
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label mr-3">An aggregate of Best Six Subjects including English: <span style="color: red;"></span></label>
        <b style="color: black;">{{session('aggregate_grade')}}</b> 
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
                <label class="form-label">Professional Certificates<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('pcertificate')}}</b> 
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Year Obtained<span style="color: red;"></span>  </label><br>
                <b style="color: black;">{{session('pyear')}}</b>  
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">College<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('pcollege')}}</b> 
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Occupation ( Current )<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('occupation')}}</b> 
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Employer<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('employer')}}</b> 
            </div>    
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Workplace<span style="color: red;"></span></label><br>
                <b style="color: black;">{{session('workplace')}}</b> 
            </div>    
    </div>

<br>
<p></p>
<h5 style="display: inline;">Courses of Admission
<p style="display: inline; margin: 0;">
    
        <small style="color: red; display: inline;"></small>
    </h5>
</p> <hr style="color:#dcccc8">


@php 
$programs = App\Models\Program::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 22])->get();
@endphp
    
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">First Choice<span style="color: red;"></span></label><br>
                @php 
                $program1 = App\Models\Program::find(session('choice1_program_id'));
                $program2 = App\Models\Program::find(session('choice2_program_id'));
                $program3 = App\Models\Program::find(session('choice3_program_id'));
                @endphp
                <b style="color: black;">{{$program1->program_name}}</b> 
            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Second Choice<span style="color: red;"></span></label><br>
                <b style="color: black;">{{$program2->program_name}}</b> 
            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Third Choice<span style="color: red;">*</span></label><br>
                <b style="color: black;">{{$program3->program_name}}</b> 
            </div>  
        </div>

        <br>
<p></p>
<h5 style="display: inline;">How do you intend to pay fees? 
<p style="display: inline; margin: 0;">
    
        <small style="color: red; display: inline;"></small>
    </h5>
</p> <hr style="color:#dcccc8">

<div class="col-lg-4">
    <div class="mb-3">
        <label class="form-label">Fees will be paid by:<span style="color: red;">*</span></label>
        <b style="color: black;">{{session('parent_guardian')}}</b> 

   </div>
</div>

<div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Sponsor <span style="color: red;">( name of sponsor )</span></label><br>
                <b style="color: black;">{{session('fee_sponsor')}}</b> 
                
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-4">
                <label class="form-label">Any other<span style="color: red;">( Specify )</span></label><br>
                <b style="color: black;">{{session('fee_other')}}</b> 
                
            </div>   
    </div><br><br><hr>

    <h4 class="card-title mb-4">UPLOADDED DOCUMENTS &nbsp;&nbsp; - &nbsp;&nbsp;Form:&nbsp;&nbsp; 
                    <span class="logo-lg">
                    <img src="{{asset('assets/images/next3.jpg')}}" alt="logo-light" height="50">
                    </span>
    </h4>
    <hr style="color:#dcccc8">



    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Copy of MSCE or Equivalent:<span style="color: red;">
                    @if(session()->has('msce_copy')) 
                    <span style="color: green;">YES</span>
                    @else 
                        <span style="color: red;">NO</span>
                    @endif
                </span></label>

            </div>
            
    </div>

    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Curriculum Vitae:<span style="color: red;">
                @if(session()->has('cv')) 
                    <span style="color: green;">YES</span>
                @else 
                    <span style="color: red;">NO</span>
                @endif
                </span></label>

            </div>
            
    </div>



    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Copy of bank deposit slip:<span style="color: red;">
                @if(session()->has('bank_slip')) 
                    <span style="color: green;">YES</span>
                @else 
                    <span style="color: red;">NO</span>
                @endif
                </span></label>
                

            </div>
            
    </div>

    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Copy of professional certificate(s):<span style="color: red;">
                @if(session()->has('copy_pcertificate')) 
                    <span style="color: green;">YES</span>
                @else 
                    <span style="color: red;">NO</span>
                @endif
                </span></label>

            </div>
            
    </div>

    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Copy of recognized ID:<span style="color: red;">
                @if(session()->has('copy_id')) 
                    <span style="color: green;">YES</span>
                @else 
                    <span style="color: red;">NO</span>
                @endif
                </span></label>

            </div>
            
    </div>

    <div class="col-lg-12">
            <div class="mb-4">
                <label class="form-label">Copy of professional body registration:<span style="color: red;">
                @if(session()->has('pregistration')) 
                    <span style="color: green;">YES</span>
                @else 
                    <span style="color: red;">NO</span>
                @endif
                </span></label>


            </div>
            
    </div>


 </div>

&nbsp;&nbsp;
<div class="d-flex justify-content-end gap-3">
    <a href="{{ route('applicant.get.form3') }}" class="btn btn-outline-secondary">
      Back <i class="far fa-arrow-alt-circle-left"></i>
    </a>

   
    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#myModal" type="submit">
      Submit <i class="far fa-paper-plane"></i>
    </button>
 

</div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-4 col-xl-3">
    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">APPLICATION SUBMISSION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="mb-3">At this point, be assured that the information you have provided is accurate and complete.</p>
                    <h5 class="text-danger">Note</h5>
                    <p>Once you submit, you will not be able to edit again.</p>
                    <p>Make sure everything is correct before proceeding.</p>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{route('reviewed.form.data')}}" class="btn btn-primary">Submit</a>
                </div>
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /.modal -->
</div>

<style>
    /* Modal Button Hover Effects */
.modal-footer .btn:hover {
    opacity: 0.85;
    transform: scale(1.05);
    transition: all 0.3s ease;
}

/* Enhance the modal title */
.modal-title {
    font-weight: bold;
    font-size: 1.25rem;
}

/* Optional: Add a subtle gradient to the modal body */
.modal-body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 10px;
}

/* Optional: Add custom font for the modal */
body {
    font-family: 'Arial', sans-serif;
}
</style>






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