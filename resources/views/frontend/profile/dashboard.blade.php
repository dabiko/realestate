@extends('frontend.layout.master')

@section('title')
    @if (Route::currentRouteName() === 'user.dashboard')

        {{ config('app.name') }} | Dashboard

    @elseif(Route::currentRouteName() === 'user.profile.edit')

        {{ config('app.name') }} | Update Profile

    @elseif(Route::currentRouteName() === 'user.password.change')

        {{ config('app.name') }} | Update Password

    @elseif(Route::currentRouteName() === 'user.profile.schedule')

        {{ config('app.name') }} | Scheduled Tours

    @elseif(Route::currentRouteName() === 'user.wishlist')

        {{ config('app.name') }} | My Wishlist

    @else

        {{ config('app.name') }} | Dashboard

    @endif

@endsection

@section('preloader')
    {{--     preloader--}}
    @include('frontend.layout.preloader')
@endsection


@section('content')
    <section class="page-title centred" style="background-image: url({{asset('frontend/assets/images/background/page-title-5.jpg')}});">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>User Profile </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>User Profile </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="property-page-section property-list">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">


                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-details.html">
                                            <img src="{{ (empty(!Auth::user()->photo)) ? asset(Auth::user()->photo): url('upload/no_image.jpg')}}" alt="profile"></a></figure>
                                    <h5><a href="blog-details.html">{{Auth::user()->name}} </a></h5>
                                    <p>{{Auth::user()->email}} </p>
                                </div>
                            </div>
                        </div>


                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                                <h4>Menu</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list ">

                                    <li class="current">  <a href="{{route('user.dashboard')}}"><i class="fab fa fa-home "></i> Dashboard </a></li>


                                    <li><a href="{{route('user.profile.edit')}}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                                    <li><a href="{{route('user.profile.schedule')}}"><i class="fa fa-envelope" aria-hidden="true"></i> Schedule Request<span class="badge badge-info">( schedules)</span></a></li>
                                    <li><a href=""><i class="fa fa-list-alt" aria-hidden="true"></i> Properties </a></li>
                                    <li><a href="{{route('user.compare')}}"><i class="fa-solid fa-code-compare" aria-hidden="true"></i> Compare  </a></li>
                                    <li><a href="{{route('user.wishlist')}}"><i class="fa fa-indent" aria-hidden="true"></i> Wishlist  </a></li>
                                    <li><a href="{{route('user.live-chat.index')}}"><i class="fa-brands fa-rocketchat" aria-hidden="true"></i> Live Chat  </a></li>
                                    <li><a href="{{route('user.password.change')}}"><i class="fa fa-key" aria-hidden="true"></i> Security </a></li>

                                    <li>
                                        <a href="{{route('user.logout')}}">
                                             <i class="fa-solid fa-right-from-bracket" aria-hidden="true">></i>
                                            {{ __('Log Out') }}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>



                @if (Route::currentRouteName() === 'user.dashboard')

                    @include('frontend.profile.partials.profile-info')

                @elseif(Route::currentRouteName() === 'user.profile.schedule')

                    @include('frontend.profile.partials.scheduled-tour')

                @elseif(Route::currentRouteName() === 'user.profile.edit')

                    @include('frontend.profile.partials.edit-profile')

                @elseif(Route::currentRouteName() === 'user.password.change')

                    @include('frontend.profile.partials.update-password')

                @elseif(Route::currentRouteName() === 'user.wishlist')
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="property-content-side">

                            <div class="wrapper list">
                                <div class="deals-list-content list-item">
                                    <div id="responseWishlist">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Route::currentRouteName() === 'user.live-chat.index')

                    @include('frontend.profile.partials.live-chat')

                @endif

            </div>
        </div>
    </section>


    @include('frontend.layout.subscription')

@endsection

