@extends('layouts.authentication')
@section('title', 'Forgot Password')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card auth_form">
                <div class="header mb-5">
                    <img src="{{ asset('assets/images/TMWlogo.png') }}" alt="Metro web Logo">
                </div>
                <div class="body">

                    <form method="POST" action="{{ route('forgot-password') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Email" style="box-shadow: none;">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"
                                        style="color: #607D8B"></i></span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="mb-3 btn btn-primary btn-block waves-effect waves-light">Reset Password</button>
                        <a class="text-center" href="{{ url('/') }}">
                            <small>{{ __('Login?') }}</small>
                        </a>
                        {{-- @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>{{ __('Forgot Your Password?') }}</small>
                            </a>
                        @endif --}}
                    </form>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        @if (Session::has('success') && Session::get('success'))
            var successMessage = "{{ Session::get('success') }}";
            Swal.fire({
                icon: "success",
                title: "Success",
                text: successMessage,
            });
        @endif

        @if (Session::has('error') && Session::get('error'))
            var errorMessage = "{{ Session::get('error') }}";
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: errorMessage,
            });
        @endif
    });
</script>

            <div class="copyright text-center">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>The Metro Web</span>
            </div>
        </div>
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <img src="{{ asset('assets/images/signin.svg') }}" alt="Sign In" />
            </div>
        </div>
    </div>
@stop





{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><img src="{{asset('img/logo1.png')}}" width="64" /></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
