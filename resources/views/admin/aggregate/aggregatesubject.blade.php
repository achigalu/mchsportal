
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
                                        <a href="{{route('aggregated.subject.pdf', ['id'=>$id, 'ay'=>$ay])}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-file-pdf" style="color:gray;" ></i>&nbsp;&nbsp;Export PDF</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       </a>
                                       
                                        <li class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hod{{$id}}{{$ay}}"><i class="mdi mdi-publish" style="color:gray;" ></i>&nbsp;&nbsp;Submit to HOD</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        <a href="{{route('list.assessments', ['courseid'=>$id, 'ay'=>$ay])}}">
                                        <li class="btn btn-outline-info"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <h4 class="mb-sm-0">Module aggregation: 
                                    &nbsp;
                                    {{$coursename->code}} - {{$coursename->name}} &nbsp;
                                    &nbsp;{{$class->classcode}} - 
                                    
                                    @if($class->campus_id==1) LL @endif
                                    @if($class->campus_id==2) BT @endif 
                                    @if($class->campus_id==3) ZA @endif - Semester  {{$lecturerModule->semester}} 
                                   </h4><P></P>
                                   <h5> Lecturer: {{$fname}} {{$lname}}</h5>
                      
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
<table>
 
  <tr>
    
    <th colspan="3">Student</th>
    <th colspan="3">Continuous Assessment (40%)</th>
    <th colspan="2">End of Semester (60%)</th>
    <th>Final Grade</th>
    <th>Remark</th>
 
  </tr>
  <tr class="bold-row">
    <td>No.</td>
    <td>Name</td>
    <td>Registration#</td>
    <td>Assignment 1</td>
    <td>Mid Semester</td>
    <td>40%</td>
    <td>EoS Grade</td>
    <td>60%</td>
    <td>100%</td>
    <td> - </td>
  </tr>
  @foreach($aggregatedGrades as $myGrades)
   
    @php 
        $stuWithGrades = App\Models\User::findOrFail($myGrades->user_id);   
    @endphp
  <tr>
    <td>{{$i++}}</td>
    <td style="text-align: left;">{{$stuWithGrades->fname}} {{$stuWithGrades->lname}}</td>

    <td>{{$myGrades->registration_no}}</td>

    <!-- Assignment 1 -->
    <td>{{$myGrades->assessment1 ?? '-'}}</td>

     <!-- Mid Semester -->
    <td>{{$myGrades->assessment2 ?? '-'}}</td>

    <!-- Computed 40% -->
    <td>{{$myGrades->computed40 ?? '-'}}</td>

    <td>{{$myGrades->exam_grade ?? '-'}}</td>

    <!-- Computed 60% -->
    <td>{{$myGrades->computed60 ?? '-'}}</td>


    <!-- Remark --> 
    <!-- Computed final grade-->
      <!-- Computed final grade-->
    <td @if($myGrades->final_grade >= 50) class="text-success font-weight-bold" 
        @elseif($myGrades->final_grade >= 40 && $myGrades->final_grade < 50) class="text-warning font-weight-bold"
        @elseif($myGrades->final_grade < 40) class="text-danger font-weight-bold" 
        @endif><strong>{{$myGrades->final_grade}}</strong></td>

    <!-- Remark --> 
@if($myGrades)
    @if($myGrades->final_grade >= 50)
    <td class="Pass text-success">Pass</td>
    @elseif($myGrades->final_grade >= 40 && $myGrades->final_grade < 50)
        <td class="Sup text-warning">Sup</td>
    @elseif($myGrades->final_grade < 40)
        <td class="Repeat text-danger">Fail</td>
    @endif
@else
<td class="Sup text-warning">---</td>
@endif
  </tr>
@endforeach

</table>

<br>
    <h4>Module assessment summary</h4>
    <p>Average Final Grade: <strong>{{ round($averageFinalGrade, 2) }}</strong></p>
    <table>
        
      <tr>
            <td>Number of Students</td>
            <td>Total Number of Passes</td>
            <td>% Passes</td>
            <td>Number of Sups</td>
            <td>% Sups</td>
            <td>Number of Repeats</td>
            <td>% Repeats</td>

        </tr>
        <tr>
        <td style="text-align: center;">{{$stuCount}}</td>
            <td>{{ round($passCount, 2)}}</td>
            <td>{{ round($passRate, 2)}}</td>
            <td>{{ round($supCount, 2)}}</td>
            <td>{{ round($supRate, 2)}}</td>
            <td>{{ round($repeatCount, 2)}}</td>
            <td>{{ round($repeatRate, 2)}}</td>
        </tr>
    </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

                        <!-- end row-->

                        <div class="modal fade" id="hod{{$id}}{{$ay}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="hod{{$id}}{{$ay}}">Submit grades to HOD</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                         
                                                           
                                                            <div class="modal-body">
                                                               Are you sure you want to Publish results for: <br>
                                                               <span class="badge rounded-pill bg-info fs-5">$id&nbsp;</span>
                                                               <br><br>
                                                                Class: 
                                                               <span class="badge rounded-pill bg-info fs-5">$id &nbsp;</span>
                                                               <br><br>
                                                                Campus: 
                                                               <span class="badge rounded-pill bg-info fs-5">$id &nbsp;</span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="">

                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Publish</button>
                                                                </a>
                                                                
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