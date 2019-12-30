@extends('layout.base_template')

@section('pageTitle')

@endsection

@section('body-content')

@if(isset($_COOKIE["isLoggedIn"]) && isset($_COOKIE["_TOKEN"]))

<h1>Welcom home buddy</h1>

@else

@include('authentication.register_login')

@endif

@endsection

@section('vue-script')
@php $hash = hash('md5', file_get_contents('js/homepage.js')); @endphp
<script src="{{'/js/homepage.js?'.$hash}}" type="text/javascript"></script>
@endsection