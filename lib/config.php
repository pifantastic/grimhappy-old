<?php

class Config {
	
	// Self explanatory.
	public $domain = 'grimhappy.com';
	
	// Self explanatory.
	public $blog_title = "grimhappy.com";
	
	// Self explanatory.
	public $blog_description = 'A blog about code!';
	
	// Format for post dates.
	public $date_format = "F jS, Y";
	
	// Active theme.
	public $theme = "ThemeHappy";
	
	// All pages. 
	public $pages = array();
	
	// Disqus shortname.  Set to FALSE to disable disqus.
	public $disqus_shortname = 'grimhappy';
	
	// You can do some config initialization here.
	public function __construct() {
		foreach (glob(BASE_DIR . "/pages/*.md") as $file) {
			$this->pages[] = new Page($file);
		}
	}
}