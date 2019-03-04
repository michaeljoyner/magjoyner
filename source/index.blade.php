@extends('_layouts.master')

@section('body')
@include('_layouts.header')
<section class="max-w-lg mx-auto md:text-2xl leading-normal px-8 md:px-16 lg:px-8">
<h1 class="text-3xl">
    Hello there, and welcome!
</h1>
<p>My name is <span class="text-red">Michael</span>, and I am a web developer. I am also one half of the exemplary <a href="https://dymanticdesign.com" class="text-red hover:text-blue">Dymantic Design.</a></p>
<p>

</p>
<p>
    When I am not developing the web I may or may not be doing some wild and recklessly cool things.
</p>
<p>
    I am very open to both short and longer term work opportunities (as long as they are remote), so feel free to <a href="mailto:joyner.michael@gmail.com" class="text-red hover:text-blue">get in touch about that</a>. Otherwise I occasionally write some web dev related <a href="/blog" class="text-red hover:text-blue">articles</a>, because I feel obliged. You are equally as obliged to read them.
</p>
<p>
Because I'd hate for you to go away empty-handed, I shall leave you with this penguin. It shall forever be your spirit animal. Cheers.
</p>
<img src="/assets/images/penguin.png" alt="A remarkably beautiful penguin" class="max-w-md w-full mx-auto block">
</section>

@endsection
