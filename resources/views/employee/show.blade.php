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
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >Profile</h1>
    </div>
  </div>
               
  <ul class="header-dropdown mt-5">

<button id="btn" type="button" class="btn btn-primary" style="padding: inherit;margin-top: 140px;">
<li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;" href="{{url('employee')}}">All Employee</a></li>
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
            <a href="{{url('employee/'.$employee->id.'/edit')}}"><button style=" border: 1px solid #FE8415;margin-top:-4px;" id="add-btn" class="d-inline btn float-right mb-1">Edit Profile</button></a>
             <div class="row clearfix shadow mt-3" style="background:white;padding-top:18px;width:100%;margin-left:1px;">
               <div class="col-md-4 mt-3">
                <div class="d-flex justify-content-center">
                <div class="imp-info" >
                <a href="javascript:void(0);">
                    <img src="{{$employee->profile_image ? $employee->profile_image : asset('img/no_image.png')}}" class="rounded-circle" alt="profile-image" width="250" height="250">
                </a>
           
              
                <h2 class="font-weight-bold mt-4">{{$employee->first_name.' '.$employee->middle_name.' '.$employee->last_name}}</h2>
                <p class="text-muted text-center mr-3 mb-4" style="margin-top: -24px;">{{$employee->employee_no}}</p>
                </div>
                </div>
             
             
               </div>
               <div class="col-md-8">
                  <h4 style="font-weight: bold;">Basic Information</h4>
                    <hr style="margin-top:-10px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                       
                    <h6 >Email</h6>  
                    <p class="text-muted">{{$employee->email}}</p>
                
                    <h6>Gender</h6>
                    <p class="text-muted">{{$employee->gender}}</p>
                    <h6>Marital Status</h6>
                    <p class="text-muted">{{$employee->marital_status}}</p>
                    <h6>Salary</h6>
                    <p class="text-muted">{{$employee->salary}}</p>
                    <h6>Source</h6>
                    <p class="text-muted">{{$employee->source}}</p>
                            </div>
                            <div class="col-sm-6">
                            <h6>Cnic Number</h6>
                            <p class="text-muted">{{$employee->cnic}}</p>
                            <h6>Date Of Birth</h6>
                            <p class="text-muted">{{$employee->date_of_birth ? date('j F, Y', strtotime($employee->date_of_birth)) : null}}</p>
                            <h6>Nationality</h6>
                            <p class="text-muted">{{$employee->nationality}}</p>
                            <h6>Qualification</h6>
                            <p class="text-muted">{{$employee->qualification}}</p>
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
                    <p class="text-muted">{{$employee->mobile_no}}</p>
                    <h6>Emergency Contact</h6>
                    <p class="text-muted">{{$employee->emergency_contact}}</p>
                    <h6>Home Phone</h6>
                    <p class="text-muted">{{$employee->home_phone}}</p>
                    <h6>Address</h6>
                    <p class="text-muted">{{$employee->address}}</p>
                    <h6>City</h6>
                    <p class="text-muted">{{$employee->city}}</p>
                    <h6>Country</h6>
                    <p class="text-muted">{{$employee->country}}</p>
                    <h6>Postal / Zip Code</h6>
                    <p class="text-muted">{{$employee->postal_code}}</p>
               </div>
             
               <div class="col-md-8 shadow" style="background: white;">
               <h4 class="mt-2" style="font-weight: bold;">Job Info / Stauts</h4>
                    <hr style="margin-top:-10px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                           <h6>Job Status</h6>
                           <p class="text-muted">{{$employee->job_status}}</p>
                           <h6>Supervisor</h6>
                           @php
                           if(isset($employee->employee_id)&&$employee->employee_id!=null)
                           {

                               $u=DB::table('users')->where('id',$employee->employee_id)->first();
                               $emp=DB::table('employees')->where('id',$u->employee_id)->first();
                           }
                           @endphp
                           {{-- @dump($emp) --}}
                           <p class="text-muted">{{isset($emp) ? $emp->first_name.' '.$emp->last_name : null}}</p>
                           @if ($employee->job_status == 'Full Time' || $employee->job_status == 'Part Time' || $employee->job_status == 'Remote')
                                <h6 >Probation Period Start: </h6>
                                <p class="text-muted">{{$employee->probation_period_start ? date('j F, Y', strtotime($employee->probation_period_start)):null}}</p>
                               
                                @endif

                                @if ($employee->job_status == 'Internship')
                                <h6 >Internship Period Start: </h6>
                                <p class="text-muted">{{$employee->internship_period_start ? date('j F, Y', strtotime($employee->internship_period_start)):null}}</p>
                               
                                @endif
                                <h6>Working Time Start</h6>
                                <p class="text-muted">{{$employee->working_time_start ? date('g:i a', strtotime($employee->working_time_start)):null}}</p>
                                <h6>Termination Date</h6>
                                <p class="text-muted">{{$employee->termination_date ? date('j F, Y', strtotime($employee->termination_date)):null}}</p>
                            </div>
                            <div class="col-sm-6">
                             <h6>Designation</h6>
                             <p class="text-muted">{{$employee->designation_id ? $employee->designation->title:null}}</p>
                             <h6>Date Of Joining</h6>
                             <p class="text-muted">{{$employee->joining_date ? date('j F, Y', strtotime($employee->joining_date)):null}}</p>
                             @if ($employee->job_status == 'Full Time' || $employee->job_status == 'Part Time' || $employee->job_status == 'Remote')
                                
                                <h6 >Probation Period End: </h6>
                                <p class="text-muted">{{$employee->probation_period_end ?  date('j F, Y', strtotime($employee->probation_period_end)):null}}</p>
                                @endif

                                @if ($employee->job_status == 'Internship')
                               
                                <h6 >Internship Period End: </h6>
                                <p class="text-muted">{{$employee->probation_period_end ? date('j F, Y', strtotime($employee->internship_period_end)):null}}</p>
                                @endif
                                <h6>Working Time End</h6>
                                <p class="text-muted">{{$employee->working_time_end ? date('g:i a', strtotime($employee->working_time_end)):null}}</p>
                            </div>
                        </div>
                    </div>

               </div>
             </div> 
             <div class="row clearfix mt-4"  style="padding-top:18px;width:100%;margin-left:1px;">
               <div class="col-md-4 shadow" style="background: white;">
                   <h4 class="mt-2" style="font-weight: bold;">Document / Attachments</h4>
                    <hr style="margin-top:-10px;">
                    @if(!$employeeDocs->isEmpty())
                                @foreach ($employeeDocs as $empdoc)
                                <p class="display:flex;">
                                <i style="font-size: 25px;" class="zmdi zmdi-folder"></i>&nbsp;<a href="{{url('emp-doc-download/'.$empdoc->id)}}">{{$empdoc->file}}</a> <a href="javascript:void(0);" class="delete-doc remove" data-id="{{url('emp-doc-delete/'.$empdoc->id)}}"><i data-toggle="tooltip" title="Delete" class="far fa-trash text-danger"></i></a>
                                </p>
                                @endforeach
                            @else
                                <small class="text-muted"><br><i>--No uploaded files--</i></small>
                            @endif
               </div>
               <div class="col-md-8 shadow" style="background: white;">
             <h4 class="mt-2" style="font-weight: bold;">Review</h4>
                    <hr style="margin-top:-10px;">
                    <p>{!!$employee->notes!!}</p>
             </div>
             </div>
            
           
            </div>
    </div>
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


@stop
