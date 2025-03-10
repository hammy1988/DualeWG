<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">

    <title>{{ config('app.name', 'Laravel') }} - {{$title}}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome_all.css')  }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome_duotone.css') }}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    @yield('headcss')
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/wgscript.js') }}"></script>
    @yield('headjs')

</head>
<body>
    <div id="app" class="wgAppContainer">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm wgNavbar">
            <div class="container">
                <a class="navbar-brand wgBrand" href="{{ url('/') }}">
                    <span class="fad fa-home-heart wgTitleIcon"></span>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Anmelden') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrieren') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle wgNavUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="fad fa-user wgNavUserIcon"></span>{{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right wgNavMenu" aria-labelledby="navbarDropdown">

                                    @if(Auth::user()->hasActiveFlatshare())
                                    <div class="wgNavSection wgNavSectionBlue">
                                        <a class="dropdown-item wgNavDashboard" href="{{ route('dashboard') }}">
                                            <span class="fad fa-newspaper" aria-hidden="true"></span>
                                            {{ __('Dashboard') }}
                                        </a>
                                            <a class="dropdown-item wgNavGroceryList" href="{{ route('purchaselist') }}">
                                            <span class="fad fa-list"></span>
                                            {{ __('Einkaufsliste') }}
                                        </a>
                                        <a class="dropdown-item wgNavAppointment" href="{{ route('calendar') }}">
                                            <span class="fad fa-calendar-week"></span>
                                            {{ __('Kalender') }}
                                        </a>
                                    </div>
                                    @endif

                                    <div class="wgNavSection wgNavSectionGold">
                                        <a class="dropdown-item wgNavProfile" href="{{ route('profile') }}">
                                            <span class="fad fa-beer" aria-hidden="true"></span>
                                            {{ __('Profil') }}
                                        </a>
                                        @if(Auth::user()->hasActiveFlatshare())
                                            <a class="dropdown-item wgNavFlatsharemanagement" href="{{ route('flatsharemanagement') }}">
                                                <span class="fad fa-home" aria-hidden="true"></span>
                                                {{ __('Deine WG') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="wgNavSection wgNavSectionRed">
                                        <a class="dropdown-item wgNavLogout" id="wgLogoutButton" href="{{ route('logout') }}">
                                            <span class="fad fa-sign-out" aria-hidden="true"></span>
                                            {{ __('Abmelden') }}
                                        </a>
                                    </div>

                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 wgMainContainer">
            @yield('content')

            @auth
                <div class="logininfo">

                    Sie sind angemeldet als:&nbsp;<a href="{{ route('profile') }}">{{ Auth::user()->givenname }} {{ Auth::user()->name }}</a>&nbsp;| (<a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>)
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            @endauth
        </main>

    </div>

    <footer class="wgFooter text-center mt-auto py-3">
        <div class="container">
            <span class="text-muted">{{ __('© ') . date("Y") . __(' ')}}<img class="wgcisLogo" src="{{ asset('img/creativeInformatics.png')  }}" alt="Creative Informatics Logo" /></span>
        </div>
    </footer>
</body>

</html>
