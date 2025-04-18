
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




@if(!empty($singleStudent))
@php 
$acy = App\Models\Academicyear::find($singleStudent->academicyear_id)
@endphp
@endif


<div class="row">
<div class="col-lg-12">

<div class="card">
    
<div class="card-body">
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0">{{$title}}</h4>

<div class="page-title-right">

<div class="btn-group">
<button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" 
aria-expanded="false"><i class="fas fa-download"></i>&nbsp;&nbsp;Download List &nbsp;&nbsp;<i class="mdi mdi-chevron-down"></i></button>
</button>&nbsp;&nbsp;
<div class="dropdown-menu">
<a class="dropdown-item" href="{{route('view.exam.numbers.inexcel', ['pclass'=>$singleStudent->programclass,
'pcampus'=>$singleStudent->campus, 'semester'=>$singleStudent->semester, 'count'=>$count, 'acdyear'=>$singleStudent->academicyear_id])}}"><span class="mdi mdi-file-excel" style="color: green;"></span>&nbsp; Exel</a>
<a class="dropdown-item" href="{{route('view.exam.numbers.inpdf', ['pclass'=>$singleStudent->programclass,
'pcampus'=>$singleStudent->campus, 'semester'=>$singleStudent->semester, 'count'=>$count, 'acdyear'=>$singleStudent->academicyear_id])}}"><span class="mdi mdi-file-pdf-box" style="color: red;"></span>&nbsp; PDF</a>
</div>

<ul class="breadcrumb m-0">

<a href="{{route('student.exam.numbers')}}">
<li class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Back</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</a>

@can('delete examination numbers')
<li class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteExamNumbers"><span class="mdi mdi-delete-circle"></span>&nbsp;&nbsp;Delete Exam Numbers</li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
@endcan

</ul>


</div>

</div>
</div>
</div>
</div>

                        <!-- end page title -->




<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                   

                                    
                                        <h4 class="card-title">Exam Numbers for Class: &nbsp;<span class="badge rounded-pill bg-info fs-6"> {{$singleStudent->programclass}} - {{$singleStudent->campus}} &nbsp;</span>
                                        
                                         Semester: &nbsp;
                                        <span class="badge rounded-pill bg-info fs-6"> {{$singleStudent->semester}} &nbsp;</span></h4><br>

<form id="checkboxForm">
    @csrf
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr style="background-color:#e6e6e6;">
                <th>#</th>
                <th>Student#</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Exam Numbers</th>
                 @can('exam num fee checkbox')
                <th>Fees Status</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($students as $student)
                <tr>
                    <td>{{$i++}}</td>
                  
            @php 
            $fees = App\Models\savedExamNumbers::where('reg_num', $student->reg_num)->first();
            @endphp
                       
                    <td>{{ $student->reg_num }}</td>
                    <td>{{ $student->fname }} {{ $student->lname }}</td>
                    <td>{{ $student->gender }}</td>
                    
                              @if($fees && !empty($fees->exam_number))
                                <td>{{ $fees->exam_number }}</td>
                                <td>
                                    @can('exam num fee checkbox')
                                    <input type="checkbox" class="student-checkbox" data-id="{{ $student->id }}" 
                                           {{ $fees->fee_status == 1 ? 'checked' : '' }}>
                                    @endcan
                                </td>
                             @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.student-checkbox').change(function () {
            const studentId = $(this).data('id');
            const feeStatus = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('student.fee.checkbox') }}",
                method: "POST",
                data: {
                    _token: $('input[name="_token"]').val(),
                    student_id: studentId,
                    fee_status: feeStatus,
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert("An error occurred while updating the fee status.");
                }
            });
        });

        $('#submitBtn').click(function () {
            // Optionally, you can handle the overall submit if needed
            alert("All changes have been saved! (This could be extended to submit all checkbox states if necessary.)");
        });
    });
</script>


      
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->


</div>
</div>
</div>
<!-- end select2 -->

</div>





</div>
<!-- end row -->

<!-- end row -->

<!-- MODAL START -->


<div class="col-sm-6 col-md-4 col-xl-3">
                                                <div class="my-4 text-center">
                                                   
                                                </div>
        
                                                <div class="modal fade" id="deleteExamNumbers" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Examination Numbers.</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                           
                                                            <div class="modal-body">
                                                               Are you sure you want to delete Exam Numbers for class: <br>
                                                               <span class="badge rounded-pill bg-info fs-5">{{$singleStudent->programclass}}&nbsp;</span>
                                                               <span class="badge rounded-pill bg-info fs-5">{{$singleStudent->campus}}&nbsp;</span> Semester: 
                                                               <span class="badge rounded-pill bg-info fs-5">{{$singleStudent->semester}}&nbsp;</span>
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No</button>

                                                                <a href="{{route('delete.exam.numbers.list', ['pclass'=>$singleStudent->programclass,
                                                                'pcampus'=>$singleStudent->campus, 'semester'=>$singleStudent->semester, 'count'=>$count])}}">

                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                                                                </a>
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>


<!-- MODAL END -->








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