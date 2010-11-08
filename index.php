<?php

// I don't know why but this needs to happen on (gs).
define('BASE_DIR', __DIR__);

// Include the GrimHappy framework.
include 'lib/grimhappy.php';

/**
 * RSS!
 */
$router->get('^/rss$', function() {
	$template = new Template('rss.php');
	$template->data['posts'] = Post::all();
	$template->render();
});
 
/**
 * Blog posts!
 */
$router->get('^/(\d+)/(\d+)/(\d+)/(.*)$', function($y, $m, $d, $post) {
	$post = new Post(BASE_DIR . "/posts/$y-$m-$d-$post.md");
	if ($post->exists) {
		$template = new Template("index.php");
		$template->data['disqus'] = TRUE;
		$template->data['posts'] = array($post);
		$template->render();
	}
	else {
		// 404.
		return FALSE;
	}
});

/**
 * Pages!
 */
$router->get('^/(\w+)$', function($page) {
	$page = new Page(BASE_DIR . "/pages/$page.md");
	if ($page->exists) {
		$template = new Template('index.php');
		$template->data['page'] = $page;
		$template->render();
	}
	else {
		// 404.
		return FALSE;
	}
});

/**
 * Index page!
 */
$router->get('^/$', function() {
	$template = new Template('index.php');
	$template->data['posts'] = Post::all();
	$template->render();
});
