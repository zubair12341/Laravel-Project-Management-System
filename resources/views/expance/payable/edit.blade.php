@extends('layouts.master')
@section('title', 'payable')
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
                <h2>Add Payable Expance</h2>
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('all.payable')}}">All Payable Expanc   rewdwe</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="{{route('update.payable')}}" method="post">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">



                        <label>List of Things</label>
                        <div class="form-group">
                            <input type="text" name="things" value="{{$payable->things}}" class="form-control form-control-sm">
                            <input type="hidden" value="{{$payable->id}}" name="id">

                        </div>



                        <div class="form-group">
                            <label>Pricing in PKR</label>
                            <input type="text" name="price" value="{{$payable->price}}" class="form-control">

                        </div>

                        <div class="form-group">
                            <label>Plan Pricing in PKR</label>
                            <input type="text" name="plan" value="{{$payable->plane_price}}" class="form-control" value="">

                        </div>

                        <div class="form-group">
                            <label>Paid by Hi5 Consulting</label>
                            <input type="text" name="paid" value="{{$payable->paid_by}}" class="form-control">

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


