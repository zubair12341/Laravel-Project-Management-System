@extends('layouts.master')
@section('title','Dashboard')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" />
@stop
@section('content')

<!--<div class="row clearfix">-->
<!--<div class="col-lg-3 col-md-6">-->
<!--    <div class="card">-->
<!--        <div class="body xl-blue">-->
<!--            <h6 class="m-t-0 m-b-0">Active Employees</h6>-->
<!--            <hr>-->
<!--            @foreach($employeeLogin as $employeeLogin)-->
<!--            <small>{{$employeeLogin->employee->first_name.''.$employeeLogin->employee->middle_name.''.$employeeLogin->employee->last_name}}: <i class="fa fa-circle" style="font-size:14px;color:green"></i>  </small><br>-->
<!--            @endforeach-->
<!--            <div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)" data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)" data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2" data-line-color="#ffffff" data-fill-color="transparent"><canvas width="177" height="40" style="display: inline-block; width: 177.25px; height: 40px; vertical-align: top;"></canvas></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--R-->
<style>
    @media only screen and (max-width: 768px) {
        .card-deck .card {
            margin-right: 15px;

        }

        @media only screen and (max-width: 765px) {
            .card-deck {
                flex-direction: column;
            }

        }
    }

    #cards .card-body.text-center {
        margin: auto;
        padding: 0px;
    }

    #cards .card .card-body {
        min-height: 100px !important;
    }

    #cards p {
        margin-bottom: 0.4rem !important;
    }

    .card {
        height: 115px;
    }

    .card-deck {
        padding-top: 38px;
        margin-right: 20px;
        margin-left: 20px;
    }

    .card-deck .card {
        height: 169px;
        border-radius: 18px;
        margin-right: 28px;

    }

    .card-body h4 {
        font-size: 50px;
        font-weight: bold;
        margin-top: 22px;
        color: white;
    }

    small.v1 {
        border-left: 1px solid;
        padding: 3px;
    }

    .card-text {
        margin-top: 11px;
        font-weight: bold;
    }
