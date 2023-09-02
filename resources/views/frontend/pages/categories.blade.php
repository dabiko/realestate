@extends('frontend.layout.master')

@section('title')

        {{ config('app.name') }} | Categories

@endsection

@section('preloader')
    {{--     preloader--}}
    @include('frontend.layout.preloader')
@endsection


@section('content')

    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-9.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Categories</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>Categories</li>
                </ul>
            </div>
        </div>
    </section>


    <!-- category-section -->
    <section class="category-section category-page centred mr-0 pt-120 pb-90">
        <div class="auto-container">
            <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <ul class="category-list clearfix">

                    @foreach($categories as $category)
                        @php
                            $count = \App\Models\Property::where('category_id',$category->id )->count();
                        @endphp
                        <li>
                            <div class="category-block-one">
                                <div class="inner-box">
                                    <div class="icon-box"><i class="{{$category->icon}}"></i></div>
                                    <h5><a href="property-details.html">{{$category->name}}</a></h5>
                                    <span>{{$count}}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>
    <!-- category-section end -->


    <!-- cta-section -->
    <section class="cta-section alternate-2 centred" style="background-image: url(assets/images/background/cta-1.jpg);">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <div class="text">
                    <h2>Looking to Buy a New Property or <br />Sell an Existing One?</h2>
                </div>
                <div class="btn-box">
                    <a href="property-details.html" class="theme-btn btn-three">Rent Properties</a>
                    <a href="index.html" class="theme-btn btn-one">Buy Properties</a>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->


    <!-- feature-section -->
    <section class="feature-section sec-pad">
        <div class="auto-container">
            <div class="sec-title centred">
                <h5>Latest Property</h5>
                <h2>Recent Properties</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/feature/feature-1.jpg" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        <figure class="author-thumb"><img src="assets/images/feature/author-1.jpg" alt=""></figure>
                                        <h6>Michael Bean</h6>
                                    </div>
                                    <div class="buy-btn pull-right"><a href="property-details.html">For Buy</a></div>
                                </div>
                                <div class="title-text"><h4><a href="property-details.html">Villa on Grand Avenue</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>$30,000.00</h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>3 Beds</li>
                                    <li><i class="icon-15"></i>2 Baths</li>
                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                </ul>
                                <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/feature/feature-2.jpg" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        <figure class="author-thumb"><img src="assets/images/feature/author-2.jpg" alt=""></figure>
                                        <h6>Robert Niro</h6>
                                    </div>
                                    <div class="buy-btn pull-right"><a href="property-details.html">For Rent</a></div>
                                </div>
                                <div class="title-text"><h4><a href="property-details.html">Contemporary Apartment</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>$45,000.00</h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>3 Beds</li>
                                    <li><i class="icon-15"></i>2 Baths</li>
                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                </ul>
                                <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="assets/images/feature/feature-3.jpg" alt=""></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        <figure class="author-thumb"><img src="assets/images/feature/author-3.jpg" alt=""></figure>
                                        <h6>Keira Mel</h6>
                                    </div>
                                    <div class="buy-btn pull-right"><a href="property-details.html">Sold Out</a></div>
                                </div>
                                <div class="title-text"><h4><a href="property-details.html">Luxury Villa With Pool</a></h4></div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>$63,000.00</h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>3 Beds</li>
                                    <li><i class="icon-15"></i>2 Baths</li>
                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                </ul>
                                <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-section end -->

    @include('frontend.layout.subscription')


@endsection

