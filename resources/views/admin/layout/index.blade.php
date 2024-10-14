
@extends('admin.layout.master_layout')

@section('title','MCHS - Portal | Home')
@section('page')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <!-- start page title -->

        @php 
    $user = Auth::user();
    $lecturer = $user->id;
    $userid = $user->id;
    $myrole = $user->role;  // Corrected to access role from the $user object
    $myroleID = null;

    // Use standard PHP if statement within @php block
    if ($myrole == 'HOD' || $myrole == 'HOD-BASIC-LL' || $myrole == 'HOD-BASIC-BT' || $myrole == 'HOD-BASIC-ZA') {
        // Set the myroleID to some meaningful value based on your needs
        $myroleID = $user->id;  // Assuming you're assigning the user ID as the role ID, this could be changed based on your actual logic
    }

    $lecturersubj = App\Models\lecturerSubjects::where('userid', $userid)->count();

    // Query for HOD access based on myroleID
    if ($myroleID) {
        $HODaccess = App\Models\lecturerSubjects::where('access_level1', $myroleID)
            ->orWhere('access_level2', $myroleID)
            ->orWhere('access_level3', $myroleID)
            ->orWhere('access_level4', $myroleID)
            ->count();
    } else {
        $HODaccess = 0;
    }
@endphp
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
                <h4 class="mb-sm-0 col-md-6" style="color: gray;">MY ACCOUNT: ADMIN </h4> 

                    <div class="page-title-right">
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        </div>


        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Campuses</p>
                                                <h4 class="mb-2">3</h4>
                                               
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                <i class="fas fa-university font-size-24"></i>
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
                                                <p class="text-truncate font-size-14 mb-2">Faculties</p>
                                                <h4 class="mb-2">6</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                 <i class="fas fa-chalkboard-teacher font-size-24"></i>  
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
                                                <p class="text-truncate font-size-14 mb-2">Departments</p>
                                                <h4 class="mb-2">36</h4>
                                               
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                 <i class="fas fa-th font-size-24"></i> 
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
                                                <p class="text-truncate font-size-14 mb-2">Programmes</p>
                                                <h4 class="mb-2">66</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                <i class="fas fa-project-diagram font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div>
        </div>
                            
                                <div class="row">
                                <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                @php 
                                                $allstudents = App\Models\User::where('role', 'student')->count()
                                                @endphp
                                                <p class="text-truncate font-size-14 mb-2">Current Students</p>
                                                <h4 class="mb-2">{{$allstudents}}</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                     <i class="fas fa-graduation-cap font-size-24"></i> 
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                                </div>
                           

                            @if($lecturersubj)
                            
                            <div class="row">
                           
                                <div class="col-xl-3 col-md-6">
                                @if($lecturersubj > 0)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">Lecturer</p>
                                               <h5 class="mb-2">My Subjects</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                


                                                
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturersubj}}
                                                </span>
                                                </a>
                                                @else

                                                @endif
                                               
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                               
                            </div><!-- end col -->
                        @endif

                        @if($HODaccess)
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">HOD</p>
                                               <h5 class="mb-2">Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$HODaccess}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif
                        @if($user->role=='Dean')
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">Dean</p>
                                               <h5 class="mb-2">Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif
                       

                        
                        @if($user->role=='Campus Regitrar')
                        <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">Campus Registrar</p>
                                               <h5 class="mb-2">Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif
                        </div>
                        <!-- end row -->

                        <div class="row">

                        @if($user->role=='Principal')
                        <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">Principal</p>
                                               <h5 class="mb-2">Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif


                        @if($user->role=='DCR')
                        <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">DCR</p>
                                               <h5 class="mb-2">Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif
                        <!-- end row -->
                        
                            
                       
                        @if($user->role=='College Registrar')
                        <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">College Registrar</p>
                                               <h5 class="mb-2"> Review Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif
                         
                        @if($user->role=='Executive Director')
                                <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">ED</p>
                                               <h5 class="mb-2">Approve Course Grades</h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                

                                                @if($lecturer)
                                                @php 
                                                $lecturerCourses = App\Models\lecturerSubjects::where('userid', $lecturer)->count()
                                                @endphp
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                {{$lecturerCourses}}
                                                </span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif

                        </div> <!-- end row -->


        <div class="row">
       
   
        </div><!-- end row -->

       
        <!-- end row -->

        <!-- row here -->

        <!-- end row -->
    </div>
    
</div>

@endsection

