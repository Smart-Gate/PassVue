<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <script>window.Laravel = {csrfToken:'{{csrf_token()}}' }</script>

        <title>Phone Book App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    
    </head>
    <body>
    <div id="app">
    <div class="container">
        <articles></articles>
    </div>
    </div>
<script src="{{ asset('js/app.js') }}">
    
    </script>
    </body>
</html>
