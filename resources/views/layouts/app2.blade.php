<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/app2.css') }}?v={{ time() }}">
        <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/0/614.png" type="image/x-icon">
        <title>@yield('title', "BlueHorizon Airline")</title>
    </head>
    <body>
        <div id="app">
            <x-header />

            <main>
                @yield('content')
            </main>

            <x-footer />
        </div>
    </body>
    <script src="{{ asset('js/functionsCrud.js') }}"></script>

</html>