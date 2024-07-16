@extends('layouts.master')
@section('title', 'Payslips')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
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
     .btn-group button i{
        font-size: 17px;
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
                    <div class="col-md-2 w-100">
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
            <div class="body" id="body">
                <div class="table-responsive">
                    <table class="admin-datatable table table-hover shadow-sm" style="width:100%;background:white;">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Employee No</th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Employee Name</th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Date</th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Month</th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Amount Payable</th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Status </th>
                                <th class="text-center" style="border-right: none;font-weight:bold;color:#1D262D;">Action</th>
                            </tr>
                        </thead>
                  
                        <tbody>
                            @foreach ($payslips as $payslip)
                            <tr>
                                <td class="text-center"> 
                                {{-- {{$payslip->employee_id ? $payslip->employee->employee_no : !null}}     --}}

                                {{$payslip->employee_id}}    
                                </td>
                                <td class="text-center">{{$payslip->employee_id ? $payslip->first_name.' '.$payslip->middle_name.' '.$payslip->last_name : null}}</td>
                                <td class="text-center">{{$payslip->date ? date('d F, Y', strtotime($payslip->date)) : null}}</td>
                                <td class="text-center">{{$payslip->date ? date('M', strtotime($payslip->date)) : null}}</td>
                                <td class="text-center">{{$payslip->payable_amount}}</td>
                                <td class="text-center">
                                    <select style="border-radius: 7px;" class="form-control-sm show-tick ms select2">
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </td>
                                <td class="text-center"><div class="btn-group"  role="group" aria-label="Basic example">
  <button type="button" style="background: #1A0C81;" class="btn btn-sm"><i class="zmdi zmdi-download "></i></button>
  <button type="button" style="background: #22A1CF;" class="btn btn-sm"><i class="zmdi zmdi-edit mr-1"></i></button>
  <button type="button" class="btn btn-success btn-sm"><a href="{{url('payslip/'.$payslip->id)}}"><i  style="color:white;" class="zmdi zmdi-eye mr-1"></i></a></button>
  <button type="button" style="background: #38C38D;" class="btn btn-sm"><i class="zmdi zmdi-mail-send"></i></button>
</div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{url('payslip/'.$payslip->id)}}">View</a></li>
                                            <li>
                                                <a href="{{url('payslip/'.$payslip->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();">Delete</a>
                                                <form id="delete" action="{{url('payslip/'.$payslip->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </li>
                                        </x-slot>
                                    </x-options-buttons> -->

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
