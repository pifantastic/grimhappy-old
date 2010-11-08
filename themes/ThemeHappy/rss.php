<rss version="2.0">
	<channel>
		<description><?php echo $config->blog_description ?></description>
		<title><?php echo $config->blog_title ?></title>
		<generator>http://<?php echo $config->domain ?>/</generator>
		<link>http://<?php echo $config->domain ?>/</link>
		<?php foreach ($posts as $post): ?>
			<item>
				<title><?php echo $post->title ?></title>
				<description><?php echo $post->html ?></description>
				<link>http://<?php echo $config->domain . $post->url ?></link>
				<guid>http://<?php echo $config->domain . $post->url ?></guid>
				<pubDate><?php echo $post->timestamp ?></pubDate>
			</item>
		<?php endforeach ?>
	</channel>
</rss>
