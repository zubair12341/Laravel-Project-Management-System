@extends('layouts.master')

@section('title', 'All Employees')

@section('page-style')

    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}" /> --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
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

        #emp-card #emp-body {
            background: #f0f0f0;
        }

        .nav-link {
            color: #67696B;
            font-weight: bold;
        }

        .nav-link.active {
            border-bottom: 2px solid blue;
        }
    </style>

    <div class="row clearfix">
        <div class="col-lg-12">

            <div class="card" id="emp-card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Employees</h1>
                            </div>
                        </div>




                        <div class="container-fluid ">
                            <div id="btn-row" class="row d-flex justify-content-center">
                                <div class="col-md-2 w-100">
                                    <a href="{{ route('emp.link-generate') }}"><button id="btn" style="width: 100%"
                                            class="btn ">Generate Link</button></a>
                                </div>
                                <div class="col-md-2 w-100">
                                    <a href="{{ route('employee.create') }}"><button id="btn" style="width: 100%"
                                            class="btn ">Add Employee</button></a>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route('department.create') }}"><button id="btn" style="width: 100%"
                                            class="btn">Departments</button></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('task-tracker') }}"> <button id="btn" style="width: 100%"
                                            class="btn ">All Task</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <div class="w-50 ">
                                <div class="form-group mb-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent border-0">
                                                <img src="{{ asset('img/sidebar/2.png') }}" width="25" height="25">
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0 bg-transparent table-search"
                                            placeholder="Search....">
                                    </div>
                                    <hr class="border-secondary my-2">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="body shadow-lg" id="emp-body">
                    <ul class="nav mb-1">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#allemployees">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#permanent">Permanent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#probation">Probation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#internee">Internee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#terminated">Terminated</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#xemployees">X Employee</a>
                        </li>
                    </ul>
                    <hr style="margin-top:-4px;">
                    <div class="tab-content">
                        <div id="allemployees" class="tab-pane fade show active">

                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-lg"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee Name
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>

                                                    {{ $designation ? $designation->title : 'N/A' }}

                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id" value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>Terminated
                                                            </option>


                                                        </select>

                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>
                                                    <br>
                                                    @if ($employee->is_user == 'false')
                                                        <button data-toggle="modal" data-target="#exampleModal{{ $employee->id }}"
                                                                class="btn btn-secondary btn-sm w-100"><span><i
                                                                        class="fas fa-check-square mr-1"></i>
                                                                </span> Approved</button>
                                                    @endif
                                                </td>
                                            </tr>

                                            <div class="modal fade " id="exampleModal{{ $employee->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom">
                                                            <h5 class="modal-title " style="font-weight:bold;"
                                                                id="addModalLabel">Edit User</h5>
        
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('emp.user-create')}}" method="post">
                                                                @csrf
                                                                <div class="row clearfix">
                                                                   <input type="hidden" value="{{$employee->id}}" name="emp_id">
                                                                    <div class="col-md-6">
                                                                        <h6 style="color: #676969;">Role</h6>
                                                                        <div class="form-group">
                                                                            <select name="role_id"
                                                                                class="form-control show-tick ms select2">
                                                                                @foreach ($roles as $role)
                                                                                    <option value="{{ $role->id }}"
                                                                                        {{ $role->id == 1 ? 'disabled' : null }}>
                                                                                        {{ $role->role_type }}</option>
                                                                                @endforeach
                                                                            </select>
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
                                                                            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
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
                        <div id="permanent" class="tab-pane fade ">
                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-sm"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee
                                                Name</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($permanentEmployees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>

                                                    {{ $designation ? $designation->title : 'N/A' }}

                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>
                                                                X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>
                                                                Terminated
                                                            </option>


                                                        </select>
                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="probation" class="tab-pane fade ">
                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-lg"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee
                                                Name</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($probationEmployees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>
                                                    {{ $designation ? $designation->title : 'N/A' }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>
                                                                Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>
                                                                X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>
                                                                Terminated
                                                            </option>


                                                        </select>
                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="internee" class="tab-pane fade ">
                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-lg"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee
                                                Name</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($interneeEmployees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>

                                                    {{ $designation ? $designation->title : 'N/A' }}

                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>
                                                                Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>
                                                                X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>
                                                                Terminated
                                                            </option>


                                                        </select>
                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="terminated" class="tab-pane fade ">
                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-lg"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee
                                                Name</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($terminatedEmployees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>

                                                    {{ $designation ? $designation->title : 'N/A' }}

                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>
                                                                Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>
                                                                X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>
                                                                Terminated
                                                            </option>


                                                        </select>
                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="xemployees" class="tab-pane fade ">
                            <div class="table-responsive">

                                <table class="admin-datatable table table-hover shadow-lg"
                                    style="width: 100%;background:white;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee No
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Employee
                                                Name</th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Designation
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Status
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Job Type
                                            </th>
                                            <th class="text-center" style="border-right: none;color:#1D262D;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($xEmployees as $employee)
                                            <?php
                                            $designation = DB::table('employees')
                                                ->join('designations', 'designations.id', '=', 'employees.designation_id')
                                                ->select('employees.id', 'designations.title')
                                                ->where('employees.id', '=', $employee->id)
                                                ->first();
                                            ?>
                                            <tr>
                                                <td>
                                                    {{ $employee->employee_no }}
                                                </td>
                                                <td>{{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </td>
                                                <td>

                                                    {{ $designation ? $designation->title : 'N/A' }}

                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select style="border-radius:7px;background:#f0f0f0;"
                                                            name="job_status" id="job-status"
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2">
                                                            <option style="display: none;"
                                                                value="{{ $employee->job_status }}" selected>
                                                                {{ $employee->job_status }}</option>
                                                            <option style="background: #E5F4FF;" value="Full Time"
                                                                {{ old('job_status') == 'Full Time' ? 'selected' : null }}>
                                                                Full
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Part Time"
                                                                {{ old('job_status') == 'Part Time' ? 'selected' : null }}>
                                                                Part
                                                                Time</option>
                                                            <option style="background: #E5F4FF;" value="Remote"
                                                                {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                                                Remote
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Internship"
                                                                {{ old('job_status') == 'Internship' ? 'selected' : null }}>
                                                                Internship</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('emp_status_update') }}" id="status_form2"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="emp_id"
                                                            value="{{ $employee->id }}">
                                                        <select name="status" id="select"
                                                            @if ($employee->employee_status == 'Probation') style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($employee->employee_status == 'Permanent') style="border-radius:7px;background:#39C38D;color:white;" @elseif($employee->employee_status == 'Internee') style="border-radius:7px;background:#FCAB10;color:white;" @elseif($employee->employee_status == 'Terminated') style="border-radius:7px;background:#BCBEC0;color:white;" @elseif($employee->employee_status == 'X-Employee') style="border-radius:7px;background:#BCBEC0;color:white;" @endif
                                                            class="form-control-sm show-tick ms select2 emp_status_upd2"
                                                            data-placeholder="Select" onchange="updateSelectStyle(this)">
                                                            <option style="display:none;"
                                                                value="{{ $employee->employee_status }}" selected
                                                                onchange="updateSelectStyle(this)">
                                                                {{ $employee->employee_status }}
                                                            </option>
                                                            <option value="Internee"
                                                                @if ($employee->employee_status == 'Internee') selected @endif>Internee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Probation"
                                                                @if ($employee->employee_status == 'Probation') selected @endif>
                                                                Probation
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="X-Employee"
                                                                @if ($employee->employee_status == 'X-Employee') selected @endif>
                                                                X-Employee
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Permanent"
                                                                @if ($employee->employee_status == 'Permanent') selected @endif>
                                                                Permanent
                                                            </option>
                                                            <option style="background: #E5F4FF;" value="Terminated"
                                                                @if ($employee->employee_status == 'Terminated') selected @endif>
                                                                Terminated
                                                            </option>


                                                        </select>
                                                    </form>
                                                <td>
                                                    <a href="{{ url('employee/' . $employee->id) }}"><button
                                                            class="btn btn-primary btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-eye mr-1"></i></span>
                                                            View</button></a>
                                                    <br>
                                                    <a href="{{ url('employee/' . $employee->id . '/edit') }}"><button
                                                            class="btn btn-success btn-sm w-100"><span><i
                                                                    class="zmdi zmdi-edit mr-1"></i>
                                                            </span> Edit</button></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function updateSelectStyle(select) {
            var selectedValue = select.value;

            switch (selectedValue) {
                case "Permanent":
                    select.style.backgroundColor = "#39C38D";
                    select.style.color = "white";
                    break;
                case "Internee":
                    select.style.backgroundColor = "#FCAB10";
                    select.style.color = "white";
                    break;
                case "X-Employee":
                    select.style.backgroundColor = "#BCBEC0";
                    select.style.color = "white";
                    break;
                case "Probation":
                    select.style.backgroundColor = "#2B9EB3";
                    select.style.color = "white";
                    break;
                case "Terminated":
                    select.style.backgroundColor = "#BCBEC0";
                    select.style.color = "white";
                    break;

            }
        }
    </script>

@stop
@section('page-script')
    {{-- <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    {{-- <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script> --}}
@stop
@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('.emp_status_upd').change(function() {
                $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $('.emp_status_upd2').change(function() {
                $(this).closest('form').submit();
            });


        });

        $(document).ready(function() {
            var table = $('.table').DataTable();

            $('.table-search').on('input', function() {
                var value = $(this).val();
                table.search(value).draw();
            });
        });
    </script>
@endpush