</style>
<div class="background" style="background: #1D262D;margin-left: -14px;margin-right: -16px;">
    <div class="container" id="cards">
        <div class="card-deck">
            <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                <div class="card-body text-center">
                    <p class="card-text">Total Employees</p>
                    <h4 class="card-text">{{$totalEmployees}}</h4>
                </div>
            </div>

            <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                <div class="card-body text-center">
                    <p class="card-text">Total Clients</p>
                    <h4>{{$totalClients}}</h4>

                </div>
            </div>

            <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                <div class="card-body text-center">
                    <p class="card-text">Total Projects</p>
                    <h4 class="totla1">{{$totalProjects}}</h4>

                </div>
            </div>

            <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                <div class="card-body text-center">
                    <p class="card-text">Total Tasks</p>
                    <h4 class="totla1">{{$totalTasks}}</h4>


                </div>
            </div>

        </div>
    </div>
    <!--R-->
    <!--<div class="col-lg-3 col-md-6">-->
    <!--     <div class="card">-->
    <!--         <div class="body xl-blue">-->
    <!--             <h4 class="m-t-0 m-b-0">{{$totalEmployees}}</h4>-->
    <!--             <p class="m-b-0">Total Employees</p>-->
    <!--             <div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)"-->
    <!--             data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)"-->
    <!--             data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2" -->
    <!--             data-line-color="#ffffff" data-fill-color="transparent">-->
    <!--                 <canvas width="177" height="40" style="display: inline-block; -->
    <!--             width: 177.25px; height: 40px; vertical-align: top;"></canvas></div>-->
    <!--         </div>-->
    <!--     </div>-->
    <!-- </div>-->
    <!-- <div class="col-lg-3 col-md-6">-->
    <!--     <div class="card">-->
    <!--         <div class="body xl-purple">-->
    <!--             <h4 class="m-t-0 m-b-0">{{$totalClients}}</h4>-->
    <!--             <p class="m-b-0 ">Total Clients</p>-->
    <!--             <div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)"-->
    <!--             data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)"-->
    <!--             data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2"-->
    <!--             data-line-color="#ffffff" data-fill-color="transparent"><canvas width="177" height="40" -->
    <!--             style="display: inline-block; width: 177.25px; height: 40px; vertical-align: top;"></canvas></div>-->
    <!--         </div>-->
    <!--     </div>-->
    <!-- </div>-->
    <!-- <div class="col-lg-3 col-md-6">-->
    <!--     <div class="card">-->
    <!--         <div class="body xl-green">-->
    <!--             <h4 class="m-t-0 m-b-0">{{$totalProjects}}</h4>-->
    <!--             <p class="m-b-0 ">Total Project</p>-->
    <!--             <hr>-->
    <!--             <small>Ongoing Project: {{$processProjects}}</small>-->
    <!--             <small>Pending Project: {{$pendingProjects}}</small>-->
    <!--             <small>Completed Project: {{$completedProjects}}</small>-->
    <!--<div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)" -->
    <!--data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)" -->
    <!--data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2"-->
    <!--data-line-color="#ffffff" data-fill-color="transparent">-->
    <!--    <canvas width="177" height="40" style="display: inline-block; width: 177.25px; height: 40px; vertical-align: top;">-->
    <!--</canvas></div>-->
    <!--         </div>-->
    <!--     </div>-->
    <!-- </div>-->
    <!-- <div class="col-lg-3 col-md-6">-->
    <!--     <div class="card">-->
    <!--         <div class="body xl-pink">-->
    <!--             <h4 class="m-t-0 m-b-0">{{$totalTasks}}</h4>-->
    <!--             <p class="m-b-0">Total Tasks</p>-->
    <!--             <hr>-->
    <!--             <small>Ongoing Task: {{$totalTasksOngoing}}</small>-->
    <!--             <small>Completed Task: {{$totalTasksCompleted}}</small>-->
    <!--<div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)" -->
    <!--data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)"-->
    <!--data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2"-->
    <!--data-line-color="#ffffff" data-fill-color="transparent">-->
    <!--<canvas width="177" height="40" style="display: inline-block; width: 177.25px; height: 40px; vertical-align: top;">-->
    <!--</canvas></div>-->
    <!--         </div>-->
    <!--     </div>-->
    <!-- </div>-->

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <button name="All" class="addtask"><a style="color:white;text-decoration: none;" href=" {{url('task-tracker')}}">All Task</a></button>
            </div>

            <div class="col-lg-4 col-md-4">
                <button name="Add" class="addtask"><a style="color:white;text-decoration: none;" href="{{url('task-tracker/create')}}">Add Task</a></button>
            </div>

            <div class="col-lg-4 col-md-4">
                <button name="Hourly" class="addtask"><a style="color:white;text-decoration: none;" href=" {{url('project')}}">Projects</a></button>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    button.addtask {
        border: none;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 58px;
        margin-top: 20px;
        background: #238eff;
        ;
        width: inherit;
        border-radius: 5px;
        height: 42px;
    }

    button.addtask:hover {
        box-shadow: 0 3px 8px 0 rgb(41 42 51 / 17%);
    }

    .card-body.text-center {
        margin-top: -35px;
    }

    p.card-text {
        font-size: 12px;
        font-weight: 700;
    }

    td,
    th {
        border: 1px solid #bbb8b8;

        padding: 8px;
    }

    div.dataTables_wrapper div.dataTables_length label {
        display: none;
    }

    .card .body {
        box-shadow: 4px 56px 82px 35px rgba(0, 0, 0, 0.1);
    }

    .table-responsive table {
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    }

    #dash-card #dash-body {
        background: #f0f0f0;
    }
</style>

<!---->

