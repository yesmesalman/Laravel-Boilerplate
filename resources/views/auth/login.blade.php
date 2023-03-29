@extends('layouts.app')

@section('content')

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    @if(session()->has('flash_error'))
                                    <div class="alert alert-danger">{{ session()->get('flash_error') }}</div>
                                    @endif

                                    @if(session()->has('flash_success'))
                                    <div class="alert alert-success">{{ session()->get('flash_success') }}</div>
                                    @endif

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." />
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" />
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                    @endif
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection