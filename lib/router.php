<?php

class Router {
	
	public $routes;
	public $url;
	
	public function __construct() {
		$this->url = '/' . $_GET['url'];
	}
	
	public function get($url, $function) {
		$this->routes[$url] = $function;
	}
	
	public function execute() {
		$matches = array();
		$response = FALSE;
		
		foreach ($this->routes as $route => $function) {
			if (preg_match("%$route%", $this->url, $matches)) {
				$response = call_user_func_array($function, array_slice($matches, 1));
				break;
			}
		}
		
		if ($response === FALSE) {
			Helpers\Response::error404();
		}
	}
}
