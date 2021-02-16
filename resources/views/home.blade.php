<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
    </head>

    <body>
        <div class="container top home">
            <div class="title">Welcome</div>
            <div class="nav">
                <ul>
                    <li><a href="/"> Home </a></li>/
                    <li><a href="/"> About </a></li>/
                    <li><a href="/config"> Configuration </a></li>/
                    <li><a href="/experiment"> Experiment </a></li>
                </ul>
            </div>
        </div>
    </body>

</html>
