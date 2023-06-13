<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid px-5">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('imgs/tobyfoxsleep.gif') }}" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="profile">
            <div class="container-fluid px-5">
                <h2 class="my-4">
                    Your Profile
                </h2>
                <div class="row">
                    <div class="col-2">
                        <ul class="list-unstyled">
                            <li
                                class="p-3 rounded-3 mb-3 {{ Route::currentRouteName() === 'admin.dashboard' ? 'bg-primary' : '' }}">
                                <a class="fw-bold text-decoration-none"
                                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li
                                class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.projects') ? 'bg-primary' : '' }}">
                                <a class="fw-bold text-decoration-none"
                                    href="{{ route('admin.projects.index') }}">Projects</a>
                            </li>
                            <li
                                class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.technologies') ? 'bg-primary' : '' }}">
                                <a class="fw-bold text-decoration-none"
                                    href="{{ route('admin.technologies.index') }}">Technologies</a>
                            </li>
                            <li
                                class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.types') ? 'bg-primary' : '' }}">
                                <a class="fw-bold text-decoration-none"
                                    href="{{ route('admin.types.index') }}">Types</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-3 -->
                    <div class="col-10">
                        @yield('content')
                    </div>
                    <!-- /.col-9 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </main>
    </div>

    <audio id="background-music" controls class="audio">
        <source src="{{ asset('music/ZeldaOst.mp3') }}" type="audio/mpeg">
        Il tuo browser non supporta l'elemento audio.
    </audio>

</body>

</html>
