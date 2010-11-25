<?php

namespace GrimHappy;

class Router {
  
  public static $routes;
  public static $url;
  
  public static function init() {
    self::$url = '/' . $_GET['url'];
  }
  
  public static function get($url, $function) {
    self::$routes[$url] = $function;
  }
  
  public static function execute() {
    $matches = array();
    $response = FALSE;
    
    foreach (self::$routes as $route => $function) {
      if (preg_match("%$route%", self::$url, $matches)) {
        $response = call_user_func_array($function, array_slice($matches, 1));
        break;
      }
    }
    
    if ($response === FALSE) {
      Helpers\Response::error404();
    }
  }
}
