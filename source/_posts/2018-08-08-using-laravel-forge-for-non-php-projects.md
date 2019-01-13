---
extends: _layouts.post
title: Using Laravel Forge for for a Node app
description: Take advantage of Laravel Forge's awesome features for a non-PHP app
nutshell: Laravel Forge has some awesome features that can be leveraged for non-Laravel/PHP apps. Learn how to setup a Node app for easy deployment, SSL and more.
post_date: 31 August 2018
section: post_content
published: true
number: 2
---

Forge has some great features that we will take advantage of, but it is really aimed at Laravel/PHP apps. So if you are planning on a large scale, big money Node project, maybe you should find a more specialized solution. However, if you are already a Forge user and have some server space to spare, and find yourself with a Node itch to scratch, read on.

<h3 class="heading">Before we begin</h3>

To follow along, you will need a [Forge](https://forge.laravel.com) account, with a server already provisioned. If you haven't done that part, do it now quickly, just provision the smallest, cheapest server for now. You will also need your sudo password for the server.

For this tutorial we will be using a simple Node app with two endpoints. The `/` endpoint just displays "hello world", and the `/env` endpoint shows the value of an environment variable. It will become clear why at a later point. So grab the [app from GitHub](https://github.com/michaeljoyner/forge-node-test) and we can get started.

<h3 class="heading">Step One: Installation</h3>

Head over to your Forge server and add a new site on the server. If you are going to want to add SSL to the site, make sure you use the correct domain name as the site name, otherwise just give it any reasonable name. Once the site has been created, go to the site's page on Forge and you can install your repo from Github by clicking on the Git repository button. Fill out the neccessary fields and make sure to uncheck the "Install Composer dependancies" checkbox.

If all went well, Forge will have now set up all the site's directories and nginx stuff on our server.

<h3 class="heading">Step Two: Nginx</h3>

Forge was kind enough to setup all the Nginx stuff for us, but we will need to make some changes. On your site's page in Forge, look for the "files" button at the bottom and select "Edit Nginx Configuration". This will open a modal with your nginx config for the site. You need to find the following:

```nginx
location / {
 try_files $uri $uri/ /index.php?$query_string;
}
```

and replace it with:

```nginx
location / {
    proxy_pass http://localhost:3000;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection 'upgrade';
    proxy_set_header Host $host;
    proxy_cache_bypass $http_upgrade;
}
```

This will make sure requests sent to your site will be forwarded to the port where Node will be listening. You can also delete some of the other PHP related stuff, or if you are not sure, just leave it there.

If you are going to be using your own domain (as opposed to just the IP address), you may as well set that up now. Go ahead and log into your domain registrar and create an A record pointing your domain (or subdomain) to the server's IP address. If you are just going to use the IP address, you may need to make one more change to your nginx file.

Find the line:

```nginx
listen 80;
```

and change it to

```nginx
listen 80 default_server;
```

If you aleready have another site on the same server that acts as the default server, then you can change the servename in the nginx config from your domain name to the IP address.

<h3 class="heading">Step Three: Environment Variables</h3>

Forge allows us to change the environment variables through its UI, giving us an easy way to edit the `.env` file which lives at the root of our site. From your site page on Forge, go to the Environment tab and click on "Edit environment". Add the following:

```yaml
SECRET_MESSAGE="Forge is great"
```

<h3 class="heading">Step Four: Test our work so far</h3>

If you visit your domain (or IP address) now, you should see an Nginx error page. That is because we haven't actually started the app. In order to check that what we have done so far works, first ssh into your server and navigate into your site's directory.

First run `npm install` to pull in our dependencies. Then run `node index.js`. You should see the message in your console to tell you that it is listening on port 3000.

Now if you go to your domain, you should see the hello world message, and if you visit the `/env` endpoint, you should see the secret message stored in your environment variable.

Once you are happy that is all working, press Ctrl+C to stop the process. Your app was running, but it isn't quite ready for the big time yet.

<h3 class="heading">Intermission</h3>

Unlike your Laravel apps, the Node app will continue to run in its own process, continuously serving requests as they come in. A new process does not start for each request. This has implications for how we need to run our Node app. If the process running our app dies, any request to our app will fail. So we need a way to monitor the process, and restart it if neccessary. Additionally, seeing as your environment variables are read only when the app starts up, and not for each request, you need to restart the process when we make changes to our environment variables, and generally when we deploy.

Luckily, Forge comes with an easy way to manage and monitor a process as a daemon, because they are exactly what it needs for Laravel's queueing functionality. Our stratergy will be to create a daemon that is monitored and will be restared if the process dies, the server restarts, etc. We will also set it to restart on each deploy.

<h3 class="heading">Step five: The daemon</h3>

When we ssh'ed into our server and ran our app manually, everything worked out just fine. This is because we use the dotenv library to manage our environment variables, and by default it will read the `.env` file in the current working directory. However, using Forge's daemon function, the app won't be started from the site's home directory, so the `.env` file can't be loaded. So we can hard code in the path to the `.env` file and pass it into the dotenv config in our app, but we also need to think how that will effect your local workflow. Another option, which we will go with, is to use a small bash script to startup our app. The daemon will then run that script. See the startup.sh script in the project root.

First, open the Node app we are using in your editor of choice, and edit the `startup.sh` file. You need to change the following line:

```
cd /home/forge/node-on-forge
```

to use the correct directory, as such:

```
cd /home/forge/[NAME-OF-YOUR-FORGE-SITE]
```

Commit your changes and ssh into the server, go to your site's home directory and pull in those changes.

Now go to the server page in Forge, and click on the Daemons tab. Enter the following into the command field: `bash /home/forge/[your-site-name]/startup.sh`. Leave it as only one process and leave the directory field blank. Then add the daemon. Once the daemon is created you may click on the little eye icon to see the status. It should be running.

Forge has now created the daemon and done all the Suepvisor (a process manager) setup and config for us. But we will need to make some small changes. While you are in the daemon screen, take note of the daemon ID number, you'll need it later.

<h3 class="heading">Step six: Supervisor config and sudo</h3>

There are two issues we have now. If the daemon is stopped for some reason, the child process that is our actuall app does not get stopped, to it is still running and occupying port 3000, and our daemon won't be able to restart. So it is time to ssh back into your server.

Use nano or vim to edit `/etc/supervisor/conf.d/daemon-[YOUR-DAEMON-ID]` as sudo. You will see something like this:

```
[program:daemon-42928]
command=bash /home/forge/[YOUR-SITE-NAME]/startup.sh

process_name=%(program_name)s_%(process_num)02d
autostart=true
autorestart=true
user=forge
numprocs=1
redirect_stderr=true
stdout_logfile=/home/forge/.forge/daemon-42928.log
```

You need to add the following: `stopasgroup=true` on the last line, so now it should look as such:

```
[program:daemon-42928]
command=bash /home/forge/[YOUR-SITE-NAME]/startup.sh

process_name=%(program_name)s_%(process_num)02d
autostart=true
autorestart=true
user=forge
numprocs=1
redirect_stderr=true
stdout_logfile=/home/forge/.forge/daemon-42928.log
stopasgroup=true
```

Save the file and then run `sudo supervisorctl update` to enable your changes.

If you check on the status of your daemon now, it probably won't be running. Go to the bottom of the page on Forge, look for the "Restart" button and restart the server. That should fix things.

The remaining problem is that we need to be able to retsart the daemon in our deploy script, but that requires sudo priveleges. So we are going to make it so that the forge user can run the `supervisorctl` command as sudo without being prompted for the sudo password.

Ssh back into your server, and run the following command: `sudo visudo`. This will open a sudo config file in your default editor (on the server, so probably either nano or vi). Add the following to the very bottom of the file, on a new line: `forge ALL=(ALL) NOPASSWD: /usr/bin/supervisorctl`. Save your changes and exit. Now you may exit your server. I don't know if it is entirely neccesary, but you may restart the server from the server page on Forge.

<h3 class="heading">Step seven: The deploy script</h3>

Now we are ready to make our deploy script from the app tab on the sites page in Forge. At the very least, we need to pull in the latest version from git, install any node dependancies and restart the daemon. You could start out with something like this:

```
cd /home/forge/[YOUR-SITE-NAME]
git pull origin master
npm install
sudo supervisorctl restart daemon-[YOUR-DAEMON-ID]:daemon-[YOUR-DAEMON-ID]_00
```

Now click on the deploy button. Once it is done, click the "View Latest Deployment Log" to see if everything worked properly.

Once it is all working, in Forge go to your site's environment variables and change the SECRET_MESSAGE. Save the changes, and go to the `/env` endpoint in your browser. You should still see the old message. Hopefully this makes sense to you now. So you need to remember that whenever you update your environment variables, you need to either redeploy the app or just restart the daemon using the Forge UI.

<h3 class="heading">Step Eight: Get that sweet SSL</h3>

As the final piece of the puzzle, as long as you are actually putting this under a real domain name, you may head over to the SSL tab in Forge and set that up just as you would for any other app. If you are using Let's Encrypt, Forge will take care of everything for you, which is absolutely wonderful.

<h3 class="heading">Wrapping Up</h3>

Initially, this may seem like a lot of work just to get a Node app up and running, but it really isn't. Once you are familiar with the process it will seem very quick and easy, and there are some huge benefits. Forge also has other features that can be used for non-Laravel apps, such as the Schedule tab, which provides an easy way to manage cron jobs. There is also a way to manage databases if you want to use a MySQL (or similar) database.

There are also ways this setup could be improved, this is really intended as a starting point. I am no expert in any of this stuff, so feel free to double-check on anything I say, or if there is anything I am missing out on, send me an email. I hope this helps though.
