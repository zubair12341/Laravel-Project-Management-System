@extends('layouts.master')
@section('title', 'Projects')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


    <link rel="stylesheet"
        href="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/styles/ssi-uploader.min.css') }}" />
@stop
@section('content')
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

        .modal .modal-header .close {
            font-size: 40px;
            color: black;
            margin: -35px;
        }

        .modal-content .modal-header {
            padding-bottom: 10px;
        }

        .modal-content {
            margin-left: 30px;
        }

        #table1 td,
        th {
            border: 1px solid #bbb8b8;

            padding: 8px;
        }

        .hiddenRow {
            padding: 0 !important;
        }

        #card #body {
            background: #f0f0f0;
        }

        .accordion-toggle {

            background-color: #FFFFFF;
        }

        .accordion-toggle.red {
            background-color: #f0f0f0;
        }

        a.dropdown-toggle {
            margin-left: 0px !important;
        }

        span.point.text-white {
            font-size: 12px;
        }

        .special-a:hover {
            background-color: #FF9948;
            padding: 13px 11px ! IMPORTANT;
            PADDING-RIGHT: 10PX !important;
        }
        .special-a {
            padding: 13px 11px ! IMPORTANT;
            PADDING-RIGHT: 10PX !important;
        }

        .theme-orange .navbar-right .navbar-nav>li>a:hover {
    background: #FF9948;
    padding: 13px 11px ! IMPORTANT;
            PADDING-RIGHT: 10PX !important;
}

