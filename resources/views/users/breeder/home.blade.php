@extends('layouts.app')

@section('title')
    | Breeder - Home
@endsection

@section('sidebar')
    <ul id="slide-out" class="side-nav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="{{ asset('images/swine-registry-logo.png') }}">
                </div>
                {{-- <a href="#!user"><img class="circle" src="{{ asset('storage/images/default/breeder.png') }}"></a>
                <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
                <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a> --}}
            </div>
        </li>
        <li :class="{ active : currentRoute.breeder.showRegForm }">
            <a href="{{ route('showRegForm') }}"> <i class="material-icons">add_box</i> Register Swine </a>
        </li>
        <li :class="{ active : currentRoute.breeder.viewRegdSwine }">
            <a href="{{ route('viewRegdSwine') }}"> <i class="material-icons">find_in_page</i> View Registered Swine </a>
        </li>
        <li :class="{ active : currentRoute.breeder.viewSwinePedigree }">
            <a href="{{ route('viewSwinePedigreePage') }}"> <i class="material-icons">line_style</i> View Swine Pedigree </a>
        </li>
        <li :class="{ active : currentRoute.breeder.showInspection }">
            <a href="{{ route('breederInspection') }}"> <i class="material-icons">highlight</i> Inspection Requests </a>
        </li>
        <li :class="{ active : currentRoute.breeder.showCertificates }">
            <a href="{{ route('breederCertificate') }}"> <i class="material-icons">picture_in_picture</i> Certificate Requests </a>
        </li>
        <li :class="{ active : currentRoute.breeder.changePassword }">
            <a href="{{ route('changePassBreeder') }}"> <i class="material-icons">lock</i> Change Password </a>
        </li>
        {{-- <li :class="{ active : currentRoute.breeder.manageFarms }">
            <a href="#!"> <i class="material-icons">store</i> Manage Farms </a>
        </li>
        <li :class="{ active : currentRoute.breeder.reports }">
            <a href="#!"> <i class="material-icons">description</i> Reports </a>
        </li> --}}
        <li class="hide-on-large-only show-on-medium-and-down">
            <div class="divider"></div>
        </li>
        <li class="hide-on-large-only show-on-medium-and-down">
            <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                Logout
            </a>
            <form id="logout-form-2" method="POST" action="{{ route('logout') }}">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Welcome, {{ Auth::user()->name }}!</h1>

            <div class="row">
                {{-- <div class="carousel carousel-slider center" data-indicators="true">
                    <div class="carousel-fixed-item center">
                        <a class="btn waves-effect white grey-text darken-text-2">button</a>
                    </div>
                    <div class="carousel-item red white-text" href="#one!">
                        <h2>First Panel</h2>
                        <p class="white-text">This is your first panel</p>
                    </div>
                    <div class="carousel-item amber white-text" href="#two!">
                        <h2>Second Panel</h2>
                        <p class="white-text">This is your second panel</p>
                    </div>
                    <div class="carousel-item green white-text" href="#three!">
                        <h2>Third Panel</h2>
                        <p class="white-text">This is your third panel</p>
                    </div>
                    <div class="carousel-item blue white-text" href="#four!">
                        <h2>Fourth Panel</h2>
                        <p class="white-text">This is your fourth panel</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@endsection

@section('customScript')
    <script type="text/javascript">
        // $(document).ready(function(){
        //     $('.carousel.carousel-slider').carousel({fullWidth: true});
        // });
    </script>
@endsection
