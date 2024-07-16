@extends('layouts.master')
@section('title', 'Payslip')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
@stop
@section('content')

<style>
         #btn{
        background: linear-gradient(90deg, rgba(254,148,0,1) 0%, rgba(255,109,0,1) 100%) !important;
        color: black;
        font-weight: 900;
     }
     #background{
       width: 103%;
       margin-left: -13px;
     }
     #card #body{
        background: #f0f0f0;
     }
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
            
        <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
           <div class="header-employee"  >
           
  <div class="d-flex justify-content-center">
    <div class="max-w-50 mt-3">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >All Payslips</h1>
    </div>
  </div>

           
          

            <div  class="container-fluid" >
                <div id="btn-row"  class="row d-flex justify-content-center">
                <div class="col-md-2">
                        <a href="{{route('payslip.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Payslips</button></a>
                    </div>
                    <div class="col-md-2 ">
                        <a href="{{route('employee.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Employee</button></a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('payslip.index')}}"><button id="btn" style="width: 100%" class="btn ">All Payslips</button></a>
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
            <p style="font-size: 20px;margin-top:-10px; color:gray;">All</p>
                <hr style="margin-top:-15px;">
                <div class="row" style="background:white;">
                      <div class="banner-box">
                   <div class="container mt-5">
                    <div class="row">
                        <div class=" col-sm-12 col-lg-8 col-xl-8 col-xxl-8 col-md-8 grid-con" id="user_info">
                            <h1 class="pay-title">PAYSLIP</h1>
                            <p >PAYSLIP ID:1001</p>
                            <br>
                            <h3 class="date-tt">DATE</h3>
                            <p>07-July-2022</p>

                            <h3 class="invoice-tt">EMPLOYEE</h3>
                             <div class="row">
                    <div class="col-md-6 col-sm-12">
                        {{-- <p><b>Bill To,</b></p> --}}
                        <table>
                            <!--<tr>-->
                            <!--    <th style="padding-right:100px;padding-bottom:10px;">Employee No</th>-->
                            <!--    <td>{{$payslip->employee->employee_no}}</td>-->
                            <!--</tr>-->
                            <tr>
                                <th>Name:</th>
                                <td>{{$payslip->employee->first_name.' '.$payslip->employee->middle_name.' '.$payslip->employee->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Mobile:</th>
                                <td>{{$payslip->employee->mobile_no}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{$payslip->employee->email}}</td>
                            </tr>
                            <tr>
                                <th>CNIC:</th>
                                <td>{{$payslip->employee->cnic}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        {{-- <table>
                            <tr>
                                <th style="padding-right:100px;padding-bottom:10px;">Services</th>
                                <td>{{$clientInvoice->task_module->module}}</td>
                            </tr>
                        </table> --}}
                    </div>
                </div>
                            
                        <!--    <p>Muhammad Farhan<br>-->
                        <!--    CNIC:4210-5057686-3<BR>-->
                        <!--    Mob: +923412074894<br>-->
                        <!--Email:farhan@thedatech.com</p>-->
                        </div>
                    <div class="col-lg-4 col-xl-col-4 col-xxl-4 col-md-4 col-sm-12" id="company_info">
                        <img src="{{asset('img/datechhlogo.png')}}" id="imges"/>
                        <strong> <h3 class="slip_7">DA TECH</h3></strong>
                         <p class="slip_2">Plot 5D 9/12 B, Ground Floor,<br>
                                     Nazimabad Block 5,<br>
                                     Karachi-74600<br>
                                     Mobile: +923048880004<br>
                                     Email: hr@thedatech.com
                                     </p>
                    </div>
                </div>
                  </div>
                   </div>
<style>
img#imges {
    width: 70%;
}
h1.pay-title {
    font-size: 30px;
    font-weight: 900;
    margin:auto;
}

    p.slip_2 {
    font-weight: 600;
}
h3.slip_7 {
    margin:auto;
    font-size: 19px;
    font-weight: 900;
    margin-top: 18px;
    margin-bottom: auto;
}
.banner-box {
   
    background-image: url("/img/header1_1.png");
    background-size: cover;
    background-repeat: no-repeat;
    padding-top: 12px;
    padding-bottom: 170px;

}
 td.line1 {
    width: 90%;
    border: solid 1px;
    font-weight: 500;
    font-size:18px;
}
td.line2 {
    width: 90%;
    border: solid 1px;
    text-align: start;
    font-weight: 500;
    font-size:18px;
}
p.slip_12 {
    text-align: center;
    font-family: cursive;
    margin-top: 100px;
}
.footer-sec {
    background-image: url("/img/footer1_1.png");
    background-size: cover;
    background-repeat: no-repeat;
    padding-top: 150px;
    padding-bottom: 220px;
}
h3.slip1_1 {
    margin-bottom: auto;
}
h3.slip2_2 {
    float: right;
    margin: auto;
}
h3.invoice-tt {
    margin-top: 100px;
    font-size: 18px;
    font-weight: 600;
    margin:auto;
}
h3.date-tt {
    font-size: 18px;
    font-weight: 600;
    margin:auto;
}
</style>
                <div class="row">
                    <div class="col-12">
                        <div class="border-style" style="text-align:center;">
                            <p style="padding-top:8px;margin-bottom:8px;font-weight:600;">Payslip for {{date('F - Y', strtotime($payslip->date))}}</p>
                        </div>
                    </div>
                </div>

                <!--<div class="row mt-3">-->
                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        {{-- <p><b>Bill To,</b></p> --}}-->
                <!--        <table>-->
                <!--            <tr>-->
                <!--                <th style="padding-right:100px;padding-bottom:10px;">Employee No</th>-->
                <!--                <td>{{$payslip->employee->employee_no}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Name</th>-->
                <!--                <td>{{$payslip->employee->first_name.' '.$payslip->employee->middle_name.' '.$payslip->employee->last_name}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Mobile #</th>-->
                <!--                <td>{{$payslip->employee->mobile_no}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Email</th>-->
                <!--                <td>{{$payslip->employee->email}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">CNIC</th>-->
                <!--                <td>{{$payslip->employee->cnic}}</td>-->
                <!--            </tr>-->
                <!--        </table>-->
                <!--    </div>-->

                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        {{-- <table>-->
                <!--            <tr>-->
                <!--                <th style="padding-right:100px;padding-bottom:10px;">Services</th>-->
                <!--                <td>{{$clientInvoice->task_module->module}}</td>-->
                <!--            </tr>-->
                <!--        </table> --}}-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row mt-5">-->
                <!--    <div class="col-md-12">-->
                <!--        <p style="padding-top:8px;margin-bottom:8px;font-weight:600;">Salary Details:</p>-->
                <!--    </div>-->
                <!--</div>-->
     
                                              <div class="container topbtom">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table mb-4">
                                                    <tbody class="border">
                                                      <tr class="border2">
                                                        <td class="line1">Basic Monthly Pay</td>
                                                        <td class="line2">{{$payslip->basic_monthly_pay}}</td>
                                                      </tr>
                                                      <tr class="border2">
                                                        
                                                        
                                                        <td class="line1">Short Hours Deduction </td>
                                                        <td class="line2">{{$payslip->hours_deduction}}</td>
                                                      </tr>
                                                      <tr class="border2">
                                                        
                                                        
                                                        <td class="line1">Late Arrivals</td>
                                                        <td class="line2">15 Days</td>
                                                      </tr>
                                                      <tr class="border2">
                                                        
                                                        
                                                        <td class="line1">Late Arrival Deduction</td>
                                                        <td class="line2">0/-</td>
                                                      </tr>
                                                      <tr class="border2">
                                                        <td class="line1">Payable Amount</td>
                                                        <td class="line2">{{$payslip->payable_amount}}</td>
                                                      </tr>                                                
                                                    </tbody>
                                                  </table>
                                                  <table class="table mt-2">
                                                    <thead>
                                                      <h3 class="slip1_1">Additional and Extras</h3>
                                                    </thead>
                                                    <tbody class="border">
                                            
                                                      <tr class="border2">
                                                        <td class="line1">Bonus</td>
                                                        <td class="line2">{{$payslip->bonus}}</td>
                                                      </tr>
                                                         
                                                    </tbody>
                                                  </table>
                                                  
                                                  <table class="table mt-5">
                                                      
                                                    <tr class="border2">
                                                        <td class="line1">Total</td>
                                                        <td class="line2">{{$payslip->total}}</td>
                                                      </tr>
                                                      <tr class="border2">
                                                        <td class="line1">Payment Method</td>
                                                        <td class="line2">Cash</td>
                                                      </tr>                                       
                                                    </tbody>
                                                  </table>
                                            </div>
                                        </div>
                        </div>
                                                <div>
                          <p class="slip_12">It is system generated and does not need signature. </p>
                      </div>
                        <!-- this si footer sec -->
                            <div class="footer-sec" >                                                     
                            </div>
                                                      
     
                <!--<div class="row border-style">-->
                <!--    <div class="col-md-6 col-md-12 ">-->
                <!--        <div class="table-responsive">-->
                <!--        <table class="table">-->
                <!--            <thead  class="thead-light">-->
                <!--            <tr>-->
                <!--                <th>Earnings</th>-->
                <!--                <th>Rs.</th>-->
                <!--                <th>Deduction</th>-->
                <!--                <th>Hours.</th>-->
                <!--            </tr>-->
                <!--            </thead>-->
                <!--            <tbody>-->
                <!--                <tr>-->
                <!--                    <td>Basic Monthly Pay</td>-->
                <!--                    <td>{{$payslip->basic_monthly_pay}}</td>-->
                <!--                    <td class="text-danger">Hours Deduction</td>-->
                <!--                    <td class="text-danger">{{$payslip->hours_deduction}}</td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <td>Bonus</td>-->
                <!--                    <td>{{$payslip->bonus}}</td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <td><b>Payable Amount</b></td>-->
                <!--                    <td><b>{{$payslip->payable_amount}}</b></td>-->
                <!--                </tr>-->
                <!--                <tr style="background-color: #e9e7e7;">-->
                <!--                    <td><b>Net Pay</b></td>-->
                <!--                    <td></td>-->
                <!--                    <td></td>-->
                <!--                    <td><b>{{$payslip->total}}</b></td>-->
                <!--                </tr>-->
                <!--            </tbody>-->
                <!--        </table>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--{{-- <div class="row" style="border-bottom:1px solid rgb(185, 185, 185);">-->
                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        <div class="form-group">-->
                <!--            <label><b>Notes</b></label>-->
                <!--            <p>{{$clientInvoice->notes}}</p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        <div style="float:right;background-color: #f5f2f2;padding: 25px;">-->
                <!--        <table>-->
                <!--            <tr>-->
                <!--                <td style="padding-right:140px;">Discount</td>-->
                <!--                <td>-->
                <!--                    {{$clientInvoice->discount}}-->
                <!--                </td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <td></td>-->
                <!--                <td></td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <td style="color:green;"><b>Grand Total</b></td>-->
                <!--                <td><b>{{$clientInvoice->grand_total}}</b></td>-->
                <!--            </tr>-->
                <!--        </table>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div> --}}-->
                <!--<div class="row">-->
                <!--    <div class="col-sm-12 mt-3">-->
                <!--        <small>It is system generated and does not need signature.</small>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
@stop
@section('page-script')

@stop
