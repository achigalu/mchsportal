<div id="sidebar-menu" style="background-color:#fff;">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            
                        @if(Auth::user()->role == 'applicant')
                        <a href="{{route('myhome')}}">
                            <li class="menu-title"><h4 style="color:#7196be;"><h4>ACCOUNT CREATION</h4></li>
                            </a>
                        @else

                            <a href="{{route('myhome')}}">
                            <li class="menu-title"><h4 style="color:#7196be;"><h4>DASHBOARD</h4></li>
                            </a>
                        @if(Auth::user()->role != 'student')
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-users-cog" style="font-size:25px;color:gray"></i>
                                    <span style="color:#0AC6CF ;">User Settings</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('list.users')}}">- Users</a></li>
                                    <li><a href="#">- Roles</a></li>
                                    <li><a href="#">- Permissions</a></li>
                                    <li><a href="#">- Logs</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-cogs" style="font-size:25px;color:gray"></i>
                                    <span style="color:#07585C;">General Settings</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- System Settings</a></li>
                                    <li><a href="#">- Institutional Details</a></li>
                                    <li><a href="{{route('all.campuses')}}">- Campuses</a></li>
                                    
                                </ul>
                            </li>
                    


                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-cog" style="font-size:25px;color:gray"></i>
                                    <span style="color:#07585C;">Academic Settings</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li><a href="{{route('view.faculty')}}">- Faculties</a></li>
                                    <li><a href="{{route('view.program')}}">- Academic Programs</a></li>
                                    <li><a href="{{route('view.fee.categories')}}">- Tuition Fee Categories</a></li>
                                   
                                    <li><a href="{{route('view.fee.structures')}}">- Add Fees to Class</a></li>
    
                                </ul>
                            </li>

                            
                            <hr>


                            <li>
                                <a href="{{route('view.cohorts')}}" class="waves-effect">
                                    <i class="fas fa-receipt" style="font-size:25px;color:gray"></i>
                                    <span style="color:#3A1108">Cohorts Settings</b></span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class=" fas fa-user-plus" style="font-size:15px;color:gray"></i>
                                    <span style="color:#3A1108">Add Intake</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('admission.student')}}">- Upload intake</a></li>
                                    
                                    <li><a href="#">- Rejected Intake list</a></li>
                                    
                                </ul>
                            </li>

                            @endif
                    <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class=" fas fa-user-plus" style="font-size:15px;color:gray"></i>
                                    <span style="color:#0A94CF;">Subjects</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('add.course')}}">- Add Subjects</a></li>
                                    <li><a href="{{route('view.courses')}}">- All Subjects</a></li>
                                    <li><a href="{{route('add.subject.to.class')}}">- Add Subject to Class </a></li>
                                    <li><a href="{{route('add.subject.to.students')}}">- Subjects to Students</a></li>
                                    <li><a href="{{route('subjects.to.lecturers')}}">- Subjects to Lecturers</a></li>
                                    <li><a href="{{route('module.register')}}">- Class List </a></li>
                                    
                                </ul>
                            </li>
                    
                            
                            

                            
                            <li>
                                <a href="##" class=" waves-effect">
                                    <i class="fas fa-users" style="font-size:15px;color:gray"></i>
                                    <span style="color:#7196be;">Students</b></span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="far fa-newspaper" style="font-size:15px;color:gray"></i>
                                    <span style="color:#7196be;">Registration</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('class.list')}}">- Students Class list</a></li> 
                                    <li><a href="{{route('students.confirmation')}}">- Students Confirmation</a></li>
                                    <li><a href="#">- Waivers </a></li>
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-book-open" style="font-size:15px;color:gray"></i>
                                    <span style="color:#7196be;">Examinations</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Management</a></li>
                                    <li><a href="#">- Assessments</a></li>
                                    <li><a href="#">- Reports</a></li>
                                    
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class=" fas fa-bullhorn" style="font-size:15px;color:gray"></i>
                                    <span style="color:#222831">Announcements</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Notices</a></li>
                                    <li><a href="#">- Regulations</a></li>
                                    
                                </ul>
                            </li>
                    <hr>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-house-user" style="font-size:15px;color:gray"></i>
                                    <span style="color:black">Accommodation</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Allocations</a></li>
                                    
                                    
                                    
                                </ul>
                            </li>


                        </ul>
                        @endif
                    </div>