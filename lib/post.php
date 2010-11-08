<?php

class Post {

	public $filepath;
	public $url = '';
	public $slug;
	public $title = '';
	public $date = '';
	public $timestamp = 0;
	public $content = '';
	public $html = '';
	public $exists = FALSE;
	
	public function __construct($filepath) {
		$this->filepath = $filepath;
		$everything = explode('-', str_replace('.md', '', basename($filepath)));
		$this->date = implode('/', array_slice($everything, 0 , 3));
		$this->timestamp = strtotime($this->date);
		$this->title = implode(' ', array_slice($everything, 3));
		$this->url = '/' . $this->date . '/' . implode('-', array_slice($everything, 3));
		$this->slug = implode('-', array_slice($everything, 3));
		if (file_exists($filepath)) {
			$this->content = file_get_contents($filepath);
			$this->html = Markdown($this->content);
			$this->exists = TRUE;
		}
	}
}
