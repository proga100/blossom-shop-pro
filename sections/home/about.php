<?php
/**
 * About Section
 * 
 * @package Blossom_Shop_Pro
 */

$about_layout = get_theme_mod( 'about_layout', 'one' );

if( is_active_sidebar( 'about' ) ){ ?>
<section id="about_section" class="about-section style-<?php echo esc_attr( $about_layout ); ?>">
	<div class="container">
    	<?php dynamic_sidebar( 'about' ); ?>
	</div>
</section><!-- .about-section -->
<?php
}