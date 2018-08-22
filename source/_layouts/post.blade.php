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
    <header class="flex justify-between p-4 shadow fixed pin-t w-full bg-white">
    <div>
        <a href="/" class="no-underline font-black text-xl">
        <span class="text-grey">MAG</span><span class="text-black">JOYNER</span>
        </a>
    </div>
    <div>
        <span>
        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/></svg>
        </span>
    </div>
</header>
<div class="px-4 max-w-lg mx-auto">
<div class="mb-4">
    <h1 class="text-3xl font-black font-sans pb-2 capitalize">{{ $page->title }}</h1>
    <p class="uppercase text-xs tracking-wide font-bold text-grey-dark">{{ $page->post_date }}</p>
</div>
    <div class="my-8 p-4 bg-purple-lightest">
        <p class="uppercase text-xs tracking-wide font-bold text-black">In a Nutshell</p>
        <p class="mt-4">{{ $page->nutshell }}</p>
    </div>
        @yield('post_content')
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>
</div>

