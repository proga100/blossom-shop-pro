<?php
/**
 * Performance Related Functions
 *
 * @package Blossom_Shop_Pro
 */

if( ! function_exists( 'blossom_shop_pro_image_lazy_load_attr' ) ) :
/**
 * Add data-layzr attribute to featured image ( for lazy load )
 *
 * @param array $attr
 * @param WP_Post $attachment
 * @param string|array $size
 *
 * @return array
 */
function blossom_shop_pro_image_lazy_load_attr( $attr, $attachment, $size ) {
	$ed_lazyload = get_theme_mod( 'ed_lazy_load', false );
	$ed_one_page = get_theme_mod( 'ed_one_page', false );
    
    if( ( $ed_one_page && is_front_page() && ! is_home() ) || is_admin() || is_feed() || ( function_exists ( 'is_cart' ) && is_cart() ) ) return $attr;
	
    $custom_logo_id = get_theme_mod( 'custom_logo' );
        
    if( $ed_lazyload ){
		if( $custom_logo_id != $attachment->ID ){
            $attr['data-layzr'] = $attr['src'];
    		$attr['src'] = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
    		if ( isset( $attr['srcset'] ) ) {
    			$attr['data-layzr-srcset'] = $attr['srcset'];
    			$attr['srcset'] = '';
    		}
        }
	}

	return $attr;
}
endif;

if( class_exists( 'Jetpack' ) ){
	if( ! Jetpack::is_module_active( 'lazy-images' ) ){
		add_filter( 'wp_get_attachment_image_attributes', 'blossom_shop_pro_image_lazy_load_attr', 10, 3 );
	}
}else{
	add_filter( 'wp_get_attachment_image_attributes', 'blossom_shop_pro_image_lazy_load_attr', 10, 3 );
}

if( ! function_exists( 'blossom_shop_pro_content_image_lazy_load_attr' ) ) :
/**
 * Add data-layzr attribute to post content images ( for lazy load )
 *
 * @param string $content
 * @return string
 */
function blossom_shop_pro_content_image_lazy_load_attr( $content ) {
	$ed_lazyload_content = get_theme_mod( 'ed_lazy_load_cimage', false );
	
    if ( $ed_lazyload_content && ! empty( $content ) ) {
		$content = preg_replace_callback(
			'/<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>/',
			'blossom_shop_pro_content_image_lazy_load_attr_callback',
			$content
		);
	}

	return $content;
}
endif;

if( class_exists( 'Jetpack' ) ){
	if( ! Jetpack::is_module_active( 'lazy-images' ) ){
		add_filter( 'the_content', 'blossom_shop_pro_content_image_lazy_load_attr' );
	}
}else{
	add_filter( 'the_content', 'blossom_shop_pro_content_image_lazy_load_attr' );
}

if( ! function_exists( 'blossom_shop_pro_content_image_lazy_load_attr_callback' ) ) :
/**
 * Callback to move src to data-src and replace it with a 1x1 tranparent image.
 *
 * @param $matches
 * @return string
 */
function blossom_shop_pro_content_image_lazy_load_attr_callback( $matches ) {
	$transparent_img = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
	if ( preg_match( '/ data-lazy *= *"false" */', $matches[0] ) ) {
		return '<img' . $matches[1] . 'src="' . $matches[2] . '"' . $matches[3] . '>';
	} else {
		return '<img' . $matches[1] . 'src="' . $transparent_img . '" data-layzr="' . $matches[2] . '"' . str_replace( 'srcset=', 'data-layzr-srcset=', $matches[3]). '>';
	}
}
endif;

