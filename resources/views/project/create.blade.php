@extends('layouts.master')
@section('title', 'Project')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/styles/ssi-uploader.min.css') }}" />

@stop

@section('content')

    @include('layouts.alert_message')

    <style>
        #background {
            width: 103%;
            margin-left: -13px;
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

        .check-input:checked {
            background-color: orange;
        }
    </style>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Add Project</h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ url('project') }}">All Projects</a></li>
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
                        </ul>
                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    <p style="font-size: 20px;margin-top:-10px; color:gray;">Add Project</p>
                    <hr style="margin-top:-15px;">
                    <form action="{{ url('project') }}" method="post">
                        @csrf
                        <div class="row clearfix shadow"
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Basic Information</h3>
                                <hr style="margin-top:-15px;">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Team Lead<span class="text-danger">*</span></label>
                                    <!--<select name="client_id" class="form-control form-control-sm">-->
                                    <select name="lead_id" class="form-control show-tick ms select2">
                                        <option>-- Select Team Lead --</option>
                                        <!---->
                                        <!--<option disabled selected>-- Select Client --</option>-->
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('lead_id') == $user->id ? 'selected' : null }}>
                                                {{ $user->employee->first_name.' '.$user->employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lead_id')
                                        <label class="error">{{ $errors->first('lead_id') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Project Title<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control form-control-sm"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <label class="error">{{ $errors->first('title') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price Type</label><br>
                                    <select name="project_type" class="form-control form-control-sm">
                                        <option style="display: none;" value="" disabled selected>-- Select Price Type
                                            --</option>
                                        <option value="fixed rate"
                                            {{ old('project_type') == 'fixed rate' ? 'selected' : '' }}>Fixed Rate</option>
                                        <option value="hourly rate"
                                            {{ old('project_type') == 'hourly rate' ? 'selected' : '' }}>Hourly Rate
                                        </option>

                                    </select>
                                    <!-- <div class="radio inlineblock m-r-20">
                                    <input type="radio" name="project_type" id="hourly-rate" class="with-gap" checked value="hourly rate" {{ old('project_type') == 'hourly rate' ? 'checked' : null }}>
                                    <label for="hourly-rate">Hourly Rate</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input type="radio" name="project_type" id="fixed-rate" class="with-gap" value="fixed rate" {{ old('project_type') == 'fixed rate' ? 'checked' : null }}>
                                    <label for="fixed-rate">Fixed Rate</label>
                                </div> -->
                                    <br>
                                    @error('project_type')
                                        <label class="error">{{ $errors->first('project_type') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status<span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option style="display:none;" value="" disabled selected>-- Select Status --
                                        </option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="process" {{ old('status') == 'process' ? 'selected' : '' }}>Process
                                        </option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="terminated" {{ old('status') == 'terminated' ? 'selected' : '' }}>
                                            Terminated</option>
                                    </select>
                                    @error('status')
                                        <label class="error">{{ $errors->first('status') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date<span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" class="form-control form-control-sm"
                                        value="{{ date('Y-m-d') }}">
                                    @error('start_date')
                                        <label class="error">{{ $errors->first('start_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control form-control-sm"
                                        value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <label class="error">{{ $errors->first('end_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Technology</label>
                                    <input type="text" name="technology" class="form-control form-control-sm"
                                        value="{{ old('technology') }}">
                                    @error('technology')
                                        <label class="error">{{ $errors->first('technology') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control form-control-sm"
                                        value="{{ old('website') }}">
                                    @error('website')
                                        <label class="error">{{ $errors->first('website') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- <label>Services</label>
                                <div class="checkbox m-r-20">
                                    <input type="checkbox"id="service" name="service"  class="with-gap"  value="Web Designing" {{ old('service') == 'Web Designing' ? 'checked' : '' }}>
                                    <label for="service">Web Designing</label>
                                </div>
                                <div class="checkbox m-r-20 mt-2">
                                    <input type="checkbox"id="service" name="service"  class="with-gap"  value="Web Development" {{ old('service') == 'Web Development' ? 'checked' : '' }}>
                                    <label for="service">Web Development</label>
                                </div>
                                <div class="checkbox m-r-20 mt-2">
                                    <input type="checkbox"id="service" name="service"  class="with-gap"  value="Hybrid Mobile App Development" {{ old('service') == 'Hybrid Mobile App Development' ? 'checked' : '' }}>
                                    <label for="service">Hybrid Mobile App Development</label>
                                </div>
                                <div class="checkbox m-r-20 mt-2">
                                    <input type="checkbox"id="service" name="service"  class="with-gap"  value="Native Mobile App Development" {{ old('service') == 'Native Mobile App Development' ? 'checked' : '' }}>
                                    <label for="service">Native Mobile App Development</label>
                                </div>
                                <div class="checkbox m-r-20 mt-2">
                                    <input type="checkbox"id="service" name="service"  class="with-gap"  value="CMS Development" {{ old('service') == 'CMS Development' ? 'checked' : '' }}>
                                    <label for="service">CMS Development</label>
                                </div> -->
                                <div class="form-group">
                                    <label>Service<span class="text-danger">*</span></label>
                                    <select name="service" class="form-control form-control-sm">
                                        <option value="Web Designing"
                                            {{ old('service') == 'Web Designing' ? 'selected' : '' }}>Web Designing
                                        </option>

                                        <option value="Web Development"
                                            {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development
                                        </option>

                                        <option value="Hybrid Mobile App Development"
                                            {{ old('service') == 'Hybrid Mobile App Development' ? 'selected' : '' }}>
                                            Hybrid Mobile App Development</option>

                                        <option value="Native Mobile App Development"
                                            {{ old('service') == 'Native Mobile App Development' ? 'selected' : '' }}>
                                            Native Mobile App Development</option>

                                        <option value="CMS Development"
                                            {{ old('service') == 'CMS Development' ? 'selected' : '' }}>CMS Development
                                        </option>

                                        <option value="SEO" {{ old('service') == 'SEO' ? 'selected' : '' }}>SEO
                                        </option>

                                        <option value="Social Media Marketing"
                                            {{ old('service') == 'Social Media Marketing' ? 'selected' : '' }}>Social Media
                                            Marketing</option>

                                        <option value="Content Writing"
                                            {{ old('service') == 'Content Writing' ? 'selected' : '' }}>Content Writing
                                        </option>

                                        <option value="Business development"
                                            {{ old('service') == 'Business development' ? 'selected' : '' }}>Business
                                            development</option>

                                        <option value="Graphics Design and Branding"
                                            {{ old('service') == 'Graphics Design and Branding' ? 'selected' : '' }}>
                                            Graphic Design and Branding</option>
                                    </select>
                                    @error('service')
                                        <label class="error">{{ $errors->first('service') }}</label>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="note" class="summernote">{{ old('note') }}</textarea>
                                    @error('note')
                                        <label class="error">{{ $errors->first('note') }}</label>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!--
                        <div class="col-md-6">
                            
                            </div>
                            <div class="col-md-6">
                          
                                </div>
                                </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                          
                            </div>
                 
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                     
                            </div>
                          
                            </div>
                            
                            <div class="row">
                         
                  
                            </div> -->

                        <div class="row">
                            <!-- <div class="col-md-6" id="project_1">
                 
                            {{-- <div class="form-group">
                            <label>File Attachment</label>
                            <input type="file" name="document" multiple id="ssi-upload" accept=".docx, .doc, .pdf, .csv, .png, .jpeg, .jpg, .pptx, .xls, .xlsx"/>
                        </div> --}}
                        </div>
                                <div class="col-md-6"  id="project_2">
                                                            <div class="form-group">
                                <label>Service<span class="text-danger">*</span></label>
                                <select name="service" class="form-control form-control-sm">
                                    <option value="Web Designing" {{ old('service') == 'Web Designing' ? 'selected' : '' }}>Web Designing</option>

                                    <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>

                                    <option value="Hybrid Mobile App Development" {{ old('service') == 'Hybrid Mobile App Development' ? 'selected' : '' }}>Hybrid Mobile App Development</option>

                                    <option value="Native Mobile App Development" {{ old('service') == 'Native Mobile App Development' ? 'selected' : '' }}>Native Mobile App Development</option>

                                    <option value="CMS Development" {{ old('service') == 'CMS Development' ? 'selected' : '' }}>CMS Development</option>

                                    <option value="SEO" {{ old('service') == 'SEO' ? 'selected' : '' }}>SEO</option>

                                    <option value="Social Media Marketing" {{ old('service') == 'Social Media Marketing' ? 'selected' : '' }}>Social Media Marketing</option>

                                    <option value="Content Writing" {{ old('service') == 'Content Writing' ? 'selected' : '' }}>Content Writing</option>

                                    <option value="Business development" {{ old('service') == 'Business development' ? 'selected' : '' }}>Business development</option>

                                    <option value="Graphics Design and Branding" {{ old('service') == 'Graphics Design and Branding' ? 'selected' : '' }}>Graphic Design and Branding</option>
                                </select>
                                @error('service')
        <label class="error">{{ $errors->first('service') }}</label>
    @enderror
                            </div>
                            </div> -->
                        </div>
                        <div class="container">
                            <div class="col-md-12 text-center mt-2">
                                <button type="submit" class="btn btn-primary" id="save-btn">Add Project</button>
                            </div>


                        </div>
                </div>
                <style>
                    #save-btn {
                        width: 180px;
                        height: 40px;
                        font-size: 15px;
                        background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
                        color: black;
                        font-weight: 900;
                        border-radius: 10px;
                    }

                    @media only screen and (max-width: 600px) {

                        div#project_2 {
                            order: 1;
                        }

                        div#project_1 {
                            order: 2;
                        }
                    }
                </style>

            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

@stop

@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('assets/js/plupload.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.min.js') }}"></script>
@stop


@push('after-scripts')
    <script>
        $('#ssi-upload').ssi_uploader({
            allowed: ['png', 'jpg', 'jpeg', 'pdf', 'txt', 'doc', 'docx', 'xls', 'csv', 'xlsx', 'pptx'],
            errorHandler: {
                method: function(msg, type) {
                    ssi_modal.notify(type, {
                        content: msg
                    });
                },
                success: 'success',
                error: 'error'
            },
            maxFileSize: 122 //mb
        });
    </script>
@endpush
