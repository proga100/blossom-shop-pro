<?php
/**
 * Service Section
 * 
 * @package Blossom_Shop_Pro
 */

$service_layout = get_theme_mod( 'service_layout', 'one' );
$service_background = get_theme_mod( 'service_background', false );

if( is_active_sidebar( 'service' ) ){ ?>
<section id="service_section" class="top-service-section style-<?php echo esc_attr( $service_layout ); ?><?php if( $service_background ) echo ' has-bg'; ?>">
	<div class="container">
    	<?php dynamic_sidebar( 'service' ); ?>
	</div>
</section> <!-- .top-service-section -->
<?php
}