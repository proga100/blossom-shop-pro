<?php
/**
 * Testimonial Section
 * 
 * @package Blossom_Shop_Pro
 */

$testimonial_layout 		= get_theme_mod( 'testimonial_layout', 'one' );
$testimonial_title 			= get_theme_mod( 'testimonial_title', __( 'Our Happy Customers', 'blossom-shop-pro' ) );
$testimonial_subtitle 		= get_theme_mod( 'testimonial_subtitle', __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ) );

if( is_active_sidebar( 'testimonial' ) ){ ?>
<section id="testimonial_section" class="testimonial-section style-<?php echo esc_attr( $testimonial_layout ); ?>">
	<div class="container">
		<?php if( $testimonial_title || $testimonial_subtitle ) : ?>
			<div class="title-wrap">
				<?php if( $testimonial_title ) echo '<h2 class="section-title">' . esc_html( $testimonial_title ) . '</h2>'; ?>
				<?php if( $testimonial_subtitle ) echo '<div class="section-desc">' . wpautop( wp_kses_post( $testimonial_subtitle ) ) . '</div>'; ?>
	    	</div>
	    <?php endif; ?>
    	<div class="section-grid owl-carousel">
    		<?php dynamic_sidebar( 'testimonial' ); ?>
    	</div>
    </div>
</section> <!-- .testimonial-section -->
<?php
}