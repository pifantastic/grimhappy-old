<?php

// I don't know why but this needs to happen on (gs).
define('BASE_DIR', __DIR__);

// Include the GrimHappy framework.
include 'lib/grimhappy.php';

/**
 * Add your own pages here.
 *
 * Format is as follows:
 * $router->get("^/(my)-(url)-(regex)$", function($my, $url, $regex) {
 *   global $config;
 *
 *   $template = new Template('index.php');
 *   
 *   $template->render();
 * });
 */

/**
 * RSS!
 */
$router->get('^/rss$', function() {
	global $config;
	
	$template = new Template('rss.php');
	
	$posts = array();
	foreach (glob(BASE_DIR . "/posts/*.md") as $file) {
		$posts[] = new Post($file);
	}
	
	usort($posts, function($a, $b) {
    if ($a == $b) return 0;
    return ($a > $b) ? -1 : 1;
  });
	
	$template->data['posts'] = $posts;
	$template->render();
});
 
/**
 * Blog posts!
 */
$router->get('^/(\d+)/(\d+)/(\d+)/(.*)', function($y, $m, $d, $post) {
	global $config;
	
	$post = new Post(BASE_DIR . "/posts/$y-$m-$d-$post.md");
	
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
 * Pages!
 */
$router->get('^/(\w+)', function($page) {
	global $config;
	
	$page = new Page(BASE_DIR . "/pages/$page.md");
	
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
 * Index page!
 */
$router->get('^/$', function() {
	global $config;
	
	$template = new Template('index.php');
	
	$posts = array();
	foreach (glob(BASE_DIR . "/posts/*.md") as $file) {
		$posts[] = new Post($file);
	}
	
	usort($posts, function($a, $b) {
    if ($a == $b) return 0;
    return ($a > $b) ? -1 : 1;
  });
	
	$template->data['posts'] = $posts;
	$template->render();
});
