
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
                                    <h4 class="mb-sm-0">Modules for: {{Auth::user()->fname}} {{Auth::user()->lname}}</h4>

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
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Module Name</th>
                                                <th>Class</th>
                                                <th>Semester</th>
                                                <th># of students</th>
                                                <th style="float: right;">Actions</th>
                                                
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            
                                            @php
                                            $count = 0
                                            @endphp
                                    @if(!empty($lecturerCourses))
                                            @foreach($lecturerCourses as $course)
                                            <tr>
                                                <td style="width: 5px;">{{++$count}}</td>
                                                @php 
                                                $lcourse = App\Models\Course::find($course->courseid)
                                                @endphp
                                                <td style="width: 20px;">{{$lcourse->code}} </td>
                                                <td>{{$lcourse->name}}</td>
                                                <td style="width: 12px;">
                                                <span class="badge rounded-pill bg-light fs-5"> 
                                                @php
                                                $class = App\Models\Programclass::where('id' ,$course->classid)->first() 
                                                @endphp
                                                {{$class->classcode}} - 
                                                @if($class->campus_id==1) LL @endif
                                                @if($class->campus_id==2) BT @endif 
                                                @if($class->campus_id==3) ZA @endif
                                                </span>
                                                </td>
                                                
                                                <td> 
                                                <span class="badge rounded-pill bg-light fs-5"> 
                                                {{$course->semester}}
                                                </span>
                                                </td>
                                               
                                                <td style="width: 30px;">
                                               
                                                @php 
                                                if($class->campus_id==1){$campus='Lilongwe';}
                                                if($class->campus_id==2){$campus='Blantyre';}
                                                if($class->campus_id==3){$campus='Zomba';}
                                                

                                                $classStudents = App\Models\User::where('programclass',$class->classcode)
                                                ->where('campus', $campus)
                                                ->where('semester', $course->semester)->get();

                                                $acyr = $classStudents->first();
                                                $ay = $acyr->academicyear_id;

                                                $students = App\Models\Studentsubject::where('programclass_id', $course->classid)
                                                ->where('semester', $course->semester)
                                                ->where('campus_id', $course->campus_id)
                                                ->where('academicyr_id', $ay)
                                                ->where('course_code', $lcourse->code)->count();
                                                

                                                @endphp
                                                <span class="badge rounded-pill bg-light fs-5"> 
                                                {{$students}}
                                                </span>
                                                </td>
                                                
                                                <td style="width: 30px;">
                                                <button class="btn btn-outline-warning" style="float: right;" data-bs-toggle="modal" data-bs-target="#myModal">Notices</button><br><br>
                                                <a href="{{route('list.assessments', ['courseid'=>$course->id, 'ay'=>$ay])}}"><button class="btn btn-outline-info" style="float: right;">Assessments</button></a>
                                                </td>
                                            </tr>
                                            @endforeach 
                                    @endif   
                                            
                                           
                                     
                                            
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

                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Module Announcements</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="">
                                                                    <input type="text" class="form-control" placeholder="Enter Module Title"><br>
                                                                    <textarea name="" rows="4" id="" class="form-control" placeholder="Enter Module Announcement"></textarea>
                                                                    
                                                                
                                                                
                                                                
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                            </div>
                                                            </form>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

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