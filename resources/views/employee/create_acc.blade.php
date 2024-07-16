@extends('layouts.master')
@section('title', 'Employee')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/font/font-fileuploader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.css') }}">
@stop

@section('content')
    <style>
        #background {
            width: 103%;
            margin-left: -13px;
        }
        #leftsidebar
        {
            display: none;
        }
        .navbar-right{
            display: none;
        }
        #card #body {
            background: #f0f0f0;
        }

        #margin {
            margin-bottom: 7rem !important;
        }

        #btn {
                background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;
        }

        .fileuploader-input .fileuploader-input-button {
                background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
        }

        .fileuploader-input .fileuploader-input-caption {
            color: gray !important;
        }

        #select1 select option {
            border-bottom: 1px gray;
        }
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Fill All Details</h1>
                            </div>
                        </div>
                        {{-- <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('employee') }}">All Employee</a></li>
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false"></a>
                                    <!--<ul class="dropdown-menu dropdown-menu-right">-->
                                    <!--    <li><a href="{{ url('employee') }}">All Employee</a></li>-->
                                    <!--</ul>-->
                                </li>
                                <!--<li class="remove">-->
                                <!--    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>-->
                                <!--</li>-->
                            </button>
                        </ul> --}}
                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    <p style="font-size: 20px;margin-top:-10px; color:gray;">Fill All Details</p>
                    <hr style="margin-top:-15px;">
                    <form action="{{ route('emp.comp-acc') }}" method="post" enctype="multipart/form-data">
                        @csrf
