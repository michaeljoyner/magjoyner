<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto+Slab:300" rel="stylesheet">
    </head>
    <body class="font-serif text-black pt-20 min-h-full flex flex-col">
        <div class="flex-1">
            @yield('body')
        </div>
        <footer class="h-8 w-full bg-grey-darkest"></footer>
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>
