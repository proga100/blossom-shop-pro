<?php
/**
 * Banner Section
 * 
 * @package Blossom_Shop_Pro
 */

$ed_banner        = get_theme_mod( 'ed_banner_section', 'slider_banner' );
$slider_type      = get_theme_mod( 'slider_type', 'latest_posts' ); 
$slider_cat       = get_theme_mod( 'slider_cat' );
$slider_cat_product = get_theme_mod( 'slider_cat_product' );
$slider_pages     = get_theme_mod( 'slider_pages' );
$slider_custom    = get_theme_mod( 'slider_custom' );
$posts_per_page   = get_theme_mod( 'no_of_slides', 3 );
$ed_caption       = get_theme_mod( 'slider_caption', true );
$read_more        = get_theme_mod( 'slider_readmore', __( 'SHOP NEW ARRIVALS', 'blossom-shop-pro' ) );
$banner_title     = get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'blossom-shop-pro' ) );
$banner_subtitle  = get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'blossom-shop-pro' ) );
$banner_label     = get_theme_mod( 'banner_label', __( 'Purchase', 'blossom-shop-pro' ) );
$banner_link      = get_theme_mod( 'banner_link', '#' );
$banner_newsletter= get_theme_mod( 'banner_newsletter' );
$slider_layout    = get_theme_mod( 'slider_layout', 'one' );
$banner_caption   = get_theme_mod( 'banner_caption_layout', 'left' );
$image_size       = blossom_shop_pro_slider_image_sizes();
       
