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
        <div class="row">
            <div class='half'>
                <div class='timeblocks'>
                    @php
                        $days = ['Monday','Tueday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                    @endphp
                    @foreach (App\Timeblock::all() as $timeblock)
                        <div class='timeblock'>{{ $days[$timeblock->day] }}, {{ $timeblock->time}}. Litre: {{ $timeblock->litre}} <a href="{{@url('/delete_timeblock').'/'.$timeblock->id}}" class='delete_tb'>x</a></div>
                    @endforeach
                </div>
                <form class='add_timeblock' method="post" action="{{@url('/timeblock')}}">
                    @csrf
                    <select name='day'>
                        <option value='0'>Monday</option>
                        <option value='1'>Tueday</option>
                        <option value='2'>Wednesday</option>
                        <option value='3'>Thursday</option>
                        <option value='4'>Friday</option>
                        <option value='5'>Saturday</option>
                        <option value='6'>Sunday</option>
                    </select>
                    <input type='time' name='hour'>
                    <label for='name'>Litre: </label><input type='number' name='litre' class='litre' min="0" max="5" step='0.1'>
                    <input type="submit" name="add timeblock">
                </form>
            </div>
            <div class='half'>
                <div class='logs'>
                    @foreach (App\Timeblock::all() as $timeblock)
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
