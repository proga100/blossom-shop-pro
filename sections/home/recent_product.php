<?php
/**
 * Recent Products Section
 * 
 * @package Blossom_Shop_Pro
 */
if( is_woocommerce_activated() ) {
	$sec_title    	= get_theme_mod( 'recent_product_title', __( 'New Arrivals', 'blossom-shop-pro' ) );
	$sub_title  = get_theme_mod( 'recent_product_subtitle', __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ) );
	$recent_product_type      = get_theme_mod( 'recent_product_type', 'latest_products' ); 
	$rp_cat           = get_theme_mod( 'rp_cat' );
	$rp_custom    	  = get_theme_mod( 'rp_custom' );
	$recent_product_layout = get_theme_mod( 'recent_product_layout', 'one' );
	$featured_image   = get_theme_mod( 'recent_product_featured_image' ); 
	$feat_title 	  = get_theme_mod( 'recent_product_featured_title', __( 'The Biggest Street Style Trends','blossom-shop-pro' ) );
	$feat_subtitle    = get_theme_mod( 'recent_product_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION','blossom-shop-pro' ) );
	$feat_url 		  = get_theme_mod( 'recent_product_featured_url', '#' );
	$feat_label		  = get_theme_mod( 'recent_product_featured_label', __( 'DISCOVER NOW','blossom-shop-pro' ) );
	$recent_image_size = ( $recent_product_layout != 'two' ) ? 'blossom-shop-recent' : 'blossom-shop-recent-two';

	$ed_crop_all    = get_theme_mod( 'ed_crop_all', false );
    $recent_image_size = ( $ed_crop_all ) ? 'full' : $recent_image_size;
    
	$rp_list = array();
	$term_count = '';
	if( $rp_custom ){
		foreach ( $rp_custom as $rp ){
			$rp_list[] = $rp['product'];
		}
	}

	if( $recent_product_type == 'single_products' ) {
		$single_products_posts = count( $rp_list );
	}

	if( $recent_product_type == 'cat_products' && $rp_cat && isset($rp_cat) ) {
		$term = get_term( $rp_cat, 'product_cat' );
	    $term_count = $term->count;
	}

	switch( $recent_product_type ) {

		case 'latest_products' :
			if( $recent_product_layout == 'three' || $recent_product_layout == 'five' ) :
				$posts_per_page   = 4;
			elseif( $recent_product_layout == 'four' || $recent_product_layout == 'six' ) :
				$posts_per_page   = 6;
			else:
				$posts_per_page   = get_theme_mod( 'no_of_products', 5 );
			endif;
		break;
		
		case 'single_products' :
			if( $recent_product_layout == 'three' || $recent_product_layout == 'five' ) :
				$posts_per_page   = ( $single_products_posts > 4 ) ? 4 : $single_products_posts;
			elseif( $recent_product_layout == 'four' || $recent_product_layout == 'six' ) :
				$posts_per_page   = ( $single_products_posts > 6 ) ? 6 : $single_products_posts;
			else:
				$posts_per_page   = $single_products_posts;
			endif;
		break;
		
		case 'cat_products' :
			if( $recent_product_layout == 'three' || $recent_product_layout == 'five' ) :
				$posts_per_page   = ( $term_count > 4 ) ? 4 : $term_count;
			elseif( $recent_product_layout == 'four' || $recent_product_layout == 'six' ) :
				$posts_per_page   = ( $term_count > 6 ) ? 6 : $term_count;
			else:
				$posts_per_page   = $term_count;
			endif;
		break;
	}

	if( $posts_per_page == 0 ) return false;
 

	$args = array(
        'post_type'           => 'product',                        
        'ignore_sticky_posts' => true,
        'posts_per_page'	  => $posts_per_page,
    );

	$woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );
	$exclude_ids =  blossom_shop_pro_get_out_of_stock_query();

	if( $woocommerce_hide_out_of_stock_items === 'yes' ){
		$args['post__not_in'] = $exclude_ids;
	}
    
    if( $recent_product_type == 'cat_products' && $rp_cat ){
        $args['tax_query']      = array( array( 'taxonomy' => 'product_cat', 'terms' => $rp_cat, ) ); 
    }elseif( $recent_product_type == 'single_products' && $rp_custom ){
        $args['post__in']       = $rp_list;
        $args['orderby']        = 'post__in';
    }
	$qry = new WP_Query( $args );
	if( $qry->have_posts() && ( $sec_title || $sub_title || $recent_product_type == 'latest_products' || $recent_product_type == 'cat_products' || $recent_product_type == 'single_products' ) ) { ?>
		<section id="recent_product_section" class="recent-prod-section style-<?php echo esc_attr( $recent_product_layout ); ?>">
			<div class="container">
				<?php if( $sec_title || $sub_title ){ ?>
	            	<div class="recent-prod-wrap">	
		                <?php
			            if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
			            if( $sub_title ) echo '<div class="section-desc">' . wpautop( wp_kses_post(  $sub_title ) ) . '</div>'; 
		        		?>
		    		</div>
		        <?php }
				 
				if( $recent_product_layout != 'one' && $recent_product_layout != 'two' && ( $featured_image || $feat_title || $feat_subtitle || ( $feat_url && $feat_label ) ) ) { ?>
					<div class="recent-prod-feature">
						<?php if( $featured_image ) blossom_shop_pro_homepage_featured_image( 'recent_product_featured_image' ); ?>
						<div class="product-title-wrap">
							<?php
							if( $feat_title || $feat_subtitle ){ ?>
				            	<div class="recent-prod-wrap">	
					                <?php
						            if( $feat_title ) echo '<h4 class="rp-title">' . esc_html( $feat_title ) . '</h2>';
						            if( $feat_subtitle ) echo '<div class="rp-desc">' . wpautop( wp_kses_post(  $feat_subtitle ) ) . '</div>'; 
					        		?>
					    		</div>
					        <?php }
					        if( $feat_url && $feat_label ){ ?>
								<div class="button-wrap">
				        			<a href="<?php echo esc_url( $feat_url ); ?>" class="btn-readmore"><?php echo esc_html( $feat_label ); ?></a>
				        		</div>
					        <?php } ?>
					    </div>
					</div>
				<?php } ?> 
	            <div class="recent-prod-grid">
	                <div class="recent-prod-slider<?php if( $recent_product_layout == 'one' || $recent_product_layout == 'two' )echo ' owl-carousel'; ?>">
	                <?php
	                    while( $qry->have_posts() ){
	                        $qry->the_post(); global $product; ?>
	                        <div class="item">
	                        	<?php
	                                $stock = get_post_meta( get_the_ID(), '_stock_status', true );
	                                if( $stock == 'outofstock' ){
	                                    echo '<span class="outofstock">' . esc_html__( 'Sold Out', 'blossom-shop-pro' ) . '</span>';
	                                }else{
	                                    woocommerce_show_product_sale_flash();    
	                                }
	                            ?>	                            
	                            <div class="recent-prod-image">
	                                <a href="<?php the_permalink(); ?>" rel="bookmark">
	                                    <?php 
	                                    if( has_post_thumbnail() ){
	                                        the_post_thumbnail( $recent_image_size );    
	                                    }else{
	                                        blossom_shop_pro_get_fallback_svg( $recent_image_size );
	                                    }
	                                    ?>
	                                </a>
	                                <?php if( is_yith_whislist_activated() ) echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
	                                <?php if( is_yith_quickview_activated() ) echo do_shortcode( '[yith_quick_view]' ); ?>
	                                <?php if( is_yith_compare_activated() ) echo do_shortcode( '[yith_compare_button]' ); ?>
	                                <?php woocommerce_template_loop_add_to_cart(); ?>
	                            </div>
	                            
	                            <?php                            
	                            the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); 
	                            echo wc_get_rating_html( $product->get_average_rating() );                                  
	                            woocommerce_template_single_price(); //price                                
	                            
	                        	?>
	                        </div>
	                        <?php
	                    }
	                    ?>
	                </div>
	            </div>
	            <?php
	            wp_reset_postdata(); ?>
		        
			</div>
		</section> <!-- .recent-prod-section -->
						
	<?php }
}