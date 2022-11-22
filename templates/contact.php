<?php
/**
 * Template Name: Contact Page
 * 
 * @package Blossom_Shop_Pro
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			if ( is_active_sidebar( 'contact-form-template-locations' ) ) {
				echo '<div class="contact-form-template-locations">';
				dynamic_sidebar( 'contact-form-template-locations' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'contact-form-template' ) ) {
				echo '<div class="contact-form-wrap">';
				dynamic_sidebar( 'contact-form-template' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'contact-template' ) ) {
				echo '<div class="contact-map-wrap">';
				dynamic_sidebar( 'contact-template' );
				echo '</div>';
			}
			?>
		</main>
	</div>	
<?php         
get_footer();