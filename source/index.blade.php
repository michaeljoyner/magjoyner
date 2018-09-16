@extends('_layouts.master')

@section('body')
@include('_layouts.header')
<section class="max-w-lg mx-auto lg:text-2xl">
@foreach($posts->filter(function($p) {return $p->published;}) as $post)
<div class="my-4 py-4 px-4 border-l-2 border-l-black border-b-1 border-l-grey">
<p class="text-xs uppercase tracking-wide text-grey-dark">{{ $post->post_date }}</p>
<h3><a href="{{ $post->getPath() }}" class="text-black font-sans text-grey-darkest no-underline capitalize">{{ $post->title }}</a></h3>
<p class="mt-2">{{ $post->description }}</p>
</div>
@endforeach
</section>

@endsection
