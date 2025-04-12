
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | Confirm Students Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
<!-- DataTables -->
        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
        <!-- Responsive datatable examples -->
        <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />     

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
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
<div class="col-lg-12">

<div class="card">
    
<div class="card-body">

<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0">Confirmation Students Registration</h4>


                            </div>
                        </div>
                        <!-- end page title -->


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        
        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>CLASS CODE</th>
                                                <th>CLASS NAME</th>
                                                <th>SEMESTER</th>
                                                <th>STUDENTS#</th>
                                                <th>CAMPUS</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>

    <!-- BASIC LILONGWE --->
    @if(Auth::user()->role=='HOD-BASIC' && Auth::user()->campus=='Lilongwe')

    <!-- DCM 1 SEM 1 - 2 -->
    @php
    $dcm1sem1 = App\Models\User::where('programclass', 'DCM1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $dcm1sem2 = App\Models\User::where('programclass', 'DCM1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp
                                            @if($dcm1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DCM1</td>
                                                <td>Diploma in Clinical Medicine 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$dcm1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DCM1', 'semester'=> 1, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($dcm1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DCM1</td>
                                                <td>Diploma in Clinical Medicine 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$dcm1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DCM1', 'semester'=> 2, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif

     <!-- DEH 1 SEM 1 - 2 -->
    @php
    $deh1sem1 = App\Models\User::where('programclass', 'DEH1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $deh1sem2 = App\Models\User::where('programclass', 'DEH1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($deh1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Environmental Health 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$deh1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DEH1', 'semester'=> 1, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($deh1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Environmental Health 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$deh1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DEH1', 'semester'=> 2, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif


    <!-- DBMS 1 SEM 1 - 2 -->
    @php
    $dbms1sem1 = App\Models\User::where('programclass', 'DBMS1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $dbms1sem2 = App\Models\User::where('programclass', 'DBMS1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($dbms1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DBMS1</td>
                                                <td>Diploma in Biomedical Sciences 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$dbms1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($dbms1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DBMS1</td>
                                                <td>Diploma in Biomedical Sciences 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$dbms1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif

    <!-- DPH 1 SEM 1 - 2 -->
    @php
    $dph1sem1 = App\Models\User::where('programclass', 'DPH1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $dph1sem2 = App\Models\User::where('programclass', 'DPH1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($dph1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DPH1</td>
                                                <td>Diploma in Pharmacy 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$dph1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DPH1', 'semester'=> 1, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($dph1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DPH1</td>
                                                <td>Diploma in Pharmacy 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$dph1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="{{route('confirm.checkbox',['class'=>'DPH1', 'semester'=> 2, 'campus'=>'Lilongwe'])}}" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif

    <!-- DR 1 SEM 1 - 2 -->
    @php
    $dr1sem1 = App\Models\User::where('programclass', 'DR1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $dr1sem2 = App\Models\User::where('programclass', 'DR1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($dr1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DR1</td>
                                                <td>Diploma in Radiography 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$dr1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($dr1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DR1</td>
                                                <td>Diploma in Radiography 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$dr1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
               
     <!-- DDT 1 SEM 1 - 2 -->
    @php
    $ddt1sem1 = App\Models\User::where('programclass', 'DDT1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $ddt1sem2 = App\Models\User::where('programclass', 'DDT1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($ddt1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Dental Therapy 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$ddt1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($ddt1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Dental Therapy 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$ddt1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif


    <!-- DDT 1 SEM 1 - 2 -->         
    @php
    $dot1sem1 = App\Models\User::where('programclass', 'DOT1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
    $dot1sem2 = App\Models\User::where('programclass', 'DOT1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
    @endphp

                                            @if($dot1sem1->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Optometry 1</td>
                                                <td>1</td>
                                                <td style="color: red;">{{$dot1sem1->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif
                                            @if($dot1sem2->isNotEmpty())
                                            <tr>
                                                <td>*</td>
                                                <td>DEH1</td>
                                                <td>Diploma in Optometry 1</td>
                                                <td>2</td>
                                                <td style="color: red;">{{$dot1sem2->count()}}</td>
                                                <td>Lilongwe</td>
                                                <td><a href="#" class="btn btn-primary">view</a>
                                            </tr>
                                            @endif


    @endif




<!-- BASIC BLANTYRE --->
@if(Auth::user()->role=='HOD-BASIC' && Auth::user()->campus=='Blantyre')

<!-- DCM 1 SEM 1 - 2 -->
@php
$dcm1sem1 = App\Models\User::where('programclass', 'DCM1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dcm1sem2 = App\Models\User::where('programclass', 'DCM1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp
                                        @if($dcm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM1</td>
                                            <td>Diploma in Clinical Medicine 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dcm1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dcm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM1</td>
                                            <td>Diploma in Clinical Medicine 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

 <!-- UDCM 1 SEM 1 - 2 -->
@php
$udcm1sem1 = App\Models\User::where('programclass', 'UDCM1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udcm1sem2 = App\Models\User::where('programclass', 'UDCM1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($udcm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM1</td>
                                            <td>Upgrading Diploma in Clinical Medicine 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udcm1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udcm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM1</td>
                                            <td>Upgrading Diploma in Clinical Medicine 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udcm1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif


<!-- DRN 1 SEM 1 - 2 -->
@php
$drn1sem1 = App\Models\User::where('programclass', 'DRN1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$drn1sem2 = App\Models\User::where('programclass', 'DRN1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($drn1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN1</td>
                                            <td>Diploma in Registered Nursing 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$drn1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($drn1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN1</td>
                                            <td>Diploma in Registered Nursing 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$drn1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

<!-- UDRN 1 SEM 1 - 2 -->
@php
$udrn1sem1 = App\Models\User::where('programclass', 'UDRN1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udrn1sem2 = App\Models\User::where('programclass', 'UDRN1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($udrn1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDRN1</td>
                                            <td>Upgrading Diploma in Registered Nursing 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udrn1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udrn1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDRN1</td>
                                            <td>Upgrading Diploma in Registered Nursing 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udrn1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

<!-- DCA 1 SEM 1 - 2 -->
@php
$dca1sem1 = App\Models\User::where('programclass', 'DCA1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dca1sem2 = App\Models\User::where('programclass', 'DCA1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($dca1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA1</td>
                                            <td>Diploma in Clinical Anaesthesia 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dca1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dca1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA1</td>
                                            <td>Diploma in Clinical Anaesthesia 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dca1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
           
 <!-- ENT 1 SEM 1 - 2 -->
@php
$ent1sem1 = App\Models\User::where('programclass', 'ENT1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$ent1sem2 = App\Models\User::where('programclass', 'ENT1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($ent1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT1</td>
                                            <td>Diploma in Ear, Nose and Throat 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ent1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ent1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT1</td>
                                            <td>Diploma in Ear, Nose and Throat 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ent1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif


<!-- ORTHOPEDICS 1 SEM 1 - 2 -->         
@php
$orthop1sem1 = App\Models\User::where('programclass', 'ORTHOP1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$orthop1sem2 = App\Models\User::where('programclass', 'ORTHOP1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

                                        @if($orthop1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP1</td>
                                            <td>Diploma in Orthopedics 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$orthop1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($orthop1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP1</td>
                                            <td>Diploma in Orthopedics 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$orthop1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif


 <!-- HODs Lilongwe--->
 <!-- BIOMEDICAL SCIENCES -->
 @if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 6)

@php
$cbms1sem1 = App\Models\User::where('programclass', 'CBMS1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cbms1sem2 = App\Models\User::where('programclass', 'CBMS1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cbms2sem1 = App\Models\User::where('programclass', 'CBMS2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cbms2sem2 = App\Models\User::where('programclass', 'CBMS2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dbms2sem1 = App\Models\User::where('programclass', 'DBMS2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dbms2sem2 = App\Models\User::where('programclass', 'DBMS2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dbms3sem1 = App\Models\User::where('programclass', 'DBMS3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dbms3sem2 = App\Models\User::where('programclass', 'DBMS3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- CBMS -->
                                        @if($cbms1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CBMS1</td>
                                            <td>Certificate in Biomedical Sciences 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cbms1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cbms1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CBMS1</td>
                                            <td>Certificate in Biomedical Sciences 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cbms1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($cbms2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CBMS2</td>
                                            <td>Certificate in Biomedical Sciences 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cbms2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cbms2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CBMS2</td>
                                            <td>Certificate in Biomedical Sciences 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cbms2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
    
    <!-- DBMS -->
                                        @if($dbms2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DBMS2</td>
                                            <td>Diploma in Biomedical Sciences 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dbms2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dbms2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DBMS2</td>
                                            <td>Diploma in Biomedical Sciences 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dbms2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dbms3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DBMS3</td>
                                            <td>Diploma in Biomedical Sciences 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dbms3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cbms3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DBMS3</td>
                                            <td>Diploma in Biomedical Sciences 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cbms3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif


    @endif



<!-- PHARMACY LILONGWE -->
 @if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 7)

@php
$cph1sem1 = App\Models\User::where('programclass', 'CPH1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cph1sem2 = App\Models\User::where('programclass', 'CPH1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cph2sem1 = App\Models\User::where('programclass', 'CPH2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$cph2sem2 = App\Models\User::where('programclass', 'CPH2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dph2sem1 = App\Models\User::where('programclass', 'DPH2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dph2sem2 = App\Models\User::where('programclass', 'DPH2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dph3sem1 = App\Models\User::where('programclass', 'DPH3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dph3sem2 = App\Models\User::where('programclass', 'DPH3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- CPH -->
                                        @if($cph1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH1</td>
                                            <td>Certificate in Pharmacy 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cph1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cph1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH1</td>
                                            <td>Certificate in Pharmacy 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cph1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($cph2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH2</td>
                                            <td>Certificate in Pharmacy 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cph2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cph2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH2</td>
                                            <td>Certificate in Pharmacy 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cph2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
    
    <!-- DPH -->
                                        @if($dph2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DPH2</td>
                                            <td>Diploma in Pharmacy 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dph2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dph2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DPH2</td>
                                            <td>Diploma in Pharmacy 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dph2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dph3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DPH3</td>
                                            <td>Diploma in Pharmacy 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dph3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dph3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DPH3</td>
                                            <td>Diploma in Pharmacy 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dph3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif


<!-- CCM LILONGWE -->
 @if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 4)

@php
$ccm1sem1 = App\Models\User::where('programclass', 'CPH1')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ccm1sem2 = App\Models\User::where('programclass', 'CPH1')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ccm2sem1 = App\Models\User::where('programclass', 'CPH2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ccm2sem2 = App\Models\User::where('programclass', 'CPH2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- CCM -->
                                        @if($ccm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM1</td>
                                            <td>Certificate in Clinical Medicine 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ccm1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ccm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM1</td>
                                            <td>Certificate in Clinical Medicine 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ccm1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ccm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM2</td>
                                            <td>Certificate in Clinical Medicine 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ccm2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ccm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM2</td>
                                            <td>Certificate in Clinical Medicine 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ccm2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
    
@endif  
<!-- DCM LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 5)

@php
$dcm2sem1 = App\Models\User::where('programclass', 'DCM2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dcm2sem2 = App\Models\User::where('programclass', 'DCM2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dcm3sem1 = App\Models\User::where('programclass', 'DCM3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dcm3sem2 = App\Models\User::where('programclass', 'DCM3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DCM -->
                                        @if($dcm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM2</td>
                                            <td>Diploma in Clinical Medicine 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dcm2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dcm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM2</td>
                                            <td>Diploma in Clinical Medicine 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dcm3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM3</td>
                                            <td>Diploma in Clinical Medicine 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dcm3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dcm3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM3</td>
                                            <td>Diploma in Clinical Medicine 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif
    
    <!-- DEH LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 9)

@php
$deh2sem1 = App\Models\User::where('programclass', 'DEH2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$deh2sem2 = App\Models\User::where('programclass', 'DEH2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$deh3sem1 = App\Models\User::where('programclass', 'DEH3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$deh3sem2 = App\Models\User::where('programclass', 'DEH3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DEH -->
                                        @if($deh2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DEH2</td>
                                            <td>Diploma in Environmental Health 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$deh2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($deh2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DEH2</td>
                                            <td>Diploma in Environmental Health 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$deh2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($deh3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DEH3</td>
                                            <td>Diploma in Environmental Health 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$deh3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($deh3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DEH3</td>
                                            <td>Diploma in Environmental Health 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$deh3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
    
@endif  
<!-- DR LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 8)

@php
$dr2sem1 = App\Models\User::where('programclass', 'DR2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr2sem2 = App\Models\User::where('programclass', 'DR2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr3sem1 = App\Models\User::where('programclass', 'DR3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr3sem2 = App\Models\User::where('programclass', 'DR3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DR -->
                                        @if($dr2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR2</td>
                                            <td>Diploma in Radiography 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dr2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dr2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR2</td>
                                            <td>Diploma in Radiography 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dr2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dr3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR3</td>
                                            <td>Diploma in Radiography 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dr3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dr3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR3</td>
                                            <td>Diploma in Radiography 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dr3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif   
   <!-- DR LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 8)

@php
$dr2sem1 = App\Models\User::where('programclass', 'DR2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr2sem2 = App\Models\User::where('programclass', 'DR2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr3sem1 = App\Models\User::where('programclass', 'DR3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dr3sem2 = App\Models\User::where('programclass', 'DR3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DR -->
                                        @if($dr2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR2</td>
                                            <td>Diploma in Radiography 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dr2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dr2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR2</td>
                                            <td>Diploma in Radiography 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dr2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dr3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR3</td>
                                            <td>Diploma in Radiography 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dr3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dr3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DR3</td>
                                            <td>Diploma in Radiography 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dr3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif  
<!-- DDT LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 11)

@php
$ddt2sem1 = App\Models\User::where('programclass', 'DDT2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ddt2sem2 = App\Models\User::where('programclass', 'DDT2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ddt3sem1 = App\Models\User::where('programclass', 'DDT3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ddt3sem2 = App\Models\User::where('programclass', 'DDT3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DDT -->
                                        @if($ddt2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DDT2</td>
                                            <td>Diploma in Dental Therapy 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ddt2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ddt2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DDT2</td>
                                            <td>Diploma in Dental Therapy 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ddt2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ddt3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DDT3</td>
                                            <td>Diploma in Dental Therapy 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ddt3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ddt3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DDT3</td>
                                            <td>Diploma in Dental Therapy 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ddt3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif 
<!-- DOT LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 12)

@php
$dot2sem1 = App\Models\User::where('programclass', 'DOT2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dot2sem2 = App\Models\User::where('programclass', 'DOT2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dot3sem1 = App\Models\User::where('programclass', 'DOT3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dot3sem2 = App\Models\User::where('programclass', 'DOT3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DOT -->
                                        @if($dot2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOT2</td>
                                            <td>Diploma in Optometry 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dot2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dot2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOT2</td>
                                            <td>Diploma in Optometry 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dot2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dot3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOT3</td>
                                            <td>Diploma in Optometry 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dot3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dot3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOT3</td>
                                            <td>Diploma in Optometry 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dot3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

@endif
<!-- UDCHN LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 10)

@php
$udchn2sem1 = App\Models\User::where('programclass', 'UDCHN2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$udchn2sem2 = App\Models\User::where('programclass', 'UDCHN2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$udchn3sem1 = App\Models\User::where('programclass', 'UDCHN3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$udchn3sem2 = App\Models\User::where('programclass', 'UDCHN3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- UDCHN -->
                                        @if($udchn1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCHN1</td>
                                            <td>Diploma in Community Health Nursing 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udchn1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udchn1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCHN1</td>
                                            <td>Diploma in Community Health Nursing 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udchn1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($udchn2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCHN2</td>
                                            <td>Diploma in Community Health Nursing 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udchn2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udchn2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCHN2</td>
                                            <td>Diploma in Community Health Nursing 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udchn2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif    
<!-- DOP LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 13)

@php
$dop1sem1 = App\Models\User::where('programclass', 'DOP2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dop1sem2 = App\Models\User::where('programclass', 'DOP2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dop2sem1 = App\Models\User::where('programclass', 'DOP3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dop2sem2 = App\Models\User::where('programclass', 'DOP3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DOP -->
                                        @if($dop1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOP1</td>
                                            <td>Diploma in Ophthalmology 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dop1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dop1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOP1</td>
                                            <td>Diploma in Ophthalmology 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dop1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dop2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOP2</td>
                                            <td>Diploma in Ophthalmology 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dop2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dop2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DOP2</td>
                                            <td>Diploma in Ophthalmology 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dop2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif    
<!-- DCA LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 14)

@php
$dca1sem1 = App\Models\User::where('programclass', 'DCA2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dca1sem2 = App\Models\User::where('programclass', 'DCA2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dca2sem1 = App\Models\User::where('programclass', 'DCA3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$dca2sem2 = App\Models\User::where('programclass', 'DCA3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
@endphp

<!-- DCA -->
                                        @if($dca1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA1</td>
                                            <td>Diploma in Clinical Anaesthesia 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dca1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dca1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA1</td>
                                            <td>Diploma in Clinical Anaesthesia 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dca1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dca2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA2</td>
                                            <td>Diploma in Clinical Anaesthesia 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dca2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dca2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA2</td>
                                            <td>Diploma in Clinical Anaesthesia 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dca2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif    
<!-- BSC CM && UBSC CM LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 29)

@php
$bsccm1sem1 = App\Models\User::where('programclass', 'BSCCM2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm1sem2 = App\Models\User::where('programclass', 'BSCCM2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm2sem1 = App\Models\User::where('programclass', 'BSCCM3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm2sem2 = App\Models\User::where('programclass', 'BSCCM3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm3sem1 = App\Models\User::where('programclass', 'BSCCM2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm3sem2 = App\Models\User::where('programclass', 'BSCCM2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm4sem1 = App\Models\User::where('programclass', 'BSCCM3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$bsccm4sem2 = App\Models\User::where('programclass', 'BSCCM3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();

$ubsccm1sem1 = App\Models\User::where('programclass', 'UBSCCM2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm1sem2 = App\Models\User::where('programclass', 'UBSCCM2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm2sem1 = App\Models\User::where('programclass', 'UBSCCM3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm2sem2 = App\Models\User::where('programclass', 'UBSCCM3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm3sem1 = App\Models\User::where('programclass', 'UBSCCM2')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm3sem2 = App\Models\User::where('programclass', 'UBSCCM2')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm4sem1 = App\Models\User::where('programclass', 'UBSCCM3')->where('semester', 1)->where('campus', 'Lilongwe')->where('registered',1)->get();
$ubsccm4sem2 = App\Models\User::where('programclass', 'UBSCCM3')->where('semester', 2)->where('campus', 'Lilongwe')->where('registered',1)->get();


@endphp

<!-- BSC -->
                                        @if($bsccm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM1</td>
                                            <td>Bsc in Clinical Medicine 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$bsccm1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($bsccm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM1</td>
                                            <td>Bsc in Clinical Medicine 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$bsccm1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($bsccm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM2</td>
                                            <td>Bsc in Clinical Medicine 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$bsccm2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($bsccm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM2</td>
                                            <td>Bsc in Clinical Medicine 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$bsccm2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($bsccm3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM3</td>
                                            <td>Bsc in Clinical Medicine 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$bsccm3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($bsccm3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM3</td>
                                            <td>Bsc in Clinical Medicine 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$bsccm3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($bsccm4sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM4</td>
                                            <td>Bsc in Clinical Medicine 4</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$bsccm4sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($bsccm4sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>BSCCM4</td>
                                            <td>Bsc in Clinical Medicine 4</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$bsccm4sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

    <!-- UBSC CM -->

                                   @if($ubsccm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM1</td>
                                            <td>Bsc in Clinical Medicine 1 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ubsccm1sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ubsccm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM1</td>
                                            <td>Bsc in Clinical Medicine 1 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ubsccm1sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ubsccm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM2</td>
                                            <td>Bsc in Clinical Medicine 2 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ubsccm2sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ubsccm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM2</td>
                                            <td>Bsc in Clinical Medicine 2 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ubsccm2sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ubsccm3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM3</td>
                                            <td>Bsc in Clinical Medicine 3 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ubsccm3sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ubsccm3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM3</td>
                                            <td>Bsc in Clinical Medicine 3 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ubsccm3sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ubsccm4sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM4</td>
                                            <td>Bsc in Clinical Medicine 4 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ubsccm4sem1->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ubsccm4sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UBSCCM4</td>
                                            <td>Bsc in Clinical Medicine 4 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ubsccm4sem2->count()}}</td>
                                            <td>Lilongwe</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
    

@endif

<!-- MED SERG -- LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 28)

@endif   

<!-- MID-WIFERY -- LILONGWE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Lilongwe' && Auth::user()->department_id == 27)

@endif   

<!-- LILONGWE CAMPUS ENDS HERE --> 


<!-- BLANTYRE HODs -->

<!-- DCM BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 19)

@php
$dcm2sem1 = App\Models\User::where('programclass', 'DCM2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dcm2sem2 = App\Models\User::where('programclass', 'DCM2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$dcm3sem1 = App\Models\User::where('programclass', 'DCM3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dcm3sem2 = App\Models\User::where('programclass', 'DCM3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();

$udcm1sem1 = App\Models\User::where('programclass', 'UDCM3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udcm1sem2 = App\Models\User::where('programclass', 'UDCM3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$udcm2sem1 = App\Models\User::where('programclass', 'UDCM3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udcm2sem2 = App\Models\User::where('programclass', 'UDCM3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- DCM -->
                                        @if($dcm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM2</td>
                                            <td>Diploma in Clinical Medicine 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dcm2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dcm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM2</td>
                                            <td>Diploma in Clinical Medicine 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dcm3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM3</td>
                                            <td>Diploma in Clinical Medicine 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dcm3sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dcm3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCM3</td>
                                            <td>Diploma in Clinical Medicine 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm3sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        
                                        <!-- UDCM -->

                                        @if($udcm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM1</td>
                                            <td>Diploma in Clinical Medicine 1 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udcm1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udcm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM1</td>
                                            <td>Diploma in Clinical Medicine 1 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udcm1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($udcm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM2</td>
                                            <td>Diploma in Clinical Medicine 2 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udcm2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udcm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM2</td>
                                            <td>Diploma in Clinical Medicine 2 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udcm2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif

<!-- CCM BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 16)

@php
$ccm1sem1 = App\Models\User::where('programclass', 'CCM1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$ccm1sem2 = App\Models\User::where('programclass', 'CCM1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$ccm2sem1 = App\Models\User::where('programclass', 'CCM2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$ccm2sem2 = App\Models\User::where('programclass', 'CCM2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- CCM -->
                                        @if($ccm1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM1</td>
                                            <td>Certificate in Clinical Medicine 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ccm1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ccm1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM1</td>
                                            <td>Certificate in Clinical Medicine 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ccm1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ccm2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM2</td>
                                            <td>Certificate in Clinical Medicine 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ccm2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ccm2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CCM2</td>
                                            <td>Certificate in Clinical Medicine 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ccm2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif

<!-- DRN - UDRN BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 22)

@php
$drn2sem1 = App\Models\User::where('programclass', 'DRN2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$drn2sem2 = App\Models\User::where('programclass', 'DRN2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$drn3sem1 = App\Models\User::where('programclass', 'DRN3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$drn3sem2 = App\Models\User::where('programclass', 'DRN3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();

$udrn1sem1 = App\Models\User::where('programclass', 'UDRN3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udrn1sem2 = App\Models\User::where('programclass', 'UDRN3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$udrn2sem1 = App\Models\User::where('programclass', 'UDRN3')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$udrn2sem2 = App\Models\User::where('programclass', 'UDRN3')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- DCM -->
                                        @if($drn2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN2</td>
                                            <td>Diploma in Registered Nursing 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$drn2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($drn2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN2</td>
                                            <td>Diploma in Registered Nursing 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dcm2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($drn3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN3</td>
                                            <td>Diploma in Registered Nursing 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$drn3sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($drn3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DRN3</td>
                                            <td>Diploma in Registered Nursing 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$drn3sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        
                                        <!-- UDRN -->

                                        @if($udrn1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDRN1</td>
                                            <td>Diploma in Registered Nursing 1 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udrn1sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udrn1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDRN1</td>
                                            <td>Diploma in Registered Nursing 1 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udrn1sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($udrn2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDRN2</td>
                                            <td>Diploma in Registered Nursing 2 ( Upgrading )</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$udrn2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($udrn2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>UDCM2</td>
                                            <td>Diploma in Registered Nursing 2 ( Upgrading )</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$udrn2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif

<!-- DCA BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 25)

@php
$dca2sem1 = App\Models\User::where('programclass', 'DCA1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dca2sem2 = App\Models\User::where('programclass', 'DCA1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$dca3sem1 = App\Models\User::where('programclass', 'DCA2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$dca3sem2 = App\Models\User::where('programclass', 'DCA2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- DCA -->
                                        @if($dca2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA2</td>
                                            <td>Diploma in Clinical Anaesthesia 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dca2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dca2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA2</td>
                                            <td>Diploma in Clinical Anaesthesia 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dca2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($dca3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA3</td>
                                            <td>Diploma in Clinical Anaesthesia 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$dca3sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($dca3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>DCA3</td>
                                            <td>Diploma in Clinical Anaesthesia 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$dca3sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif

<!-- ENT BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 24)

@php
$ent2sem1 = App\Models\User::where('programclass', 'ENT1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$ent2sem2 = App\Models\User::where('programclass', 'ENT1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$ent3sem1 = App\Models\User::where('programclass', 'ENT2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$ent3sem2 = App\Models\User::where('programclass', 'ENT2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- ENT -->
                                        @if($ent2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT2</td>
                                            <td>Diploma in Ear, Nose and Throat 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ent2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ent2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT2</td>
                                            <td>Diploma in Ear, Nose and Throat 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ent2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($ent3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT3</td>
                                            <td>Diploma in Ear, Nose and Throat 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$ent3sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($ent3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ENT3</td>
                                            <td>Diploma in Ear, Nose and Throat 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$ent3sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif

<!-- ORTHOP BLANTYRE -->
@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Blantyre' && Auth::user()->department_id == 24)

@php
$orthop2sem1 = App\Models\User::where('programclass', 'ORTHOP1')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$orthop2sem2 = App\Models\User::where('programclass', 'ORTHOP1')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
$orthop3sem1 = App\Models\User::where('programclass', 'ORTHOP2')->where('semester', 1)->where('campus', 'Blantyre')->where('registered',1)->get();
$orthop3sem2 = App\Models\User::where('programclass', 'ORTHOP2')->where('semester', 2)->where('campus', 'Blantyre')->where('registered',1)->get();
@endphp

<!-- ORTHOP -->
                                        @if($orthop2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP2</td>
                                            <td>Diploma in Orthopedics 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$orthop2sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($orthop2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP2</td>
                                            <td>Diploma in Orthopedics 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$orthop2sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($orthop3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP3</td>
                                            <td>Diploma in Orthopedics 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$orthop3sem1->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($orthop3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>ORTHOP3</td>
                                            <td>Diploma in Orthopedics 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$orthop3sem2->count()}}</td>
                                            <td>Blantyre</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
@endif


<!--- ZOMBA CAMPUS --->

@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Zomba' && Auth::user()->department_id == 21)

@php
$cph1sem1 = App\Models\User::where('programclass', 'CPH1')->where('semester', 1)->where('campus', 'Zomba')->where('registered',1)->get();
$cph1sem2 = App\Models\User::where('programclass', 'CPH1')->where('semester', 2)->where('campus', 'Zomba')->where('registered',1)->get();
$cph2sem1 = App\Models\User::where('programclass', 'CPH2')->where('semester', 1)->where('campus', 'Zomba')->where('registered',1)->get();
$cph2sem2 = App\Models\User::where('programclass', 'CPH2')->where('semester', 2)->where('campus', 'Zomba')->where('registered',1)->get();
@endphp

<!-- CPH ZOMBA -->
                                        @if($cph1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH1</td>
                                            <td>Certificate in Pharmacy 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cph1sem1->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cph1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH1</td>
                                            <td>Certificate in Pharmacy 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cph1sem2->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($cph2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH2</td>
                                            <td>Certificate in Pharmacy 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cph2sem1->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($cph2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>CPH2</td>
                                            <td>Certificate in Pharmacy 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$cph2sem2->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                  
@endif

@if(Auth::user()->role=='HOD' && Auth::user()->campus=='Zomba' && Auth::user()->department_id == 18)

@php
$nmt1sem1 = App\Models\User::where('programclass', 'NMT1')->where('semester', 1)->where('campus', 'Zomba')->where('registered',1)->get();
$nmt1sem2 = App\Models\User::where('programclass', 'NMT1')->where('semester', 2)->where('campus', 'Zomba')->where('registered',1)->get();
$nmt2sem1 = App\Models\User::where('programclass', 'NMT2')->where('semester', 1)->where('campus', 'Zomba')->where('registered',1)->get();
$nmt2sem2 = App\Models\User::where('programclass', 'NMT2')->where('semester', 2)->where('campus', 'Zomba')->where('registered',1)->get();
$nmt3sem1 = App\Models\User::where('programclass', 'NMT3')->where('semester', 1)->where('campus', 'Zomba')->where('registered',1)->get();
$nmt3sem2 = App\Models\User::where('programclass', 'NMT3')->where('semester', 2)->where('campus', 'Zomba')->where('registered',1)->get();
@endphp

<!-- CPH ZOMBA -->
                                        @if($nmt1sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT1</td>
                                            <td>Diploma in Nursing and Midwifery Technician 1</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$nmt1sem1->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($nmt1sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT1</td>
                                            <td>Diploma in Nursing and Midwifery Technician 1</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$nmt1sem2->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($nmt2sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT2</td>
                                            <td>Diploma in Nursing and Midwifery Technician 2</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$cph2sem1->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($nmt2sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT2</td>
                                            <td>Diploma in Nursing and Midwifery Technician 2</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$nmt2sem2->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                        @if($nmt3sem1->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT3</td>
                                            <td>Diploma in Nursing and Midwifery Technician 3</td>
                                            <td>1</td>
                                            <td style="color: red;">{{$nmt3sem1->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif
                                        @if($nmt3sem2->isNotEmpty())
                                        <tr>
                                            <td>*</td>
                                            <td>NMT3</td>
                                            <td>Diploma in Nursing and Midwifery Technician 3</td>
                                            <td>2</td>
                                            <td style="color: red;">{{$nmt3sem2->count()}}</td>
                                            <td>Zomba</td>
                                            <td><a href="#" class="btn btn-primary">view</a>
                                        </tr>
                                        @endif

                                  
@endif

<!---  END ZOMBA --->

                                            </tbody>
                                            
                                        </table>
                                        

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->


</div>
</div>
</div>
<!-- end select2 -->

</div>





</div>
<!-- end row -->

<!-- end row -->










   <!-- start page title -->


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
  <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
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

        <script src="{{asset('assets/js/app.js')}}"></script>


        

    </body>

</html>