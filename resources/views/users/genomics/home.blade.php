@extends('layouts.app')

@section('title')
    | Genomics - Home
@endsection

@section('sidebar')
    <ul id="slide-out" class="side-nav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="{{ asset('images/swine-registry-logo.png') }}">
                </div>
                {{-- <a href="#!user"><img class="circle" src="{{ asset('storage/images/default/genomics.png') }}"></a>
                <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
                <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a> --}}
            </div>
        </li>
        <li :class="{ active : currentRoute.genomics.regLabResults }">
            <a href="{{ route('genomicsRegisterForm') }}"> <i class="material-icons">add_box</i> Register Lab Results </a>
        </li>
        <li :class="{ active : currentRoute.genomics.viewLabResults }">
            <a href="{{ route('viewLabResults') }}"> <i class="material-icons">find_in_page</i> View Lab Results </a>
        </li>
        <li :class="{ active : currentRoute.genomics.changePassword }">
            <a href="{{ route('changePassGenomics') }}"> <i class="material-icons">lock</i> Change Password </a>
        </li>
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
            </div>
        </div>
    </div>
</div>

@endsection
