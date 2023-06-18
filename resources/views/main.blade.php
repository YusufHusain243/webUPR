<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Petrona&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>
        {{ isset($setting[0]) ? (session('locale') !== null && session('locale') == 'id' ? $setting[0]->name_id : $setting[0]->name_en) : '' }}
        - Universitas Palangka Raya</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/user/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/user/main.css') }}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="app">
        @include('components/header')

        @yield('content')

        @include('components/footer')

        <a href="https://wa.me/ {{ isset($setting[0]) ? $setting[0]->wa : '' }}"
            class="scroll-top d-flex align-items-center justify-content-center bg-success">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <script src="{{ asset('vendor/user/main.js') }}"></script>
    <script src="{{ asset('vendor/user/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/user/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/user/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/user/aos/aos.js') }}"></script>
</body>

</html>
