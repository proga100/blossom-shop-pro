<?php
/**
 * Blossom Shop Pro Woocommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Blossom_Shop_Pro
 */

/**
 * Woocommerce related hooks
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );

/**
 * Declare Woocommerce Support
*/
function blossom_shop_pro_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce' );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'blossom_shop_pro_woocommerce_support');

/**
 * Woocommerce Sidebar
*/
function blossom_shop_pro_wc_widgets_init(){
    register_sidebar( array(
      'name'          => esc_html__( 'Shop Sidebar', 'blossom-shop-pro' ),
      'id'            => 'shop-sidebar',
      'description'   => esc_html__( 'Sidebar displaying only in woocommerce pages.', 'blossom-shop-pro' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
  ) );    
}
add_action( 'widgets_init', 'blossom_shop_pro_wc_widgets_init' );

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function blossom_shop_pro_wc_wrapper(){    
    ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
        }
        add_action( 'woocommerce_before_main_content', 'blossom_shop_pro_wc_wrapper' );

/**
 * After Content
 * Closes the wrapping divs
*/
function blossom_shop_pro_wc_wrapper_end(){
    ?>
</main>
</div>
<?php
do_action( 'blossom_shop_pro_wo_sidebar' );
}
add_action( 'woocommerce_after_main_content', 'blossom_shop_pro_wc_wrapper_end' );

/**
 * Callback function for Shop sidebar
*/
function blossom_shop_pro_wc_sidebar_cb(){
    $sidebar = blossom_shop_pro_sidebar();
    if( $sidebar ){
        echo '<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">';
        dynamic_sidebar( 'shop-sidebar' );
        echo '</aside>'; 
    }
}
add_action( 'blossom_shop_pro_wo_sidebar', 'blossom_shop_pro_wc_sidebar_cb' );

/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title' , '__return_false' );

if( ! function_exists( 'blossom_shop_pro_wc_cart_count' ) ) :
/**
 * Woocommerce Cart Count
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header 
*/
function blossom_shop_pro_wc_cart_count(){
    $count = WC()->cart->get_cart_contents_count(); ?>
    <div class="cart-block">
        <div class="bsp-cart-block-wrap">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart" title="<?php esc_attr_e( 'View your shopping cart', 'blossom-shop-pro' ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="13.87" height="16" viewBox="0 0 13.87 16"><path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"/></svg>
                <span class="count"><?php echo absint( $count ); ?></span>
            </a>
            <span class="cart-amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
        </div>
        <div class="cart-block-popup"> 
            <?php the_widget( 'WC_Widget_Cart' ); ?>
        </div>
    </div>
    <?php
}
endif;

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header
 */
function blossom_shop_pro_add_to_cart_fragment( $fragments ){
    ob_start();
    $count = WC()->cart->get_cart_contents_count(); ?>
    <div class="bsp-cart-block-wrap">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart" title="<?php esc_attr_e( 'View your shopping cart', 'blossom-shop-pro' ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="13.87" height="16" viewBox="0 0 13.87 16"><path d="M15.8,5.219a.533.533,0,0,0-.533-.485H13.132V4.44A3.333,3.333,0,0,0,9.932,1a3.333,3.333,0,0,0-3.2,3.44v.293H4.6a.533.533,0,0,0-.533.485L3,16.419A.539.539,0,0,0,3.532,17h12.8a.539.539,0,0,0,.533-.581Zm-8-.779A2.267,2.267,0,0,1,9.932,2.067,2.267,2.267,0,0,1,12.065,4.44v.293H7.8ZM4.118,15.933,5.084,5.8H6.732v.683a1.067,1.067,0,1,0,1.067,0V5.8h4.267v.683a1.067,1.067,0,1,0,1.067,0V5.8H14.78l.965,10.133Z" transform="translate(-2.997 -1)"/></svg>
            <span class="count"><?php echo absint( $count ); ?></span>
        </a>
        <span class="cart-amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
    </div>
    <?php
    
    $fragments['.bsp-cart-block-wrap'] = ob_get_clean();
    
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'blossom_shop_pro_add_to_cart_fragment' );

/**
 * Ajax Callback for adding favorite count
 * 
*/
function blossom_shop_pro_add_favourite_ajax() {    

    $count = $_POST['count'] + 1; 
    echo absint( $count );
    
    die();
}
add_action( 'wp_ajax_blossom_shop_pro_add_favorite_count', 'blossom_shop_pro_add_favourite_ajax' );
add_action( 'wp_ajax_nopriv_blossom_shop_pro_add_favorite_count', 'blossom_shop_pro_add_favourite_ajax' );

/**
 * Ajax Callback for decrease favorite count 
 * 
*/
function blossom_shop_pro_remove_favourite_ajax() {    

    $count = $_POST['count'] - 1; 
    echo absint( $count );
    
    die();
}
add_action( 'wp_ajax_blossom_shop_pro_remove_favorite_count', 'blossom_shop_pro_remove_favourite_ajax' );
add_action( 'wp_ajax_nopriv_blossom_shop_pro_remove_favorite_count', 'blossom_shop_pro_remove_favourite_ajax' );

/**
 * Add Yith Wish list to Shop Page
 * 
*/
function blossom_shop_pro_add_whislist_shop() {    

    if ( is_yith_whislist_activated() ) {
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'blossom_shop_pro_add_whislist_shop', 12 );

if ( ! function_exists( 'blossom_shop_pro_product_search_form' ) ) :
    /**
     * Display Product search form with categories
     *
     * @return void
     */
    function blossom_shop_pro_product_search_form(){ ?>
        <div class="search-form-wrapper">
            <form role="search" method="get" class="form-inline woocommerce-product-search"
                  action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="form-group style-search">
                    <label class="screen-reader-text"
                           for="woocommerce-product-search-field"><?php esc_html_e( 'Search for:', 'blossom-shop-pro' ); ?></label>
                    <input type="search" id="woocommerce-product-search-field" class="search-field"
                           placeholder="<?php esc_attr_e( 'Search Products...', 'blossom-shop-pro' ); ?>"
                           value="<?php echo get_search_query(); ?>" name="s"/>
                    <?php

                    $product_cats = get_terms( array(
                        'taxonomy' => 'product_cat',
                    ) );

                    if ( !empty( $product_cats ) && !is_wp_error( $product_cats ) ) :
                        $selected_product_cat = get_query_var('product_cat');
                        ?>
                        <select name="product_cat" class="cat-dropdown">
                            <option value=""><?php echo '&mdash; ' . esc_html__( 'Select Category', 'blossom-shop-pro' ) . ' &mdash;'; ?></option>
                            <?php
                            foreach ( $product_cats as $product_cat ) { ?>
                                <option value="<?php echo esc_attr( $product_cat->slug ) ?>" <?php selected( $product_cat->slug, $selected_product_cat ) ?>><?php echo esc_html( $product_cat->name ); ?></option>
                            <?php } ?>
                        </select>
                    <?php endif; ?>
                    <button type="submit" value="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path></svg>
                    </button>
                    <input type="hidden" name="post_type" value="product"/>
                </div>
            </form>
        </div>
        <?php
    }
endif;

function blossom_shop_pro_get_out_of_stock_query(){ 
	$stock_query = array(
		'post_type' 		=> 'product',
		'posts_per_page'	=> -1,
		'fields' 			=> 'ids',
		'meta_query' 		=> array(
			array(
				'key' 		=> '_stock_status',
				'value' 	=> 'outofstock',
			)
		) );
    $out_of_stocks 	= new WP_Query( $stock_query );
    $exclude_ids 	= $out_of_stocks->posts;
    return $exclude_ids;
}