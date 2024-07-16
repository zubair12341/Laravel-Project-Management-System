@extends('layouts.master')
@section('title', 'Task Tracker')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
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
            <div class="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Add Task</h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            {{-- <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('task-tracker') }}">All Task</a></li>
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false"></a>

                                </li>

                            </button> --}}
                        </ul>
                    </div>
                </div>
                <div class="body">
                    <form id="form_validation" action="{{ url('task-tracker') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                       
                            @if(auth()->user()->role_id=='4')
                            @else
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Assign To Employee</label>
                                    <select name="employee_id" required class="form-control show-tick ms select2"
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
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" value="{{ $newTaskNo }}" name="newtaskno">
                                    <label>Project Title</label>
                                    <select name="project_id" required class="form-control show-tick ms select2"
                                        data-placeholder="Select">
                                        <option></option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ old('project_id') == $project->id ? 'selected' : null }}>
                                                {{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <label class="error">{{ $errors->first('project_id') }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                           
                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                   
                                    <select required name="status" class="form-control ms">
                                        <option value="pending">Pending</option>

                                        <option value="in progress">In Progress
                                        </option>
                                        <option value="ongoing">Ongoing</option>
                                    </select>
                                    @error('status')
                                        <label class="error">{{ $errors->first('status') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-form">Priority</label>
                                    <select required name="priority" class="form-control ms" placeholder="Select">
                                        <option value="normal" id="one">Normal</option>
                                        <option value="medium" id="two">Medium</option>
                                        <option value="high" id="three">High</option>
                                    </select>
                                    @error('priority')
                                        <label class="error">{{ $errors->first('priority') }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Assign Date</label>
                                    <input type="date" required name="assign_date" class="form-control form-control-sm"
                                        value="{{ date('Y-m-d') }}">
                                    @error('assign_date')
                                        <label class="error">{{ $errors->first('assign_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deadline Date</label>
                                    <input type="date" required name="deadline_date"
                                        class="form-control form-control-sm" value="{{ old('deadline_date') }}">
                                    @error('deadline_date')
                                        <label class="error">{{ $errors->first('deadline_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6  col order-last">
                                <div class="form-group">
                                    <label>File Attachment</label>
                                    <input type="file" name="attachment" multiple id="fileuploader" />
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea name="note" class="summernote">{{ old('note') }}</textarea>
                                    @error('note')
                                        <label class="error">{{ $errors->first('note') }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

                <style>
                    #save-btn {
                        width: 180px;
                        height: 40px;
                        font-size: 15px;
                    }
                </style>
            </div>
        </div>
    </div>
    </div>

@stop


@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>
@stop

@push('after-scripts')
    <script>
        // enable fileuploader plugin
        $('#fileuploader').fileuploader({
            addMore: true
        });
    </script>
@endpush
