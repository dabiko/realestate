@extends('admin.layout.guest')
@section('title')
    {{ config('app.name') }} | Admin Login
@endsection
@section('content')
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="auth-login-side-wrapper">

                        </div>
                    </div>
                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo logo-light d-block mb-2">Homes <span>Admin Login</span></a>
                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>


                            <form method="POST" action="{{ route('login') }}" class="forms-sample">

                                @csrf
                                @method('POST')

                                <div class="mb-3">
                                    <label for="login" class="form-label">{{__('Email | Name | Phone')}}</label>
                                    <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" id="login" placeholder="Email, Phone or Username" value="{{old('login')}}">
                                    @error('login')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{__('Password')}}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  id="password" autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                                    <label for="remember_me" class="form-check-label">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white"> {{ __('Log in') }}</button>
                                </div>
                                <a href="{{route('register')}}" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
