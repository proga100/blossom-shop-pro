<?php
/**
 * Blossom Shop Pro Custom functions and definitions
 *
 * @package Blossom_Shop_Pro
 */

/**
 * Show/Hide Admin Bar in frontend.
*/
if( ! get_theme_mod( 'ed_adminbar', true ) ) add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'blossom_shop_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blossom_shop_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blossom Shop Pro, use a find and replace
	 * to change 'blossom-shop-pro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blossom-shop-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary', 'blossom-shop-pro' ),
        'secondary' => esc_html__( 'Secondary', 'blossom-shop-pro' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    // Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blossom_shop_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 
        'custom-logo', 
        apply_filters( 
            'blossom_shop_pro_custom_logo_args', 
            array( 
                'height'      => 70,
                'width'       => 70,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => array( 'site-title', 'site-description' ) 
            )
        ) 
    );
    
    /**
     * Add support for custom header.
    */
    add_theme_support( 
        'custom-header', 
        apply_filters( 
            'blossom_shop_pro_custom_header_args', 
            array(
        		'default-image' => '',
                'video'         => true,
        		'width'         => 1920,
        		'height'        => 806,
        		'header-text'   => false
            ) 
        ) 
    );

    // Register default headers.
    register_default_headers( array(
        'default-banner' => array(
            'url'           => '%s/images/banner-img.jpg',
            'thumbnail_url' => '%s/images/banner-img.jpg',
            'description'   => esc_html_x( 'Default Banner', 'header image description', 'blossom-shop-pro' ),
        ),
    ) );
 
    /**
     * Add Custom Images sizes.
    */    
    add_image_size( 'blossom-shop-schema', 600, 60, true );
    add_image_size( 'blossom-shop-blog', 829, 623, true );
    add_image_size( 'blossom-shop-blog-full', 1220, 623, true );
    add_image_size( 'blossom-shop-blog-list', 398, 297, true );
    add_image_size( 'blossom-shop-slider', 1751, 726, true );
    add_image_size( 'blossom-shop-slider-two', 640, 900, true );
    add_image_size( 'blossom-shop-slider-three', 1220, 650, true );
    add_image_size( 'blossom-shop-slider-four', 442, 700, true );
    add_image_size( 'blossom-shop-featured', 860, 860, true );
    add_image_size( 'blossom-shop-featured-one', 860, 415, true );
    add_image_size( 'blossom-shop-featured-two', 423, 617, true );
    add_image_size( 'blossom-shop-featured-three', 865, 1030, true );
    add_image_size( 'blossom-shop-recent', 540, 810, true );
    add_image_size( 'blossom-shop-recent-two', 420, 472, true );

    
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 
            'home', 
            'blog',
            'about' => array(
                'template' => 'templates/about.php',
            ),
            'contact' => array(
                'template' => 'templates/contact.php',
            ), 
        ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'blossom-shop-pro' ),
				'items' => array(
					'page_home',
					'page_blog',
                    'page_about',
                    'page_contact',
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'blossom_shop_pro_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
    // Add theme support for Responsive Videos.
    add_theme_support( 'jetpack-responsive-videos' );

    // Add excerpt support for pages
    add_post_type_support( 'page', 'excerpt' );

    // Remove widget block.
    remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'blossom_shop_pro_setup' );

