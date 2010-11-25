Drupal supports page caching for anonymous users which can be a very important performance boost for your site.  It works by taking the output of a page and placing it in the `page_cache` table.  As you can see from the below picture, you have three configuration options for page caching:

* __Caching Mode__ - Aggressive or Normal.  Normal caching will cache pages with no crazy side effects.  Aggressive caching will go a step further and ignore running Drupal's `hook_boot` and `hook_exit`.  This will be faster but could result in some really spooky behavior depending on what modules you have installed and what they are doing during boot and exit.
* __Minimum cache lifetime__ - This is a quick way of saying "Don't rebuild any cached pages until at least X minutes have passed"
* __Page compression__ - Drupal can also compress pages that it caches to optimize bandwidth.  Most servers already support compression and if that the case this should be disabled.

![Drupal Page Cache](/files/drupal-page-cache.png)

## Better Faster Stronger Page Caching

This is nice and all, but what if you need more control over which pages are cached?  What if you have an article content type that you want to cache for 5 minutes, but you don't want to cache any other content types?  What if you want to cache page X for 10 minutes unless a user has a specific role?  Drupal's out of the box page caching cannot solve these problems.  [Menu Callback Cache](http://drupal.org/project/menu_callback_cache) to the rescue!

Drupal's menu system is very flexible.  It works like URL routers in most development frameworks.  You specify a URL pattern, and then a callback to execute for that pattern.  By default, nodes in Drupal have the all too familiar URL structure `node/[nid]` where nid is the ID of the node you are viewing.  We can see how this is defined in Drupal core:

    :::php
    $items['node/%node'] = array(
      'title callback'   => 'node_page_title',
      'title arguments'  => array(1),
      'page callback'    => 'node_page_view',
      'page arguments'   => array(1),
      'access callback'  => 'node_access',
      'access arguments' => array('view', 1),
      'type'             => MENU_CALLBACK
    );
    
The [Menu Callback Cache](http://drupal.org/project/menu_callback_cache) (MCC) module works by augmenting Drupal's menu system.  It provides 3 new keys that you can specify in `hook_menu`:

* cache
* cache key callback
* cache max age

### cache
This is the only required key to enable menu callback caching.  If set to `TRUE`, MCC will cache the menu item's output for 5 minutes globally for all users.

### cache key callback
By default, MCC generates its own cache key based off of the name of the page callback and a hash of the arguments.  If, however, you would like to specify your own cache key, you can implement a cache key callback.  It accepts the same arguments as the page callback and must return a string.  If you want to cache a menu item conditionally, you can throw a `DoNotCacheException` in the cache key callback which will bypass MCC.

### cache max age
Sets the max age of the cache menu item, defaults to 5 minutes.

## Examples!

Here is an example of the most basic usage, caching a menu callback for 5 minutes:

    :::php
    /**
     * Implementation of hook_menu().
     */
    function my_module_menu() {
      $items = array();
      
      $items['foo'] = array(
        'title' => 'Foo', 
        'description' => 'Foooooooooooooo.', 
        'page callback' => 'my_module_foo', 
        'access arguments' => array('access content'), 
        'type' => MENU_NORMAL_ITEM,
        'cache' => MENU_CALLBACK_CACHE_PER_USER,
      );
      
      return $items;
    }
    
    /**
     * Page callback for 'foo/'
     */
    function my_module_foo() {
      return "This is some content, yo.";
    }

Now let's see how we would use MCC to solve our earlier questions:

> What if I have an article content type that I want to cache for 5 minutes, but I don't want to cache any other content types?

    :::php
    /**
     *  Implementation of hook_menu_alter().
     */
    function my_module_menu_alter(&$items) {
      $items['node/%node']['cache'] = MENU_CALLBACK_CACHE_PER_USER;
      $items['node/%node']['cache max age'] = 60 * 5;
      $items['node/%node']['cache key callback'] = 'my_module_cache_key_callback';
    }
    
    /**
     *  Cache key callback for path node/%node.
     */
    function my_module_cache_key_callback($node) {
      // Set the cache key if this node is of type 'page'.
      if ($node->type == 'article') {
        return __FUNCTION__ . '-' . $node->nid;
      }
      // Don't cache nodes that aren't type 'article'.
      else {
        throw new DoNotCacheException();
      }
    }

In the previous example I implemented a cache key callback.  This means I can clear that cache programmatically if ever I need to:

    :::php
    /**
     * Implementation of hook_nodeapi.
     */
    function my_module_nodeapi(&$node, $op, $a3 = NULL, $a4 = NULL) {
      switch ($op) {
        case 'update':
          // Clear the cached menu callback when we update the node.
          cache_clear_all('my_module_cache_key_callback-' . $node->nid);
          break;
      }
    }

> What if I want to cache page X for 10 minutes unless the user has a specific role?

    :::php
    /**
     * Implementation of hook_menu().
     */
    function my_module_menu() {
      $items = array();
      
      $items['x'] = array(
        'title' => 'Page X', 
        'description' => 'SeXy.', 
        'page callback' => 'my_module_x', 
        'access arguments' => array('access content'), 
        'type' => MENU_NORMAL_ITEM,
        'cache' => MENU_CALLBACK_CACHE_GLOBAL,
        'cache key callback' => 'my_module_x_cache_key_callback',
        'cache max age' => 60 * 10
      );
      
      return $items;
    }
    
    /**
     * Cache key callback for page x.
     */
    function my_module_x_cache_key_callback() {
      global $user;
      
      // Don't let editors see cached page.
      if (in_array('editor', array_values($user->roles))) {
        throw new DoNotCacheException();
      }
      
      return 'cache-x';
    }
    
    /**
     * Page callback for 'x/'
     */
    function my_module_x() {
      return "This is some content, yo.";
    }

This module is currently in use on a very high traffic website to provide some very helpful page caching.  When coupled with Memcached, it can be a very useful tool in helping to build high performance Drupal modules.  I am currently working on another post that describes several tips and tricks for developing high performance modules.