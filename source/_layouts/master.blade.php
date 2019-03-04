<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8">
        <title>MAGJoyner</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto+Slab:300" rel="stylesheet">

        <meta name="og:image" content="https://picsum.photos/1200/630/?random"/>
        <meta name="og:url" content="https://magjoyner.com"/>
        <meta name="og:title" content="MAGJoyner"/>
        <meta name="og:site_name" content="MAGJoyner"/>
        <meta name="og:type" content="Website"/>
        <meta name="og:description" content="The personal site of MAG Joyner, web developer ordaniare."/>
        <meta name="description" content="The personal site of MAG Joyner, web developer ordaniare.">
        <meta name="twitter:card" content="summary_large_image">
    </head>
    <body class="font-serif text-black pt-32 min-h-full flex flex-col">
        <div class="flex-1">
            @yield('body')
        </div>
        <footer class="w-full bg-grey-darkest flex justify-center items-center p-8">
        <div>
        <a class="no-underline text-white hover:text-red" href="https://github.com/michaeljoyner">
        <svg aria-labelledby="simpleicons-github-icon" role="img" viewBox="0 0 24 24" height="24px" class="fill-current" xmlns="http://www.w3.org/2000/svg"><title id="simpleicons-github-icon">GitHub icon</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
        </a>
    </div>
        </footer>
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
