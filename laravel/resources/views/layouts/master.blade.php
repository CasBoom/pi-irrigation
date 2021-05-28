<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">

        <title>@yield('title')</title>

    </head>
    <body>
        <div id='container'>
                @yield('header')
                @yield('content')
        </div>
    </body>
</html>
