<?php
namespace GrimHappy;
?>
<rss version="2.0">
	<channel>
		<description><?php echo Config::$blog_description ?></description>
		<title><?php echo Config::$blog_title ?></title>
		<generator>http://<?php echo Config::$domain ?>/</generator>
		<link>http://<?php echo Config::$domain ?>/</link>
		<?php foreach ($posts as $post): ?>
			<item>
				<title><?php echo $post->title ?></title>
				<description><?php echo htmlspecialchars($post->html) ?></description>
				<link>http://<?php echo Config::$domain . $post->url ?></link>
				<guid>http://<?php echo Config::$domain . $post->url ?></guid>
				<pubDate><?php echo $post->timestamp ?></pubDate>
			</item>
		<?php endforeach ?>
	</channel>
</rss>
