<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    </head>
    <body>
        <header>
            Header
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            Footer
        </footer>
        <script src="{{mix('/js/app.js')}}"></script>
    </body>
</html>
