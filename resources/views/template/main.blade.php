<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" type="text/css">
        <!-- Bootstraps CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <!-- lib -->
        <script src="https://unpkg.com/ml5@0.4.3/dist/ml5.min.js"></script> 
        <!-- <script src="https://unpkg.com/ml5@latest/dist/ml5.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/p5@1.2.0/lib/p5.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">@yield('brand')</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/config">Configuration</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/experiment">Experiment</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">About</a>
                </li>
            </ul>

            </div>
        </div>
        </nav>

        @yield('info')
        @yield('record')
        @yield('icons')
        @yield('train')
        @yield('uses')

     
    <footer>
        <div class="footers container-fluid" style="font-family: 'Open Sans Condensed', sans-serif;">
        © 2020, I Wayan Shinichirou Ikebe All Rights Reserved. 
        </div>
    </footer>
    </body>
    <!-- js -->
    <!-- <script src="{{ asset('/js/record_deploy.js') }}"></script> -->
    <script src="{{ asset('/js/script.js') }}"></script>
</html>
