
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
                                
                                    <h4 class="mb-sm-0">
                                    
                                    Assessment list: 
                                    <span class="badge rounded-pill bg-secondary fs-6"> 
                                    {{$courseID->code}} - {{$courseID->name}} 
                                    
                                    <span class="badge rounded-pill bg-info fs-6"> 
                                    {{$mycoursename->classcode}}  
                                    {{$courseID->classcode}} - 
                                     @if( $lectSub->campus_id==1) LL @endif
                                     @if( $lectSub->campus_id==2) BT @endif
                                     @if( $lectSub->campus_id==3) ZA @endif 

                                    
                                        
                                    Semester {{$lectSub->semester}}
                                     </span>
                                    </span>
                                    </h4>

                                    @php 
    $subjfromlecturerTable = App\Models\lecturerSubjects::findOrfail($id);
    $mysubject = $subjfromlecturerTable->courseid;
    $subjcode = App\Models\Course::findOrfail($mysubject);
    $mysubjcode = $subjcode->code;

    // Fetch the first student subject record based on filters
    $studentaccess = App\Models\Studentsubject::where('academicyr_id', $ay)
        ->where('programclass_id', $subjfromlecturerTable->classid)
        ->where('course_code', $mysubjcode)
        ->where('semester', $subjfromlecturerTable->semester)
        ->where('campus_id', $subjfromlecturerTable->campus_id)
        ->first();

    // Determine access based on assessment
    $access = null;
    switch($assessment) {
        case 1:
            $access = $studentaccess->access_assessment1;
            break;
        case 2:
            $access = $studentaccess->access_assessment2;
            break;
        case 3:
            $access = $studentaccess->access_exam_grade;
            break;
        case 4:
            $access = $studentaccess->access_final_grade;
            break;
    }
