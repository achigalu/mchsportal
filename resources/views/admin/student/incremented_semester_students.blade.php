
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | Assign Subjects to Students Class</title>
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
<div class="col-lg-12">

<div class="card">
<div class="card-body">

<h4 class="card-title">Cumulative Semesters for Registration</h4>
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
<br>


    <form action="" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Note*</label>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <h4>Class: <span style="color: #FF5733;">{{$pclass->classcode}} | Sem {{$semester}} - 
                        @if($pclass->campus_id==1) LL @endif
                        @if($pclass->campus_id==2) BT @endif
                        @if($pclass->campus_id==3) ZA @endif
                    </span>: Current cum sem = 
                    <span class="badge rounded-pill bg-info float-center fs-6 py-1 px-2">
                    {{$firststudent->cum_semester}}
                    </span></h4> <br>
                   Total Students: {{$classStudents->count()}}
                </div>
            </div>
        </div>


        <div class="form-group col-md-4">
            <label for="">Cumulative Semesters</label>
            <div class="card bg-light text-dark">
                <div class="card-body">
                <select class="form-select" id="cum_semester_select" aria-label="Default select example" required>
                        <option value="" selected="">-- select --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for=""></label>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <!-- Button to trigger the modal -->
            <button type="button" class="btn btn-warning" 
                data-bs-toggle="modal" data-bs-target="#accumulateSemesterModal" 
                id="triggerModal" style="margin-top: 8px;">
                Accumulate Semester
            </button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal Structure -->
<!-- Modal Structure -->
<!-- Modal Structure -->
<!-- Button to trigger the modal -->

<!-- Modal -->
<div class="modal fade" id="accumulateSemesterModal" tabindex="-1" aria-labelledby="accumulateSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accumulateSemesterModalLabel">Accumulate Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to send the data -->
                <form action="{{ route('update.cumulative.semester') }}" method="POST">
                    @csrf
                    <!-- Hidden fields to store class code and semester -->
                    <input type="hidden" name="classcode" id="classcode_modal" value="{{ $pclass->classcode }}">
                    <input type="hidden" name="semester" id="semester_modal" value="{{ $semester }}">
                    <input type="hidden" name="class_id" id="class_id_modal" value="{{ $class_id}}">
                    <input type="hidden" name="campus" id="campus_modal" value="{{$pclass->campus_id}}">
                    <input type="hidden" name="acy" id="acy_modal" value="{{ $acy->id }}">
                    <input type="hidden" name="cum_semester" id="cum_semester_modal" value="{{$firststudent->cum_semester}}">

                    <!-- Display the classcode -->
                    <div class="mb-3">
                        <label for="classcode_display" class="form-label">Class Code</label>
                        <input type="text" class="form-control" id="classcode_display" readonly>
                    </div>

                    <!-- Display the semester -->
                    <div class="mb-3">
                        <label for="semester_display" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester_display" readonly>
                    </div>

                    <!-- Display the selected cumulative semester in the modal -->
                    <div class="mb-3">
                        <label for="cum_semester_modal" class="form-label">Selected Cumulative Semester</label>
                        <input type="text" class="form-control" id="cum_semester_modal" name="cum_semester" readonly>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                    </div>


                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


</div>
</div>
</div>
<!-- end select2 -->

</div>
    



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


<script>

        document.addEventListener('DOMContentLoaded', function () {
    // Get the dropdown, modal button, and modal input elements
    const cumSemesterSelect = document.getElementById('cum_semester_select');
    const triggerModalButton = document.getElementById('triggerModal');
    const classcodeInput = document.getElementById('classcode_modal');
    const semesterInput = document.getElementById('semester_modal');
    const classcodeDisplay = document.getElementById('classcode_display');
    const semesterDisplay = document.getElementById('semester_display');
    const cumSemesterModalInput = document.getElementById('cum_semester_modal');

    // Add an event listener to the button to pass the selected cumulative semester to the modal
    triggerModalButton.addEventListener('click', function () {
        // Get the selected cumulative semester value
        const selectedCumSemester = cumSemesterSelect.value;
        
        // Set the classcode, semester, and selected cumulative semester values into the modal's hidden fields
        const selectedClasscode = classcodeInput.value; // This is already set from Blade
        const selectedSemester = semesterInput.value; // This is already set from Blade

        // Set the values in the modal input fields
        classcodeDisplay.value = selectedClasscode; // Display the classcode in the modal
        semesterDisplay.value = selectedSemester;   // Display the semester in the modal
        cumSemesterModalInput.value = selectedCumSemester; // Display the selected cumulative semester in the modal
    });
});

</script>
        

    </body>

</html>