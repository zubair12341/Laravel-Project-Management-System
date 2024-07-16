@extends('layouts.master')
@section('title', 'Task Progress')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@stop

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Task Progress Details</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                           <li><a href="{{url('task')}}">All Task</a></li>
                           <li><a href="{{url('task/create')}}">Add Task</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body" id="refresh-data">
                <div class="row">
                    <div class="col-md-6">
                <h5><span class="text-muted">Project: </span>
                    @if ($viewTaskProgress->title)
                        {{$viewTaskProgress->title}}
                    @endif
                    <a href="{{url('task-tracker/'.$viewTaskProgress->id.'/edit')}}"><i data-toggle="tooltip" data-placement="top" title="Edit" style="font-size: 15px;" class="fad fa-pencil-alt"></i></a>
                </h5>
                <p><span class="text-muted">Assign To:</span> {{$viewTaskProgress->first_name.' '.$viewTaskProgress->middle_name.' '.$viewTaskProgress->last_name}}</p>
                <p><span class="text-muted">Task No:</span> {{$viewTaskProgress->task_no}}</p>
                <p><span class="text-muted">Assign Date:</span> {{date('l d F, Y', strtotime($viewTaskProgress->assign_date))}}</p>
                <p><span class="text-muted">Deadline Date:</span> {{$viewTaskProgress->deadline_date ? date('l d F, Y', strtotime($viewTaskProgress->deadline_date)) : '--Nil--'}}</p>
                <p style="margin:0;"><span class="text-muted">Priority:</span>
                    @if ($viewTaskProgress->priority == 'normal')
                        <span class="badge badge-primary">{{$viewTaskProgress->priority}}</span>
                    @elseif ($viewTaskProgress->priority == 'medium')
                        <span class="badge badge-warning">{{$viewTaskProgress->priority}}</span>
                    @elseif ($viewTaskProgress->priority == 'high')
                        <span class="badge badge-danger">{{$viewTaskProgress->priority}}</span>
                    @endif
                </p>
                <br>
                <p style="margin:0;"><span class="text-muted">Status:</span>
                    @if ($viewTaskProgress->status == 'pending')
                        <span class="badge badge-danger">{{$viewTaskProgress->status}}</span>
                    @elseif ($viewTaskProgress->status == 'in progress')
                        <span class="badge badge-warning">{{$viewTaskProgress->status}}</span>
                    @elseif ($viewTaskProgress->status == 'ongoing')
                        <span class="badge badge-primary">{{$viewTaskProgress->status}}</span>
                    @elseif ($viewTaskProgress->status == 'completed')
                        <span class="badge badge-success">{{$viewTaskProgress->status}}</span>
                    @endif
                </p>
                <br>

                <div style="display:flex;">
                    <p><span class="text-muted">Task Progress({{$viewTaskProgress->progress}}%):</span></p>
                    <span>
                        <div class="progress" style="margin-top:8px;margin-left:10px;background:#F7C600;border-radius:0;width: 200px;">
                        <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: {{$viewTaskProgress->progress}}%;border-radius:0;"></div>
                        </div>
                    </span>
                </div>

                </div>
                <div class="col-md-6">
                    <p><span class="text-muted">Note:</span></p>
                    <p>{!! $viewTaskProgress->note !!}</p>
                </div>
                </div>

                <hr style="border-top: 1px dashed #bbb8b8;">
                <div class="row">
                    <div class="col-md-12">
                @foreach ($viewWorkDetail as $vtp)
                <ul class="list-unstyled activity">
                    <li class="a_contact">
                        <h4><span class="text-muted">Submit Date: </span>{{date('l d F, Y', strtotime($vtp->date))}}
                            <a href="javascript:void(0);" onclick="editTaskProgress({{$vtp->id}})"><i data-toggle="tooltip" data-placement="top" title="Edit" class="fad fa-pencil-alt"></i></a>
                        </h4>
                        <br>
                        <p style="margin:0;"><span class="text-muted">Hour:</span> {{$vtp->hours}}</p><br>
                        <p style="margin:0;"><span class="text-muted">Module:</span> {{$vtp->module}}</p><br>
                        <p style="margin:0;"><span class="text-muted">Work Detail:</span><br> {!! $vtp->work_detail !!}</p><br>
                    </li><br>
                </ul>
                @endforeach
            </div>
            </div>

            </div>
        </div>
    </div>
