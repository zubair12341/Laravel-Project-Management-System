@extends('layouts.master')
@section('title', 'Apply Leave')
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
                <h2>Add Leave</h2>
                <ul class="header-dropdown">
                      <button  type="button" class="btn btn-primary" style="padding: inherit; margin: auto;">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                         <!--<i class="zmdi zmdi-more"></i>-->
                          <!--<button type="button" class="btn btn-primary">Add Task</button>-->
                         </a>
                        <!--<ul class="dropdown-menu dropdown-menu-left mt-3">-->
                         <li><a id="Add_2" style="font-weight:700; color:white; margin-left:-19px; text-decoration:none;" href="{{url('leave')}}">All Leave</a></li>
                        <!--    <li><a href="{{url('leave')}}">All Leave</a></li>-->
                        <!--</ul>-->
                    <!--</li>-->
                    <!--<li class="remove">-->
                    <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                    <!--</li>-->
                    </button>
                </ul>
            </div>
            <style>
                 button.btn.btn-primary {
                                 font-weight: 700;
                                  font-size: 12px;
                               }
                           .card .header .header-dropdown {
                                    position: absolute;
                                    top: 0px;
                                    right: 0px;
                                    list-style: none;
                                }
                                
                       #save-btn{
                                width:180px;
                               height: 40px;
                               font-size: 15px;;
                            }
            </style>
            <div class="body">
                <form action="{{url('leave')}}" method="post">
                    @csrf
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Leave Type</label>
                            <select name="leave_type" class="form-control form-control-sm">
                                <option value="casual">Casual</option>
                                <option value="sick">Sick</option>
                            </select>
                            @error('leave_type')
                                <label class="error">{{ $errors->first('leave_type') }}</label>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Days</label>
                            <input type="text" name="days" id="days" class="form-control form-control-sm" readonly value="{{old('days')}}">
                            @error('days')
                                <label class="error">{{ $errors->first('days') }}</label>
                            @enderror
                        </div>
                        </div>
                        </div>
                        
                        
                        <div class="row">
                        <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="from_date" id="from-date" class="form-control form-control-sm" value="{{old('from_date')}}">
                            @error('from_date')
                                <label class="error">{{ $errors->first('from_date') }}</label>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-6 mt-1">
                        <div class="form-group">
                            <label>To Date</label><br>
                            <small class="text-danger">For 1 day leave To-Date same as From-Date</small>
                            <input type="date" name="to_date" id="to-date" class="form-control form-control-sm" value="{{old('to_date')}}">
                            @error('to_date')
                                <label class="error">{{ $errors->first('to_date') }}</label>
                            @enderror
                        </div>
                      </div>
                      </div>
                         
                         <div class="row">
                             <div class="col-md-6">
                        <div class="form-group">
                            <label>Reason</label>
                            <textarea name="reason" class="summernote">{{old('reason')}}</textarea>
                            @error('reason')
                                <label class="error">{{$errors->first('reason')}}</label>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-6"></div>
                            <div class="container">
                                 <div class="col-md-12 text-center">
                                          <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                          </div>
                     </div>
                  </div>
              </div>
                  
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
