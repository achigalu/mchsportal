
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

                                $subj = App\Models\lecturerSubjects::findOrfail($id);
                                @endphp

                                    <div class="page-title-right">
                                    <div class="btn-group">
                                    
                                    
                                    
                        @if($assessment == 2) 
                            <!--END OF SEMESTER SEND TO HOD -->
                        

                                    @if($access == 0)
                                    
                                    <ul class="breadcrumb m-0">
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#publish{{$id}}{{$assessment}}{{$ay}}">
                                        <span class="mdi mdi-publish"></span>&nbsp;&nbsp;Publish to students &nbsp;&nbsp;</button>
                                    </button>&nbsp;&nbsp;
                                    </ul>
                                    
                                    @else
                                    
                                    <ul class="breadcrumb m-0">
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#unpublish{{$id}}{{$assessment}}{{$ay}}">
                                        <span class="mdi mdi-publish"></span>&nbsp;&nbsp;UnPublish from students &nbsp;&nbsp;</button>
                                    </button>
                                    </ul>
                                    @endif

                                    @if((Auth::user()->role=='HOD' || Auth::user()->role=='HOD-BASIC' || Auth::user()->role=='Lecturer' 
                                    || Auth::user()->role=='Dean' || Auth::user()->role=='Administrator' || Auth::user()->role=='Admin'
                                    || Auth::user()->role=='Deputy Dean' || Auth::user()->role=='Campus Registrar' || Auth::user()->role=='Dos'
                                    || Auth::user()->role=='Principal') && $subjfromlecturerTable->userid == Auth::user()->id)
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('list.assessments',['courseid'=>$id, 'ay'=>$ay])}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <li class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    @else
                                    <ul class="breadcrumb m-0">
                                        <a href="{{route('hod.review.assessments', Auth::user()->id)}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <li class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    @endif

                            <!-- SUBMIT TO HOD-->
      
                                        @if($subj->reviewed2 == 1)
                                        @if(Auth::user()->role =='HOD' || Auth::user()->role =='HOD-BASIC') 
                                        <ul class="breadcrumb m-0">         
                                                <li class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#lecturer{{$id}}{{$assessment}}{{$ay}}">
                                                <i class="mdi mdi-publish" ></i>&nbsp; Back to Lecturer</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </ul>  
                               
                                        @endif  
                                        @endif
                                       
                                        @if($subj->reviewed2 == 0)
                                        @if(Auth::user()->role =='HOD' || Auth::user()->role =='HOD-BASIC') 
                                        @else
                                                <ul class="breadcrumb m-0">         
                                                <li class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#hod{{$id}}{{$assessment}}{{$ay}}">
                                                <i class="mdi mdi-publish" ></i>&nbsp; Submit to HOD</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </ul>        
                                        @endif
                                        @endif
                 @endif
                          
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                                                @php 
                                                $assess = App\Models\Assessmentlist::find($assessment)
                                                @endphp

                                                
                                    <h5>
                                    
                                    Assessment: {{$assess->assessment_name}}.
                                    
                                    <br>
                                    {{$courseID->code}} - {{$courseID->name}} 
                                    
                                    {{$mycoursename->classcode}}  
                                    {{$courseID->classcode}} - 
                                     @if( $lectSub->campus_id==1) LL @endif
                                     @if( $lectSub->campus_id==2) BT @endif
                                     @if( $lectSub->campus_id==3) ZA @endif 

                                    
                                        
                                    Semester {{$lectSub->semester}}
                                </br></h5>
                              
     

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
                                                     <!-- VALUES SENT FOR FURTHER PROCESSING -->
                                                    <input type="text" name="registration[]" value="{{$student->registration_no}}" hidden>
                                                    <input type="text" name="assessment_id" value="{{$assessment}}" hidden>
                                                    <input type="text" name="coursecode" value="{{$courseID->code}}" hidden>
                                                    <input type="text" name="ay" value="{{$ay}}" hidden>
                                                
                                                </td>
                                                <td>
                                                    @if($assessment==2)
                                                    <!-- add logic to test if Auth::user()->id is equal to userid in lectsubjTable  ACTIVE/DISABLED, IF DISABLED DONT SHOW SUBMIT TO HOD OR OTHERS BUTTON-->
                                                    <input class="form-control" name="studentGrade[]" type="number" min="0" max="100" 
                                                    value="{{ $student->assessment2 ?? '' }}" 
                                                     
                                                    {{ $lectSub->reviewed2 == 0 ? '' : 'readonly' }}>
                                                    
                                                    @endif

                                                   
                                                </td>

                                                <td>
                                                @php
                                                    $assessments = [
                                                        1 => 'access_assessment1',
                                                        2 => 'access_assessment2',
                                                        3 => 'access_exam_grade',
                                                        4 => 'access_final_grade'
                                                    ];
                                                @endphp

                                                @foreach($assessments as $key => $accessField)
                                                    @if($assessment == $key && $student->$accessField == 1)
                                                        STUDENT
                                                    @else
                                                        @if($assessment == $key && $student->$accessField == 0)
                                                            @php
                                                                $course = App\Models\Course::where('code', $student->course_code)->first();
                                                                $accessID = App\Models\lecturerSubjects::where('courseid', $course->id)
                                                                            ->where('semester', $lectSub->semester)
                                                                            ->where('classid', $student->programclass_id)
                                                                            ->first();

                                                                $accessLevelField = 'access_level' . $key;
                                                                $gradesWith = App\Models\User::findOrFail($accessID->$accessLevelField);
                                                            @endphp

                                                            {!! '<strong>' . ($gradesWith->role == 'Lecturer' ? 'LECTURER' : ' ') . '</strong>' !!}
                                                            {!! '<strong>' . ($gradesWith->role == 'HOD-BASIC' ? 'HOD - BASIC' : ' ') . '</strong>' !!}
                                                            {!! '<strong>' . ($gradesWith->role == 'HOD' ? 'HOD' : ' ') . '</strong>' !!}
                                                            {!! '<strong>' . ($gradesWith->role == 'Dean' ? 'DEAN' : ' ') . '</strong>' !!}
                                                            {!! '<strong>' . ($gradesWith->role == 'College Registrar' ? 'COLLEGE REGISTRAR' : ' ') . '</strong>' !!}
                                                            {!! '<strong>' . ($gradesWith->role == 'Executive Director' ? 'EXECUTIVE DIRECTOR' : ' ') . '</strong>' !!}
                                                         
                                                        @endif
                                                    @endif
                                                @endforeach
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
                                            <td style="width: 800px;">
                                            
                                            </td>
                                            <td></td>
                                            <td></td>
                                            @if($lectSub->reviewed2 == 0)
                                            <td>
                                                        <button type="submit" class="btn btn-outline-info btn-lg" style="float: right;"><i class="fas fa-save"></i>&nbsp;&nbsp; Save marks</button>

                                            </td>
                                            @endif
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
<!-- MODAL START -->


