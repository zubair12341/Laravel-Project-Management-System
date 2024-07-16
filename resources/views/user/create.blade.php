@extends('layouts.master')
@section('title', 'User')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
@stop
@section('content')

    @include('layouts.alert_message')
    <style>
        #background {
            width: 103%;
            margin-left: -13px;
        }

        #card #body {
            background: #f0f0f0;
        }

        #margin {
            margin-bottom: 7rem !important;
        }

        #btn {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;
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
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Add User</h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('user') }}">All Users</a></li>
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false"></a>
                                    <!--<ul class="dropdown-menu dropdown-menu-right">-->
                                    <!--    <li><a href="{{ url('employee') }}">All Employee</a></li>-->
                                    <!--</ul>-->
                                </li>
                                <!--<li class="remove">-->
                                <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                                <!--</li>-->
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    <p style="font-size: 20px;margin-top:-10px; color:gray;">Add User</p>
                    <hr style="margin-top:-15px;">
                    <form action="{{ url('user') }}" method="post">
                        @csrf
                        <div class="row clearfix shadow "
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Basic Information</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-6">
                                <label>Select Employee</label>
                                <div class="form-group">
                                    <select name="employee_id" class="form-control show-tick ms select2"
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : null }}>
                                                {{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <label class="error">{{ $errors->first('employee_id') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Role</label>
                                <div class="form-group">
                                    <select name="role_id" class="form-control show-tick ms">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == 1 ? 'disabled' : null }}>
                                                {{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Login Email </label>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control show-tick ms"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <label class="error">{{ $errors->first('email') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control show-tick ms"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <label class="error">{{ $errors->first('password') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 style="color: #676969;" class="mt-2">Permission
                                </h6>
                                <div class="form-group">
                                    <div class=" inlineblock m-r-20">
                                        <input type="radio" name="permission"
                                            id="no_access"  checked
                                            value="0"
                                          >
                                        <label for="no_access">No Access</label>
                                    </div>
                                    <div class=" inlineblock">
                                        <input type="radio" name="permission"
                                            id="access" 
                                            value="1"
                                            >
                                        <label for="access"> Only Domain View</label>
                                    </div>
                                    <div class=" inlineblock">
                                        <input type="radio" name="permission"
                                            id="accessall" 
                                            value="2"
                                            >
                                        <label for="accessall"> Domain View, Create and Edit</label>
                                    </div>
                                    <br>
                                    @error('permission')
                                        <label
                                            class="error">{{ $errors->first('status') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Login Status</label>
                                <div class="form-group">
                                    <div class="radio inlineblock m-r-20">
                                        <input type="radio" name="status" id="Active" class="with-gap" checked
                                            value="1" {{ old('status') == '1' ? 'checked' : null }}>
                                        <label for="Active">Active</label>
                                    </div>
                                    <div class="radio inlineblock">
                                        <input type="radio" name="status" id="Inactive" class="with-gap" value="0"
                                            {{ old('status') == '0' ? 'checked' : null }}>
                                        <label for="Inactive">Inactive</label>
                                    </div>
                                    <br>
                                    @error('status')
                                        <label class="error">{{ $errors->first('status') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary mb-5" id="save-btn">Add User</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                     
                            
                              <div class="col-md-6"
                         
                            </div> -->

                </div>





                </form>
            </div>
        </div>
        <style>
            .login1_1 {
                margin: auto;
            }

            #save-btn {
                width: 180px;
                height: 40px;
                font-size: 15px;
                background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
                color: black;
                font-weight: 900;
                border-radius: 10px;
                ;
            }
        </style>

    </div>

    </div>
    </div>
    </div>

@stop

@push('after-scripts')
@endpush

@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
@stop