if( ( $ed_banner == 'static_banner' || $ed_banner == 'static_nl_banner' || ( is_woocommerce_activated() && $ed_banner == 'static_product' ) ) && has_custom_header() ){ 
    if( has_header_video() ) {
        $custom_header_class = ' video-banner';
    }else{
        $custom_header_class = ' static-banner';
    } ?>
    <div id="banner_section" class="site-banner <?php echo esc_attr( $banner_caption ); ?> <?php echo esc_attr( $custom_header_class ); ?> <?php if( $ed_banner == 'static_nl_banner' ) echo 'static-newsletter'; ?>">
        <?php 
            the_custom_header_markup(); 
                if( $ed_banner == 'static_banner' && ( $banner_title || $banner_subtitle || ( $banner_label && $banner_link ) ) ){
                    echo '<div class="banner-caption ' . esc_attr( $banner_caption ) . '"><div class="container">';
                    if( $banner_title ) echo '<h2 class="banner-title">' . esc_html( $banner_title ) . '</h2>';
                    if( $banner_subtitle ) echo '<div class="banner-desc">' . wp_kses_post( $banner_subtitle ) . '</div>';
            		if( $banner_label && $banner_link ) echo '<a class="btn-readmore" href="' . esc_url( $banner_link ) . '">' . esc_html( $banner_label ) . '</a>';
                    echo '</div></div>';
                }elseif( $ed_banner == 'static_nl_banner' && $banner_newsletter ){
                    echo '<div class="banner-caption ' . esc_attr( $banner_caption ) . '"><div class="container">';
                    echo do_shortcode( wp_kses_post( $banner_newsletter ) );
                    echo '</div></div>';
                }elseif( is_woocommerce_activated() && $ed_banner == 'static_product' && ( $banner_title || $banner_subtitle ) ){
                    echo '<div class="banner-caption ' . esc_attr( $banner_caption ) . '"><div class="container">';
                    if( $banner_title ) echo '<h2 class="banner-title">' . esc_html( $banner_title ) . '</h2>';
                    if( $banner_subtitle ) echo '<div class="banner-desc">' . wp_kses_post( $banner_subtitle ) . '</div>';
                    blossom_shop_pro_product_search_form();
                    echo '</div></div>';
                }   
        ?>
    </div>
<?php
}elseif( $ed_banner == 'slider_banner' ){
    if( $slider_type == 'latest_posts' || $slider_type == 'cat' || $slider_type == 'pages' || ( is_woocommerce_activated() && ( $slider_type == 'latest_products' || $slider_type == 'cat_products' ) ) ){
        $args = array(            
            'ignore_sticky_posts' => true
        );
        
        if( $slider_type == 'cat_products' && $slider_cat_product ) {
            $args['post_type']      = 'product';
            $args['tax_query']      = array( array( 'taxonomy' => 'product_cat', 'terms' => $slider_cat_product ) ); 
            $args['posts_per_page'] = -1;
        }elseif( $slider_type == 'latest_products' ){
            $args['post_type']      = 'product';
            $args['posts_per_page'] = $posts_per_page;          
        }elseif( $slider_type === 'cat' && $slider_cat ){
            $args['post_type']      = 'post';
            $args['cat']            = $slider_cat; 
            $args['posts_per_page'] = -1;  
        }elseif( $slider_type == 'pages' && $slider_pages ){
            $args['post_type']      = 'page';
            $args['posts_per_page'] = -1;
            $args['post__in']       = blossom_shop_pro_get_id_from_page( $slider_pages );
            $args['orderby']        = 'post__in';
        }else{
            $args['post_type']      = 'post';
            $args['posts_per_page'] = $posts_per_page;
        }
            
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div id="banner_section" class="site-banner banner-<?php echo esc_attr( $slider_layout ); ?>">
                <?php if( $slider_layout == 'four' ) echo '<div class="container">'; ?>
                <div class="item-wrap owl-carousel">            
        			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                    <div class="item <?php echo esc_attr( $banner_caption ); ?>">
        				<?php 
                        if( has_post_thumbnail() ){
        				    the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        				}else{ 
        				    blossom_shop_pro_get_fallback_svg( $image_size );//fallback
                        }
                        
                        if( $ed_caption ){ ?>                        
        				<div class="banner-caption <?php echo esc_attr( $banner_caption ); ?>">
        					<div class="container">
        						<div class="text-holder">
        							<?php
                                        blossom_shop_pro_category_slider();
                                        the_title( '<h2 class="banner-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                        if( $read_more ) echo '<div class="button-wrap"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $read_more ) . '</a></div>';                              
                                    ?>
        						</div>
        					</div>
        				</div>
                        <?php } ?>
        			</div>
        			<?php } ?>
                </div>                
            <?php if( $slider_layout == 'four' ) echo '</div>'; ?>                        
            </div>
        <?php
        wp_reset_postdata();
        }
    
    }elseif( $slider_type == 'custom' && $slider_custom ){ ?>
        <div id="banner_section" class="site-banner banner-<?php echo esc_attr( $slider_layout ); ?>">
            <?php if( $slider_layout == 'four' ) echo '<div class="container">'; ?>
    		<div class="item-wrap owl-carousel">
    			<?php 
                foreach( $slider_custom as $slide ){ 
                    if( $slide['thumbnail'] ){ ?>
                        <div class="item <?php echo esc_attr( $banner_caption ); ?>">
                        <?php 
                            $image = wp_get_attachment_image_url( $slide['thumbnail'], $image_size ); ?>
    				        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( strip_tags( $slide['title'] ) ); ?>" itemprop="image" />
                                
                            <?php if( $ed_caption && ( $slide['title'] || $slide['subtitle'] ) ){ ?>                        
                				<div class="banner-caption <?php echo esc_attr( $banner_caption ); ?>">
                					<div class="container">
                						<div class="text-holder">
                							<?php
                                                if( $slide['subtitle'] ){
                                                    echo '<div class="cat-links"><span class="cat-links-border"></span><span class="cat-links-inner">';
                                                    if( $slide['link'] ) echo '<a href="' . esc_url( $slide['link'] ) . '">';
                                                    echo esc_html( $slide['subtitle'] ); 
                                                    if( $slide['link'] ) echo '</a>';
                                                    echo '</span></div>';    
                                                } 
                                                if( $slide['title'] ){
                                                    echo '<h2 class="banner-title">';
                                                    if( $slide['link'] ) echo '<a href="' . esc_url( $slide['link'] ) . '" rel="bookmark">';
                                                    echo wp_kses_post( $slide['title'] );
                                                    if( $slide['link'] ) echo '</a>';
                                                    echo '</h2>';    
                                                }
                                                
                                                if( $read_more && $slide['link'] ) echo '<a href="' . esc_url( $slide['link'] ) . '" class="btn-readmore">' . esc_html( $read_more ) . '</a>';                            
                                            ?>
                						</div>
                					</div>
                				</div>
                            <?php } ?>
            			</div>
        			<?php 
                    } 
                } 
                ?>                        
    		</div>
            <?php if( $slider_layout == 'four' ) echo '</div>'; ?>            
    	</div>
        <?php
    }
}