@endphp

                                    <div class="page-title-right">
                                    <div class="btn-group">
                                    @if($access == 0)
                                    <a href="{{route('submit.grades.to.students', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay])}}">
                                    <button type="button" class="btn btn-outline-danger" ><span class="mdi mdi-publish"></span>&nbsp;&nbsp;Publish to students &nbsp;&nbsp;</button>
                                    </button></a>&nbsp;&nbsp;
                                    @else

                                    <a href="{{route('unpublish.grades.to.students', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay])}}">
                                    <button type="button" class="btn btn-outline-info" ><span class="mdi mdi-publish"></span>&nbsp;&nbsp;UnPublish to students &nbsp;&nbsp;</button>
                                    </button></a>&nbsp;&nbsp;
                                    @endif
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('list.assessments',['courseid'=>$id, 'ay'=>$ay])}}">
                                        <li class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>

                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('submit.hod', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay])}}">
                                        <li class="btn btn-outline-info"><i class="mdi mdi-publish"></i>&nbsp; Submit to HOD</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                                                @php 
                                                $assess = App\Models\Assessmentlist::find($assessment)
                                                @endphp

                                                
                                    <h5 style="color:#F57152;">
                                    <span class="badge rounded-pill bg-info fs-6"> 
                                    Assessment: {{$assess->assessment_name}}.
                                    </span> 
                                    <br></h5>
                              
     

                        <div class="row">
                            <div class="col-12">

                            @if(session()->has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('status')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('invalid'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('invalid')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif   


                                <div class="card">



                                <form action="{{route('students.graded1', ['id' => $id, 'assessment' => $assessment])}}" method="post"> 
                                    @csrf
                                    <div class="card-body">
                                    
                                                
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                       
                                      
                                        <thead>
                                        
                                            <tr style="background-color: #f0f0f0;">
                                                <th style="width: 10px;">#</th>
                                                <th style="width: 100px;">Student Name</th>
                                                <th style="width: 50px;">Registration #</th>
                                                <th>Grade</th>
                                                <th>Current Grades with</th>
                                                <th></th>

                                               
                                            </tr>
                                            </thead>
                                            
                                            <tbody>
                                            @php 
                                            $a=0
                                            @endphp

                                            @if(!empty($stu))
                                            @foreach($stu as $student)
                                            <tr>
                                                <td>{{++$a}}</td>
                                                <td >
                                                @php 
                                                $myname = App\Models\User::where('reg_num', $student->registration_no)->first()
                                                @endphp

                                                @if(!empty($myname))
                                                {{$myname->fname}} {{$myname->lname}}
                                                </td>
                                                
                                                <td>{{$student->registration_no}}
                                                    <input type="text" name="registration[]" value="{{$student->registration_no}}" hidden>
                                                    <input type="text" name="assessment_id" value="{{$assessment}}" hidden>
                                                    <input type="text" name="coursecode" value="{{$courseID->code}}" hidden>
                                                    <input type="text" name="ay" value="{{$ay}}" hidden>
                                                
                                                </td>
                                                <td>
                                                    @if($assessment==1)
                                                    <input class="form-control" name="assessment[]" type="number" min="0" max="100" value="{{ $student->assessment1 ?? ''}}" style="width: 100px;">
                                                    @endif

                                                    @if($assessment==2)
                                                    <input class="form-control" name="assessment[]" type="number" min="0" max="100" value="{{ $student->assessment2 ?? ''}}" style="width: 100px;">
                                                    @endif

                                                    @if($assessment==3)
                                                    <input class="form-control" name="assessment[]" type="number" min="0" max="100" value="{{ $student->exam_grade ?? ''}}" style="width: 100px;">
                                                    @endif

                                                    @if($assessment==4)
                                                    <input class="form-control" name="assessment[]" type="number" min="0" max="100" value="{{ $student->final_grade ?? ''}}" style="width: 100px;">
                                                    @endif
                                                            

                                                </td>

                                                <td>
                                                @if($assessment==1 && $student->access_assessment1==1)

                                                STUDENT

                                                    @else
                                                     @if($assessment==1 && $student->access_assessment1==0)
                                                        @php
                                                            $course = App\Models\Course::where('code',$student->course_code)->first();
                                                  
                                                            $accessID = App\Models\lecturerSubjects::where('courseid', $course->id)
                                                                        ->where('semester', $lectSub->semester)
                                                                        ->where('classid', $student->programclass_id)
                                                                        ->first();

                                                            $gradesWith = App\Models\User::findOrfail($accessID->access_level1);
                                                        @endphp
                                                        {{$gradesWith->role}}
                                                        
                                                    @endif
  
                                                @endif

                                                @if($assessment==2 && $student->access_assessment2==1)
                                                STUDENT 
                                                @else 
                                                    @if($assessment==2 && $student->access_assessment2==0)
                                                @php
                                                    $course = App\Models\Course::where('code',$student->course_code)->first();
 
                                                    $accessID = App\Models\lecturerSubjects::where('courseid', $course->id)
                                                                ->where('semester', $lectSub->semester)
                                                                ->where('classid', $student->programclass_id)
                                                                ->first();
                                                    
                                                    $gradesWith = App\Models\User::findOrfail($accessID->access_level2);

                                                @endphp
                                                    {{$gradesWith->role}}

                                                    @endif
                                                @endif

                                                @if($assessment==3 && $student->access_exam_grade==1)
                                                STUDENT
                                                    @else
                                                         @if($assessment==3 && $student->access_exam_grade==0)
                                                         @php
                                                    $course = App\Models\Course::where('code',$student->course_code)->first();
 
                                                    $accessID = App\Models\lecturerSubjects::where('courseid', $course->id)
                                                                ->where('semester', $lectSub->semester)
                                                                ->where('classid', $student->programclass_id)
                                                                ->first();
                                                    
                                                    $gradesWith = App\Models\User::findOrfail($accessID->access_level3);

                                                @endphp
                                                    {{$gradesWith->role}}

                                                    @endif
                                                @endif


                                                @if($assessment==4 && $student->access_final_grade==1)
                                                STUDENT 

                                                @else
                                                    @if($assessment==4 && $student->access_final_grade==0)
                                                    @php
                                                    $course = App\Models\Course::where('code',$student->course_code)->first();
 
                                                    $accessID = App\Models\lecturerSubjects::where('courseid', $course->id)
                                                                ->where('semester', $lectSub->semester)
                                                                ->where('classid', $student->programclass_id)
                                                                ->first();
                                                    
                                                    $gradesWith = App\Models\User::findOrfail($accessID->access_level4);

                                                    @endphp
                                                    {{$gradesWith->role}}

                                                    @endif  
                                                @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif
                                           
                                          
                                           
                                           
                                            
                                            </tbody>
                                            
                                        </table>
                                        <table>
                                            
                                        </table>
                                      <table>
                                        <tr>
                                            <td style="width: 300px;">
                                            
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                        <button type="submit" class="btn btn-outline-info btn-lg" style="float: right; width: 200px"><i class="fas fa-save"></i>&nbsp;&nbsp; Save grades</button>

                                            </td>
                                        </tr>
                                      </table>
                                    </div>
                                    </form>
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