@extends('layouts.master')
@section('title', 'Department')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" />
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

    #add {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        color: black;
    }
    #edit-add {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        color: black;
    }

    @media only screen and (max-width: 676px) {
        #responsive {
            width: 96px;
        }

    }
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
            <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                <div class="header-employee">

                    <div class="d-flex justify-content-center">
                        <div class="max-w-50 mt-3">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Departments</h1>
                        </div>
                    </div>




                    <div class="container-fluid">
                        <div id="btn-row" class="row d-flex justify-content-center">
                            <div class="col-md-2 w-100">
                                <button id="btn" style="width: 100%;font-size:10px" data-toggle="modal" class="btn" data-target="#addModal">Add Departments</button>

                            </div>
                           
                            <div class="col-md-2">
                                <a href="{{route('employee.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Employee</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('employee')}}"> <button id="btn" style="width: 100%" class="btn ">All Employee</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-5">
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
            <div class="body shadow-lg" id="body">
                <p style="font-size: 20px;margin-top:-10px; color:gray;">All</p>
                <hr style="margin-top:-15px;">

                <div class="table-responsive">
                    <table class="admin-datatable table table-hover shadow-sm" style="width: 100%;background:white;">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="border-right: none;color:#1D262D;">Department Name</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;">Designation Title</th>
                                <th id="responsive" class="text-center " style="border-right: none;color:#1D262D;width:217px;">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <?php
                            $designations = DB::table('departments')
                                ->join('designations', 'departments.id', '=', 'designations.department_id')
                                ->select('designations.*')
                                ->where('departments.id', '=', $department->id)
                                ->get();

                            ?>
                            <tr>

                                <td class="text-center">
                                    {{$department->name}}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <select id="select-designation" name="designation_id" style="width: 150px;background:#E5E7E7;border-radius:7px" class="form-control form-control-md show-tick ms select2 align-items-center" data-placeholder="Select">

                                            @foreach($designations as $designation)
                                            <option style="background: white;" value="{{$designation->id}}" {{old('designation_id') == $designation->id ? 'selected':null}}>{{$designation->title}}</option>
                                            @endforeach
                                    </div>
                                    </select>




                                </td>
                                <td class="text-center ">
                                    <!--                             
                            <a  href="{{url('department/'.$department->id.'/edit')}}">
                            </a> -->

                                    <button data-toggle="modal" data-target="#editdepartment{{$department->id}}" class="btn btn-success edit-btn btn-sm w-75"><span><i class="zmdi zmdi-edit mr-1"></i>
                                        </span> Edit</button>
                                    <br>
                                    <a href="{{url('department/'.$department->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();"><button class="btn btn-danger btn-sm w-75"><span><i class="zmdi zmdi-delete"></i>
                                            </span> Delete</button> </a>
                                    <form id="delete" action="{{url('department/'.$department->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                    </form>
                                    <div class="modal fade" id="editdepartment{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom">
                                            <h5 class="modal-title" style="font-weight: bold;" id="editModalLabel">Edit Department</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('department/'.$department->id)}}" method="post">
                                                @method('put')
                                                @csrf
                                                <div class="row clearfix">
                                                    <div class="col-md-5">
                                                        <label>Department Name</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <input type="text" id="name" name="name" class="form-control form-control-sm" value="{{$department->name}}">
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
                                                                        <input type="hidden" id="designationId" name="id[]" value="{{$designation->id}}" />
                                                                        <input type="text" id="title" name="title[]" class="form-control" value="{{$designation->title}}" />
                                                                    </td>
                                                                 
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" id="edit-add" class="mt-3 mb-5 btn btn-md btn-primary">+Add</button>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button style=" border: 1px solid #FE8415" type="submit" id="add-btn" class="btn btn-lg">Save Changes</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                        
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>All Departments</h2>
                <ul class="header-dropdown">
                    {{-- <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp">
                            <li><a href="{{url('')}}">Add</a></li>
                        </ul>
                    </li> --}}
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <tr>
                                    <th>Options</th>
                                    <th>Department Name</th>
                                </tr>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Options</th>
                                <th>Department Name</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($departments as $department)
                            <tr>
                                <td>
                                    <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{url('department/'.$department->id.'/edit')}}">Edit</a></li>
                                            <li>
                                                <a href="{{url('department/'.$department->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();">Delete</a>
                                                <form id="delete" action="{{url('department/'.$department->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </li>
                                        </x-slot>
                                    </x-options-buttons>
                                </td>
                                <td>{{$department->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="modal fade " id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title " style="font-weight:bold;" id="addModalLabel">Add Departments</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{url('department')}}" method="post">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-5">
                                <label style="margin-left: 0.9rem!important;">Department Name</label>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="text" placeholder="Department" style="outline: #CFCFCF;" name="name" class="form-control form-control-sm" value="{{old('name')}}">
                                    @error('name')
                                    <label class="error">{{$errors->first('name')}}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="text-center ml-3">Designation Title</label>
                            </div>
                            <div class="col-md-7">
                                <table>
                                    <tr>

                                    </tr>
                                    <tbody class="new-row">
                                        <tr>
                                            <td class="w-100">
                                                <input type="text" placeholder="Designation" name="title[]" class="form-control" />
                                            </td>

                                            <td>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="add" class="mt-3 mb-5 btn btn-md btn-primary">+Add</button>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button style=" border: 1px solid #FE8415" type="submit" id="add-btn" class="btn btn-lg btn-outline-cutom btn-gradient">Add Department</button>
                                </div>
                            </div>

                            <style>
                                #add-btn {
                                    background-image: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%);
                                    border-color: transparent;
                                    -webkit-background-clip: text;
                                    -moz-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    -moz-text-fill-color: transparent;
                                }
                            </style>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>


@stop
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

@push('after-scripts')


<script>
    $('#add').on('click', function() {
        var tr = '<tr>' +
            '<td ><input style="margin-top:10px;" type="text" name="title[]" class="form-control"/></td>' +

            '</tr>';
        $('.new-row').append(tr);
    });

    $('.new-row').on('click', '.delete-row', function() {
        $(this).parent().parent().remove();
    });
</script>
<script>
$('#edit-add').on('click', function(){
    var tr = '<tr>'+
            '<td  style="margin-top:10px;"><input type="text" name="title[]" class="form-control"/></td>'+
            
            '</tr>';
        $('.new-row').append(tr);
});

$('.new-row').on('click', '.delete-row', function(){
     $(this).parent().parent().remove();
});
</script>

@endpush

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
@stop