if ( ! function_exists( 'blossom_shop_pro_js_async_attr' ) ) :
/**
 * Add "defer" tag
*/
function blossom_shop_pro_js_async_attr( $tag ){
	
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	if( is_admin() ) return $tag;
    
	$async_files = apply_filters( 'blossom_shop_pro_js_async_files', array( 
        get_template_directory_uri() . '/js' . $build .'/ajax' . $suffix . '.js',
		get_template_directory_uri() . '/js' . $build .'/custom' . $suffix . '.js',		
        get_template_directory_uri() . '/js' . $build .'/layzr' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build .'/owl.carousel' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build .'/owlcarousel2-a11ylayer' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build .'/all' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build .'/v4-shims' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build . '/jquery.fancybox' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build . '/jquery.nav' . $suffix . '.js',
        get_template_directory_uri() . '/js' . $build . '/jquery.countdown' . $suffix . '.js',
	    get_template_directory_uri() . '/js' . $build . '/jquery.mCustomScrollbar' . $suffix . '.js',
	    get_template_directory_uri() . '/js' . $build . '/slick' . $suffix . '.js',
        get_site_url() . '/wp-content/js/jquery/jquery-migrate.min.js',
        get_site_url() . '/wp-includes/js/imagesloaded.min.js',
        get_site_url() . '/wp-includes/js/masonry.min.js',
        get_site_url() . '/wp-includes/js/wp-embed.min.js'   	
	) );

	if( is_cf7_activated() ){
		array_push( $async_files, 
		 	get_site_url() . '/wp-content/plugins/contact-form-7/includes/js/scripts.js'
		);
	}

	if( is_woocommerce_activated() ){
		array_push( $async_files,
        	get_site_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js',        	
        	get_site_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js',
        	get_site_url() . '/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js',
        	get_site_url() . '/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js'
        ) ;
	}
	
	$add_async = false;
	foreach( $async_files as $file ){
		if( strpos( $tag, $file ) !== false ){
			$add_async = true;
			break;
		}
	}

	if( $add_async && get_theme_mod( 'ed_defer', false ) ) $tag = str_replace( ' src', ' defer="defer" src', $tag );

	return $tag;
}
endif;
add_filter( 'script_loader_tag', 'blossom_shop_pro_js_async_attr', 10 );

if( ! function_exists( 'blossom_shop_pro_gravatar' ) ) :
/**
 * returns the gravatar for author.
*/
function blossom_shop_pro_gravatar( $id, $image_size ){
    $ed_lazyload_gravatar = get_theme_mod( 'ed_lazyload_gravatar', false );
    if( $ed_lazyload_gravatar ){
        $avatar_url = get_avatar_url( $id, array( 'size' => $image_size ) );
        if( $avatar_url ){ ?>
            <img class="avatar" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-layzr="<?php echo esc_url( $avatar_url ); ?>" alt="" />
            <?php
        }
    }else{
        echo get_avatar( $id, $image_size );        
    }    
} 
endif;

if ( ! function_exists( 'blossom_shop_pro_remove_script_version' ) ) :
/**
 * Remove Script/Style version parameter
*/
function blossom_shop_pro_remove_script_version( $src ){
	
	if ( is_admin() )
		return $src;
    
    if( get_theme_mod( 'ed_ver', false ) ){
        $parts = explode( '?ver', $src );
        return $parts[0];
    }else{
        return $src;
    }	
}
endif;
add_filter( 'script_loader_src', 'blossom_shop_pro_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'blossom_shop_pro_remove_script_version', 15, 1 );

if( ! function_exists( 'blossom_shop_pro_homepage_featured_image' ) ) :
/**
 * returns the featured images for homepage sections
*/
function blossom_shop_pro_homepage_featured_image( $indicator ){
	$ed_lazyload = get_theme_mod( 'ed_lazy_load', false );
	$featured_image = get_theme_mod( $indicator );

    if( $ed_lazyload ){ ?>
        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-layzr="<?php echo esc_url( $featured_image ); ?>" alt="<?php esc_attr_e( 'featured-image', 'blossom-shop-pro' ); ?>" itemprop="image"/>
        <?php
    }else{
        echo '<img src="' . esc_url( $featured_image ) .'" alt="' . esc_attr__( 'featured-image', 'blossom-shop-pro' ) . '" itemprop="image"/>';        
    }    
} 
endif;