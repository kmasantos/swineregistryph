@extends('layouts.app')

@section('title')
    | Admin - Home
@endsection

@section('sidebar')
    <ul id="slide-out" class="side-nav fixed">
        <li><a href="#!">View Registered Swine</a></li>
        <li><a href="#!">Manage Accredited Farms</a></li>
        <li><a href="#!">Manage Form fields</a></li>
        <li><a href="#!">Manage Breeds</a></li>
        <li><a href="#!">Reports</a></li>
        <li class="hide-on-large-only show-on-medium-and-down">
            <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
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
