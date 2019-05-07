@extends('layouts.login-user')

@section('content')
<div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-33">
                        Account Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input id="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input id="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-20">
                        <button type="submit" class="login100-form-btn">
                            Sign in
                        </button>
                    </div>
                    
                    @if(Route::has('password.request'))
                    <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                            Forgot
                        </span>

                        <a href="{{ route('password.request') }}" class="txt2 hov1">
                            Username / Password?
                        </a>
                    </div>
                    @endif

                    <div class="text-center">
                        <span class="txt1">
                            Create an account?
                        </span>

                        <a href="{{ route('register') }}" class="txt2 hov1">
                            Sign up
                        </a>
                    </div>
                </form>
            </div>
        </div>
@endsection