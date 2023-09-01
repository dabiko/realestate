<!DOCTYPE html>
<html lang="en">
@include('agent.layout.header-scripts')
<script>
    const ToastToRight = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 2000,
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
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>
<body>
<div class="main-wrapper">

    @include('agent.layout.navigation')


    <div class="page-wrapper">

        @include('agent.layout.header')


        <div class="page-content">
            @yield('content')
        </div>

        @include('agent.layout.footer')

    </div>
</div>
@include('agent.layout.footer-scripts')

</body>

@stack('scripts')
</html>

