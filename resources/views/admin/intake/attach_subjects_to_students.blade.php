
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | College Faculties</title>
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
@php 
$myclass = App\Models\Programclass::find($class)
@endphp


@php
$mystudents = App\Models\User::where('programclass',$myclass->classcode)
->where('semester',$semester)
->where('campus',$myclass->campus->campus)
->where('academicyear_id', $ay)
->count()
@endphp

@php
       $classsubjects = App\Models\Myclasssubject::where('programclass_id', $class)
      ->where('semester', $semester)
      ->where('academicyear_id', $ay)->get();
@endphp


</div>
</div>
</div>
<!-- end select2 -->

</div>





<div class="row">
<div class="col-lg-12">

<div class="card">
    
<div class="card-body">

<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">


<h4 class="mb-sm-0"></h4>

<div class="page-title-right" style="margin-right: 25px; float: right;">

<div class="btn-group">
<a href="{{route('add.subject.to.students')}}">
<button type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back&nbsp;&nbsp;</button> 
</a>
</div>

@if ($classsubjects->isEmpty())
&nbsp;&nbsp;<i style="color: red;">No subjects assigned to this class yet.</i>
@else

<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" 
aria-expanded="false"><i class="fas fa-download"></i>&nbsp;&nbsp;Download &nbsp;&nbsp;<i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a>
    <a class="dropdown-item" href="#">PDF</a>
   
</div>
<a href="{{ route('allocate.subjects.to.students', ['class' =>$myclass->id, 'semester' =>$semester, 'ay' =>$ay, 'campus' =>$myclass->campus_id ]) }}">
<button type="button" class="btn btn-warning"><i class="fas fa-users" data-bs-toggle="dropdown"></i>&nbsp;&nbsp;Assign Subjects to Students&nbsp;&nbsp;</button>
</a>

@endif


                                </div>
                            </div>
                            
                        </div>
                        <!-- end page title -->
           



<div class="row">
                            <div class="col-12">
                                <div class="card">
                           
                                
 <div class="page-title-right" style="margin-left: 20px; float: right;">

<h4> @if(!empty($myclass->classcode))
                    <h4 class="card-title"><b style="color: #69514B;">{{$myclass->classcode}} - @if($myclass->campus_id==1) LL @endif 
                            @if($myclass->campus_id==2) BT @endif
                            @if($myclass->campus_id==3) ZA @endif | Semester: </b>{{$semester}}</h4>
                    @endif</h4>

 </div>

                                    <div class="card-body">
 
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color:#e6e6e6;">
                                                <th>#</th>
                                                <th>Class</th>
                                                <th>Code</th>
                                                <th>Subject Name</th>
                                                <th>Semester</th>
                                                <th>Students</th>
                                                
                                            </tr>
                                            </thead>

                                            <tbody>         
                                            @if(!empty($classsubjects ))    
                                            @php $id = 0 @endphp <!-- Move the initialization outside of the loop -->
                                                            @foreach($classsubjects as $subjects)
                                                            <tr>
                                                              
                                                                <td>{{ ++$id }}</td>
                                                                <td>{{$subjects->programclass->classcode}}</td>
                                                                <td>{{$subjects->course->code}}</td>
                                                                <td>{{$subjects->course->name}}</td>
                                                                @if(!empty($semester))
                                                                <td>{{$semester}}</td>
                                                                @endif
                                                                <td><span class="badge rounded-pill bg-success">{{$mystudents}}</span></td>

                                                            </tr>

                                            @endforeach
                                            @endif
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