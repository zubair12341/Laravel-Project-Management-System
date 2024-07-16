@extends('layouts.master')
@section('title', 'Task Module')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
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
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div id="card" class="card">
        <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                <div class="header-employee">

                    <div class="d-flex justify-content-center">
                        <div class="max-w-50 mt-3">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Milestones</h1>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div id="btn-row" class="row d-flex justify-content-center">
                            <div class="col-md-2 w-100">
                                <button id="btn" style="width: 100%" class="btn "  data-toggle="modal" data-target="#exampleModal">Add Milestone</button>

                            </div>
                            <div class="col-md-2">
                                <a href="{{url('client')}}"><button id="btn" style="width: 100%" class="btn ">All Clients</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('client.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Client</button></a>

                            </div>
                            <div class="col-md-2">
                                <a href="{{url('task-report')}}"><button id="btn" style="width: 100%" class="btn">Reports</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('task-module')}}"><button id="btn" style="width: 100%" class="btn">Task Module</button></a>
                            </div>
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
                                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Search: Client name, project task....">
                                </div>
                                <hr class="border-secondary my-2">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- <div class="header">
                <h2>Add Task Module</h2>
                <ul class="header-dropdown">
                    {{-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="{{url('user')}}">Task Module</a></li>
                        </ul>
                    </li> --}}
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div> -->
            <div id="body" class="body shadow-lg">
            <div class="table-responsive">
                    <table class="admin-datatable table table-hover shadow-sm" style="width: 100%;background:white;">
                        <thead class="thead-light">
                            <tr>
                                <!--<th>Options</th>-->
                                <th style="background: white;font-weight:bold;">Milestones</th>
                            </tr>
                        </thead>
                     
                        <tbody>
                            @foreach ($taskModules as $taskModule)
                            <tr id="mid{{$taskModule->id}}" class="tableReload">
                                <!--<td>-->
                                <!--    <x-options-buttons>-->
                                <!--        <x-slot name="buttons">-->
                                <!--            <li><a href="">Edit</a></li>-->
                                <!--            <li>-->
                                <!--                <a href="" onclick="event.preventDefault();-->
                                <!--                    document.getElementById('delete').submit();">Delete</a>-->
                                <!--                <form id="delete" action="" method="post">-->
                                <!--                    @method('delete')-->
                                <!--                    @csrf-->
                                <!--                </form>-->
                                <!--            </li>-->
                                <!--        </x-slot>-->
                                <!--    </x-options-buttons>-->
                                <!--</td>-->
                                <td class="taskmodule">{{$taskModule->module}}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a  href="javascript:void(0)" onclick="editModule({{$taskModule->id}})"  class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>

                                        <button type="button" class="btn btn-sm btn-default delete remove" data-id="{{url('task-module/'.$taskModule->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                        {{-- <form action="{{url('user/'.$user->id)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form id="moduleFormEdit">
                                        @csrf
                                        <input type="hidden" id="id" name="id"/>
                                        <div class="form-group">
                                            <label>Milestone</label>
                                            <input type="text" class="form-control" id="module" name="module" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" style=" border: 1px solid #FE8415" id="save-btn" class="mt-5 btn btn-lg">Save Changes</button>
                                                        </div>
                                                    </div>
                                                  
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('task-module')}}" method="post">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Milestone</label>
                            <input type="text" name="module" class="form-control form-control-sm" value="{{old('module')}}">
                            @error('module')
                                <label class="error">{{$errors->first('module')}}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="modal-footer">
                <div class="col-md-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" style=" border: 1px solid #FE8415" id="save-btn" class="mt-5 btn btn-lg">Save Changes</button>
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


@stop

@push('after-scripts')
<script>
    function editModule(id){
        $.get('/task-module/'+id, function(taskModule){
            $('#id').val(taskModule.id);
            $('#module').val(taskModule.module);
            $('#updateModal').modal('toggle');
        });
    }

    $('#moduleFormEdit').submit(function(e){
        e.preventDefault();

        let id = $('#id').val();
        let module = $('#module').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            url: "{{url('task-module')}}"+"/"+id,
            type: "PUT",
            data: {
                id:id,
                module:module,
                _token:_token,
            },
            success:function(response){
                $('#mid' + response.id +' td:nth-child(1)').text(response.module);
                $('.taskmodule').text(response.module);
                $('#updateModal').modal('toggle');
                alert('Record has been updated!');
                // $('#moduleFormEdit')[0].reset();
            }
        })
    });


$(".delete").click('.remove',function(){

var dataId = $(this).attr("data-id");
var del = this;
if(confirm("Do you want to delete this record?")){
    $.ajax({
    url:dataId,
    type:'DELETE',
    data:{
    _token : $("input[name=_token]").val()
    },
    success:function(response){
        $(del).closest( "tr" ).remove();
        alert(response.message);
    }
    });
}
});

</script>
@endpush

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop


