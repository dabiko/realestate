@extends('frontend.layout.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('preloader')
    {{--     preloader--}}
    @include('frontend.layout.preloader')
@endsection

@section('content')


    {{--    banner-section --}}
    @include('frontend.layout.home.banner')


    {{--    category-section--}}
    @include('frontend.layout.home.category')


    {{--    feature-section--}}
    @include('frontend.layout.home.featured-property')


    {{--   video-section --}}
    @include('frontend.layout.home.video')


    {{--    deals-section --}}
    @include('frontend.layout.home.best-deals')



    {{--    testimonial-section end --}}
    @include('frontend.layout.home.testimonials')


    {{--    chosen-section--}}
    @include('frontend.layout.home.chosen-section')


    {{--     place-section--}}
    @include('frontend.layout.home.top-section')


    {{--    agent-section--}}
    @include('frontend.layout.home.agent-section')


    {{--    cta-section --}}
    @include('frontend.layout.home.cta-section')


    {{--    news-section--}}
    @include('frontend.layout.home.news-section')


    {{--   download-section--}}
    @include('frontend.layout.home.download-section')


@endsection
