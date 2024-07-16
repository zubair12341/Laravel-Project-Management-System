@extends('layouts.master')
@section('title', 'Department')
@section('page-style')
@stop
@section('content')

@include('layouts.alert_message')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
            <div class="header">
                <h2>Edit Department</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('department/create')}}">Add Departments</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body" id="body">
                <form action="{{url('department/'.$department->id)}}" method="post">
                @method('put')
                @csrf
                <div class="row clearfix">
                    <div class="col-md-5">
                    <label>Department Name</label>
                    </div>
                    <div class="col-md-7">
                    <div class="form-group">
                            <input type="text" name="name" class="form-control form-control-sm" value="{{$department->name}}">
                            @error('name')
                                <label class="error">{{$errors->first('name')}}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                    <label>Designation Title</label>
                    </div>
                    <div class="col-md-7">
                    <table>
                                <tr>
                                   
                                </tr>
                                <tbody class="new-row">
                                @foreach ($designations as $designation)
                                <tr>
                                    <td style="padding-right:10px;">
                                        <input type="hidden" name="id[]" value="{{$designation->id}}" />
                                        <input type="text" name="title[]" class="form-control" value="{{$designation->title}}"/>
                                    </td>
                                    <td>
                                        <button type="button" class="delete-row btn btn-neutral"><i class="fas fa-times text-danger"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                            <button type="button" id="add" class="mt-3 mb-5 btn btn-md btn-primary">+Add</button>
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
<script>
$('#add').on('click', function(){
    var tr = '<tr>'+
            '<td style="padding-right:10px;"><input type="text" name="title[]" class="form-control"/></td>'+
            '<td><button type="button" class="delete-row btn btn-neutral"><i class="fas fa-times text-danger"></i></button></td>'+
            '</tr>';
        $('.new-row').append(tr);
});

$('.new-row').on('click', '.delete-row', function(){
     $(this).parent().parent().remove();
});
</script>
@endpush

@section('page-script')
@stop


