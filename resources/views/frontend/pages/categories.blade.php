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
                                    <h5><a href="{{$count > 0 ? route('property.category', ['category' => Crypt::encryptString($category->id), ]) :  'javascript:void(0)'}}">{{$category->name}}</a></h5>
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
                    <h2>Looking to Buy a New Property, Rent a New Property or <br />Sell an Existing One?</h2>
                </div>
                <div class="btn-box">
                    <a href="{{route('property.listing', ['purpose' => 'rent', ])}}" class="theme-btn btn-three">Rent Properties</a>
                    <a href="{{route('property.listing', ['purpose' => 'buy', ])}}" class="theme-btn btn-one mr-3">Buy Properties</a>
                    <a href="{{route('property.listing', ['purpose' => 'sale', ])}}" class="theme-btn btn-three">Sale Properties</a>
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
                @foreach($recent_properties as $property)
                    @php
                        $count_list = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                          ->where('property_id', $property->id)
                          ->count();

                        $count_compare = \App\Models\Compare::where('user_id', \Illuminate\Support\Facades\Auth::id())
                          ->where('property_id', $property->id)
                          ->count();
                    @endphp

                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
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
                                        <div class="buy-btn pull-right"><a href="{{route('agent.listing', ['purpose' => $property->purpose, 'agent' => Crypt::encryptString($property->user_id)])}}">For {{$property->purpose}}</a></div>
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

        <div class="pagination-wrapper ">
            <div style="margin-left: 45%" class="ml-40">
                {{ $recent_properties->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
    <!-- feature-section end -->

    @include('frontend.layout.subscription')


@endsection

