
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

<h4 class="card-title">SigningOff a Class</h4>
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

@php
$class = App\Models\Programclass::all();
@endphp
@php
$campus = App\Models\Campus::all();
$classStudents = App\Models\User::where('programclass', $pclass->classcode)
->where('semester', $semester)->where('campus_id', $pclass->campus_id)->get();
@endphp 

    <form action="" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="">Note*</label>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <h4>Move students from: <span style="color: #FF5733;">{{$pclass->classcode}} | Sem {{$semester}} - 
                        @if($pclass->campus_id==1) LL @endif
                        @if($pclass->campus_id==2) BT @endif
                        @if($pclass->campus_id==3) ZA @endif
                    </span> TO:</h4> <br>
                   Total Students: {{$classStudents->count()}}
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="">Class year</label>
            <div class="card bg-light text-dark">
                @php 
                $allprogramclassess = App\Models\Programclass::where('program_id',$pclass->program_id)->get();
                @endphp
                <div class="card-body">
                    <select class="form-select" name="new_class" id="newClassSelect" aria-label="Default select example" required>
                        <option value="{{$pclass->id}}" selected="">{{$pclass->classcode}} - 
                            @if($pclass->campus_id==1) LL @endif
                            @if($pclass->campus_id==2) BT @endif
                            @if($pclass->campus_id==3) ZA @endif
                        </option>
                        @foreach($allprogramclassess as $allpclasses)
                            <option value="{{$allpclasses->id}}">{{$allpclasses->classcode}} - 
                            @if($allpclasses->campus_id==1) LL @endif
                            @if($allpclasses->campus_id==2) BT @endif
                            @if($allpclasses->campus_id==3) ZA @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="">Semester</label>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <select class="form-select" name="new_semester" id="newSemesterSelect" aria-label="Default select example" required>
                        <option value="" selected="">-- select --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
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
                            data-bs-toggle="modal" 
                            data-bs-target="#signOffModal{{$pclass->classcode}}{{$semester}}" 
                            style="margin-top: 8px;">
                        Sign Off
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- Modal Structure -->
<!-- Modal Structure -->
<!-- Modal Structure -->
<div class="modal fade" id="signOffModal{{$pclass->classcode}}{{$semester}}" tabindex="-1" aria-labelledby="signOffModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signOffModalLabel">Confirm Sign Off</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- This is where we will display the class and semester details dynamically -->
        <p>Sign off students from <span style="color: #FF5733;">{{$pclass->classcode}}
          @if($pclass->campus_id==1) LL @endif
          @if($pclass->campus_id==2) BT @endif
          @if($pclass->campus_id==3) ZA @endif

        | Sem: {{$semester}}</span>? to 
          <span style="color: blueviolet;" id="modalNewClassDisplay"></span> | <span style="color: blueviolet;" id="modalNewSemesterDisplay"></span>
        </p>
        
        <form action="{{ route('update.signing.off.students') }}" method="post">
            @csrf
            <input type="hidden" name="campus_id" value="{{$pclass->campus_id}}">
            <input type="hidden" name="semester" value="{{$semester}}">
            <input type="hidden" name="class_id" value="{{$pclass->id}}">
            
            <!-- Hidden inputs for new_class and new_semester -->
          
            <input type="hidden" name="new_class" id="modalNewClass">
            <input type="hidden" name="new_semester" id="modalNewSemester">
           
            <button type="submit" class="btn btn-warning mt-3">Confirm Sign Off</button>
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
        // Get all the Sign Off buttons
        var signOffButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
        
        signOffButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the new_class and new_semester values
                var newClass = document.getElementById('newClassSelect').value;
                var newSemester = document.getElementById('newSemesterSelect').value;
                
                // Set the hidden input fields inside the modal
                document.getElementById('modalNewClass').value = newClass;
                document.getElementById('modalNewSemester').value = newSemester;

                // Update the text inside the modal
                var newClassText = document.querySelector(`#newClassSelect option[value="${newClass}"]`).textContent;
                var newSemesterText = (newSemester == 1) ? 'Semester 1' : (newSemester == 2) ? 'Semester 2' : 'Not Selected';
                
                document.getElementById('modalNewClassDisplay').textContent = newClassText;
                document.getElementById('modalNewSemesterDisplay').textContent = newSemesterText;
            });
        });
    });
</script>

        

    </body>

</html>