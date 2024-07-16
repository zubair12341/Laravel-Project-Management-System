@extends('layouts.master')
@section('title', 'Edit User')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}" />
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}" />

<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}" />

@stop
@section('content')

@include('layouts.alert_message')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
            <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                <div class="header">
                    <div class="d-flex justify-content-center">
                        <div id="margin" class="max-w-50 ">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Add Project</h1>
                        </div>
                    </div>
                    <ul class="header-dropdown mt-5">

                        <button id="btn" type="button" class="btn btn-primary" style="padding: inherit;margin-top: 140px;">
                            <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;" href="{{url('user')}}">All Users</a></li>
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <!--<ul class="dropdown-menu dropdown-menu-right">-->
                                <!--    <li><a href="{{url('employee')}}">All Employee</a></li>-->
                                <!--</ul>-->
                            </li>
                            <!--<li class="remove">-->
                            <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                            <!--</li>-->
                        </button>
                    </ul>
                </div>
            </div>
            <div class="body" id="body">
                <form action="{{url('user/'.$user->id)}}" method="post">
                    @method('put')
                    @csrf
                    <div class="row clearfix">

                        <div class="col-md-6">
                            <label>Select Employee</label>
                            <div class="form-group">
                                <select name="employee_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                    <option></option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" {{$user->employee_id == $employee->id ? 'selected':null}}>{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <label class="error">{{$errors->first('employee_id')}}</label>
                                @enderror
                            </div>

                            <label>Login Email</label>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-sm" value="{{$user->email}}">
                                @error('email')
                                <label class="error">{{$errors->first('email')}}</label>
                                @enderror
                            </div>

                            {{-- <label>Password</label>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-sm" value="{{$user->password}}">
                            @error('password')
                            <label class="error">{{$errors->first('password')}}</label>
                            @enderror
                        </div> --}}

                        <label>Role</label>
                        <div class="form-group">
                            <select name="role_id" class="form-control form-control-sm show-tick">
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : null}} {{$role->id == 1 ? 'disabled' : null}}>{{$role->role_type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="mt-2">Login Status</label>
                        <div class="form-group">
                            <div class="radio inlineblock m-r-20">
                                <input type="radio" name="status" id="Active" class="with-gap" checked value="1" {{$user->status == 1 ? 'checked' : ''}}>
                                <label for="Active">Active</label>
                            </div>
                            <div class="radio inlineblock">
                                <input type="radio" name="status" id="Inactive" class="with-gap" value="0" {{$user->status == 0 ? 'checked' : ''}}>
                                <label for="Inactive">Inactive</label>
                            </div>
                            <br>
                            @error('status')
                            <label class="error">{{$errors->first('status')}}</label>
                            @enderror
                        </div>
                    </div>

            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
</div>

@stop

@push('after-scripts')

@endpush

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>

<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
@stop