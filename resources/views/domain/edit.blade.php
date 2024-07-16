@extends('layouts.master')
@section('title', 'Domains')
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.css') }}" />
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
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header">
                        <div class="d-flex justify-content-center">
                            <div id="margin" class="max-w-50 ">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">Edit Domain</h1>
                            </div>
                        </div>
                        <ul class="header-dropdown mt-5">

                            <button id="btn" type="button" class="btn btn-primary"
                                style="padding: inherit;margin-top: 140px;">
                                <li><a style="font-weight:700; color:white; margin-left:20px; text-decoration:none;color:black;"
                                        href="{{ route('domain.index') }}">All Domains</a></li>
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
                    <form action="{{ route('domain.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="d_id" value="{{ $domain->id }}" id="">
                        <div class="row clearfix shadow "
                            style="background:white;padding-top:18px;width:100%;margin-left:1px;">
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Domain Detail</h3>
                                <hr style="margin-top:-15px;">
                            </div>

                            <div class="col-md-6">
                                <label class="login1_1">Domain & Service Name </label>
                                <div class="form-group">
                                    <input type="text" name="domain_service_name" class="form-control show-tick ms"
                                        value="{{ $domain->domain_service_name }}" required>
                                    @error('domain_service_name')
                                        <label class="error">{{ $errors->first('domain_service_name') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Service Provider Name</label>
                                <div class="form-group">
                                    <input type="text" name="service_provider_name" class="form-control show-tick ms"
                                        value="{{ $domain->service_provider_name }}" required>
                                    @error('service_provider_name')
                                        <label class="error">{{ $errors->first('service_provider_name') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Acc Source </label>
                                <div class="form-group">
                                    <input type="text" name="acc_source" class="form-control show-tick ms"
                                        value="{{ $domain->acc_source }}" required>
                                    @error('acc_source')
                                        <label class="error">{{ $errors->first('acc_source') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="d-flex">
                                    <label class="login1_1" for="client_acc">Client Account? </label>
                                    <div class="form-group">
                                        <input type="checkbox" name="client_acc" id="client_acc" class=" show-tick ms mt-3"
                                            value="" {{ $domain->client_url!=null||$domain->c_username!=null||$domain->c_password!=null?'checked':'' }}>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <div class="d-flex">
                                    <label class="login1_1 d_exp" for="d_exp">Domain Expired don't have? </label>
                                    <div class="form-group">
                                        <input type="checkbox" name="d_exp" id="d_exp" class="show-tick ms mt-3" value="" {{$domain->domain_exp_date==null?'checked':''}}>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="domain_exp_date">
                                <label class="login1_1">Domain Expired Date </label>
                                <div class="form-group">
                                    <input type="date" name="domain_exp_date" id="domain_exp_date_toggle" class="form-control show-tick ms"
                                        value="{{ $domain->domain_exp_date }}">
                                    @error('domain_exp_date')
                                        <label class="error">{{ $errors->first('domain_exp_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" id="domain_renewl_status">
                                <label class="login1_1">Domain Renewl Status </label>
                                <div class="form-group">
                                    <input type="text" name="domain_renewl_status" class="form-control show-tick ms"
                                        value="{{ $domain->domain_renewl_status }}">
                                    @error('domain_renewl_status')
                                        <label class="error">{{ $errors->first('domain_renewl_status') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="clientAccount">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 style="font-weight: bold;">Client Account Credientials</h3>
                                        <hr style="margin-top:-15px;">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="login1_1">Account URL</label>
                                        <div class="form-group">
                                            <input type="text" name="client_url" class="form-control show-tick ms"
                                                value="{{ $domain->client_url }}">
                                            @error('client_url')
                                                <label class="error">{{ $errors->first('client_url') }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="login1_1">Account Email/Username </label>
                                        <div class="form-group">
                                            <input type="text" name="c_username" class="form-control show-tick ms"
                                                value="{{ $domain->c_username }}">
                                            @error('c_username')
                                                <label class="error">{{ $errors->first('c_username') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="login1_1">Account Password </label>
                                        <div class="form-group">
                                            <input type="text" name="c_password" class="form-control show-tick ms"
                                                value="{{ $domain->c_password }}">
                                            @error('c_password')
                                                <label class="error">{{ $errors->first('c_password') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">Hosting Detail</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Website Status </label>
                                <div class="form-group">
                                    <input type="text" name="website_status" class="form-control show-tick ms"
                                        value="{{ $domain->website_status }}">
                                    @error('website_status')
                                        <label class="error">{{ $errors->first('website_status') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="login1_1">Website Setup Date </label>
                                <div class="form-group">
                                    <input type="date" name="website_setup_date" class="form-control show-tick ms"
                                        value="{{ $domain->website_setup_date }}">
                                    @error('website_setup_date')
                                        <label class="error">{{ $errors->first('website_setup_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Website Expiry Date </label>
                                <div class="form-group">
                                    <input type="date" name="website_exp_date" class="form-control show-tick ms"
                                        value="{{ $domain->website_exp_date }}">
                                    @error('website_exp_date')
                                        <label class="error">{{ $errors->first('website_exp_date') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="login1_1">SSL Apply Date </label>
                                <div class="form-group">
                                    <input type="date" name="ssl_apply_date" class="form-control show-tick ms"
                                        value="{{ $domain->ssl_apply_date }}">
                                    @error('ssl_apply_date')
                                        <label class="error">{{ $errors->first('ssl_apply_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">SSL Expiry Date </label>
                                <div class="form-group">
                                    <input type="date" name="ssl_exp_date" class="form-control show-tick ms"
                                        value="{{ $domain->ssl_exp_date }}">
                                    @error('ssl_exp_date')
                                        <label class="error">{{ $errors->first('ssl_exp_date') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Hosting Name </label>
                                <div class="form-group">
                                    <input type="text" name="hosting_name" class="form-control show-tick ms"
                                        value="{{ $domain->hosting_name }}">
                                    @error('hosting_name')
                                        <label class="error">{{ $errors->first('hosting_name') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">cPanel Detail</h3>
                                <hr style="margin-top:-15px;">
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">CPanel URL</label>
                                <div class="form-group">
                                    <input type="text" name="cpanel_url" class="form-control show-tick ms"
                                        value="{{ $domain->cpanel_url }}">
                                    @error('cpanel_url')
                                        <label class="error">{{ $errors->first('cpanel_url') }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="login1_1">Username </label>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control show-tick ms"
                                        value="{{ $domain->username }}">
                                    @error('username')
                                        <label class="error">{{ $errors->first('username') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="login1_1">Password </label>
                                <div class="form-group">
                                    <input type="text" name="password" class="form-control show-tick ms"
                                        value="{{ $domain->password }}">
                                    @error('password')
                                        <label class="error">{{ $errors->first('password') }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label for="login1_18">This is WordPess Website? </label>
                                <input type="checkbox" {{ $domain->wordpress_url!=null||$domain->w_username!=null||$domain->w_password!=null?'checked':'' }} id="login1_18" name="" class=" show-tick ms">

                            </div>
                            <div class=" wordpress ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 style="font-weight: bold;">Wordpress Details</h3>
                                        <hr style="margin-top:-15px;">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="login1_1">WordPess URL</label>
                                        <div class="form-group">
                                            <input type="text" name="wordpress_url" class="form-control show-tick ms"
                                                value="{{ $domain->wordpress_url }}">
                                            @error('wordpress_url')
                                                <label class="error">{{ $errors->first('wordpress_url') }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="login1_1">Username </label>
                                        <div class="form-group">
                                            <input type="text" name="w_username" class="form-control show-tick ms"
                                                value="{{ $domain->w_username }}">
                                            @error('w_username')
                                                <label class="error">{{ $errors->first('w_username') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="login1_1">Password </label>
                                        <div class="form-group">
                                            <input type="text" name="w_password" class="form-control show-tick ms"
                                                value="{{ $domain->w_password }}">
                                            @error('w_password')
                                                <label class="error">{{ $errors->first('w_password') }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary mb-5" id="save-btn">Update
                                        Domain</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>




            </div>
        </div>
    </div>

    <style>
        .wordpress {
            padding-left: 20px;
        }
        .clientAccount {
            padding-left: 20px;
        }
        .login1_1 {
            margin: auto;
        }

        #save-btn {
            width: 180px;
            height: 40px;
            font-size: 15px;
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;
            border-radius: 10px;
            ;
        }

        label.login1_1 {
    margin-left: 0;
}

input#client_acc {
    margin-left: -60px;
}

label.login1_1.d_exp {
    margin-left: -19px;
}

input#d_exp {
    margin-left: -25px;
}
    </style>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            if ($('#login1_18').is(':checked')) {
                $('.wordpress').show();
            } else {
                $('.wordpress').hide();
            }
            if ($('#client_acc').is(':checked')) {
                $('.clientAccount').show();
            } else {
                $('.clientAccount').hide();
            }

            if ($('#d_exp').is(':checked')) {
                $('#domain_exp_date').hide();
                $('#domain_exp_date_toggle').prop('required', false);
            } else {
                $('#domain_exp_date').show();
                $('#domain_exp_date_toggle').prop('required', true);
            }

            $('#login1_18').change(function() {
                $('.wordpress').toggle();
            });

            $('#client_acc').change(function() {
                $('.clientAccount').toggle();
            });

            $('#d_exp').change(function() {
                if ($(this).is(':checked')) {
                    $('#domain_exp_date').hide();
                    $('#domain_renewl_status').hide();
                    $('#domain_exp_date_toggle').prop('required', false);
                } else {
                    $('#domain_exp_date').show();
                    $('#domain_renewl_status').show();
                    $('#domain_exp_date_toggle').prop('required', true);
                }
            });

            // Trigger change event on page load to set the initial state
            $('#d_exp').trigger('change');
        });
    </script>
@stop

@push('after-scripts')
@endpush

@section('page-script')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/advanced-form-elements.js') }}"></script>
@stop
