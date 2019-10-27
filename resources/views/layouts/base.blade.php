<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"
        type="image/x-icon">
</head>

<body>
    <div id="app">
        @vueLink(url()->current())
            @include('navbar.vue')
        @else
            @include('navbar.bs')
        @endvueLink

        <main class="py-4">
            @yield('baseContent')
            {{-- @include('vue') --}}
        </main>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your
                Website 2019</p>
        </div>
        <!-- /.container -->
    </footer>
    <!-- Scripts -->
    @vueLink(url()->current())
        <script src="{{ mix('js/ts.js') }}"></script>
    @else
        <script src="{{ mix('js/app.js') }}"></script>    
    @endvueLink
</body>

</html>