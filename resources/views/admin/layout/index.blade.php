
@extends('admin.layout.master_layout')

@section('title','MCHS - Portal | Home')
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
                <h4 class="mb-sm-0 col-md-6" style="color: gray;">MY ACCOUNT: ADMIN</h4> 

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
                                <div class="row">
                                <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Students</p>
                                                <h4 class="mb-2">3409</h4>
                                                
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
                        

                                                @php 
                                                $lecturer = Auth::user()->id
                                                @endphp
                                <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                            <a href="{{route('lecturer.courses', $lecturer)}}"> 
                                                <p class="text-truncate font-size-14 mb-2">My</p>
                                               <h4 class="mb-2">Courses</h4></a>
                                                
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
                        </div>


        <div class="row">
       
   
        </div><!-- end row -->

       
        <!-- end row -->

        <!-- row here -->

        <!-- end row -->
    </div>
    
</div>

@endsection

