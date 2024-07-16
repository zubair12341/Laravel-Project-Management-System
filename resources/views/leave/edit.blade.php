@extends('layouts.master')
@section('title', 'Leave')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>View Leave</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('leave-list')}}">All Leave</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="row">


                <div class="col-md-6 col-sm-12">
                    <label>Leave Type</label>
                    <p><b>{{$leave->leave_type}}</b></p>
                    <p>From Date rachndf</p>
                    <p><b>{{$leave->from_date ? date('j F, Y', strtotime($leave->from_date)) : null}}</b></p>
                    <p>To Date</p>
                    <p><b>{{$leave->to_date ? date('j F, Y', strtotime($leave->to_date)) : null}}</b></p>
                    <p>Reason</p>
                    <p>{!!$leave->reason!!}</p>

                    <form class="card-body" action="{{url('leave-list/'.$leave->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{$leave->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="approved" {{$leave->status == 'approved' ? 'selected' : ''}}>Approved</option>
                                <option value="rejected" {{$leave->status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                            </select>
                            @error('status')
                                <label class="error">{{ $errors->first('status') }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="mt-5 btn btn-primary">Save Changes</button>
                    </form>

                </div>

                <div class="col-md-6 col-sm-12">
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('page-script')

@stop
