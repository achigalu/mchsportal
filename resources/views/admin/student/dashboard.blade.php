
@extends('admin.layout.master_layout')

@section('title','MCHS - Portal | Student Home')
@section('page')


<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
                               <!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
@php 
    $ay = App\Models\Academicyear::where('status', 1)->get()
@endphp

</div>
</div>
<!-- end page title -->
        






        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

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

                    @php
                    $student = Auth::user();
                   
                    $myExamNO = App\Models\savedExamNumbers::where('reg_num', $student->reg_num)->first();
                  
                    $ay = App\Models\Academicyear::find($student->academicyear_id);
                    $classcode = $student->programclass;
                    $stuFeesObj = App\Models\Programclass::where('classcode', $classcode)->first();

                    $feecategory = $stuFeesObj->feecategory_id;
                    $stuFees = App\Models\Feecategory::where('id', $feecategory)->first();
                    @endphp
                    
                    @if(!empty($student->programclass))
                <h4 class="mb-sm-0 col-md-12" style="color: gray;">{{$student->fname}} {{$student->lname}} ({{$student->reg_num}}):<b style="color:#7196be;"> {{$student->programclass}} | {{$ay->ayear}} {{$ay->month}} * {{$ay->description}} | Semester {{$student->semester}}</b> | {{$student->campus}} - Campus</h4> 
                  
                    @endif

                </div>

            </div>
        </div>

        <!-- end page title -->
       @php 
       $stuCourses = App\Models\Studentsubject::where('registration_no', $student->reg_num  )->get();
       $courseCount = $stuCourses->count();
       $hasFinalGradeOne = $stuCourses->contains('access_final_grade', 1);
       @endphp
        </div>



        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">My fees balance</p>
                                                @if(!empty($stuFees))
                                               
                                                @if($stuFees->local_fee > 0)
                                                <h4 class="mb-2">MK {{$stuFees->local_fee}}</h4>
                                                @endif

                                                @if($stuFees->foreign_fee > 0)
                                                <h4 class="mb-2">$ {{$stuFees->foreign_fee}}</h4>
                                                @endif

                                                @endif
                                               
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>View fee details</span></p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                           
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Examination#:</p>
                                                @if($myExamNO)
                                                    @if($myExamNO->fee_status == 1)
                                                        <span class="text-danger fw-bold fs-5 me-2">
                                                            {{$myExamNO->exam_number}}
                                                        </span>
                                                    @elseif($myExamNO->fee_status == 0)
                                                        <span class="text-danger fw-bold fs-5 me-2">
                                                            Visit Accounts
                                                        </span>
                                                    @endif  
                                                @else
                                                    <span class="text-danger fw-bold fs-5 me-2">
                                                        Exam# not set
                                                    </span>
                                                @endif  
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>View more details</span></p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                <i class="fas fa-folder-open font-size-24"></i>
                                                
                                                </span>
                                            </div>
                                        </div> 
                                                                                   
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Time Table</p>
                                                <h5 class="mb-2">{{$student->programclass}} | Semester: {{$student->semester}}</h5>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>View more details</span></p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                <i class="far fa-calendar-alt font-size-24"></i>
                                                
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Registration</p>
                               
                                                <h6 class="mb-2">
                                                    
                                                    @if($student->registered == 0)
                                                    <div style="display: flex; align-items: center;">
                                                        <span class="text-danger fw-bold">Not Registered: {{$student->programclass}} | {{$student->semester}}</span>
                                                        
                                                        <!-- condition for displaying Register button based on semester set -->
                                                     <!-- Trigger Modal (Avatar inside Anchor Tag) -->
                                                    @php 
                                                    $semester = App\Models\Semester::where('academicyear_id', Auth::user()->academicyear_id)->where('semester', Auth::user()->cum_semester)->first();
                                                    @endphp
                                                    @if(Carbon\Carbon::now()->isBetween(Carbon\Carbon::parse($semester->rsdate), Carbon\Carbon::parse($semester->redate)))
                                                    <a href="javascript:void(0);" id="avatar-trigger">
                                                        <div class="avatar-sm" style="margin-left: 10px;">
                                                        <span class="avatar-title text-danger rounded-3" style="background-color: #f7d4a1;">
                                                            <i class="fas fa-registered font-size-24"></i>
                                                        </span>
                                                        </div>
                                                    </a>
                                                    @else
                                                    Registration closed..
                                                    @endif

                                                    <!-- Modal (Hidden initially) -->
                                                    <div id="myModal" class="modal">
                                                    <div class="modal-content">
                                                        <span class="close-btn">&times;</span>
                                                        <h4 class="text-primary fw-bold">Class Registration</h4>
                                                        <p class="text-muted">Registration for {{$student->programclass}} | {{$student->semester}} is now open.</p>
                                                        <p class="text-danger">Registration closes on 23 March 2025</p>
                                                        <a href="{{route('student.registration')}}">
                                                        <button class="btn btn-warning w-100">Register</button>
                                                        </a>
                                                    </div>
                                                    </div>
                                                    <!-- end modal -->

                                                    <!-- End condition for displaying Register button based on semester set -->
                                                    </div>
                                                    @endif
                                                    @if($student->registered == 1)
                                                    <span class="text-warning fw-bold">Pending Confirmation: {{$student->programclass}} | {{$student->semester}}</span><br>
                                                    <span class="text-success fw-bold font-size-12 me-2">Your HOD needs to approve</span>
                                                    @endif
                                                    @if($student->registered == 2)
                                                    <span class="text-success fw-bold">Registered: {{$student->programclass}} | {{$student->semester}}</span>
                                                    @endif
                                              
                                                </h6>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i></span></p>
                                            </div>
                                            
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        
                        <!-- end row -->
    
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="background-color:antiquewhite; padding: 10px;">
                                               

                                                @if ($hasFinalGradeOne) 
                                                
                                                <a href="{{route('download.student.semester.report')}}" class="dropdown-item"><i class="fas fa-file-pdf" style="color:red;" ></i>&nbsp;&nbsp;Download Semester Grades Report</a>
                                                @else 
                                                <h6>Downloadable school report will be provided here once results are out.</h6>
                                                @endif
                                                <!-- item
                                                
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-file-pdf" style="color:gray;" ></i>&nbsp;&nbsp;View all grades</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-file-pdf" style="color:gray;" ></i>&nbsp;&nbsp;My transcrpt</a>
                                                -->
                                            </div>
                                        </div>
                                        
                                        @if($hasFinalGradeOne)
                                        <h4 class="card-title mb-4">MY COURSES ( {{$courseCount}} )</h4><h5 style="color:red";>NOTE: *With these results, please refer to the curriculum or consult HOD for more.*</h5>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                                <thead class="table-light">
                                                    <tr style="background-color:#494848 ;">
                                                        <th style="width: 10px;">S/N</th>
                                                        <th><strong>COURSE CODE</strong></th>
                                                        <th>COURSE NAME</th>
                                                        <th>CA(%)</th>
                                                        <th>MID-SEM-EXAM(%)</th>                                                      
                                                        <th style="width: 120px;">FINAL GRADE(%)</th>
                                                        <th style="width: 120px;">REMARK</th>
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                      


                                            @if(!empty($stuCourses))
                                            @php 
                                            $i = 0
                                            @endphp
                                                    @foreach($stuCourses as $subject)
                                                    <tr>
                                                        <td style="width: 10px;"><h6 class="mb-0">{{++$i}}</h6></td>
                                                        <td>{{$subject->course_code}}</td>
                                                        <td>
                                                        @php 
                                                        $course = App\Models\Course::where('code', $subject->course_code)->first()
                                                        @endphp
                                                        
 
                                                        @if(!empty($course))
                                                        {{$course->name}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                            
                                                        @if($subject->access_assessment1==1)
                                                        {{$subject->assessment1}}
                                                        @else
                                                        --
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->access_assessment2==1)
                                                        {{$subject->assessment2}}
                                                        @else
                                                        --
                                                        @endif
                                                        </td>
                                                       
                                                        <td>
                                                        @if($subject->access_final_grade==1)
                                                        {{$subject->final_grade}}
                                                        @else
                                                        --
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->access_final_grade == 1)
                                                        @if($subject->final_grade >= 50)
                                                            <b style="color: green;">Pass</b>
                                                        @elseif(is_null($subject->final_grade))
                                                            <b style="color: gray;">--</b>
                                                        @elseif($subject->final_grade < 30)
                                                            <b style="color: red;">Repeat</b>
                                                        @elseif($subject->final_grade >= 30 && $subject->final_grade < 50)
                                                            <b style="color: orange;">Sup</b>
                                                        @endif
                                                        @else 
                                                        --
                                                        @endif
                                                        </td>
                                                        </tr>
                                                       
                                                        
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                     <!-- end -->
                                                     
                                                     <!-- end -->
                                                </tbody><!-- end tbody -->
                                            </table> <!-- end table -->
                                        </div>
                                    </div><!-- end card -->
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                           
                        </div>
                        <!-- end row -->
    </div>
    
