
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
                                    <h4 class="mb-sm-0">Subject Configurations</h4>

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
                                        <a href="{{route('add.subject.to.class')}}"><li class="btn btn-secondary">
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
@endphp

@php
$class_subjects = App\Models\Myclasssubject::where('programclass_id', $class->id)
->where('semester', $semester)
->whereNull('academicyear_id')
->get()
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
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i>
                                        {{session()->get('invalid')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endif
    
                                        <h4 class="card-title mb-4"></h4>@error('class_id') <span class="text-danger">{{$message}}</span> @enderror
                                        <form action="{{route('config.class.subjects')}}" method="post">
                                            @csrf
                                        <div class="table-responsive input-group">
                                        <input type="text" name="class_id" value="{{$class->id}}" hidden>
                                        <input type="text" name="semester" value="{{$semester}}" hidden>
                                       <h4>
                                       Assign Subjects to: <span style="color: red;"> 


                                        {{$class->classcode}} 
                                        - @if($class->campus_id ==1) LL @endif
                                          @if($class->campus_id ==2) BT @endif
                                          @if($class->campus_id ==3) ZA @endif
                                          - Semester : <span class="badge rounded-pill bg-info float-end">{{$semester}}</span>
                                        
                                        </span>
                                       </h4> 
                                    
                                       @error('subject_id') <span class="text-danger">{{$message}}</span> @enderror 
                                        </div>
            
                                        <div class="table-responsive input-group">
                                        
                                        <select class="form-select shadow-none form-select-sm" name="subject_id" required>
                                        <option selected value="">--Select--</option>
                                        @foreach($subjects as $subject)
                        
                                            <option value="{{$subject->id}}">{{$subject->code}} {{$subject->name}}</option>
                                            @endforeach
                                            </select>&nbsp;&nbsp;
                                           
                                            
                                            <button type="submit" class="btn btn-warning">Config</button>
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
                                                <th>S/N</th>
                                                <th>SEMESTER</th>
                                                <th>SUBJECT CODE</th>
                                                <th>SUBJECT NAME</th>
                                                <th>EXAM WEIGHT(%)</th>
                                                <th>CA WEIGHT(%)</th>
                                                <th>IS MAJOR</th>
                                                <th>ACTIONS</th>
                                                
                                            </tr>
                                            </thead>
        
                                            @php $i = 1; @endphp
                                            <tbody>
                                            @forelse($class_subjects as $subjects)
                                           <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$subjects->semester}}</td>
                                           
                                            <td>{{$subjects->course->code}}</td>
                                            <td>{{$subjects->course->name}}</td>
                                            <td>{{$subjects->exam_weight}}</td>
                                            <td>{{$subjects->ca_weight}}</td>
                                            <td>{{($subjects->is_major ==1)? 'Yes' : 'No'}}</td>
                                            <td>
                                                <a href="{{route('edit.assigned.subject', ['subj_id'=>$subjects->id, 'class_id'=>$class->id,'semester'=>$semester] )}}"><button class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></button></a>
                                                  
                                                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#deleteClassSubject{{$subjects->id}}-{{$classAY}}"><i class="fas fa-trash"></i></button></td>

 <!-- MODAL START -->


<div class="col-sm-6 col-md-4 col-xl-3">
<div class="my-4 text-center">
    
</div>

<div class="modal fade" id="deleteClassSubject{{$subjects->id}}-{{$classAY}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Class Subject.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                Are you sure you want to delete 
                <span class="badge rounded-pill bg-info fs-5">
                {{$subjects->course->code}} | {{$subjects->course->name}}
                &nbsp;</span>
                <br><br>
                for class: 
                    <span class="badge rounded-pill bg-secondary" style="font-size: 0.9rem;">
                {{$class->classcode}} 
                - @if($class->campus_id ==1) LL @endif
                    @if($class->campus_id ==2) BT @endif
                    @if($class->campus_id ==3) ZA @endif
                    - Semester : {{$semester}}</span>
                                   
                                        
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                <a href="{{route('delete.assigned.subject', ['subj_id'=>$subjects->id, 'class_id'=>$class->id,'semester'=>$semester, 'ay'=>$classAY])}}">

                <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </a>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>


<!-- MODAL END -->
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