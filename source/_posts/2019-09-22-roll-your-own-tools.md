---
extends: _layouts.post
title: "Roll your own tools"
description: One of my favorite programming exercises is to make my own little tools that I can use in my day to day work.
nutshell: Even if they are super simple, the benefits to making your own tools are huge.
post_date: 22 September 2019
section: post_content
published: true
number: 5
---

Web development for work can sometimes feel just like, well, work. Sometimes one needs a change of scenery to freshen things up. This is possibly why we are always so quick to jump onto the latest hotness, which doesn't always work in our favor. However, there is a way to get that change in scenery, flex those programming muscles and still be productive.

As a web developer, your trusty command line is never far away. Making your own little tools to use at the command line is not only fairly easy, it can improve your productivity while providing a fun exercise. Even if what you make could be replaced by a single line of bash, that is not the point. Use a language that you don't get to use everyday for extra benefits. For me, Go(lang) is the perfect fit, but there are many optins out there. I like Go because I genuinely enjoy using it, it has great tooling, and nothing has to be too complicated.

So what tools can you build? By tools, I just mean helpful little things that help you in your day to day work. Here is an example: you probably often download a file from a browser or Slack or something, and that file ends up in your Downloads folder. Now you need to move that file from your Downloads folder to some location, probably somewhere in your current working directory. Of course you can just use the `mv` command, that's what it was built for. But it could be simpler. How about a command that just fetches the latest file in you Downloads folder and puts it in the location you specify. Let's call our tool "accio". So doing `accio images` will take the latest file in my Downloads directory and put it in the images directory in my current working directory. Then we can improve things from there. `accio --count=4 images` will take the last four downloads. `accio --name="new-name.jpg" images` will rename the file, as one would expect. The great thing is that you can build on this in any way you want. The best thing is that you don't have to polish every edge and figure out every possible issue, because this tool is just for you. Want to handle zip archives, then do it. Totally up to you.

I have built many such tools, several that I use regularly. Some examples:

- a tool that searches through folders of svg icons and copies the selected one to the clipboard
- a tool that deploys a project to Laravel Forge and shows me progress and steps in my terminal
- a tool that simply duplicates a file into the same folder with a new name
- a tool that simplifies making a new post entry on a Jigsaw site (create file with title, date and unique slug)
- a tool to list image sizes and dimensions in a folder in nice human readable format
- a http status code lookup tool
- a quick thesaurus tool

Each of them was a fun exercise to do, provided me with some learning opportunities and they all help me in some way on a regular basis. Perhaps I will do a writeup on some, but my next planned post will be on SPA vs SSR/MPA, which is the rocky path I am walking down at the moment.
