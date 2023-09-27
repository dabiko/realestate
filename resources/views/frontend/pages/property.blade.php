@extends('frontend.layout.master')

@section('title')

    {{ config('app.name') }} | {{$property->name}}

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
                <h1>{{$property->name}}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>{{$property->name}}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="property-details property-details-one">
        <div class="auto-container">
            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">
                    <h3>{{$property->name}}</h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">
                            <figure class="author-thumb"><img src="{{empty(!$property->agent->photo) ? asset($property->agent->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                            <h6>{{$property->agent->name}}</h6>
                        </div>
                        <ul class="rating clearfix pull-left">
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-40"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            <li><a href="property-details.html">Building</a></li>
                            <li><a href="javascript:void(0)">For {{$property->purpose}}</a></li>
                        </ul>
                        <div class="price-box pull-right">
                            <h3>${{$property->low_price}}.00</h3>
                        </div>
                    </div>
                    <ul class="other-option pull-right clearfix">
                        <li><a href="property-details.html"><i class="icon-37"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-38"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                    </ul>
                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-details-content">

                        @if($sliders->Count() > 0)
                            <div class="carousel-inner">
                                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                    @foreach($sliders as $slider)
                                        <figure class="image-box"><img src="{{ empty(!asset($slider->image)) ? asset($slider->image) : url('frontend/assets/images/resource/property-details-1.jpg')}}" alt=""></figure>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        <div class="discription-box content-widget">
                            <div class="title-box">
                                <h4>Property Description</h4>
                            </div>
                            <div class="text">
                                <p>{{  strip_tags($property->long_desc)   }} </p>
                            </div>
                        </div>

                            @if($details->Count() > 0)
                                <div class="details-box content-widget">
                                    <div class="title-box">
                                        <h4>Property Details</h4>
                                    </div>
                                    <ul class="list clearfix">
                                        @foreach($details as $detail)
                                            <li>{{$detail->detail->name}}: <span>{{$detail->value}}</span></li>
                                        @endforeach

                                    </ul>
                                </div>
                            @endif

                            @if($amenities->Count() > 0)
                                <div class="amenities-box content-widget">
                                    <div class="title-box">
                                        <h4>Amenities</h4>
                                    </div>
                                    <ul class="list clearfix">
                                        @foreach($amenities as $amenity)
                                            <li>{{$amenity->amenity->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(!empty($plansActive))
                                <div class="floorplan-inner content-widget">
                                    <div class="title-box">
                                        <h4>Floor Plan</h4>
                                    </div>
                                    <ul class="accordion-box">

                                        <li class="accordion block active-block">
                                            <div class="acc-btn active">
                                                <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                                <h5>{{$plansActive->name}}</h5>
                                            </div>
                                            <div class="acc-content current">
                                                <div class="content-box">
                                                    <p>{{$plansActive->short_desc}}</p>
                                                    <figure class="image-box">
                                                        <img src="{{asset($plansActive->image)}}" alt="">
                                                    </figure>
                                                </div>
                                            </div>
                                        </li>
                                        @foreach($plans as $plan)
                                            <li class="accordion block">
                                                <div class="acc-btn">
                                                    <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                                    <h5>{{$plan->name}}</h5>
                                                </div>
                                                <div class="acc-content">
                                                    <div class="content-box">
                                                        <p>{{$plan->short_desc}}</p>
                                                        <figure class="image-box">
                                                            <img src="{{asset($plan->image)}}" alt="">
                                                        </figure>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach



                                    </ul>
                                </div>
                            @endif

                            @if($locations->Count() > 0)
                                <div class="location-box content-widget">
                                    <div class="title-box">
                                        <h4>Location</h4>
                                    </div>

                                    <ul class="info clearfix">
                                        @foreach($locations as $location)
                                            <li><span>{{$location->name}}:</span> {{$location->value}}</li>
                                        @endforeach
                                    </ul>
                                    <div class="google-map-area">
                                        <div
                                            class="google-map"
                                            id="contact-google-map"
                                            data-map-lat="{{$maps->latitude}}"
                                            data-map-lng="{{$maps->longitude}}"
                                            data-icon-path="{{asset('frontend/assets/images/icons/map-marker.png')}}"
                                            data-map-title="Sadi, Bonapriso, Makepe"
                                            data-map-zoom="12"
                                            data-markers='{"marker-1": [{{$maps->latitude}}, {{$maps->longitude}}, "<h4>Branch Office</h4><p>77/99 Douala-Makepe</p>","{{asset('frontend/assets/images/icons/map-marker.png')}}"]}'>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($facilities->Count() > 0)
                                <div class="nearby-box content-widget">
                                    <div class="title-box">
                                        <h4>What’s Nearby?</h4>
                                    </div>
                                    <div class="inner-box">

                                        @foreach($facilities as $facility)
                                            @php
                                                $facility_item = \App\Models\PropertyFacilityItem::where('property_facility_id',$facility->facility_id)
                                                ->where('status',1)
                                                ->get();
                                            @endphp
                                            <div class="single-item">
                                                <div class="icon-box">{!! $facility->facility->icon !!}</div>
                                                <div class="inner">
                                                    <h5>{{$facility->facility->name}} : </h5>


                                                    @foreach($facility_item as $item)
                                                        <div class="box clearfix">
                                                            <div class="text pull-left">
                                                                <h6>{{$item->name}} <span>({{$item->distance}}km)</span></h6>
                                                            </div>
                                                            @if($item->rating == 1)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 1.5)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-40"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 2)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 2.5)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-40"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>

                                                                </ul>
                                                            @elseif ($item->rating == 3)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 3.5)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-40"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 4)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 4.5)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-40"></i></li>
                                                                </ul>
                                                            @elseif ($item->rating == 5)
                                                                <ul class="rating pull-right clearfix">
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                    <li><i class="icon-39"></i></li>
                                                                </ul>
                                                            @else

                                                                <ul class="rating pull-right clearfix">
                                                                    <li><p>0</p></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                    <li><i class="fa-regular fa-star"></i></li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endif

                            @if($stats->Count() > 0)
                                <div class="statistics-box content-widget">
                                    <div class="title-box">
                                        <h4>Page Statistics</h4>
                                    </div>
                                    <figure class="image-box">
                                        @foreach($stats as $stat)
                                            <a href="" class="lightbox-image" data-fancybox="gallery"><img src="{{asset($stat->image)}}" alt=""></a>
                                        @endforeach
                                    </figure>
                                </div>
                            @endif

                            @if(!empty($property->video_link))
                                <div class="statistics-box content-widget">
                                    <div class="title-box">
                                        <h4>Video</h4>
                                    </div>
                                    <figure class="image-box">
                                        <iframe
                                            width="700"
                                            height="415"
                                            src="{{$property->video_link}}"
                                            title="{{$property->name}}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen>
                                        </iframe>
                                    </figure>
                                </div>
                            @endif

                        <div class="schedule-box content-widget">
                            <div class="title-box">
                                <h4>Schedule A Tour</h4>
                            </div>
                            <div class="form-inner">
                                <form action="property-details.html" method="post">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-calendar-alt"></i>
                                                <input type="text" name="date" placeholder="Tour Date" id="datepicker">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-clock"></i>
                                                <input type="text" name="time" placeholder="Any Time">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Your Name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="tel" name="phone" placeholder="Your Phone" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="property-sidebar default-sidebar">
                        <div class="author-widget sidebar-widget">
                            <div class="author-box">
                                <figure class="author-thumb"><img src="{{empty(!$property->agent->photo) ? asset($property->agent->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                <div class="inner">
                                    <h4>{{$property->agent->name}}</h4>
                                    <ul class="info clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>{{$property->agent->address}}</li>
                                        <li><i class="fas fa-phone"></i><a href="tel:{{$property->agent->phone}}">{{$property->agent->phone}}</a></li>
                                    </ul>
                                    <div class="btn-box"><a href="agents-details.html">View Listing</a></div>
                                </div>
                            </div>
                            <div class="form-inner">
                                <form action="property-details.html" method="post" class="default-form">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="calculator-widget sidebar-widget">
                            <div class="calculate-inner">
                                <div class="widget-title">
                                    <h4>Mortgage Calculator</h4>
                                </div>
                                <form method="post" action="mortgage-calculator.html" class="default-form">
                                    <div class="form-group">
                                        <i class="fas fa-dollar-sign"></i>
                                        <input type="number" name="total_amount" placeholder="Total Amount">
                                    </div>
                                    <div class="form-group">
                                        <i class="fas fa-dollar-sign"></i>
                                        <input type="number" name="down_payment" placeholder="Down Payment">
                                    </div>
                                    <div class="form-group">
                                        <i class="fas fa-percent"></i>
                                        <input type="number" name="interest_rate" placeholder="Interest Rate">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-calendar-alt"></i>
                                        <input type="number" name="loan" placeholder="Loan Terms(Years)">
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <select class="wide">
                                                <option data-display="Monthly">Monthly</option>
                                                <option value="1">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Calculate Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="similar-content">
                <div class="title">
                    <h4>Similar Properties</h4>
                </div>
                <div class="row clearfix">
                    @foreach($similar_property as $similar)

                        <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                            <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{asset($similar->thumbnail)}}" alt=""></figure>
                                        <div class="batch"><i class="icon-11"></i></div>
                                        <span class="category">{{$similar->tag}}</span>
                                    </div>
                                    <div class="lower-content">
                                        <div class="author-info clearfix">
                                            <div class="author pull-left">
                                                <figure class="author-thumb"><img src="{{empty(!$similar->agent->photo) ? asset($similar->agent->photo) : url('upload/no_image.jpg') }}" alt=""></figure>
                                                <h6>{{$similar->agent->name}}</h6>
                                            </div>
                                            <div class="buy-btn pull-right"><a href="{{route('property.details', Crypt::encryptString($similar->id) )}}">For {{$similar->purpose}}</a></div>
                                        </div>
                                        <div class="title-text"><h4><a href="{{route('property.details', Crypt::encryptString($similar->id))}}">{{$similar->name}}</a></h4></div>
                                        <div class="price-box clearfix">
                                            <div class="price-info pull-left">
                                                <h6>Start From</h6>
                                                <h4>${{$similar->low_price}}.00</h4>
                                            </div>
                                            <ul class="other-option pull-right clearfix">
                                                <li><a href="{{route('property.details', Crypt::encryptString($similar->id))}}"><i class="icon-12"></i></a></li>
                                                <li><a href="{{route('property.details', Crypt::encryptString($similar->id))}}"><i class="icon-13"></i></a></li>
                                            </ul>
                                        </div>
                                        <p>{{$similar->short_desc}}</p>
                                        <ul class="more-details clearfix">
                                            <li><i class="icon-14"></i>{{$similar->beds}} Beds</li>
                                            <li><i class="icon-15"></i>{{$similar->bath}} Baths</li>
                                            <li><i class="icon-16"></i>{{$similar->size}} Sq Ft</li>
                                        </ul>
                                        <div class="btn-box"><a href="{{route('property.details', Crypt::encryptString($similar->id))}}" class="theme-btn btn-two">See Details</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </section>
    @include('frontend.layout.subscription')
@endsection
