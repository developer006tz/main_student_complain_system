<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Vemto Logo" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-light">studentcomplaints</span>
    </a>

    @php
    function resourceRoutes($resource) {
        $routes =  [
            $resource . '.index',
            $resource . '.show',
            $resource . '.create',
            $resource . '.edit',
            $resource . '.destroy',
        ];
        $routes_ = array_map(function ($route) {
            return request()->routeIs($route);
        }, $routes);
        return in_array(true, $routes_);
    }
    $complaint_routes = resourceRoutes('complaints');
    $student_routes = resourceRoutes('students');
    $lecture_routes = resourceRoutes('lectures');
    $department_routes = resourceRoutes('departments');
    $user_routes = resourceRoutes('users');
    $role_routes = resourceRoutes('roles');
    $permission_routes = resourceRoutes('permissions');
    $complaint_type_routes = resourceRoutes('complain-types');
    $department_head_routes = resourceRoutes('department-heads');
    $message_routes = resourceRoutes('messages');
    $semester_routes = resourceRoutes('semesters');
    $programe_routes = resourceRoutes('programs');
    $course_routes = resourceRoutes('courses');
    $nta_level_routes = resourceRoutes('nta-levels');
    $academic_year_routes = resourceRoutes('academic-years');
    $enrollment_routes = resourceRoutes('enrollments');
    $countrie_routes = resourceRoutes('countries');

    @endphp

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                @if(Auth::user()->getRoleNames()[0] !='user')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                    <li class="nav-item  {{ $complaint_routes ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ $complaint_routes ? 'active' : '' }}">
                            <i class="nav-icon icon ion-md-filing"></i>
                            <p>
                                @if(Auth::user()->hasRole('super-admin','department-head'))
                                    Manage Complaints
                                @else
                                    My Complaints
                                @endif
                                <i class="nav-icon right icon ion-md-arrow-dropleft"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                    @can('view-any', App\Models\Complaint::class)
                        <li class="nav-item">
                            <a href="{{ route('complaints.index') }}" class="nav-link {{ $complaint_routes ? 'active' : '' }}">
                                <i class="nav-icon icon ion-ios-bookmarks"></i>
                                <p>All Complaints</p>
                            </a>
                        </li>
                    @endcan
                        @can('view-any', App\Models\Complaint::class)
                            <li class="nav-item">
                                <a href="{{ route('complaints.index') }}" class="nav-link {{ $complaint_routes ? 'active' : '' }}">
                                    <i class="nav-icon icon ion-md-stopwatch"></i>
                                    <p>Complete</p>
                                </a>
                            </li>
                        @endcan
                        @can('view-any', App\Models\Complaint::class)
                            <li class="nav-item">
                                <a href="{{ route('complaints.index') }}" class="nav-link {{ $complaint_routes ? 'active' : '' }}">
                                    <i class="nav-icon icon ion-ios-refresh"></i>
                                    <p>Pending</p>
                                </a>
                            </li>
                        @endcan
                        @can('view-any', App\Models\Complaint::class)
                            <li class="nav-item">
                                <a href="{{ route('complaints.index') }}" class="nav-link {{ $complaint_routes ? 'active' : '' }}">
                                    <i class="nav-icon icon ion-md-swap"></i>
                                    <p>Transfered</p>
                                </a>
                            </li>
                        @endcan
                        @can('view-any', App\Models\Complaint::class)
                            <li class="nav-item">
                                <a href="{{ route('complaints.index') }}" class="nav-link {{ $complaint_routes ? 'active' : '' }}">
                                    <i class="nav-icon icon ion-md-alert"></i>
                                    <p>Failed</p>
                                </a>
                            </li>
                        @endcan

                        </ul>
                    </li>
{{--                start manage users--}}
                    @if(Auth::user()->hasRole('super-admin','department-head'))
                    <li class="nav-item {{ $user_routes || $student_routes || $lecture_routes || $department_head_routes ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $user_routes || $student_routes || $lecture_routes || $department_head_routes ? 'active' : '' }}">
                            <i class="nav-icon icon ion-md-people"></i>
                            <p>
                                Manage Users
                                <i class="nav-icon right icon ion-md-arrow-dropleft"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @can('view-any', App\Models\Student::class)
                                <li class="nav-item">
                                    <a href="{{ route('students.index') }}" class="nav-link {{ $student_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon  ion-md-person"></i>
                                        <p>Students</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Lecture::class)
                                <li class="nav-item">
                                    <a href="{{ route('lectures.index') }}" class="nav-link {{ $lecture_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon  ion-md-person"></i>
                                        <p>Lectures</p>
                                    </a>
                                </li>
                            @endcan
                                @can('view-any', App\Models\DepartmentHead::class)
                                    <li class="nav-item">
                                        <a href="{{ route('department-heads.index') }}" class="nav-link {{ $department_head_routes ? 'active' : '' }}">
                                            <i class="nav-icon icon  ion-md-person"></i>
                                            <p>Department Heads</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('view-any', App\Models\User::class)
                                    <li class="nav-item">
                                        <a href="{{ route('users.index') }}" class="nav-link {{ $user_routes ? 'active' : '' }}">
                                            <i class="nav-icon icon  ion-md-people"></i>
                                            <p> All Users</p>
                                        </a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                    @endif
{{--                      end manage users      --}}

                    @can('view-any', App\Models\Message::class)
                        <li class="nav-item {{ $message_routes ? 'active' : '' }}">
                            <a href="{{ route('messages.index') }}" class="nav-link {{ $message_routes ? 'active' : '' }}">
                                <i class="nav-icon icon  ion-md-chatboxes"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    @endcan
                    {{--start settings--}}
                    @if(Auth::user()->hasRole('super-admin','department-head'))
                    <li class="nav-item {{ $department_routes || $semester_routes || $programe_routes || $course_routes || $complaint_type_routes || $nta_level_routes || $academic_year_routes || $enrollment_routes || $countrie_routes ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $department_routes || $semester_routes || $programe_routes || $course_routes || $complaint_type_routes || $nta_level_routes || $academic_year_routes || $enrollment_routes || $countrie_routes ? 'active' : '' }}">
                            <i class="nav-icon icon ion-md-settings"></i>
                            <p>
                                Settings
                                <i class="nav-icon right icon ion-md-arrow-dropleft"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('view-any', App\Models\Department::class)
                                <li class="nav-item">
                                    <a href="{{ route('departments.index') }}" class="nav-link  {{ $department_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-md-home"></i>
                                        <p>Departments</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Semester::class)
                                <li class="nav-item">
                                    <a href="{{ route('semesters.index') }}" class="nav-link {{ $semester_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-md-calendar"></i>
                                        <p>Semesters</p>
                                    </a>
                                </li>
                            @endcan

                            @can('view-any', App\Models\Program::class)
                                <li class="nav-item">
                                    <a href="{{ route('programs.index') }}" class="nav-link {{ $programe_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-logo-buffer"></i>
                                        <p>Programs</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Course::class)
                                <li class="nav-item">
                                    <a href="{{ route('courses.index') }}" class="nav-link {{ $course_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-ios-journal"></i>
                                        <p>Courses</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\ComplainType::class)
                                <li class="nav-item">
                                    <a href="{{ route('complain-types.index') }}" class="nav-link {{ $complaint_type_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon  ion-ios-switch"></i>
                                        <p>Complain Types</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\NtaLevel::class)
                                <li class="nav-item">
                                    <a href="{{ route('nta-levels.index') }}" class="nav-link {{ $nta_level_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-ios-podium"></i>
                                        <p>Nta Levels</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\AcademicYear::class)
                                <li class="nav-item">
                                    <a href="{{ route('academic-years.index') }}" class="nav-link {{ $academic_year_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon  ion-ios-calendar"></i>
                                        <p>Academic Years</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Enrollment::class)
                                <li class="nav-item">
                                    <a href="{{ route('enrollments.index') }}" class="nav-link {{ $enrollment_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon  ion-md-person-add"></i>
                                        <p>Enrollments</p>
                                    </a>
                                </li>
                            @endcan
                            @can('view-any', App\Models\Country::class)
                                <li class="nav-item">
                                    <a href="{{ route('countries.index') }}" class="nav-link {{ $countrie_routes ? 'active' : '' }}">
                                        <i class="nav-icon icon ion-md-flag"></i>
                                        <p>Countries</p>
                                    </a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                    @endif
                    {{--end settings--}}

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item {{ $role_routes || $permission_routes ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $role_routes || $permission_routes ? 'active' : '' }}">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            System Permissions
                            <i class="nav-icon right icon ion-md-arrow-dropleft"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ $role_routes ? 'active' : '' }}">
                                <i class="nav-icon icon ion-ios-man"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link  {{ $permission_routes ? 'active' : '' }}">
                                <i class="nav-icon icon ion ion-ios-unlock"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endif
                @endauth

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