<div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="publish{{$id}}{{$assessment}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="publish{{$id}}{{$assessment}}{{$ay}}">Publish results to students.</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            @php 
                                                            $subj = App\Models\lecturerSubjects::findOrfail($id);
                                                            $ass = App\Models\Assessmentlist::findOrfail($assessment);
                                                            $class = App\Models\programclass::findOrfail($subj->classid);
                                                            $course = App\Models\Course::findOrfail($subj->courseid);
                                                            if($subj->campus_id == 1) { $campus = 'Lilongwe';}
                                                            if($subj->campus_id == 2) { $campus = 'Blantyre';}
                                                            if($subj->campus_id == 3) { $campus = 'Zomba';}
                                                            @endphp
                                                           
                                                            <div class="modal-body">
                                                               Are you sure you want to Publish results for: <br>
                                                               <span class="badge rounded-pill bg-info fs-5">{{$course->code}} | {{$course->name}}&nbsp;</span>
                                                               <br><br>
                                                                Class: 
                                                               <span class="badge rounded-pill bg-info fs-5">{{$class->classcode}} | Semester: {{$subj->semester}} &nbsp;</span>
                                                               <br><br>
                                                                Campus: 
                                                               <span class="badge rounded-pill bg-info fs-5">{{$campus}} &nbsp;</span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('submit.grades.to.students', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay])}}">

                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Publish</button>
                                                                </a>
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>


<!-- MODAL END -->


<!-- MODAL START -->


