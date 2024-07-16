@extends('layouts.master')
@section('title', 'Payable')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}" />
@stop
@section('content')
<style>
    #btn {
        background: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%) !important;
        color: black;
        font-weight: 900;
    }

    #background {
        width: 103%;
        margin-left: -13px;
    }
    #card #body{
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
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div id="card" class="card">
            <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                <div class="header-employee">

                    <div class="d-flex justify-content-center">
                        <div class="max-w-50 mt-3">
                            <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Expense</h1>
                        </div>
                    </div>





                    <div class="container-fluid">
                        <div id="btn-row" class="row d-flex justify-content-center">
                            <div class="col-md-2 w-100">
                                <a href="{{url('add-payable')}}"><button id="btn" style="width: 100%" class="btn ">Add Expense</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('user')}}"><button id="btn" style="width: 100%" class="btn ">User</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('payslip.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Payslips</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('department.create')}}"><button id="btn" style="width: 100%" class="btn">Departments</button></a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('time-tracker')}}"> <button id="btn" style="width: 100%" class="btn ">Attendence</button></a>
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
            <div class="body shadow-lg" id="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover shadow-sm" style="width:100%;background:white;">
                        <thead class="thead-light">
                            <tr>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Date</th>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Details</th>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Account</th>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Mode</th>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Type</th>
                                <th style="border-right: 0px;font-weight:bold;" class="text-center font-weight-bold">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($payable as $payable )

                            <tr class="text-center">
                                <td>
                                    <!-- <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{route('edit.payable',$payable->id)}}">Edit</a></li>
                                            <li><a href="{{route('delete.payable',$payable->id)}}">Delete</a></li>

                                           {{-- <li>
                                                <a href="{{url('employee/'.$employee->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();">Delete</a>
                                                <form id="delete" action="{{url('employee/'.$employee->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </li>--}}
                                        </x-slot>
                                    </x-options-buttons> -->
                                    {{$payable->date ? date('j F, Y', strtotime($payable->date)):null}}
                                </td>
                                <th>@if($payable->type== 'In')
                                    <span>{{$payable->project->title}}</span>
                                    @elseif($payable->type== 'Out')
                                    <span>{{$payable->description}}</span>
                                    @endif
                                </th>
                                <th>{{$payable->account}}</th>
                                <th>{{$payable->mode}}</th>
                                <th>{{$payable->type}}</th>
                                <th>
                                    <button class="btn btn-success btn-sm w-100" data-toggle="modal" data-target="#exampleModal{{$payable->id}}"><span><i class="zmdi zmdi-edit mr-1"></i>
                                        </span> Edit</button>
                                </th>

                            </tr>
                            <div class="modal fade" id="exampleModal{{$payable->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header borde-bottom">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Expense</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('update.payable')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row clearfix ">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" name="date" class="form-control form-control-sm" value="{{$payable->date}}">
                                                            @error('date')
                                                            <label class="error">{{$errors->first('date')}}</label>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Type</label>
                                                        <div class="form-group">
                                                            <select name="type" id="select-type" class="form-control show-tick ms select2">
                                                                <option value="In" {{$payable->type == 'In' ? 'selected':null}}>In

                                                                </option>

                                                                <option value="Out" {{$payable->type == 'Out' ? 'selected':null}}>Out</option>




                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="in">
                                                            <label>Select Project</label>
                                                            <select name="project_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                                                <option></option>
                                                                @foreach ($projects as $project)
                                                                <option value="{{$project->id}}" {{$payable->project_id == $project->id ? 'selected':null}}>{{$project->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div id="out" style="display: none;">
                                                            <label>Details</label>
                                                            <textarea class="form-control" rows="5" name="description">{{$payable->description}}</textarea>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Select Account</label>
                                                        <select name="account" class="form-control show-tick ms select2" data-placeholder="Select">
                                                            <option></option>

                                                            <option value="Asad Malik - Meezan" {{$payable->account == 'Asad Malik - Meezan' ? 'selected':null}}>Asad Malik - Meezan</option>
                                                            <option value="DA Tech - Meezan" {{$payable->account == 'DA Tech - Meezan' ? 'selected':null}}>DA Tech - Meezan</option>

                                                        </select>

                                                        <div id="oo" class="mt-3" style="display: none;">
                                                            <label>Select Mode</label>
                                                            <select name="mode" class="form-control show-tick ms select2" data-placeholder="Select">
                                                                <option></option>

                                                                <option value="Online Transfer" {{$payable->mode == 'Online Transfer' ? 'selected':null}}>Online Transfer</option>
                                                                <option value="Cash"  {{$payable->mode == 'Cash' ? 'selected':null}}>Cash</option>
                                                                <option value="Cheque"  {{$payable->mode == 'Cheque' ? 'selected':null}}>Cheque</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="ii" class="col-md-6 mt-3">
                                                        <label>Select Mode</label>
                                                        <select name="mode" class="form-control show-tick ms select2" data-placeholder="Select">
                                                            <option></option>

                                                            <option value="Online Transfer" {{$payable->mode == 'Online Transfer' ? 'selected':null}}>Online Transfer</option>
                                                            <option value="Cash"  {{$payable->mode == 'Cash' ? 'selected':null}}>Cash</option>
                                                            <option value="Cheque" {{$payable->mode == 'Cheque' ? 'selected':null}}>Cheque</option>

                                                        </select>
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
                                                            background: linear-gradient(90deg, rgba(254, 148, 0, 1) 0%, rgba(255, 109, 0, 1) 100%) !important;
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

@push('after-scripts')
<script>
    $("#select-type").change(function() {
        var selectedValue = $(this).val();

        if (selectedValue == "Out") {
            $('#out').show();
            $('#in').hide();
            $('#oo').show();
            $('#ii').hide();
        } else {
            $('#in').show();
            $('#out').hide();
            $('#ii').show();
            $('#oo').hide();
        }

    });
</script>



@endpush