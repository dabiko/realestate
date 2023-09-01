@extends('frontend.layout.master')

@section('title')
    {{ config('app.name') }} | Login
@endsection

@section('content')
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-9.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div>
        </div>

        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Authentication</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>Agent Log In</li>
                </ul>
            </div>
        </div>

    </section>

    <section class="ragister-section centred sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                    <div class="sec-title">
                        <h5>Homes</h5>
                    </div>
                    <div class="tabs-box">

                        <div class="centred clearfix">
                            <button style="color:#FFFFFF; background-color: #2DBE6C"  class="theme-btn  active-btn" type="button">Log In</button>

                            <a href="{{route('agent.register')}}">
                               <button style="color:#2DBE6C" class="theme-btn " type="button">Register</button>
                            </a>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <h4>Agent Log In</h4>

                                    <form action="{{ route('login') }}" method="POST" class="default-form">

                                        @csrf
                                        @method('POST')

                                        <div class="form-group">
                                            <label for="login">{{__('Email | Name | Phone')}}</label>
                                            <input type="text" name="login"  id="login" class="form-control @error('login') is-invalid @enderror" value="{{old('login')}}">
                                            @error('login')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" >
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-check mb-3">
                                            <label for="remember_me"> {{ __('Remember me') }}</label>
                                            <input type="checkbox" class="form-check" name="remember" id="remember_me">
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">{{__('Log In')}}</button>
                                        </div>
                                    </form>

                                    <div class="othre-text">
                                        @if (Route::has('password.request'))
                                            <p>{{__('Forgot your password?')}}  <a href="{{route('password.request')}}">  {{__('Reset password')}} </a> </p>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="subscribe-section bg-color-3">
        <div class="pattern-layer" style="background-image: url({{asset('frontend/assets/images/shape/shape-2.png')}});"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                    <div class="text">
                        <span>Subscribe</span>
                        <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                    <div class="form-inner">
                        <form action="contact.html" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter your email" required="">
                                <button type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
