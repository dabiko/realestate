<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{asset('frontend/assets/images/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css"/>

    <!-- Stylesheets -->
    <link href="{{asset('frontend/assets/css/font-awesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/owl.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/color/theme-color.css')}}" id="jssDefault" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/switcher-style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">

    {{--SweetAlert2--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>
