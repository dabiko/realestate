@php
 $header_setting = \App\Models\SiteHeaderSetting::findOrFail(1);
@endphp

<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{$header_setting->address}}</li>
                    <li><i class="far fa-clock"></i>{{$header_setting->working_hours}}</li>
                    <li><i class="far fa-phone"></i><a href="tel:{{$header_setting->phone}}">{{$header_setting->phone}}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    {{ empty(!$header_setting->facebook ? '<li><a href=""><i class="fab fa-facebook-f"></i></a></li>' : '') }}
                    {{ empty(!$header_setting->twitter ? '<li><a href=""><i class="fab fa-twitter"></i></a></li>' : '') }}
                    {{ empty(!$header_setting->pinterest ? '<li><a href=""><i class="fab fa-pinterest-p"></i></a></li>' : '') }}
                    {{ empty(!$header_setting->google ? '<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>' : '') }}
                    {{ empty(!$header_setting->vimeo ? '<li><a href=""><i class="fab fa-vimeo-v"></i></a></li>' : '') }}
                </ul>
                @auth
                    <div class="sign-box">
                        <a href="{{route('user.dashboard')}}"><i class="fas fa-server"></i>Dashboard</a> &boxV;
                        <a href="{{route('user.logout')}}"><i class="fas fa-user"></i>Log Out</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{route('login')}}"><i class="fas fa-user"></i>Log In</a>
                    </div>
                @endauth

            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{route('home')}}"><img src="{{asset($header_setting->logo)}}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="">
                                    <a href="{{route('home')}}"><span>Home</span></a>
                                </li>

                                <li class="dropdown"><a href="{{route('properties')}}"><span>Property</span></a>
                                    <ul>
                                        <li><a href="{{route('property.listing', ['purpose' => 'rent', ])}}">Rent Property </a></li>
                                        <li><a href="{{route('property.listing', ['purpose' => 'buy', ])}}">Buy Property </a></li>
                                        <li><a href="{{route('property.listing', ['purpose' => 'sale', ])}}">Sale Property </a></li>
                                    </ul>
                                </li>

                                <li class="">
                                    <a href=""><span>Agents</span></a>
                                </li>

                                <li class="">
                                    <a href="{{route('blog-post.all')}}"><span>Blog</span></a>
                                </li>

                                <li class="">
                                    <a href=""><span>About Us</span></a>
                                </li>

                                <li>
                                    <a href=""><span>Contact</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box">
                    @auth
                    @else
                        <a href="{{route('agent.login')}}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{route('home')}}"><img src="{{asset('frontend/assets/images/logo.png')}}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div>
            </div>
        </div>
    </div>
</header>
