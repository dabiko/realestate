@extends('frontend.layout.master')

@section('title')
    {{ config('app.name') }} | Register
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
                    <li><a href="{{route('login')}}">Log In</a></li>
                    <li>Register</li>
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

                            <a href="{{route('login')}}">
                                <button style="color:#2DBE6C"   class="theme-btn  active-btn" type="button">Log In</button>
                            </a>

                            <button style="color:#FFFFFF; background-color: #2DBE6C" class="theme-btn " type="button">Register</button>

                        </div>
                        <div class="tabs-content">

                            <div class="tab active-tab" id="tab-2">
                                <div class="inner-box">
                                    <h4>Register</h4>

                                    <form
                                        action="{{ route('register') }}"
                                        method="POST" class="default-form"
                                    >
                                        @csrf
                                        @method('POST')

                                        <div class="form-group">
                                            <label for="name">{{__('Name')}}</label>
                                            <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="login">{{__('Email')}}</label>
                                            <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">{{__('Password')}}</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" >
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" >
                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">{{__('Register')}}</button>
                                        </div>
                                    </form>
                                    <div class="othre-text">
                                        <p>Already having an account? <a href="{{route('login')}}">Log In</a></p>
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
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
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
