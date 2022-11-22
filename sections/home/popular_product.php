<?php
/**
 * Popular Products Section
 * 
 * @package Blossom_Shop_Pro
 */
if( is_woocommerce_activated() ) {
    $sec_title    	= get_theme_mod( 'popular_product_title', __( 'Popular Products', 'blossom-shop-pro' ) );
    $sub_title  = get_theme_mod( 'popular_product_subtitle', __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ) );
    $popular_product_type   = get_theme_mod( 'popular_product_type', 'from_views' ); 
    $popular_product_layout = get_theme_mod( 'popular_product_layout', 'one' );
    $featured_image   = get_theme_mod( 'popular_product_featured_image' ); 
    $feat_title 	  = get_theme_mod( 'popular_product_featured_title', __( 'STREET TRENDING 2019','blossom-shop-pro' ) );
    $feat_subtitle    = get_theme_mod( 'popular_product_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION','blossom-shop-pro' ) );
    $feat_url 		  = get_theme_mod( 'popular_product_featured_url', '#' );
    $feat_label		  = get_theme_mod( 'popular_product_featured_label', __( 'DISCOVER NOW','blossom-shop-pro' ) );

    $label      = get_theme_mod( 'popular_product_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) );
    $btn_link   = get_theme_mod( 'popular_product_link', '#');
    $popular_image_size = ( $popular_product_layout != 'two' ) ? 'blossom-shop-recent' : 'blossom-shop-recent-two';

    $ed_crop_all    = get_theme_mod( 'ed_crop_all', false );
    $popular_image_size = ( $ed_crop_all ) ? 'full' : $popular_image_size;
    
    if( $popular_product_layout == 'three' || $popular_product_layout == 'five' ) :
    	$posts_per_page   = 4;
    elseif( $popular_product_layout == 'four' || $popular_product_layout == 'six' ) :
    	$posts_per_page   = 6;
    else:
    	$posts_per_page   = 8;
    endif;

    $args = array(
        'post_type'           => 'product',                        
        'ignore_sticky_posts' => true,
        'posts_per_page'      => $posts_per_page,
    );

    $woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );
	$exclude_ids =  blossom_shop_pro_get_out_of_stock_query();

	if( $woocommerce_hide_out_of_stock_items === 'yes' ){
		$args['post__not_in'] = $exclude_ids;
	}
    if( $popular_product_type == 'from_views' ){
        $args['orderby']        = 'meta_value_num';
        $args['meta_key']       = '_blossom_shop_pro_view_count';   
    }elseif( $popular_product_type == 'from_comments' ){
        $args['orderby'] = 'comment_count';
    }
    
    $qry = new WP_Query( $args );
        
    if( $qry->have_posts() && ( $sec_title || $sub_title || $popular_product_type == 'from_views' || $popular_product_type == 'from_comments' ) ) { ?>
		<section id="popular_product_section" class="popular-prod-section style-<?php echo esc_attr( $popular_product_layout ); ?>">
			<div class="container">
				<?php if( $sec_title || $sub_title ){ ?>
	            	<div class="popular-prod-wrap">	
		                <?php
			            if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
			            if( $sub_title ) echo '<div class="section-desc">' . wpautop( wp_kses_post(  $sub_title ) ) . '</div>'; 
		        		?>
		    		</div>
		        <?php }				
				 
				if( $popular_product_layout != 'one' && $popular_product_layout != 'two' && ( $featured_image || $feat_title || $feat_subtitle || ( $feat_url && $feat_label ) ) ) { ?>
					<div class="popular-prod-feature">
						<?php if( $featured_image ) blossom_shop_pro_homepage_featured_image( 'popular_product_featured_image' ); ?>
						<div class="product-title-wrap">
                            <?php
                            if( $feat_title || $feat_subtitle ){ ?>
    			            	<div class="popular-prod-wrap">	
    				                <?php
    					            if( $feat_title ) echo '<h4 class="pp-title">' . esc_html( $feat_title ) . '</h2>';
    					            if( $feat_subtitle ) echo '<div class="pp-desc">' . wpautop( wp_kses_post(  $feat_subtitle ) ) . '</div>'; 
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
	            <div class="popular-prod-grid">
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
                            <div class="popular-prod-image">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( $popular_image_size );    
                                    }else{
                                        blossom_shop_pro_get_fallback_svg( $popular_image_size );
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
	            <?php
	            wp_reset_postdata(); ?>
                
                <?php if( ( wc_get_page_id( 'shop' ) ) && $label ){ ?>
                    <div class="button-wrap">
                        <a href="<?php the_permalink( wc_get_page_id( 'shop' ) ); ?>" class="btn-readmore"><?php echo esc_html( $label ); ?></a>
                    </div>
                <?php } ?>		        
			</div>
		</section> <!-- .popular-prod-section -->
	<?php 
	}
}