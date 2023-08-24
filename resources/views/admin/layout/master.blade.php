<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header-scripts')
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
</html>
