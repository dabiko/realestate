@extends('frontend.layout.master')

@section('title')
    {{ config('app.name') }} | Dashboard
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

    <section class="sidebar-page-container blog-details sec-pad-2">
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
                                <h4>Category</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list ">

                                    <li class="current">  <a href="{{route('user.dashboard')}}"><i class="fab fa fa-envelope "></i> Dashboard </a></li>


                                    <li><a href="{{route('user.profile.edit')}}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                                    <li><a href="blog-details.html"><i class="fa fa-credit-card" aria-hidden="true"></i> Buy credits<span class="badge badge-info">( 10 credits)</span></a></li>
                                    <li><a href="blog-details.html"><i class="fa fa-list-alt" aria-hidden="true"></i></i> Properties </a></li>
                                    <li><a href="blog-details.html"><i class="fa fa-indent" aria-hidden="true"></i> Add a Property  </a></li>
                                    <li><a href="{{route('user.password.change')}}"><i class="fa fa-key" aria-hidden="true"></i> Security </a></li>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" href="{{route('logout')}}">
                                                <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                                                {{ __('Log Out') }}
                                            </a>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


                @if (Route::currentRouteName() === 'user.dashboard')

                    @include('profile.partials.profile-info')

                @elseif(Route::currentRouteName() === 'user.profile.edit')

                    @include('profile.partials.edit-profile')

                @elseif(Route::currentRouteName() === 'user.password.change')

                    @include('profile.partials.update-password')

                @endif


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
@push('scripts')
    <script>

        $(document).ready(function () {
            $('#image').change(function (event) {

                let reader = new FileReader();

                reader.onload = function (event) {

                    $('#show-image').attr('src', event.target.result);

                }

                reader.readAsDataURL(event.target.files['0']);

            })
        })

    </script>
@endpush
