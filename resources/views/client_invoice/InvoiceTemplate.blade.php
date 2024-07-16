<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <ul class="header-dropdown">
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{url('client-invoice')}}">All Invoice</a></li>
                            <li><a href="{{url('client-invoice-download')}}">Download Invoice</a></li>
                        </ul>
                    </li>
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            
            <style>
             /* Media Query for Mobile Devices */
   @media (max-width: 480px) {
    .graycol {
    text-align: start;
}
        }
        
           @media (max-width: 480px) {
    .headzero{
      margin: 0%;
    }
        }
          
                .marz{
                    margin: 0;
                }
                .brd{
                    text-align: end;
                    
                    border-right:solid 2px #80808057;
                }
                .divaction{
                    padding:10px;
                }
                .graycol{
                    color:gray;
                }
                .padbot{
                    padding-bottom:20px;
                }
                
                  @media (max-width: 480px) {
    .slipD{
      float: unset !important;
    }
        }
        
           @media (max-width: 480px) {
    .brd{
      border-right: 0;
    }
        }
            @media (max-width: 480px) {
    .martop{
      margin-top: 40px;
    }
        }
            </style>
            <div class="body" style="padding-left:20px !important;padding-right:20px !important;">
                
                <div class="row">
                    <div class="col-lg-4 col-xl-4 col-xxl-4 col-md-4 col-sm-6">
                        <img style="margin-right:20px;" src="{{asset('img/datech-logo.png')}}" width="50"/>
                        <h5 class="marz">Invoice No <span class="text-danger">{{$clientInvoice->invoice_no}}</span></h5>
                        <h5 class="marz">Sent:{{date('d F, Y', strtotime($clientInvoice->created_at))}}</h5>
                    </div>
                    
                    <div class="col-lg-8 col-xl-8 col-xxl-8 col-md-8 col-sm-6">
                        <div class="row martop" >
                            <div class="col-lg-7 col-xl-7 col-xxl-7 col-md-5 col-sm-7 brd">
                                
                                <div class="divaction graycol">
                                    <h5 class="headzero">To</h5>
                                </div>
                                    
                            </div>
                            <div class="col-lg-5 col-xl-5 col-xxl-5 col-md-7 col-sm-5">
                                
                                 <div class="divaction">
                                    <h5>Rajinder</h5>
                                    
                                    <div class="graycol">
                                         <h5 class="marz">Ali Khan</h5>
                                    <h5 class="marz">Ali Khan</h5>
                                    </div>
                                   
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="row" style="margin-top:15px">
                            <div class="col-lg-7 col-xl-7 col-xxl-7 col-md-5 col-sm-7 brd">
                                
                                <div class="divaction graycol">
                                    <h5 class="headzero">From</h5>
                                </div>
                                    
                            </div>
                            <div class="col-lg-5 col-xl-5 col-xxl-5 col-md-7 col-sm-5">
                                
                                 <div class="divaction">
                                    <h5>DA Tech</h5>
                                   





                                    
                                    <div class="graycol">
                                         <h5 class="marz">Asad Malik </h5>
  <h5 class="marz"> 5D 9/12 B, Ground Floor,</h5>
    <h5 class="marz">Nazimabad Block 5,</h5>
      <h5 class="marz">Karachi - 74600</h5>
         <h5 class="marz">NTN: 5409912-3</h5>
            <h5 class="marz">Phone: +92 304 8880004</h5>
               <h5 class="marz">Email: accounts@thedatech.com</h5>
                
                                    </div>
                                   
                                    
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    
                </div>
                
                <!--<div class="row">-->
                <!--    <div class="col-12" style="text-align:center;margin-top:50px;">-->
                <!--        <h5 class="mt-3" style="font-weight:600;">DA Tech</h5>-->
                <!--        <p>Plot 6/1 - 5A, Ground floor, Nazimabad Block 5-->
                <!--           Karachi, 74600<br>-->
                <!--           Mobile: +92 304 8880004<br>-->
                <!--           Email: dawn.asad@gmail.com</p>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row">-->
                <!--    <div class="col-12">-->
                <!--        <div class="border-style" style="text-align:center;">-->
                <!--            <p style="padding-top:8px;margin-bottom:8px;font-weight:600;">Billing Period: {{date('d F, Y', strtotime($clientInvoice->from_date))}} - {{date('d F, Y', strtotime($clientInvoice->to_date))}}</p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div class="row mt-3">-->
                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        <p><b>Bill To,</b></p>-->
                <!--        <table>-->
                <!--            <tr>-->
                <!--                <th style="padding-right:100px;padding-bottom:10px;">Invoice No</th>-->
                <!--                <td>{{$clientInvoice->invoice_no}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Name</th>-->
                <!--                <td>{{$clientInvoice->client->full_name}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Mobile #</th>-->
                <!--                <td>{{$clientInvoice->client->mobile_no}}</td>-->
                <!--            </tr>-->
                <!--            <tr>-->
                <!--                <th style="padding-bottom:10px;">Email</th>-->
                <!--                <td>{{$clientInvoice->client->email}}</td>-->
                <!--            </tr>-->
                <!--        </table>-->
                <!--    </div>-->

                <!--    <div class="col-md-6 col-sm-12">-->
                <!--        <p></p>-->
                <!--        <table>-->
                <!--            <tr>-->
                <!--                <th style="padding-right:100px;padding-bottom:10px;">Services</th>-->
                <!--                <td>{{$clientInvoice->task_module->module}}</td>-->
                <!--            </tr>-->
                <!--        </table>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="row mt-5 mb-5">
                    <div class="col-md-12">
                        <div>
                            <p style="padding-top:8px;margin-bottom:8px;font-weight:600;">Project Name: <span>Date here</span> </p>
                        </div>
                        
                          <div>
                             <p style="padding-top:8px;margin-bottom:8px;font-weight:600;">Billing Period: <span>Date here</span> </p>
                        </div>
                        
                      
                    </div>
                </div>

                <div class="row border-style">
                    <div class="col-md-6 col-md-12 ">
                        <div class="table-responsive">
                        <table class="table">
                            <thead  class="thead-light">
                            <tr>
                                <th>Description & Miscellaneous Work</th>
                                <th>Hours</th>
                                <th>Rate</th>
                                <th>Total</th>
                               
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientInvoiceDetail as $cid)
                                    <tr>
                                        <td>{{$cid->description}}</td>
                                        <td>{{$cid->quantity}}</td>
                                        <td>{{$cid->rate}}</td>
                                        <td>{{$cid->total}}</td>
                                       
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-bottom:1px solid rgb(185, 185, 185);">
                    <div class="col-lg-8 col-xl-8 col-xxl-8 col-md-8 col-sm-6">
                        <!--<div class="form-group">-->
                        <!--    <label><b>Notes</b></label>-->
                        <!--    <p>{{$clientInvoice->notes}}</p>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-4 col-xl-4 col-xxl-4 col-md-4 col-sm-6" >
                        <div class="slipD martop" style="float:right;padding: 10px; background-color: #f5f2f2;">
                        <table>
                            <tr>
                                <td style="padding-right:140px;">Discount</td>
                                <td>
                                    {{$clientInvoice->discount}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="color:green;"><b>Grand Total:</b></td>
                                <td><b>{{$clientInvoice->grand_total}}</b></td>
                            </tr>
                            <!--<tr>-->
                            <!--    <td style="color:green;"><b>Service Category:</b></td>-->
                            <!--    <td><b>{{$clientInvoice->task_module->module}}</b></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td style="color:green;"><b>Payment Mode:</b></td>-->
                            <!--    <td><b>Payment Mode</b></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td style="color:green;"><b>Notes:</b></td>-->
                            <!--    <td><b>{!!$clientInvoice->notes!!}</b></td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--    <td style="color:green;"><b>Remarks:</b></td>-->
                            <!--    <td><b>Remarks</b></td>-->
                            <!--</tr>-->
                        </table>
                        </div>
                    </div>
                    
                    <div>
                        
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                     
                          <h6>Service Category: <span class="ml-2">{{$clientInvoice->task_module->module}}</span></h6>
                            <h6>Payment Mode: <span class="ml-2">Payment Mode</span></h6>
                              <h6>Notes:<span class="ml-2">{!!$clientInvoice->notes!!}</span></h6>
                                 <h6>Remarks: <span class="ml-2">Remarks</span></h6>
                    </div>
                    
                    <div class="col-sm-12 mt-1" style="text-align:center">
                        
                        <small >It is a system generated invoice and does not need a signature.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
