@extends('layouts.app')

@section('title')
    | Admin - Home
@endsection

@section('sidebar')
    <ul id="slide-out" class="side-nav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="{{ asset('images/swine-registry-logo.png') }}">
                </div>
                {{-- <a href="#!user"><img class="circle" src="{{ asset('storage/images/default/admin.png') }}"></a>
                <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
                <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a> --}}
            </div>
        </li>
        <li :class="{ active : currentRoute.admin.adminViewRegdSwine }">
            <a href="{{ route('adminViewRegdSwine') }}"> <i class="material-icons">find_in_page</i> View Registered Swine </a>
        </li>
        <li :class="{ active : currentRoute.admin.showManageBreeders }">
            <a href="{{ route('showManageBreeders') }}"> <i class="material-icons">account_circle</i> Manage Breeders </a>
        </li>
        <li :class="{ active : currentRoute.admin.showManageEvaluators }">
            <a href="{{ route('showManageEvaluators') }}"> <i class="material-icons">gavel</i> Manage Evaluators </a>
        </li>
        <li :class="{ active : currentRoute.admin.showManageGenomics }">
            <a href="{{ route('showManageGenomics') }}"> <i class="material-icons">person</i> Manage Genomics </a>
        </li>
        <li :class="{ active : currentRoute.admin.showManagePropertiesView }">
            <a href="{{ route('showManagePropertiesView') }}"> <i class="material-icons">list</i> Manage Properties </a>
        </li>
        <li :class="{ active : currentRoute.admin.showManageBreedsView }">
            <a href="{{ route('showManageBreedsView') }}"> <i class="material-icons">toc</i> Manage Breeds </a>
        </li>
        <li :class="{ active : currentRoute.admin.showCertificates }">
            <a href="{{ route('adminCertificate') }}"> <i class="material-icons">picture_in_picture</i> Certificate Requests </a>
        </li>
        <li :class="{ active : currentRoute.admin.manageAPIsView }">
            <a href="{{ route('manageAPIsView') }}"> <i class="material-icons">build</i> Manage API Credentials </a>
        </li>
        <li :class="{ active : currentRoute.admin.changePassword }">
            <a href="{{ route('changePassAdmin') }}"> <i class="material-icons">lock</i> Change Password </a>
        </li>
        {{-- <li :class="{ active : currentRoute.admin.reports }">
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
            </div>
        </div>
    </div>
</div>

@endsection
