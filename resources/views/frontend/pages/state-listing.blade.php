@extends('frontend.layout.master')

@section('title')

    {{ config('app.name') }} | Popular properties

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
                <h1>All Properties by States </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li> state </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="deals-style-two sec-pad">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>All Most Popular Places</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore magna aliqua enim.</p>
            </div>
            <div class="sortable-masonry">
                <div class="items-container row clearfix">
                    @foreach($states as $state)
                        @php
                            $popular_places = \App\Models\Property::with(['state'])->where('state_id',$state->id)->get();
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
        </div>
    </section>
    @include('frontend.layout.subscription')
@endsection
