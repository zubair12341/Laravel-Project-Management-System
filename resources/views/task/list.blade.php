@extends('layouts.master')
@section('title', 'Task Tracker')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    {{-- <link rel="stylesheet"
        href="//cdn.datatables.net/plug-ins/1.10.24/features/searchHighlight/dataTables.searchHighlight.css" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" /> --}}

@stop

@section('content')
    @include('layouts.alert_message')
    <style>
        #btn {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;
        }

        #background {
            width: 103%;
            margin-left: -13px;
        }

        #card #body {
            background: #f0f0f0;
        }

        #table1 td,
        th {
            border: 1px solid #bbb8b8;

            padding: 8px;
        }

        .hiddenRow {
            padding: 0 !important;
        }

        .modal .modal-header .close {
            font-size: 40px;
            color: black;
            margin: -35px;
        }

        .modal-content .modal-header {
            padding-bottom: 10px;
        }

        .nav-link {
            color: #67696B;
            font-weight: bold;
        }

        .nav-link.active {
            border-bottom: 2px solid #F9BB78;
            color: #F9BB78;
        }

        select {
            height: 33px;
            padding: 8px;
            min-width: 250px;
            background: rgba(0, 0, 0, 0);
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-simple {
            display: none;
        }
        button.btn.dropdown-toggle.btn-simple {
    display: none;
}
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">

                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Tasks</h1>
                            </div>
                        </div>
                        <div class="container-fluid mb-5">
                            <div id="btn-row" class="row d-flex justify-content-center">
                                @if (auth()->user()->role_id != '3')
                                    <div class="col-md-2 w-100">
                                        <a href="{{ url('project/create') }}"><button id="btn" style="width: 100%"
                                                class="btn ">Add Projects</button></a>

                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ url('project') }}"><button id="btn" style="width: 100%"
                                                class="btn">All Projects</button></a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url('task-tracker/create') }}"><button id="btn"
                                                style="width: 100%" class="btn">Add Task</button></a>
                                    </div>
                                @else
                                    <div class="col-md-2">
                                        <a href="{{ url('task') }}"><button id="btn" style="width: 100%"
                                                class="btn">My Task</button></a>
                                    </div>
                                @endif
                            </div>
                        </div>






                        <div class="d-flex justify-content-center mt-4">
                            <div class="w-50 ">
                                {{-- <div class="form-group mb-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-0">
                                            <img src="{{asset('img/sidebar/2.png')}}" width="25" height="25">
                                        </span>
                                    </div>
                                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Search: Client name, project task....">
                                </div>
                                <hr class="border-secondary my-2">
                            </div> --}}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="body shadow-lg" id="body">

                    <form action="" method="GET">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="sssss" class="form-label mx-2">Filter by Sales person</label>
                                </div>
                                <div class="col-3">
                                    <label for="ssssss" class="form-label mx-2">Filter by Status</label>
                                </div>
                                <div class="col-3">
                                    <label for="ssssss" class="form-label mx-2">Filter by Project Title</label>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-3">
                                    <select name="sale_id" id="sssss" class="">
                                        <option value="">All</option>
                                        @foreach ($sale as $lead)
                                            <option @if (isset($_GET['sale_id']) && $_GET['sale_id'] == $lead->id) selected @endif
                                                value="{{ $lead->id }}">{{ $lead->employee->first_name }}
                                                {{ $lead->employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="status" id="ssssss" class="">
                                        <option value="">All</option>
                                        <option @if (isset($_GET['status']) && $_GET['status'] == 'pending') selected @endif value="pending">Pending
                                        </option>
                                        <option @if (isset($_GET['status']) && $_GET['status'] == 'process') selected @endif value="process">Process
                                        </option>
                                        <option @if (isset($_GET['status']) && $_GET['status'] == 'completed') selected @endif value="completed">
                                            Completed</option>
                                        <option @if (isset($_GET['status']) && $_GET['status'] == 'terminated') selected @endif value="terminated">
                                            Terminated</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="project_title"
                                        value="{{ isset($_GET['project_title']) ? $_GET['project_title'] : '' }}">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn " id="btn">Filter</button>
                                </div>
                            </div>


                        </div>
                    </form>

                    <div class="table-responsive">

                        <table class="admin-datatable table table-hover" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($projects as $project)
                                    <tr data-toggle="collapse" onclick="toggleColor(this)"
                                        data-target="#demo1{{ $project->id }}" class="accordion-toggle">
                                        <td>
                                            <p><img id="icon" src="{{ asset('img/right.png') }}" width="20"
                                                    height="20" alt="">
                                                <span style="font-weight:bold;"> Project :</span> {{ $project->title }}
                                                <span style="font-size: 14px;color:#A1BBEE;">
                                                    (Sale person:{{ $project->sale->employee->first_name }}) (Status: {{$project->status}})</span>
                                            </p>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>


                                        <td></td>
                                        <td></td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="background-color: #f0f0f0;" class="hiddenRow">
                                            <div class="accordion-body collapse" id="demo1{{ $project->id }}">
                                                <table class="admin-datatable table table-hover mt-5 shadow" id="table1"
                                                    style="width: 100%; background:white">
                                                    <thead class="thead-light no-sort">
                                                        <tr>
                                                            <th style="background:white;">#</th>


                                                            <th class="text-center"
                                                                style="color:#1D262D;background:white">
                                                                Developer</th>
                                                            <th class="text-center"
                                                                style="color:#1D262D;background:white">
                                                                Status</th>
                                                            <th class="text-center"
                                                                style="color:#1D262D;background:white">
                                                                Priority</th>
                                                            <th class="text-center "
                                                                style="color:#1D262D;background:white">
                                                                Progress</th>

                                                            <th class="text-center"
                                                                style="color:#1D262D;background:white">
                                                                Deadline</th>
                                                            <th class="text-center"
                                                                style="color:#1D262D;background:white">
                                                                Assign</th>
                                                            <th class="text-center"
                                                                style="border-right: none;color:#1D262D;width:85px;background:white">
                                                                Action </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($project->tasks as $projectTask)
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
                                                                    @if ($projectTask->employee)
                                                                        <span>{{ $projectTask->employee->first_name . ' ' . $projectTask->employee->middle_name . ' ' . $projectTask->employee->last_name ?? null }}</span>
                                                                    @else
                                                                        Not Assign to developer
                                                                    @endif


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
                                                                        href="{{ route('edit.task', $projectTask->id) }}"><i
                                                                            class="zmdi zmdi-edit mr-1"></i>
                                                                        @if (auth()->user()->role_id == 3)
                                                                            Assign
                                                                        @else
                                                                            Edit
                                                                        @endif
                                                                    </a>
                                                                    <a class="btn btn-secondary btn-sm w-100"
                                                                        href="{{ route('task_view', $projectTask->id) }}"><i
                                                                            class="zmdi zmdi-eye mr-1"></i>View</a>

                                                                </td>

                                                            </tr>

                                                            <style>
                                                                .body {
                                                                    position: relative;
                                                                }

                                                                .modal {
                                                                    position: absolute;
                                                                    margin-left: 280px;

                                                                }

                                                                @media only screen and (max-width: 765px) {
                                                                    .modal {

                                                                        margin-left: 0;

                                                                    }

                                                                }

                                                                .modal-content .modal-header button {
                                                                    right: 482px;

                                                                }

                                                                .modal-content .modal-header img {
                                                                    position: absolute;
                                                                    left: 451px;
                                                                    top: 15px;
                                                                }
                                                            </style>

                                                            <div id="myModal{{ $projectTask->employee_id }}"
                                                                class="modal fade">
                                                                <div class="modal-dialog ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">

                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal">&times;<span
                                                                                    class="sr-only">Close</span></button>
                                                                            <img src="{{ asset('img/sidebar/icon.png') }}"
                                                                                width="30" height="30"
                                                                                alt="">

                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h2>{{ $projectTask->employee_id }}</h2>
                                                                            <h5 class="ml-2"
                                                                                style="color: #0E0E0F;font-weight:bold;">
                                                                                {{ $projectTask->project->title ?? null }}
                                                                            </h5>
                                                                            <ul class="nav mb-1 border-bottom">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link active"
                                                                                        data-toggle="tab"
                                                                                        href="#update">Update</a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" data-toggle="tab"
                                                                                        href="#files">Files</a>

                                                                                </li>
                                                                            </ul>
                                                                            <hr style="margin-top:-4px;">
                                                                            <div class="tab-content">
                                                                                <div id="update"
                                                                                    class="tab-pane fade show active">

                                                                                </div>
                                                                                <div id="files"
                                                                                    class="tab-pane fade ">
                                                                                    <style>
                                                                                        #add-btn {
                                                                                            background-image: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%);
                                                                                            border-color: transparent;
                                                                                            -webkit-background-clip: text;
                                                                                            -moz-background-clip: text;
                                                                                            -webkit-text-fill-color: transparent;
                                                                                            -moz-text-fill-color: transparent;
                                                                                        }
                                                                                    </style>
                                                                                    <button type="submit"
                                                                                        style=" border: 1px solid #FE8415"
                                                                                        id="add-btn" class="btn"><i
                                                                                            class="zmdi zmdi-plus mt-1"></i>
                                                                                        Add File</button>

                                                                                    @foreach ($project->task_attachment as $ta)
                                                                                        <div class="container">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-6">

                                                                                                    <div class="card"
                                                                                                        style="background: #EFF1F1;width:200px;border-radius:7px;height:160px;border:1px solid #C3C4C5;">
                                                                                                        <div
                                                                                                            class="card-body">

                                                                                                            <h6>PDF</h6>
                                                                                                        </div>

                                                                                                        <p class="card-footer"
                                                                                                            style="background:#FFFFFF;margin-top:-95px;border-bottom:1px solid #C3C4C5;">
                                                                                                            {{ $ta->attachment }}
                                                                                                        </p>


                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach



                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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




                    </div>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


