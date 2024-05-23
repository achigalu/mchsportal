
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
                <h4 class="mb-sm-0 col-md-6" style="color: gray;">MY ACCOUNT: <i>ADMIN</i></h4> 

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
                                                <p class="text-truncate font-size-14 mb-2">Faculties</p>
                                                <h4 class="mb-2">6</h4>
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
                                                <p class="text-truncate font-size-14 mb-2">Departments</p>
                                                <h4 class="mb-2">36</h4>
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
                                                <p class="text-truncate font-size-14 mb-2">Programmes</p>
                                                <h4 class="mb-2">66</h4>
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
                            </div>
                                <div class="row">
                                <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Students</p>
                                                <h4 class="mb-2">3409</h4>
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

