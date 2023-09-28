<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>Discover St, New York, NY 10012, USA</li>
                    <li><i class="far fa-clock"></i>Mon - Sat  9.00 - 18.00</li>
                    <li><i class="far fa-phone"></i><a href="tel:2512353256">+251-235-3256</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
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
                    <figure class="logo"><a href="{{route('home')}}"><img src="{{asset('frontend/assets/images/logo.png')}}" alt=""></a></figure>
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
                                    <a href=""><span>Blog</span></a>
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
