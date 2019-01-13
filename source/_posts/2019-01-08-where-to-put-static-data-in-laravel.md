---
extends: _layouts.post
title: Where to put static data in your Laravel app
description: A look at ways to manage static data in a Laravel app
nutshell: Database if you want queries and relationships, files if you want simplicity and version control. There are many ways to tackle this, here are a few.
post_date: 08 January 2019
section: post_content
published: true
number: 3
---

Static site generators are all the rage these days, and for good reason. One of their many selling points is that there is no need to interact with a database layer. If you have some collection of information or data, you can normally just keep it in some sort of pre-defined format and the site genreator will ensure you have access to it when you need it.

On the other hand, if you are working with a Laravel app you will most likely be using some sort of database anyway, so it stands to reason that that is where you would put any collection of orginised data. However, there are times when a more "static" approach could make sense.

The example I will use for this discussion is this: On a project, where somewhere on the public facing site, there will be a page showing the "team". The client is a busy person and says she does not want to spend any time editing, updating or creating team members, she will just email you whatever information is needed, and you need to make the change.

Let's look at our options.

<h3 class="heading">The database</h3>

Always a good place for data. That's probably why it's caled a database. The main reason to use a database when you have some static-seeming data (a list of the world's countries for example) is so you can create relationships between that data and other entities. A handy way to populate the database with this data is to put it into migrations. Then you have a record of it in your code-base and VCS.

<h3 class="heading">Leave the data in the view?</h3>

If we think about our example with the "team members", we can assume we don't need to relate the data (names, titles, avatarts, etc) to any other entity. We know it will just be a page showing a grid of team memebrs and their basic info.

What would be the most straightforward way to handle this situation? Most likely it would be to just write up the page in regular old HTML, don't extract the data out at all. Then we no longer have the problem of where to put the data. It doesn't take too much thinking to see when this solution would break down, and if we were working with a collection of things, we would miss out the (essential) ability to loop over things.

<h3 class="heading">Keep it with the code</h3>

The next simplest thing to do in my opinion is write a regular class, lets call it `App\Team` and put a static function on it that returns the data just how we want it. Then we can call that in our controller to pass the data to the view, or even call it directly from the view if we are feeling wild. Something along the lines of this:

```php
// App/Team.php

namespace App;

class Team {
    private $team_members = [
        [
            'name' => 'Agatha',
            'title' => 'Boss',
            'avatar' => 'public/images/team/agatha.png'
        ],
        [
            'name' => 'Hercule',
            'title' => 'Chief Investigative Officer',
            'avatar' => 'public/images/team/hercule.png'
        ],
        //...
    ];

    public static function members() {
        return $this->team_members;
    }
}

// somewhere in a controller

public function show() {
    $members = App\Team::members();

    return view('team.page', ['members' => $members]);
}
```

That works well, and for our example where we only have one kind of entity I would be very tempted to use it. If it's not the solution for you, read on.

A similar approach is to bind something to Laravel's container. Eveyone loves the container. You would do this in a `ServiceProvider` of your choice, and our example (at its most basic) would look something like this:

```php
//in AppServiceProvider, or any other registered service provider

public function register() {
    $this->app->bind('team', function() {
        return [
        [
            'name' => 'Agatha',
            'title' => 'Boss',
            'avatar' => 'public/images/team/agatha.png'
        ],
        [
            'name' => 'Hercule',
            'title' => 'Chief Investigative Officer',
            'avatar' => 'public/images/team/hercule.png'
        ],
        //...
    ]
    });
}

// somewhere in a controller

public function show() {
    $members = app('team');

    return view('team.page', ['members' => $members]);
}
```

These approaches work well, in many cases are all that is needed. There are still drawbacks though, you either end up repeating similar classes, or cluttering up your ServiceProviders.

<h3 class="heading">Just copy Laravel</h3>

Consider the way Laravel handles config data. That seems to me to be exactly the solution I am looking for. The data exists in its own dedicated files, and there is a very elegant way to retrieve that data, such as using the sexy helper function `config('my-key', 'default-value')`. The best part is that we don't have to worry about how Laravel reads in the data or makes it available to us. No ServiceProviders or classes, just simple php files with assosiative arrays. This appeals to me as a great way to handle static data, except for one thing. The word config. My ideal situation would be just the same, except instead of putting the files in a `config` folder, there is also a `data` folder. Then make a `data` helper function that works just like the `config` helper function. Then we end up with something like this:

```php
//in data/team.php
<?php

return [
    [
            'name' => 'Agatha',
            'title' => 'Boss',
            'avatar' => 'public/images/team/agatha.png'
        ],
        [
            'name' => 'Hercule',
            'title' => 'Chief Investigative Officer',
            'avatar' => 'public/images/team/hercule.png'
        ],
        //...
];

//and in some controller
public function show() {
    return view('team.page', ['members' => data('team')]);
}
```

The great part about this is that all the parts that make this work can be extracted away into a package for reuse in other projects, because your data is separated from it all. This is precisely what I have done for a project I am working on now, and so far it works wonderfully. Here is a brief breakdown of how you could do it:

- Create your data directory and add your data as assosiative arrays in php files, just like the confog folder.
- Make a `DataRepository` (name it whatever you want), that on construction takes a directory name, reads all the files in that directory and creates a store of all the data in those files. Probably add some caching here.
- Add a nice `get` method to your `DataRepository`
- Write a helper function that just calls the get method on your `DataRepository`
- Make a ServiceProvider that creates the new `DataRepository` and binds it to the container
- You're done

Once the project is finished, I will document and "release" the package, and will update this post accordingly.
