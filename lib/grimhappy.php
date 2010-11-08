<?php

date_default_timezone_set('America/Chicago');

include 'config.php';
include 'post.php';
include 'page.php';
include 'router.php';
include 'template.php';
include 'helpers.php';
include 'markdown.php';

// Globals.
$router = new Router();
$config = new Config();

function shutdown() {
	global $router;
	$router->execute();
}

register_shutdown_function('shutdown');