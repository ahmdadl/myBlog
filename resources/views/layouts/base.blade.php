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
        <nav
            class="navbar navbar-expand-sm navbar-dark bg-primary shadow-sm text-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse navbar-sm-"
                    id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="nav-link {{request()->is('posts') ? 'active' : ''}}"
                                href="/posts">Posts</a>
                        </li>
                        <li>
                            <a class="nav-link {{request()->is('posts/create') ? 'active' : ''}}"
                                href="/posts/create">Create</a>
                        </li>
                        <li>
                            <a class="nav-link {{request()->is('category/create') ? 'active' : ''}}"
                                href="/category/create">Ccategory</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                                class="nav-link dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                <span class="d-inline mr-1 badge @switch(Auth::user()->type)
                                        @case('admin')
                                            {{'badge-danger'}}
                                            @break
                                        @case('normal')
                                            {{'badge-primary'}}
                                            @break
                                        @case('super')
                                            {{'badge-success'}}
                                        @default
                                            {{'badge-primary'}}
                                    @endswitch">
                                    {{Auth::user()->type}}
                                </span>
                                <img class="img d-inline rounded-circle pr-1"
                                    src='{{asset('img/user.png')}}'
                                    width="35" height="35">
                                {{ Auth::user()->name }} <span
                                    class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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