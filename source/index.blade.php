@extends('_layouts.master')

@section('body')
@include('_layouts.header')
<section class="max-w-2xl mx-auto md:text-2xl leading-normal px-8 md:px-16 lg:px-8">
<h1 class="text-4xl font-bold">
    Hi there,
</h1>
<p>My name is Michael, and I am the <span class="line-through">only</span> best web developer at <a href="https://dymanticdesign.com" class="text-yellow-600 hover:underline">Dymantic Design</a>, which is a <span class="line-through">small</span> fantastic design and web development studio.</p>


<p>
    Most of my client projects are built using Laravel and Vue, along with HTML/CSS of course. I also really enjoy building things in Golang and Node.
</p>

<p>
    I <span class="line-through">occasionally</span> used to write some web dev related <a href="/blog" class="text-yellow-600 hover:underline">articles</a>, of which you are welcome to read. 
</p>
<p>
    If you'd like me to work with (or for you), feel free to <a href="mailto:joyner.michael@gmail.com" class="text-yellow-600 hover:underline">get in touch</a>. 
</p>
<p>
Because I'd hate for you to go away empty-handed, I shall leave you with this penguin. It shall forever be your spirit animal. Cheers.
</p>
<img src="/assets/images/penguin.png" alt="A remarkably beautiful penguin" class="max-w-md w-full mx-auto block">
</section>

@endsection
