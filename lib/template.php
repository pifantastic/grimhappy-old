<?php

namespace GrimHappy;

class Template {
	
	public $data = array();
	public $file;
	
	public function __construct($file) {
		$this->file = BASE_DIR . "/themes/" . Config::$theme . "/$file";
	}
	
	public function render() {
		extract($this->data);
		include $this->file;
	}
}
