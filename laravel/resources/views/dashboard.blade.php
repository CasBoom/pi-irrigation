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
    <a href="{{@url('/profile')}}">
        Profile
    </a>
</header>
@endsection
@section('content')
    <main>
        <div class="row">
            <div class='block half'>
                <h2>Schedule</h2>
                <div class='timeblocks'>
                    @php
                        $days = ['Monday','Tueday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                    @endphp
                    @foreach (App\Timeblock::orderBy('day')->orderBy('time')->get() as $timeblock)
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
            <div class='block half'>
                <h2>Logs</h2>
                <div class='logs'>
                    @foreach (App\WateringLogs::all() as $log)
                        <div class='log_entry success_{{$log->success}}'>{{$log->time.', ' . $log->litre . ' Litre'}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='block full'>
                <h2>Data per day</h2>
                <table class='data'>
                    <tr>
                        <th></th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th>
                    </tr>
                    <tr>
                        <th>Litre</th>
                        @for($i = 0; $i<7; $i++)
                            <td>{{app('App\Http\Controllers\TimeBlocksController')->litresPerDay($i)}}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th>Frequency</th>
                        @for($i = 0; $i<7; $i++)
                            <td>{{app('App\Http\Controllers\TimeBlocksController')->entriesPerDay($i)}}</td>
                        @endfor
                    </tr>
                </table>
            </div>
        </div>
    </main>
@endsection