<!--<div class="row clearfix">-->
<!--    <div class="col-lg-6 col-md-6">-->
<!--        <div class="card">-->
<!--            <div class="body xl-blue">-->
<!--                <h4 class="m-t-0 m-b-0">{{$totalTasksOngoing}}</h4>-->
<!--                <p class="m-b-0">Ongoing Task</p>-->
<!--                <div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)" data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)" data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="40px" data-line-width="2" data-line-color="#ffffff" data-fill-color="transparent"><canvas width="177" height="40" style="display: inline-block; width: 177.25px; height: 40px; vertical-align: top;"></canvas></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-6 col-md-6">-->
<!--        <div class="card">-->
<!--            <div class="body xl-purple">-->
<!--                <h4 class="m-t-0 m-b-0">{{$totalTasksCompleted}}</h4>-->
<!--                <p class="m-b-0 ">Completed Task</p>-->
<!--                <div class="sparkline" data-type="line" data-spot-radius="1" data-highlight-spot-color="rgb(233, 30, 99)" data-highlight-line-color="#222" data-min-spot-color="rgb(233, 30, 99)" data-max-spot-color="rgb(0, 150, 136)" data-spot-color="rgb(0, 188, 212)" data-offset="90" data-width="100%" data-height="42px" data-line-width="2" data-line-color="#ffffff" data-fill-color="transparent"><canvas width="177" height="42" style="display: inline-block; width: 177.25px; height: 42px; vertical-align: top;"></canvas></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="dash-card">

            <div class="body " id="dash-body">
                <div class="table-responsive">
                    <h5 style="font-weight: 600;">Recently Task</h5>
                    <table class="table table-centered table-striped table-nowrap mb-0">
                        <thead>
                            <tr>
                      
                                <th>Project</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                               
                                    <td>
                                        {{ $task->project->title ?? null }}
                                    </td>
                                    <td>{{ $task->task_no }}</td>
                                    <td>
                                        @if ($task->priority == 'normal')
                                            <span class="badge badge-primary">{{ $task->priority }}</span>
                                        @elseif($task->priority == 'medium')
                                            <span class="badge badge-warning">{{ $task->priority }}</span>
                                        @elseif($task->priority == 'high')
                                            <span class="badge badge-danger">{{ $task->priority }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $task->assign_date ? \Carbon\Carbon::parse($task->assign_date)->format('j F, Y') : null }}
                                    </td>
                                    <td>
                                        {{ $task->deadline_date ? \Carbon\Carbon::parse($task->deadline_date)->format('j F, Y') : null }}
                                    </td>
                                    <td>
                                        <p style="margin-bottom: -10px;"><small>{{ $task->progress }}%</small>
                                        </p>
                                        <div class="progress"
                                            style="margin-top:8px;background:#F7C600;border-radius:0;">
                                            <div class="progress-bar l-green" role="progressbar"
                                                aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"
                                                style="width: {{ $task->progress }}%;border-radius:0;"></div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($task->status == 'pending')
                                            <span class="badge badge-danger">{{ $task->status }}</span>
                                        @elseif ($task->status == 'ongoing')
                                            <span class="badge badge-primary">{{ $task->status }}</span>
                                        @elseif ($task->status == 'in progress')
                                            <span class="badge badge-warning">{{ $task->status }}</span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge badge-success">{{ $task->status }}</span>
                                        @endif
                                    </td>
                                    <td >

                                        <a class="btn btn-success btn-sm w-100"
                                        href="{{ route('edit.task', $task->id) }}"><i class="zmdi zmdi-edit mr-1"></i> @if(auth()->user()->role_id==3) Assign  @else Edit @endif</a>
                                    <a class="btn btn-secondary btn-sm w-100"
                                        href="{{ route('task_view', $task->id) }}"><i class="zmdi zmdi-eye mr-1"></i>view</a>

                                    </td>
                                </tr>
                                <!-- Modal -->
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="dash-card">

            <div class="body " id="dash-body">

                <div class="table-responsive">
                    <h5 style="font-weight: 600;">Todays Checkin</h5>
                    <table id="refresh-data" class="admin-datatable table table-hover" style="width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Options</th>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Hours</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($todayCheckins as $todayCheckin)
                            <tr>
                                <td>
                                  
                                    
                                </td>
                                <td>{{$todayCheckin->first_name.' '.$todayCheckin->middle_name.' '.$todayCheckin->last_name}}</td>
                                <td>{{$todayCheckin->date ? date('l j F, Y', strtotime($todayCheckin->date)):null}}</td>
                                <td>
                                    <p style="margin:0;"><span class="text-primary">Check-In:</span><br>
                                        {{$todayCheckin->checkin ? date('j F, Y | g:i a', strtotime($todayCheckin->checkin)):null}}
                                    </p>
                                    <hr style="margin:0;border-top: 1px dashed #bbb8b8;">
                                    <p style="margin:0;"><span class="text-danger">Check-Out:</span><br>
                                        {{$todayCheckin->checkout ? date('j F, Y | g:i a', strtotime($todayCheckin->checkout)) : '-- Nil --'}}
                                    </p>
                                </td>
                                <td>
                                    <p style="margin:0;"><span class="text-primary">Total Hours:</span><br>
                                        {{$todayCheckin->total_hours ?? '-- Nil --'}}
                                    </p>
                                    <hr style="margin:0;border-top: 1px dashed #bbb8b8;">
                                    <p style="margin:0;"><span class="text-danger">Break Hours:</span><br>
                                        {{$todayCheckin->break_hours ?? '-- Nil --'}}
                                    </p>
                                    <hr style="margin:0;border-top: 1px dashed #bbb8b8;">
                                    <p style="margin:0;"><span class="text-success">Working Hours:</span><br>
                                        {{$todayCheckin->working_hours ?? '-- Nil --'}}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               
                <div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Time</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="Edit-Checkin">
                                <div class="modal-body">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" id="id" name="id" />
                                    <div class="form-group">
                                        <label><b>Check In Time</b></label>
                                        <input type="datetime" class="form-control form-control-sm" id="checkin" name="checkin">
                                    </div>
                                    <div class="form-group">
                                        <label><b>Check Out Time</b></label>
                                        <input type="datetime" class="form-control form-control-sm" id="checkout" name="checkout">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</div> --}}



