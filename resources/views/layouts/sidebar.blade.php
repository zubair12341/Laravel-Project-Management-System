<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    li,
    a,
    p,
    strong,
    sub,
    sup,
    span {
        font-family: 'Roboto' !important;
    }

    .hover-img {
        transition: opacity 0.4s ease-in-out;
        opacity: 1;
    }

    .hover-img:hover {
        opacity: 0.7;
    }

    .list li a {
        transition: opacity 0.3s ease-in-out;
        opacity: 1;
    }

    .list li a:hover {
        opacity: 0.9;
    }

    .ml-menu {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        margin-left: 15px;


    }

    .ml-menu li {
        border-bottom: 1px solid black;
    }

    .sidebar .menu .list .ml-menu li a {
        color: black
    }

    @media screen and (max-width: 761px) {
        .btn-menu {
            margin-left: -16px;
            margin-top: 30px;
        }

        .sidebar .menu .list a {
            margin-left: 0;
        }

        .ml-menu {
            margin-left: 0;
        }

        p.badge {
            font-size: 15px;
            font-weight: 700;
            padding: 12px 30px !important;
            text-transform: capitalize;
            letter-spacing: 1px;
        }

    }
</style>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar" style="font-family: 'Montserrat', sans-serif;">
    <div class="navbar-brand mt-2" style="border: none;">


        {{-- {{route('dashboard.index')}} --}}
        <a href="#"><img src="{{ asset('assets/images/TMWlogo.png') }}" alt="DA Tech"></a>

    </div>
    <span id="leftBtn" style="display: none;"><button class="btn-menu ls-toggle-btn" onclick="btnOpen()"
            style="width: 29px; height: 29px; border-radius: 21px; background-color: #f1f2f2; margin-top:-47px; margin-left:12px; border:none;"
            id="menu-icon" type="button"><i style="color:#bec0c2;"
                class="zmdi zmdi-chevron-right toggle-icon"></i></button></span>
    <span id="rightBnt" style="margin-left: 248px;">
        <button class="btn-menu ls-toggle-btn" onclick="btnClose()"
            style="width: 29px; height: 29px; border-radius: 21px; background-color: #f1f2f2; border:none; margin-top: -3px; "
            id="menu-icon" type="button"><i style="color:#bec0c2;"
                class="zmdi zmdi-chevron-right toggle-icon"></i></button>

    </span>
    <div class="menu" id="menu">
        <ul class="list">


            @can('admin-dashboard')
                <li class="{{ request()->is('admin/dashboard') ? 'active open' : null }}"><a
                        href="{{ url('admin/dashboard') }}"><img class="hover-img"
                            src="{{ asset('img/sidenav/dashboard.png') }}"
                            data-alt-src="{{ asset('img/sidenav/dashboard1.png') }}" width="16px" height="15px"
                            alt=""><span>Dashboard</span></a></li>
            @endcan
            @can('employee-dashboard')
                <li class="{{ request()->is('emp/dashboard') ? 'active open' : null }}"><a
                        href="{{ url('emp/dashboard') }}"><img class="hover-img"
                            src="{{ asset('img/sidenav/dashboard.png') }}"
                            data-alt-src="{{ asset('img/sidenav/dashboard1.png') }}" width="16px" height="15px"
                            alt=""><span>Dashboard</span></a></li>
            @endcan
            @can('manager-dashboard')
                <li class="{{ request()->is('manager/dashboard') ? 'active open' : null }}"><a
                        href="{{ url('manager/dashboard') }}"><img class="hover-img"
                            src="{{ asset('img/sidenav/dashboard.png') }}"
                            data-alt-src="{{ asset('img/sidenav/dashboard1.png') }}" width="16px" height="15px"
                            alt=""><span>Dashboard</span></a></li>
            @endcan
            @can('hr-dashboard')
                <li class="{{ request()->is('manager/dashboard') ? 'active open' : null }}"><a
                        href="{{ url('manager/dashboard') }}"><img class="hover-img"
                            src="{{ asset('img/sidenav/dashboard.png') }}"
                            data-alt-src="{{ asset('img/sidenav/dashboard1.png') }}" width="16px" height="15px"
                            alt=""><span>Dashboard</span></a></li>
            @endcan

            @can('employee')
                <li
                    class="{{ request()->is('employee') || request()->is('department/create') || request()->is('employee/create') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                            src="{{ asset('img/sidenav/employees.png') }}"
                            data-alt-src="{{ asset('img/sidenav/employee1.png') }}" width="16px" height="15px"
                            alt=""> <span>Employee</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('employee') ? 'active' : null }}"><a href="{{ url('employee') }}">All
                                Employees</a></li>
                        <li class="{{ request()->is('employee/create') ? 'active' : null }}"><a
                                href="{{ url('employee/create') }}">Add Employee</a></li>
                        {{-- <li class="{{ request()->is('payslip') ? 'active' : null }}"><a href="{{url('payslip')}}">All Payslips</a></li>
                    <li class="{{ request()->is('payslip/create') ? 'active' : null }}"><a href="{{url('payslip/create')}}">Add Payslip</a></li> --}}
                        <!--changes-->
                        <li style="border-bottom:none" class="{{ request()->is('department/create') ? 'active' : null }}">
                            <a href="{{ url('department/create') }}">Departments</a></li>

                    </ul>
                </li>
            @endcan

            {{-- @can('client')
            <li class="{{ request()->is('client') || request()->is('client/create') || request()->is('client-invoice') || request()->is('client-invoice/create')? 'active open' : null }}">
                <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img" src="{{asset('img/sidenav/client.png')}}" data-alt-src="{{asset('img/sidenav/client1.png')}}" width="16px" height="15px" alt=""> <span>Client</span></a>
                <ul class="ml-menu">
                    <li class="{{ request()->is('client') ? 'active' : null }}"><a href="{{url('client')}}">All Clients</a></li>
                    <li class="{{ request()->is('client/create') ? 'active' : null }}"><a href="{{url('client/create')}}">Add Client</a></li>
                    <li class="{{ request()->is('client-invoice') ? 'active' : null }}"><a href="{{url('client-invoice')}}">All Invoices</a></li>
                    <li  style="border-bottom:none" class="{{ request()->is('client-invoice/create') ? 'active' : null }}"><a href="{{url('client-invoice/create')}}">Add Invoice</a></li>
                </ul>
            </li>
            @endcan --}}

            @can('project')
                <li class="{{ request()->is('project') || request()->is('project/create') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                            src="{{ asset('img/sidenav/project.png') }}"
                            data-alt-src="{{ asset('img/sidenav/projects_1.png') }}" width="16px" height="16px"
                            alt=""> <span>Project</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('project') ? 'active' : null }}"><a href="{{ url('project') }}">All
                                Projects</a></li>
                        <li style="border-bottom:none" class="{{ request()->is('project/create') ? 'active' : null }}"><a
                                href="{{ url('project/create') }}">Add Project</a></li>
                    </ul>
                </li>
            @endcan

            @can('tasktracker')
                <li
                    class="{{ request()->is('task-tracker') || request()->is('task-tracker/create') || request()->is('task-report') || request()->is('task-module') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                            src="{{ asset('img/sidenav/task.png') }}" data-alt-src="{{ asset('img/sidenav/tasks1.png') }}"
                            width="16px" height="15px" alt=""> <span>Task Tracker</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('task-tracker') ? 'active' : null }}"><a
                                href="{{ url('task-tracker') }}">All Tasks</a></li>
                        @if (auth()->user()->role_id != '3')
                            <li class="{{ request()->is('task-tracker/create') ? 'active' : null }}"><a
                                    href="{{ url('task-tracker/create') }}">Add Task</a></li>
                        @endif
                        {{-- <li class="{{ request()->is('task-report') ? 'active' : null }}"><a href="{{url('task-report')}}">Task hourly Report</a></li>
                    <li  style="border-bottom:none" class="{{ request()->is('task-module') ? 'active' : null }}"><a href="{{url('task-module')}}">Task Module</a></li> --}}
                    </ul>
                </li>
            @endcan
            {{-- 
            @can('timetracker')
            <li class="{{ request()->is('time-tracker')? 'active open' : null }}">
                <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img" src="{{asset('img/sidenav/attendance.png')}}" data-alt-src="{{asset('img/sidenav/attendance1.png')}}" width="16px" height="15px" alt=""> <span>Attendance</span></a>
                <ul class="ml-menu">
                    <li  style="border-bottom:none" class="{{ request()->is('time-tracker') ? 'active' : null }}"><a href="{{url('time-tracker')}}">Time Tracker</a></li>
                </ul>
            </li>
            @endcan --}}

            {{-- @can('leave-list')
            <li class="{{ request()->is('leave-list')? 'active open' : null }}">
                <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img" src="{{asset('img/sidenav/leaves.png')}}" data-alt-src="{{asset('img/sidenav/leaves1.png')}}" width="16px" height="15px" alt=""> <span>Leave
                        @if ($count = App\Models\Leave::where('viewed', 0)->count())



                        @endif
                    </span></a>
                <ul class="ml-menu">
                    <li  style="border-bottom:none" class="{{ request()->is('leave-list') ? 'active' : null }}"><a href="{{url('leave-list')}}">All Leaves</a></li>
                </ul>
            </li>
            @endcan --}}

            {{-- @can('payslip')
            <li class="{{ request()->is('add-payable') || request()->is('all-payable') || request()->is('add-recivable') || request()->is('all-recivable') ? 'active open' : null }}">
                <a href="javascript:void(0)" class="menu-toggle"><img  class="hover-img" src="{{asset('img/sidenav/expense.png')}}" data-alt-src="{{asset('img/sidenav/expense1.png')}}" width="16px" height="15px" alt=""> <span>Expense</span></a>
                <ul class="ml-menu">



                    <li class="{{ request()->is('add-payable') ? 'active' : null }}"><a href="{{route('add.payble')}}">Payable</a></li>
                    <li class="{{ request()->is('all-payable') ? 'active' : null }}"><a href="{{route('all.payable')}}">All Payable</a></li>
                    <li class="{{ request()->is('add-recivable') ? 'active' : null }}"><a href="{{route('add.recivable')}}">Receivable</a></li>
                    <li  style="border-bottom:none" class="{{ request()->is('all-recivable') ? 'active' : null }}"><a href="{{route('all.reciveable')}}">All Receivable</a></li>
                </ul>
            </li>
            @endcan --}}

            <!--@can('department')
    -->
                <!--    <li class="{{ request()->is('department/create') ? 'active open' : null }}">-->
                <!--        <a href="javascript:void(0)" class="menu-toggle"><i class="fas fa-building"></i> <span>Department</span></a>-->
                <!--<ul class="ml-menu">-->
                <!--    <li class="{{ request()->is('department/create') ? 'active' : null }}"><a href="{{ url('department/create') }}">Add Department</a></li>-->
                <!--</ul>-->
                <!--    </li>-->
                <!--
