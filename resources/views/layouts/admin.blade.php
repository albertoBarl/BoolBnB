<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>BoolBnB - Business</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    {{-- payments w/Braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navbar sticky-top flex-md-nowrap p-2 shadow-sm my_header">

            <a class="navbar-brand col-md-3 col-lg-2 me-0 ms-5" href="/">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/1200px-Airbnb_Logo_B%C3%A9lo.svg.png" alt="airbnb-logo-lg" class="airbnblogo">
            </a>

            <!-- <input class="form-control form-control-dark w-100" type="text" Placeholder="Search"> -->
            <div class="navbar nav">

                <button class="navbar-toggler position-absolute d-md-none collapsed me-5 my_togglerbtn" type="button"
                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    <span class="navbar-toggler-icon my_togglerbtnico"></span>
                </button>

                <div class="nav-item text-nowrap ms-5">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <button class="btn btn-outline-light">{{ __('Logout') }}</button>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <!-- {{ Route::currentRouteName() }} -->
                                <a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary bg-opacity-25' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.services.index' ? 'bg-secondary bg-opacity-25' : '' }}"
                                    href="{{ route('admin.services.index') }}"> <i
                                        class="fa-solid fa-newspaper fa-lg fa-fw"></i> Services
                                </a>
                            </li>
                            {{-- Messages --}}
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.messages.index' ? 'bg-secondary bg-opacity-25' : '' }}"
                                    href="{{ route('admin.messages.index') }}"> <i
                                        class="fa-solid fas fa-envelope fa-lg fa-fw"></i> Messages
                                </a>
                            </li>

                            {{-- appartamenti --}}
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.apartments.index' ? 'bg-secondary bg-opacity-25' : '' }}"
                                    href="{{ route('admin.apartments.index') }}"> <i
                                        class="fa-solid fa-building fa-lg fa-fw"></i>
                                    Apartments
                                </a>
                            </li>


                            {{-- sponsors --}}
                            <li class="nav-item">
                                <a class="nav-link text-dark {{ Route::currentRouteName() == 'admin.sponsors.index' ? 'bg-secondary bg-opacity-25' : '' }}"
                                    href="{{ route('admin.sponsors.index') }}"> <i
                                        class="fa-solid fa-dollar-sign fa-lg fa-fw"></i>
                                    Sponsors
                                </a>
                            </li>

                            {{-- airbnb --}}
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="http://localhost:5173/">
                                    <i class="fa-brands fa-airbnb fa-lg fa-fw" style="-webkit-text-stroke: 1px #212529;"></i>
                                    Sito Airbnb
                                </a>
                            </li>

                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>
