<!DOCTYPE html>
<html lang="en-IN">

<head>
    <title>Home - {{ config('app.name') }} </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/hover.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}" />
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/animate.min.css') }}" rel="stylesheet" />
    <link id="MyStyleSheet" href="{{ asset('frontend/css/Layout.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/LayoutMR.css') }}" rel="stylesheet" type="text/css" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    {{-- <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" /> --}}
    <meta name="theme-color" content="#ffffff" />
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
</head>

@stack('styles')

<body>

    <x-frontend.header />

    {{ $slot }}

    <x-frontend.footer />

</body>

@stack('scripts')

</html>
