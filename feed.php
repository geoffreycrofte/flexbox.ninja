<?php
header('Content-Type: application/xml; charset=UTF-8');
require_once( '../inc/functions.php' );

$metas       = _get_header();
$description = $metas['description'];
$title       = $metas['title'];

$demos     = get_demos();
$items     = '';
$last_post = '';

foreach ( $demos as $slug => $metas ) {
	$demo_content = get_demo_content( $slug );
	$strtotime = strtotime( $metas->dateCreated );

	$post_date = date( 'D, d M Y H:i:s O', $strtotime );
	$last_post = (int) $strtotime > (int) $last_post ? $strtotime : $last_post;

	$items .= "\n\t" . '<item>
		<title>' . $metas -> title . '</title>
		<link>' . DEMOS_URL . '/' . $slug . '/</link>
		<author>Geoffrey Crofte</author>
		<pubDate>' . $post_date . '</pubDate>
		<source url="' . BASE_URL . '/feed">Geoffreycrofte.com - Flexbox·ninja</source>
		<guid isPermaLink="true">' . DEMOS_URL . '/' . $slug . '</guid>

		<description><![CDATA[
			<img src="' . DEMOS_URL . '/' . $slug . '/' . $slug . '-big.png" width="362" height="216" />
			' . $demo_content . '
		]]></description>
	</item>' . "\n";
}
?><?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Flexbox.ninja</title>
		<link><?php echo BASE_URL; ?></link>
		<description><?php echo $description; ?></description>
		<language>EN</language>
		<pubDate><?php echo date( 'D, d M Y H:i:s O', $file_age ); ?></pubDate>
		<lastBuildDate><?php echo date( 'D, d M Y H:i:s O', $last_post ); ?></lastBuildDate>
		<docs>http://www.rssboard.org</docs>
		<image>
			<title>GeoffreyCrofte.com - Flexbox·ninja</title>
			<url><?php echo BASE_URL . '/assets/images/logo.png'; ?></url>
			<link><?php echo BASE_URL; ?></link>
			<description><?php echo $title; ?></description>
			<width>144</width>
			<height>80</height>
		</image>
		<skipHours>
			<hour>23</hour>
		</skipHours>
		<skipDays>
			<day>Sunday</day>
		</skipDays>
		<atom:link href="<?php echo BASE_URL; ?>/feed" rel="self" type="application/rss+xml" />


		<?php echo $items; ?>

	</channel>
</rss>
