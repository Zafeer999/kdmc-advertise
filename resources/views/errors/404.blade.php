<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <link href="{{ asset('admin/dist/images/logo.svg') }}" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hoarding Permission || 404 Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css') }}" />
</head>

<body class="main">
    <div class="container">
        <div class="error-page d-flex flex-column flex-lg-row align-items-center justify-content-center h-screen text-center text-lg-start">
            <div class="-intro-x me-lg-20">
                <img alt="Rubick Bootstrap HTML Admin Template" class="h-48 h-lg-auto" src="{{ asset('admin/dist/images/error-illustration.svg') }}" />
            </div>
            <div class="text-white mt-10 mt-lg-0">
                <div class="intro-x fs-8xl fw-medium">404 </div>
                <div class="intro-x fs-xl fs-lg-3xl fw-medium mt-5">Oops. This page has ____ missing. </div>
                <div class="intro-x fs-lg mt-3">You may have mistyped ___ address or the page ___ have moved. </div>
                <a href="{{ route('admin.home') }}" class="intro-x btn py-3 px-4 text-white border-white dark-border-dark-5 dark-text-gray-300 mt-10">Back to Home </a>
            </div>
        </div>
    </div>
    <div data-url="main-dark-error-page.html" class="dark-mode-switcher cursor-pointer shadow-md position-fixed bottom-0 end-0 box dark-bg-dark-2 border rounded-pill w-40 h-12 d-flex align-items-center justify-content-center z-50 mb-10 me-10">
        <div class="me-4 text-gray-700 dark-text-gray-300">Dark Mode </div>
        <div class="dark-mode-switcher__toggle border"></div>
    </div>
    <script src="../developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="../maps.googleapis.com/maps/api/js_1beb78b.js"></script>
    <script src="{{ asset('admin/dist/js/app.js') }}"></script>
</body>

</html>