<div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="unpublish{{$id}}{{$assessment}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="unpublish{{$id}}{{$assessment}}{{$ay}}">Publish results to students.</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            @php 
                                                            $subj = App\Models\lecturerSubjects::findOrfail($id);
                                                            $ass = App\Models\Assessmentlist::findOrfail($assessment);
                                                            $class = App\Models\programclass::findOrfail($subj->classid);
                                                            $course = App\Models\Course::findOrfail($subj->courseid);
                                                            if($subj->campus_id == 1) { $campus = 'Lilongwe';}
                                                            if($subj->campus_id == 2) { $campus = 'Blantyre';}
                                                            if($subj->campus_id == 3) { $campus = 'Zomba';}

                                                            @endphp
                                                           
                                                            <div class="modal-body">
                                                               Are you sure you want to unpublish results for: <br>
                                                               <span class="badge rounded-pill bg-info fs-5">{{$course->code}} | {{$course->name}}&nbsp;</span><br><br>
                                                                Class: 
                                                               <span class="badge rounded-pill bg-info fs-5">{{$class->classcode}} | Semester: {{$subj->semester}} &nbsp;</span>
                                                               <br><br>
                                                                Campus: 
                                                               <span class="badge rounded-pill bg-info fs-5">{{$campus}} &nbsp;</span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('unpublish.grades.to.students', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay])}}">

                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">UnPublish</button>
                                                                </a>
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>

                                            <div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="hod{{$id}}{{$assessment}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="hod{{$id}}{{$assessment}}{{$ay}}">Submit results to HOD for review.</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            @php 
                                                                $subj = App\Models\lecturerSubjects::findOrfail($id);
                                                                $ass = App\Models\Assessmentlist::findOrfail($assessment);
                                                                $class = App\Models\programclass::findOrfail($subj->classid);
                                                                $course = App\Models\Course::findOrfail($subj->courseid);

                                                                $classcoordinator = $class->coordinator;
                                                                $coordinator = null;

                                                                if (!empty($classcoordinator)) {
                                                                    $coordinator = App\Models\User::findOrFail($classcoordinator);
                                                                    $hod = $coordinator->id;
                                                                } else {
                                                                    $hod = null;
                                                                }

                                                                $department = App\Models\Department::findOrfail($coordinator->department_id);

                                                                $campus = '';
                                                                if ($subj->campus_id == 1) { $campus = 'Lilongwe'; }
                                                                if ($subj->campus_id == 2) { $campus = 'Blantyre'; }
                                                                if ($subj->campus_id == 3) { $campus = 'Zomba'; }
                                                            @endphp
                                                            <div class="modal-body">
                                                               
                                                
                                                            <span class="badge text-wrap" style="width: 100%; font-size: 1.5rem; background-color: #E6E3E3; color: black;">
                                                               <b> HOD : {{$coordinator->fname}} {{$coordinator->lname}}</b> <br>
                                                                {{$department->department_name}} - 
                                                                
                                                                {{$department->campus_id == 1 ? 'Lilongwe' : ''}}
                                                                {{$department->campus_id == 2 ? 'Blantyre' : ''}}
                                                                {{$department->campus_id == 3 ? 'Zomba' : ''}}
                                                                <br><br>

                                                                {{$course->code}} | {{$course->name}}<br>
                                                               &nbsp;Class: 
                                                               {{$class->classcode}} | Semester: {{$subj->semester}} &nbsp;<br><br>
                                                               Campus: {{$campus}}<br><br>
                                                             
                                                            </span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('submit.hod', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay, 'hod'=>$hod])}}">

                                                                <button type="submit" class="btn btn-warning waves-effect" data-bs-dismiss="modal">Submit</button> </a>

                                                         
                                                                
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
<!-- MODAL END -->

<!-- MODAL START -->
                  

                                            <div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="lecturer{{$id}}{{$assessment}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="hod{{$id}}{{$assessment}}{{$ay}}">Submit results back to lecturer.</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            @php 
                                                                $subj = App\Models\lecturerSubjects::findOrfail($id);
                                                                $ass = App\Models\Assessmentlist::findOrfail($assessment);
                                                                $class = App\Models\programclass::findOrfail($subj->classid);
                                                                $course = App\Models\Course::findOrfail($subj->courseid);

                                                               

                                                                if (!empty($subj->userid)) {
                                                                    $lecturer = App\Models\User::findOrFail($subj->userid);
                                                             
                                                                } else {
                                                                    $lecturer = null;
                                                                }

                                                                $campus = '';
                                                                if ($subj->campus_id == 1) { $campus = 'Lilongwe'; }
                                                                if ($subj->campus_id == 2) { $campus = 'Blantyre'; }
                                                                if ($subj->campus_id == 3) { $campus = 'Zomba'; }
                                                            @endphp
                                                            <div class="modal-body">
                                                               
                                                
                                                            <span class="badge text-wrap" style="width: 100%; font-size: 1.5rem; background-color: #E6E3E3; color: black;">

                                                             {{$lecturer->fname}} {{$lecturer->lname}} 
                                                             
                                                            </span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('submit.back.to.lecturer', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay, 'lecturerid'=>$lecturer->id])}}">

                                                                <button type="submit" class="btn btn-warning waves-effect" data-bs-dismiss="modal">Submit</button> </a>

                                                         
                                                                
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>

                                            <div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="backToLecturer{{$id}}{{$assessment}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                            <h5 class="modal-title" id="hod{{$id}}{{$assessment}}{{$ay}}">Submit results back to lecturer.</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            @php 
                                                                $subj = App\Models\lecturerSubjects::findOrfail($id);
                                                                $ass = App\Models\Assessmentlist::findOrfail($assessment);
                                                                $class = App\Models\programclass::findOrfail($subj->classid);
                                                                $course = App\Models\Course::findOrfail($subj->courseid);

                                                               

                                                                if (!empty($subj->userid)) {
                                                                    $lecturer = App\Models\User::findOrFail($subj->userid);
                                                             
                                                                } else {
                                                                    $lecturer = null;
                                                                }

                                                                $campus = '';
                                                                if ($subj->campus_id == 1) { $campus = 'Lilongwe'; }
                                                                if ($subj->campus_id == 2) { $campus = 'Blantyre'; }
                                                                if ($subj->campus_id == 3) { $campus = 'Zomba'; }
                                                            @endphp
                                                            <div class="modal-body">
                                                               
                                                
                                                            <span class="badge text-wrap" style="width: 100%; font-size: 1.5rem; background-color: #E6E3E3; color: black;">

                                                             {{$lecturer->fname}} {{$lecturer->lname}} 
                                                             
                                                            </span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('submit.back.to.lecturer', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay, 'lecturerid'=>$lecturer->id])}}">

                                                                <button type="submit" class="btn btn-warning waves-effect" data-bs-dismiss="modal">Submit</button> </a>

                                                         
                                                                
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>

                                            


<!-- MODAL END -->
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