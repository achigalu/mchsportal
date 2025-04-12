
<!doctype html>
<html lang="en">

    <head>
        
    <meta charset="utf-8" />
        <title>MCHS Portal | Module Aggregate</title>
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

<h4 class="card-title"><b>Aggregate class module marks</b></h4><br>

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
<form action="{{route('aggregate.class.marks')}}" method="post" enctype="" >
    @csrf
                    <div class="row">
                    @php 
                    $academic_year = App\Models\Academicyear::where('status',1)->get();
                    @endphp
                    <div class="form-group col-md-5">
                    <label for="">Academic year</label>
                        <div class="card bg-light text-dark">
                        
                    <div class="card-body" >
                    <select class="form-control select2" aria-label="Default select example" name="acyID" required>
                    <option value="">-- selects --</option>
                    @if($academic_year->isNotEmpty())
                    @foreach($academic_year as $acy)
                    <option value="{{$acy->id}}">{{$acy->ayear}} - {{$acy->month}} | {{$acy->description}}
                    </option>
                    @endforeach
                    @endif
                    </select>
                    </div>
                    </div>
                    </div>

                    <div class="form-group col-md-2">
                    <label for="">Class</label>
                        <div class="card bg-light text-dark">
                        
                    <div class="card-body" >
                    <select class="form-control select2" aria-label="Default select example" name="classID" required>
                    <option value="">-- select --</option>
                    
                    @if(Auth::user()->role=='HOD-BASIC' && Auth::user()->campus=='Lilongwe')
                    <option value="8">DCM 1 - LL</option>
                    <option value="19">DPH 1 - LL</option>
                    <option value="3">DBMS 1 - LL</option>
                    <option value="25">DOT 1 - LL</option>
                    <option value="13">DDT 1 - LL</option>
                    <option value="16">DEH 1 - LL</option>
                    <option value="22">DR 1 - LL</option>

                    @elseif(Auth::user()->role=='HOD-BASIC' && Auth::user()->campus=='Blantyre')
                    <option value="42">DCM 1 - BT</option>
                    <option value="54">UDCM 1 - BT</option>
                    <option value="36">DRN 1 - BT</option>
                    <option value="58">UDRN 1 - BT</option>
                    <option value="60">DCA 1 - BT</option>
                    <option value="62">ENT 1 - BT</option>
                    <option value="66">ORTHOP 1 - BT</option>

                    @elseif(Auth::user()->role=='HOD')
                    @if(!empty($hodClasses))
                    @foreach($hodClasses as $class)
                    <option value="{{$class->id}}">{{$class->classcode}} - 
                            @if($class->campus_id==1) LL @endif
                            @if($class->campus_id==2) BT @endif
                            @if($class->campus_id==3) ZA @endif
                            </option>
                            @endforeach
                    @endif
                    @elseif(Auth::user()->role=='Lecturer')
                    @if(!empty($classDetails))
                    @foreach($classDetails as $class)
                            <option value="{{$class->id}}">{{$class->classcode}} - 
                            @if($class->campus_id==1) LL @endif
                            @if($class->campus_id==2) BT @endif
                            @if($class->campus_id==3) ZA @endif
                            </option>
                            @endforeach
                    @endif
                    @elseif(Auth::user()->role=='Dean')
                    @if(!empty($deanClasses))
                    @foreach($deanClasses as $class)
                    <option value="{{$class->id}}">{{$class->classcode}} - 
                            @if($class->campus_id==1) LL @endif
                            @if($class->campus_id==2) BT @endif
                            @if($class->campus_id==3) ZA @endif
                            </option>
                            @endforeach
                    @endif
                    @elseif(Auth::user()->role=='Campus Registrar' || Auth::user()->role=='Principal')
                    @if(!empty($cr))
                    @foreach($cr as $class)
                    <option value="{{$class->id}}">{{$class->classcode}} - 
                            @if($class->campus_id==1) LL @endif
                            @if($class->campus_id==2) BT @endif
                            @if($class->campus_id==3) ZA @endif
                            </option>
                            @endforeach
                    @endif
                    @elseif(Auth::user()->role=='DCR-Academic' ||
                     Auth::user()->role=='DCR-Administration' ||
                      Auth::user()->role=='College Registrar' ||
                       Auth::user()->role=='Executive Director' ||
                        Auth::user()->role=='Admin' ||
                       Auth::user()->role=='Administrator')
                    @if(!empty($co))
                    @foreach($co as $class)
                    <option value="{{$class->id}}">{{$class->classcode}} - 
                            @if($class->campus_id==1) LL @endif
                            @if($class->campus_id==2) BT @endif
                            @if($class->campus_id==3) ZA @endif
                            </option>
                            @endforeach
                            @endif

                            
                    @else 
                  
                    @endif
                    </select>
                    </div>
                    </div>
                    </div>


                    <div class="form-group col-md-2">
                    <label for="">Semester</label>
                        <div class="card bg-light text-dark">
                        
                    <div class="card-body">
                    <select class="form-select" aria-label="Default select example" name="semester" required>
                    <option value="">-- select --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select>
                    </div>
                    </div>
                    </div>

                    
                    <div class="form-group col-md-3">
                    <label for="" ></label>
                        <div class="card bg-light text-dark">
                        
                    <div class="card-body">
                    <button class="btn btn-info w-100" type="submit" style="margin-top: 8px;">Aggregate students marks</button>
                    </div>
                    </div>
                    </div>
                    </div>

</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</div>
</div>
</div>
<!-- end select2 -->

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