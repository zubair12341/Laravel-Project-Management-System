@extends('layouts.master')
@section('title', 'Task Report')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Task Reports</h2>
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
            <div class="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Employee</th>
                                <th>Project</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Module</th>
                                <th>Hours</th>
                                <th>Work Detail</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Employee</th>
                                <th>Project</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Module</th>
                                <th>Hours</th>
                                <th>Work Detail</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($taskReport as $tr)
                            <tr>
                                <td>
                                    {{$tr->first_name ? $tr->first_name.' '.$tr->middle_name.' '.$tr->last_name:null}}
                                </td>
                                <td>
                                    {{$tr->title ? $tr->title : null}}
                                </td>
                                <td>{{$tr->full_name ? $tr->full_name : null}}</td>
                                <td>{{$tr->date ? \Carbon\Carbon::parse($tr->date)->format('j F, Y') : null}}</td>
                                <td>{{$tr->module}}</td>
                                <td>{{$tr->hours}}</td>
                                <td>{!!$tr->work_detail!!}</td>
                            </tr>
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