</div>

 <!-- Task Progress Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Edit Task Progress</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form id="UpdateTaskProgress">
            @csrf
        <div class="modal-body">
            <div class="row clearfix">
                <div class="col-md-12">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" id="date" name="date" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label>Module</label>
                            <select id="module" name="module" class="form-control show-tick ms select2">
                                <option></option>
                                @foreach ($modules as $module)
                                    <option value="{{$module->module}}">{{$module->module}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Hours</label>
                            <input type="text" id="hours" name="hours" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label>Work Detail</label>
                            <textarea type="text" id="work_detail" name="work_detail" class="summernote"></textarea>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
    </div>
    </div>

<!-- Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Edit Task Progress</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form id="UpdateTask">
            @csrf
        <div class="modal-body">
            <div class="row clearfix">
                <div class="col-md-12">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label>Project Title</label>
                            <select name="project_id" id="project" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option></option>
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <label class="error">{{$errors->first('project_id')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Assign To Employee</label>
                            <select name="employee_id" id="employee" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option></option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <label class="error">{{$errors->first('employee_id')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Task No</label>
                            <input type="text" name="task_no" id="task_no" class="form-control form-control-sm" readonly>
                            @error('task_no')
                            <label class="error">{{$errors->first('task_no')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Priority</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="normal">Normal</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                            @error('priority')
                                <label class="error">{{$errors->first('priority')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Assign Date</label>
                            <input type="date" name="assign_date" id="assign_date" class="form-control form-control-sm">
                            @error('assign_date')
                                <label class="error">{{$errors->first('assign_date')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deadline Date</label>
                            <input type="date" name="deadline_date" id="deadline_date" class="form-control form-control-sm">
                            @error('deadline_date')
                                <label class="error">{{$errors->first('deadline_date')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="pending">Pending</option>
                                <option value="in progress">In Progress</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                            @error('status')
                                <label class="error">{{$errors->first('status')}}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Select Task Progress(%)</label>
                            <select style="width: 160px;" name="progress" id="progress" class="form-control form-control-sm">
                                <option value="0">0%</option>
                                <option value="25">25%</option>
                                <option value="50">50%</option>
                                <option value="75">75%</option>
                                <option value="100"><span style="color: green;">Mark as Completed(100%)</span></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Note</label>
                            <textarea name="note" id="note" class="summernote"></textarea>
                            @error('note')
                                <label class="error">{{$errors->first('note')}}</label>
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    {{-- end modal --}}
@stop

@section('modal')

@endsection


@section('page-script')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('assets/js/notify.js')}}"></script>
@stop

@push('after-scripts')
<script>

// Edit Task
function editTask(id){
    $.get('/edit-task/'+id, function(editTask){
        $('#id').val(editTask.id);
        $('#project').val(editTask.project_id);
        $('#employee').val(editTask.employee_id);
        $('#task_no').val(editTask.task_no);
        $('#priority').val(editTask.priority);
        $('#assign_date').val(editTask.assign_date);
        $('#deadline_date').val(editTask.deadline_date);
        $('#status').val(editTask.status);
        $('#progress').val(editTask.progress);
        $('#note').summernote("code", editTask.note);
        $('#editTaskModal').modal('toggle');
    });
}

// Edit Task Progress
function editTaskProgress(id){
    $.get('/edit-task-progress/'+id, function(taskProgress){
        $('#id').val(taskProgress.id);
        $('#date').val(taskProgress.date);
        $('#module').val(taskProgress.module);
        $('#hours').val(taskProgress.hours);
        $("#work_detail").summernote("code", taskProgress.work_detail);
        $('#editModal').modal('toggle');
    });
}

$('#UpdateTaskProgress').submit(function(e){
    e.preventDefault();

    let _token = $('input[name=_token]').val();
    let id = $('#id').val();
    let date = $('#date').val();
    let module = $('#module').val();
    let hours = $('#hours').val();
    let work_detail = $('#work_detail').val();

    $.ajax({
        url: '{{url("update-task-progress")}}/'+id,
        type: "PUT",
        data: {
            _token:_token,
            date:date,
            module:module,
            hours:hours,
            work_detail:work_detail,
        },
        success:function(response){
            $.notify(
                response, "success"
            );
            $('#editModal').modal('toggle');
            $('#refresh-data').fadeOut(300, function(){
                $("#refresh-data").fadeIn().load(location.href + " #refresh-data");
            });
        }
    });

});

</script>
@endpush
