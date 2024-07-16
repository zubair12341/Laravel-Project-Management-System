@extends('layouts.master')
@section('title', 'Dashboard')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/light-gallery/css/lightgallery.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}">
@stop
@section('content')

@include('layouts.alert_message')

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
    <div class="px-3">

        <!-- Start Content-->
        <div class="container-fluid">

           
            <div class="background" style="background: #1D262D;margin-left: -14px;margin-right: -16px;">
                <div class="container" id="cards">
                    <br>
                    <br>
                    <div class="card-deck">
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                            <div class="card-body text-center">
                                <p class="card-text">Pending Tasks</p>
                                <h4>{{ $total_pending_count }}</h4>
                            </div>
                        </div>
                
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                            <div class="card-body text-center">
                                <p class="card-text">On Working Tasks</p>
                                <h4 class="totla1">{{ $total_progress_count + $total_ongoing_count }}</h4>
                            </div>
                        </div>
                
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                            <div class="card-body text-center">
                                <p class="card-text">Completed Tasks</p>
                                <h4 class="totla1">{{ $total_complete_count }}</h4>
                            </div>
                        </div>
                
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                            <div class="card-body text-center">
                                <p class="card-text">Total Tasks</p>
                                <h4 class="totla1">{{ $total_task_count }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                
            
            <br><br><br><br>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                           
                        </div>
            
                        <div class="col-lg-4 col-md-4">
                       
                        </div>
            
                        <div class="col-lg-4 col-md-4">
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row-->



            <div class="row">

                <!--end col-->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <h5 class="card-title text-dark" ><strong>Projects </strong></h5>
                                </div>
                                @if(auth()->user()->role_id=='3')
                                <div class="col-2">
                                    <a href="{{ url('task') }}" class="btn btn-primary">View All</a>
                                </div>
                                @else
                                <div class="col-2">
                                    <a href="{{ url('project') }}" class="btn btn-primary">View All</a>
                                </div>
                                @endif
                            </div>



                            <div class="table-responsive">
                                <table class="admin-datatable table table-hover shadow-sm" style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border: none;color:#1D262D;background:white">Title</th>
                                            <th class="text-center" style="border: none;color:#1D262D;background:white">Team Lead
                                            </th>
                                            <th class="text-center" style="border: none;color:#1D262D;background:white">Status</th>
                                            <th class="text-center" style="border: none;color:#1D262D;background:white">Start Date
                                            </th>
                                            <th class="text-center" style="border: none;color:#1D262D;background:white">End Date
                                            </th>
                                            {{-- <th class="text-center" style="border: none;color:#1D262D;background:white">Action</th> --}}
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @foreach ($tasks as $project)
                                            <tr data-toggle="collapse" onclick="toggleColor(this)"
                                                data-target="#demo1{{ $project->id }}" class="accordion-toggle">
                                                <td>
        
                                                    <img id="icon" src="{{ asset('img/right.png') }}" width="20"
                                                        height="20" alt="">
                                                    {{ $project->title }}
                                                </td>
                                                <td>
                                                    @if ($project->employee)
                                                        {{ $project->employee->employee->first_name . ' ' . $project->employee->employee->last_name }}
                                                    @endif
                                                </td>
                                                <td> <input readonly id="stauts" name="status"
                                                        @if ($project->status == 'completed') style="border-radius:7px;background:#38C38D;color:white;" @elseif($project->status == 'process') style="border-radius:7px;background:#FBAB10;color:white;" @elseif($project->status == 'pending') style="border-radius:7px;background:#3889FF;color:white;" @else style="border-radius:7px;background:red;color:white;" @endif
                                                        class="form-control-sm ms" value="{{ $project->status }}">
        
        
                                                </td>
        
        
                                                <td>{{ $project->start_date ? date('j F, Y', strtotime($project->start_date)) : null }}
                                                </td>
                                                <td>{{ $project->end_date ? date('j F, Y', strtotime($project->end_date)) : null }}
                                                </td>
                                                {{-- <td>
        
                                                    <button data-toggle="modal" data-target="#exampleModal{{ $project->id }}"
                                                        class="btn btn-success btn-sm w-100"><i class="zmdi zmdi-edit mr-1"></i>
                                                        Edit</button>
                                                    <a href="{{ route('project.delete', $project->id) }}"><button
                                                            class="btn btn-danger btn-sm w-100"><i class="zmdi zmdi-delete"></i>
                                                            Delete</button></a>
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="background-color: #f0f0f0;" class="hiddenRow">
                                                    <div class="accordion-body collapse" id="demo1{{ $project->id }}">
                                                        <table class="admin-datatable table table-hover mt-5 shadow" id="table1"
                                                            style="width: 100%; background:white">
                                                            <thead class="thead-light no-sort">
                                                                <tr>
                                                                    <th style="background:white;">#</th>
                                                                    <th class=" text-center "
                                                                        style="color:#1D262D;background:white">Task</th>
        
                                                                    <th class="text-center"
                                                                        style="color:#1D262D;background:white">Developer</th>
                                                                    <th class="text-center"
                                                                        style="color:#1D262D;background:white">Status</th>
                                                                    <th class="text-center"
                                                                        style="color:#1D262D;background:white">Priority</th>
                                                                    <th class="text-center "
                                                                        style="color:#1D262D;background:white">Progress</th>
        
                                                                    <th class="text-center"
                                                                        style="color:#1D262D;background:white">Deadline</th>
                                                                    <th class="text-center"
                                                                        style="color:#1D262D;background:white">Assign</th>
                                                                    <th class="text-center"
                                                                        style="border-right: none;color:#1D262D;width:85px;background:white">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
        
                                                            <tbody>
                                                                <?php
                                                                $projectTasks = DB::table('tasks')
                                                                    // ->join('projects', 'projects.id', '=', 'tasks.project_id')
                                                                    // ->join('employees', 'employees.id', '=', 'tasks.employee_id')
                                                                
                                                                    ->where('project_id', $project->id)
                                                                    ->get();
                                                                
                                                                ?>
                                                                @php
                                                                    $i = 0;
                                                                @endphp
                                                                @foreach ($projectTasks as $projectTask)
                                                                    <?php
                                                                    $referenceCount = DB::table('task_attachments')
                                                                        ->select(DB::raw('count(distinct attachment) as quantity'))
                                                                        ->where('task_id', $projectTask->id)
                                                                        ->first();
                                                                    ?>
        
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="border-left: none;">{{ $i }}</td>
                                                                        <td>
                                                                            {{ $project->title }}
        
                                                                        </td>
        
                                                                        <td>
                                                                            @php $employee = DB::table('employees')
                                                                                    ->where('id', $projectTask->employee_id)
                                                                                ->first(); @endphp
                                                              
                                                                            <span> @if($employee) {{ $employee->first_name . ' ' . $employee->last_name ?? null }} @else Not assign to developer @endif</span>
        
        
        
                                                                        </td>
                                                                        <td>
                                                                            @if ($projectTask->status == 'ongoing')
                                                                                <span style="background:#FCAB10;"
                                                                                    class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                                            @elseif($projectTask->status == 'completed')
                                                                                <span style="background: #39C38D;"
                                                                                    class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                                            @elseif($projectTask->status == 'pending')
                                                                                <span style="background: #BBBDC1;"
                                                                                    class="btn btn-sm w-100">{{ $projectTask->status }}</span>
                                                                            @elseif($projectTask->status == 'working on it')
                                                                                <span style="background: #FBAB10;"
                                                                                    class="btn btn-sm">{{ $projectTask->status }}</span>
                                                                            @elseif($projectTask->status == 'in progress')
                                                                                <span style="background: #BBBDC1;"
                                                                                    class="btn btn-sm">{{ $projectTask->status }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
        
        
                                                                            @if ($projectTask->priority == 'high')
                                                                                <span style="background:#fc2b10;"
                                                                                    class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                                            @elseif($projectTask->priority == 'normal')
                                                                                <span style="background: #39C38D;"
                                                                                    class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                                            @elseif($projectTask->priority == 'medium')
                                                                                <span style="background: #df9b09;"
                                                                                    class="btn btn-sm w-100">{{ ucFirst($projectTask->priority) }}</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <span style="background: #272c77;"
                                                                                class="btn btn-sm w-100">{{ ucFirst($projectTask->progress) }}%</span>
                                                                        </td>
        
        
                                                                        <td>
                                                                            {{ $projectTask->deadline_date ? \Carbon\Carbon::parse($projectTask->deadline_date)->format('j F, Y') : null }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $projectTask->assign_date ? \Carbon\Carbon::parse($projectTask->assign_date)->format('j F, Y') : null }}
                                                                        </td>
                                                                        <td style="border-right: none; ">
        
                                                                            <a class="btn btn-success btn-sm w-100"
                                                                            href="{{ route('edit.task', $projectTask->id) }}"><i class="zmdi zmdi-edit mr-1"></i> @if(auth()->user()->role_id==3) Assign  @else Edit @endif</a>
                                                                        <a class="btn btn-secondary btn-sm w-100"
                                                                            href="{{ route('task_view', $projectTask->id) }}"><i class="zmdi zmdi-eye mr-1"></i>view</a>
        
                                                                        </td>
        
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ url('project/' . $project->id . '/task') }}"><button
                                                                    style="background-color: #FBAB10;"
                                                                    class="btn ml-auto">View</button> </a>
                                                        </div>
        
                                                    </div>
                                                </td>
                                            </tr>
        
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!--end card body-->

                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

            </div>
            <!--end row-->

        </div> <!-- container -->

    </div>
@stop

@section('page-script')
<script src="{{asset('assets/plugins/light-gallery/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('assets/bundles/fullcalendarscripts.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/medias/image-gallery.js')}}"></script>
<script src="{{asset('assets/js/pages/calendar/calendar.js')}}"></script>

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

@push('after-scripts')

<script>

function showModule(id){
    $.get('/timebreaker/'+id, function(viewTimeTracker){
        $('#break-time').empty();
        if (viewTimeTracker.length > 0) {
            $.each(viewTimeTracker, function (index, value) {
                $('#break-time').append('<tr>' +
                    '<td>' + value.breakin  + '</td>' +
                    '<td>' + value.breakout + '</td>' +
                    '<td>' + value.total_hours + '</td>' +
                    '</tr>');
            });

            $('#viewModal').modal('toggle');
        }
        else{
            $('#break-time').append('<div  style="text-align:center;"><p>Break time not found</p></div>');
            $('#viewModal').modal('toggle');
        };

    });
}

$(window).load(function()
{
    $('#onloadModal').modal('show');
})

</script>

<script>
    function display_ct6() {
        var x = new Date()
        var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
        hours = x.getHours( ) % 12;
        hours = hours ? hours : 12;
        var x1 = x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear();
        x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
        document.getElementById('ct6').innerHTML = x1;
        display_c6();
        }
        function display_c6(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct6()',refresh)
        }
    display_c6();
</script>
@endpush
