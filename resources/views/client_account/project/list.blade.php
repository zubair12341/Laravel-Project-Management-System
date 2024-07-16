@extends('layouts.client_master')
@section('title', 'Project')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
@stop
@section('content')
@include('layouts.alert_message')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>All Project</h2>
                <ul class="header-dropdown">
                    {{-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="{{url('task/create')}}">Add Task</a></li>
                        </ul>
                    </li> --}}
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="emp-datatable table table-hover" style="width:100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>project</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>project</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                             {{-- @foreach ($tasks as $task) --}}
                            {{--<tr>
                                <td>
                                    {{$task->project->title ?? null}}
                                </td>
                                <td>{{$task->task_no}}</td>
                                <td>
                                    @if ($task->priority == 'normal')
                                        <span class="badge badge-primary">{{$task->priority}}</span>
                                    @elseif($task->priority == 'medium')
                                        <span class="badge badge-warning">{{$task->priority}}</span>
                                    @elseif($task->priority == 'high')
                                        <span class="badge badge-danger">{{$task->priority}}</span>
                                    @endif
                                </td>
                                <td>
                                    {{$task->assign_date ? \Carbon\Carbon::parse($task->assign_date)->format('j F, Y') : null}}
                                </td>
                                <td>
                                    {{$task->deadline_date ? \Carbon\Carbon::parse($task->deadline_date)->format('j F, Y') : null}}
                                </td>
                                <td>
                                    @if ($task->status == 'ongoing')
                                        <span class="badge badge-primary">{{$task->status}}</span>
                                    @elseif($task->status == 'completed')
                                        <span class="badge badge-success">{{$task->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex;">
                                        <a href="{{url('employee-task/'.$task->id.'/edit')}}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="View Task"><i class="far fa-eye"></i></a>

                                        <a href="{{url('employee-task-progress/'.$task->id.'/task-progress')}}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Submit Task Progress"><i class="fas fa-tasks"></i></a>

                                        <a  href="javascript:void(0)" onclick="editModule({{$task->id}})"  class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr> --}}
                            <!-- Modal -->
                            <div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Task Progress <span id="projectTitle"></span></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form id="task-form-edit">
                                    <div class="modal-body">
                                    <label><b>Task Details</b></label>
                                    <p id="note"></p>
                                    <hr>
                                        @csrf
                                        <input type="hidden" id="id" name="id"/>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label><b>Project progress(%)</b></label>
                                            <select class="form-control" id="progress" name="progress">
                                                <option value="100">100% (Completed)</option>
                                                <option value="95">95%</option>
                                                <option value="90">90%</option>
                                                <option value="85">85%</option>
                                                <option value="80">80%</option>
                                                <option value="75">75%</option>
                                                <option value="70">70%</option>
                                                <option value="65">65%</option>
                                                <option value="60">60%</option>
                                                <option value="55">55%</option>
                                                <option value="50">50%</option>
                                                <option value="45">45%</option>
                                                <option value="40">40%</option>
                                                <option value="35">35%</option>
                                                <option value="30">30%</option>
                                                <option value="25">25%</option>
                                                <option value="20">20%</option>
                                                <option value="15">15%</option>
                                                <option value="10">10%</option>
                                                <option value="5">5%</option>
                                                <option value="0" selected>0%</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><b>Project Status</b></label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="ongoing">Ongoing</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                    </div>
                                    </form>

                                    <form id="add-task-progress">
                                        @csrf
                                        <div class="modal-body">
                                            <hr>
                                            <h5>Add Task Progress</h5>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <input type="date" name="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}">
                                                        @error('date')
                                                            <label class="error">{{$errors->first('date')}}</label>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Module</label>
                                                        <select name="module" class="form-control show-tick ms select2" data-placeholder="Select">
                                                            <option></option>
                                                            @foreach ($modules as $module)
                                                                <option value="{{$module->module}}">{{$module->module}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('module')
                                                            <label class="error">{{$errors->first('module')}}</label>
                                                        @enderror
                                                    </div>
                                                </div> --}}

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Hours</label>
                                                        <input type="text" name="hours" class="form-control form-control-sm" value="{{old('hours')}}">
                                                        @error('hours')
                                                            <label class="error">{{$errors->first('hours')}}</label>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea name="work_detail" class="summernote">{{old('work_detail')}}</textarea>
                                                    @error('work_detail')
                                                    <label class="error">{{$errors->first('work_detail')}}</label>
                                                    @enderror
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="mt-5 btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-script')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
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
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
@stop

@push('after-scripts')
<script>
function editModule(id){
    $.get('/employee-task/'+id+'/edit', function(task){
        $('#id').val(task.id);
        $('#projectTitle').html(task.project_id);
        $('#note').html(task.note);

        $('#viewTaskModal').modal('toggle');
    });
}


$('#task-form-edit').submit(function(e){

    e.preventDefault();

    let _token = $('input[name=_token]').val();
    let id = $('#id').val();
    let status = $('#status').val();

    $.ajax({
        url: "{{url('employee-task')}}"+"/"+id,
        type: "put",
        data: {
            _token:_token,
            id:id,
            status:status,
        },
        success:function(response){
            $('#viewBreakTimeModal').modal('toggle');
            alert(response);
        }
    })
});

</script>
@endpush

