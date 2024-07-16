@extends('layouts.master')
@section('title', 'reciveable')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@stop
@section('content')

@include('layouts.alert_message')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Recicveable Expance</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('all.reciveable')}}">All Recicveable Expance</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="{{route('update.recivable')}}" method="post">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">



                        <label>Client Name</label>
                        <div class="form-group">
                            <input type="text" name="client_name" id="" value="{{$recivedable->client_name}}" class="form-control form-control-sm">
                            <input type="hidden" name="id" value="{{$recivedable->id}}">
                        </div>



                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" name="Purpose" value="{{$recivedable->purpose}}" class="form-control">

                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" value="">{{$recivedable->description}}</textarea>

                        </div>

                        <label>plan</label>
                        <div class="form-group">
                            <select name="plan" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option>{{$recivedable->plan}}</option>
                                <option value="Recurring">Recurring</option>
                                <option value="One time">One time</option>
                                <option value="Standard">Standard</option>
                                <option value="Split Amount">Split Amount</option>

                            </select>

                        </div>

                        <div class="form-group">
                            <label>Paid Via</label>
                            <input type="text" name="paid_via" value="{{$recivedable->paid_via}}" class="form-control">

                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" value="{{$recivedable->amount}}" class="form-control">

                        </div>

                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@push('after-scripts')
<script>

    var basic_pay = $('#basic-pay');
    var $bonus = $('#bonus');
    var pay_amount = $('#pay-amount');
    var total = $('#total');

    function calcVal() {
        var num1 = basic_pay.val();
        var num2 = $bonus.val();
        var result = parseInt(num1, 10) + parseInt(num2, 10);

        if (!isNaN(result)) {
            pay_amount.val(result);
            total.val(result);
          }
      }

      calcVal();
      basic_pay.on("keydown keyup", function() {
          calcVal();
      });
      $bonus.on("keydown keyup", function() {
          calcVal();
      });

</script>
@endpush

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop


