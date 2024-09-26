
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
                    @php
                    $student = Auth::user()
                    @endphp

                    @php 
                    $myExamNO = App\Models\savedExamNumbers::where('reg_num', $student->reg_num)->first()
                    @endphp

                    @php 
                    $ay = App\Models\Academicyear::find($student->academicyear_id)
                    @endphp
                    
                    @if(!empty($student->programclass))
                <h4 class="mb-sm-0 col-md-12" style="color: gray;">{{$student->fname}} {{$student->lname}} ({{$student->reg_num}}):<b style="color:#7196be;"> {{$student->programclass}} | {{$ay->ayear}} {{$ay->month}} * {{$ay->description}} | Semester {{$student->semester}}</b> | {{$student->campus}} - Campus</h4> 
                  
                    @endif
                </div>
            </div>
        </div>
        <!-- end page title -->
       @php 
       $stuCourses = App\Models\Studentsubject::where('registration_no', $student->reg_num  )->get()
       @endphp
        </div>



        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">My fees balance</p>
                                                <h4 class="mb-2">MK {{$fees->local_fee}}</h4>
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
                                                @if($myExamNO->fee_status==1)
                                                <span class="text-danger fw-bold fs-5 me-2">
                                                {{$myExamNO->exam_number}}
                                                </span>
                                                   

                                                    @else
                                                    <span class="text-danger fw-bold fs-5 me-2">
                                                    Not eligible
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
                               
                                                <h5 class="mb-2">{{$student->programclass}} | Semester: {{$student->semester}}</h5>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>View more details</span></p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                <i class="fas fa-registered font-size-24"></i>
                                                
                                                </span>
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
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            </div>
                                        </div>
    
                                        <h4 class="card-title mb-4">MY COURSES</h4>
    
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 10px;">#</th>
                                                        <th>Code</th>
                                                        <th>Course Name</th>
                                                        <th>CA1(%)</th>
                                                        <th>Mid-Sem(%)</th>
                                                        <th>End-Sem-Exam(%)</th>
                                                        <th style="width: 120px;">Final Grade(%)</th>
                                                        <th style="width: 120px;">Remark</th>
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
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->access_assessment2==1)
                                                        {{$subject->assessment2}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->access_exam_grade==1)   
                                                        {{$subject->exam_grade}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->access_final_grade==1)
                                                        {{$subject->final_grade}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($subject->remark)
                                                        <b>Pass</b>
                                                        @else
                                                         <b></b>
                                                         @endif
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

@endsection

