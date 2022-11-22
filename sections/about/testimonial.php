<?php
/**
 * About Testimonial Section
 * 
 * @package Blossom_Shop_Pro
 */

$about_testi_title 		= get_theme_mod( 'about_testi_title', __( 'Our Happy Customers', 'blossom-shop-pro' ) );
$about_testi_subtitle 	= get_theme_mod( 'about_testi_subtitle', __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ) );

if( is_active_sidebar( 'about-testimonial' ) ){ ?>
<section id="about_testimonial_section" class="testimonial-section style-three">
	<div class="container">
	    <?php if( $about_testi_title || $about_testi_subtitle ) : ?>
			<div class="title-wrap">
				<?php if( $about_testi_title ) echo '<h2 class="section-title">' . esc_html( $about_testi_title ) . '</h2>'; ?>
				<?php if( $about_testi_subtitle ) echo '<div class="section-desc">' . wpautop( wp_kses_post( $about_testi_subtitle ) ) . '</div>'; ?>
	    	</div>
	    <?php endif; ?>
		<div class="section-grid owl-carousel">
			<?php dynamic_sidebar( 'about-testimonial' ); ?>
		</div>
	</div>
</section><!-- .testimonial-section -->
<?php
}