@extends('layouts.master')

@section('title')
    Profile
@endsection
@section('header')
<header>
    <h1>Profile</h1>
    <a href="{{@url('/logout')}}">
        Logout
    </a>
    <a href="{{@url('/')}}">
        Dashboard
    </a>
</header>
@endsection
@section('content')
    <form method="post" action="{{@url('/reset_password')}}" class="login_form">
    @csrf
    <p>
        @if(isset($_GET['error']))
            <p class="block full success_0 reset_error">
                {{htmlspecialchars($_GET['error'])}}
            </p>
        @endif
        <label for="name">Name: </label>
        <input type="text" name="name">
    </p>
    <p>
        <label for="password">Password: </label>
        <input type="password" name="password">
    </p>
    <p>
        <label for="new_password">New password: </label>
        <input type="password" name="new_password">
    </p>
    <p>
        <label for="confirm_password">Confirm password: </label>
        <input type="password" name="confirm">
    </p>
    <input type="submit" name="Submit">
    </form>
@endsection
