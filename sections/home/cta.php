<?php
/**
 * CTA Section
 * 
 * @package Blossom_Shop_Pro
 */

$cta_layout = get_theme_mod( 'cta_layout', 'one' );
if( is_active_sidebar( 'cta' ) ){ ?>
	<section id="cta_section" class="cta-section style-<?php echo esc_attr( $cta_layout ); ?>">
	<?php 
		if( $cta_layout == 'two' ) echo '<div class="container">';
		dynamic_sidebar( 'cta' );
		if( $cta_layout == 'two' ) echo '</div>';
	?>
	</section> <!-- .cta-section -->
<?php
}