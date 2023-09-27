@extends('frontend.layout.master')

@section('title')

        {{ config('app.name') }} | Compare properties

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
                <h1>Compare Properties</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>compare properties</li>
                </ul>
            </div>
        </div>
    </section>


    <section class="properties-section centred">
        <div class="auto-container">
            <div class="table-outer" id="responseData">
                @if($count > 0)
                    <table class="properties-table">
                        <thead class="table-header">
                        <tr>
                            <th>Property Info </th>
                            @foreach($compare as $list)

                                <th>
                                    <a style="border-color: #00BB77"  type="submit" class="text-body"  onclick="compareRemove({{$list->id}})">
                                        <i style="border-color: #00BB77; color: #e01b1b" class="fa fa-trash"></i>
                                    </a>

                                   <figure class="image-box"><img src="{{asset($list->property->thumbnail)}}" alt=""></figure>
                                    <div class="title">{{$list->property->name}}</div>
                                   <div class="price">$ {{$list->property->low_price}}</div>
                                </th>
                            @endforeach

                        </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <p>City</p>
                                </td>
                                @foreach($compare as $list)
                                    <td>
                                        <p>{{$list->location->value}}</p>
                                    </td>
                                @endforeach

                            </tr>
                            <tr>
                                <td>
                                    <p>Area</p>
                                </td>
                                @foreach($compare as $list)
                                    <td>
                                        <p>{{$list->property->size}} Sq Ft</p>
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <td>
                                    <p>Bedrooms</p>
                                </td>
                                @foreach($compare as $list)
                                    <td>
                                        <p>{{$list->property->beds}} </p>
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <td>
                                    <p>Bathrooms</p>
                                </td>
                                @foreach($compare as $list)
                                    <td>
                                        <p>{{$list->property->bath}}</p>
                                    </td>
                                @endforeach
                            </tr>

                        </tbody>

                    </table>

                @else
                    <div class="deals-block-one">
                        <div colspan="100%" style="text-align: center;" class="alert alert-primary" role="alert">
                            <i data-feather="alert-circle"></i>
                            <strong>Your compare list is empty !!! </strong> add properties <a href="">Here</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('frontend.layout.subscription')

@endsection

