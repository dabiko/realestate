<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header-scripts')
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
<div class="main-wrapper">

    @include('admin.layout.navigation')


    <div class="page-wrapper">

        @include('admin.layout.header')


        <div class="page-content">
            @yield('content')
        </div>

        @include('admin.layout.footer')

    </div>
</div>
@include('admin.layout.footer-scripts')

</body>

@stack('scripts')
</html>

