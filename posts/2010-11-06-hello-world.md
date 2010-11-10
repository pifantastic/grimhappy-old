Yes this is my 5th attempt to start blogging.  Yes this will probably be my 5th failure.  But you know what Thomas Edison did when his first attempt at the lightbulb failed?  He patented it.  Apparently patenting failure is a valid approach.  I've already submitted my blog to the US Patent office.  I think you already owe me like 47 cents.

The truth is, I was looking at the code for [Brian Leroux's](http://twitter.com/brianleroux) [wtfjs](http://wtfjs/com) and really liked the idea of using git as a sort of publishing system.  wtfjs runs on [node.js](http://nodejs.com), however, and I couldn't figure out how to get node running on Media Templs (gs).  So I did the next best thing.  I (_very_ loosely) ported the idea to PHP.  You can grab the code [here](https://github.com/pifantastic/grimhappy).  It is a constant work in progress, but I've been very pleased so far.  

Creating a new post is as simple as creating a new file in the `posts` directory following the naming scheme: `YYYY-MM-DD-my-post-title.md`.  Everything uses [markdown](http://daringfireball.net/projects/markdown/) for formatting.  Pages are created similarly by adding a new file to the `pages` directory following the naming scheme `page-name.md`.  

You can add your own behavior very easily too!  Just pop open `index.php` and a new url and callback:

    :::php
    get('^whatsup$', function() {
      if (rand(0, 1)) {
        echo 'Not much bra';
      }
      else {
        Response::error404();
      }
    });

So there you have it!  Please use it!  Tell me if something doesn't work!
