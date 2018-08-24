<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $page->title }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto+Slab:300" rel="stylesheet">
    </head>
    <body class="font-serif text-black pt-20 leading-normal">
        @include('_layouts.header')
        <div class="px-4 max-w-lg mx-auto lg:text-xl">
            <div class="mb-4">
                <h1 class="text-3xl font-black font-sans pb-2 capitalize lg:text-5xl">{{ $page->title }}</h1>
                <p class="uppercase text-xs tracking-wide font-bold text-grey-dark">{{ $page->post_date }}</p>
            </div>
            <div class="my-8 p-4 bg-purple-lightest">
                <p class="uppercase text-xs tracking-wide font-bold text-black">In a Nutshell</p>
                <p class="mt-4">{{ $page->nutshell }}</p>
            </div>
            @yield('post_content')
        </div>
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>

