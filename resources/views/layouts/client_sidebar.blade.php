<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar" style="font-family: 'Segoe UI';">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        {{-- {{route('dashboard.index')}} --}}
        <a href="#"><img src="{{asset('img/datech-logo.png')}}" width="25" alt="DA Tech"><span class="m-l-10">DA Tech</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    {{-- <a href="#" class="image">
                        @if (Auth::user()->role_id == 1)
                        <img src="{{asset('img/no_image.png')}}" alt="Profile-Photo" />
                        @elseif (Auth::user()->role_id == 2 && Auth::user()->employee->profile_image)
                        <img src="{{asset('storage/profile-images/'.Auth::user()->employee->profile_image)}}" alt="Profile-Photo" width="" />
                        @else
                        <img src="{{asset('img/no_image.png')}}" alt="Profile-Photo" />
                        @endif
                    </a> --}}
                    <div class="detail" style="text-align:left;">
                        <?php
                            // $employee = Auth::user()->employee;
                        ?>
                        {{-- @if (Auth::user()->role_id == 2)
                            <h5 style="font-size:13px;margin-bottom:0;">{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</h5>
                            <small>Employee</small>
                        @endif
                        <small>{{Auth::user()->role_id == 1 ? 'Admin' : null }}</small> --}}
                    </div>
                </div>
            </li>

            {{----------------- Role Client---------------}}
            @if(Auth::guard('client_login')->user()->is_client == 1)

            <li class="{{request()->is('client-project') ? 'active' : null}}">
                <a href="javascript:void(0)" class="menu-toggle"><i class="fas fa-tasks"></i> <span>Project</span></a>
                <ul class="ml-menu">
                    <li class="{{request()->is('client-project') ? 'active' : null}}"><a href="{{url('client-project')}}">Project List</a></li>
                </ul>
            </li>

            @endif

        </ul>
    </div>
</aside>
