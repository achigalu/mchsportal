
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Student Information</title>
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

                      <!-- Start Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Student Information</h4> 

            <div class="page-title-right">   
                <!--
                <a href="{{route('add.class.modules.to.single.student',['student_id'=>$student->id])}}" class="btn btn-outline-primary">
                <i class="fas fa-plus"></i> Delete student modules
                </a>
                
                <a href="#" class="btn btn-outline-primary">
                <i class="far fa-trash-alt"></i> Add Modules
                </a>
                -->
                <a href="#" class="btn btn-outline-primary">
                    <i class="fas fa-file-pdf"></i> Print Profile
                </a>

                <a href="{{route('edit.student',['studentID'=>$student->id])}}" class="btn btn-outline-info">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>

                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fas fa-exchange-alt"></i> Transfer Student
                </button>

                <a href="{{ route('all.students.list') }}" class="btn btn-outline-secondary">
                    <i class="far fa-arrow-alt-circle-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>  
<!-- End Page Title -->

                        <!-- start page title -->
                        <div class="row">    
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                @php 
                                    $studentProfile = App\Models\Studentprofile::where('user_id', $student->id)->first();
                                    @endphp

                                @if(!empty($studentProfile->photo))
                                    <img src="{{ $studentProfile->photo ? url('uploads/students_photo/'.$studentProfile->photo) :  url('uploads/students_photo/3.jpg') }}" 
                                    style="width: 100px; height: 100px; margin-top: 20px;" class="avatar-md rounded-circle mx-auto d-block"> 
                                    @else
                                    <img src="{{ url('uploads/students_photo/3.jpg') }}" 
                                    style="width: 100px; height: 100px; margin-top: 20px;" class="avatar-md rounded-circle mx-auto d-block"> 
                                    @endif
                                

                                    <div class="card-body" style="text-align: center;">
                                        <div class="card" style="background-color:AliceBlue; padding:10px;"><br>
                                        <h5 class="card-title;" style="color: orange;">{{$student->fname}} {{$student->lname}}</h5>
                                        <h6 class="card-title;" style="color: skyblue;">{{$student->reg_num}}</h6>

                                        <p class="card-text">{{$student->programclass}} , Sem : {{$student->semester}} - {{$student->campus}}</p>
                                       &nbsp;
                                    </div>
                                        <!--
                                        <a href="#" class="btn btn-info waves-effect waves-light">Edit page</a>
                                    -->
                                    </div>
                                </div>
        
                            </div><!-- end col -->
        

                            <div class="col-md-6 col-xl-9">
        
    
                            <div class="card">
            <div class="card-body" style="text-align: left;">
                <div class="card" style="background-color:AliceBlue; padding:10px;">
    


                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Status</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th style="width: 120px;">Salary</th>
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                                    <tr>
                                                        <td><h6 class="mb-0">coming soon</h6></td>
                                                        <td>coming soon</td>
                                                        <td>
                                                            <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>coming soon</div>
                                                        </td>
                                                        <td>
                                                        coming soon
                                                        </td>
                                                        <td>
                                                        coming soon
                                                        </td>
                                                        <td>coming soon</td>
                                                    </tr>
                                                     <!-- end -->
                                                 
                                                     <!-- end -->
                                                </tbody><!-- end tbody -->
                                            </table> <!-- end table -->

                                            
            </div>

            </div>
       
        </div>

    </div><!-- end col -->
                        
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
       


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Made it wider -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-exchange-alt"></i> Change Student Class/Program/Campus</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p><strong>Current Details:</strong></p>
                <p class="mb-3">
                    <strong>Name:</strong><strong style="color: orange;"> {{$student->fname}} {{$student->lname}}</strong>  <br>
                    Class: <strong style="color: red;">{{$student->programclass}} | {{$student->semester}} - {{$student->campus}}</strong>
                </p>

                <hr>
                @php 
                $pclass = App\Models\Programclass::all();
                @endphp
                <form action="{{route('single.student.change.class')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="student_id" value="{{$student->id}}">
                        <label for="newClass" class="form-label">New Class</label>
                        <select class="form-select" id="newClass" name="class_id">
                            <option value="">Select Class</option>
                            @foreach($pclass as $class)
                            <option value="{{$class->id}}">{{$class->classcode}} | 
                                @if($class->campus_id==1)LL @endif
                                @if($class->campus_id==2)BT @endif
                                @if($class->campus_id==3)ZA @endif
                            </option>
                            @endforeach
                            <!-- Populate options dynamically -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="newSemester" class="form-label">New Semester</label>
                        <select class="form-select" id="newSemester" name="semester_id">
                            <option value="">Select Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <!-- Populate options dynamically -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Transfer</label>
                        <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Provide reason..."></textarea>
                    </div>
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

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