.theme-orange .navbar-right .navbar-nav>li>a {
    padding: 13px 11px ! IMPORTANT;
            PADDING-RIGHT: 10PX !important;
}
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Projects</h1>
                            </div>
                        </div>
                        <div class="container-fluid mb-5">
                            <div id="btn-row" class="row d-flex justify-content-center">
                                <div class="col-md-2 w-100">
                                    <a href="{{ url('project/create') }}"><button id="btn" style="width: 100%"
                                            class="btn ">Add Projects</button></a>

                                </div>

                                <div class="col-md-2">
                                    <a href="{{ url('task-tracker/create') }}"><button id="btn" style="width: 100%"
                                            class="btn">Add Tasks</button></a>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-center mt-4">
                            <div class="w-50 ">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    <form action="" method="GET">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label for="sssss" class="form-label mx-2">Filter by team lead</label>
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
                                    <select name="lead_id" id="sssss" class="form-control form-control-sm">
                                        <option value="">All</option>
                                        @foreach ($users as $lead)
                                            <option @if (isset($_GET['lead_id']) && $_GET['lead_id'] == $lead->id) selected @endif
                                                value="{{ $lead->id }}">{{ $lead->employee->first_name }}
                                                {{ $lead->employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="status" id="ssssss" class="form-control form-control-sm">
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
                        <table class="admin-datatable table table-hover shadow-sm" style="width: 100%;background:white;">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">#</th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Title</th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Team Lead
                                    </th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Sales Person
                                    </th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Status</th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Start Date
                                    </th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">End Date
                                    </th>
                                    <th class="text-center" style="border: none;color:#1D262D;background:white">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $in = 0;
                                @endphp
                                @foreach ($projects as $project)
                                    @php
                                        $in++;
                                    @endphp
                                    <tr data-toggle="collapse" onclick="toggleColor(this)"
                                        data-target="#demo1{{ $project->id }}" class="accordion-toggle">
                                        <td class="d-flex">
                                            <img id="icon" src="{{ asset('img/right.png') }}" width="20"
                                                height="20" alt="">
                                            {{ $in }}
                                        </td>
                                        <td>


                                            {{ $project->title }}
                                        </td>
                                        <td>
                                            @if ($project->employee)
                                                {{ $project->employee->employee->first_name . ' ' . $project->employee->employee->last_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($project->sale)
                                                {{ $project->sale->employee->first_name . ' ' . $project->sale->employee->last_name }}
                                            @else
                                                Admin
                                            @endif
                                        </td>
                                        <td> <input readonly id="stauts" name="status"
                                                @if ($project->status == 'completed') style="border-radius:7px;background:#38C38D;color:white;" @elseif($project->status == 'process') style="border-radius:7px;background:#FBAB10;color:white;" @elseif($project->status == 'pending') style="border-radius:7px;background:#3889FF;color:white;"
                                                @elseif($project->status == 'terminated') style="border-radius:7px;background:red;color:white;" @endif
                                                class="form-control-sm ms" value="{{ $project->status }}">


                                        </td>


                                        <td>{{ $project->start_date ? date('j F, Y', strtotime($project->start_date)) : null }}
                                        </td>
                                        <td>{{ $project->end_date ? date('j F, Y', strtotime($project->end_date)) : null }}
                                        </td>
                                        <td>

                                            <button data-toggle="modal" data-target="#exampleModal{{ $project->id }}"
                                                class="btn btn-success btn-sm w-100"><i class="zmdi zmdi-edit mr-1"></i>
                                                Edit</button>
                                            <a href="{{ route('project.delete', $project->id) }}"><button
                                                    class="btn btn-danger btn-sm w-100"><i class="zmdi zmdi-delete"></i>
                                                    Delete</button></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="background-color: #f0f0f0;" class="hiddenRow">
                                            <div class="accordion-body collapse" id="demo1{{ $project->id }}">
                                                <table class="admin-datatable table table-hover mt-5 shadow"
                                                    id="table1" style="width: 100%; background:white">
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

                                                                    <span>
                                                                        @if ($employee)
                                                                            {{ $employee->first_name . ' ' . $employee->last_name ?? null }}
                                                                        @else
                                                                            Not Assign to developer
                                                                        @endif
                                                                    </span>



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
                                                                            class="zmdi zmdi-edit mr-1"></i>edit</a>
                                                                    <a class="btn btn-secondary btn-sm w-100"
                                                                        href="{{ route('task_view', $projectTask->id) }}"><i
                                                                            class="zmdi zmdi-eye mr-1"></i>view</a>

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

                                    <div class="modal fade" id="exampleModal{{ $project->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom">
                                                    <h5 class="modal-title" style="font-weight:bold;"
                                                        id="exampleModalLabel">Edit Project</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('project.update') }}" method="post">
                                                        @csrf
                                                        <div class="row clearfix">
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="project_id"
                                                                    value="{{ $project->id }}">
                                                                <input type="hidden" class="main_lead" name="lead_id"
                                                                    value="">
                                                                <input type="hidden" class="main_project"
                                                                    name="project_type" value="">
                                                                <input type="hidden" class="main_status" name="status"
                                                                    value="">
                                                                <input type="hidden" class="main_service" name="service"
                                                                    value="">
                                                                <div class="form-group">
                                                                    <label>Team Lead<span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="lead_id" id=""
                                                                        class="form-control form-control-sm lead">
                                                                        <option disabled selected>-- Select Team Lead --
                                                                        </option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}"
                                                                                {{ $project->lead_id == $user->id ? 'selected' : null }}>
                                                                                {{ $user->employee->first_name . ' ' . $user->employee->last_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('lead_id')
                                                                        <label
                                                                            class="error">{{ $errors->first('lead_id') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project Name<span
                                                                            class="text-danger">*</span></label>
                                                                    <input required id="title" type="text"
                                                                        name="title"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $project->title }}">
                                                                    @error('title')
                                                                        <label
                                                                            class="error">{{ $errors->first('title') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project Type</label><br>
                                                                    <select required name="project_type" id=""
                                                                        class="form-control form-control-sm project">

                                                                        <option value="fixed rate" class="border-bottom"
                                                                            {{ $project->project_type == 'hourly rate' ? 'selected' : '' }}>
                                                                            Fixed Rate</option>
                                                                        <option value="hourly rate"
                                                                            {{ $project->project_type == 'fixed rate' ? 'selected' : '' }}>
                                                                            Hourly Rate</option>

                                                                    </select>

                                                                    <br>
                                                                    @error('project_type')
                                                                        <label
                                                                            class="error">{{ $errors->first('project_type') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Status<span class="text-danger">*</span></label>
                                                                    <select required id="" name="status"
                                                                        class="form-control form-control-sm status">

                                                                        <option value="pending"
                                                                            {{ $project->status == 'pending' ? 'selected' : '' }}>
                                                                            Pending</option>
                                                                        <option value="process"
                                                                            {{ $project->status == 'process' ? 'selected' : '' }}>
                                                                            Process</option>
                                                                        <option value="completed"
                                                                            {{ $project->status == 'completed' ? 'selected' : '' }}>
                                                                            Completed</option>
                                                                        <option value="terminated"
                                                                            {{ $project->status == 'terminated' ? 'selected' : '' }}>
                                                                            Terminated</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <label
                                                                            class="error">{{ $errors->first('status') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Start Date<span
                                                                            class="text-danger">*</span></label>
                                                                    <input required id="start" type="date"
                                                                        name="start_date"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    @error('start_date')
                                                                        <label
                                                                            class="error">{{ $errors->first('start_date') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>End Date</label>
                                                                    <input required id="end" type="date"
                                                                        name="end_date"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $project->end_date }}">
                                                                    @error('end_date')
                                                                        <label
                                                                            class="error">{{ $errors->first('end_date') }}</label>
                                                                    @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Technology</label>
                                                                    <input required id="tech" type="text"
                                                                        name="technology"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $project->technology }}">
                                                                    @error('technology')
                                                                        <label
                                                                            class="error">{{ $errors->first('technology') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Website</label>
                                                                    <input required id="web" type="text"
                                                                        name="website"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $project->website }}">
                                                                    @error('website')
                                                                        <label
                                                                            class="error">{{ $errors->first('website') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Service<span
                                                                            class="text-danger">*</span></label>
                                                                    <select required id="" name="service"
                                                                        class="form-control form-control-sm service">
                                                                        <option value="Web Designing"
                                                                            {{ $project->service == 'Web Designing' ? 'selected' : '' }}>
                                                                            Web Designing</option>

                                                                        <option value="Web Development"
                                                                            {{ $project->service == 'Web Development' ? 'selected' : '' }}>
                                                                            Web Development</option>

                                                                        <option value="Hybrid Mobile App Development"
                                                                            {{ $project->service == 'Hybrid Mobile App Development' ? 'selected' : '' }}>
                                                                            Hybrid Mobile App Development</option>

                                                                        <option value="Native Mobile App Development"
                                                                            {{ $project->service == 'Native Mobile App Development' ? 'selected' : '' }}>
                                                                            Native Mobile App Development</option>

                                                                        <option value="CMS Development"
                                                                            {{ $project->service == 'CMS Development' ? 'selected' : '' }}>
                                                                            CMS Development</option>

                                                                        <option value="SEO"
                                                                            {{ $project->service == 'SEO' ? 'selected' : '' }}>
                                                                            SEO</option>

                                                                        <option value="Social Media Marketing"
                                                                            {{ $project->service == 'Social Media Marketing' ? 'selected' : '' }}>
                                                                            Social Media Marketing</option>

                                                                        <option value="Content Writing"
                                                                            {{ $project->service == 'Content Writing' ? 'selected' : '' }}>
                                                                            Content Writing</option>

                                                                        <option value="Business development"
                                                                            {{ $project->service == 'Business development' ? 'selected' : '' }}>
                                                                            Business development</option>

                                                                        <option value="Graphics Design and Branding"
                                                                            {{ $project->service == 'Graphics Design and Branding' ? 'selected' : '' }}>
                                                                            Graphic Design and Branding</option>
                                                                    </select>
                                                                    @error('service')
                                                                        <label
                                                                            class="error">{{ $errors->first('service') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Note</label>
                                                                    <textarea id="note" name="note" class="summernote">{{ $project->note }}</textarea>
                                                                    @error('note')
                                                                        <label
                                                                            class="error">{{ $errors->first('note') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="col-md-12">
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="submit"
                                                                        style=" border: 1px solid #FE8415" id="save-btn"
                                                                        class="mt-5 btn btn-lg">Save Changes</button>
                                                                </div>
                                                            </div>
                                                            <style>
                                                                #save-btn {
                                                                    width: 180px;
                                                                    height: 40px;
                                                                    font-size: 15px;
                                                                    background: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%) !important;
                                                                    color: black;
                                                                    font-weight: 900;
                                                                    border-radius: 10px;
                                                                }
                                                            </style>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<script>
    $(document).ready(function() {

        $('.lead').on('change', function() {
            var data = $(this).val();
            $('.main_lead').val(data);
        })

        $('.service').on('change', function() {
            var data = $(this).val();
            $('.main_service').val(data);
        })
        $('.status').on('change', function() {
            var data = $(this).val();
            $('.main_status').val(data);
        })
        $('.project').on('change', function() {
            var data = $(this).val();
            $('.main_project').val(data);
        })
        $(document).on('click', '.edit-btn', function() {
            project = $(this).val();


            $.ajax({
                type: "GET",
                url: "/project/" + project + "/edit",
                success: function(response) {

                    console.log(response)
                    $('#title').val(response.project.title)
                    $('#start').val(response.project.start_date)
                    $('#end').val(response.project.end_date)
                    $('#tech').val(response.project.technology)
                    $('#web').val(response.project.website)
                    $('.radio').val(response.project.project_type)
                    $('#service').val(response.project.service)
                    $('#status').val(response.project.status)
                    $('#client').val(response.project.client_id)
                    $('#note').val(response.project.note)



                }
            })
        })
    })
</script>

@section('page-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/plupload.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.min.js') }}"></script>
@stop
@push('after-scripts')
    <script>
        $('#ssi-upload').ssi_uploader({
            allowed: ['png', 'jpg', 'jpeg', 'pdf', 'txt', 'doc', 'docx', 'xls', 'csv', 'xlsx', 'pptx'],
            errorHandler: {
                method: function(msg, type) {
                    ssi_modal.notify(type, {
                        content: msg
                    });
                },
                success: 'success',
                error: 'error'
            },
            maxFileSize: 122 //mb
        });
    </script>
    <script>
        function toggleColor(element) {
            element.classList.toggle("red");
        }
    </script>
    <script>
        document.getElementById("myIcon").addEventListener("click", changeIcon);

        function changeIcon() {
            document.getElementById("icon").src = "{{ asset('img/down.png') }}";
        }
    </script>
@endpush
