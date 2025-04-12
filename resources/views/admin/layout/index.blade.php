
@extends('admin.layout.master_layout')

@section('title','MCHS - Students Portal | Home')
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

    
    $allstudentsLL = App\Models\User::where('role', 'student')->where('campus', 'Lilongwe')->count();
    $allstudentsBT = App\Models\User::where('role', 'student')->where('campus', 'Blantyre')->count();
    $allstudentsZA = App\Models\User::where('role', 'student')->where('campus', 'Zomba')->count();
    

    $lecturersubj = App\Models\lecturerSubjects::where('userid', $userid)->count();


    // ------ NOT IN USE NOW -------
    // Use standard PHP if statement within @php block
    if ($myrole == 'HOD' || $myrole == 'HOD-BASIC') {
        // Set the myroleID to some meaningful value based on your needs
        $myroleID = $user->id;  // Assuming you're assigning the user ID as the role ID, this could be changed based on your actual logic
    }

    

    // Query for HOD access based on myroleID
    if ($myroleID) {
        $HODaccess = App\Models\lecturerSubjects::where(function ($query) use ($myroleID) {
                $query->where('access_level1', $myroleID)
                      ->orWhere('access_level2', $myroleID)
                      ->orWhere('access_level3', $myroleID)
                      ->orWhere('access_level4', $myroleID);
            })
            ->where('userid', '!=', $myroleID) // Exclude courses where userid is $myroleID
            ->distinct()
            ->pluck('courseid')
            ->count();
    } else {
        $HODaccess = 0;
    }

    // ------ NOT IN USE NOW -------
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
<a class="dropdown-item" href="#">{{$academic->ayear}} - {{$academic->month}} - {{$academic->description}}</a>
@endforeach

</div>
@php 

$campus = App\Models\Campus::all();
$faculties = App\Models\Faculty::all()->count();
$departmentsall = App\Models\Department::all();
$departmentscount = $departmentsall->count();
$programs = App\Models\Program::all();

                                               
@endphp


<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><i class="fas fa-th"></i> &nbsp;&nbsp;College Campuses&nbsp;&nbsp; <i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    @foreach($campus as $camp)
<a class="dropdown-item" href="{{url('/all/campuses')}}">{{$camp->campus}}</a>
    @endforeach
</div>
@can('college setup')

<ul class="breadcrumb m-0">
<a href="{{route('all.intake.categories')}}">
<li class="btn btn-secondary"><i class="fas fa-bars"></i>&nbsp;&nbsp;Intake Categories Description</li> &nbsp;
</a>
<a href="{{route('add.cohort')}}">
<li class="btn btn-secondary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Intake/Cohort</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a>
</ul>
@endcan
</div>

</div>
</div>
</div>
</div>

<!-- end page title -->
        

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 col-md-6" style="color: gray;">{{Auth::user()->fname}} {{Auth::user()->lname}} : {{ Auth::user()->role }} | {{Auth::user()->campus}}</h4> 

                    <div class="page-title-right">
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        </div>

 <!-- FOR CENTRAL OFFICE ONLY -->
