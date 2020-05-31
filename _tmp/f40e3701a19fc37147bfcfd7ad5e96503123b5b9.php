<?php $__env->startSection('body'); ?>
<?php echo $__env->make('_layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<section class="max-w-2xl mx-auto md:text-2xl leading-normal px-8 md:px-16 lg:px-8">
<h1 class="text-4xl font-bold">
    Hi there,
</h1>
<p>My name is Michael, and I am a web developer. I currently practice my craft at <a href="https://dymanticdesign.com" class="text-yellow-600 hover:underline">Dymantic Design</a>, which is a design and web development studio that I co-founded.</p>

<p>
    My guiding philosophy for development is to strive for simplicity and cover myself with tests.
</p>

<p>
    I do most of my professional work in Laravel and Vue, along with HTML/CSS of course. I also really enjoy Node and use it on several internal or personal projects, and some of the most fun I've had programming is making my own little tools in Go.
</p>

<p>
    Occasionally I write some web dev related <a href="/blog" class="text-yellow-600 hover:underline">articles</a>, of which you are welcome to read. I plan on trying to increase my writing output, but I'd be lying if I said I hadn't promised that before. 
</p>
<p>
    If you'd like me to work with (or for you), feel free to <a href="mailto:joyner.michael@gmail.com" class="text-yellow-600 hover:underline">get in touch</a>. 
</p>
<p>
Because I'd hate for you to go away empty-handed, I shall leave you with this penguin. It shall forever be your spirit animal. Cheers.
</p>
<img src="/assets/images/penguin.png" alt="A remarkably beautiful penguin" class="max-w-md w-full mx-auto block">
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>