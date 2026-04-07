<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Responsive Portfolio Website</title>
        <!-- Fonts -->
       <link rel="stylesheet" href="/template/assets/fonts/unicons/css/line.css">
        <!-- CSS -->
         <!-- SWIPER CSS -->
        <link rel="stylesheet" href="/template/assets/css/swiper-bundle.min.css">
        <link rel="stylesheet" href="/template/assets/css/styles.css">
    </head>
    <body>
        @vite('resources/js/app.js')
        <div id="app"></div>

        <!--==================== MAIN JS ====================-->
        <script src="/template/assets/js/main.js"></script>
    </body>
</html>
