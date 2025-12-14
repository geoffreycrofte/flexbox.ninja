<?php
require_once( '../inc/functions.php' );

$slug = esc_key( $_GET['p'] );

if ( $demo = demo_exists( $slug ) ) {
	$demo_url= BASE_URL . '/demos/' . $slug;
	$img     = $demo_url . '/' . $slug;
	$classes = isset( $demo -> color ) ? ' ' . $demo -> color : '';
	$title   = $demo -> title . ' solved with Flexbox';

	$scripts = array(
		BASE_URL . '/assets/js/highlight.min.js',
		BASE_URL . '/assets/js/main.js'
	);
	$styles = array(
		BASE_URL . '/assets/css/zenburn.css'
	);

	$meta = array(
		'title'       => $title,
		'description' => $demo -> desc,
		'image'       => $img . '-big.png',
		'image_og'    => $img . '-big.png',
	);

	require_once( '../inc/header.php' );

?>

		<section class="demo-page-content<?php echo $classes; ?>" role="main">
			<header class="demo-header">
				<h1 class="demo-title"><?php echo $demo -> title; ?></h1>
				<img class="demo-image" src="<?php echo $img . '-big.png'; ?>" srcset="<?php echo $img . '.svg'; ?> 1x, <?php echo $img . '.svg'; ?> 2x" alt="" width="640" height="382">
				<?php if ( $demo-> dl || $demo-> direct ) { ?>

				<p class="demo-links">
					<?php if ( $demo-> dl ) { ?>

					<a id="download-demo" data-demo="<?php echo $slug; ?>" class="button-ghost" href="<?php echo $demo_url; ?>/demo.html" download="<?php echo $slug; ?>.html" target="_blank" title="Demo downloads in a new tab">Download demo</a>

					<?php } if ( $demo-> direct ) { ?>

					<a id="see-demo" data-demo="<?php echo $slug; ?>" class="button" href="<?php echo $demo_url; ?>/demo.html" target="_blank" title="Demo opens in a new tab">See demo</a>

					<?php } ?>

				</p>

				<?php } ?>

			</header>

			<div class="main-content">

				<?php echo get_demo_content( $slug ); ?>

			</div>
		</section>

		<?php 
			$data = array(
				'slug'  => $slug,
				'title' => $title,
			);
			share_the_love( $data );
		?>

<?php
}
else {
	$meta = array(
		'title'       => 'Error',
		'description' => 'Something wrong with this demo',
	);
	require_once( '../inc/header.php' );
?>

		<p>This is weird. You accessed a page that looks like a demo, but our little database just responded that demo doesn't exist. Probably an issue on our side though, no worries, we will work on getting this page on track.</p>
<?php
}

require_once( '../inc/footer.php' );
