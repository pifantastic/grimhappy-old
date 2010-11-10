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

// Shut the fuck up, PHP.
date_default_timezone_set($config->time_zone);

// Define a URL -> Callback.
function get($url, $function) {
  global $router;
  $router->get($url, $function);
}

// Route the request.
function shutdown() {
  global $router;
  try {
    $router->execute();
  } catch (Exception $e) {
    Response::error404();
  }
}

register_shutdown_function('GrimHappy\shutdown');
