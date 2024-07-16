@extends('layouts.master')
@section('title', 'Clients')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
@stop
@section('content')
<style>
     #btn{
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        color: black;
        font-weight:900;
     }
     #background{
       width: 103%;

       margin-left: -13px;
     }
     #card #body{
        background: #f0f0f0;
     }
      th{
        border-bottom: 1px solid #bbb8b8;
        color: #1D262D;
      }
     
</style>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card" id="card">
        <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
           <div class="header-employee"  >
           
  <div class="d-flex justify-content-center">
    <div class="max-w-50 mt-3">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >All Clients</h1>
    </div>
  </div>

           
          

            <div  class="container-fluid" >
                <div id="btn-row"  class="row d-flex justify-content-center">
                    <div class="col-md-2 w-100">
                        <a href="{{route('client.create')}}"><button id="btn" style="width: 100%" class="btn ">Add Client</button></a> 
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
            <div class="body shadow-lg" id="body">
                {{-- <div class="table-responsive"> --}}
                    <table class="admin-datatable table table-hover shadow-sm" style="width: 100%;background:white;">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="background: white;color:#1D262D;">Client Name</th>
                                <th class="text-center" style="background: white;color:#1D262D;">Contact</th>
                                <th class="text-center" style="background: white;color:#1D262D;">City / Country</th>
                                <th class="text-center" style="background: white;color:#1D262D;">Status</th>
                                <th class="text-center" style="background: white;color:#1D262D;">Action</th>
                            </tr>
                        </thead>
                   
                        <tbody>
                            @foreach ($clients as $client)
                                <tr class="text-center">
                                    <td>
                                        <!-- <x-options-buttons>
                                            <x-slot name="buttons">
                                                <li><a href="{{url('client-invoice/create/'.$client->id)}}">Add Invoice</a></li>
                                                <li><a href="{{url('client/'.$client->id.'/edit')}}">Edit</a></li>
                                                <li>
                                                    <a href="{{url('client/'.$client->id)}}" onclick="event.preventDefault();
                                                        document.getElementById('delete').submit();">Delete</a>
                                                    <form id="delete" action="{{url('client/'.$client->id)}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </li>
                                            </x-slot>
                                        </x-options-buttons> -->
                                        {{$client->full_name}}
                                    </td>
                                <td style="color: gray;">
                                    {{$client->email}}
                                    <br>
                                    {{$client->mobile_no}}
                                    <br>
                                    {{$client->skype}}


                                </td>
                                <td>{{$client->city}} / {{$client->country}}</td>
                                <td>{{$client->email}}</td>
                                <td>
                                    
                                <a  href="{{url('client/'.$client->id)}}"><button class="btn btn-primary btn-sm w-100"><span><i class="zmdi zmdi-eye mr-1"></i></span>  View</button></a>
                            <br>
                            <a  href="{{url('client/'.$client->id.'/edit')}}"><button class="btn btn-success btn-sm w-100"><span><i class="zmdi zmdi-edit mr-1"></i>
</span> Edit</button></a>
<br>
<a  href="{{url('client/'.$client->id)}}"><button class="btn btn-warning btn-sm w-100"><span><img src="{{asset('img/projects.png')}}" width="10" height="10" alt=""></span> Projects</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- </div> --}}
                </div>
@stop

@section('page=script')
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