<input type="hidden" name="emp_id" value="{{$employee->id}}">
                        <div class="row clearfix shadow "
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Basic Information</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            
                          
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="form-group">
                                    <input type="text" required name="first_name" class="form-control form-control-sm form-float"
                                        value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <label class="error">{{ $errors->first('first_name') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <div class="form-group">
                                    <input type="text" name="last_name" required class="form-control form-control-sm"
                                        value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <label class="error">{{ $errors->first('last_name') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label> Email</label>
                                <div class="form-group">
                                    <input type="email" name="other_email" required value="{{$employee->email}}" class="form-control form-control-sm"
                                        value="{{ old('other_email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth</label>
                                <div class="form-group">
                                    <input type="date" name="date_of_birth" required class="form-control date"
                                        placeholder="dd/mm/yyyy" value="{{ old('date_of_birth') }}">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <label>Gender</label>

                                <div class="form-group">
                                    <select name="gender" required class="form-control form-control-sm show-tick">
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : null }}>Male
                                        </option>
                                        <hr>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : null }}>Female
                                        </option>
                                    </select>

                                    <br>
                                    @error('gender')
                                        <label class="error">{{ $errors->first('gender') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Nationality</label>
                                <div class="form-group">
                                    <input type="text" required name="nationality" class="form-control form-control-sm"
                                        value="{{ old('nationality') }}">
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <label>Qualification</label>
                                <div class="form-group">
                                    <select name="qualification" required id="select1"
                                        class="form-control form-control-sm show-tick">
                                        <option value="matric" {{ old('qualification') == 'matric' ? 'selected' : null }}>
                                            Matric
                                            <hr>
                                        </option>

                                        <option value="diploma"
                                            {{ old('qualification') == 'diploma' ? 'selected' : null }}>
                                            Diploma Holder</option>
                                        <option value="inter" {{ old('qualification') == 'inter' ? 'selected' : null }}>
                                            Intermediate</option>
                                        <option value="bachelors"
                                            {{ old('qualification') == 'bachelors' ? 'selected' : null }}>Bachelors
                                        </option>
                                        <option value="bscs" {{ old('qualification') == 'bscs' ? 'selected' : null }}>
                                            BSCS
                                        </option>
                                        <option value="bsse" {{ old('qualification') == 'bsse' ? 'selected' : null }}>
                                            BSSE
                                        </option>
                                        <option value="masters"
                                            {{ old('qualification') == 'masters' ? 'selected' : null }}>
                                            Masters</option>
                                        <option value="mcs" {{ old('qualification') == 'mcs' ? 'selected' : null }}>Mcs
                                        </option>

                                    </select>

                                </div>

                            </div>
                            <div class="col-md-6">

                                <label>Source</label>
                                <div class="form-group">
                                    <select name="source" required class="form-control form-control-sm show-tick">
                                        <option value="Indeed" {{ old('source') == 'Indeed' ? 'selected' : null }}>Indeed
                                        </option>
                                        <hr>
                                        <option value="Linkedin" {{ old('source') == 'Linkedin' ? 'selected' : null }}>
                                            Linkedin</option>
                                        <option value="Direct" {{ old('source') == 'Direct' ? 'selected' : null }}>Direct
                                        </option>
                                        <option value="Referred" {{ old('source') == 'Referred' ? 'selected' : null }}>
                                            Referred</option>
                                        <option value="Friend" {{ old('source') == 'Friend' ? 'selected' : null }}>Friend
                                        </option>
                                    </select>

                                    <br>
                                    @error('gender')
                                        <label class="error">{{ $errors->first('gender') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Marital Status</label>
                                <div class="form-group">
                                    <select name="marital_status" required class="form-control form-control-sm show-tick">
                                        <option value="unmarried"
                                            {{ old('marital_status') == 'unmarried' ? 'selected' : null }}>Unmarried
                                        </option>
                                        <hr>
                                        <option value="married"
                                            {{ old('marital_status') == 'married' ? 'selected' : null }}>Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>CNIC <small>(without dash)</small></label>
                                <div class="form-group">
                                    <input type="number" required name="cnic" minlength="14"
                                        class="form-control form-control-sm" placeholder="Ex:42101542517561"
                                        value="{{ old('cnic') }}">
                                    @error('cnic')
                                        <label class="error">{{ $errors->first('cnic') }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix mt-3 shadow"
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Contact Details / Address</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-6">

                                <label>Mobile No</label>
                                <div class="form-group">
                                    <input type="number" required name="mobile_no" class="form-control form-control-sm"
                                        value="{{ old('mobile_no') }}">
                                    @error('mobile_no')
                                        <label class="error">{{ $errors->first('mobile_no') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Emergency Contact</label>
                                <div class="form-group">
                                    <input type="number" required name="emergency_contact" class="form-control form-control-sm"
                                        value="{{ old('emergency_contact') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Address</label>
                                <div class="form-group">
                                    <textarea type="text" required name="address" rows="5" class="form-control form-control-sm">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <div class="form-group">
                                    <input type="text" required name="country" class="form-control form-control-sm"
                                        value="{{ old('country') }}">
                                </div>
                                <label>City</label>
                                <div class="form-group">
                                    <input type="text" required name="city" class="form-control form-control-sm"
                                        value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <label>Postal/Zip Code</label>
                                <div class="form-group">
                                    <input type="number" required name="postal_code" class="form-control form-control-sm"
                                        value="{{ old('postal_code') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Home Phone</label>
                                <div class="form-group">
                                    <input type="text" required name="home_phone" class="form-control form-control-sm"
                                        value="{{ old('home_phone') }}">
                                </div>
                            </div>
                        </div>
 


                        <div class="row clearfix mt-3 shadow"
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Document Attachment</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-12">
                                <label>Upload Profile Picture</label>
                                <div class="form-group">
                                    <input type="file" name="profile_image" class="dropify"
                                        data-allowed-file-extensions="png jpg jpeg" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Upload Documents (CNIC, etc)</label>
                                <div class="form-group">

                                    <input type="file" name="file" multiple id="fileuploader"
                                        accept=".docx, .doc, .pdf, .csv, .png, .jpeg, .jpg, .pptx, .xls, .xlsx" />
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix mt-3 shadow"
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Write A Review</h3>
                                <hr style="margin-top:-15px;">
                            </div>

                            <div class="col-md-12">

                                <textarea class="summernote " name="notes">{{ old('notes') }}</textarea>


                            </div>

                        </div>








                        <div class="container mt-2">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                            </div>
                        </div>

                        <style>
                            #save-btn {
                                width: 180px;
                                height: 40px;
                                font-size: 15px;
                                    background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
                            }
                        </style>



                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
@stop


@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>

    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
@stop

@push('after-scripts')
    <script>
        $("#job-status").change(function() {
            var selectedValue = $(this).val();

            if (selectedValue == "Internship") {
                $('#ip').show();
                $('#ipe').show();
                $('#pp').hide();
                $('#ppe').hide();
            } else if (selectedValue == "Full Time") {
                $('#pp').show();
                $('#ipe').hide();
                $('#ip').hide();
                $('#ppe').show();
            } else {
                $('#pp').show();
                $('#ipe').hide();
                $('#ip').hide();
                $('#ppe').show();
            }

        });
    </script>

    <script>
        // enable fileuploader plugin
        $('#fileuploader').fileuploader({
            addMore: true
        });
    </script>
@endpush
