@extends('layouts.master')
@section('title', 'Leave')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')
@include('layouts.alert_message')
<style>
    #emp-btn{
        background: linear-gradient(90deg, rgba(254,148,0,1) 0%, rgba(255,109,0,1) 100%) !important;
     }
     #emp-background{
       width: 103%;
       margin-left: -13px;
     }
     #card #body{
        background: #f0f0f0;
     }
     .modal .modal-header .close {
        font-size: 40px;
        color: black;
        margin: -35px;
     }
     .modal-content .modal-header {
        padding-bottom: 10px;
     }
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
        <div id="emp-background" class="container-fluid" style="background: #1D262D;padding:20px;">
           <div class="header-employee"  >
           
  <div class="d-flex justify-content-center">
    <div class="max-w-50 mt-3">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >All Leaves</h1>
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
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">Employee Name</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">Leave Type</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">From Date</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">to Date</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">Status</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">Reason</th>
                                <th class="text-center" style="border-right: none;color:#1D262D;background:white;font-weight:bold;">Action</th>
                            </tr>
                        </thead>
                     
                        <tbody>
                            @foreach ($leaves as $leave)
                            <tr class="text-center">
                               
                                <td>{{$leave->employee_id ? $leave->employee->first_name.' '.$leave->employee->middle_name.' '.$leave->employee->last_name : null}}</td>
                                <td>{{$leave->leave_type}}</td>
                                <td>{{\Carbon\Carbon::parse($leave->from_date)->format('j F, Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($leave->to_date)->format('j F, Y')}}</td>
                                <td>
                                    <!-- @if ($leave->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>

                                    @elseif($leave->status == 'approved')
                                        <span class="badge badge-success">Approved</span>

                                    @elseif($leave->status == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif -->
                                    <form class="card-body" action="{{url('leave-list/'.$leave->id)}}"  id="leave-form" method="post">
                        @method('PUT')
                        @csrf
                                    <select class="form-control-sm show-tick ms select2" id="status-select" @if($leave->status == "approved") style="border-radius:7px;background:#2B9EB3;color:white;" @elseif($leave->status == "pending") style="border-radius:7px;background:#0020AB;color:white;" @elseif($leave->status == "rejected") style="border-radius:7px;background:#F30006;color:white;" @endif>
                                    <option style="background: #E5F4FF;color:#1D262D;" value="pending" {{$leave->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option style="background: #E5F4FF;color:#1D262D;" value="approved" {{$leave->status == 'approved' ? 'selected' : ''}}>Approved</option>
                                <option style="background: #E5F4FF;color:#1D262D;" value="rejected" {{$leave->status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                                    </select>
                                    </form>
                                </td>
                                <td>{!!$leave->reason!!}</td>
                                <td>
<button style="background:#22A1CF;" data-toggle="modal" data-target="#exampleModal{{$leave->id}}" class="btn btn-sm w-100"><span><i class="zmdi zmdi-eye mr-1"></i></span> View</button>
                                    <!-- <x-options-buttons>
                                        <x-slot name="buttons">
                                            <li><a href="{{url('leave-list/'.$leave->id.'/edit')}}">Edit</a></li>
                                            <li>
                                                <a href="{{url('leave-list/'.$leave->id)}}" onclick="event.preventDefault();
                                                    document.getElementById('delete').submit();">Delete</a>
                                                <form id="delete" action="{{url('leave-list/'.$leave->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </li>
                                        </x-slot>
                                    </x-options-buttons> -->
                                </td>
                            </tr>
                            <div class="modal fade" id="exampleModal{{$leave->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom">
        <h5 class="modal-title" id="exampleModalLabel">Employee Leave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="info">

                    <p class="text-muted  d-inline">Employee Name:</p>
                    
                    <p style="font-weight: bold;"  class=" d-inline ml-2">{{$leave->employee_id ? $leave->employee->first_name.' '.$leave->employee->middle_name.' '.$leave->employee->last_name : null}}</p>
                </div>
                <div class="type mt-3">
                    <p class="text-muted  d-inline">Leave Type:</p>
                    <p style="font-weight: bold;" class="d-inline ml-2">{{$leave->leave_type}}</p>
                </div>
            </div>
            <div class="col-md-6 mt-3">
            <p class="text-muted  d-inline">From Date:</p>
            <p style="font-weight: bold;" class="d-inline ml-2">{{$leave->from_date ? date('j F, Y', strtotime($leave->from_date)) : null}}</p> 
            </div>
            <div class="col-md-6 mt-3">
            <p class="text-muted  d-inline">To Date:</p> 
            <p style="font-weight: bold;" class="d-inline ml-2">{{$leave->to_date ? date('j F, Y', strtotime($leave->to_date)) : null}}</p>
            </div>
            <div class="col-md-12 mt-3">
                <p style="font-weight:bold;">Reason:</p>
                <p class="text-muted">{!!$leave->reason!!}</p>
            </div>
            
            <form class="card-body" action="{{url('leave-list/'.$leave->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>Status</label>
                            <br>
                            <select name="status" class="form-control show-tick ms select2 w-25">
                                <option value="pending" {{$leave->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="approved" {{$leave->status == 'approved' ? 'selected' : ''}}>Approved</option>
                                <option value="rejected" {{$leave->status == 'rejected' ? 'selected' : ''}}>Rejected</option>
                            </select>
                            @error('status')
                                <label class="error">{{ $errors->first('status') }}</label>
                            @enderror
                        </div>
        
                                   </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                    <button style=" border: 1px solid #FE8415" type="submit" id="add-btn" class="btn btn-lg btn-outline-cutom btn-gradient">Save Changes</button>
                    </div>
                    </div>
                    
 <style>
    #add-btn{
        background-image:linear-gradient(90deg, rgba(254,148,0,1) 0%, rgba(255,109,0,1) 100%) ;   
        border-color: transparent;
        -webkit-background-clip: text;
    -moz-background-clip: text;
    -webkit-text-fill-color: transparent; 
    -moz-text-fill-color: transparent;
    }

    
 </style>
                </div>
                    </form>
        </div>
      </div>
      
    </div>
  </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
@push('after-scripts')
<script>
       const statusSelect = document.getElementById('status-select');
    statusSelect.addEventListener('change', () => {
        document.getElementById('leave-form').submit();
    });
</script>
@endpush
