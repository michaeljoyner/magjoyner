@extends('_layouts.master')

@section('body')
@include('_layouts.header')
<section class="max-w-lg mx-auto lg:text-2xl">
@foreach($posts->filter(function($p) {return $p->published;}) as $post)
    <div class="my-12 py-0 px-4 border-l-2 border-gray-600">
        <p class="text-xs uppercase tracking-wide text-gray-200">{{ $post->post_date }}</p>
        <h3><a href="{{ $post->getPath() }}" class="font-bold font-sans text-yellow-600 hover:underline no-underline capitalize text-xl">{{ $post->title }}</a></h3>
        <p class="mt-2 text-lg">{{ $post->description }}</p>
    </div>
@endforeach
</section>

@endsection
