<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('title',config('app.name'))">
    <meta name="description" content="@yield('title',config('app.name'))">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title',config('app.name'))</title>

    <!-- Styles -->
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @include('partical.header')
    @yield('content')
    @include('partical.footer')
    <!-- Scripts -->
    <script src="{{ mix('js/home.js') }}"></script>
    @yield('scripts')
</body>
</html>
