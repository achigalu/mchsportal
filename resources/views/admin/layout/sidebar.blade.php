<div id="sidebar-menu" style="background-color:#fff;">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">

        @if(Auth::user()->role == 'student')
            <a href="{{ route('myhome') }}">
            <li class="menu-title"><h4 style="color:dark gray;">DASHBOARD</h4></li>
            </a>

            @php 
                $studentProfile = App\Models\Studentprofile::where('user_id', Auth::user()->id)->first();
            @endphp

            <li>
                <a href="{{ $studentProfile ? route('edit.student.profile', Auth::user()->id) : route('student.profile') }}">
                    <i class="fas fa-user"></i>
                    <span style="color:#7196be; font-size:14px;">
                        <b>{{ $studentProfile ? 'Edit Profile' : 'Add Profile' }}</b>
                    </span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fas fa-dollar-sign"></i>
                    <span style="color:#7196be; font-size:14px;"><b>Financial Statement</b></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fas fa-stream"></i>
                    <span style="color:#7196be; font-size:14px;"><b>Exam Results</b></span>
                </a>
            </li>

        @elseif(Auth::user()->role == 'applicant')
            <a href="{{ route('myhome') }}">
                <li class="menu-title"><h4 style="color:dark gray;">COURSE APPLICATION</h4></li>
            </a>

        @else
            <a href="{{ route('myhome') }}">
                <li class="menu-title"><h4 style="color:dark gray;">DASHBOARD</h4></li>
            </a>
         
            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class=" fas fa-grip-vertical" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>College Setup</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('college.setup') }}">- College Details</a></li>
                    <li><a href="{{ route('all.campuses') }}">- Campuses</a></li>
                </ul>
            </li>
            
            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-user-cog" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Users</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('view users')
                    <li><a href="{{ route('list.users') }}">- All Users</a></li>
                    @endcan
                    @can('view role')
                    <li><a href="{{ route('list.roles') }}">- Roles</a></li>
                    @endcan
                    @can('view permission')
                    <li><a href="{{ route('list.permissions') }}">- Permissions</a></li>
                    @endcan
                    <li><a href="#">- Logs</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-hourglass-end" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Academics</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('view.cohorts') }}">- Sessions/Intakes</a></li>
                    <li><a href="{{ route('view.faculty') }}">- Faculties</a></li>
                    <li><a href="{{ route('view.program') }}">- Academic Programs</a></li>
                    <li><a href="{{ route('view.fee.categories') }}">- Tuition Fee Categories</a></li>
                    <li><a href="{{ route('online.application.summary') }}">- Online Applications</a></li>
                    <!--<li><a href="{{ route('view.fee.structures') }}">- Add Fees to Class</a></li> -->
                </ul>
            </li>

            <hr>

            <li>
                <a href="{{ route('admission.student') }}" class="waves-effect">
                    <i class="fas fa-user-plus" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Intake Uploads</b></span>
                </a>
            </li>

            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fas fa-layer-group" style="font-size:15px;color:#7196be"></i>
                                    <span style="color:gray;"><b> Modules </b></span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('add.course')}}">- Add Module</a></li>
                                    <li><a href="{{route('view.courses')}}">- All Modules</a></li>
                                    <li><a href="{{route('add.subject.to.class')}}">- Class Modules </a></li>
                                    <li><a href="{{route('add.subject.to.students')}}">- Students Modules </a></li>
                                    
                                    <li><a href="{{route('add.subject.to.old.class')}}">- Old Class Modules </a></li>
                                    <li><a href="{{route('add.subject.to.old.students')}}">- Old Students Modules</a></li>
                                    <li><a href="{{route('subjects.to.lecturers')}}">- Lecturer Modules</a></li>
                                </ul>
                            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-users" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Students List</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('all.students.list') }}">- All Students</a></li>
                    <li><a href="{{ route('class.list') }}">- Class List</a></li>
                    @if(Auth::user()->role == 'Admin')
                    <li><a href="{{ route('students.signoff') }}">- Students SignOff</a></li>
                    <li><a href="{{ route('students.semester.increments') }}">- Cumulate Semesters</a></li>
                    @endif
                </ul>
            </li>

            <li>
                @can('examinations sidebar')
                <a href="{{route('examination.related.modules')}}" class="has-arrow waves-effect">
                    <i class="fas fa-book-open" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Examinations</b></span>
                </a>
                @endcan
                <ul class="sub-menu" aria-expanded="false">

                <!-- <li><a href="#">- Grades</a></li> 
                    <li><a href="{{ route('grade.old.students') }}">- Grades (Old Students)</a></li>
                    <li><a href="{{ route('student.exam.numbers') }}">- Exam Numbers</a></li>
                    <li><a href="{{route('class.aggregated.grades')}}">- Aggregated grades</a></li> -->
                </ul>
               
            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-bullhorn" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Announcements</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">- Notices</a></li>
                    <li><a href="#">- Regulations</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="fas fa-house-user" style="font-size:15px;color:#7196be;"></i>
                    <span style="color:gray;"><b>Accommodation</b></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">- Allocations</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
