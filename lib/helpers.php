<?php

namespace Helpers;

class Response {
	
	public static function error404() {
		header("Status: 404 Not Found");
		echo file_get_contents(BASE_DIR . '/lib/404.php');
		exit();
	}
}