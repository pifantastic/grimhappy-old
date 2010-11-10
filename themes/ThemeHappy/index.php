<!DOCTYPE html>
<html>
<head>
  <title><?php echo $config->blog_title ?></title>
  
  <link href="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/syntaxhighlighter/styles/shCore.css" rel="stylesheet" type="text/css" />
  <link href="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/syntaxhighlighter/styles/shCoreRDark.css" rel="stylesheet" type="text/css" />
  <link href="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/syntaxhighlighter/styles/shThemeRDark.css" rel="stylesheet" type="text/css" />
  <link href="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/css/jquery.tweet.css" rel="stylesheet" type="text/css" />
  <link href="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <a href="https://github.com/pifantastic/grimhappy/">
    <img style="position: absolute; top: 0; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub" />
  </a> 
  
  <div id="container">
    <header>
      <h1><a href="/"><?php echo $config->blog_title ?></a></h1>
    </header>
    
    <nav>
      <ul>
        <li><a href="/">home</a></li>
        <?php foreach ($config->pages as $p): ?>
          <li><a href="<?php echo $p->url ?>"><?php echo $p->title ?></a></li>
        <?php endforeach ?>
      </ul>
    </nav>

    <div id="content">
      <?php if ($page): ?>
        <article>
          <?php echo $page->html ?>	
        </article>
      <?php else: ?>
        <?php foreach ((array) $posts as $post): ?>
          <article>
            <h1><a href="<?php echo $post->url ?>"><?php echo $post->title ?></a></h1>
            <div class="meta">
              <time><?php echo date($config->date_format, $post->timestamp) ?></time> |
              <a href="<?php echo $post->url ?>#disqus_thread">permalink</a>
            </div>
            <?php echo $post->html ?>
          </article>
        <?php endforeach ?>
      <?php endif ?>
      
      <?php if ($config->disqus_shortname && $disqus): ?>
        <div id="disqus_thread">
          <h3>Say something</h3>
        </div>
        <script type="text/javascript">
          var disqus_identifier = '<?php echo $post->slug ?>';
          (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://grimhappy.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
          })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=grimhappy">comments powered by Disqus.</a></noscript>
      <?php endif ?>
    </div>

    <div id="sidebar">
      <h2>Links</h2>
      <ul>
        <li><a href="http://twitter.com/AaronForsander">Twitter</a></li>
        <li><a href="http://facebook.com/forsander">Facebook</a></li>
        <li><a href="http://www.linkedin.com/in/aaronforsander">Linked In</a></li>
      </ul>
      <div id="twitter" class="tweet">
        <h3>omg tweets!</h3>
      </div>
    </div>
    
    <footer>
      &copy; Aaron Forsander, 2010
    </footer>
  </div>
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
  <script src="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/js/jquery.tweet.js"></script>

  <?php if ($config->disqus_shortname): ?>
  <script type="text/javascript">
    var disqus_shortname = 'grimhappy';
    (function () {
    var s = document.createElement('script'); s.async = true;
    s.src = 'http://disqus.com/forums/' + disqus_shortname + '/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
  </script>
  <?php endif ?>

  <script src="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/syntaxhighlighter/scripts/shCore.js"></script>
  <script src="//<?php echo $config->domain ?>/themes/<?php echo $config->theme ?>/syntaxhighlighter/scripts/shAutoloader.js"></script>
  <script>
    function path() {
      var args = arguments, result = [];
      for (var i = 0; i < args.length; i++)
        result.push(args[i].replace('@', '/themes/<?php echo $config->theme ?>/syntaxhighlighter/scripts/'));
      return result
    };

    $("pre").each(function() {
      var $this = $(this),
      matches = /:::(\w+)/.exec($this.text());
      if (matches && matches.length > 1) {
        $this.text($this.text().replace(':::' + matches[1], '')).attr("class", "brush: " + matches[1]);
      }
    });
      
    SyntaxHighlighter.autoloader.apply(null, path(
      'applescript            @shBrushAppleScript.js',
      'actionscript3 as3      @shBrushAS3.js',
      'bash shell             @shBrushBash.js',
      'coldfusion cf          @shBrushColdFusion.js',
      'cpp c                  @shBrushCpp.js',
      'c# c-sharp csharp      @shBrushCSharp.js',
      'css                    @shBrushCss.js',
      'delphi pascal          @shBrushDelphi.js',
      'diff patch pas         @shBrushDiff.js',
      'erl erlang             @shBrushErlang.js',
      'groovy                 @shBrushGroovy.js',
      'java                   @shBrushJava.js',
      'jfx javafx             @shBrushJavaFX.js',
      'js jscript javascript  @shBrushJScript.js',
      'perl pl                @shBrushPerl.js',
      'php                    @shBrushPhp.js',
      'text plain             @shBrushPlain.js',
      'py python              @shBrushPython.js',
      'ruby rails ror rb      @shBrushRuby.js',
      'sass scss              @shBrushSass.js',
      'scala                  @shBrushScala.js',
      'sql                    @shBrushSql.js',
      'vb vbnet               @shBrushVb.js',
      'xml xhtml xslt html    @shBrushXml.js'
    ));
    
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter.all();
    
    $(function() {
      $("#twitter").tweet({
        join_text: "auto",
        username: "AaronForsander",
        count: 5,
        auto_join_text_default: "", 
        auto_join_text_ed: "",
        auto_join_text_ing: "",
        auto_join_text_reply: "",
        auto_join_text_url: "",
        loading_text: "loading tweets..."
      });
    });
  </script>
</body>
</html>
