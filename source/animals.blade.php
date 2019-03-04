@extends('_layouts.animal-index')

@section('body')
@include('_layouts.header')
<h1 class="text-3xl font-black font-sans pb-2 capitalize lg:text-5xl text-center mb-16">Animal Almanac</h1>
<section class="max-w-lg mx-auto lg:text-2xl flex flex-wrap">
@foreach($animals as $animal)
<div class="w-1/2 px-4">
<a href="{{ $animal->getPath() }}" class="text-black font-sans text-grey-darkest hover:text-red-light no-underline capitalize">
    <img src="/assets/images/animals/{{ $animal->image }}" alt="{{ $animal->alt }}" class="max-w-full block mx-auto w-48 h-48">
</a>
</div>
@endforeach
</section>

@endsection
