@extends('frontend.layout.master')

@section('title')

    {{ config('app.name') }} | {{$agent->name}}

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
                <h1>{{$agent->name}} Details</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>{{$agent->name}}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="agent-details">
        <div class="auto-container">
            <div class="agency-details-content">
                <div class="agents-block-one">
                    <div class="inner-box mr-0">
                        <figure class="image-box"><img src="{{asset(empty(!$agent->photo) ? $agent->photo : url('upload/no_image.jpg'))}}" alt=""></figure>
                        <div class="content-box">
                            <div class="upper clearfix">
                                <div class="title-inner pull-left">
                                    <h4>{{$agent->name}}</h4>
                                    <span class="designation">{{$agent->role}}</span>
                                </div>
                                <ul class="social-list pull-right clearfix">
                                    <li><a href="agency-details.html"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="agency-details.html"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="agency-details.html"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="text">
                                <p>{{$agent->description}}</p>
                            </div>
                            <ul class="info clearfix mr-0">
                                <li><i class="fab fa fa-envelope"></i><a href="mailto:{{$agent->email}}">{{$agent->email}}</a></li>
                                <li><i class="fab fa fa-phone"></i><a href="tel:{{$agent->phone}}">{{$agent->phone}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@if($count > 0)
    <section class="agents-page-section agent-details-page">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="agents-content-side tabs-box">
                        <div class="group-title">
                            <h3>Listing By {{$agent->name}}</h3>
                        </div>
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left">
                                <div class="tab-btn-box">
                                    <ul class="tab-btns tab-buttons centred clearfix">
                                        <li class="tab-btn active-btn" data-tab="#tab-1">All</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="right-column pull-right clearfix">
                                <div class="short-box clearfix">
                                    <div class="select-box">
                                        <select class="wide">
                                            <option data-display="Sort by: Newest">Sort by: Newest</option>
                                            <option value="1">New Arrival</option>
                                            <option value="2">Top Rated</option>
                                            <option value="3">Offer Place</option>
                                            <option value="4">Most Place</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="short-menu clearfix">
                                    <button class="list-view on"><i class="icon-35"></i></button>
                                    <button class="grid-view"><i class="icon-36"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="wrapper list">
                                    <div class="deals-list-content list-item">
                                        @foreach($agent_properties as $property)
                                            @php
                                                $count_list = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                  ->where('property_id', $property->id)
                                                  ->count();

                                                $count_compare = \App\Models\Compare::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                  ->where('property_id', $property->id)
                                                  ->count();
                                            @endphp
                                            <div class="deals-block-one">
                                                <div class="inner-box">
                                                    <div class="image-box">
                                                        <figure class="image"><img style="width: 300px; height: 350px;" src="{{asset($property->thumbnail)}}" alt=""></figure>
                                                        <div class="batch"><i class="icon-11"></i></div>
                                                        <span class="category">{{$property->tag}}</span>
                                                        <div class="buy-btn"><a href="{{route('property.details',Crypt::encryptString($property->id))}}">For {{$property->purpose}}</a></div>
                                                    </div>
                                                    <div class="lower-content">
                                                        <div class="title-text"><h4><a href="{{route('property.details', Crypt::encryptString($property->id))}}">{{$property->name}}</a></h4></div>
                                                        <div class="price-box clearfix">
                                                            <div class="price-info pull-left">
                                                                <h6>Start From</h6>
                                                                <h4>$ {{$property->low_price}}</h4>
                                                            </div>
                                                            <div class="author-box pull-right">
                                                                <figure class="author-thumb">
                                                                    <img src="{{empty(!$property->agent->photo) ? asset($property->agent->photo) : url('upload/no_image.jpg') }}" alt="">
                                                                    <span>{{$property->agent->name}}</span>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <p>{{$property->desc}}</p>
                                                        <ul class="more-details clearfix">
                                                            <li><i class="icon-14"></i>{{$property->beds}} Beds</li>
                                                            <li><i class="icon-15"></i>{{$property->bath}} Baths</li>
                                                            <li><i class="icon-16"></i>{{$property->size}} Sq Ft</li>
                                                        </ul>
                                                        <div class="other-info-box clearfix">
                                                            <div class="btn-box pull-left"><a href="{{route('property.details',Crypt::encryptString($property->id))}}" class="theme-btn btn-two">See Details</a></div>
                                                            <ul class="other-option pull-right clearfix">
                                                                @if($count_compare > 0)
                                                                    <li id="compare-{{$property->id}}">
                                                                        <a
                                                                            aria-label="Add to compare"
                                                                            class="action-btn "
                                                                            id="{{Crypt::encryptString($property->id)}}"
                                                                            onclick="addToCompare(this.id)"
                                                                        >
                                                                            <i
                                                                                id="list-status"
                                                                                onMouseOver="this.style.color='white'"
                                                                                onMouseOut="this.style.color='#00BB77'"
                                                                                style="color: #00BB77; " class="icon-12"></i>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li id="compare-{{$property->id}}"><a
                                                                            aria-label="Add to compare"
                                                                            class="action-btn"
                                                                            id="{{Crypt::encryptString($property->id)}}"
                                                                            onclick="addToCompare(this.id)"
                                                                        >
                                                                            <i class="icon-12"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif




                                                                @if($count_list > 0)
                                                                    <li id="wishlist-{{$property->id}}">
                                                                        <a
                                                                            aria-label="Add to wishlist"
                                                                            class="action-btn "
                                                                            id="{{Crypt::encryptString($property->id)}}"
                                                                            onclick="addToWishList(this.id)"
                                                                        >
                                                                            <i
                                                                                id="list-status"
                                                                                onMouseOver="this.style.color='white'"
                                                                                onMouseOut="this.style.color='#00BB77'"
                                                                                style="color: #00BB77; " class="icon-13"></i>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li id="wishlist-{{$property->id}}"><a
                                                                            aria-label="Add to wishlist"
                                                                            class="action-btn"
                                                                            id="{{Crypt::encryptString($property->id)}}"
                                                                            onclick="addToWishList(this.id)"
                                                                        >
                                                                            <i class="icon-13"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="deals-grid-content">
                                        <div class="row clearfix">

                                                @foreach($agent_properties as $property)
                                                    @php
                                                        $count_list = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                          ->where('property_id', $property->id)
                                                          ->count();

                                                        $count_compare = \App\Models\Compare::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                          ->where('property_id', $property->id)
                                                          ->count();
                                                    @endphp
                                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                                        <div class="feature-block-one">
                                                            <div class="inner-box">
                                                                <div class="image-box">
                                                                    <figure class="image"><img src="{{asset($property->thumbnail)}}" alt=""></figure>
                                                                    <div class="batch"><i class="icon-11"></i></div>
                                                                    <span class="category">{{$property->tag}}</span>
                                                                </div>
                                                                <div class="lower-content">
                                                                    <div class="author-info clearfix">
                                                                        <div class="author pull-left">
                                                                            <figure class="author-thumb"><img src="{{empty(!$property->agent->photo) ? asset($property->agent->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                                                            <h6>{{$property->agent->name}}</h6>
                                                                        </div>
                                                                        <div class="buy-btn pull-right"><a href="{{route('property.details', Crypt::encryptString($property->id) )}}">For {{$property->purpose}}</a></div>
                                                                    </div>
                                                                    <div class="title-text"><h4><a href="{{route('property.details', Crypt::encryptString($property->id))}}">{{$property->name}}</a></h4></div>
                                                                    <div class="price-box clearfix">
                                                                        <div class="price-info pull-left">
                                                                            <h6>Start From</h6>
                                                                            <h4>${{$property->low_price}}.00</h4>
                                                                        </div>
                                                                        <ul class="other-option pull-right clearfix">

                                                                            @if($count_compare > 0)
                                                                                <li id="compare-{{$property->id}}">
                                                                                    <a
                                                                                        aria-label="Add to compare"
                                                                                        class="action-btn "
                                                                                        id="{{Crypt::encryptString($property->id)}}"
                                                                                        onclick="addToCompare(this.id)"
                                                                                    >
                                                                                        <i
                                                                                            id="list-status"
                                                                                            onMouseOver="this.style.color='white'"
                                                                                            onMouseOut="this.style.color='#00BB77'"
                                                                                            style="color: #00BB77; " class="icon-12"></i>
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                                <li id="compare-{{$property->id}}"><a
                                                                                        aria-label="Add to compare"
                                                                                        class="action-btn"
                                                                                        id="{{Crypt::encryptString($property->id)}}"
                                                                                        onclick="addToCompare(this.id)"
                                                                                    >
                                                                                        <i class="icon-12"></i>
                                                                                    </a>
                                                                                </li>
                                                                            @endif




                                                                            @if($count_list > 0)
                                                                                <li id="wishlist-{{$property->id}}">
                                                                                    <a
                                                                                        aria-label="Add to wishlist"
                                                                                        class="action-btn "
                                                                                        id="{{Crypt::encryptString($property->id)}}"
                                                                                        onclick="addToWishList(this.id)"
                                                                                    >
                                                                                        <i
                                                                                            id="list-status"
                                                                                            onMouseOver="this.style.color='white'"
                                                                                            onMouseOut="this.style.color='#00BB77'"
                                                                                            style="color: #00BB77; " class="icon-13"></i>
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                                <li id="wishlist-{{$property->id}}"><a
                                                                                        aria-label="Add to wishlist"
                                                                                        class="action-btn"
                                                                                        id="{{Crypt::encryptString($property->id)}}"
                                                                                        onclick="addToWishList(this.id)"
                                                                                    >
                                                                                        <i class="icon-13"></i>
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                        </ul>
                                                                    </div>
                                                                    <p>{{$property->short_desc}}</p>
                                                                    <ul class="more-details clearfix">
                                                                        <li><i class="icon-14"></i>{{$property->beds}} Beds</li>
                                                                        <li><i class="icon-15"></i>{{$property->bath}} Baths</li>
                                                                        <li><i class="icon-16"></i>{{$property->size}} Sq Ft</li>
                                                                    </ul>
                                                                    <div class="btn-box"><a href="{{route('property.details',Crypt::encryptString($property->id))}}" class="theme-btn btn-two">See Details</a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="default-sidebar agent-sidebar">
                        <div class="agents-contact sidebar-widget">
                            <div class="widget-title">
                                <h5>Contact To {{$agent->name}}</h5>
                            </div>
                            <div class="form-inner">
                                                                <form action="{{route('user.property.message')}}" method="POST" class="default-form">

                                                                    @method('POST')
                                                                    @csrf

                                                                    <input type="hidden" name="property_id" value="{{Crypt::encryptString($property->id)}}" >
                                                                    <input type="hidden" name="agent_id" value="{{Crypt::encryptString($property->agent->id)}}" >


                                                                    <div class="form-group">
                                                                        <input disabled type="text" name="name" value="{{Auth::user() ? Auth::user()->name : 'Your name'}}" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input disabled type="email" name="email"  value="{{Auth::user() ? Auth::user()->email : 'Your Email'}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input disabled type="text" name="phone"  value="{{Auth::user() ? Auth::user()->phone : 'Your Phone'}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <textarea name="message" class="@error('message') is-invalid @enderror" placeholder="Message"></textarea>
                                                                        @error('message')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group message-btn">
                                                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                                                    </div>
                                                                </form>

                            </div>
                        </div>
                        <div class="category-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Status Of Property</h5>
                            </div>
                            <ul class="category-list clearfix">
                                <li><a href="agency-details.html">For Rent <span>({{$rent}})</span></a></li>
                                <li><a href="agency-details.html">For Sale <span>({{$sale}})</span></a></li>
                                <li><a href="agency-details.html">For Buy <span>({{$buy}})</span></a></li>
                            </ul>
                        </div>
                        <div class="featured-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Featured Properties</h5>
                            </div>
                            <div class="single-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                                @foreach($featured_properties as $featured_property)
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{asset($featured_property->thumbnail)}}" alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">{{$featured_property->tag}}</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text"><h4><a href="{{route('property.details', Crypt::encryptString($featured_property->id) )}}">{{$featured_property->name}}</a></h4></div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info">
                                                        <h6>Start From</h6>
                                                        <h4>$ {{$featured_property->low_price}}</h4>
                                                    </div>
                                                </div>
                                                <p>{{$featured_property->desc}}</p>
                                                <div class="btn-box"><a href="{{route('property.details', Crypt::encryptString($featured_property->id) )}}" class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="agents-page-section agent-details-page">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="agents-content-side tabs-box">
                        <div class="tabs-content">
                            <div class="alert alert-primary text-center" role="alert">
                                <i class="btn-inverse-info"></i>
                                <b> Empty Listing !!. No Listing By {{$agent->name}}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
    @include('frontend.layout.subscription')
@endsection
