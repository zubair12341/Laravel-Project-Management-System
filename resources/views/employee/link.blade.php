@extends('layouts.master')
@section('title', 'Employee')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/font/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.css') }}">
@stop

@section('content')
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

        .fileuploader-input .fileuploader-input-button {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        }

        .fileuploader-input .fileuploader-input-caption {
            color: gray !important;
        }

        #select1 select option {
            border-bottom: 1px gray;
        }
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Generate Link </h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('employee') }}">All Employee</a></li>
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
                    <p style="font-size: 20px;margin-top:-10px; color:gray;">Generate Link</p>
                    <hr style="margin-top:-15px;">
                    <form action="{{ route('emp.link-generate.post') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix shadow "
                        style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                        <div class="col-md-12">
                            <h3 style="font-weight: bold;">Basic Information</h3>
                            <hr style="margin-top:-15px;">
                        </div>
                        <div class="col-md-6">

                            <label>Employee No</label>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="employee_no"
                                    value="{{ $newEmployeeNo }}" readonly>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <label> Email</label>
                            <div class="form-group">
                                <input type="email" name="other_email" required class="form-control form-control-sm"
                                    value="{{ old('other_email') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label> Salary</label>
                            <div class="form-group">
                                <input type="text" name="salary" required class="form-control form-control-sm"
                                    value="{{ old('salary') }}">
                            </div>
                        </div>
               
                    </div>



                        <div class="row clearfix mt-3 shadow"
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Job Info / Job Status</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-6">

                                <label>Job Status</label>
                                <div class="form-group">
                                    <select name="job_status" required id="job-status"
                                        class="form-control form-control-sm show-tick">

                                        <option value="Full Time"
                                            {{ old('job_status') == 'Full Time' ? 'selected' : null }}>Full Time</option>
                                        <option value="Part Time"
                                            {{ old('job_status') == 'Part Time' ? 'selected' : null }}>Part Time</option>
                                        <option value="Remote" {{ old('job_status') == 'Remote' ? 'selected' : null }}>
                                            Remote</option>
                                        <option value="Internship"
                                            {{ old('job_status') == 'Internship' ? 'selected' : null }}>Internship</option>
                                    </select>
                                    @error('job_status')
                                        <label class="error">{{ $errors->first('job_status') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Designations</label>
                                <div class="form-group">
                                    <select name="designation_id" required class="form-control form-control-sm show-tick "
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <label class="error">{{ $errors->first('employee_id') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                                <label>Supervisor</label>
                                <div class="form-group">
                                    <select name="employee_id"  class="form-control form-control-sm show-tick "
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : null }}>
                                                {{ $employee->employee->first_name . ' ' . $employee->employee->middle_name . ' ' . $employee->employee->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <label class="error">{{ $errors->first('employee_id') }}</label>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">

                                <label>Date Of Joining</label>
                                <div class="form-group">
                                    <input type="date" required name="joining_date" class="form-control"
                                        placeholder="dd/mm/yyyy" value="{{ old('joining_date') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="pp">
                                    <label>Probation Period Start</label>
                                    <div class="form-group ">
                                        <input type="date"  name="probation_period_start" class="form-control"
                                            placeholder="dd/mm/yyyy" value="{{ old('probation_period_start') }}">
                                    </div>
                                </div>
                                <div id="ip" style="display: none;">
                                    <label>Internship Period Start</label>
                                    <div class="form-group input-group masked-input">
                                        <input type="date" name="internship_period_start" class="form-control"
                                            placeholder="dd/mm/yyyy" value="{{ old('internship_period_start') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">


                                <div id="ppe">

                                    <label>Probation Period End</label>
                                    <div class="form-group ">
                                        <input type="date" name="probation_period_end" class="form-control"
                                            placeholder="dd/mm/yyyy" value="{{ old('probation_period_end') }}">
                                    </div>
                                </div>
                                <div id="ipe" style="display:none;">


                                    <label>Internship Period End</label>
                                    <div class="form-group">
                                        <input type="date" name="internship_period_end" class="form-control"
                                            placeholder="dd/mm/yyyy" value="{{ old('internship_period_end') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <label>Working Time Start</label>
                                <div class="form-group">
                                    <input type="time" required name="working_time_start" class="form-control"
                                        placeholder="Ex: 11:59 pm" value="{{ old('working_time_start') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Working Time End</label>
                                <div class="form-group">
                                    <input type="time" required name="working_time_end" class="form-control"
                                        placeholder="Ex: 11:59 pm" value="{{ old('working_time_end') }}">
                                </div>
                            </div>
                        </div>




                        <div class="container mt-2">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="save-btn">Generate Link</button>
                            </div>
                        </div>

                        <style>
                            #save-btn {
                                width: 180px;
                                height: 40px;
                                font-size: 15px;
                                background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
                            }
                        </style>

                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@stop


@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>

    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
@stop

@push('after-scripts')
    <script>
        $("#job-status").change(function() {
            var selectedValue = $(this).val();

            if (selectedValue == "Internship") {
                $('#ip').show();
                $('#ipe').show();
                $('#pp').hide();
                $('#ppe').hide();
            } else if (selectedValue == "Full Time") {
                $('#pp').show();
                $('#ipe').hide();
                $('#ip').hide();
                $('#ppe').show();
            } else {
                $('#pp').show();
                $('#ipe').hide();
                $('#ip').hide();
                $('#ppe').show();
            }

        });
    </script>

    <script>
        // enable fileuploader plugin
        $('#fileuploader').fileuploader({
            addMore: true
        });
    </script>
@endpush
