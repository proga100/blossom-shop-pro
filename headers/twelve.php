<?php
/**
 * Header Twelve
 *
 * @package Blossom_Shop_Pro
 */

$ed_cart   = get_theme_mod( 'ed_shopping_cart', true ); 
$sticky_header = ( get_theme_mod( 'ed_sticky_header', false ) ) ? ' sticky-enabled ' : '';
?>

<header id="masthead" class="site-header header-twelve<?php echo esc_attr( $sticky_header ); ?>" itemscope itemtype="http://schema.org/WPHeader">
	<div class="header-t">
		<div class="container">
			<?php blossom_shop_pro_secondary_navigation(); ?>
			<?php blossom_shop_pro_primary_nagivation(); ?>
			<?php if( blossom_shop_pro_social_links( false ) )
				echo '<div class="right">';
				blossom_shop_pro_social_links();
				echo '</div>';
			?>
		</div>
	</div><!-- .header-t -->
	<div class="header-main">
		<div class="container">
			<div class="left-content">
				<?php 
				blossom_shop_pro_currency_block(); 
				blossom_shop_pro_language_block();
				blossom_shop_pro_header_search();
				?>
			</div>
			<?php blossom_shop_pro_site_branding(); ?>
            <div class="right">
				<?php blossom_shop_pro_user_block(); ?>
				<?php blossom_shop_pro_favourite_block(); ?>
				<?php if( is_woocommerce_activated() && $ed_cart ) blossom_shop_pro_wc_cart_count(); ?>            	
            </div>
		</div>
	</div><!-- .header-main -->
	<?php blossom_shop_pro_sticky_header(); ?>
</header><!-- #masthead -->