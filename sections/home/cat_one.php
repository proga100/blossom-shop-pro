<?php
/**
 * Category One Section
 * 
 * @package Blossom_Shop_Pro
 */

if( is_woocommerce_activated() ) {
    global $product;
    $sec_title    	      = get_theme_mod( 'cat_one_title', __( 'Best Sellers', 'blossom-shop-pro' ) );
    $sub_title        = get_theme_mod( 'cat_one_subtitle', __( 'Check out our best sellers products.', 'blossom-shop-pro' ) );
    $cat_one_select   = get_theme_mod( 'cat_one_select' );
    $cat_one_type     = get_theme_mod( 'cat_one_type', 'latest_cat_one' ); 
    $cat_one_layout   = get_theme_mod( 'cat_one_layout', 'three' );
    $featured_image   = get_theme_mod( 'cat_one_featured_image' ); 
    $feat_title 	  = get_theme_mod( 'cat_one_featured_title', __( 'STREET TRENDING 2019','blossom-shop-pro' ) );
    $feat_subtitle    = get_theme_mod( 'cat_one_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION','blossom-shop-pro' ) );
    $feat_url 		  = get_theme_mod( 'cat_one_featured_url', '#' );
    $feat_label		  = get_theme_mod( 'cat_one_featured_label', __( 'DISCOVER NOW','blossom-shop-pro' ) );

    $label    = get_theme_mod( 'cat_one_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) );
    $cat_one_image_size = ( $cat_one_layout != 'two' ) ? 'blossom-shop-recent' : 'blossom-shop-recent-two';
    
    $ed_crop_all    = get_theme_mod( 'ed_crop_all', false );
    $cat_one_image_size = ( $ed_crop_all ) ? 'full' : $cat_one_image_size;
    
    if( $cat_one_select ) {

        $cat_one_term = get_term( $cat_one_select, 'product_cat' );
        $term_count = $cat_one_term->count;

        if( $cat_one_layout == 'three' || $cat_one_layout == 'five' ) :
        	$posts_per_page   = ( $term_count > 4 ) ? 4 : $term_count;
        elseif( $cat_one_layout == 'four' || $cat_one_layout == 'six' ) :
        	$posts_per_page   = ( $term_count > 6 ) ? 6 : $term_count;
        else:
        	$posts_per_page   = ( $term_count > 8 ) ? 8 : $term_count;
        endif;
        
        $args = array(
            'post_type'           => 'product',            
            'posts_per_page'      => $posts_per_page,
            'tax_query'           => array( 
                array(
                    'taxonomy'          => 'product_cat',
                    'terms'             => $cat_one_select,
                    'include_children'  => false,
                ),
            ),
        );

        if( $cat_one_type == 'on_sales_one' ){
            $args['post__in'] 		= wc_get_product_ids_on_sale();   
        }elseif( $cat_one_type == 'number_reviews_one' ){   
            $args['orderby']        = 'meta_value_num';   
            $args['meta_key']       = '_wc_average_rating';   
        }
        $woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );
	    $exclude_ids =  blossom_shop_pro_get_out_of_stock_query();

        if( $woocommerce_hide_out_of_stock_items === 'yes' ){
            $args['post__not_in'] = $exclude_ids;
        }
        
    	$qry_cat_one = new WP_Query( $args ); 
        
    	if( $qry_cat_one->have_posts() ){ ?>
    		<section id="cat_one_section" class="first-cat-section style-<?php echo esc_attr( $cat_one_layout ); ?>">
    			<div class="container">
    				<?php if( $sec_title || $sub_title ){ ?>
    	            	<div class="cat-wrap">	
    		                <?php
    			            if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
    			            if( $sub_title ) echo '<div class="section-desc">' . wpautop( wp_kses_post(  $sub_title ) ) . '</div>'; 
    		        		?>
    		    		</div>
    		        <?php }				
    				 
    				if( $cat_one_layout != 'one' && $cat_one_layout != 'two' && ( $featured_image || $feat_title || $feat_subtitle || ( $feat_url && $feat_label ) ) ) { ?>
    					<div class="cat-feature">
    						<?php if( $featured_image ) blossom_shop_pro_homepage_featured_image( 'cat_one_featured_image' ); ?>
    						<div class="product-title-wrap">
                                <?php
                                if( $feat_title || $feat_subtitle ){ ?>
        			            	<div class="cat-wrap">	
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
    	            <div class="cat-grid">
                    	<?php
                        while( $qry_cat_one->have_posts() ){
                            $qry_cat_one->the_post(); global $product; ?>
                            <div class="item">
                            	<?php
                                    $stock = get_post_meta( get_the_ID(), '_stock_status', true );
                                    
                                    if( $stock == 'outofstock' ){
                                        echo '<span class="outofstock">' . esc_html__( 'Sold Out', 'blossom-shop-pro' ) . '</span>';
                                    }else{
                                        woocommerce_show_product_sale_flash();    
                                    }
                                ?>	                            
                                <div class="cat-image">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php 
                                        if( has_post_thumbnail() ){
                                            the_post_thumbnail( $cat_one_image_size );    
                                        }else{
                                            blossom_shop_pro_get_fallback_svg( $cat_one_image_size );
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
                    
                    <?php if( $cat_one_select && $label ){ ?>
                        <div class="button-wrap">
                            <a href="<?php echo esc_url( get_category_link( $cat_one_select ) ); ?>" class="btn-readmore"><?php echo esc_html( $label ); ?></a>
                        </div>
                    <?php } ?>		        
    			</div>
    		</section> <!-- .first-cat-section -->
    	<?php 
    	}
    }
}