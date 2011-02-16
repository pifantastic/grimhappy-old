<?php

namespace GrimHappy;

// I don't know why but this needs to happen on (gs).
define('BASE_DIR', __DIR__);

// Include the GrimHappy framework.
include 'lib/grimhappy.php';

/**
 * RSS!
 */
get('^/rss$', function() {
	header("Content-Type: application/xml; charset=ISO-8859-1"); 
  $template = new Template('rss.php');
  $template->data['posts'] = Post::all();
  $template->render();
});

/**
 * Blog posts!
 */
get('^/(\d+)/(\d+)/(\d+)/(.*)$', function($y, $m, $d, $post) {
  $post = new Post("$y-$m-$d-$post.md");
  
  if ($post->exists) {
    $template = new Template("index.php");
    $template->data['disqus'] = TRUE;
    $template->data['posts'] = array($post);
    $template->render();
  }
  else {
    return FALSE;
  }
});

/**
 * Drafts!
 */
get('^/drafts$', function() {
  $template = new Template('index.php');
  $template->data['posts'] = Post::drafts();
  $template->render();
});

/**
 * Pages!
 */
get('^/(\w+)$', function($page) {
  $page = new Page("$page.md");
  
  if ($page->exists) {
    $template = new Template('index.php');
    $template->data['page'] = $page;
    $template->render();
  }
  else {
    return FALSE;
  }
});

/**
 * Index!
 */
get('^/$', function() {
  $template = new Template('index.php');
  $template->data['posts'] = Post::all();
  $template->render();
});
