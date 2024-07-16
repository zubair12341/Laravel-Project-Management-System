@extends('layouts.master')
@section('title', 'Payslip')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
@stop
@section('content')

@include('layouts.alert_message')

<style>
     #card #body{
        background: #f0f0f0;
     }

     #background{
       width: 103%;
       margin-left: -13px;
     }
     #margin{
        margin-bottom: 7rem!important;
     }
     #btn{
        background: linear-gradient(90deg, rgba(254,148,0,1) 0%, rgba(255,109,0,1) 100%) !important;
        color: black;
        font-weight: 900;
     }
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
        <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
            <div class="header">
            <div class="d-flex justify-content-center">
    <div id="margin" class="max-w-50 ">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >Add Payslip</h1>
    </div>
  </div>
               
  <ul class="header-dropdown mt-5">

<button id="btn" type="button" class="btn btn-primary" style="padding: inherit;margin-top: 140px;">
<li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;" href="{{url('payslip')}}">All Payslips</a></li>
<li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
    <!--<ul class="dropdown-menu dropdown-menu-right">-->
    <!--    <li><a href="{{url('employee')}}">All Employee</a></li>-->
    <!--</ul>-->
</li>
<!--<li class="remove">-->
<!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
<!--</li>-->
</button>
</ul>
            </div>
            </div>
            <div class="body shadow-lg" id="body">
            <p style="font-size: 20px;margin-top:-10px; color:gray;">Add Payslip</p>
                <hr style="margin-top:-15px;">
                <form action="{{url('payslip')}}" method="post">
                @csrf
                <div class="row clearfix mt-3 shadow" style="background:white;padding-top:18px;width:100%;margin-left:1px;"> 
                <div class="col-md-12">
      <h3 style="font-weight: bold;">Basic Information</h3>
                    <hr style="margin-top:-15px;">  
      </div>
                <div class="col-md-6">
                <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control form-control-sm" value="{{old('date')}}">
                            @error('date')
                                <label class="error">{{$errors->first('date')}}</label>
                            @enderror
                        </div>
                </div>
                <div class="col-md-6">
                <label>Select Employee</label>
                        <div class="form-group">
                            <select name="employee_id" id="employee_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option></option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? 'selected':null}}>{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <label class="error">{{$errors->first('employee_id')}}</label>
                            @enderror
                        </div>
                </div> 
                
                <div class="col-md-6">
                <label>Basic Monthly Pay</label>
                        <div class="form-group">
                            <input type="number" name="basic_monthly_pay" id="basic-pay" class="form-control form-control-sm">
                            @error('basic_monthly_pay')
                                <label class="error">{{$errors->first('basic_monthly_pay')}}</label>
                            @enderror
                        </div>
                </div>

            {{-- <div class="col-md-6">
            <label>Overtime</label>
                        <div class="form-group">
                            <input type="number" name="basic_monthly_pay" id="basic-pay" class="form-control form-control-sm">
                            @error('basic_monthly_pay')
                                <label class="error">{{$errors->first('basic_monthly_pay')}}</label>
                            @enderror
                        </div>
                </div> --}}

                <div class="col-md-6">

                <div class="form-group">
                            <label>Hours Deduction</label>
                            <input type="number" name="hours_deduction" class="form-control" value="{{old('hours_deduction')}}">
                            @error('hours_deduction')
                                <label class="error">{{$errors->first('hours_deduction')}}</label>
                            @enderror
                        </div>
                </div>
               <div class="col-md-6">
               <div class="form-group">
                            <label>Payable Amount</label>
                            <input type="number" name="payable_amount" id="pay-amount" class="form-control">
                            @error('payable_amount')
                                <label class="error">{{$errors->first('payable_amount')}}</label>
                            @enderror
                        </div>

               </div>
               <div class="col-md-6">
              

               <div class="form-group">
                            <label>Bonus</label>
                            <input type="number" name="bonus" id="bonus" class="form-control">
                            @error('bonus')
                                <label class="error">{{$errors->first('bonus')}}</label>
                            @enderror
                        </div>

               </div>
               <div class="col-md-6">
               <div class="form-group">
                            <label>Total</label>
                            <input type="number" name="total" id="total" class="form-control">
                            @error('total')
                                <label class="error">{{$errors->first('total')}}</label>
                            @enderror
                        </div>
               </div>
               <!-- <div class="col-md-6">
               <label>Payment Methods
               </label>
                        <div class="form-group">
                            <select name="employee_id" id="employee_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                <option></option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? 'selected':null}}>{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <label class="error">{{$errors->first('employee_id')}}</label>
                            @enderror
                        </div>
               </div> -->
               <div class="col-md-12">
               <div class="d-flex justify-content-center">
    <div id="margin" class="max-w-50 mt-4">
    <button type="submit" id="btn" class="btn btn-lg">Add Payslip</button>
    </div>
  </div>
               </div>
     
              

            </div>
                
             
                </div>
              
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
      
       $(document).ready(function(){
          $("#employee_id").on('change', function(){
               var val = $(this).val();
               
               

               $.ajax({
                    type: "post",
                    url:  "{{ url('payslip/salary') }}",
                    data : {
                        "_token" : "{{ csrf_token() }}",
                        "employee_id" : val,
                    },
                    success:function(data) {
                        var employee = JSON.parse(data);
                    $("#basic-pay").val(employee.salary);
                }
            });
          });
      });

</script>
@endpush

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
@stop


