<?php
/**
 * Category Three Section
 *
 * @package Blossom_Shop_Pro
 */

if ( is_woocommerce_activated() ) {
	$sec_title        = get_theme_mod( 'cat_three_title', __( 'Products On Sales', 'blossom-shop-pro' ) );
	$sub_title        = get_theme_mod( 'cat_three_subtitle', __( 'Grab the limited time offers on these products.', 'blossom-shop-pro' ) );
	$cat_three_select = get_theme_mod( 'cat_three_select' );
	$cat_three_type   = get_theme_mod( 'cat_three_type', 'latest_cat_three' );
	$cat_three_layout = get_theme_mod( 'cat_three_layout', 'five' );
	$featured_image   = get_theme_mod( 'cat_three_featured_image' );
	$feat_title       = get_theme_mod( 'cat_three_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) );
	$feat_subtitle    = get_theme_mod( 'cat_three_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) );
	$feat_url         = get_theme_mod( 'cat_three_featured_url', '#' );
	$feat_label       = get_theme_mod( 'cat_three_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) );
	$label                = get_theme_mod( 'cat_three_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) );
	$cat_three_image_size = ( $cat_three_layout != 'two' ) ? 'blossom-shop-recent' : 'blossom-shop-recent-two';
	$ed_crop_all          = get_theme_mod( 'ed_crop_all', false );
	$cat_three_image_size = ( $ed_crop_all ) ? 'full' : $cat_three_image_size;
	if ( $cat_three_select ) {

		$cat_three_term = get_term( $cat_three_select, 'product_cat' );
		$term_count     = $cat_three_term->count;
		if ( $cat_three_layout == 'three' || $cat_three_layout == 'five' ) :
			$posts_per_page = ( $term_count > 4 ) ? 4 : $term_count;
		elseif ( $cat_three_layout == 'four' || $cat_three_layout == 'six' ) :
			$posts_per_page = ( $term_count > 6 ) ? 6 : $term_count;
		else:
			$posts_per_page = ( $term_count > 8 ) ? 8 : $term_count;
		endif;
		$args                                = array(
				'post_type'      => 'product',
				'posts_per_page' => $posts_per_page,
				'tax_query'      => array(
						array(
								'taxonomy'         => 'product_cat',
								'terms'            => absint( $cat_three_select ),
								'include_children' => false,
						),
				),
		);
		$woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );
		$exclude_ids                         = blossom_shop_pro_get_out_of_stock_query();
		if ( $woocommerce_hide_out_of_stock_items === 'yes' ) {
			$args['post__not_in'] = $exclude_ids;
		}
		if ( $cat_three_type == 'on_sales_three' ) {
			$args['post__in'] = wc_get_product_ids_on_sale();
		} elseif ( $cat_three_type == 'number_reviews_three' ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_wc_average_rating';
		}
		$args_featured = array(
				'post_type'      => 'product',
				'posts_per_page' => 2,
				'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                ),
            ),
		);
		$qry           = new WP_Query( $args );
		$qry_featured  = new WP_Query( $args_featured );
		if ( $qry->have_posts() ) { ?>
			<section id="cat_three_section" class="third-cat-section style-<?php echo esc_attr( $cat_three_layout ); ?>">
				<div class="container">
					<?php if ( $sec_title || $sub_title ) { ?>
						<div class="cat-wrap">
							<?php
							if ( $sec_title ) {
								echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
							}
							if ( $sub_title ) {
								echo '<div class="section-desc">' . wpautop( wp_kses_post( $sub_title ) ) . '</div>';
							}
							?>
						</div>
					<?php }
					if ( $cat_three_layout != 'one' && $cat_three_layout != 'two' && ( $featured_image || $feat_title || $feat_subtitle || ( $feat_url && $feat_label ) ) ) { ?>
						<div class="cat-feature">
							<?php if ( $featured_image ) {
								blossom_shop_pro_homepage_featured_image( 'cat_three_featured_image' );
							} ?>
							<div class="product-title-wrap">
								<?php
								if ( $feat_title || $feat_subtitle ) { ?>
									<div class="cat-wrap">
										<?php
										if ( $feat_title ) {
											echo '<h4 class="pp-title">' . esc_html( $feat_title ) . '</h2>';
										}
										if ( $feat_subtitle ) {
											echo '<div class="pp-desc">' . wpautop( wp_kses_post( $feat_subtitle ) ) . '</div>';
										}
										?>
									</div>
								<?php }
								if ( $feat_url && $feat_label ) { ?>
									<div class="button-wrap">
										<a href="<?php echo esc_url( $feat_url ); ?>" class="btn-readmore"><?php echo esc_html( $feat_label ); ?></a>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<div class="cat-grid">
						<?php
						$lms_counter = 1;
						while ( $qry_featured->have_posts() ) {
							$qry_featured->the_post();
							global $product; ?>
							<div class="item stm_prod_<?php echo esc_attr( $lms_counter ) ?>">
								<?php
								$stock = get_post_meta( get_the_ID(), '_stock_status', true );
								if ( $stock == 'outofstock' ) {
									echo '<span class="outofstock">' . esc_html__( 'Sold Out', 'blossom-shop-pro' ) . '</span>';
								} else {
									woocommerce_show_product_sale_flash();
								}
								?>
								<div class="cat-image">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $cat_three_image_size );
										} else {
											blossom_shop_pro_get_fallback_svg( $cat_three_image_size );
										}
										?>
									</a>
									<?php if ( is_yith_whislist_activated() ) {
										echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
									} ?>
									<?php if ( is_yith_quickview_activated() ) {
										echo do_shortcode( '[yith_quick_view]' );
									} ?>
									<?php if ( is_yith_compare_activated() ) {
										echo do_shortcode( '[yith_compare_button]' );
									} ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>

								<?php
								the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
								echo wc_get_rating_html( $product->get_average_rating() );
								woocommerce_template_single_price(); //price
								?>
							</div>
							<?php
							$lms_counter ++;
						}
						$lms_counter = 1;
						while ( $qry->have_posts() ) {
							$qry->the_post();
							global $product; ?>
							<div class="item stm_prod_<?php echo esc_attr( $lms_counter ) ?>">
								<?php
								$stock = get_post_meta( get_the_ID(), '_stock_status', true );
								if ( $stock == 'outofstock' ) {
									echo '<span class="outofstock">' . esc_html__( 'Sold Out', 'blossom-shop-pro' ) . '</span>';
								} else {
									woocommerce_show_product_sale_flash();
								}
								?>
								<div class="cat-image">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $cat_three_image_size );
										} else {
											blossom_shop_pro_get_fallback_svg( $cat_three_image_size );
										}
										?>
									</a>
									<?php if ( is_yith_whislist_activated() ) {
										echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
									} ?>
									<?php if ( is_yith_quickview_activated() ) {
										echo do_shortcode( '[yith_quick_view]' );
									} ?>
									<?php if ( is_yith_compare_activated() ) {
										echo do_shortcode( '[yith_compare_button]' );
									} ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								</div>

								<?php
								the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
								echo wc_get_rating_html( $product->get_average_rating() );
								woocommerce_template_single_price(); //price
								?>
							</div>
							<?php
							$lms_counter ++;
						}
						?>

					</div>
					<button class="lms-more-products"><?php echo esc_html__( 'More products ...', 'blossom-shop-pro' ) ?></button>
					<?php
					wp_reset_postdata(); ?>

					<?php if ( $cat_three_select && $label ) { ?>
						<div class="button-wrap">
							<a href="<?php echo esc_url( get_category_link( $cat_three_select ) ); ?>" class="btn-readmore"><?php echo esc_html( $label ); ?></a>
						</div>
					<?php } ?>
				</div>
			</section> <!-- .third-cat-section -->
			<?php
		}
	}
}