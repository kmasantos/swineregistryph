@extends('layouts.app')

@section('title')
    | Login
@endsection

@section('content')
<div class="container">
    <div class="row"></div>
    <div class="row"></div>
    <div class="row center">
        <img src="{{ asset('images/swine-registry-logo.png') }}" />
    </div>
    <div class="row">
        <div class="col s4 offset-s4">
            <div class="row">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="input-field col s12">
                        <input id="email" type="text" class="validate" name="email" value="{{ old('email') }}">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" name="password">
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" class="btn waves-effect waves-light indigo right"> Login
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
