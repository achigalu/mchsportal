
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | Allocate Subjects to Lecturers</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
<!-- DataTables -->
        <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
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
                                    <h4 class="mb-sm-0"></h4>

                                    <div class="page-title-right">
<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" 
aria-expanded="false"><i class="fas fa-download"></i>&nbsp;&nbsp;Download &nbsp;&nbsp;<i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">Exel</a>
    <a class="dropdown-item" href="#">PDF</a>
   
</div>
                                        <ul class="breadcrumb m-0">
                                        <a href="{{route('subjects.to.lecturers')}}">
                                        <li class="btn btn-secondary"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </a>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

<!-- start page title -->


<div class="row">
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h4 class="card-title">Assign Subjects to Lecturers</h4>
@if(session()->has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<i class="mdi mdi-check-all me-2"></i>
{{session()->get('status')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('invalid'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<i class="mdi mdi-block-helper me-2"></i>
{{session()->get('invalid')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif 

@if(!empty($data))

                      @php
                      $campus = App\Models\Campus::all()
                      @endphp 
                      @php
                      $academic = App\Models\Academicyear::where('status',1)->get()
                      @endphp 
                      <form action="{{route('modules.to.lecturers')}}" method="post">
                     @csrf
                    <div class="row">
                    <div class="form-group col-md-6">
                    <label for="">Class</label>
                    <div class="card bg-light text-dark">
                     
                    <div class="card-body" >
                    <select class="form-control select2" name="class_id" aria-label="Default select example" required>
                    <option value="" selected="">-- select --</option>
                    
                    @foreach($data as $myclass)
                  
                    <option value="{{$myclass->programclass_id}}">{{$myclass->classcode}} - @if($myclass->campus_id==1) LL @endif @if($myclass->campus_id==2) BT  @endif @if($myclass->campus_id==3) ZA  @endif</option>

                    @endforeach
                   
                    </select>
                    </div>

                    
                    </div>
                    </div>

                    <div class="form-group col-md-2">
                    <label for="">Semester</label>
                    <div class="card bg-light text-dark">
                     
                    <div class="card-body" >
                    <select class="form-control select" name="semester" aria-label="Default select example" required>
                    <option value="" selected="">-- select --</option>
                
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select>
                    </div>

                    
                    </div>
                    </div>

                    


                    <div class="form-group col-md-4">
                    <label for="" ></label>
                        <div class="card bg-light text-dark">
                        
                    <div class="card-body">
                    <button class="btn btn-info" type="submit" style="margin-top: 8px;">Allocate Subjects to lecturers</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    
                    
                    </div>





</div>
</div>
</div>
<!-- end select2 -->
@endif
</div>

@if(!empty($myclassSubjects))
<div class="row">

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr style="background-color:#e6e6e6;">
                                                <th>#</th>
                                                <th>Class</th>
                                                <th>Subject Code</th>
                                                <th>Subject Name</th>
                                                <th>Semester</th>
                                                <th>Assign Lecturers</th>
                                                
                                            </tr>
                                            </thead>
                                           
                                             <tbody>         
                                        
                                        @php $id = 0 @endphp <!-- Move the initialization outside of the loop -->
                                        @foreach($myclassSubjects as $subject)
                                        <tr>

                                            <td>{{ ++$id }}</td>
                                            <td>
                                            {{$subject->classcode}} - @if($subject->campus_id==1)LL @endif
                                            @if($subject->campus_id==2)BT @endif
                                            @if($subject->campus_id==3)ZA @endif
                                            </td>
                                            <td>
                                            @php
                                            $coursecode = App\Models\Course::find($subject->course_id) 
                                            @endphp
                                            {{$coursecode->code}} 
                                            </td>
                                            
                                            <td>{{$coursecode->name}}</td>

                                            <td>{{$subject->semester}}</td>

                                                <td>
                                                   
                                                    <div class="row">
                                                        <div class="col">
                                                        @php 
                                                        $lecturers = App\Models\lecturerSubjects::where('courseid',$subject->course_id)->get()
                                                        @endphp

                                                        @if(!empty($lecturers))

                                                        @foreach($lecturers as $lecturer)
                                                        
                                                        @php
                                                        $user = App\Models\User::find($lecturer->userid)
                                                        @endphp

                                                        {{$user->fname}} {{$user->lname}} 
                                                        <span class="badge rounded-pill bg-warning" data-bs-toggle="modal" data-bs-target="#deleteLecturer{{$user->lname}}"><i class="fas fa-user-times"></i></span>

                                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-1 text-center">
                                                    
                                                
                                                    <!-- Small modal -->
                                                   
                                                </div>
                                            @if(!empty($subject))
                                                <div class="modal fade" id="deleteLecturer{{$user->lname}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Are you sure to delete</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                            Are you sure to delete lecturer <span style="color:red;">{{$user->fname}} {{$user->lname}}</span>
                                                             from <br>{{$coursecode->code}} | {{$coursecode->name}} -  @if($subject->campus_id==1)LL @endif
                                                            @if($subject->campus_id==2)BT @endif
                                                            @if($subject->campus_id==3)ZA @endif ?
                                                               
                                                            </div>
                                                           
                                                            <form action="{{route('delete.moduleLecturer', $user->id)}}" method="post">
                                                                @csrf
                                                                @if(!empty($class_id))
                                                                <input type="hidden" value="{{$class_id}}" name="class_id">
                                                                <input type="hidden" value="{{$semester}}" name="semester">
                                                                <input type="hidden" value="{{$coursecode->id}}" name="course_id">
                                                                <input type="hidden" value="{{$subject->campus_id}}" name="campus_id">
                                                                @endif
                                                           
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-warning waves-effect waves-light">Yes</button>
                                                            </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                        @endif

                                                      
                                    @endforeach
                                    @endif
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    <span class="badge rounded-pill bg-success me-1" data-bs-toggle="modal" data-bs-target="#addLecturer{{$subject->course_id}}"><i class="fas fa-user-plus"></i></span>
                                                </td>


                                        </tr>

                                        <div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="addLecturer{{$subject->course_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Allocate lecturer to subject</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               <form action="{{route('allocate.modules.to.lecturers')}}" method="post">
                                                                @csrf
                                                                @if(!empty($class_id))
                                                                <input type="hidden" value="{{$class_id}}" name="class_id">
                                                                <input type="hidden" value="{{$semester}}" name="semester">
                                                                <input type="hidden" value="{{$subject->course_id}}" name="course_id">
                                                                <input type="hidden" value="{{$subject->campus_id}}" name="campus_id">
                                                                @endif
                                                              <select name="lecturer_id" class="form-control" id="" required>
                                                                <option value="">-- Select lecturer --</option>
                                                                @php 
                                                                $lecturers = App\Models\User::where('role', 'lecturer')->get();
                                                                @endphp
                                                                @foreach ($lecturers as $lecturer)
                                                                <option value="{{$lecturer->id}}">{{$lecturer->fname}} {{$lecturer->lname}}</option>
                                                                
                                                                @endforeach
                                                              </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-secondary waves-effect waves-light">Assign</button>
                                                                </form> 
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>


                                        @endforeach
                                      
                                            </tbody>
                                        </table>
                                      
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

@endif
</div>
</div>
</div>
<!-- end select2 -->

</div>





</div>
<!-- end row -->

<!-- end row -->

                                       

                                           







   <!-- start page title -->


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
  <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
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