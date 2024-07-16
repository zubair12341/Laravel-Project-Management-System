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
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Update Task</h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('task-tracker') }}">All Task</a></li>
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false"></a>

                                </li>

                            </button>
                        </ul>
                    </div>
                </div>
                <div class="body">
                    <form action="{{ url('task-tracker/' . $task->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row clearfix">
                            @if (auth()->user()->role_id == '1')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assign To Employee</label>
                                        <select name="employee_id" class="form-control show-tick ms select2"
                                            data-placeholder="Select">
                                            <option></option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $task->employee_id == $employee->id ? 'selected' : null }}>
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
                            @if (auth()->user()->role_id == '3')
                                @php
                                    $user = DB::table('employees')
                                        ->where('id', auth()->user()->employee_id)
                                        ->first();
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assign To Employee</label>
                                        <select name="employee_id" class="form-control show-tick ms select2"
                                            data-placeholder="Select">
                                            <option></option>
                                            <option value="{{ $user->id }}"
                                                {{ $task->employee_id == $user->id ? 'selected' : null }}>
                                                {{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                                            </option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ $task->employee_id == $employee->id ? 'selected' : null }}>
                                                    {{ $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('employee_id')
                                            <label class="error">{{ $errors->first('employee_id') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">

                                    <button type="submit" class="mt-5 btn btn-primary">Save Changes</button>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Project Title</label>
                                        <select name="project_id" class="form-control show-tick ms select2"
                                            data-placeholder="Select">
                                            <option></option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    {{ $task->project_id == $project->id ? 'selected' : null }}>
                                                    {{ $project->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_id')
                                            <label class="error">{{ $errors->first('project_id') }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Priority</label>
                                        <select name="priority" class="form-control">
                                            <option value="normal" {{ $task->priority == 'normal' ? 'selected' : null }}>
                                                Normal</option>
                                            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : null }}>
                                                Medium</option>
                                            <option value="high" {{ $task->priority == 'high' ? 'selected' : null }}>High
                                            </option>
                                        </select>
                                        @error('priority')
                                            <label class="error">{{ $errors->first('priority') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Progress</label>
                                        <select name="progress" class="form-control">
                                            <option value="10" {{ $task->progress == '10' ? 'selected' : null }}>10%
                                            </option>
                                            <option value="20" {{ $task->progress == '20' ? 'selected' : null }}>20%
                                            </option>
                                            <option value="30" {{ $task->progress == '30' ? 'selected' : null }}>30%
                                            </option>
                                            <option value="40" {{ $task->progress == '40' ? 'selected' : null }}>40%
                                            </option>
                                            <option value="50" {{ $task->progress == '50' ? 'selected' : null }}>50%
                                            </option>
                                            <option value="60" {{ $task->progress == '60' ? 'selected' : null }}>60%
                                            </option>
                                            <option value="70" {{ $task->progress == '70' ? 'selected' : null }}>70%
                                            </option>
                                            <option value="80" {{ $task->progress == '80' ? 'selected' : null }}>80%
                                            </option>
                                            <option value="90" {{ $task->progress == '90' ? 'selected' : null }}>90%
                                            </option>
                                            <option value="100" {{ $task->progress == '100' ? 'selected' : null }}>100%
                                            </option>
                                        </select>
                                        @error('progress')
                                            <label class="error">{{ $errors->first('priority') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Assign Date</label>
                                        <input type="date" name="assign_date" class="form-control form-control-sm"
                                            value="{{ $task->assign_date }}">
                                        @error('assign_date')
                                            <label class="error">{{ $errors->first('assign_date') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Deadline Date</label>
                                        <input type="date" name="deadline_date" class="form-control form-control-sm"
                                            value="{{ $task->deadline_date }}">
                                        @error('deadline_date')
                                            <label class="error">{{ $errors->first('deadline_date') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control form-control-sm">
                                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : null }}>
                                                Pending</option>
                                            <option value="in progress"
                                                {{ $task->status == 'in progress' ? 'selected' : null }}>In Progress
                                            </option>
                                            <option value="ongoing" {{ $task->status == 'ongoing' ? 'selected' : null }}>
                                                Ongoing</option>
                                            <option value="completed"
                                                {{ $task->status == 'completed' ? 'selected' : null }}>Complete</option>
                                        </select>
                                        @error('status')
                                            <label class="error">{{ $errors->first('status') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea name="note" class="summernote">{{ $task->note }}</textarea>
                                        @error('note')
                                            <label class="error">{{ $errors->first('note') }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>File Attachment</label>
                                        <input type="file" name="attachment" multiple id="fileuploader"
                                            accept=".docx, .doc, .pdf, .csv, .png, .jpeg, .jpg, .pptx, .xls, .xlsx" />
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Documents</label>
                                    @if (!$task_attachment->isEmpty())
                                        @foreach ($task_attachment as $ta)
                                            <p class="display:flex;">
                                                <i class="fas fa-eye" aria-hidden="true"></i>&nbsp;<a target="blank"
                                                    href="{{ $ta->attachment }}">{{ $ta->attachment }}</a> <a
                                                    href="javascript:void(0);" class="delete-doc remove"
                                                    data-id="{{ url('task-doc-delete/' . $ta->id) }}"><i
                                                        data-toggle="tooltip" title="Delete"
                                                        class="far fa-trash text-danger"></i></a>
                                            </p>
                                        @endforeach
                                    @else
                                        <small class="text-muted"><br><i>--No uploaded files--</i></small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <button type="submit" class="mt-5 btn btn-primary">Save Changes</button>
                        </div>
                        @endif

                    </form>
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
@stop

@push('after-scripts')
    <script>
        $('#fileuploader').fileuploader({
            addMore: true
        });

        $(".delete-doc").click('.remove', function() {
            var dataId = $(this).attr("data-id");
            var del = this;
            if (confirm("Do you want to delete this attachment?")) {
                $.ajax({
                    url: dataId,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        $(del).closest("p").remove();
                        alert(response.message);
                    }
                });
            }

        });
    </script>
@endpush
