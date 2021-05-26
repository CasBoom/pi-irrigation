<!DOCTYPE html>
<html>
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


    </body>
</html>
