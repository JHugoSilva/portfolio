<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('template/assets/css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/fonts/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/fonts/unicons/css/line.css') }}">
@vite('resources/js/app.js')

    </head>
    <body>
        <div id="admin"></div>
 </body>

</html>
