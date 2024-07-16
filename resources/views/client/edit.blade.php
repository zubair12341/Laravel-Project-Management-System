@extends('layouts.master')
@section('title', 'Client')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/fileuploader/font/font-fileuploader.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/fileuploader/jquery.fileuploader.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}"/>
@stop

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
    <h1  style="border-bottom: 1px solid white;color:white;font-weight:bold;" >Edit Client</h1>
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
            <p style="font-size: 20px;margin-top:-10px; color:gray;">Edit Client Profile</p>
                <hr style="margin-top:-15px;">
                <form action="{{url('client/'.$client->id)}}" method="post">
                    @method('put')
                    @csrf

                    <div class="row clearfix shadow" style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                    <div class="col-md-12">
      <h3 style="font-weight: bold;">Basic Information</h3>
                    <hr style="margin-top:-15px;">  
      </div>
      <div class="col-md-6">
      <div class="form-group">
                            <label>Full Name<span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control form-control-sm" value="{{$client->full_name}}">
                            @error('full_name')
                                <label class="error">{{$errors->first('full_name')}}</label>
                            @enderror
                        </div>
      </div>
      <div class="col-md-6">
      <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control form-control-sm" value="{{$client->email}}">
                            @error('email')
                                <label class="error">{{ $errors->first('email') }}</label>
                            @enderror
                        </div>
      </div>
      <div class="col-md-6">
      <label>Gender</label>
                   
      <div class="form-group">
                        <select  name="gender" class="form-control form-control-sm show-tick" >
                        <option value="male" {{$client->gender == 'male' ? 'selected':null}}>Male</option>
                                <hr>
                          <option value="female" {{$client->gender == 'female' ? 'selected':null}}>Female</option>
                        </select>
                            <br>
                            @error('gender')
                                <label class="error">{{$errors->first('gender')}}</label>
                            @enderror
                        </div>
      </div>
      <div class="col-md-6">
                              
                              <div class="form-group">
                                 <label for="">State</label>
                                 <select  name="state_province" class="form-control form-control-sm show-tick" >
                                 <option value="uae" {{$client->state_province == 'uae' ? 'selected' : null}}>UAE</option>
                                         <hr>
                                   <option value="europe"  {{$client->state_province == 'europe' ? 'selected' : null}}>Europe</option>
                                   <option value="usa" {{$client->state_province == 'usa' ? 'selected' : null}}>USA</option>
                                   <option value="asia"  {{$client->state_province == 'asia' ? 'selected' : null}}>Asia</option>
                                 </select>
                                 
                                  <br>
                                  @error('state_province')
                                      <label class="error">{{$errors->first('state_province')}}</label>
                                  @enderror
                              </div>
                                 </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control form-control-sm" value="{{$client->country}}">
                            @error('country')
                                <label class="error">{{ $errors->first('country') }}</label>
                            @enderror
                        </div>
                                 </div>
                                 <div class="col-md-6">
                                 <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control form-control-sm" value="{{$client->city}}">
                            @error('city')
                                <label class="error">{{ $errors->first('city') }}</label>
                            @enderror
                        </div>
                                 </div>
                                 <div class="col-md-12">
                                 <div class="form-group">
                                <label for="">Source</label>
                                <select name="source" id="select1" class="form-control form-control-sm show-tick">
                                    <option value="Guru"  {{$client->source == 'Guru' ? 'selected' : null}}>Guru
                                        <hr>
                                    </option>

                                    <option value="Fiverr"  {{$client->source == 'Fiverr' ? 'selected' : null}}>Fiverr</option>
                                    <option value="Upwork"  {{$client->source == 'Upwork' ? 'selected' : null}}>Upwork</option>
                                    <option value="Direct"  {{$client->source == 'Direct' ? 'selected' : null}}>Direct</option>
                                    <option value="Referred" {{$client->source == 'Referred' ? 'selected' : null}}>Referred</option>
                                    

                                </select>

                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea type="text" name="address" rows="5" class="form-control form-control-sm">{{$client->address}}</textarea>
                            @error('address')
                                <label class="error">{{ $errors->first('address') }}</label>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-12">
        <label >Upload Profile Picture</label>
        <div class="form-group">
                                    <input type="file" name="profile_image" class="dropify" data-allowed-file-extensions="png jpg jpeg" accept=".png, jpg, .jpeg" data-default-file="{{$client->profile_image ? asset('storage/client_profile_images/'.$client->profile_image) : asset('img/no_image.png')}}">
                                </div>
      </div>
                    </div>

                    <div class="row clearfix shadow mt-3" style="background:white;padding-top:18px;width:100%;margin-left:1px;" >
                    <div class="col-md-12">
      <h3 style="font-weight: bold;">Contact Information</h3>
                    <hr style="margin-top:-15px;">  
      </div>      
                    <div class="col-md-6">
                      <div class="form-group">
                            <label>Mobile No</label>
                            <input type="text" name="mobile_no" class="form-control form-control-sm" value="{{$client->mobile_no}}">
                            @error('mobile_no')
                                <label class="error">{{ $errors->first('mobile_no') }}</label>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                            <label>Skype</label>
                            <input type="text" name="skype" class="form-control form-control-sm" value="{{$client->skype}}">
                            @error('skype')
                                <label class="error">{{ $errors->first('skype') }}</label>
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                      <div class="form-group">
                            <label>Payment Resource</label>
                            <select name="payment_resource" class="form-control form-control-sm">
                                <option value="paypal" {{$client->payment_resource == 'paypal' ? 'selected' : null}}>PayPal</option>
                                <option value="guru" {{$client->payment_resource == 'guru' ? 'selected' : null}}>Guru</option>
                                <option value="fiverr" {{$client->payment_resource == 'fiverr' ? 'selected' : null}}>Fiverr</option>
                                <option value="upwork" {{$client->payment_resource == 'upwork' ? 'selected' : null}}>Upwork</option>
                                <option value="payoneer" {{$client->payment_resource == 'payoneer' ? 'selected' : null}}>Payoneer</option>
                                <option value="bank transfer" {{$client->payment_resource == 'band transfer' ? 'selected' : null}}>Bank Transfer</option>
                            </select>
                            @error('payment_resource')
                                <label class="error">{{ $errors->first('payment_resource') }}</label>
                            @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row clearfix mt-3 shadow" style="background:white;padding-top:18px;width:100%;margin-left:1px;" >
           
                <div class="col-md-12">
      <h3 style="font-weight: bold;">Comments</h3>
                    <hr style="margin-top:-15px;">  
      </div>   
              
                <div class="col-md-12">
                    
                <div class="form-group">
                          
                            <textarea type="text" name="note" class="summernote">{{$client->note}}</textarea>
                            @error('note')
                                <label class="error">{{ $errors->first('note') }}</label>
                            @enderror
                        </div>
                </div>
                </div>
                 
                <div class="container">
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" class="btn btn-lg" id="btn">Save Changes</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-script')
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/dist/summernote.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
<script src="{{asset('assets/js/plupload.full.min.js')}}"></script>
<script src="{{asset('assets/plugins/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.min.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploader/jquery.fileuploader.min.js')}}"></script>
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
@stop

@push('after-scripts')
<script>
    // enable fileuploader plugin
    $('#fileuploader').fileuploader({
            addMore: true
    });
</script>
@endpush