if( ! function_exists( 'blossom_shop_pro_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blossom_shop_pro_content_width() {
	
    $GLOBALS['content_width'] = apply_filters( 'blossom_shop_pro_content_width', 830 );
}
endif;
add_action( 'after_setup_theme', 'blossom_shop_pro_content_width', 0 );

if( ! function_exists( 'blossom_shop_pro_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function blossom_shop_pro_template_redirect_content_width(){
	$sidebar = blossom_shop_pro_sidebar();
    if( $sidebar ){	   
        $GLOBALS['content_width'] = 830;      
	}else{
        if( is_singular() ){
            if( blossom_shop_pro_sidebar( true ) === 'full-width centered' ){
                $GLOBALS['content_width'] = 830;
            }else{
                $GLOBALS['content_width'] = 1220;                
            }                
        }else{
            $GLOBALS['content_width'] = 1220;
        }
	}
}
endif;
add_action( 'template_redirect', 'blossom_shop_pro_template_redirect_content_width' );

if( ! function_exists( 'blossom_shop_pro_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function blossom_shop_pro_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    $ed_googlefont_local = get_theme_mod( 'ed_googlefont_local', false );
        
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.3.4' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), '3.5.2' );
    wp_enqueue_style( 'jquery-mCustomScrollbar', get_template_directory_uri(). '/css' . $build . '/jquery.mCustomScrollbar' . $suffix . '.css', array(), '3.1.5' );
    if( ! $ed_googlefont_local ) { 
        wp_enqueue_style( 'blossom-shop-pro-google-fonts', blossom_shop_pro_fonts_url(), array(), null );
    }
    wp_enqueue_style( 'blossom-shop-pro-megamenu', get_template_directory_uri(). '/css' . $build . '/megamenu' . $suffix . '.css', array(), BLOSSOM_SHOP_PRO_THEME_VERSION );
    wp_enqueue_style( 'blossom-shop-pro', get_stylesheet_uri(), array(), BLOSSOM_SHOP_PRO_THEME_VERSION );
    
    if( get_theme_mod( 'ed_lazy_load', false ) || get_theme_mod( 'ed_lazy_load_cimage', false ) || get_theme_mod( 'ed_lazyload_gravatar', false ) ) {
        wp_enqueue_script( 'layzr', get_template_directory_uri() . '/js' . $build . '/layzr' . $suffix . '.js', array('jquery'), '2.0.4', true );
    }
    
    //Fancy Box
    if( get_theme_mod( 'ed_lightbox', false ) ){
        wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/css' . $build . '/jquery.fancybox' . $suffix . '.css', array(), '3.5.6' );
        wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js' . $build . '/jquery.fancybox' . $suffix . '.js', array('jquery'), '3.5.6', true );
    }
    
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery', 'all' ), '5.6.3', true );
	if( get_theme_mod( 'ed_one_page', false ) ) {
        wp_enqueue_script( 'jquery-nav', get_template_directory_uri() . '/js' . $build . '/jquery.nav' . $suffix . '.js', array( 'jquery' ), '3.0.0', true );
    }
    wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/js' . $build . '/jquery.countdown' . $suffix . '.js', array( 'jquery' ), '2.2.0', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array( 'jquery', 'owl-carousel' ), '0.2.1', true );
    wp_enqueue_script( 'jquery-mCustomScrollbar', get_template_directory_uri() . '/js' . $build . '/jquery.mCustomScrollbar' . $suffix . '.js', array( 'jquery' ), '3.1.5', true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js' . $build . '/slick' . $suffix . '.js', array( 'jquery' ), '1.6.0', true );
	wp_enqueue_script( 'blossom-shop-pro', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), BLOSSOM_SHOP_PRO_THEME_VERSION, true );
    
    $countdown_value        = get_theme_mod( 'countdown_timer', '2021-08-20' );
    $countdown_timer        = new DateTime( $countdown_value );
    $today                  = new DateTime( date('Y-m-d') );
    $countdown              = '';
    $home_sections          = blossom_shop_pro_get_home_sections();

    if( in_array( 'product_deal', $home_sections ) ){
        if( $countdown_timer > $today ){
            $countdown = $countdown_value;
        }
    }

    $array = array( 
        'rtl'           => is_rtl(),
        'auto'          => get_theme_mod( 'slider_auto', true ),
		'loop'          => get_theme_mod( 'slider_loop', true ),
        'speed'         => get_theme_mod( 'slider_speed', 3000 ),
        'animation'     => get_theme_mod( 'slider_animation' ),
        'lightbox'      => get_theme_mod( 'ed_lightbox', false ),
        'one_page'      => get_theme_mod( 'ed_one_page', false ),
        'drop_cap'      => get_theme_mod( 'ed_drop_cap', false ),
        'sticky'        => get_theme_mod( 'ed_sticky_header', false ),
        'sticky_widget' => get_theme_mod( 'ed_last_widget_sticky', false ),
        'countdown'     => $countdown,
        'recent_product'=> get_theme_mod( 'recent_product_layout', 'one' ),
        'home_url'      => home_url(),
        'theme_nonce'   => wp_create_nonce( 'blossom_shop_pro_theme_nonce' ),
    );
    
    wp_localize_script( 'blossom-shop-pro', 'blossom_shop_pro_data', $array );
    
    /** Ajax Pagination */
    $pagination = get_theme_mod( 'pagination_type', 'numbered' );
    $loadmore   = get_theme_mod( 'load_more_label', __( 'Load More Posts', 'blossom-shop-pro' ) );
    $loading    = get_theme_mod( 'loading_label', __( 'Loading...', 'blossom-shop-pro' ) );
    $nomore     = get_theme_mod( 'no_more_label', __( 'No More Post', 'blossom-shop-pro' ) );
       
    // Add parameters for the JS
    global $wp_query;
    $max = $wp_query->max_num_pages;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    
    wp_enqueue_script( 'blossom-shop-pro-ajax', get_template_directory_uri() . '/js' . $build . '/ajax' . $suffix . '.js', array('jquery'), BLOSSOM_SHOP_PRO_THEME_VERSION, true );
    
    wp_localize_script( 
        'blossom-shop-pro-ajax', 
        'blossom_shop_pro_ajax',
        array(
            'url'        => admin_url( 'admin-ajax.php' ),
            'startPage'  => $paged,
            'maxPages'   => $max,
            'nextLink'   => next_posts( $max, false ),
            'autoLoad'   => $pagination,
            'loadmore'   => $loadmore,
            'loading'    => $loading,
            'nomore'     => $nomore,
            'plugin_url' => plugins_url(),
            'rtl'           => is_rtl(),                
         )
    );
    
    if ( is_jetpack_activated( true ) ) {
        wp_enqueue_style( 'tiled-gallery', plugins_url() . '/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.css' );            
    }
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'blossom_shop_pro_scripts' );

if( ! function_exists( 'blossom_shop_pro_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function blossom_shop_pro_admin_scripts( $hook ){    
    if( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'user-new.php' || $hook == 'user-edit.php' || $hook == 'profile.php' ){
        wp_enqueue_script( 'blossom-shop-pro-admin', get_template_directory_uri() . '/inc/js/admin.js', array( 'jquery', 'jquery-ui-sortable' ), BLOSSOM_SHOP_PRO_THEME_VERSION, false );
    }
    
    wp_enqueue_style( 'blossom-shop-pro-admin', get_template_directory_uri() . '/inc/css/admin.css', '', BLOSSOM_SHOP_PRO_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'blossom_shop_pro_admin_scripts' );

if( ! function_exists( 'blossom_shop_pro_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blossom_shop_pro_body_classes( $classes ) {
    $bg_pattern    = get_theme_mod( 'bg_pattern', 'nobg' );
    $bg            = get_theme_mod( 'body_bg', 'image' );
    $widget_sticky = get_theme_mod( 'ed_last_widget_sticky', false );
    $child_theme   = get_theme_mod( 'child_additional_support', 'default' );
    
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if( $bg == 'pattern' && $bg_pattern != 'nobg' ){
		$classes[] = 'custom-background-image custom-background';
	}
    
    if( $bg == 'image' && get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    if( $widget_sticky ) {
        $classes[] = 'widget-sticky';
    }
    
    $classes[] = blossom_shop_pro_sidebar( true );

    if( is_home() || is_search() || is_archive() ){
        $classes[] = get_theme_mod( 'blog_page_layout', 'classic-layout' );
    }

    if( is_woocommerce_activated() && is_product() ){
        $classes[] = get_theme_mod( 'single_product_layout', 'bsp-style-one' );
    }

    if( 'default' != $child_theme ){
        $classes[] = $child_theme;
    }
    
	return $classes;
}
endif;
add_filter( 'body_class', 'blossom_shop_pro_body_classes' );

if( ! function_exists( 'blossom_shop_pro_post_classes' ) ) :
/**
 * Add custom classes to the array of post classes.
*/
function blossom_shop_pro_post_classes( $classes ){
    
    $ed_social_float = get_theme_mod( 'ed_social_float', false );

    if( is_single() && $ed_social_float ){
        $classes[] = 'sticky-meta';
    }
    
    $classes[] = 'latest_post';
    
    return $classes;
}
endif;
add_filter( 'post_class', 'blossom_shop_pro_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blossom_shop_pro_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blossom_shop_pro_pingback_header' );

if( ! function_exists( 'blossom_shop_pro_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_shop_pro_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'blossom-shop-pro' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'blossom-shop-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'blossom-shop-pro' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'blossom-shop-pro' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'blossom-shop-pro' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'blossom-shop-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'blossom_shop_pro_change_comment_form_default_fields' );

if( ! function_exists( 'blossom_shop_pro_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function blossom_shop_pro_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'blossom-shop-pro' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'blossom-shop-pro' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'blossom_shop_pro_change_comment_form_defaults' );

if ( ! function_exists( 'blossom_shop_pro_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function blossom_shop_pro_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'blossom_shop_pro_excerpt_more' );

if ( ! function_exists( 'blossom_shop_pro_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function blossom_shop_pro_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'excerpt_length', 55 );
    return is_admin() ? $length : absint( $excerpt_length );    
}
endif;
add_filter( 'excerpt_length', 'blossom_shop_pro_excerpt_length', 999 );

if( ! function_exists( 'blossom_shop_pro_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function blossom_shop_pro_exclude_cat( $query ){

    $ed_banner      = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $slider_type    = get_theme_mod( 'slider_type', 'latest_posts' );
    $slider_cat     = get_theme_mod( 'slider_cat' );
    $posts_per_page = get_theme_mod( 'no_of_slides', 5 );
    $repetitive_posts = get_theme_mod( 'include_repetitive_posts', false );
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
        if( $ed_banner == 'slider_banner' && !$repetitive_posts ){
            if( $slider_type === 'cat' && $slider_cat  ){            
                $query->set( 'category__not_in', array( $slider_cat ) );            
            }elseif( $slider_type == 'latest_posts' ){
                $args = array(
                    'post_type'           => 'post',
                    'post_status'         => 'publish',
                    'posts_per_page'      => $posts_per_page,
                    'ignore_sticky_posts' => true
                );
                $latest = get_posts( $args );
                $excludes = array();
                foreach( $latest as $l ){
                    array_push( $excludes, $l->ID );
                }
                $query->set( 'post__not_in', $excludes );
            }
        }  
    }
}
endif;
add_filter( 'pre_get_posts', 'blossom_shop_pro_exclude_cat' );

if( ! function_exists( 'blossom_shop_pro_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function blossom_shop_pro_get_the_archive_title( $title ){
    
    $ed_prefix = get_theme_mod( 'ed_prefix_archive', true );
    if( is_post_type_archive( 'product' ) ){
        $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
    }else{
        if( is_category() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Category Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">' . esc_html( single_cat_title( '', false ) ) . '</h1>';
            }
        }
        elseif( is_tag() ){
            if( $ed_prefix ) {
                $title = '<h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Tags Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">' . esc_html( single_tag_title( '', false ) ) . '</h1>';
            }
        }elseif( is_year() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-shop-pro' ) ) . '</h1>';                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Year Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'blossom-shop-pro' ) ) . '</h1>';
            }
        }elseif( is_month() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-shop-pro' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Month Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'blossom-shop-pro' ) ) . '</h1>';
            }
        }elseif( is_day() ){
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-shop-pro' ) ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Day Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'blossom-shop-pro' ) ) .  '</h1>';
            }
        }elseif( is_post_type_archive() ) {
            if( $ed_prefix ){
                $title = '<h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';                            
            }else{
                $title = '<span class="sub-title">'. esc_html__( 'Archives','blossom-shop-pro' ) . '</span><h1 class="page-title">'  . post_type_archive_title( '', false ) . '</h1>';
            }
        }elseif( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            if( $ed_prefix ){
                $title = '<h1 class="page-title">' . single_term_title( '', false ) . '</h1>';                                   
            }else{
                $title = '<span class="sub-title">' . $tax->labels->singular_name . '</span><h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
            }
        }
    }    
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'blossom_shop_pro_get_the_archive_title' );

if( ! function_exists( 'blossom_shop_pro_remove_archive_description' ) ) :
/**
 * filter the_archive_description & get_the_archive_description to show post type archive
 * @param  string $description original description
 * @return string post type description if on post type archive
 */
function blossom_shop_pro_remove_archive_description( $description ){
    $ed_shop_archive_description = get_theme_mod( 'ed_shop_archive_description', false );
    $shop_archive_description    = get_theme_mod( 'shop_archive_description' );
    if( is_post_type_archive( 'product' ) ) {
        if( ! $ed_shop_archive_description ){
            $description = '';
        }else{
            if( $shop_archive_description ) $description = $shop_archive_description;
        }
    }
    return wpautop( wp_kses_post( $description ) );
}
endif;
add_filter( 'get_the_archive_description', 'blossom_shop_pro_remove_archive_description' );

if( ! function_exists( 'blossom_shop_pro_allowed_social_protocols' ) ) :
/**
 * List of allowed social protocols in HTML attributes.
 * @param  array $protocols Array of allowed protocols.
 * @return array
 */
function blossom_shop_pro_allowed_social_protocols( $protocols ) {
    $social_protocols = array(
        'skype'
    );
    return array_merge( $protocols, $social_protocols );    
}
endif;
add_filter( 'kses_allowed_protocols' , 'blossom_shop_pro_allowed_social_protocols' );

if( ! function_exists( 'blossom_shop_pro_migrate_free_option' ) ) :
/**
 * Function to migrate free theme option to pro theme
*/
function blossom_shop_pro_migrate_free_option(){    
    $fresh = get_option( '_blossom_shop_pro_fresh_install' ); //flag to check if it is first switch
    $pages = array(
        'about' => array( 
            'page_name'     => esc_html__( 'About', 'blossom-shop-pro' ),
            'page_template' => 'templates/about.php'
        ),
        'contact' => array( 
            'page_name'     => esc_html__( 'Contact', 'blossom-shop-pro' ),
            'page_template' => 'templates/contact.php'
        ),
    );
    
    if( ! $fresh ){        
        $options = get_option( 'theme_mods_blossom-shop' );
        
        if( $options ){
            //migrate free theme option to pro
            foreach( $options as $option => $value ){
                if( $option !== 'sidebars_widgets' ){
                    set_theme_mod( $option, $value );
                }    
            }
            //create default pages on theme migration
            foreach( $pages as $page => $val ){
                blossom_shop_pro_create_post( $val['page_name'], $page, $val['page_template'] );
            } 
        }        
        update_option( '_blossom_shop_pro_fresh_install', true );  
    }
}
endif;
add_action( 'after_switch_theme', 'blossom_shop_pro_migrate_free_option' );

if( ! function_exists( 'blossom_shop_pro_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function blossom_shop_pro_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'blossom-shop-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = blossom_shop_pro_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( blossom_shop_pro_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "http://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"  => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => blossom_shop_pro_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">';
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        } else {
            echo wp_json_encode( $args );
        }
        echo '</script>';
    }
}
endif;
add_action( 'wp_head', 'blossom_shop_pro_single_post_schema' );

if( ! function_exists( 'blossom_shop_pro_get_comment_author_link' ) ) :
/**
 * Filter to modify comment author link
 * @link https://developer.wordpress.org/reference/functions/get_comment_author_link/
 */
function blossom_shop_pro_get_comment_author_link( $return, $author, $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url )
        $return = '<span itemprop="name">'. esc_html( $author ) .'</span>';
    else
        $return = '<span itemprop="name"><a href=' . esc_url( $url ) . ' rel="external nofollow noopener" class="url" itemprop="url">' . esc_html( $author ) . '</a></span>';

    return $return;
}
endif;
add_filter( 'get_comment_author_link', 'blossom_shop_pro_get_comment_author_link', 10, 3 );

if( ! function_exists( 'blossom_shop_pro_post_states' ) ) :
/**
 * Display Post State for pages in WP Admin
*/
function blossom_shop_pro_post_states( $post_states, $post ){
    if( 'page' == get_post_type( $post->ID ) ){
        if( get_page_template_slug( $post->ID ) == 'templates/about.php' ) $post_states[]       = esc_html__( 'About Page', 'blossom-shop-pro' );
        if( get_page_template_slug( $post->ID ) == 'templates/contact.php' ) $post_states[]     = esc_html__( 'Contact Page', 'blossom-shop-pro' );
    }
    return $post_states; 
}
endif;
add_filter( 'display_post_states', 'blossom_shop_pro_post_states', 10, 2 );

if( ! function_exists( 'blossom_shop_pro_filter_post_gallery' ) ) :
/**
 * Filter the output of the gallery. 
*/ 
function blossom_shop_pro_filter_post_gallery( $output, $attr, $instance ){
    global $post, $wp_locale;

    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
    	'order'      => 'ASC',
    	'orderby'    => 'menu_order ID',
    	'id'         => $post ? $post->ID : 0,
    	'itemtag'    => $html5 ? 'figure'     : 'dl',
    	'icontag'    => $html5 ? 'div'        : 'dt',
    	'captiontag' => $html5 ? 'figcaption' : 'dd',
    	'columns'    => 3,
    	'size'       => 'thumbnail',
    	'include'    => '',
    	'exclude'    => '',
    	'link'       => ''
    ), $attr, 'gallery' );
    
    $id = intval( $atts['id'] );
    
    if ( ! empty( $atts['include'] ) ) {
    	$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    
    	$attachments = array();
    	foreach ( $_attachments as $key => $val ) {
    		$attachments[$val->ID] = $_attachments[$key];
    	}
    } elseif ( ! empty( $atts['exclude'] ) ) {
    	$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
    	$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }
    
    if ( empty( $attachments ) ) {
    	return '';
    }
    
    if ( is_feed() ) {
    	$output = "\n";
    	foreach ( $attachments as $att_id => $attachment ) {
    		$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
    	}
    	return $output;
    }
    
    $itemtag = tag_escape( $atts['itemtag'] );
    $captiontag = tag_escape( $atts['captiontag'] );
    $icontag = tag_escape( $atts['icontag'] );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) ) {
    	$itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[ $captiontag ] ) ) {
    	$captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[ $icontag ] ) ) {
    	$icontag = 'dt';
    }
    
    $columns = intval( $atts['columns'] );
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';
    
    $selector = "gallery-{$instance}";
    
    $gallery_style = '';
    
    /**
     * Filter whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
    	$gallery_style = "
    	<style type='text/css'>
    		#{$selector} {
    			margin: auto;
    		}
    		#{$selector} .gallery-item {
    			float: {$float};
    			margin-top: 10px;
    			text-align: center;
    			width: {$itemwidth}%;
    		}
    		#{$selector} img {
    			border: 2px solid #cfcfcf;
    		}
    		#{$selector} .gallery-caption {
    			margin-left: 0;
    		}
    		/* see gallery_shortcode() in wp-includes/media.php */
    	</style>\n\t\t";
    }
    
    $size_class = sanitize_html_class( $atts['size'] );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    
    /**
     * Filter the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );
    
    $i = 0; 
    foreach ( $attachments as $id => $attachment ) {
            
    	$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
    	if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
    		//$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr ); // for attachment url 
            $image_output = "<a href='" . wp_get_attachment_url( $id ) . "' data-fancybox='group{$columns}' data-caption='" . esc_attr( $attachment->post_excerpt ) . "'>";
            $image_output .= wp_get_attachment_image( $id, $atts['size'], false, $attr );
            $image_output .= "</a>";
    	} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
    		$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
    	} else {
    		$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr ); //for attachment page
    	}
    	$image_meta  = wp_get_attachment_metadata( $id );
    
    	$orientation = '';
    	if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
    		$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    	}
    	$output .= "<{$itemtag} class='gallery-item'>";
    	$output .= "
    		<{$icontag} class='gallery-icon {$orientation}'>
    			$image_output
    		</{$icontag}>";
    	if ( $captiontag && trim($attachment->post_excerpt) ) {
    		$output .= "
    			<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
    			" . wptexturize($attachment->post_excerpt) . "
    			</{$captiontag}>";
    	}
    	$output .= "</{$itemtag}>";
    	if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
    		$output .= '<br style="clear: both" />';
    	}
    }
    
    if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
    	$output .= "
    		<br style='clear: both' />";
    }
    
    $output .= "
    	</div>\n";
    
    return $output;
}
endif;

if( class_exists( 'Jetpack' ) ){
    if( !Jetpack::is_module_active( 'carousel' ) ){
        add_filter( 'post_gallery', 'blossom_shop_pro_filter_post_gallery', 10, 3 );
    }
}else{
    add_filter( 'post_gallery', 'blossom_shop_pro_filter_post_gallery', 10, 3 );
}

if( ! function_exists( 'blossom_shop_pro_activate_notice' ) ) :
/**
 * Theme activation notice.
*/
function blossom_shop_pro_activate_notice() {
    global $current_user;
    $theme_list       = wp_get_theme( 'blossom-shop-pro' );
    $add_license      = get_option( 'blossom-shop-pro_license_key' );
    $current_screen   = get_current_screen();    
    $activate_license = get_option( 'blossom-shop-pro_license_key_status' );
    $statuses         = array( 'invalid', 'inactive', 'expired', 'disabled', 'site_inactive' );   
    
    if( $theme_list->exists() && ( empty( $add_license ) || in_array( $activate_license, $statuses ) ) && $current_screen->base != 'appearance_page_blossom-shop-pro-license' ) { ?>
        <div class="notice notice-info is-dismissible">
            <p><?php esc_html_e( 'Activate Theme License ( Blossom Shop Pro ) to enjoy the full benefits of using the theme. We\'re sorry about this extra step but we built the activation to prevent mass piracy of our themes. This allows us to better serve our paying customers. An active theme comes with free updates, top notch support and guaranteed latest WordPress support.', 'blossom-shop-pro' ); ?>
            </p>
            <p>
                <span style="color:red;"><?php esc_html_e( 'Please Activate Theme License!', 'blossom-shop-pro' ); ?></span> - <a href="<?php echo esc_url( 'themes.php?page=blossom-shop-pro-license' ); ?>"><u><?php esc_html_e( 'Click here to enter your license key', 'blossom-shop-pro' ); ?></u></a> - <?php esc_html_e( 'if there is an error, please contact us at ', 'blossom-shop-pro' ); ?><a href="mailto:support@blossomthemes.com" target="_blank">support@blossomthemes.com</a> - <a href="<?php echo esc_url( 'https://blossomthemes.com/active-theme-license/' ); ?>" target="_blank"><u><?php esc_html_e( 'How to activate the theme license', 'blossom-shop-pro' ); ?></u></a>.
            </p> 
        </div>  
        <?php
    }
}
endif;
add_action( 'admin_notices', 'blossom_shop_pro_activate_notice' );

if( ! function_exists( 'blossom_shop_pro_redirect_on_activation' ) ) :
/**
 * Redirect to Getting Started page on theme activation
*/
function blossom_shop_pro_redirect_on_activation() {
    global $pagenow;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect( admin_url( "themes.php?page=blossom-shop-pro-license" ) );
    }
}
endif;
add_action( 'admin_init', 'blossom_shop_pro_redirect_on_activation' );

if ( ! function_exists( 'blossom_shop_pro_set_views' ) ) :
/**
 * Function to add the post view count 
 */
function blossom_shop_pro_set_views( $post_id ) {
    if ( in_the_loop() ) {
        $post_id = get_the_ID();
      } 
    else {
        global $wp_query;
        $post_id = $wp_query->get_queried_object_id();
    }
    
    if( is_singular( 'product' ) ){
        $count_key = '_blossom_shop_pro_view_count';
        $count = get_post_meta( $post_id, $count_key, true );
        if( $count == '' ){
            $count = 0;
            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '1' );
        }else{
            $count++;
            update_post_meta( $post_id, $count_key, $count );
        }
    }
}
endif;
add_action( 'wp','blossom_shop_pro_set_views' );

if ( ! function_exists( 'blossom_shop_pro_header_menu_desc' ) ) :
/**
 * Descriptions on Header Menu
 * @param string $item_output , HTML outputp for the menu item
 * @param object $item , menu item object
 * @param int $depth , depth in menu structure
 * @param object $args , arguments passed to wp_nav_menu()
 * @return string $item_output
 */
function blossom_shop_pro_header_menu_desc( $item_output, $item, $depth, $args ) {

    if ( 'primary' == $args->theme_location && $item->description ){
        $item_output = str_replace( '</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output );
    }

    return $item_output;
}
endif;
add_filter( 'walker_nav_menu_start_el', 'blossom_shop_pro_header_menu_desc', 10, 4 );

if( ! function_exists( 'blossom_shop_pro_google_analytics' ) ) :
/**
 * Place to add Google Analytics Code
 */
function blossom_shop_pro_google_analytics() {
    $google_ad_code = get_theme_mod( 'google_analytics_ad_code' );

    echo $google_ad_code;
}
endif;
add_action( 'wp_head' , 'blossom_shop_pro_google_analytics' );

if( ! function_exists( 'blossom_shop_pro_admin_review_notice' ) ) :
/**
 * Adding Review Feature to getting started page.
 */
function blossom_shop_pro_admin_review_notice() {

    $theme_args      = wp_get_theme();
    $meta            = get_option( 'blossom-shop-pro-review-notice' );
    $name            = $theme_args->get( 'Name' );
    $textdomain      = $theme_args->get( 'TextDomain' );
    $current_screen  = get_current_screen();
    $transients      = get_transient( 'blossom_shop_pro_transients_results' );

    if ( is_admin() && !$meta ) {
        
        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        } 

        if ( true == $transients ) {
            return;
        }

        ?>

        <div class="welcome-message notice notice-info is-dismissible review-message">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <div class="logo-holder">
                         <img src="<?php echo get_template_directory_uri() . '/images/admin-review.jpg'; ?>">
                    </div>
                   <div class="review-holder">
                       <div class="message-text">
                           <p><?php printf( __( ' We hope you are enjoying using our theme %1$s %2$s %3$s. Would you consider leaving us a review?', 'blossom-shop-pro' ), '<strong>', $name, '</strong>' ) ; ?></p>
                       </div>
                       <div class="button-holder">
                           <a href="<?php echo esc_url( 'https://blossomthemes.com/wordpress-themes/' . $textdomain . '/#edd-reviews' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e( 'Sure! I’d Love to!', 'blossom-shop-pro' ); ?></a>
                            <a href="?blossom-shop-pro-review-notice=1" class="button button-primary"><?php esc_html_e( 'I’ve already left a review', 'blossom-shop-pro' ); ?></a>
                            <a href="?blossom-shop-pro-review-transient=1" class="button button-primary"><?php esc_html_e( 'Maybe Later', 'blossom-shop-pro' ); ?></a>
                            <a href="?blossom-shop-pro-review-notice=1" class="button button-primary"><?php esc_html_e( 'Never show again', 'blossom-shop-pro' ); ?></a>
                       </div>
                   </div>
                    
                    
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'blossom_shop_pro_admin_review_notice' );

if( ! function_exists( 'blossom_shop_pro_ignore_admin_review_notice' ) ) :
/**
 * Adding review feature on getting started page.
 */
function blossom_shop_pro_ignore_admin_review_notice(){
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset( $_GET['blossom-shop-pro-review-notice'] ) && $_GET['blossom-shop-pro-review-notice'] = '1' ) {

        update_option( 'blossom-shop-pro-review-notice', true );
    }
}
endif;
add_action( 'admin_init', 'blossom_shop_pro_ignore_admin_review_notice' );

if( ! function_exists( 'blossom_shop_pro_admin_review_transients' ) ) :
/**
 * Adding transient for review feature on getting started page.
 */
function blossom_shop_pro_admin_review_transients(){
       
    if ( isset( $_GET['blossom-shop-pro-review-transient'] ) && $_GET['blossom-shop-pro-review-transient'] = '1' ) {

        if ( true != get_transient( 'blossom_shop_pro_transients_results' ) ) {

            set_transient( 'blossom_shop_pro_transients_results', true, MONTH_IN_SECONDS );
        }
    }
}
endif;
add_action( 'admin_init', 'blossom_shop_pro_admin_review_transients' );

if ( ! function_exists( 'blossom_shop_pro_get_fontawesome_ajax' ) ) :
/**
 * Return an array of all icons.
 */
function blossom_shop_pro_get_fontawesome_ajax() {
    // Bail if the nonce doesn't check out
    if ( ! isset( $_POST['blossom_shop_pro_customize_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['blossom_shop_pro_customize_nonce'] ), 'blossom_shop_pro_customize_nonce' ) ) {
        wp_die();
    }

    // Do another nonce check
    check_ajax_referer( 'blossom_shop_pro_customize_nonce', 'blossom_shop_pro_customize_nonce' );

    // Bail if user can't edit theme options
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_die();
    }

    // Get all of our fonts
    $fonts = blossom_shop_pro_get_fontawesome_list();
    
    ob_start();
    if( $fonts ){ ?>
        <ul class="font-group">
            <?php 
                foreach( $fonts as $font ){
                    echo '<li data-font="' . esc_attr( $font ) . '"><i class="' . esc_attr( $font ) . '"></i></li>';                        
                }
            ?>
        </ul>
        <?php
    }
    echo ob_get_clean();

    // Exit
    wp_die();
}
endif;
add_action( 'wp_ajax_blossom_shop_pro_get_fontawesome_ajax', 'blossom_shop_pro_get_fontawesome_ajax' );