
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
<h4 class="mb-sm-0"></h4>
@php 
    $ay = App\Models\Academicyear::where('status', 1)->get()
@endphp
<div class="page-title-right">
<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><i class="fas fa-bars"></i> &nbsp;&nbsp;Active Academic Years&nbsp;&nbsp; <i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
@foreach($ay as $academic) 
<a class="dropdown-item" href="{{route('view.cohorts')}}">{{$academic->ayear}} - {{$academic->month}} - {{$academic->description}}</a>
@endforeach

</div>
@php 
$campus = App\Models\Campus::all()
@endphp
<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><i class="fas fa-th"></i> &nbsp;&nbsp;Campuses&nbsp;&nbsp; <i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    @foreach($campus as $camp)
<a class="dropdown-item" href="#">{{$camp->campus}}</a>
    @endforeach
</div>


<ul class="breadcrumb m-0">
<a href="{{route('all.intake.categories')}}">
<li class="btn btn-secondary"><i class="fas fa-bars"></i>&nbsp;&nbsp;Intake Categories Description</li> &nbsp;
</a>
<a href="{{route('add.cohort')}}">
<li class="btn btn-secondary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Intake/Cohort</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a>
</ul>
</div>

</div>
</div>
</div>
<!-- end page title -->
        






        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    @php
                    $student = Auth::user()
                    @endphp
                    
                    @if(!empty($student->programclass))
                <h4 class="mb-sm-0 col-md-12" style="color: gray;">{{$student->fname}} {{$student->lname}} ({{$student->reg_num}}):<b style="color:#7196be;"> {{$student->programclass}} - Semester {{$student->semester}}</b> | {{$student->campus}} - Campus</h4> 
                  
                    @endif
                </div>
            </div>
        </div>
        <!-- end page title -->
       @php 
       $stuCourses = App\Models\Studentsubject::where('registration_no', $student->reg_num)->get()
       @endphp
        </div>



        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                                                <h4 class="mb-2">1452</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
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
                                                <p class="text-truncate font-size-14 mb-2">New Orders</p>
                                                <h4 class="mb-2">938</h4>
                                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
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
                                                <p class="text-truncate font-size-14 mb-2">New Users</p>
                                                <h4 class="mb-2">8246</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>  
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
                                                <p class="text-truncate font-size-14 mb-2">Unique Visitors</p>
                                                <h4 class="mb-2">29670</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
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
                                                        <th>CA1</th>
                                                        <th>Mid-Sem</th>
                                                        <th>Exam</th>
                                                        <th style="width: 120px;">Final Grade</th>
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
                                                        @if(!empty($subject->assessment1))
                                                        {{$subject->assessment1}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if(!empty($subject->assessment2))
                                                        {{$subject->assessment2}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if(!empty($subject->exam_grade))     
                                                        {{$subject->exam_grade}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if(!empty($subject->final_grade))
                                                        {{$subject->final_grade}}
                                                        @endif
                                                        </td>
                                                        <td>
                                                         <b>Pass</b>
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

