<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $page->title }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto+Slab:300" rel="stylesheet">
        <meta name="og:image" content="https://picsum.photos/1200/630/?random"/>
        <meta name="og:url" content="{{ $page->getUrl() }}"/>
        <meta name="og:title" content="{{ $page->title }}"/>
        <meta name="og:site_name" content="MAGJoyner"/>
        <meta name="og:type" content="Website"/>
        <meta name="og:description" content="{{ $page->description }}"/>
        <meta name="description" content="{{ $page->description }}">
        <meta name="twitter:card" content="summary_large_image">
    </head>
    <body class="font-serif text-black pt-32 leading-normal">
        @include('_layouts.header')
        <div class="px-4 max-w-lg mx-auto lg:text-xl">
            <div class="mb-4">
                <h1 class="text-3xl font-black font-sans pb-2 capitalize lg:text-5xl text-center">{{ $page->title }}</h1>
            </div>
            <div class="max-w-sm mx-auto">
                <img src="/assets/images/animals/{{ $page->image }}" alt="{{ $page->alt }}">
            </div>
            
            <div class="max-w-md mx-auto bg-grey-lightest shadow p-4">
                <p class="font-bold text-grey-darkest text-sm uppercase">Did you know?</p>
                <p>{{ $page->fact }}</p>
            </div>
        </div>
        <div class="my-12">
            <p class="text-black text-center mb-4">share this animal</p>
            <div class="flex justify-center items-center">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($page->getUrl()) }}"
                class="no-underline text-black hover:text-purple mx-4">
                <svg height="30px" class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65.32 65.33"><path d="M32.66,0A32.67,32.67,0,1,0,65.32,32.66,32.66,32.66,0,0,0,32.66,0Zm7.41,27.75-.34,4.34H35.28V47.17H29.66V32.09h-3V27.75h3V24.84c0-1.29,0-3.27,1-4.5a5.35,5.35,0,0,1,4.66-2.18,18.83,18.83,0,0,1,5.38.54l-.75,4.44a10.17,10.17,0,0,0-2.42-.36c-1.16,0-2.21.42-2.21,1.58v3.39Z"/></svg>
                </a>
                <a href="https://twitter.com/home?status={{ urlencode($page->title . ' ' . $page->getUrl()) }}"
                class="no-underline text-black hover:text-purple mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" height="30px" class="fill-current" viewBox="0 0 65.32 65.33"><path d="M32.66,0A32.67,32.67,0,1,0,65.32,32.66,32.66,32.66,0,0,0,32.66,0ZM45,26.34c0,.27,0,.55,0,.83,0,8.4-6.39,18.09-18.09,18.09a18,18,0,0,1-9.75-2.86,12.84,12.84,0,0,0,9.42-2.63,6.35,6.35,0,0,1-5.94-4.42,5.79,5.79,0,0,0,1.19.12,6.25,6.25,0,0,0,1.68-.23A6.36,6.36,0,0,1,18.4,29v-.08a6.39,6.39,0,0,0,2.89.79,6.37,6.37,0,0,1-2-8.49,18.07,18.07,0,0,0,13.11,6.65,6.36,6.36,0,0,1,10.83-5.8,12.84,12.84,0,0,0,4-1.55,6.36,6.36,0,0,1-2.79,3.52,12.5,12.5,0,0,0,3.65-1A12.72,12.72,0,0,1,45,26.34Z"/></svg>
                </a>
                <a href="mailto:?&subject=Read&body={{ $page->getUrl() }}"
                class="no-underline text-black hover:text-purple mx-4">
                <svg height="30px" class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65.33 65.33"><polygon points="33.06 34.32 24.12 26.82 41.99 26.82 33.06 34.32"/><path d="M34.29,38.3l11.3-9.49V40.94H20.52V28.81l11.3,9.49a1.92,1.92,0,0,0,2.47,0Z"/><path d="M60.15,14.09a24,24,0,0,0-8.94-8.93C25.84-9.26,0,8.68,0,32.66A32.67,32.67,0,0,0,32.67,65.33C56.66,65.33,74.61,39.45,60.15,14.09Zm-10.72,27a3.7,3.7,0,0,1-3.7,3.7H20.38a3.7,3.7,0,0,1-3.7-3.7V26.68a3.7,3.7,0,0,1,3.7-3.7H45.73a3.7,3.7,0,0,1,3.7,3.7Z"/></svg>
                </a>
            </div>
        </div>
        <footer class="h-8 w-full bg-grey-darkest"></footer>
        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
        @if($page->production)
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-51468211-17','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
        @endif
    </body>
</html>

