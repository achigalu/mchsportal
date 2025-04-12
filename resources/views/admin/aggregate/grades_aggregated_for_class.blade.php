
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Aggregating students grades</title>
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
       
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 1px;
            text-align: left;
        }
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #004085;
            color: #ffffff;
            font-weight: bold;
        }
        td {
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td:first-child {
            text-align: left;
            font-weight: bold;
        }
        .pass {
            color: #28a745;
            font-weight: bold;
        }
        .fail {
            color: #dc3545;
            font-weight: bold;
        }
        caption {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .bold-row td {
            font-weight: bold;
            background-color: #f2f2f2; /* Optional: Light gray background for better visibility */
        }
        
        .Pass { color: #28a745 !important; font-weight: bold; }
        .Sup { color: #ffc107 !important; font-weight: bold; }
        .Repeat { color: #dc3545 !important; font-weight: bold; }
    
    </style>
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
                                   
                                    <h1></h1>
                                    <div class="page-title-right">
                                    
                                                @php 
                                                $lecturer = Auth::user()->id;
                                                $i = 1;
                                                @endphp
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('class.aggregated.grades.pdf', [$ay, $class, $semester])}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-file-pdf" style="color:gray;" ></i>&nbsp;&nbsp;Export PDF</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       </a>
                                       @php
                                       $studentaccess = App\Models\Studentsubject::where('academicyr_id', $ay)
                                        ->where('programclass_id', $class)
                                        ->where('semester', $semester)
                                        ->where('campus_id', $campusID)
                                        ->get();

                                        $hasAccess = $studentaccess->contains('access_final_grade', 0);
                                        @endphp

                                       @can('publish end of semester results')
                                       @if($hasAccess)
                                        <li class="btn btn-outline-danger" data-bs-toggle="modal" 
                                        data-bs-target="#publishToStudents{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}">
                                        <i class="mdi mdi-publish" style="color:gray;" ></i>&nbsp;&nbsp;Publish to students</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      
                                      @else
                                        <li class="btn btn-outline-danger" data-bs-toggle="modal"
                                         data-bs-target="#unpublishFromStudents{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}">
                                         <i class="mdi mdi-publish" style="color:gray;"></i>&nbsp;&nbsp;Unpublish from students</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       
                                         <li class="btn btn-outline-danger" data-bs-toggle="modal"
                                         data-bs-target="#signoff{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}">
                                         <i class="mdi mdi-publish" style="color:gray;"></i>&nbsp;&nbsp;SignOff</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      @endif
                                      @endcan
                                       
                                        <a href="{{route('class.aggregated.grades')}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="page-title-right">
                        <h4 class="mb-sm-0">Aggregated marks for: {{$myclass->classcode}}-Sem {{$semester}} - {{$mycampus}} |
                             {{$acyear->ayear}} {{$acyear->month}} {{$acyear->description}}</h4> 
                        </div>

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
<br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                    <div class="custom-table-container card">

                                    @php
    use App\Models\User;

    // Retrieve all students in one query to avoid multiple DB hits
    $regNumbers = collect($finalResults)->pluck('registration_no')->toArray();
    $students = User::whereIn('reg_num', $regNumbers)->get()->keyBy('reg_num');

    // Initialize Counters
    $totalStudents = count($finalResults);
    $totalPasses = 0;
    $totalSups = 0;
    $totalFails = 0;
    $totalGradeSum = 0;  // To calculate average grade for the class
@endphp

<div class="card-body">
    <div class="table-responsive custom-table-wrapper">
        <table>
            <thead class="custom-table-head">
                <tr style="text-align: left; background-color: #295587; color: white;">
                    <th style="text-align: left;">SN</th>
                    <th style="text-align: left;">STUDENT NAME</th>
                    @foreach ($headers as $header)
                        <th>{{ strtoupper($header) }}</th>
                    @endforeach
                    <th>REMARK</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($finalResults as $row)
                    @php
                        // Fetch student details from the preloaded $students collection
                        $student = $students[$row['registration_no']] ?? null;
                        $grades = array_values(array_slice($row, 1)); // Extract grades only

                        // Count fails and supplements
                        $failCount = collect($grades)->filter(fn($grade) => $grade < 40)->count();
                        $supCount = collect($grades)->filter(fn($grade) => $grade >= 40 && $grade < 50)->count();

                        // Determine remark and update counters
                        if ($failCount == 0 && $supCount == 0) {
                            $remark = "Pass";
                            $color = "green";
                            $totalPasses++;
                        } elseif ($supCount > 0 && $supCount <= 2 && $failCount == 0) {
                            $remark = "Sup";
                            $color = "orange";
                            $totalSups++;
                        } else {
                            $remark = "Fail";
                            $color = "red";
                            $totalFails++;
                        }

                        // Calculate average grade for the class summary
                        $averageGrade = round(array_sum($grades) / count($grades));
                        $totalGradeSum += $averageGrade;
                    @endphp

                    <tr>
                        <td>{{ $i++ }}</td>
                        <td class="custom-name" style="text-align: left;">{{ $student ? $student->fname . ' ' . $student->lname : 'Unknown' }}</td>
                        <td class="custom-registration">{{ $row['registration_no'] }}</td>
                        
                        @foreach ($grades as $grade)
                            <td class="custom-grade">{{ $grade }}</td>
                        @endforeach

                        <td class="custom-remark" style="color: {{ $color }}; font-weight: bold;">
                            {{ $remark }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <h4>Class Assessment Summary</h4>
        @php
            // Calculate class average grade
            $classAverageGrade = $totalStudents > 0 ? round($totalGradeSum / $totalStudents, 2) : 0;

            // Calculate percentages (avoid division by zero)
            $passPercentage = $totalStudents > 0 ? round(($totalPasses / $totalStudents) * 100, 2) : 0;
            $supPercentage = $totalStudents > 0 ? round(($totalSups / $totalStudents) * 100, 2) : 0;
            $failPercentage = $totalStudents > 0 ? round(($totalFails / $totalStudents) * 100, 2) : 0;
        @endphp

      <!--  <h5>Average Grade: {{ $classAverageGrade }}</h5> -->

        <table border="1">
            <thead>
                <tr style="text-align: left; background-color: #f1f1f1; color: black;">
                    <td>Number of Students</td>
                    <td>Total Passes</td>
                    <td>% Passes</td>
                    <td>Total Sups</td>
                    <td>% Sups</td>
                    <td>Total Fails</td>
                    <td>% Fails</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{ $totalStudents }}</td>
                    <td>{{ $totalPasses }}</td>
                    <td>{{ $passPercentage }}%</td>
                    <td>{{ $totalSups }}</td>
                    <td>{{ $supPercentage }}%</td>
                    <td>{{ $totalFails }}</td>
                    <td>{{ $failPercentage }}%</td>
                </tr>
            </tbody>
        </table>
<br>
        <h4>Modules</h4>
                    @if(session()->has('courses'))
                <ul>
                    @foreach(session('courses') as $course)
                        <li>{{ $course->code }} - {{ $course->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No courses available.</p>
            @endif

    </div>
</div>



                                    
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                        </div>
                        <!-- end row-->

                        <div class="modal fade" id="unpublishFromStudents{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="">Un Publish Results from students</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                         
                                                           
                                                            <div class="modal-body">
                                                               un Publish results for: <br>
                                                               Class:
                                                               <h4>{{$myclass->classcode}} | Semester: {{$semester}}&nbsp;</h4>
                                                               
                                                                Intake: 
                                                               <h4>{{$acyear->ayear}} {{$acyear->month}} {{$acyear->description}} &nbsp;</h4>
                                                               
                                                                Campus: 
                                                               <h4>{{$mycampus}} &nbsp;</h4>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                                                                <form action="{{route('unpublish.class.modules',['ay'=>$ay, 'class'=>$class, 'semester'=>$semester, 'campus'=>$campusID, 'publish'=>1])}}" method="POST">
                                                                    @csrf
                                                              
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">un Publish</button>
                                                                
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            


                                            <div class="modal fade" id="publishToStudents{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="">Publish Results to students</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                         
                                                           
                                                            <div class="modal-body">
                                                               Publish results for: <br>
                                                               Class:
                                                               <h4>{{$myclass->classcode}} | Semester: {{$semester}}&nbsp;</h4>
                                                               
                                                                Intake: 
                                                               <h4>{{$acyear->ayear}} {{$acyear->month}} {{$acyear->description}} &nbsp;</h4>
                                                               
                                                                Campus: 
                                                               <h4>{{$mycampus}} &nbsp;</h4>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                                                                <a href="{{ route('aggregate.class.marks', ['ay' => $ay, 'class' => $class, 'semester' => $semester, 'campus' => $campusID]) }}">
                                                                <form action="{{ route('publish.class.modules', ['ay' => $ay, 'class' => $class, 'semester' => $semester, 'campus' => $campusID]) }}" method="POST">
                                                                @csrf
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">Publish</button>
                                                                </form>
                                                                </a>
                                                                
                                                                
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            

                                            <div class="modal fade" id="signoff{{$myclass->classcode}}{{$semester}}{{$mycampus}}{{$acyear->ayear}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="">Signing off </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                         
                                                           
                                                            <div class="modal-body">
                                                              
                                                               Class:
                                                               <h4>{{$myclass->classcode}} | Semester: {{$semester}}&nbsp;</h4>
                                                               
                                                                Intake: 
                                                               <h4>{{$acyear->ayear}} {{$acyear->month}} {{$acyear->description}} &nbsp;</h4>
                                                               
                                                                Campus: 
                                                               <h4>{{$mycampus}} &nbsp;</h4>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>
                                                                <form action="{{route('signing.off.class',['ay'=>$ay, 'class'=>$class, 'semester'=>$semester, 'campus'=>$campusID, 'publish'=>1])}}" method="POST">
                                                                    @csrf
                                                              
                                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">SignOff</button>
                                                                
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                        
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