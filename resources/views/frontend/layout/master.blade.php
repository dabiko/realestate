<!DOCTYPE html>
<html lang="en">
@include('frontend.layout.header-script')
<body>

<div class="boxed_wrapper">


    @yield('preloader')

    {{--     main header--}}
    @include('frontend.layout.header')

    {{--    Mobile Menu    --}}
    @include('frontend.layout.mobile-menu')


    @yield('content')


    {{--    main-footer --}}
    @include('frontend.layout.footer')


    {{--    Scroll to top--}}
    @include('frontend.layout.scroll-to-top')
</div>

@include('frontend.layout.footer-script')
</body>
</html>
