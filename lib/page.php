<?php

namespace GrimHappy;

class Page {

	public $filepath;
	public $url = '';
	public $title = '';
	public $content = '';
	public $html = '';
	public $exists = FALSE;
	
	public function __construct($filepath) {
		$this->filepath = BASE_DIR . "/pages/$filepath";
		$this->title = str_replace('.md', '', basename($filepath));
		$this->url = '/' . $this->title;
		if (file_exists($this->filepath)) {
			$this->content = file_get_contents($this->filepath);
			$this->html = Markdown($this->content);
			$this->exists = TRUE;
		}
	}
	
	public static function all() {
		$pages = array();
		foreach (glob(BASE_DIR . "/pages/*.md") as $file) {
			$pages[] = new Page($file);
		}
		return $pages;
	}
}