</div>

<!-- Optional: Style for Modal and Avatar -->
<style>
/* Modal styles */
.modal {
  display: none; /* Hidden by default */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Background overlay */
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

/* Modal Content */
.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 80%;
  max-width: 500px;
  position: relative;
}

/* Close Button (×) */
.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

/* Avatar Styles */
.avatar-sm {
  display: inline-block;
  cursor: pointer;
  margin-left: 10px;
}

.avatar-title {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  font-size: 24px;
}

/* Button Styles (Optional for the link inside modal) */
.fb-link {
  color: #4CAF50;
  text-decoration: none;
}
.fb-link:hover {
  text-decoration: underline;
}
</style>

<!-- JavaScript to handle Modal functionality -->
<script>
// Get the modal, close button, and the avatar trigger
var modal = document.getElementById("myModal");
var btn = document.getElementById("avatar-trigger");
var closeBtn = document.getElementsByClassName("close-btn")[0];

// When the avatar is clicked, open the modal
btn.onclick = function() {
  modal.style.display = "flex"; // Show the modal
};

// When the close button (×) is clicked, close the modal
closeBtn.onclick = function() {
  modal.style.display = "none"; // Hide the modal
};

// When the user clicks anywhere outside the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none"; // Hide the modal if clicked outside
  }
};
</script>


@endsection