@if (Auth::user()->role == 'Executive Director' || Auth::user()->role == 'College Registrar' || Auth::user()->role == 'Accounts Clerk'
|| Auth::user()->role == 'DCR-Administration' || Auth::user()->role == 'DCR-Academic' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Administrator' || Auth::user()->role == 'Finance Manager'|| Auth::user()->role == 'Accountant')
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
                                                <a href="{{route('view.faculty')}}">
                                                <p class="text-truncate font-size-14 mb-2">Faculties</p>
                                               
                                                <h4 class="mb-2">{{$faculties}}</h4>
                                               
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                 <i class="fas fa-chalkboard-teacher font-size-24"></i>  
                                                </span>
                                            </div>
                                            </a>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                               <a href="{{route('view.all.departments')}}">
                                                <p class="text-truncate font-size-14 mb-2">Departments</p>
                                                <h4 class="mb-2">{{$departmentscount}}</h4>
                                             
                                               
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                 <i class="fas fa-th font-size-24"></i> 
                                                </span>
                                            </div>
                                            </a>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                @php 
                                                $programs = App\Models\Program::count();
                                                @endphp
                                                <a href="{{route('view.program')}}">
                                                <p class="text-truncate font-size-14 mb-2">Programmes</p>
                                                <h4 class="mb-2">{{$programs}}</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                <i class="fas fa-project-diagram font-size-24"></i>  
                                                </span>
                                            </div></a>
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
                                                <p class="text-truncate font-size-14 mb-2">Total | All Students</p>
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
             
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Students | Lilongwe Campus</p>
                                                <h4 class="mb-2">{{$allstudentsLL}}</h4>
                                                
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

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Students | Blantyre Campus</p>
                                                <h4 class="mb-2">{{$allstudentsBT}}</h4>
                                                
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


                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Students | Zomba Campus</p>
                                                <h4 class="mb-2">{{$allstudentsZA}}</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                     <i class="fas fa-graduation-cap font-size-24"></i> 
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                    </div>

@endif

<!-- FOR CAMPUS PRINCIPAL, CAMPUS REGISTRAR -->

@if (Auth::user()->role == 'Principal' || Auth::user()->role == 'Campus Registrar' || Auth::user()->role == 'Deputy Dean' 
|| Auth::user()->role == 'DoS' || Auth::user()->role == 'Dean' || Auth::user()->role == 'Lecturer' || Auth::user()->role == 'HOD' || Auth::user()->role == 'HOD-BASIC')

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
                                            <a href="{{route('view.faculty')}}">
                                                <p class="text-truncate font-size-14 mb-2">All Faculties</p>
                                                @php 
                                                $faculties = App\Models\Faculty::count()
                                                @endphp
                                                <h4 class="mb-2">{{$faculties}}</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                 <i class="fas fa-chalkboard-teacher font-size-24"></i>  
                                                </span>
                                                </a>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                             @php
                                            $userCampus = Auth::user()->campus;
                                            $campusMapping = [
                                                'Lilongwe' => 1,
                                                'Blantyre' => 2,
                                                'Zomba' => 3,
                                            ];
                                            
                                            $campus_id = $campusMapping[$userCampus] ?? null;

                                            $filteredDepartments = $departmentsall->where('campus_id', $campus_id)->count();
                                            @endphp
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                           
                                            <a href="{{route('view.all.departments')}}">
                                            <p class="text-truncate font-size-14 mb-2">Departments | {{$userCampus}}</p>
                                            <h4 class="mb-2">{{$filteredDepartments}}</h4>

                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                 <i class="fas fa-th font-size-24"></i> 
                                                </span>
                                            </a>
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
                                                @php 
                                           
                                            $userCampus = Auth::user()->campus;
                                            $campusMapping = [
                                                'Lilongwe' => 1,
                                                'Blantyre' => 2,
                                                'Zomba' => 3,
                                            ];
                                            
                                            $campus_id = $campusMapping[$userCampus] ?? null;

                                            $programs = $programs->where('campus_id', $campus_id)->count();
                                           
                                            @endphp
                                            <a href="{{route('view.program')}}">
                                            <p class="text-truncate font-size-14 mb-2">Programmes | {{$userCampus}}</p>
                                            <h4 class="mb-2">{{$programs}}</h4>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                <i class="fas fa-project-diagram font-size-24"></i>  
                                                </span>
                                                </a>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div>
        </div>   
        

                    <div class="row">
                           @if(Auth::user()->role != 'Lecturer' && Auth::user()->role != 'HOD-BASIC' && Auth::user()->role != 'HOD')
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                @if (Auth::user()->campus == 'Lilongwe')
                                                <p class="text-truncate font-size-14 mb-2">Students | Lilongwe</p>
                                                <h4 class="mb-2">{{$allstudentsLL}}</h4>
                                                @endif
                                                @if (Auth::user()->campus == 'Blantyre')
                                                <p class="text-truncate font-size-14 mb-2">Students | Blantyre</p>
                                                <h4 class="mb-2">{{$allstudentsBT}}</h4>
                                                @endif
                                                @if (Auth::user()->campus == 'Zomba')
                                                <p class="text-truncate font-size-14 mb-2">Students | Zomba</p>
                                                <h4 class="mb-2">{{$allstudentsZA}}</h4>
                                                @endif
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
                    
                        @endif

@if($lecturersubj > 0) 
        
        
                           
                            <div class="col-xl-3 col-md-6">
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2"></p>
                                               <h5 class="mb-2 text-primary">My Modules</h5></a>                                              
                                            </div>
                                            <div class="avatar-sm">
                                                <a href="{{route('lecturer.courses', $lecturer)}}">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                {{$lecturersubj}}
                                                </span>
                                                </a>
                                               
                                               
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div>
                                  
            
            @else

            @endif


            @if($user->role=='HOD-BASIC')
                        
                             
                            
                   
                                               <div class="col-xl-3 col-md-6">
                                                   <div class="card">
                                                       <div class="card-body">
                                                           <div class="d-flex">
                                                               <div class="flex-grow-1">
                                                               <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                                   <p class="text-truncate font-size-14 mb-2"></p>
                                                                  <h5 class="mb-2 text-info">HOD Review</h5></a>
                                                                   
                                                               </div>
                                                               <div class="avatar-sm">
                                                                <!--
                                                                @php
                                                               $coordinatorId = auth()->id(); // Logged-in coordinator

                                                                    $subjects = \App\Models\lecturerSubjects::whereIn('classid', function ($query) use ($coordinatorId) {
                                                                        $query->select('id')
                                                                            ->from('programclasses')
                                                                            ->where('coordinator', $coordinatorId);
                                                                    })
                                                                    ->select('classid', 'courseid', 'semester', 'campus_id') // Select only unique identifiers
                                                                    ->distinct() // Ensure uniqueness
                                                                    ->get();
                                                                    @endphp
                                        -->
                                                                   @if($subjects)
                                                                   
                                                                   <a href="{{route('hod.review.assessments', $lecturer)}}">
                                                                   <span class="avatar-title bg-light text-primary rounded-3">
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
                                           @if($user->role=='HOD')
                            
                                               <div class="col-xl-3 col-md-6">
                                                   <div class="card">
                                                       <div class="card-body">
                                                           <div class="d-flex">
                                                               <div class="flex-grow-1">
                                                               <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                                   <p class="text-truncate font-size-14 mb-2"></p>
                                                                   <h5 class="mb-2 text-primary">My Modules</h5></a>
                                                                   
                                                               </div>
                                                               <div class="avatar-sm">
                                                                   
                   
                                                                   @php 
                                                                   $lecturerCourses = App\Models\lecturerSubjects::where('userid', $userid)->count()
                                                                   @endphp
                                                                   <a href="{{route('lecturer.courses', $lecturer)}}">
                                                                   <span class="avatar-title bg-light text-primary rounded-3">
                                                                   {{$lecturerCourses}}
                                                                   </span>
                                                                   </a>
                                                                  
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
                                                               <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                                   <p class="text-truncate font-size-14 mb-2"></p>
                                                                   
                                                                  <h5 class="mb-2 text-info">HOD Review</h5></a>
                                                                   
                                                               </div>
                                                               <div class="avatar-sm">
                                                                   
                   
                                                                   @if($lecturer)
                                                                   
                                                                   <a href="{{route('hod.review.assessments', $lecturer)}}">
                                                                   <span class="avatar-title bg-light text-primary rounded-3">
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
                   
            <!-- REGISTRATION LOGIC -->                             
            @if($user->role=='HOD' || $user->role=='HOD-BASIC')
               
            
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('students.confirm.registration', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2"></p>
                                               <h5 class="mb-2 text-warning">Pending Confirmation </h5></a>
                                                
                                            </div>
                                            <div class="avatar-sm">
                                            @php
                                            $pendingRegBasicLL = App\Models\User::whereIn('programclass', [
                                                'DCM1', 'DR1', 'DPH1', 'DEH1', 'DOT1', 'DBMS1', 'DDT1'
                                            ])
                                            ->whereIn('semester', [1, 2])
                                            ->where('registered', 1)->where('campus_id',1)
                                            ->count();


                                            $pendingRegBasicBT = App\Models\User::whereIn('programclass', [
                                                'DCM1', 'UDCM1', 'DRN1', 'UDRN1', 'DCA1', 'ENT1', 'ORTHOP1'
                                            ])
                                            ->whereIn('semester', [1, 2])
                                            ->where('registered', 1)->where('campus_id',2)
                                            ->count();

                                            $pendingRegHOD = App\Models\Department::where('user_id', Auth::user()->id)->first();
                                            @endphp
                                                @if(Auth::user()->campus == 'Lilongwe' && Auth::user()->role == 'HOD-BASIC')
                                                <a href="{{route('students.confirm.registration', $lecturer)}}">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                {{$pendingRegBasicLL}}
                                                </span>
                                                </a>
                                                @endif

                                                @if(Auth::user()->campus == 'Blantyre' && Auth::user()->role == 'HOD-BASIC')
                                                <a href="{{route('students.confirm.registration', $lecturer)}}">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                {{$pendingRegBasicBT}}
                                                </span>
                                                </a>
                                                @endif

                                                @if(Auth::user()->role == 'HOD')
                                                <a href="{{route('students.confirm.registration', $lecturer)}}">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                @php
                                                // Get the programs associated with the current user
                                                    $programHOD = App\Models\Program::where('department_id', Auth::user()->department_id)->get();

                                                    // Initialize the total student count
                                                    $totalStudentCount = 0;

                                                    // Loop through each program and count the students
                                                    foreach ($programHOD as $program) {
                                                        $totalStudentCount += App\Models\User::where('program_id', $program->id)
                                                            ->where('registered', 1) // assuming you want only pending registration students
                                                            ->count();
                                                    }

                                                @endphp
                                                {{$totalStudentCount}}
                                                </span>
                                                </a>
                                                @endif
                                               
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        @endif

                <!-- END OF REGITRATION LOGIC -->

            </div>

     </div>


</div>


@endif    

                  



           
                        <!-- end row -->

   

       
        <!-- end row -->

        <!-- row here -->

        <!-- end row -->
    </div>
    
</div>

@endsection

