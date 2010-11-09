<?php

namespace GrimHappy;

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
	
	// Time Zone.
	public $time_zone = 'America/Chicago';
	
	// You can do some config initialization here.
	public function __construct() {
		$this->pages = Page::all();
	}
}