{{-- <div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header">
                <h2>Pending Projects</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('time-tracker')}}">All Projects</a></li>
</ul>
</li>
<li class="remove">
    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
</li>
</ul>
</div>
<div class="body">
    <div class="table-responsive">
        <table id="refresh-data" class="admin-datatable table table-hover" style="width: 100%;">
            <thead class="thead-light">
                <tr>
                    <th>Options</th>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Task Count</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Options</th>
                    <th>Project Name</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Task Count</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($pendingProjectsDatas as $pendingProjectsData)
                <tr>
                    <td>
                    </td>
                    <td>{{$pendingProjectsData->title}}</td>
                    <td>{{$pendingProjectsData->full_name}}</td>
                    <td>{{$pendingProjectsData->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>




</div> --}}

<div class="row clearfix">
    <div class="col-lg-12">


    </div>

    <!--<div class="col-lg-6">-->
    <!--    <div class="card">-->
    <!--        <div class="header">-->
    <!--            <h2>Today Checkins</h2>-->
    <!--            <ul class="header-dropdown">-->
    <!--                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>-->
    <!--                    <ul class="dropdown-menu dropdown-menu-right">-->
    <!--                        <li><a href="{{url('time-tracker')}}">All Checkin</a></li>-->
    <!--                    </ul>-->
    <!--                </li>-->
    <!--                <li class="remove">-->
    <!--                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!--        </div>-->
    <!--        <div class="body">-->
    <!--            <div class="table-responsive">-->
    <!--                <table id="refresh-data" class="admin-datatable table table-hover" style="width: 100%;">-->
    <!--                    <thead class="thead-light">-->
    <!--                        <tr>-->
    <!--                            <th>Options</th>-->
    <!--                            <th>Employee</th>-->
    <!--                            <th>Date</th>-->
    <!--                            <th>Time</th>-->
    <!--                            <th>Hours</th>-->
    <!--                        </tr>-->
    <!--                    </thead>-->
    <!--                    <tfoot>-->
    <!--                        <tr>-->
    <!--                            <th>Options</th>-->
    <!--                            <th>Employee</th>-->
    <!--                            <th>Date</th>-->
    <!--                            <th>Time</th>-->
    <!--                            <th>Hours</th>-->
    <!--                        </tr>-->
    <!--                    </tfoot>-->
    <!--                    <tbody>-->
    <!--                        @foreach ($todayCheckins as $todayCheckin)-->
    <!--                        <tr>-->
    <!--                            <td>-->
    <!--                                {{-- <x-options-buttons>-->
    <!--                                    <x-slot name="buttons">-->
    <!--                                        <li><a href="javascript:void(0);" onclick="viewBreakTimeModule({{$time_tracker->id}})">View</a></li>-->
    <!--                                        <li><a href="javascript:void(0);" onclick="editModule({{$time_tracker->id}})">Edit</a></li>-->
    <!--                                        <li>-->
    <!--                                            <a href="{{url('time-tracker/'.$time_tracker->id)}}" onclick="event.preventDefault();-->
    <!--                                                document.getElementById('delete').submit();">Delete</a>-->
    <!--                                            <form id="delete" action="{{url('time-tracker/'.$time_tracker->id)}}" method="post">-->
    <!--                                                @method('delete')-->
    <!--                                                @csrf-->
    <!--                                            </form>-->
    <!--                                        </li>-->
    <!--                                    </x-slot>-->
    <!--                                </x-options-buttons> --}}-->
    <!--                            </td>-->
    <!--                            <td>{{$todayCheckin->first_name.' '.$todayCheckin->middle_name.' '.$todayCheckin->last_name}}</td>-->
    <!--                            <td>{{$todayCheckin->date ? date('l j F, Y', strtotime($todayCheckin->date)):null}}</td>-->
    <!--                            <td>-->
    <!--                                <p style="margin:0;"><span class="text-primary">Check-In:</span><br>-->
    <!--                                    {{$todayCheckin->checkin ? date('j F, Y | g:i a', strtotime($todayCheckin->checkin)):null}}-->
    <!--                                </p>-->
    <!--                                <hr style="margin:0;border-top: 1px dashed #bbb8b8;">-->
    <!--                                <p style="margin:0;"><span class="text-danger">Check-Out:</span><br>-->
    <!--                                    {{$todayCheckin->checkout ? date('j F, Y | g:i a', strtotime($todayCheckin->checkout)) : '-- Nil --'}}-->
    <!--                                </p>-->
    <!--                            </td>-->
    <!--                            <td>-->
    <!--                                <p style="margin:0;"><span class="text-primary">Total Hours:</span><br>-->
    <!--                                    {{$todayCheckin->total_hours ?? '-- Nil --'}}-->
    <!--                                </p>-->
    <!--                                <hr style="margin:0;border-top: 1px dashed #bbb8b8;">-->
    <!--                                <p style="margin:0;"><span class="text-danger">Break Hours:</span><br>-->
    <!--                                    {{$todayCheckin->break_hours ?? '-- Nil --'}}-->
    <!--                                </p>-->
    <!--                                <hr style="margin:0;border-top: 1px dashed #bbb8b8;">-->
    <!--                                <p style="margin:0;"><span class="text-success">Working Hours:</span><br>-->
    <!--                                    {{$todayCheckin->working_hours ?? '-- Nil --'}}-->
    <!--                                </p>-->
    <!--                            </td>-->
    <!--                        </tr>-->
    <!--                        @endforeach-->
    <!--                    </tbody>-->
    <!--                </table>-->
    <!--            </div>-->

    <!-- Edit Modal for TimeTracker -->
    <!--            <div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
    <!--                <div class="modal-dialog">-->
    <!--                <div class="modal-content">-->
    <!--                    <div class="modal-header">-->
    <!--                    <h5 class="modal-title" id="exampleModalLabel">Edit Time</h5>-->
    <!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                        <span aria-hidden="true">&times;</span>-->
    <!--                    </button>-->
    <!--                    </div>-->
    <!--                    <form id="Edit-Checkin">-->
    <!--                    <div class="modal-body">-->
    <!--                        @csrf-->
    <!--                        @method('put')-->
    <!--                        <input type="hidden" id="id" name="id"/>-->
    <!--                        <div class="form-group">-->
    <!--                            <label><b>Check In Time</b></label>-->
    <!--                            <input type="datetime" class="form-control form-control-sm" id="checkin" name="checkin">-->
    <!--                        </div>-->
    <!--                        <div class="form-group">-->
    <!--                            <label><b>Check Out Time</b></label>-->
    <!--                            <input type="datetime" class="form-control form-control-sm" id="checkout" name="checkout">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="modal-footer">-->
    <!--                    <button type="submit" class="btn btn-primary">Save changes</button>-->
    <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
    <!--                    </div>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<script>

</script>

@stop

@section('page-script')
<script src="{{asset('assets/bundles/countTo.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/knob.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/sparkline.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/widgets/infobox/infobox-1.js')}}"></script>
<script src="{{asset('assets/js/pages/charts/jquery-knob.js')}}"></script>
<script src="{{asset('assets/js/pages/charts/sparkline.js')}}"></script>
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
@stop