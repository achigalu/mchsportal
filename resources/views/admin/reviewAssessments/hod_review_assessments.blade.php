
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | {{$title}}</title>
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
                                   
                                    <h5 class="mb-sm-0">Review Modules for: {{Auth::user()->fname}} {{Auth::user()->lname}} | HOD: {{Auth::user()->department->department_name}} | {{Auth::user()->campus}}</h5>

                                    <div class="page-title-right">
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" 
aria-expanded="false"><i class="fas fa-download"></i>&nbsp;&nbsp;Download &nbsp;&nbsp;</button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a> 
    <a class="dropdown-item" href="#">PDF</a>
   
</div>
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('myhome')}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                       
                        <!-- end page title -->
                        @if($hodModulesAssessment1->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <h3 class="card-title" style="color:#07689F;">REVIEW ASSESSMENT 1</h3>
                                    
                                    <p></p>
                                    <table class="table table-hover table-striped table-bordered table-responsive-sm shadow-sm">
                                        <thead class="thead-dark" style="background-color:#efeeee; color:000000;">
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">CODE</th>
                                                <th class="text-left">MODULE NAME</th>
                                                <th class="text-left">CLASS</th>
                                                <th class="text-center">SEMESTER</th>
                                                <th class="text-left">LECTURER</th>
                                                <th class="text-center">#STUDENTS</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php 
                                        $i = 1;
                                        $o = 1;
                                        $p = 1;
                                        @endphp
                                    @foreach ($hodModulesAssessment1 as $module)
                                    @if($module->userid == Auth::user()->id)
                                    @else

                                            @php
                                                // Determine campus name
                                                $campus = '';
                                                if ($module->campus_id == 1) {
                                                    $campus = "Lilongwe";
                                                } elseif ($module->campus_id == 2) {
                                                    $campus = "Blantyre";
                                                } elseif ($module->campus_id == 3) {
                                                    $campus = "Zomba";
                                                }
                       

                                                // Fetch related data
                                                $subj = App\Models\Course::find($module->courseid);
                                                $myclass = App\Models\Programclass::find($module->classid);
                                                $lecturer = App\Models\User::find($module->userid);

                                                // Ensure $myclass is not null before accessing classcode
                                                $totalStu = 0;
                                                if ($myclass) {
                                                    $totalStu = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->count();
                                                    $student = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td class="text-center">{{$subj->code}}</td>
                                                <td class="text-left">{{$subj->name}}</td>
                                                <!-- accessing the course name -->
                                                <td class="text-center" style="color:red;">{{$myclass->classcode}}</td>
                                                <td class="text-center">{{$module->semester}}</td>
                                                <td class="text-left">{{$lecturer->fname}} {{$lecturer->lname}}</td>
                                                <td class="text-center">{{$totalStu}}</td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{route('review.students.grading', ['id' => $module->id, 'assessment' => 1, 'ay'=>$student->academicyear_id])}}">
                                                        <button class="btn btn-outline-info btn-sm waves-effect waves-light" style="font-size: 14px;">Review Grades</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                @endif
                        <br>
                @if($hodModulesMid->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <h3 class="card-title" style="color:#07689F;">REVIEW MID SEMESTER</h3>
                                    <p></p>
                                    <table class="table table-hover table-striped table-bordered table-responsive-sm shadow-sm">
                                        <thead class="thead-dark" style="background-color:#efeeee; color:000000;">
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">CODE</th>
                                                <th class="text-left">MODULE NAME</th>
                                                <th class="text-left">CLASS</th>
                                                <th class="text-center">SEMESTER</th>
                                                <th class="text-left">LECTURER</th>
                                                <th class="text-center">#STUDENTS</th>
                                                <th class="text-center">ACTIONS</th> 
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                @foreach ($hodModulesMid as $module)
                                @if($module->userid == Auth::user()->id)
                                @else

                                            @php
                                                // Determine campus name
                                                $campus = '';
                                                if ($module->campus_id == 1) {
                                                    $campus = "Lilongwe";
                                                } elseif ($module->campus_id == 2) {
                                                    $campus = "Blantyre";
                                                } elseif ($module->campus_id == 3) {
                                                    $campus = "Zomba";
                                                }
                       

                                                // Fetch related data
                                                $subj = App\Models\Course::find($module->courseid);
                                                $myclass = App\Models\Programclass::find($module->classid);
                                                $lecturer = App\Models\User::find($module->userid);

                                                // Ensure $myclass is not null before accessing classcode
                                                $totalStu = 0;
                                                if ($myclass) {
                                                    $totalStu = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->count();
                                                    $student = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{$o++}}</td>
                                                <td class="text-center">{{$subj->code}}</td>
                                                <td class="text-left">{{$subj->name}}</td>
                                                <!-- accessing the course name -->
                                                <td class="text-center" style="color:red;">{{$myclass->classcode}}</td>
                                                <td class="text-center">{{$module->semester}}</td>
                                                
                                                <td class="text-left">{{$lecturer->fname}} {{$lecturer->lname}}</td>
                                                <td class="text-center">{{$totalStu}}</td>
                                                <td class="text-center">
                                                <div class="btn-group" role="group">
                                                        <a href="{{route('review.students.grading', ['id' => $module->id, 'assessment' => 2, 'ay'=>$student->academicyear_id])}}">
                                                        <button class="btn btn-outline-info btn-sm waves-effect waves-light" style="font-size: 14px;">Review Grades</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>

                    @endif
                        <br>
                    @if($hodModulesEndSem->isNotEmpty())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <h3 class="card-title" style="color:#07689F;">REVIEW END OF SEMESTER</h3>

                                    <p></p>
                                    <table class="table table-hover table-striped table-bordered table-responsive-sm shadow-sm">
                                        <thead class="thead-dark" style="background-color:#efeeee; color:000000;">
                                            <tr>
                                                <th class="text-center">S/N</th>
                                                <th class="text-center">CODE</th>
                                                <th class="text-left">MODULE NAME</th>
                                                <th class="text-left">CLASS</th>
                                                <th class="text-center">SEMESTER</th>
                                                <th class="text-left">LECTURER</th>
                                                <th class="text-center">#STUDENTS</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            @foreach ($hodModulesEndSem as $module)
                            @if($module->userid == Auth::user()->id)
                            @else
                                        @php
                                                // Determine campus name
                                                $campus = '';
                                                if ($module->campus_id == 1) {
                                                    $campus = "Lilongwe";
                                                } elseif ($module->campus_id == 2) {
                                                    $campus = "Blantyre";
                                                } elseif ($module->campus_id == 3) {
                                                    $campus = "Zomba";
                                                }
                       

                                                // Fetch related data
                                                $subj = App\Models\Course::find($module->courseid);
                                                $myclass = App\Models\Programclass::find($module->classid);
                                                $lecturer = App\Models\User::find($module->userid);

                                                // Ensure $myclass is not null before accessing classcode
                                                $totalStu = 0;
                                                if ($myclass) {
                                                    $totalStu = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->count();
                                                    $student = App\Models\User::where('programclass', $myclass->classcode)
                                                        ->where('semester', $module->semester)
                                                        ->where('campus', $campus)
                                                        ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{$p++}}</td>
                                                <td class="text-center">{{$subj->code}}</td>
                                                <td class="text-left">{{$subj->name}}</td>
                                                <!-- accessing the course name -->
                                                <td class="text-center" style="color:red;">{{$myclass->classcode}}</td>
                                                <td class="text-center">{{$module->semester}}</td>
                                                <td class="text-left">{{$lecturer->fname}} {{$lecturer->lname}}</td>
                                                <td class="text-center">{{$totalStu}}</td>
                                                <td class="text-center">
                                                <div class="btn-group" role="group">
                                                        <a href="{{route('review.students.grading', ['id' => $module->id, 'assessment' => 3, 'ay'=>$student->academicyear_id])}}">
                                                        <button class="btn btn-outline-info btn-sm waves-effect waves-light" style="font-size: 14px;">Review Grades</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
@else
<div class="row">
                            <div class="col-md-12">
                                <div class="card card-body">
                                    <table class="table table-hover table-striped table-bordered table-responsive-sm shadow-sm">
                                        <thead class="thead-dark" style="background-color:#efeeee; color:000000;">
                                        </thead>
                                     
                                        <tbody>
                                        <h4>No Modules to review yet.</h4>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
@endif
                        <!-- end row-->
                     

                        <!-- end row-->
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

        <script src="{{asset('assets/js/app.js')}}"></script>

    </body>

</html>