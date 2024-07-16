@extends('layouts.master')
@section('title', 'receivable')
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
                <h2 id="Add_1">Add Receivable Expance</h2>
                <ul class="header-dropdown">
                    <button  type="button" class="btn btn-primary" style="padding: inherit; margin: auto;">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <!--<ul class="dropdown-menu dropdown-menu-right">-->
                            <li><a id="Add_2" style="font-weight:700; color:white; margin-left:-14px; text-decoration:none;" href="{{route('all.reciveable')}}">All Receivable Expance </a></li>
                        <!--</ul>-->
                    </li>
                    <!--<li class="remove">-->
                    <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                    <!--</li>-->
                                </button>
                </ul>
            </div>

            <div class="body">
                <form action="{{route('post.reciveable')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label>Client Name</label>
                        <div class="form-group">
                            <input type="text" name="client_name" id="" class="form-control form-control-sm">
                        </div>
                        </div>
                         <div class="col-md-6">
                         <label>Plan</label>
                        <div class="form-group">
                            <select name="plan" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option></option>
                                <option value="Recurring">Recurring</option>
                                <option value="One time">One time</option>
                                <option value="Standard">Standard</option>
                                <option value="Split Amount">Split Amount</option>

                            </select>
                           </div>
                           </div>
                        </div>
                   
                    <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label>Paid Via</label>
                            <input type="text" name="paid_via" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="" class="form-control">

                        </div>
                         </div>
                         <div>

                    </div>
                    <div class="col-md-6">
                    </div>
                </div>

                       <div class="row">
                           <div class="col-md-6">
                        <div class="form-group">
                            <label>Purpose</label>
                            <input type="text" name="Purpose" id="" class="form-control">
                          </div>
                        
                        <div class="form-group">
                            <label>Document Attachment</label>
                            <input type="file" name="file" multiple id="fileuploader" >

                        </div>

                        </div>
                        
                       <div class="col-md-6">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" value=""></textarea>
                          </div>
                        </div>
                    <div class="container">
                                 <div class="col-md-12 text-center">
                                          <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                                  </div>
                        <style>
                            #save-btn{
                                   width:180px;
                               height: 40px;
                               font-size: 15px;
                            }
                           @media only screen and (max-width: 640px)
                           {
                                .card .header h2 {
                                    max-width: 50%;
                                }
                        }                                </style>

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