@endcan-->

            @can('users')
                <li class="{{ request()->is('user') || request()->is('user/create') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                            src="{{ asset('img/sidenav/user.png') }}"
                            data-alt-src="{{ asset('img/sidenav/user1.png') }}" width="14px" height="16px"
                            alt=""> <span>Users</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('user') ? 'active' : null }}"><a href="{{ url('user') }}">All
                                Users</a></li>
                        <li style="border-bottom:none" class="{{ request()->is('user/create') ? 'active' : null }}"><a
                                href="{{ url('user/create') }}">Add User</a></li>
                    </ul>
                </li>
            @endcan
            @if (auth()->user()->role_id == '1')
                <li class="{{ request()->is('domains') || request()->is('create-domains') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                            src="{{ asset('img/sidenav/project.png') }}"
                            data-alt-src="{{ asset('img/sidenav/projects_1.png') }}" width="16px" height="16px"
                            alt=""> <span>Domains</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('domains') ? 'active' : null }}"><a
                                href="{{ route('domain.index') }}">All Domains</a></li>
                        <li style="border-bottom:none"
                            class="{{ request()->is('create-domains') ? 'active' : null }}"><a
                                href="{{ route('domain.create') }}">Add Domain</a></li>
                    </ul>
                </li>
            @else
                @php
                    $user_p = DB::table('manage_permissions')
                        ->where('user_id', auth()->user()->id)
                        ->first();
                @endphp
                @if ($user_p->domain_show_edit == 'Yes' || $user_p->domain_show== 'Yes')
                    <li
                        class="{{ request()->is('domains') || request()->is('create-domains') ? 'active open' : null }}">
                        <a href="javascript:void(0)" class="menu-toggle"><img class="hover-img"
                                src="{{ asset('img/sidenav/project.png') }}"
                                data-alt-src="{{ asset('img/sidenav/projects_1.png') }}" width="16px"
                                height="16px" alt=""> <span>Domains</span></a>
                        <ul class="ml-menu">
                            <li class="{{ request()->is('domains') ? 'active' : null }}"><a
                                    href="{{ route('domain.index') }}">All Domains</a></li>
                                    @if($user_p->domain_show_edit == 'Yes')
                            <li style="border-bottom:none"
                                class="{{ request()->is('create-domains') ? 'active' : null }}"><a
                                    href="{{ route('domain.create') }}">Add Domain</a></li>
                                    @endif
                        </ul>
                    </li>
                @endif
            @endif
            @can('reports')
                <li class="{{ request()->is('reports') ? 'active open' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><i class="fas fa-user"></i> <span>Reports</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('user') ? 'active' : null }}"><a href="{{ url('report') }}">All
                                Reports</a></li>
                        {{-- <li class="{{ request()->is('user/create') ? 'active' : null }}"><a href="{{url('user/create')}}">Add User</a>
            </li> --}}
                    </ul>
                </li>
            @endcan

            {{-- @can('leave')
        <li class="{{request()->is('leave') || request()->is('leave/create') ? 'active' : null}}">
            <a href="javascript:void(0)" class="menu-toggle"><i class="fas fa-file-alt"></i> <span>My Leaves</span></a>
            <ul class="ml-menu">
                <li class="{{request()->is('leave') ? 'active' : null}}"><a href="{{url('leave')}}">All Leave</a></li>
                <li class="{{request()->is('leave/create') ? 'active' : null}}"><a href="{{url('leave/create')}}">Apply Leave</a></li>
            </ul>
        </li>
        @endcan --}}

            @can('task')
                <li class="{{ request()->is('task') ? 'active' : null }}">
                    <a href="javascript:void(0)" class="menu-toggle"><i class="fas fa-tasks"></i> <span>My
                            Tasks</span></a>
                    <ul class="ml-menu">
                        <li class="{{ request()->is('task') ? 'active' : null }}"><a href="{{ url('task') }}">All
                                Task</a></li>
                    </ul>
                </li>
            @endcan



        </ul>
    </div>
</aside>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(".toggle-icon").click(function() {
        $(this).toggleClass("zmdi zmdi-chevron-right zmdi zmdi-chevron-left");
    });


    function btnClose() {

        var rightBtn = document.getElementById("rightBnt");
        rightBtn.style.display = "none";

        var leftBtn = document.getElementById("leftBtn");
        leftBtn.style.display = "block";
    }

    function btnOpen() {
        var rightBtn = document.getElementById("rightBnt");
        rightBtn.style.display = "block";

        var leftBtn = document.getElementById("leftBtn");
        leftBtn.style.display = "none";

    }
    $(document).ready(function() {
        $(".hover-img").hover(function() {
            var temp = $(this).attr("src");
            $(this).attr("src", $(this).attr("data-alt-src"));
            $(this).attr("data-alt-src", temp);
        });
    });
</script>
