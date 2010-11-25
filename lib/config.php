<?php

namespace GrimHappy;

class Config {
	
	// Self explanatory.
	public static $domain = 'grimhappy.com';
	
	// Self explanatory.
	public static $blog_title = "grimhappy.com";
	
	// Self explanatory.
	public static $blog_description = 'A blog about code!';
	
	// Format for post dates.
	public static $date_format = "F jS, Y";
	
	// Active theme.
	public static $theme = "ThemeHappy";
	
	public static $theme_path = '';
	
	// All pages. 
	public static $pages = array();
	
	// Disqus shortname.  Set to FALSE to disable disqus.
	public static $disqus_shortname = 'grimhappy';
	
	// Time Zone.
	public static $time_zone = 'America/Chicago';
	
	// You can do some config initialization here.
	public static function init() {
		self::$pages = Page::all();
		self::$theme_path = DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . self::$theme . DIRECTORY_SEPARATOR;
	}
}
