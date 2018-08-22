@extends('_layouts.master')

@section('body')
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
@foreach($posts->filter(function($p) {return $p->published;}) as $post)
<div class="my-4 py-4 px-4 border-l-2 border-l-black border-b-1 border-l-grey">
<p class="text-xs uppercase tracking-wide text-grey-dark">{{ $post->post_date }}</p>
<h3><a href="{{ $post->getPath() }}" class="text-black no-underline capitalize">{{ $post->title }}</a></h3>
<p class="mt-2">{{ $post->description }}</p>
</div>
@endforeach
@endsection
