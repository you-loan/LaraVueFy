<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LaraVueFy</title>

        <!-- CSRF token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Application javascripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Application stylesheet -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

    </head>
    <body>
        <div id="app">      <!-- this is the reference for Vue -->
            <App></App>     <!-- this is our application's tag -->
        </div>
    </body>
</html>

