<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('public/css/boostrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/header.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/footer.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('public/js/jquery.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @stack('css')
</head>
<body>
    
    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    @stack('scripts')
    <script src="{{ asset('public/js/cart.js') }}"></script>

</body>

</html>
