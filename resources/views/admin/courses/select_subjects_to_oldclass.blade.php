
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
                                    <h4 class="mb-sm-0">Add Subjects to Old Class</h4>

                                    <div class="page-title-right">
                                    <div class="btn-group">
<button type="button" class="btn btn-secondary"><i class="fas fa-download"></i>&nbsp;&nbsp;Download</button>
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="mdi mdi-chevron-down"></i>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a>
    <a class="dropdown-item" href="#">PDF</a>
   
</div>

                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('add.subject.to.old.class')}}"><li class="btn btn-secondary">
                                        <i class=" fas fa-arrow-left"></i>&nbsp;&nbsp;Back</li></a>&nbsp;

                                        <a href="{{route('view.courses')}}">
                                        <li class="btn btn-secondary"><i class="fa fa-cog"></i>&nbsp;&nbsp;Configure Subjects</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
@php
$class = App\Models\Programclass::where('id', $class)->first();
$class_subjects = App\Models\Myclasssubject::where('programclass_id', $class->id)->get()
@endphp



                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    @if(session()->has('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i>
                                        {{session()->get('message')}}
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
    
                                        <h4 class="card-title mb-4"></h4>@error('class_id') <span class="text-danger">{{$message}}</span> @enderror
                                        <form action="{{route('add.subjects.to.old.class')}}" method="post">
                                            @csrf
                                        <div class="table-responsive input-group">
                                        <input type="text" name="class_id" value="{{$class->id}}" hidden>
                                    
                                        
                                       Assign Subjects to: &nbsp;<h3 class="badge rounded-pill bg-success">{{$class->classcode}}</h3> 
                                       
                                       <h3 class="badge rounded-pill bg-success">
                                       @if($class->campus_id ==1) Lilongwe Campus @endif
                                       @if($class->campus_id ==2) Blantyre Campus @endif
                                        @if($class->campus_id ==3) Zomba Campus @endif
                                       </h3> 
                                      &nbsp;semester: &nbsp; <h3 class="badge rounded-pill bg-warning">{{$semester}}</h3>
                                      @php
                                      $academicyear = App\Models\Academicyear::find($ay)
                                      @endphp
                                      &nbsp;&nbsp;Intake: &nbsp;&nbsp; <h3 class="badge rounded-pill bg-warning">{{$academicyear->ayear}} {{$academicyear->month}} {{$academicyear->description}}</h3>
                                     
                                       @error('subject_id') <span class="text-danger"></span> @enderror 
                                        </div>
                                        <input type="text" name="academicyr" value="{{$ay}}" hidden>
                                        <input type="text" name="class" value="{{$class->id}}" hidden>
                                        <input type="text" name="semester" value="{{$semester}}" hidden>

            
                                        <div class="table-responsive input-group">
                                        
                                        <select class="form-select shadow-none form-select-sm" name="subject_id" required>
                                        <option selected value="">--Select--</option>
                                        @foreach($subjects as $subject)
                        
                                            <option value="{{$subject->id}}">{{$subject->code}} {{$subject->name}}</option>
                                        @endforeach
                                            </select>&nbsp;&nbsp;

                                            <button type="submit" class="btn btn-warning">Assign</button>
                                        </div>
                                        </form>
                                    </div><!-- end card -->
                                </div><!-- end card -->
                                 
                            <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color: #f0f0f0;">
                                                <th>Semester</th>
                                                <th>Subject Code</th>
                                                <th>Subject Name</th>
                                                <th>Exam Weight(%)</th>
                                                <th>CA Weight(%)</th>
                                                <th>Is Major</th>
                                                <th>Lecturers</th>
                                                <th>Actions</th>
                                                
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            @forelse($class_subjects as $subjects)
                                           <tr>
                                            <td>{{$subjects->semester}}</td>
                                           
                                            <td>{{$subjects->course->code}}</td>
                                            <td>{{$subjects->course->name}}</td>
                                            <td>{{$subjects->exam_weight}}</td>
                                            <td>{{$subjects->ca_weight}}</td>
                                            <td>{{($subjects->is_major ==1)? 'Yes' : 'No'}}</td>
                                            <td>-------</td>
                                            <td>
                                                <a href=""><button class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></button></a>
                                                  
                                                <button class="btn btn-outline-warning"><i class="fas fa-trash"></i></button></td>
                                            @empty
                                            <p>No data to show</p>
                                           </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
     
                            </div>
                            <!-- end col -->
                           
                        </div>
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