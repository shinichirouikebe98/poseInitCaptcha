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

        @yield('experiment') 
    <footer>
        <div class="footers container-fluid" style="font-family: 'Open Sans Condensed', sans-serif;">
        © 2020, I Wayan Shinichirou Ikebe All Rights Reserved. 
        </div>  
    </footer>
    </body>
    <!-- js -->
    <script src="{{ asset('/js/sketch2.js') }}" charset="utf-8"></script>
    <!-- <script src="{{ asset('/js/script.js') }}"></script> -->
</html>
