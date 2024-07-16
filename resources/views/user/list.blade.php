@extends('layouts.master')
@section('title', 'Users')
@section('page-style')

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

        #month {
            height: 40px;
            padding: 8px;
            min-width: 360px !important;
            background: rgba(0, 0, 0, 0);
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Users</h1>
                            </div>
                        </div>




                        <div class="container-fluid">
                            <div id="btn-row" class="row d-flex justify-content-center">
                                <div class="col-md-2 w-100">
                                    <a href="{{ url('user/create') }}"><button id="btn" style="width: 100%"
                                            class="btn ">Add User</button></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('employee') }}"><button id="btn" style="width: 100%"
                                            class="btn ">All Employees</button></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('employee/create') }}"><button id="btn" style="width: 100%"
                                            class="btn ">Add Employee</button></a>

                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('department.create') }}"><button id="btn" style="width: 100%"
                                            class="btn">Departments</button></a>

                                </div>
                                <div class="col-md-2">
                                    <a href="{{ url('task-tracker') }}"><button id="btn" style="width: 100%"
                                            class="btn">All Task</button></a>

                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
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
                <div class="body shadow-lg" id="body">
                    <div class="table-responsive">
                        <table id="user_datatable" class="user-datatable table table-hover shadow-sm"
                            style="width:100%;background:white;">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="background: white;color:#1D262D;">Employee Id</th>
                                    <th class="text-center" style="background: white;color:#1D262D;">Employee Name</th>
                                    <th class="text-center" style="background: white;color:#1D262D;">Email</th>
                                    <th class="text-center" style="background: white;color:#1D262D;">Role</th>
                                    <th class="text-center" style="background: white;color:#1D262D;">Status</th>
                                    <th class="text-center" style="background: white;color:#1D262D;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $c = 000000;
                                @endphp
                                @foreach ($admin as $user)
                                    @php
                                        $c++;
                                    @endphp
                                    <tr>
                                        <td class="text-center">

                                            EMP-00000{{ $c }}
                                        </td>
                                        <td class="text-center">
                                            Administrator</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            <select disabled id="roleId" name="role_id"
                                                style="background:#e5f4ff;border-radius:7px;"
                                                class="form-control form-control-sm show-tick ms ">
                                                <option selected style="display:none;color:blue;" value="Admin">Admin
                                                    <hr>
                                                </option>
                                            </select>

                                        </td>

                                        <td>
                                            <style>
                                                .toggle-switch label {
                                                    cursor: pointer;
                                                    text-indent: -9999px;
                                                    width: 50px;
                                                    height: 25px;
                                                    background: grey;
                                                    display: block;
                                                    border-radius: 100px;
                                                    position: relative;

                                                }

                                                .toggle-switch label:after {
                                                    content: '';
                                                    position: absolute;
                                                    top: 3px;
                                                    left: 3px;
                                                    width: 20px;
                                                    height: 20px;
                                                    background: #fff;
                                                    border-radius: 90px;
                                                    transition: 0.3s;
                                                }

                                                .toggle-switch input:checked+label {
                                                    background: #bada55;
                                                }

                                                .toggle-switch input:checked+label:after {
                                                    left: calc(100% - 5px);
                                                    transform: translateX(-100%);
                                                }

                                                .toggle-switch label:active:after {
                                                    width: 130px;
                                                }
                                            </style>
                                            <div class="toggle-switch d-flex justify-content-center">

                                                <input data-id="{{ $user->id }}" disabled class="toggle-class"
                                                    type="checkbox" id="switch" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $user->status ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>

                                            @if ($user->id == auth()->user()->id)
                                                <i data-toggle="modal" data-target="#exampleModal{{ $user->id }}"
                                                    style="font-size:30px;color:#1D262D;" class="zmdi zmdi-edit"></i>
                                            @endif
                                            {{-- <a href="{{ url('user/' . $user->id) }}"
                                            onclick="event.preventDefault();
                                                document.getElementById('delete').submit();"><i
                                                style="font-size:30px;color:#1D262D;padding-left: 10px;"
                                                class="zmdi zmdi-delete"></i>
                                        </a>
                                        <form id="delete" action="{{ url('user/' . $user->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                        </form> --}}
                                        </td>
                                    </tr>
                                    <div class="modal fade " id="exampleModal{{ $user->id }}" tabindex="-1"
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
                                                    <form action="{{ url('user/' . $user->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="row clearfix">
                                                            {{-- <div class="col-md-6">
                                                                <h6 style="color: #676969;">Select Employee</h6>
                                                                <div class="form-group">
                                                                    <select name="employee_id"
                                                                        class="form-control show-tick ms select2"
                                                                        data-placeholder="Select">
                                                                        <option></option>
                                                                        @foreach ($employees as $employee)
                                                                            <option value="{{ $employee->id }}"
                                                                                {{ $user->employee_id == $employee->id ? 'selected' : null }}>
                                                                                {{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('employee_id')
                                                                        <label
                                                                            class="error">{{ $errors->first('employee_id') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-md-6">
                                                                <h6 style="color: #676969;">Role</h6>
                                                                <div class="form-group">
                                                                    <select name="role_id"
                                                                        class="form-control show-tick ms select2">
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}"
                                                                                {{ $user->role_id == $role->id ? 'selected' : null }}
                                                                                {{ $role->id == 1 ? 'disabled' : null }}>
                                                                                {{ $role->role_type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;">Login Email</h6>
                                                                <div class="form-group">
                                                                    <input type="email" name="email"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $user->email }}">
                                                                    @error('email')
                                                                        <label
                                                                            class="error">{{ $errors->first('email') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <h6 style="color: #676969;">Password</h6>
                                                                <div class="form-group">
                                                                    <input type="password" name="password"
                                                                        class="form-control form-control-sm"
                                                                        value="">
                                                                    @error('password')
                                                                        <label
                                                                            class="error">{{ $errors->first('password') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>



                                                            {{-- <div class="col-md-6">







                                                                <h6 style="color: #676969;" class="mt-2">Login Status
                                                                </h6>
                                                                <div class="form-group">
                                                                    <div class="radio inlineblock m-r-20">
                                                                        <input type="radio" name="status"
                                                                            id="Active" class="with-gap" checked
                                                                            value="1"
                                                                            {{ $user->status == 1 ? 'checked' : '' }}>
                                                                        <label for="Active">Active</label>
                                                                    </div>
                                                                    <div class="radio inlineblock">
                                                                        <input type="radio" name="status"
                                                                            id="Inactive" class="with-gap"
                                                                            value="0"
                                                                            {{ $user->status == 0 ? 'checked' : '' }}>
                                                                        <label for="Inactive">Inactive</label>
                                                                    </div>
                                                                    <br>
                                                                    @error('status')
                                                                        <label
                                                                            class="error">{{ $errors->first('status') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div> --}}

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
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">

                                            {{ $user->employee_no }}
                                        </td>
                                        <td class="text-center">
                                            {{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                                        </td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            <select data-id="{{ $user->id }}" id="roleId" name="role_id"
                                                style="background:#e5f4ff;border-radius:7px;"
                                                class="form-control form-control-sm show-tick ms ">
                                                @foreach ($roles as $role)
                                                    <option selected style="display:none;color:blue;"
                                                        value="{{ $user->role_type }}">{{ $user->role_type }}
                                                        <hr>
                                                    </option>
                                                    <option style="background:white;" value="{{ $role->id }}"
                                                        {{ $role->id == 1 ? 'disabled' : null }}>{{ $role->role_type }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </td>

                                        <td>
                                            <style>
                                                .toggle-switch label {
                                                    cursor: pointer;
                                                    text-indent: -9999px;
                                                    width: 50px;
                                                    height: 25px;
                                                    background: grey;
                                                    display: block;
                                                    border-radius: 100px;
                                                    position: relative;

                                                }

                                                .toggle-switch label:after {
                                                    content: '';
                                                    position: absolute;
                                                    top: 3px;
                                                    left: 3px;
                                                    width: 20px;
                                                    height: 20px;
                                                    background: #fff;
                                                    border-radius: 90px;
                                                    transition: 0.3s;
                                                }

                                                .toggle-switch input:checked+label {
                                                    background: #bada55;
                                                }

                                                .toggle-switch input:checked+label:after {
                                                    left: calc(100% - 5px);
                                                    transform: translateX(-100%);
                                                }

                                                .toggle-switch label:active:after {
                                                    width: 130px;
                                                }
                                            </style>
                                            <div class="toggle-switch d-flex justify-content-center">

                                                <input data-id="{{ $user->id }}" class="toggle-class"
                                                    type="checkbox" id="switch" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                    data-off="InActive" {{ $user->status ? 'checked' : '' }}>

                                            </div>
                                        </td>
                                        <td>


                                            <i data-toggle="modal" data-target="#exampleModal{{ $user->id }}"
                                                style="font-size:30px;color:#1D262D;" class="zmdi zmdi-edit"></i>
                                            <a href="{{ url('user/' . $user->id) }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();"><i
                                                    style="font-size:30px;color:#1D262D;padding-left: 10px;"
                                                    class="zmdi zmdi-delete"></i>
                                            </a>
                                            <form id="delete" action="{{ url('user/' . $user->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade " id="exampleModal{{ $user->id }}" tabindex="-1"
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
                                                    <form action="{{ url('user/' . $user->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="row clearfix">
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;">Select Employee</h6>
                                                                <div class="form-group">
                                                                    <select name="employee_id"
                                                                        class="form-control show-tick ms select2"
                                                                        data-placeholder="Select">
                                                                        <option></option>
                                                                        @foreach ($employees as $employee)
                                                                            <option value="{{ $employee->id }}"
                                                                                {{ $user->employee_id == $employee->id ? 'selected' : null }}>
                                                                                {{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('employee_id')
                                                                        <label
                                                                            class="error">{{ $errors->first('employee_id') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;">Role</h6>
                                                                <div class="form-group">
                                                                    <select name="role_id"
                                                                        class="form-control show-tick ms select2">
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}"
                                                                                {{ $user->role_id == $role->id ? 'selected' : null }}
                                                                                {{ $role->id == 1 ? 'disabled' : null }}>
                                                                                {{ $role->role_type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;">Login Email</h6>
                                                                <div class="form-group">
                                                                    <input type="email" name="email"
                                                                        class="form-control form-control-sm"
                                                                        value="{{ $user->email }}">
                                                                    @error('email')
                                                                        <label
                                                                            class="error">{{ $errors->first('email') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <h6 style="color: #676969;">Password</h6>
                                                                <div class="form-group">
                                                                    <input type="password" name="password"
                                                                        class="form-control form-control-sm"
                                                                        value="">
                                                                    @error('password')
                                                                        <label
                                                                            class="error">{{ $errors->first('password') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            @php
                                                                $user_p = DB::table('manage_permissions')
                                                                    ->where('user_id', $user->id)
                                                                    ->first();
                                                            @endphp
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;" class="mt-2">Permission
                                                                </h6>
                                                                <div class="form-group">
                                                                    <div class=" inlineblock m-r-20">
                                                                        <input type="radio" name="permission"
                                                                            id="no_access"
                                                                            {{ $user_p->domain_show_edit == 'No' && $user_p->domain_show == 'No' ? 'checked' : '' }}
                                                                            value="0">
                                                                        <label for="no_access">No Access</label>
                                                                    </div>
                                                                    <div class=" inlineblock">
                                                                        <input type="radio" name="permission"
                                                                            id="access"
                                                                            {{ $user_p->domain_show == 'Yes' ? 'checked' : '' }}
                                                                            value="1">
                                                                        <label for="access"> Only Domain View</label>
                                                                    </div>
                                                                    <div class=" inlineblock">
                                                                        <input type="radio"
                                                                            {{ $user_p->domain_show_edit == 'Yes' ? 'checked' : '' }}
                                                                            name="permission" id="accessall"
                                                                            value="2">
                                                                        <label for="accessall"> Domain View, Create and
                                                                            Edit</label>
                                                                    </div>
                                                                    <br>

                                                                    @error('permission')
                                                                        <label
                                                                            class="error">{{ $errors->first('permission') }}</label>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 style="color: #676969;" class="mt-2">Login Status
                                                                </h6>
                                                                <div class="form-group">
                                                                    <div class=" inlineblock m-r-20">
                                                                        <input type="radio" name="status"
                                                                            id="Active" class="with-gap" checked
                                                                            value="1"
                                                                            {{ $user->status == 1 ? 'checked' : '' }}>
                                                                        <label for="Active">Active</label>
                                                                    </div>
                                                                    <div class=" inlineblock">
                                                                        <input type="radio" name="status"
                                                                            id="Inactive" class="with-gap"
                                                                            value="0"
                                                                            {{ $user->status == 0 ? 'checked' : '' }}>
                                                                        <label for="Inactive">Inactive</label>
                                                                    </div>
                                                                    <br>
                                                                    @error('status')
                                                                        <label
                                                                            class="error">{{ $errors->first('status') }}</label>
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
            </div>
        </div>
    </div>

@stop
@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


@stop
@push('after-scripts')
    <script>
        $('.toggle-class').change(function() {

            var status = $(this).prop('checked') == true ? 1 : 0;
            var userid = $(this).data('id');
            //alert(userid);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                    'status': status,
                    'userid': userid
                },
                success: function(data) {
                    console.log(userid);
                    alert(data.message);
                }
            });
        });

        $('#roleId').on('change', function() {
            var roleId = $(this).val();
            var userId = $(this).data('id');
            $.ajax({
                url: '/updateRole',
                type: 'GET',
                data: {
                    'roleId': roleId,
                    'userId': userId
                },
                success: function(data) {
                    console.log('Success');
                    alert(data.message);
                    $('#roleId').html(options); // update the dropdown list with the new options
                }

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
