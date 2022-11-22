<?php
/**
 * Header Ten
 *
 * @package Blossom_Shop_Pro
 */

$ed_cart   = get_theme_mod( 'ed_shopping_cart', true ); 
$sticky_header = ( get_theme_mod( 'ed_sticky_header', false ) ) ? ' sticky-enabled ' : '';
?>

<header id="masthead" class="site-header header-ten<?php echo esc_attr( $sticky_header ); ?>" itemscope itemtype="http://schema.org/WPHeader">
	<?php 
	$currency_switcher = get_theme_mod( 'currency_switcher_shortcode' );
	$langugage_switcher = get_theme_mod( 'language_switcher_shortcode' );

	if( has_nav_menu( 'secondary' ) || blossom_shop_pro_social_links( false ) || $currency_switcher || $langugage_switcher ) : ?>
		<div class="header-t">
			<div class="container">
				<?php blossom_shop_pro_secondary_navigation(); ?>
				<?php if( blossom_shop_pro_social_links( false ) || $currency_switcher || $langugage_switcher ) : ?>
					<div class="right">
						<?php 
						blossom_shop_pro_currency_block(); 
						blossom_shop_pro_language_block();
						blossom_shop_pro_social_links();
						?>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- .header-t -->
	<?php endif; ?>
	<div class="header-main">
		<div class="container">
			<?php blossom_shop_pro_site_branding(); ?>
			<?php blossom_shop_pro_primary_nagivation(); ?>
            <div class="right">
				<?php blossom_shop_pro_header_search(); ?>
				<?php blossom_shop_pro_user_block(); ?>
				<?php blossom_shop_pro_favourite_block(); ?>
				<?php if( is_woocommerce_activated() && $ed_cart ) blossom_shop_pro_wc_cart_count(); ?>            	
            </div>
		</div>
	</div><!-- .header-main -->
	<?php blossom_shop_pro_sticky_header(); ?>
</header><!-- #masthead -->