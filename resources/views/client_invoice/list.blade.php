@extends('layouts.master')
@section('title', 'Invoices')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')
<style>
         #btn{
        background: linear-gradient(90deg, rgba(254,148,0,1) 0%, rgba(255,109,0,1) 100%) !important;
        color: black;
        font-weight:900;
     }
     #background{
       width: 103%;

       margin-left: -13px;
     }
     
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
        <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
           <div class="header-employee"  >
           
  <div class="d-flex justify-content-center">
    <div class="max-w-50 mt-3">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >All Invoices</h1>
    </div>
  </div>

           
          

            <div  class="container-fluid" >
                <div id="btn-row"  class="row d-flex justify-content-center">
                    <div class="col-md-2 w-100">
                        <a href="{{route('client.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Client</button></a> 
                    </div>
                    <div class="col-md-2">
                        <a href="{{url('client-invoice')}}"><button id="btn" style="width: 100%" class="btn ">All Invoices</button></a> 
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('client-invoice.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Invoices</button></a> 
                    </div>
                    <div class="col-md-2">
                        <a href="{{url('project')}}"><button id="btn" style="width: 100%" class="btn">All Projects</button></a> 
                    </div>
                     <div class="col-md-2">
                        <a href="{{url('project/create')}}"><button id="btn" style="width: 100%" class="btn ">Add Projects</button></a> 
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
            <div class="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover" style="width:100%;">
                        <thead class="thead-light">
                            <tr>
                                <th>Options</th>
                                <th>Client</th>
                                <th>Invoice No</th>
                                <th>Billing Period</th>
                                <th>Services</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Options</th>
                                <th>Client</th>
                                <th>Invoice No</th>
                                <th>Billing Period</th>
                                <th>Services</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($clientInvoices as $clientInvoice)
                            <tr>
                                <td>
                                    <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{url('client-invoice/'.$clientInvoice->id)}}">View</a></li>
                                            <li><a href="{{url('client-invoice-download/'.$clientInvoice->id)}}">Download</a></li>
                                            <li><a href="{{url('client-invoice/'.$clientInvoice->id.'/edit')}}">Edit</a></li>
                                            <li>
                                                <a href="{{url('client-invoice/'.$clientInvoice->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();">Delete</a>
                                                <form id="delete" action="{{url('client-invoice/'.$clientInvoice->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </li>
                                        </x-slot>
                                    </x-options-buttons>
                                </td>
                                <td>{{$clientInvoice->client->full_name}}</td>
                                <td>{{$clientInvoice->invoice_no}}</td>
                                <td><b>From:</b> {{date('j F, Y', strtotime($clientInvoice->from_date)) ?? null}} <br> <b>To:</b> {{$clientInvoice->to_date ? date('j F, Y', strtotime($clientInvoice->to_date)):null}}</td>
                                <td>{{$clientInvoice->task_module->module}}</td>
                                <td>
                                    
                             @if ($clientInvoice->status == 'Pending' )
                                    <span class="badge badge-warning">Pending </span>
                                    @elseif($clientInvoice->status == 'Paid' )
                                    <span class="badge badge-success">Paid</span>
                             @endif
                                </td>
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
