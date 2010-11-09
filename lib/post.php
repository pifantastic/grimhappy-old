<?php

namespace GrimHappy;

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
		$this->filepath = BASE_DIR . "/posts/$filepath";
		$everything = explode('-', str_replace('.md', '', basename($filepath)));
		$this->date = implode('/', array_slice($everything, 0 , 3));
		$this->timestamp = strtotime($this->date);
		$this->title = implode(' ', array_slice($everything, 3));
		$this->url = '/' . $this->date . '/' . implode('-', array_slice($everything, 3));
		$this->slug = implode('-', array_slice($everything, 3));
		if (file_exists($this->filepath)) {
			$this->content = file_get_contents($this->filepath);
			$this->html = Markdown($this->content);
			$this->exists = TRUE;
		}
	}
	
	public static function all() {
		$posts = array();
		foreach (glob(BASE_DIR . "/posts/*.md") as $file) {
			$posts[] = new Post($file);
		}
		
		usort($posts, function($a, $b) {
			if ($a == $b) return 0;
			return ($a > $b) ? -1 : 1;
		});
		
		return $posts;
	}
}
