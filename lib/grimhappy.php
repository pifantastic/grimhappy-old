<?php

namespace GrimHappy;

include 'config.php';
include 'post.php';
include 'page.php';
include 'router.php';
include 'template.php';
include 'helpers.php';
include 'markdown.php';

Router::init();
Config::init();

// Shut the fuck up, PHP.
date_default_timezone_set(Config::$time_zone);

// Define a URL -> Callback.
function get($url, $function) {
  Router::get($url, $function);
}

// Route the request.
function shutdown() {
  try {
    Router::execute();
  } catch (Exception $e) {
    Response::error404();
  }
}

register_shutdown_function('GrimHappy\shutdown');
