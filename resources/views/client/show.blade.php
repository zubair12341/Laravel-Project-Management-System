@extends('layouts.master')
@section('title', 'Profile')
@section('content')

<style>
               #background{
       width: 103%;
       margin-left: -13px;
     }

     #card #body{
        background: #f0f0f0;
     }
     #margin{
        margin-bottom: 7rem!important;
     }
     #btn{
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        color: black;
        font-weight: 900;
        border-radius: 10px;
     }
     .fileuploader-input .fileuploader-input-button{
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
     }
     .fileuploader-input .fileuploader-input-caption{
        color: gray !important;
     }
    
</style>
<div class="row clearfix">
<div class="col-lg-12">
    <div class="card" id="card">
    <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
            <div class="header">
            <div class="d-flex justify-content-center">
    <div id="margin" class="max-w-50 ">
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >Client Profile</h1>
    </div>
  </div>
               
  <ul class="header-dropdown mt-5">

<button id="btn" type="button" class="btn btn-primary" style="padding: inherit;margin-top: 140px;">
<li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;" href="{{url('client')}}">All Clients</a></li>
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
            <p class="d-inline" style="font-size: 20px;margin-top:-10px; color:black;font-weight:bold;">Profile</p>
            <a href="{{url('client/'.$client->id.'/edit')}}"><button style=" border: 1px solid #FE8415;margin-top:-4px;" id="add-btn" class="d-inline btn float-right mb-1">Edit Profile</button></a>
             <div class="row clearfix shadow mt-3" style="background:white;padding-top:18px;width:100%;margin-left:1px;">
               <div class="col-md-4 mt-3">
                <div class="d-flex justify-content-center">
                <div class="imp-info" >
                <a href="javascript:void(0);">
                    <img src="{{$client->profile_image ? asset('storage/profile_images/'.$client->profile_image) : asset('img/no_image.png')}}" class="rounded-circle" alt="profile-image" width="250" height="250">
                </a>
           
              
                <h2 class="font-weight-bold mt-4">{{$client->full_name}}</h2>

                </div>
                </div>
             
             
               </div>
               <div class="col-md-8">
                  <h4 style="font-weight: bold;">Basic Information</h4>
                    <hr style="margin-top:-10px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                       
                    <h6 >Gender</h6>  
                    <p class="text-muted">{{$client->gender}}</p>
                
                    <h6>Source</h6>
                    <p class="text-muted">Something</p>
                    <h6>State</h6>
                    <p class="text-muted">{{$client->state_province}}</p>
            
                    <h6>Payment Source</h6>
                    <p class="text-muted">{{$client->payment_resource}}</p>
                            </div>
                            <div class="col-sm-6">
                            <h6>Address</h6>
                            <p class="text-muted">{{$client->address}}</p>
                            <h6>City</h6>
                            <p class="text-muted">{{$client->city}}</p>
                            <h6>Country</h6>
                            <p class="text-muted">{{$client->country}}</p>
                            
                            </div>

                        </div>
                    </div>
            
                
               </div>
             </div>
             <div class="row clearfix mt-3" style="padding-top:18px;width:100%;margin-left:1px;">
               <div class="col-md-4 shadow " style="background: white;margin-right:0px">
               <h4 class="mt-2" style="font-weight: bold;">Contact Details / Address</h4>
                    <hr style="margin-top:-10px;">

                    <h6>Mobile no.</h6>
                    <p class="text-muted">{{$client->mobile_no}}</p>
                    <h6>Skype</h6>
                    <p class="text-muted">{{$client->skype}}</p>
                    <h6>Email</h6>
                    <p class="text-muted">{{$client->email}}</p>
               </div>
             
               <div class="col-md-8 shadow" style="background: white;">
               <h4 class="mt-2" style="font-weight: bold;">Remarks</h4>
                    <hr style="margin-top:-10px;">
                   <h6>Remarks</h6>
                   <p class="text-muted">{{$client->note}}</p>

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
    </div>
</div>
</div>



@stop
