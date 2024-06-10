<div id="sidebar-menu" style="background-color:#fff;">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                         
                        @if(Auth::user()->role == 'student')
                        <a href="{{route('myhome')}}">
                            <li class="menu-title"><h4 style="color:#7196be;"><h4>DASHBOARD</h4></li>
                            </a>
                     
                       
                        
                        <li>
                                <a href="javascript: void(0);">
                                <i class="fas fa-user"></i>
                                    <span style="color:#7196be; font-size:14px"><b> Profile</b></span>
                                </a>
                               
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                <i class="fas fa-dollar-sign"></i>
                                    <span style="color:#7196be; font-size:14px"><b> Financial Statement</b></span>
                                </a>
                               
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                <i class="fas fa-stream"></i>
                                    <span style="color:#7196be; font-size:14px"><b> Exam Results</b></span>
                                </a>
                               
                            </li>
                        
                        @else

                        @if(Auth::user()->role == 'applicant')
                        <a href="{{route('myhome')}}">
                            <li class="menu-title"><h4 style="color:#7196be;"><h4>ACCOUNT CREATION</h4></li>
                            </a>
                        @else

                            <a href="{{route('myhome')}}">
                            <li class="menu-title"><h4 style="color:gray;"><h4>DASHBOARD</h4></li>
                            </a>
                     
                       
                        
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-cogs" style="font-size:25px;color:#7196be"></i>
                                    <span style="color:gray;"><b> College Setup</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li><a href="#">- College Details</a></li>
                                    <li><a href="{{route('all.campuses')}}">- College Campuses</a></li>
                                    
                                </ul>
                            </li>
                        
                        
                        
                        
                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fas fa-users-cog" style="font-size:25px;color:#7196be"></i>
                                    <span style="color:gray;"><b> System Users</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('list.users')}}">- All Users</a></li>
                                    <li><a href="#">- Roles</a></li>
                                    <li><a href="#">- Permissions</a></li>
                                    <li><a href="#">- Logs</a></li>
                                </ul>
                            </li>

                        <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-cog" style="font-size:25px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Academic Setup</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <li><a href="{{route('view.cohorts')}}">- Sessions/Intakes</a></li>
                                    <li><a href="{{route('view.faculty')}}">- Faculties</a></li>
                                    <li><a href="{{route('view.program')}}">- Academic Programs</a></li>
                                    <li><a href="{{route('view.fee.categories')}}">- Tuition Fee Categories</a></li>
                                   
                                    <li><a href="{{route('view.fee.structures')}}">- Add Fees to Class</a></li>
    
                                </ul>
                            </li>
                
                            <hr>

                            <li>
                                <a href="{{route('admission.student')}}" class=" waves-effect">
                                    <i class="fas fa-user-plus" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Add Students</b></span>
                                </a>
                            </li>


                           
                    <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class=" fas fa-user-plus" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Subjects Setup</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('add.course')}}">- Add Subjects</a></li>
                                    <li><a href="{{route('view.courses')}}">- All Subjects</a></li>
                                    <li><a href="{{route('add.subject.to.class')}}">- Add Subject to Class </a></li>
                                    <li><a href="{{route('add.subject.to.students')}}">- Subjects to Students</a></li>
                                    <li><a href="{{route('subjects.to.lecturers')}}">- Subjects to Lecturers</a></li>
                                    
                                    
                                </ul>
                            </li>
                    

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-users" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Students List</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('class.list')}}">- Class list</a></li> 
                                    <li><a href="{{route('students.confirmation')}}">- Confirm Registration</a></li>
                                    
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-book-open" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Examinations</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Management</a></li>
                                    <li><a href="#">- Assessments</a></li>
                                    <li><a href="#">- Reports</a></li>
                                    
                                    
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class=" fas fa-bullhorn" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Announcements</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Notices</a></li>
                                    <li><a href="#">- Regulations</a></li>
                                    
                                </ul>
                            </li>
                    <hr>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-house-user" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Accommodation</b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#">- Allocations</a></li>
                                    
                                    
                                    
                                </ul>
                            </li>


                        </ul>
                        @endif
                        @endif
                    </div>