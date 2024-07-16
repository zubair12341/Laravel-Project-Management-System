@extends('layouts.master')
@section('title', 'Domain')
@section('page-style')

@stop
@section('content')
    @include('layouts.alert_message')
    <style>
        #btn {
            background: linear-gradient(90deg, #ceb781 0%, #7F6B3E 100%) !important;
            color: black;
            font-weight: 900;

        }

        #background {
            width: 103%;
            margin-left: -13px;
        }

        #card #body {
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

        .modal-content {
            margin-left: 30px;
        }

        div#user_datatable_filter {
            display: none;
        }

        #month {
            height: 40px;
            padding: 8px;
            min-width: 220px;
            background: rgba(0, 0, 0, 0);
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        #service_provider_name {
            height: 40px;
            padding: 8px;
            min-width: 220px;
            background: rgba(0, 0, 0, 0);
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-simple {
            display: none;
        }

        button.btn.dropdown-toggle.btn-simple {
            display: none;
        }
    </style>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card" id="card">
                <div id="background" class="container-fluid" style="background: #1D262D;padding:20px;">
                    <div class="header-employee">

                        <div class="d-flex justify-content-center">
                            <div class="max-w-50 mt-3">
                                <h1 style="border-bottom: 1px solid white;color:white;font-weight:bold;">All Domains</h1>
                            </div>
                        </div>


                        @if (auth()->user()->role_id == '1')
                            <div class="container-fluid">
                                <div id="btn-row" class="row d-flex justify-content-center">
                                    <div class="col-md-2 w-100">
                                        <a href="{{ route('domain.create') }}"><button id="btn" style="width: 100%"
                                                class="btn ">Add Domain</button></a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url('user') }}"><button id="btn" style="width: 100%"
                                                class="btn ">All User</button></a>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url('user/create') }}"><button id="btn" style="width: 100%"
                                                class="btn ">Add User</button></a>

                                    </div>

                                </div>
                            </div>
                        @endif
                        <div class="d-flex justify-content-center mt-4">
                            <div class="w-50 ">
                                <div class="form-group mb-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent border-0">
                                                <img src="{{ asset('img/sidebar/2.png') }}" width="25" height="25">
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0 bg-transparent table-search"
                                            placeholder="Search....">
                                    </div>
                                    <hr class="border-secondary my-2">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="body shadow-lg" id="body">
                    <form method="GET" action="{{ route('domain.index') }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="service_provider_name">Select Service Provider:</label>
                                    <select id="service_provider_name" name="service_provider_name" class="">
                                        <option value="">All</option>
                                        @foreach ($serviceProviders as $provider)
                                            <option value="{{ $provider }}"
                                                {{ request('service_provider_name') == $provider ? 'selected' : '' }}>
                                                {{ $provider }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="month">Select Expired Month:</label>
                                    <select id="month" name="month" class="">
                                        <option value="">All</option>
                                        @foreach (range(1, 12) as $month)
                                            <option value="{{ $month }}"
                                                {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="year">Select Expired Year:</label>
                                    <input type="number" id="year" name="year" class="form-control"
                                        value="{{ request('year') }}" placeholder="YYYY" min="2000"
                                        max="{{ date('Y') + 10 }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="user_datatable" class="user-datatable table table-bordered table-hover shadow-sm"
                            style="width:100%;background:white;">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        #</th>
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        Domain & Service Name</th>
                                    {{-- <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        Service Provider Name</th> --}}
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        Domain Expired</th>
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        SSL Expired</th>
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        Hosting Expired</th>
                                    <th class="text-center" style="background: white;color:#1D262D; white-space: nowrap;">
                                        Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($domains as $key => $domain)
                                    @php
                                        $i++;
                                        $expirationDate = Carbon\Carbon::parse($domain->domain_exp_date);
                                        $now = Carbon\Carbon::now();
                                        $isExpiringSoon = $expirationDate->diffInDays($now) <= 30;
                                    @endphp

                                    @php
                                        $expirationDateSSL = Carbon\Carbon::parse($domain->ssl_exp_date);
                                        $now = Carbon\Carbon::now();
                                        $isExpiringSoonSSL = $expirationDateSSL->diffInDays($now) <= 30;

                                        $expirationDateWeb = Carbon\Carbon::parse($domain->website_exp_date);
                                        $now = Carbon\Carbon::now();
                                        $isExpiringSoonWeb = $expirationDateWeb->diffInDays($now) <= 30;
                                    @endphp

                                    <tr>
                                        <td class="text-center">{{ $i }}</td>
                                        <td class="text-center">{{ $domain->domain_service_name }}</td>
                                        {{-- <td class="text-center">{{ $domain->service_provider_name }}</td> --}}
                                        <td class="center-content ">
                                            <p class="badge {{ $isExpiringSoon ? 'badge-danger' : 'badge-primary' }}">
                                                {{ $domain->domain_exp_date ? Carbon\Carbon::parse($domain->domain_exp_date)->format('d-F-y') : 'null' }}
                                            </p>
                                        </td>
                                        <td class="center-content ">
                                            <p
                                                class="badge {{ $isExpiringSoonSSL && $domain->ssl_exp_date != null ? 'badge-danger' : 'badge-primary' }}">
                                                {{ $domain->ssl_exp_date ? Carbon\Carbon::parse($domain->ssl_exp_date)->format('d-F-y') : 'Not Apply' }}
                                            </p>
                                        </td>

                                        <td class="center-content ">
                                            <p
                                                class="badge {{ $isExpiringSoonWeb && $domain->website_exp_date != null ? 'badge-danger' : 'badge-primary' }}">
                                                {{ $domain->website_exp_date ? Carbon\Carbon::parse($domain->website_exp_date)->format('d-F-y') : 'Null' }}
                                            </p>
                                        </td>

                                        <td>
                                            @if (auth()->user()->role_id == '1')
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#viewDomain{{ $domain->id }}"><i
                                                            class="fas fa-eye"></i></button>
                                                    <a href="{{ route('domain.edit', $domain->id) }}"
                                                        class="btn btn-primary mx-1"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('domain.delete', $domain->id) }}"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </div>
                                            @else
                                                @php
                                                    $user_p = DB::table('manage_permissions')
                                                        ->where('user_id', auth()->user()->id)
                                                        ->first();
                                                @endphp
                                                @if ($user_p->domain_show_edit == 'Yes')
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-toggle="modal"
                                                            data-target="#viewDomain{{ $domain->id }}"><i
                                                                class="fas fa-eye"></i></button>
                                                        <a href="{{ route('domain.edit', $domain->id) }}"
                                                            class="btn btn-primary mx-1"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                @else
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                        data-target="#viewDomain{{ $domain->id }}"><i
                                                            class="fas fa-eye"></i></button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewDomain{{ $domain->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="viewDomainLabel{{ $domain->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewDomainLabel{{ $domain->id }}">
                                                        Domain
                                                        Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4>Domains Information</h4>
                                                                <hr>
                                                                <strong>Domain & Service Name:</strong>
                                                                {{ $domain->domain_service_name }}<br>
                                                                <strong>Service Provider Name:</strong>
                                                                {{ $domain->service_provider_name }}<br>
                                                                <strong>Acc Source:</strong> {{ $domain->acc_source }}<br>
                                                                <strong>Domain Expired: </strong>
                                                                <p
                                                                    class="badge {{ $isExpiringSoon && $domain->domain_exp_date != null ? 'badge-danger' : 'badge-primary' }}">
                                                                    {{ $domain->domain_exp_date != null ? Carbon\Carbon::parse($domain->domain_exp_date)->format('d-F-y') : 'Not buyed' }}
                                                                </p> <br>
                                                                <strong>Domain Renewal Status:</strong>
                                                                {{ $domain->domain_renewl_status != null ? $domain->domain_renewl_status : 'Not Yet' }}<br>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <h4>Website Information</h4>
                                                                <hr>
                                                                <strong>Website Status:</strong>
                                                                {{ $domain->website_status != null ? $domain->website_status : 'not live' }}<br>
                                                                <strong>Website Setup Date:</strong>
                                                                {{ $domain->website_setup_date != null ? Carbon\Carbon::parse($domain->website_setup_date)->format('d-F-y') : 'Null' }}<br>
                                                                <strong>Website Expired Date:</strong>
                                                                <p
                                                                    class="badge {{ $isExpiringSoonWeb && $domain->website_exp_date != null ? 'badge-danger' : 'badge-primary' }}">
                                                                    {{ $domain->website_exp_date != null ? Carbon\Carbon::parse($domain->website_exp_date)->format('d-F-y') : 'Null' }}
                                                                </p><br>
                                                                <strong>SSL Apply Date:</strong>
                                                                {{ $domain->ssl_apply_date != null ? Carbon\Carbon::parse($domain->ssl_apply_date)->format('d-F-y') : 'Not Apply' }}<br>
                                                                <strong>SSL Expired Date:</strong>
                                                                <p
                                                                    class="badge {{ $isExpiringSoonSSL && $domain->ssl_exp_date != null ? 'badge-danger' : 'badge-primary' }}">
                                                                    {{ $domain->ssl_exp_date != null ? Carbon\Carbon::parse($domain->ssl_exp_date)->format('d-F-y') : 'Not Apply' }}
                                                                </p><br>
                                                                <strong>Hosting Name:</strong>
                                                                {{ $domain->hosting_name != null ? $domain->hosting_name : 'Null' }}<br>


                                                            </div>

                                                            @if ($domain->client_url != null || $domain->c_username != null || $domain->c_password != null)
                                                            <div class="col-md-12">
                                                                <h4>Client Account Credentials</h4>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>Client Account URL:</strong>
                                                                        <input type="text"
                                                                            id="client-url-{{ $key }}"
                                                                            value="{{ $domain->client_url != null ? $domain->client_url : 'Null' }}"
                                                                            class="form-control" readonly>

                                                                    </div>
                                                                    <div class="col-3">

                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('client-url-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>Username/Email:</strong>
                                                                        <input type="text"
                                                                            id="c_username-{{ $key }}"
                                                                            value="{{ $domain->c_username != null ? $domain->c_username : 'Null' }}"
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('c_username-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>Password:</strong>
                                                                        <input type="password"
                                                                            id="c_password-{{ $key }}"
                                                                            class="form-control"
                                                                            value="{{ $domain->c_password != null ? $domain->c_password : 'Null' }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('c_password-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyAllData3('{{ $key }}')">Copy
                                                                            All Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif


                                                            <div class="col-md-12">
                                                                <h4>cPanel Credentials</h4>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>cPanel URL:</strong>
                                                                        <input type="text"
                                                                            id="cpanel-url-{{ $key }}"
                                                                            value="{{ $domain->cpanel_url != null ? $domain->cpanel_url : 'Null' }}"
                                                                            class="form-control" readonly>

                                                                    </div>
                                                                    <div class="col-3">

                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('cpanel-url-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>Username:</strong>
                                                                        <input type="text"
                                                                            id="username-{{ $key }}"
                                                                            value="{{ $domain->username != null ? $domain->username : 'Null' }}"
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('username-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <strong>Password:</strong>
                                                                        <input type="password"
                                                                            id="password-{{ $key }}"
                                                                            class="form-control"
                                                                            value="{{ $domain->password != null ? $domain->password : 'Null' }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyText('password-{{ $key }}')">Copy</button><br>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <button class="btn btn-primary mt-4"
                                                                            onclick="copyAllData('{{ $key }}')">Copy
                                                                            All Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if ($domain->wordpress_url != null || $domain->w_username != null || $domain->w_password != null)
                                                                <div class="col-md-12">
                                                                    <h4>WordPress Credentials</h4>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <strong>WordPress URL:</strong>
                                                                            <input type="text"
                                                                                id="wordpress-url-{{ $key }}"
                                                                                value="{{ $domain->wordpress_url != null ? $domain->wordpress_url : 'Null' }}"
                                                                                class="form-control" readonly>

                                                                        </div>
                                                                        <div class="col-3">

                                                                            <button class="btn btn-primary mt-4"
                                                                                onclick="copyText('wordpress-url-{{ $key }}')">Copy</button><br>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <strong>Username:</strong>
                                                                            <input type="text"
                                                                                id="w_username-{{ $key }}"
                                                                                value="{{ $domain->w_username != null ? $domain->w_username : 'Null' }}"
                                                                                class="form-control" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button class="btn btn-primary mt-4"
                                                                                onclick="copyText('w_username-{{ $key }}')">Copy</button><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <strong>Password:</strong>
                                                                            <input type="password"
                                                                                id="w_password-{{ $key }}"
                                                                                class="form-control"
                                                                                value="{{ $domain->w_password != null ? $domain->w_password : 'Null' }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button class="btn btn-primary mt-4"
                                                                                onclick="copyText('w_password-{{ $key }}')">Copy</button><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <button class="btn btn-primary mt-4"
                                                                                onclick="copyAllData2('{{ $key }}')">Copy
                                                                                All Data</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-between">
                                                        @if (auth()->user()->role_id == '1')
                                                            <a href="{{ route('domain.edit', $domain->id) }}"
                                                                class="btn btn-primary mx-1">Edit</a>
                                                            <a href="{{ route('domain.delete', $domain->id) }}"
                                                                class="btn btn-danger">Delete</a>
                                                        @else
                                                            @if ($user_p->domain_show_edit == 'Yes')
                                                                <a href="{{ route('domain.edit', $domain->id) }}"
                                                                    class="btn btn-primary mx-1">Edit</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            @if (session('openModal'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        $('#viewDomain{{ session('openModal') }}').modal('show');
                                    });
                                </script>
                            @endif
                            <script>
                                function copyText(inputId) {
                                    var inputElement = document.getElementById(inputId);

                                    navigator.clipboard.writeText(inputElement.value).then(function() {
                                        //  alert();
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: "Text copied to clipboard: " + inputElement.value
                                        });
                                    }, function(err) {
                                        console.error('Could not copy text: ', err);
                                    });
                                }

                                function copyAllData(key) {
                                    var cpanelUrl = document.getElementById('cpanel-url-' + key).value;
                                    var username = document.getElementById('username-' + key).value;
                                    var password = document.getElementById('password-' + key).value;

                                    var formattedText = `
+===================================+
| Account Info                  
+===================================+
| cPanel: ${cpanelUrl}
| UserName: ${username}
| PassWord: ${password}
+===================================+`;

                                    navigator.clipboard.writeText(formattedText).then(function() {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: "Account info copied to clipboard"
                                        });
                                    }, function(err) {
                                        console.error('Could not copy text: ', err);
                                    });
                                }


                                function copyAllData2(key) {
                                    var cpanelUrl = document.getElementById('wordpress-url-' + key).value;
                                    var username = document.getElementById('w_username-' + key).value;
                                    var password = document.getElementById('w_password-' + key).value;

                                    var formattedText = `
+===================================+
| WordPress Info                  
+===================================+
| WordPress Url: ${cpanelUrl}
| UserName: ${username}
| PassWord: ${password}
+===================================+`;

                                    navigator.clipboard.writeText(formattedText).then(function() {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: "Account info copied to clipboard"
                                        });
                                    }, function(err) {
                                        console.error('Could not copy text: ', err);
                                    });
                                }


                                function copyAllData3(key) {
                                    var cpanelUrl = document.getElementById('client-url-' + key).value;
                                    var username = document.getElementById('c_username-' + key).value;
                                    var password = document.getElementById('c_password-' + key).value;

                                    var formattedText = `
+===================================+
| Account Info                  
+===================================+
| Account Url: ${cpanelUrl}
| UserName/Email: ${username}
| PassWord: ${password}
+===================================+`;

                                    navigator.clipboard.writeText(formattedText).then(function() {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "bottom-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal.stopTimer;
                                                toast.onmouseleave = Swal.resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "success",
                                            title: "Account info copied to clipboard"
                                        });
                                    }, function(err) {
                                        console.error('Could not copy text: ', err);
                                    });
                                }

                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .center-content {
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
@stop
@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


@stop
@push('after-scripts')
    <script>
        $('.toggle-class').change(function() {

            var status = $(this).prop('checked') == true ? 1 : 0;
            var userid = $(this).data('id');
            //alert(userid);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {
                    'status': status,
                    'userid': userid
                },
                success: function(data) {
                    console.log(userid);
                    alert(data.message);
                }
            });
        });

        $('#roleId').on('change', function() {
            var roleId = $(this).val();
            var userId = $(this).data('id');
            $.ajax({
                url: '/updateRole',
                type: 'GET',
                data: {
                    'roleId': roleId,
                    'userId': userId
                },
                success: function(data) {
                    console.log('Success');
                    alert(data.message);
                    $('#roleId').html(options); // update the dropdown list with the new options
                }

            });
        });
        $(document).ready(function() {
            var table = $('.table').DataTable();

            $('.table-search').on('input', function() {
                var value = $(this).val();
                table.search(value).draw();
            });
        });
    </script>
@endpush
