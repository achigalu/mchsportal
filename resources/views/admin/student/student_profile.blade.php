
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>MCHS Portal | Student Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
        
        <!-- Plugins -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">

        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">

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
    @php
    $student = Auth::user()
    @endphp
<h4 class="mb-sm-0">Profle for: {{$student->fname}} {{$student->lname}}</h4>

<div class="page-title-right">


</div>


</div>
</div>
</div>
<!--- start row -->

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

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
<form action="{{route('store.student.profile')}}" method="POST" class="custom-validation">
    @csrf
    <h5>Bio Information</h5><p></p>
    <div class="row">
    
    <div class="col-lg-4">
        
            <div class="mb-3">
                <label class="form-label">Title*</label>
                <select class="form-select" name="title" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Sister">Sister</option>
                            <option value="Pr">Mr</option>
                            </select>
                @error('title') <span class="text-danger">{{$message}}</span> @enderror
                

            </div>
            
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Initials</label>
                <input class="form-control" name="initials" type="text" placeholder="" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>
 
    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Date of birth*</label>
                
                <input class="form-control" name="dbirth" type="date" placeholder="Surname" id="example-text-input">
                @error('lname') <span class="text-danger">{{$message}}</span> @enderror

            </div>
            
    </div>

    
        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Gender*</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="gender" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Marital Status*</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="marital" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Nationality*</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="country" aria-label="Default select example">
                <option selected=""  value="">-- select --</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Religion*</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="religion" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="Christianity">Chritianity</option>
                            <option value="Islam">Islam</option>
                            <option value="Buddism">Buddism</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">District*</label>
                @error('gender') <span class="text-danger">{{$message}}</span> @enderror
                <select class="form-select" name="district" aria-label="Default select example">
                            <option value="">-- select --</option>
                            <option value="BT">Blantyre</option>
                            <option value="BLK">Balaka</option>
                            <option value="CK">Chikwawa</option>
                            <option value="CA">Chitipa</option>
                            <option value="DA">Dowa</option>
                            <option value="DZ">Dedza</option>
                            <option value="KU">Kasungu</option>
                            <option value="KA">Karonga</option>
                            <option value="LL">Lilongwe</option>
                            <option value="LA">Likoma</option>
                            <option value="MGH">Mangochi</option>
                            <option value="ME">Mulanje</option>
                            <option value="MHG">Machinga</option>
                            <option value="MN">Mwanza</option>
                            <option value="MJ">Mchinji</option>
                            <option value="MZ">Mzimba</option>
                            <option value="KK">Nkhotakota</option>
                            <option value="NB">Nkhatabay</option>
                            <option value="NS">Ntchisi</option>
                            <option value="NN">Neno</option>
                            <option value="NU">Ntcheu</option>
                            <option value="NE">Nsanje</option>
                            <option value="RU">Rumphi</option>
                            <option value="SA">Salima</option>
                            <option value="TO">Thyolo</option>
                            <option value="ZA">Zomba</option>
                            </select>

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">T/A*</label>
                <input class="form-control" name="traditional" type="text" placeholder="Firstname" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror

            </div>  
        </div>

        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Village*</label>
                <input class="form-control" name="village" type="text" placeholder="Firstname" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror

            </div>  
        </div>

        <br><br><p>
            <h5>Contact Information</h5>
            <hr>
            <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone*</label>
                <input class="form-control" name="student_phone1" type="text" placeholder="" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Phone(If you have two)</label>
                <input class="form-control" name="student_phone2" type="text" placeholder="Firstname" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email(If you have one)</label>
                <input class="form-control" name="student_email" type="text" placeholder="Firstname" id="validationCustom01">
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Home Address*</label><br>
                <textarea id="comments" class="form-control" name="student_address" rows="4" cols="41" 
                placeholder="" maxlength="200"></textarea>
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>

    <br><br><p>
            <h5>Next of KIN</h5>
            <hr>
    
        <div class="col-lg-6">
                <label class="form-label">Full Name</label> 
                @error('fullname') <span class="text-danger">{{$message}}</span> @enderror 
                <input class="form-control" name="kin_fullname" type="text" placeholder="" id="validationCustom01">
             </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Relationship</label>
                @error('relationship') <span class="text-danger">{{$message}}</span> @enderror 
                <select class="form-select" name="relationship" aria-label="Default select example">
                            <option selected=""  value="">-- select --</option>
                            <option value="Mother">Mother</option>
                            <option value="Father">Father</option>
                            <option value="Uncle">Uncle</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Brother">Brother</option>
                            <option value="Aunt">Aunt</option>
                            </select>
            </div>
 
            
 </div>


        <p>

        <hr>

        
    <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Phone</label>
                @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="text" name="kin_phone" placeholder="" id="example-text-input">

            </div>
            
        </div>
 
        <div class="col-lg-6">
            <div class="mb-2">
                <label class="form-label">Email</label>
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                <input class="form-control" type="text" name="kin_email" placeholder="" id="example-text-input">

            </div>
            
        </div>
        <div class="col-lg-6">
            <div class="mb-4">
                <label class="form-label">Home Address*</label><br>
                <textarea id="comments" class="form-control" name="kin_address" rows="4" cols="40" 
                placeholder="" maxlength="200"></textarea>
                @error('fname') <span class="text-danger">{{$message}}</span> @enderror
            </div>   
    </div>


    </div>
  <div class="form-group">
&nbsp;&nbsp;<button class="btn btn-secondary" type="submit">Update</button> &nbsp;&nbsp;
</form>
<a href="{{route('list.users')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a><br><br>
</div>  


</div>
</div>


<!-- end page title -->

<!-- end row -->

<!-- end row -->


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

        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>

        <!-- validation -->
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

    </body>

</html>