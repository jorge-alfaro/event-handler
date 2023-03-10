<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph -->
    <meta property="og:title" content="Proyectos personales"/>
    <meta property="og:description" content="Creado en Laravel 9 + vite php 8.1">
    <meta property="og:url" content="https://events.alfaro.pw" />
    <meta property="og:image" content="https://firebasestorage.googleapis.com/v0/b/pocket-76717.appspot.com/o/1200x630.jpg?alt=media&token=48c78996-c749-4040-8b38-03ffd7210690" />
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="Event-handler" />
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:label1" content="Developer">
    <meta name="twitter:data1" content="Jorge Alfaro">
    <meta property="og:type" content="application" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/favicon/favicon-16x16.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/dd74d6eba5.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss','resources/css/app.css', 'resources/js/app.js' ])
    @stack('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="{{ Vite::asset('resources/img/identicon.svg') }}" class="me-1" alt="logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto text-center">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-decoration-underline" href="{{ route('main') }}">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('home') }}">Administrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('events.index') }}">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('members.index') }}">Miembros</a>
                            </li>
                            <li class="nav-item dropdown bg-info rounded-3 w-50 align-self-center ps-1 pe-2">
                                <a id="btnGroupDrop1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ strtoupper( Auth::user()->name) }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
