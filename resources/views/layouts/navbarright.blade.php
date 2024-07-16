<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<style>
    .navbar-right .navbar-nav {
        right: -11px;
        top: -1px;
        background: #1D262D;
    }

    .navbar-right .navbar-brand img {
        margin-top: -10px;


    }

    ul.dropdown-menu.slideUp2.show {
        width: 339px;
    }
    .special-d
    {
        margin-bottom: 0
    }
    .special-a{
 
    border-radius: 5px;
    color: #222;
    line-height: 50px;
    text-align: center;
    width: 50px;
    transition: all 0.5s;
    }
    .special-a:hover
    {
       background-color: #FF9948
    }

    
 
</style>
<div class="navbar-right">

    <ul class="navbar-nav h-100">

        <a href="" class="navbar-brand"><img src="{{ asset('assets/images/icon.png') }}" alt=""></a>

        <li class="dropdown d-flex align-items-center mt-5 special-d special-a">
          
            
                        @livewire('notifications')


        </li>
                {{-- <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li> --}}
        
      
        {{-- <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown"
                role="button"><img src="{{ asset('img/sidebar/3.png') }}" width="20" alt=""></i></a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">App Sortcute</li>
                <li class="body">
                    <ul class="menu app_sortcut list-unstyled">
                        <li>
                            <a href="#">
                                <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-camera"></i></div>
                                <p class="mb-0">Employees</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-calendar"></i></div>
                                <p class="mb-0">Calendar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> --}}
        {{-- 
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><img src="{{asset('img/sidebar/1.png')}}" width="20" alt=""></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu slideUp2">
                <li class="header">Tasks List <small class="float-right"><a href="javascript:void(0);">View All</a></small></li>
                <li class="body">
                    <ul class="menu tasks list-unstyled">
                        <li>
                            <div class="progress-container progress-primary">
                                <span class="progress-badge">eCommerce Website</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                        <span class="progress-value">86%</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled team-info">
                                    <li class="m-r-15"><small>Team</small></li>
                                    <li>
                                        <img src="../assets/images/xs/avatar2.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar3.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar4.jpg" alt="Avatar">
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="progress-container">
                                <span class="progress-badge">iOS Game Dev</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                        <span class="progress-value">45%</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled team-info">
                                    <li class="m-r-15"><small>Team</small></li>
                                    <li>
                                        <img src="../assets/images/xs/avatar10.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar9.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar8.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar7.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar6.jpg" alt="Avatar">
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="progress-container progress-warning">
                                <span class="progress-badge">Home Development</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;">
                                        <span class="progress-value">29%</span>
                                    </div>
                                </div>
                                <ul class="list-unstyled team-info">
                                    <li class="m-r-15"><small>Team</small></li>
                                    <li>
                                        <img src="../assets/images/xs/avatar5.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar2.jpg" alt="Avatar">
                                    </li>
                                    <li>
                                        <img src="../assets/images/xs/avatar7.jpg" alt="Avatar">
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> --}}
        {{-- <li><a href="#search" class="main_search" title="Search..."><img src="{{ asset('img/sidebar/2.png') }}"
                    width="20" alt=""></a></li> --}}
        <style>
            .mega-menu {
                margin-bottom: 30px;
            }
        </style>
        <li>
            <a class="mega-menu mt-5" href="{{ route('logout') }}"
                onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                <img src="{{ asset('img/sidebar/5.png') }}" width="16" alt="">
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>

        <div class="d-flex flex-column align-items-center mb-5" style="margin-top: -30px;">
            <div class="arrow-up"></div>
            <a href=""><img src="{{ asset('assets/images/icon.png') }}" width="30" alt="Logo"></a>
        </div>
        <style>
            .arrow-up {
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-bottom: 8px solid #cbcbcb;
                margin-bottom: 3px;
            }
        </style>
        <!--<li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>-->
        <!-- logout -->


        <!-- <style>
            .notification-dropdown .dropdown-menu {
             width: 300px;
            height: 300px;
                
                
            }
            .notification-dropdown .dropdown-menu p{
                font-size: 12px;
                display: flex;
                justify-content: center;
                align-items: center;
                
            }
           
        </style> -->

        {{-- <div class="notification-dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-solid fa-bell"></i>
       </button>
       <div class="dropdown-menu dropdown-menu-right " aria-labelledby="notificationDropdown">
        <p>
@foreach ($notifications as $notification)
<a href="{{ url('task/' . $tasks->id . '/edit') }}">{{ $notification->message }}</a>
        <form method="PUT" action="{{ url('notification/' . $notification->id) }}">
        <button type="submit">Mark as read</button>
    </form>
@endforeach
        </p>
       
     
</div>
</div>  --}}
        <style>
        </style>


<script>
    <script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('element.updated', (el, component) => {
            // Preserve scroll position
            el.scrollTop = el.scrollHeight;
        });
    });
</script>
</script>

    </ul>
</div>
