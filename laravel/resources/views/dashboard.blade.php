@extends('layouts.master')

@section('title')
    Dashboard
@endsection
@section('header')
<header>
    <h1>
        Dashboard
    </h1>
    <a href="{{@url('/logout')}}">
        Logout
    </a>
</header>
@endsection
@section('content')
    <main>
    </main>
@endsection
