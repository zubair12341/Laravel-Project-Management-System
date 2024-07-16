@extends('layouts.authentication')
@section('title', 'Login')
@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <div class="card auth_form">
            <div class="header">
                <img src="{{asset('img/datech-logo.png')}}" alt="DA Tech Logo" width="40">
                <h5>Log in</h5>
            </div>
            <div class="body">
                <form method="POST" action="{{ url('ClientLogin') }}">
                    @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" style="box-shadow: none;">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-account-circle" style="color: #607D8B"></i></span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" style="box-shadow: none;">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-lock" style="color: #607D8B"></i></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label>
                </div>
                <button type="submit" class="mb-3 btn btn-primary btn-block waves-effect waves-light">Login In</button>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <small>{{ __('Forgot Your Password?') }}</small>
                    </a>
                @endif
                </form>
            </div>
        </div>
        <div class="copyright text-center">
            &copy;
            <script>document.write(new Date().getFullYear())</script>,
            <span>The DA Tech</span>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <img src="{{asset('assets/images/signin.svg')}}" alt="Sign In"/>
        </div>
    </div>
</div>
@stop
