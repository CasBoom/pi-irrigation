<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        @if ($errors->any())
            <ul>
                    {{implode('', $errors->all('<li>: message</li>'))}}
            </ul>
        @endif
        <form method="post" target=''>
            @csrf
            <p>
                <label for="name">Name: </label>
                <input type="text" name="name">
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password">
            </p>
            <input type="submit" name="Submit">
        </form>
    </body>
</html>
