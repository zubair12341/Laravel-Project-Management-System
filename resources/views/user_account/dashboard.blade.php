@extends('layouts.master')
@section('title', 'Profile')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/plugins/light-gallery/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.css') }}">
@stop
@section('content')



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
                                <h4>{{$pending_task_count}}</h4>
                            </div>
                        </div>
            
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%)
                        !important;">
                            <div class="card-body text-center">
                                <p class="card-text">On Working Tasks</p>
                                <h4 class="totla1">{{$progress_task_count+$ongoing_task_count}}</h4>
            
                            </div>
                        </div>
            
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;">
                            <div class="card-body text-center">
                                <p class="card-text">Completed Tasks</p>
                                <h4 class="totla1">{{$complete_task_count}}</h4>
            
                            </div>
                        </div>
            
                        <div class="card" style="background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%)
                        !important;">
                            <div class="card-body text-center">
                                <p class="card-text">Total Tasks</p>
                                <h4 class="totla1">{{$task_count}}</h4>
            
            
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
                                    <h5 class="card-title text-dark" ><strong>Recently Added Task </strong></h5>
                                </div>
                                <div class="col-2">
                                    <a href="{{ url('task') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>



                            <div class="table-responsive">
                                <table class="table table-centered table-striped table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>Project</th>
                                            <th>Task No</th>
                                            <th>Priority</th>
                                            <th>Assign Date</th>
                                            <th>Deadline Date</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>
                                                    <x-options-buttons>
                                                        <x-slot name="buttons">
                                                            <li><a href="{{ url('task/' . $task->id . '/edit') }}">View</a></li>
                                                        </x-slot>
                                                    </x-options-buttons>
                                                </td>
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
                                            </tr>
                                            <!-- Modal -->
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
    <script src="{{ asset('assets/plugins/light-gallery/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/fullcalendarscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/medias/image-gallery.js') }}"></script>
    <script src="{{ asset('assets/js/pages/calendar/calendar.js') }}"></script>

    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!---->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <!---->
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

@push('after-scripts')
@endpush