@stop

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Task Details</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" style="height:0px;">
                        <tr>
                            <td class="table-style text-muted">Project</td>
                            <td id="project" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Employee</td>
                            <td id="employee" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Task No</td>
                            <td id="task_no" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Priority</td>
                            <td id="priority" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Assign Date</td>
                            <td id="assign_date" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Deadline Date</td>
                            <td id="deadline_date" class="table-style"></td>
                        </tr>
                        <tr>
                            <td class="table-style text-muted">Status</td>
                            <td id="status" class="table-style"></td>
                        </tr>

                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('page-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    {{-- <script src="https://cdn.datatables.net/plug-ins/1.10.24/features/searchHighlight/dataTables.searchHighlight.min.js">
    
    </script> --}}
    {{-- <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script> --}}
    <script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

@push('after-scripts')
    <script>
        function viewDetails(id) {
            $.get('/task/' + id, function(task) {
                $('#id').html(task.id);
                $('#project').html(task.project_id);
                $('#employee').html(task.employee_id);
                $('#task_no').html(task.task_no);
                $('#priority').html(task.priority);
                $('#assign_date').html(task.assign_date);
                $('#deadline_date').html(task.deadline_date);
                $('#status').html(task.status);
                $('#showModal').modal('toggle');
            });
        }

        function viewProgress(id) {
            $.get('/check-view-progress/' + id, function(checkViewProgress) {
                if (checkViewProgress.title) {
                    window.location.href = "{{ url('/view-task-progress') }}" + "/" + id;
                } else {
                    alert('No task progress submit yet');
                }
            });
        }
    </script>
    <script>
        var messageLink = document.getElementById('open');
        var box = document.getElementById('box');

        messageLink.addEventListener('click', function(e) {
            e.preventDefault();
            box.style.display = 'block';
        });

        var closeButton = document.querySelector('#box .close');
        var box = document.querySelector('#box');

        closeButton.addEventListener('click', function() {
            box.style.display = 'none';
        });
    </script>

    <script>
        function open_popup() {
            document.getElementById("box").style.display = 'block';
        }
    </script>
@endpush
