@extends('layouts.master')
@section('title', 'Task Tracker')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/font/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.css') }}">
    {{-- <link rel="stylesheet" href="node_modules/@pnotify/bootstrap4/dist/PNotifyBootstrap4.css" /> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/plugins/sticky_notification/sticky.css')}}"/> --}}
    {{-- <link href="dist/sticky.css" rel="stylesheet" type="text/css" /> --}}
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
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">View Task</h1>
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
                    <!-- Nav tabs -->


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <div style="margin-right:-20px;margin-left:-20px;">
                                        <table class="table">
                                            <tr style="background: #F2F4F6;border-bottom: 1px solid #dee2e6;">
                                                <td style="border-right: 1px solid #dee2e6;padding-left: 30px;">
                                                    <span class="text-muted"><i class="far fa-project-diagram"
                                                            style="font-size: 18px;"></i> Project</span><br>
                                                    {{ $task->project->title }}
                                                </td>
                                                <td style="border-right: 1px solid #dee2e6;padding-left: 30px;">
                                                    <span class="text-muted"><i class="far fa-calendar"
                                                            style="font-size: 18px;"></i> Deadline Date</span>
                                                    <br>
                                                    @if ($task->deadline_date)
                                                        {{ date('j F, Y', strtotime($task->deadline_date)) }}
                                                    @else
                                                        <small class="text-muted"><i>--Nil--</i></small>
                                                    @endif
                                                </td>
                                                <td style="border-right: 1px solid #dee2e6;padding-left: 30px;">
                                                    <span class="text-muted"><i class="far fa-badge-check"
                                                            style="font-size: 18px;"></i> Status</span><br>
                                                    <span id="header-status">{{ $task->status }}</span>
                                                </td>
                                                <td style="padding-left: 30px;">
                                                    <span class="text-muted">
                                                        <i class="far fa-badge-percent" style="font-size: 18px;"></i>
                                                        {{ $task->status }}(<span
                                                            id="progress-count">{{ $task->progress }}</span>%)
                                                    </span><br>
                                                    <div class="progress"
                                                        style="margin-top: 8px;background:#F7C600;border-radius:0;">
                                                        <div class="progress-bar l-green" role="progressbar"
                                                            aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: {{ $task->progress }}%;border-radius:0;"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Rachna-->

                            <!--Rachnn-->
                            <div class="row">

                                <div class="col-md-6 col-sm-12 mt-3">

                                    <div class="row">

                                    </div>
                                    <table class="table">

                                        <tr>
                                            <td><label class="text-muted">Task No </label></td>
                                            <td>
                                                <p>{{ $task->task_no }}</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label class="text-muted">Priority</label></td>
                                            <td>
                                                @if ($task->priority == 'normal')
                                                    <p class="badge badge-primary">{{ $task->priority }}</p>
                                                @elseif ($task->priority == 'medium')
                                                    <p class="badge badge-warning">{{ $task->priority }}</p>
                                                @elseif ($task->priority == 'high')
                                                    <p class="badge badge-danger">{{ $task->priority }}</p>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label class="text-muted">Deadline Date</label></td>
                                            <td>
                                                @if ($task->deadline_date)
                                                    <p>{{ date('j F, Y', strtotime($task->deadline_date)) }}</p>
                                                @else
                                                    <small class="text-muted"><i>--Nil--</i></small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="text-muted">Status</label></td>
                                            <td>
                                                @if ($task->status == 'pending')
                                                    <p class="badge badge-danger hide-badge p-2">{{ $task->status }}</p>
                                                @elseif ($task->status == 'ongoing')
                                                    <p class="badge badge-primary hide-badge">{{ $task->status }}</p>
                                                @elseif ($task->status == 'in progress')
                                                    <p class="badge badge-warning hide-badge">{{ $task->status }}</p>
                                                @elseif ($task->status == 'completed')
                                                    <p class="badge badge-success hide-badge">{{ $task->status }}</p>
                                                @endif
                                                <span id="task-status"></span>
                                            </td>
                                        </tr>




                                    </table>


                                </div>

                                <div class="col-md-6 col-sm-12 mt-3">
                                    <div style="display:flex;">


                                    </div>
                                    <div class="row">

                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td><label class="text-muted">Project Name</label></td>
                                            <td>
                                                <em>{{ $task->project->title }}</em>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label class="text-muted">Assign To:</label></td>
                                            <td>
                                                @if ($task->employee)
                                                    <p>{{ $task->employee->first_name . ' ' . $task->employee->middle_name . ' ' . $task->employee->last_name }}
                                                    </p>
                                                @else
                                                    <p class="badge badge-danger hide-badge">Not assign</p>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label class="text-muted">Assign Date</label></td>
                                            <td>
                                                <p>{{ $task->assign_date ? date('j F, Y', strtotime($task->assign_date)) : null }}
                                                </p>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td colspan="2" style="max-width: 300px;">
                                                <label class="text-muted">Note</label>
                                                <p style="word-wrap: break-word;">{!!$task->note!!}</p>
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td colspan="2">
                                                <label class="text-muted">Comments</label>
                                                <p></p>
                                            </td>
                                        </tr> --}}
                                    </table>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <tr>
                                        <td><label class="text-muted">Document</label></td>
                                        <td>
                                            <div class="form-group">
                                                @if (!$task_attachment->isEmpty())
                                                    @foreach ($task_attachment as $ta)
                                                        <p><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;<a
                                                                href="{{ $ta->attachment }}"
                                                                target="blank">{{ $ta->attachment }}</a>
                                                        </p>
                                                    @endforeach
                                                @else
                                                    <small class="text-muted"><br><i>--No uploaded files--</i></small>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 mt-3">
                                <form action="{{ route('task_comment') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <div class="form-group">
                                        <label class="text-muted"><strong>Add Comments</strong></label>
                                        <textarea name="comment" class="summernote">{{ old('comment') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-muted"><strong>File Attachment</strong></label>
                                        <input type="file" name="attachment" multiple id="fileuploader"
                                            accept=".docx, .doc, .pdf, .csv, .png, .jpeg, .jpg, .pptx, .xls, .xlsx" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <div class="comments-section">
                                        <h4 class="comment-heading">All Comments</h4>
                                        @if (isset($comments))
                                            @foreach ($comments as $comment)
                                                <div class="comment">
                                                    <div class="comment-details">
                                                        <div class="comment-author">
                                                            @if ($comment->employee &&$comment->employee->profile_image)
                                                                <img src="{{ $comment->employee->profile_image }}"
                                                                    alt="Profile Image" class="profile-image">
                                                            @else
                                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png"
                                                                    alt="Profile Image" class="profile-image">
                                                            @endif
                                                            {{ $comment->employee?$comment->employee->first_name:'Admin' }}
                                                            <div class="float-right">
                                                                {{ $comment->created_at->diffForHumans() }}</div>
                                                        </div>
                                                        <div class="comment-content">{!! $comment->comment !!}</div>
                                                        @if ($comment->file)
                                                            <div class="comment-attachments">
                                                                @foreach ($comment->file as $key => $value)
                                                                    @php
                                                                        $fileExtension = pathinfo(
                                                                            $value->file,
                                                                            PATHINFO_EXTENSION,
                                                                        );
                                                                        $iconClass = '';
                                                                        switch ($fileExtension) {
                                                                            case 'doc':
                                                                            case 'docx':
                                                                                $iconClass = 'fa-file-word';
                                                                                break;
                                                                            case 'pdf':
                                                                                $iconClass = 'fa-file-pdf';
                                                                                break;
                                                                            case 'csv':
                                                                            case 'xls':
                                                                            case 'xlsx':
                                                                                $iconClass = 'fa-file-excel';
                                                                                break;
                                                                            case 'png':
                                                                            case 'jpeg':
                                                                            case 'jpg':
                                                                                $iconClass = 'fa-file-image';
                                                                                break;
                                                                            case 'pptx':
                                                                                $iconClass = 'fa-file-powerpoint';
                                                                                break;
                                                                            default:
                                                                                $iconClass = 'fa-file';
                                                                                break;
                                                                        }
                                                                    @endphp
                                                                    @php
                                                                        $fileExtension = pathinfo(
                                                                            $value->file,
                                                                            PATHINFO_EXTENSION,
                                                                        );
                                                                        $isImage = in_array($fileExtension, [
                                                                            'png',
                                                                            'jpeg',
                                                                            'jpg',
                                                                        ]);
                                                                    @endphp
                                                                    <a href="{{ $value->file }}" target="_blank"
                                                                        class="attachment-link mx-2">
                                                                        @if ($isImage)
                                                                            <img style="height: 60px"
                                                                                src="{{ $value->file }}"
                                                                                alt="Attachment Image"
                                                                                class="attachment-image">Attachment{{ $key == 0 ? '' : $key }}
                                                                        @else
                                                                            <i class="far {{ $iconClass }}"></i>
                                                                            Attachment{{ $key == 0 ? '' : $key }}
                                                                        @endif
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @if($comment->employee_id==auth()->user()->employee_id)
                                                    <a href="{{ route('task_comment_delete', $comment->id) }}"
                                                        class="delete-comment"><i class="fa fa-trash text-danger"></i></a>
                                                        @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="no-comments">Comments Not Found</p>
                                        @endif
                                    </div>
                                </div>
                            </div>





                        </div>

                        {{-- <div role="tabpanel" class="tab-pane active " id="add-task-update">
                            <div class="row clearfix">
                                <div class="col-md-6 mt-3">
                                    @if ($task->status != 'ongoing')
                                        <form>
                                            @csrf
                                            <input type="hidden" id="id" value="{{ $task->id }}">
                                            <div class="form-group">
                                                <label>Select Task Progress(%)</label>
                                                <select style="width: 160px;" name="progress" id="progress"
                                                    class="form-control form-control-sm">
                                                    <option value="0" {{ $task->progress == 0 ? 'selected' : null }}>
                                                        0%</option>
                                                    <option value="25"
                                                        {{ $task->progress == 25 ? 'selected' : null }}>25%</option>
                                                    <option value="50"
                                                        {{ $task->progress == 50 ? 'selected' : null }}>50%</option>
                                                    <option value="75"
                                                        {{ $task->progress == 75 ? 'selected' : null }}>75%</option>
                                                    <option value="100"
                                                        {{ $task->progress == 100 ? 'selected' : null }}><span
                                                            style="color: green;">Mark as Completed(100%)</span></option>
                                                </select>
                                            </div>
                                        </form>
                                    @endif
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="form-group">
                                        <label>Module</label>
                                        <select name="module" class="form-control show-tick ms select2"
                                            data-placeholder="Select">
                                            <option></option>
                                            @foreach ($modules as $module)
                                                <option value="{{ $module->module }}">{{ $module->module }}</option>
                                            @endforeach
                                        </select>
                                        @error('module')
                                            <label class="error">{{ $errors->first('module') }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <form action="{{ url('task-taker-progress/' . $task->id) }}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <!--<h6>Add hourly Task Progress</h6>-->
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control form-control-sm"
                                                value="{{ date('Y-m-d') }}">
                                            @error('date')
                                                <label class="error">{{ $errors->first('date') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hours</label>
                                            <input type="text" name="hours" class="form-control form-control-sm"
                                                value="{{ old('hours') }}">
                                            @error('hours')
                                                <label class="error">{{ $errors->first('hours') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Notes</label>
                                            <textarea name="work_detail" class="summernote">{{ old('work_detail') }}</textarea>
                                            @error('work_detail')
                                                <label class="error">{{ $errors->first('work_detail') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="container">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                                    </div>
                                </div>
                                <style>
                                    #save-btn {
                                        width: 180px;
                                        height: 40px;
                                        font-size: 15px;
                                        ;
                                    }
                                </style>
                        </div> --}}
                    </div>
                </div>
            </div>
            <style>
                .profile-image {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    margin-right: 10px;
                }

                .default-profile-image {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    margin-right: 10px;
                    background-color: #ccc;
                    color: #fff;
                    text-align: center;
                    line-height: 40px;
                    font-size: 18px;
                }

                .comments-section {
                    margin-top: 20px;
                }

                .comment {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 10px;
                    margin-bottom: 10px;
                    background-color: #fff;
                }

                .comment-heading {
                    font-size: 18px;
                    margin-bottom: 10px;
                }

                .comment-author {
                    font-weight: bold;
                    margin-bottom: 5px;
                }

                .comment-content {
                    margin-bottom: 10px;
                }

                .comment-attachments {
                    margin-top: 5px;
                }

                .attachment-link {
                    margin-right: 10px;
                }

                .delete-comment {
                    float: right;
                    color: #dc3545;
                    margin-top: -15px
                }

                .no-comments {
                    font-style: italic;
                    color: #6c757d;
                }
            </style>
        @stop

        @section('page-script')
            <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
            <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
            <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
            <script src="{{ asset('assets/js/notify.js') }}"></script>
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
            <script>
                $("#progress").change(function() {

                    let _token = $('input[name=_token]').val();
                    var id = $("#id").val();
                    var progress = $("#progress").val();

                    $.ajax({
                        url: "{{ url('task-takerup-progress') }}" + "/" + id,
                        type: "PUT",
                        data: {
                            _token: _token,
                            progress: progress
                        },
                        success: function(data) {
                            $('#progress-count').html(progress);
                            $('.progress-bar').css({
                                "width": progress + '%'
                            });
                            if (progress == 100) {

                                $.ajax({
                                    url: "{{ url('task-taker') }}" + "/" + id,
                                    type: "PUT",
                                    data: {
                                        _token: _token,
                                        id: id,
                                        status: 'completed'
                                    },
                                    success: function(response, textStatus, jqXHR) {
                                        $('#header-status').html('completed');
                                        $('.hide-badge').hide();
                                        $('#task-status').html(
                                            '<p class="badge badge-success">completed</p>');
                                        $.notify(
                                            "Task 100(%) mark as completed", "success"
                                        );
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(jqXHR);
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });

                            } else {
                                $.ajax({
                                    url: "{{ url('task-taker') }}" + "/" + id,
                                    type: "PUT",
                                    data: {
                                        _token: _token,
                                        id: id,
                                        status: 'in progress'
                                    },
                                    success: function(response, textStatus, jqXHR) {
                                        $('#header-status').html('in progress');
                                        $('.hide-badge').hide();
                                        $('#task-status').html(
                                            '<p class="badge badge-warning">in progress</p>');
                                        $.notify(
                                            "Task " + progress + "(%) in progress", "warning"
                                        );
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(jqXHR);
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });
                            }
                        },
                    });
                });
            </script>
        @endpush
