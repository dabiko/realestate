
<section class="deals-style-two sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Top Places</h5>
            <h2>Most Popular Places</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
        </div>
        <div class="sortable-masonry">
            <div class="items-container row clearfix">
                @foreach($states as $state)
                    @php
                       $popular_places = \App\Models\Property::where('state_id',$state->id)->get();
                    @endphp
                        @if(count($popular_places) > 0)
                                <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all brand illustration print software logo">
                                    <div class="place-block-one">
                                        <div class="inner-box">
                                            <figure class="image-box"><img src="{{asset(empty(!$state->image) ? $state->image : 'frontend/assets/images/resource/place-2.jpg')}}" alt=""></figure>
                                            <div class="text">
                                                <h4><a href="{{route('property.state', ['state' => $state->name, 'property' => Crypt::encryptString($state->id)])}}">{{$state->name}}</a></h4>
                                                <p>{{count($popular_places)}} Properties</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endif
                @endforeach
            </div>
        </div>
            <div class="more-btn centred"><a href="{{route('state.listing')}}" class="theme-btn btn-one">View All Listing</a></div>
    </div>
</section>
