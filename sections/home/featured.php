<?php
/**
 * Feature Section
 * 
 * @package Blossom_Shop_Pro
 */
$featured_layout 	 = get_theme_mod( 'featured_layout', 'one' );
$featured_type       = get_theme_mod( 'featured_type', 'feat_page' );
$featured_page_one   = get_theme_mod( 'featured_content_one' );
$featured_page_two   = get_theme_mod( 'featured_content_two' );
$featured_page_three = get_theme_mod( 'featured_content_three' );
$featured_page_four  = get_theme_mod( 'featured_content_four' );

$featured_cat_one   = get_theme_mod( 'cat_featured_one' );
$featured_cat_two   = get_theme_mod( 'cat_featured_two' );
$featured_cat_three = get_theme_mod( 'cat_featured_three' );
$featured_cat_four  = get_theme_mod( 'cat_featured_four' );

$button_title       = get_theme_mod( 'featured_button_title', __( 'DISCOVER NOW','blossom-shop-pro' ) );

$ed_crop_all    = get_theme_mod( 'ed_crop_all', false );

$image_size = '';

if( $featured_layout == 'one' ) {
	$featured_pages      = array( $featured_page_one, $featured_page_two, $featured_page_three );
	$featured_cats       = array( $featured_cat_one, $featured_cat_two, $featured_cat_three );
}else{
	$featured_pages      = array( $featured_page_one, $featured_page_two, $featured_page_three, $featured_page_four );
	$featured_cats       = array( $featured_cat_one, $featured_cat_two, $featured_cat_three, $featured_cat_four );
}

$featured_pages      = array_diff( array_unique( $featured_pages), array( '' ) );
$featured_custom     = get_theme_mod( 'featured_custom' );

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post__in'       => $featured_pages,
    'orderby'        => 'post__in'   
);
	$woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );	
	if( is_woocommerce_activated() ){
		$exclude_ids =  blossom_shop_pro_get_out_of_stock_query();

		if( $woocommerce_hide_out_of_stock_items === 'yes' ){
			$args['post__not_in'] = $exclude_ids;
		}
	}

$qry = new WP_Query( $args );
                    
