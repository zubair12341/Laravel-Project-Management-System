@extends('layouts.master')
@section('title', 'Tasks')
@section('page-style')
{{-- <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/> --}}
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
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
                <div class="header-employee">

                    <div class="d-flex justify-content-center">
                        <div class="max-w-50 mt-3">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Tasks</h1>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <div class="w-50 ">
                            <div class="form-group mb-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-0">
                                            <img src="{{asset('img/sidebar/2.png')}}" width="25" height="25">
                                        </span>
                                    </div>
                                    <input type="text" class="form-control border-0 bg-transparent table-search" placeholder="Search: .....">
                                </div>
                                <hr class="border-secondary my-2">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="emp-datatable table table-hover" style="width:100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Options</th>
                                <th>project</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Options</th>
                                <th>project</th>
                                <th>Task No</th>
                                <th>Priority</th>
                                <th>Assign Date</th>
                                <th>Deadline Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{url('task/'.$task->id.'/edit')}}">View</a></li>
                                        </x-slot>
                                    </x-options-buttons>
                                </td>
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
                                    <p style="margin-bottom: -10px;"><small>{{$task->progress}}%</small></p>
                                    <div class="progress" style="margin-top:8px;background:#F7C600;border-radius:0;">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: {{$task->progress}}%;border-radius:0;"></div>
                                    </div>
                                </td>
                                <td>
                                    @if ($task->status == 'pending')
                                        <span class="badge badge-danger">{{$task->status}}</span>
                                    @elseif ($task->status == 'ongoing')
                                        <span class="badge badge-primary">{{$task->status}}</span>
                                    @elseif ($task->status == 'in progress')
                                        <span class="badge badge-warning">{{$task->status}}</span>
                                    @elseif($task->status == 'completed')
                                        <span class="badge badge-success">{{$task->status}}</span>
                                    @endif
                                </td>
                            </tr>
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
                                                <option value="0" selected>0%</option>
                                                <option value="20">20%</option>
                                                <option value="50">50%</option>
                                                <option value="70">70%</option>
                                                <option value="100">100% (Completed)</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><b>Project Status</b></label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="in-progress">In Progess</option>
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

                                                <div class="col-md-4">
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
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Hours</label>
                                                        <input type="text" name="hours" class="form-control form-control-sm" value="{{old('hours')}}">
                                                        @error('hours')
                                                            <label class="error">{{$errors->first('hours')}}</label>
                                                        @enderror
                                                    </div>
                                                </div>
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
{{-- <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

{{-- <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script> --}}
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
@stop

@push('after-scripts')
<script>
    $(document).ready(function() {
      var table = $('.table').DataTable();

      $('.table-search').on('input', function() {
        var value = $(this).val();
        table.search(value).draw();
      });
    });
  </script>
<script>
function editModule(id){
    $.get('/task/'+id+'/edit', function(task){
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
        url: "{{url('task')}}"+"/"+id,
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
