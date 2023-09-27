<!DOCTYPE html>
<html lang="en">
@include('frontend.layout.header-script')

<script>
    const ToastToRight = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const ToastCenter = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>
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


@stack('scripts')
</html>
