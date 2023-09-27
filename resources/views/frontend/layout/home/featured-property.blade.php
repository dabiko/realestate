<section class="feature-section sec-pad bg-color-1">
<div class="auto-container">
    <div class="sec-title centred">
        <h5>Features</h5>
        <h2>Featured Property</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
    </div>
    <div class="row clearfix">

         @foreach($featured_property as $property)
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
    <div class="more-btn centred"><a href="" class="theme-btn btn-one">View All Listing</a></div>
</div>
</section>
