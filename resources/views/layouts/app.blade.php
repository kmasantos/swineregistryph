<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title') </title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('customStyle')
</head>
<body>

    <header>
        <div id="custom-nav" class="navbar-fixed">
            <nav class="teal lighten-1">
                <div class="nav-wrapper">
                    @auth
                        <a href="#!" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
                    @endauth
                    <a href="{{ route('home') }}" class="brand-logo">{{ config('app.name', 'Laravel') }}</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        @if (Auth::guest())
                            <li><a href="{{ route('viewSwinePedigreePageGuest') }}">View Pedigree</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else
                            <li><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></li>
                            <li>
                                <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                    @yield('sidebar')
                </div>
            </nav>
        </div>
    </header>

    {{-- Main content for authenticated users --}}
    @auth
        <main id="app" class="main-logged-in blue-grey lighten-5">
            @yield('content')
        </main>
    @endauth

    {{-- Main content for guest users --}}
    @guest
        <main id="app">
            @yield('content')
        </main>
    @endguest

    {{-- Footer for guest users --}}
    @guest
        <footer class="page-footer" style="background-color:white;">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="black-text">Swine Breed Registry PH</h5>
                        <p class="grey-text text-darken-2">
                            Swine Breed Registry PH is a project of the UPLB Institute of Animal Science. 
                            It is funded by Department of Science and Technology - Philippine Council for Agriculture, 
                            Forestry and Natural Resources Research and Development (DOST-PCAARRD) 
                            and in cooperation with Accredited Swine Breeders Association of the Philippines (ASBAP).
                        </p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="black-text">Participating Agencies</h5>
                        <div class="col s4">
                            <img style="height:auto; width:100%;" src="{{ asset('images/ias-logo.png') }}">
                        </div>
                        <div class="col s4">
                            <img style="height:auto; width:100%;" src="{{ asset('images/uplb-logo.png') }}">
                        </div>
                        <div class="col s4">
                            <img style="height:auto; width:100%;" src="{{ asset('images/pcaarrd-logo.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container black-text">
                    © {{ date('Y') }} Purebred Swine Registry PH
                </div>
            </div>
        </footer>
    @endguest

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('customScript')

</body>
</html>
