<?php

namespace GrimHappy;

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

date_default_timezone_set($config->time_zone);

function shutdown() {
	global $router;
	$router->execute();
}

register_shutdown_function('GrimHappy\shutdown');