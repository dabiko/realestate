<section class="feature-section sec-pad bg-color-1">
<div class="auto-container">
    <div class="sec-title centred">
        <h5>Features</h5>
        <h2>Featured Property</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
    </div>
    <div class="row clearfix">

         @foreach($featured_property as $featured)

             @php
               $details = \App\Models\PropertyDetail::where('property_id', $featured->id)->get();
             @endphp
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="{{asset($featured->thumbnail)}}" alt=""></figure>
                            <div class="batch"><i class="icon-11"></i></div>
                            <span class="category">{{$featured->tag}}</span>
                        </div>
                        <div class="lower-content">
                            <div class="author-info clearfix">
                                <div class="author pull-left">
                                    <figure class="author-thumb"><img src="{{asset($featured->agent->photo)}}" alt=""></figure>
                                    <h6>{{$featured->agent->name}}</h6>
                                </div>
                                <div class="buy-btn pull-right"><a href="property-details.html">For {{$featured->purpose}}</a></div>
                            </div>
                            <div class="title-text"><h4><a href="property-details.html">{{$featured->name}}</a></h4></div>
                            <div class="price-box clearfix">
                                <div class="price-info pull-left">
                                    <h6>Start From</h6>
                                    <h4>${{$featured->low_price}}.00</h4>
                                </div>
                                <ul class="other-option pull-right clearfix">
                                    <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                    <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                </ul>
                            </div>
                            <p>{{$featured->short_desc}}</p>
                            <ul class="more-details clearfix">
                                @foreach($details as $detail)

                                    <li><i class="icon-14"></i>3 {{$detail}}</li>
                                @endforeach

                                <li><i class="icon-15"></i>2 Baths</li>
                                <li><i class="icon-16"></i>600 Sq Ft</li>
                            </ul>
                            <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See Details</a></div>
                        </div>
                    </div>
                </div>
            </div>
         @endforeach

    </div>
    <div class="more-btn centred"><a href="" class="theme-btn btn-one">View All Listing</a></div>
</div>
</section>
