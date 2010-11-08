<?php

class Template {
	
	public $data = array();
	public $file;
	
	public function __construct($file) {
		global $config;
		$this->file = BASE_DIR . "/themes/{$config->theme}/$file";
	}
	
	public function render() {
		global $config;
		extract($this->data);
		include $this->file;
	}
}
