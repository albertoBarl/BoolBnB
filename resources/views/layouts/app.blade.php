<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

    <div class="offcanvas offcanvas-bottom h-100" tabindex="-1" id="offcanvasFooter" aria-labelledby="offcanvasFooterLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            
            <div class="container px-5">

                <div class="row"><strong>Assistenza</strong></div>

                <div class="row">

                    <div class="col-4">
                        <p><a href="#">Centro assistenza</a></p>
                        <p><a href="#">Opzioni di cancellazione</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">AirCover</a></p>
                        <p><a href="#">La nostra risposta all'emergenza COVID-19</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">Accessibilità per tutti</a></p>
                        <p><a href="#">Segnala problemi nel quartiere</a></p>
                    </div>
                    
                </div>

                <div class="row"><hr></div>

                <div class="row"><strong>Community</strong></div>

                <div class="row">

                    <div class="col-4">
                        <p><a href="#">Airbnb: un rifugio sicuro</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">Contro la discriminazione</a></p>
                    </div>
                    <div class="col-4"></div>
                    
                </div>

                <div class="row"><hr></div>

                <div class="row"><strong>Ospitare</strong></div>

                <div class="row">

                    <div class="col-4">
                        <p><a href="#">Apri un Airbnb</a></p>
                        <p><a href="#">Vai al forum della community</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">AirCover per gli host</a></p>
                        <p><a href="#">Come ospitare responsabilmente</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">Esplora le risorse per host</a></p>
                    </div>
                    
                </div>

                <div class="row"><hr></div>

                <div class="row"><strong>Airbnb</strong></div>

                <div class="row">

                    <div class="col-4">
                        <p><a href="#">Newsroom</a></p>
                        <p><a href="#">Opportunità di lavoro</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">Scopri le nuove funzionalità</a></p>
                        <p><a href="#">Investitori</a></p>
                    </div>
                    <div class="col-4">
                        <p><a href="#">Lettera dai nostri fondatori</a></p>
                        <p><a href="#">Gift card</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>


        <nav class="navbar navbar-expand-md shadow-sm sticky-top p-2 my_header">
            <div class="container">
                <a class="navbar-brand col-md-3 col-lg-2 me-0" href="/">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/1200px-Airbnb_Logo_B%C3%A9lo.svg.png" alt="airbnb-logo-lg" class="airbnblogo">
                </a>

                <button class="navbar-toggler my_togglerbtn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon my_togglerbtnico"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
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

        <main class="">
            @yield('content')
        </main>

        <footer class="row align-items-center my_footercontainer px-5 bg-light mt-5 shadow-sm">

            <div class="col-9 my_footercollg py-3">
                    © 2023 Airbnb, Inc. &#x2022; <a href="#">Privacy</a> &#x2022; <a href="#">Termini</a> &#x2022; <a href="#">Mappa del sito</a> &#x2022; <a href="#">Dettagli dell'azienda</a> &#x2022; <a href="#">Destinazioni</a>
            </div>

            <div class="col-3 text-end"> <a class="btn my_footerbtn" role="button" data-bs-toggle="offcanvas" href="#offcanvasFooter" aria-controls="offcanvasFooter">Supporto e risorse <fa icon="angle-up" /></a> </div>

        </footer>
    </div>
</body>

</html>
