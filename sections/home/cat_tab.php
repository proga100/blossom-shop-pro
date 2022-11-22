<?php
/**
 * Category Tab Section
 * 
 * @package Blossom_Shop_Pro
 */

$show_category_tabs = get_theme_mod( 'cat_tab_custom' );

if( is_woocommerce_activated() && $show_category_tabs ){ ?>
	<section id="cat_tab_section" class="cat-tab-section">
		<div class="container">
			<div id="temp" style="display: none;"></div>
			<?php blossom_shop_pro_get_category_tabs(); ?>
		</div>
	</section><!-- .special-pricing-section -->
<?php }