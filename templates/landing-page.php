<?php
/**
 * Template Name: Landing Page
 * 
 * @package Blossom_Shop_Pro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head itemscope itemtype="http://schema.org/WebSite">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php wp_body_open(); ?>
		<div id="page" class="site">
			<div id="content" class="site-content">
				<div class="container">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
							<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'page' );

							endwhile; // End of the loop.
							?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div><!-- .container -->
			</div><!-- #content -->
		</div><!-- #page -->
		<?php wp_footer(); ?>
	</body>
</html>