if( ( $featured_type == 'feat_page' && $featured_pages && $qry->have_posts() ) || ( $featured_cats && $featured_type == 'feat_cat' ) || ( $featured_type == 'feat_custom' && $featured_custom ) ){ ?>
    <section id="featured_section" class="featured-section style-<?php echo esc_attr( $featured_layout ); ?> <?php echo esc_attr( $featured_type ); ?>">
		<div class="container">
		<?php 
            if( $featured_type == 'feat_page' && $featured_pages && $qry->have_posts() ){ ?>
				<?php while( $qry->have_posts() ){ $qry->the_post(); 

				    if( $featured_layout == 'one' || $featured_layout == 'three' ) { 
				        $image_size = 'blossom-shop-featured';
				    }elseif( $featured_layout == 'two' || $featured_layout == 'four' ) {
				        if( $qry->current_post == 0 || $qry->current_post == 1 || $qry->current_post == 2 ){
				        	$image_size = 'blossom-shop-featured';    
				        }elseif( $qry->current_post == 3 ){
				        	$image_size = 'blossom-shop-featured-one';    
				        }
				    }elseif( $featured_layout == 'five' || $featured_layout == 'six' ){ 
				        if( $qry->current_post == 0 ){
				        	$image_size = 'blossom-shop-featured-three';    
				        }elseif( $qry->current_post == 1 ){
				        	$image_size = 'blossom-shop-featured-one';    
				        }elseif( $qry->current_post == 2 || $qry->current_post == 3 ){
				        	$image_size = 'blossom-shop-featured-two';    
				        }
				    }else{
				        $image_size = 'blossom-shop-featured';
				    } 

                    $image_size = ( $ed_crop_all ) ? 'full' : $image_size;
                    ?>
    				<div class="section-block">
                        <figure class="block-img">
                            <?php 
                                if( has_post_thumbnail() ){
                                    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                                }else{
                                	blossom_shop_pro_get_fallback_svg( $image_size );
                                }
                            ?>                                   
                        </figure>
                        <div class="block-content">
                        	<?php if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '<div class="block-inner-content">';
                        	}
                        	the_title( '<h4 class="block-title"><a href="'. esc_url( get_permalink() ) .'">', '</a></h4>' ); ?>
							<?php if( ( $featured_layout != 'one' && $featured_layout != 'three' ) && $qry->current_post == 0 && $button_title ) echo '<a href="'. esc_url( get_permalink() ) .'" class="btn-readmore">' . esc_html( $button_title ) . '</a>';
							if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '</div>';
                        	} ?>
						</div>
    				</div>
				<?php }
                wp_reset_postdata();                                   
            }elseif( is_woocommerce_activated() && $featured_type == 'feat_cat' && $featured_cats ){
                $index = 0; 
                foreach( $featured_cats as $featured_cat ) :
                	if( !$featured_cat ) break;
                	$cat_count = get_term( $featured_cat, 'product_cat' );
				    if( $featured_layout == 'one' || $featured_layout == 'three' ) { 
				        $image_size = 'blossom-shop-featured';
				    }elseif( $featured_layout == 'two' || $featured_layout == 'four' ) {
				        if( $index == 0 || $index == 1 || $index == 2 ){
				        	$image_size = 'blossom-shop-featured';    
				        }elseif( $index == 3 ){
				        	$image_size = 'blossom-shop-featured-one';    
				        }
				    }elseif( $featured_layout == 'five' || $featured_layout == 'six' ){ 
				        if( $index == 0 ){
				        	$image_size = 'blossom-shop-featured-three';    
				        }elseif( $index == 1 ){
				        	$image_size = 'blossom-shop-featured-one';    
				        }elseif( $index == 2 || $index == 3 ){
				        	$image_size = 'blossom-shop-featured-two';    
				        }
				    }else{
				        $image_size = 'blossom-shop-featured';
				    } 

                    $image_size = ( $ed_crop_all ) ? 'full' : $image_size; 
                    ?>
    				<div class="section-block">
                        <figure class="block-img">
                            <?php 
                                if( get_term_meta( absint( $featured_cat ), 'thumbnail_id', true ) ){
                                    $image_id = get_term_meta( absint( $featured_cat ), 'thumbnail_id', true );
                                    echo wp_get_attachment_image( $image_id, $image_size );
                                }else{
                                	blossom_shop_pro_get_fallback_svg( $image_size );
                                }
                            ?>                                   
                        </figure>
                        <div class="block-content">
                        	<?php if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '<div class="block-inner-content">';
                        	}
                        	$term_meta = get_term_by( 'id', $featured_cat, 'product_cat' );

                        	echo '<h4 class="block-title"><a href="'. esc_url( get_term_link( absint( $featured_cat ), 'product_cat' ) ) .'">' . esc_html( $term_meta->name ) . '</a></h4>';

                        	echo '<div class="product-sale-count">';
                        	if ( $cat_count->count ) : ?>
                                <span class="product-count">
                                    <?php printf( _n( '<span class="item-count">%s</span><span class="item-texts">product</span>', '<span class="item-count">%s</span><span class="item-texts">products</span>', $cat_count->count, 'blossom-shop-pro' ), number_format_i18n( $cat_count->count ) ); ?>
                                </span>
                            <?php endif;

                            echo blossom_shop_pro_onsale_product_count( $featured_cat );
                            echo '</div>';
							
							if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '</div>';
                        	} ?>
						</div>
    				</div>
				<?php
                    $index++;
				endforeach;                                   
            }elseif( $featured_type == 'feat_custom' && $featured_custom ){ 
            	$index = 0;
            	foreach( $featured_custom as $feature ){ 
            		if( $featured_layout == 'one' || $featured_layout == 'three' ) { 
				        $image_size = 'blossom-shop-featured';
				    }elseif( $featured_layout == 'two' || $featured_layout == 'four' ) {
				        if( $index == 0 || $index == 1 || $index == 2 ) :
				        	$image_size = 'blossom-shop-featured';    
				        elseif( $index == 3 ) :
				        	$image_size = 'blossom-shop-featured-one';    
				        endif;
				    }elseif( $featured_layout == 'five' || $featured_layout == 'six' ){ 
				        if( $index == 0 ) :
				        	$image_size = 'blossom-shop-featured-three';    
				        elseif( $index == 1 ) :
				        	$image_size = 'blossom-shop-featured-one';    
				        elseif( $index == 2 || $index == 3 ) :
				        	$image_size = 'blossom-shop-featured-two';    
				        endif;
				    }else{
				        $image_size = 'blossom-shop-featured';
				    } 

                    $image_size = ( $ed_crop_all ) ? 'full' : $image_size;
                    
                    ?>
    				<div class="section-block">
                        <figure class="block-img">
                            <?php if( $feature['thumbnail'] ){
                                $image = wp_get_attachment_image_url( $feature['thumbnail'], $image_size );
                                echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $feature['title'] ) . '" itemprop="image">';
                            }else{
                            	blossom_shop_pro_get_fallback_svg( $image_size );
                            } ?>
                        </figure>
						<div class="block-content">
							<?php
							if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '<div class="block-inner-content">';
                        	}
                            if( $feature['title'] ) echo '<h4 class="block-title">';
                            if( !$feature['link'] ) echo '<span>';
                            if( $feature['link'] ) echo '<a href="' . esc_url( $feature['link'] ) . '">';
                            if( $feature['title'] ) echo esc_html( $feature['title'] );
                            if( $feature['link'] ) echo '</a>'; 
                            if( !$feature['link'] ) echo '</span>';
                            if( $feature['title'] ) echo '</h4>';
                            if( ( $featured_layout != 'one' && $featured_layout != 'three' ) && $index == 0 && $button_title && $feature['link'] ) echo '<a href="'. esc_url( esc_url( $feature['link'] ) ) .'" class="btn-readmore">' . esc_html( $button_title ) . '</a>';
                            if( $featured_layout == 'five' || $featured_layout == 'six' ) { 
                        		echo '</div>';
                        	} ?>
						</div>
    				</div>
				<?php $index++; 
				}
            } 
        ?>
		</div>
	</section>
<?php
}    