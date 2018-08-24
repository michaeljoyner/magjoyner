<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto+Slab:300" rel="stylesheet">
    </head>
    <body class="font-serif text-black pt-20">
        @yield('body')
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>
