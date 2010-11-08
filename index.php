<?php

// I don't know why but this needs to happen on (gs).
define('BASE_DIR', __DIR__);

// Include the GrimHappy framework.
include 'lib/grimhappy.php';

// $router->get('^/phpinfo$', "phpinfo");

/**
 * RSS!
 */
$router->get('^/rss$', function() {
	$template = new GrimHappy\Template('rss.php');
	$template->data['posts'] = GrimHappy\Post::all();
	$template->render();
});
 
/**
 * Blog posts!
 */
$router->get('^/(\d+)/(\d+)/(\d+)/(.*)$', function($y, $m, $d, $post) {
	$post = new GrimHappy\Post(BASE_DIR . "/posts/$y-$m-$d-$post.md");
	if ($post->exists) {
		$template = new GrimHappy\Template("index.php");
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
$router->get('^/(\w+)$', function($page) {
	$page = new GrimHappy\Page(BASE_DIR . "/pages/$page.md");
	if ($page->exists) {
		$template = new GrimHappy\Template('index.php');
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
$router->get('^/$', function() {
	$template = new GrimHappy\Template('index.php');
	$template->data['posts'] = GrimHappy\Post::all();
	$template->render();
});
