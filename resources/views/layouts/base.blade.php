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
        <style>
            .sk-cube-grid{width:40px;height:40px;margin:100px auto}.sk-cube-grid .sk-cube{width:33%;height:33%;background-color:#fff;float:left;-webkit-animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out;animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out}.sk-cube-grid .sk-cube1{-webkit-animation-delay:.2s;animation-delay:.2s}.sk-cube-grid .sk-cube2{-webkit-animation-delay:.3s;animation-delay:.3s}.sk-cube-grid .sk-cube3{-webkit-animation-delay:.4s;animation-delay:.4s}.sk-cube-grid .sk-cube4{-webkit-animation-delay:.1s;animation-delay:.1s}.sk-cube-grid .sk-cube5{-webkit-animation-delay:.2s;animation-delay:.2s}.sk-cube-grid .sk-cube6{-webkit-animation-delay:.3s;animation-delay:.3s}.sk-cube-grid .sk-cube7{-webkit-animation-delay:0s;animation-delay:0s}.sk-cube-grid .sk-cube8{-webkit-animation-delay:.1s;animation-delay:.1s}.sk-cube-grid .sk-cube9{-webkit-animation-delay:.2s;animation-delay:.2s}@-webkit-keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}@keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}
        </style>
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
    <input type="hidden" name="csrf_token" value="{{csrf_token()}}" id="csrf-token" />
    </div>

    <div style="position: fixed; top: 0;left: 0; z-index:9999; width: 100%; height: 100%; background-color: #343a40" id="splashScreen">
        <div style="position: relative">
            <div style="display: flex; justify-content: center; align-items: center;height: 100vh;">
                <div class="sk-cube-grid">
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Made with &hearts; by <a href="http://ninjacoder.rf.gd/">ninjaCoder</a> 2019</p>
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