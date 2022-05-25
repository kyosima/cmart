<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="url-home" content="{{ URL::to('/') }}" />
    <meta name="url-home-customer" content="{{ url('/') }}" />
    {{-- <meta name="url-ekyc" content="{{ route('ekyc.getVerify') }}" /> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('public/js/slickslider.js') }}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="{{ asset('public/css/boostrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/header.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/footer.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/search.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{ asset('public/vnpt-econtract/vnpt-econtract.min.css') }}">
    <script src="{{ asset('public/vnpt-econtract/vnpt-econtract.min.js')}}"></script>
    @stack('css')
</head>

<body>
        {{-- @if (Auth::check()) 
            @if (Auth::user()->is_kyc == 0) 
                <script>
                    location.href= $("meta[name='url-ekyc']").attr("content");
                </script>
            @endif
        @endif --}}
    @include('layout.header')

    @yield('content')

    @include('layout.footer')

    @stack('scripts')
    <script src="{{ asset('public/js/cart.js') }}"></script>
    <script src="{{ asset('public/js/boostrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/search.js') }}"></script>
    <script src="{{ asset('public/js/category.js') }}"></script>

</body>

</html>
