@extends('users.admin.home')

@section('title')
    | Manage Breeders
@endsection

@section('content')

<div class="container">
    <manage-breeders :initial-breeders="{{ $customizedBreederData }}"> </manage-breeders>
</div>

@endsection
