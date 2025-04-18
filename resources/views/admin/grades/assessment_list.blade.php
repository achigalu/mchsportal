
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
                        @if(!empty($id))
                        @php
                        $lecturerModule = App\Models\lecturerSubjects::find($id)
                        @endphp
                        @endif

                        @php 
                        $class = App\Models\Programclass::where('id', $lecturerModule->classid)->first()
                        @endphp

                        @php 
                        $course = App\Models\lecturerSubjects::find($id)
                        @endphp
                        @php 
                        $coursename = App\Models\Course::find($course->courseid)
                        @endphp
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                   
                                    <h1></h1>
                                    <div class="page-title-right">
                                    
                                                @php 
                                                $lecturer = Auth::user()->id
                                                @endphp
                                                
                                        @if($hasGrades)
                                        <ul class="breadcrumb m-0">
                                        
                                        <a href="{{route('aggregate.course', ['id' => $id, 'ay'=>$ay])}}">
                                        <li class="btn btn-outline-danger"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Aggregate {{$coursename->code}} grades</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        @endif

                                        <a href="{{route('lecturer.courses', $lecturer)}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <h4 class="mb-sm-0">Assessment list: 
                                    &nbsp;
                                    {{$coursename->code}} - {{$coursename->name}} &nbsp;
                                    &nbsp;{{$class->classcode}} - 
                                    
                                    @if($class->campus_id==1) LL @endif
                                    @if($class->campus_id==2) BT @endif 
                                    @if($class->campus_id==3) ZA @endif - Semester  {{$lecturerModule->semester}} 
                                   </h4><P></P>
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>#</th>
                                                <th>Assessment Name</th>
                                                <th>Number of Students</th>
                                                <th>Class</th>
                                                <th style="float: right;">Actions</th>
                                                
                                            </tr>
                                            </thead>
                                       

                                        @php 
                                        $assessmentlist1 = App\Models\Assessmentlist::find(1)
                                        @endphp
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{{$assessmentlist1->assessment_name}}
                                                </td>
                                               
                                                @php 
                                                $lcourse = App\Models\Course::find($lecturerModule->courseid);
                         
                                                $students = App\Models\Studentsubject::where('programclass_id', $lecturerModule->classid)
                                                ->where('semester', $lecturerModule->semester)
                                                ->where('campus_id', $lecturerModule->campus_id)
                                                ->where('academicyr_id', $ay)
                                                ->where('course_code', $lcourse->code)->count()
                                                @endphp

                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5"> 
                                                {{$students}}
                                                </span>
                                                </td>
                                                <td>
                                                    
                                                <span class="badge rounded-pill bg-light fs-5">
                                                    {{$class->classcode}} - 
                                                    @if($class->campus_id==1) LL @endif
                                                    @if($class->campus_id==2) BT @endif 
                                                    @if($class->campus_id==3) ZA @endif - Sem  {{$lecturerModule->semester}} 
                                                </span>

                                                </td>
                                                <td>
                                                @if($students>0)

                                                    <a href="{{route('students.grading', ['id' => $id, 'assessment' => $assessmentlist1->id, 'ay'=>$ay])}}"><button class="btn btn-outline-primary" style="float: right;">Grading</button></a>
                                                @else
                                                <a href="{{route('lecturer.courses', $lecturer)}}"><button class="btn btn-outline-info" style="float: right;">Back</button></a>
                                                @endif
                                            </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td> @php 
                                                $assessmentlist2 = App\Models\Assessmentlist::find(2)
                                                @endphp

                                                {{$assessmentlist2->assessment_name}}
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">  
                                                {{$students}}
                                                </span>

                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">
                                                {{$class->classcode}} - 
                                                    @if($class->campus_id==1) LL @endif
                                                    @if($class->campus_id==2) BT @endif 
                                                    @if($class->campus_id==3) ZA @endif - Sem  {{$lecturerModule->semester}}
                                                </span>
                                                </td>
                                                <td>
                                                @if($students>0)
                                                    <a href="{{route('students.grading', ['id' => $id, 'assessment' => $assessmentlist2->id, 'ay'=>$ay])}}"><button class="btn btn-outline-primary" style="float: right;">Grading</button></a>
                                                @else
                                                <a href="{{route('lecturer.courses', $lecturer)}}"><button class="btn btn-outline-info" style="float: right;">Back</button></a>
                                                @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>3</td>
                                                <td>@php 
                                                $assessmentlist3 = App\Models\Assessmentlist::find(3)
                                                @endphp

                                                {{$assessmentlist3->assessment_name}}
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">
                                                    {{$students}}
                                                </span>
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">
                                                {{$class->classcode}} - 
                                                    @if($class->campus_id==1) LL @endif
                                                    @if($class->campus_id==2) BT @endif 
                                                    @if($class->campus_id==3) ZA @endif - Sem  {{$lecturerModule->semester}}
                                                </span>
                                                </td>
                                              
                                                <td>
                                                @if($students>0)
                                                        <a href="{{route('students.grading', ['id' => $id, 'assessment' => $assessmentlist3->id, 'ay'=>$ay])}}"><button class="btn btn-outline-primary" style="float: right;">Grading</button></a>

                                                @else
                                                <a href="{{route('lecturer.courses', $lecturer)}}"><button class="btn btn-outline-info" style="float: right;">Back</button></a>
                                                @endif
                                             </td>
                                            </tr>

<!-- 

                                            <tr>
                                                <td>4</td>
                                                <td>@php 
                                                $assessmentlist4 = App\Models\Assessmentlist::find(4)
                                                @endphp

                                                {{$assessmentlist4->assessment_name}}
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">
                                                    {{$students}}
                                                </span>
                                                </td>
                                                <td>
                                                <span class="badge rounded-pill bg-light fs-5">
                                                {{$class->classcode}} - 
                                                    @if($class->campus_id==1) LL @endif
                                                    @if($class->campus_id==2) BT @endif 
                                                    @if($class->campus_id==3) ZA @endif - Sem  {{$lecturerModule->semester}}
                                                </span>
                                                </td>
                                              
                                                <td>
                                                @if($students>0)
                                                        <a href="{{route('students.grading', ['id' => $id, 'assessment' => $assessmentlist4->id, 'ay'=>$ay])}}"><button class="btn btn-outline-warning" style="float: right;">Grading</button></a>

                                                @else
                                                <a href="{{route('lecturer.courses', $lecturer)}}"><button class="btn btn-outline-info" style="float: right;">Back</button></a>
                                                @endif
                                             </td>
                                            </tr>
-->
                                            
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <!-- end row-->
                        
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