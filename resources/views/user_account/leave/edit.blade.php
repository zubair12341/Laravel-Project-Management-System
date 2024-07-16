@extends('layouts.master')
@section('title', 'Leave')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
@stop

@section('content')

@include('layouts.alert_message')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Edit Leave</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('leave')}}">All Leave</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="{{url('leave/'.$leave->id)}}" method="post">
                    @method('put')
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Leave Type</label>
                            <select name="leave_type" class="form-control form-control-sm">
                                <option value="casual" {{$leave->leave_type == 'casual' ? 'selected' : null}}>Casual</option>
                                <option value="sick" {{$leave->leave_type == 'sick' ? 'selected' : null}}>Sick</option>
                            </select>
                            @error('leave_type')
                                <label class="error">{{ $errors->first('leave_type') }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="from_date" id="from-date" class="form-control form-control-sm" value="{{$leave->from_date}}">
                            @error('from_date')
                                <label class="error">{{ $errors->first('from_date') }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>To Date</label><br>
                            <small class="text-danger">For 1 day leave To-Date same as From-Date</small>
                            <input type="date" name="to_date" id="to-date" class="form-control form-control-sm" value="{{$leave->to_date}}">
                            @error('to_date')
                                <label class="error">{{ $errors->first('to_date') }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Days</label>
                            <input type="text" name="days" id="days" class="form-control form-control-sm" readonly value="{{$leave->days}}">
                            @error('days')
                                <label class="error">{{ $errors->first('days') }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Reason</label>
                            <textarea name="reason" class="summernote">{{$leave->reason}}</textarea>
                            @error('reason')
                                <label class="error">{{$errors->first('reason')}}</label>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <button type="submit" class="mt-5 btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop


@section('page-script')
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop

@push('after-scripts')
<script>
$("#to-date, #from-date").change(function(){

    var edate = new Date($('#to-date').val());
    var sdate = new Date($('#from-date').val());

    days = (edate- sdate) / (1000 * 60 * 60 * 24);
    days = days+1;
    // alert (days);
    if(days > 0){
        $("#days").val(days);
    }
    else{
        $("#days").val(0);
    }
 });
</script>
@endpush
