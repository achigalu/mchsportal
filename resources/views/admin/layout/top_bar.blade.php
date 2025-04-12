<header id="page-topbar" style="background-color:#7196be;">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('myhome')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm-light" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/plogo.jpg')}}" alt="logo-light" height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                      

                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                
                            </div>
                        </div>


                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"> &nbsp;&nbsp;7
                                    
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">School opening date</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You will be notified when we are openning school</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                   
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">End of Semester Examinations</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You will be informed here if Exams are out.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                   
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php
                                        $userProfile = App\Models\userProfile::where('user_id', Auth::user()->id)->first();
                                        $studentProfile = App\Models\Studentprofile::where('user_id', Auth::user()->id)->first();
                                    @endphp

                                    @if(Auth::user()->role == 'student')
                                    @if(!empty($studentProfile->photo))
                                    <img src="{{ $studentProfile->photo ? url('uploads/students_photo/'.$studentProfile->photo) :  url('uploads/students_photo/3.jpg') }}" 
                                    style="width: 50px; height: 50px;" class="avatar-md rounded-circle"> 
                                    @else
                                    <img src="{{ url('uploads/students_photo/3.jpg') }}" 
                                    style="width: 50px; height: 50px;" class="avatar-md rounded-circle"> 
                                    @endif
                                   
                                    

                                    @elseif(Auth::user()->role != 'student')
                                        @if(!empty($userProfile->image))
                                        <img src="{{ $userProfile->image ? url('uploads/user_photo/'.$userProfile->image) :  url('uploads/students_photo/3.jpg') }}" 
                                        style="width: 50px; height: 50px;" class="avatar-md rounded-circle">
                                        @else
                                        <img src="{{ url('uploads/students_photo/3.jpg') }}" 
                                        style="width: 50px; height: 50px;" class="avatar-md rounded-circle">
                                        @endif

                                    @else
                                        <img src="{{ url('uploads/students_photo/3.jpg') }}" 
                                        style="width: 50px; height: 50px;" class="avatar-md rounded-circle">
                                    @endif
 
                                
                                <span class="d-none d-xl-inline-block ms-1">
                                    
                                {{Auth::user()->fname}} {{Auth::user()->lname}} | 
                               
                                 {{Auth::user()->role}} 
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            @if(Auth::user()->role=='student')
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('admin.student.resetStudentPassword')}}"><i class="ri-user-line align-middle me-1"></i>Change my password</a><p>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('user.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                            @elseif(Auth::user()->role=='applicant')
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('user.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                            @else
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('user.reset.password')}}"><i class="ri-user-line align-middle me-1"></i>Change my password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('admin.user.profile')}}"><i class="ri-user-line align-middle me-1"></i>My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{route('user.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                            </div>
                            @endif
                        </div>

                      
            
                    </div>
                </div>

                
            </header>