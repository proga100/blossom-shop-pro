<?php
/**
 * Blossom Shop Pro Customizer Partials
 *
 * @package Blossom_Shop_Pro
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blossom_shop_pro_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blossom_shop_pro_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if( ! function_exists( 'blossom_shop_pro_get_slider_readmore' ) ) :
/**
 * Slider Readmore
*/
function blossom_shop_pro_get_slider_readmore(){
    return esc_html( get_theme_mod( 'slider_readmore', __( 'Continue Reading', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_banner_title' ) ) :
/**
 * Banner Title
*/
function blossom_shop_pro_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_banner_subtitle' ) ) :
/**
 * Banner SubTitle
*/
function blossom_shop_pro_get_banner_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_banner_label' ) ) :
/**
 * Banner Label
*/
function blossom_shop_pro_get_banner_label(){
    return esc_html( get_theme_mod( 'banner_label', __( 'Purchase', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_read_more' ) ) :
/**
 * Display blog readmore button
*/
function blossom_shop_pro_get_read_more(){
    return esc_html( get_theme_mod( 'read_more_text', __( 'Continue Reading', 'blossom-shop-pro' ) ) );    
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_related_title' ) ) :
/**
 * Display blog readmore button
*/
function blossom_shop_pro_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'Recommended Articles', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_notification_text' ) ) :
/**
 * Display header sticky text
*/
function blossom_shop_pro_get_notification_text(){
    return esc_html( get_theme_mod( 'notification_text', __( 'End of Season SALE now on thru 1/21.','blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_notification_label' ) ) :
/**
 * Display header sticky button
*/
function blossom_shop_pro_get_notification_label(){
    return esc_html( get_theme_mod( 'notification_label', __( 'SHOP NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_share_title' ) ) :
/**
 * Display share title
*/
function blossom_shop_pro_get_share_title(){
    return esc_html( get_theme_mod( 'share_title', __( 'Share', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_phone_label' ) ) :
/**
 * Display Phone Number
*/
function blossom_shop_pro_get_phone_label(){
    return esc_html( get_theme_mod( 'phone_label', __( 'Phone Number', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_email_label' ) ) :
/**
 * Display Email
*/
function blossom_shop_pro_get_email_label(){
    return esc_html( get_theme_mod( 'email_label', __( 'Email', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_opening_hours_label' ) ) :
/**
 * Display Opening Hours
*/
function blossom_shop_pro_get_opening_hours_label(){
    return esc_html( get_theme_mod( 'opening_hours_label', __( 'Opening Hours', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_whats_app_label' ) ) :
/**
 * Display Whats App
*/
function blossom_shop_pro_get_whats_app_label(){
    return esc_html( get_theme_mod( 'whats_app_label', __( 'WHATSAPP', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_about_testi_title' ) ) :
/**
 * Display About Testimonial Title
*/
function blossom_shop_pro_get_about_testi_title(){
    return esc_html( get_theme_mod( 'about_testi_title', __( 'Our Happy Customers', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_about_testi_subtitle' ) ) :
/**
 * Display About Testimonial SubTitle
*/
function blossom_shop_pro_get_about_testi_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'about_testi_subtitle', __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_recent_product_title' ) ) :
/**
 * Display Recent Product Title
*/
function blossom_shop_pro_get_recent_product_title(){
    return esc_html( get_theme_mod( 'recent_product_title', __( 'New Arrivals', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_recent_product_subtitle' ) ) :
/**
 * Display Recent Product SubTitle
*/
function blossom_shop_pro_get_recent_product_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'recent_product_subtitle', __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_recent_product_featured_title' ) ) :
/**
 * Display Recent Product Featured Title
*/
function blossom_shop_pro_get_recent_product_featured_title(){
    return esc_html( get_theme_mod( 'recent_product_featured_title', __( 'The Biggest Street Style Trends', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_recent_product_featured_subtitle' ) ) :
/**
 * Display Recent Product Featured SubTitle
*/
function blossom_shop_pro_get_recent_product_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'recent_product_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_recent_product_featured_label' ) ) :
/**
 * Display Recent Product Featured Label
*/
function blossom_shop_pro_get_recent_product_featured_label(){
    return esc_html( get_theme_mod( 'recent_product_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_title' ) ) :
/**
 * Display Popular Product Title
*/
function blossom_shop_pro_get_popular_product_title(){
    return esc_html( get_theme_mod( 'popular_product_title', __( 'Popular Products', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_subtitle' ) ) :
/**
 * Display Popular Product SubTitle
*/
function blossom_shop_pro_get_popular_product_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'popular_product_subtitle', __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_featured_title' ) ) :
/**
 * Display Popular Product Featured Title
*/
function blossom_shop_pro_get_popular_product_featured_title(){
    return esc_html( get_theme_mod( 'popular_product_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_featured_subtitle' ) ) :
/**
 * Display Popular Product Featured SubTitle
*/
function blossom_shop_pro_get_popular_product_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'popular_product_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_featured_label' ) ) :
/**
 * Display Popular Product Featured Label
*/
function blossom_shop_pro_get_popular_product_featured_label(){
    return esc_html( get_theme_mod( 'popular_product_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_popular_product_all' ) ) :
/**
 * Display Popular Product View All
*/
function blossom_shop_pro_get_popular_product_all(){
    return esc_html( get_theme_mod( 'popular_product_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_prod_deal_title' ) ) :
/**
 * Display Product Deal Title
*/
function blossom_shop_pro_get_prod_deal_title(){
    return esc_html( get_theme_mod( 'prod_deal_title', __( 'HOT DEAL THIS WEEK', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_prod_deal_subtitle' ) ) :
/**
 * Display Product Deal SubTitle
*/
function blossom_shop_pro_get_prod_deal_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'prod_deal_subtitle', __( 'FLAT 40% OFF EVERYTHING', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_prod_deal_button' ) ) :
/**
 * Display Product Deal SubTitle
*/
function blossom_shop_pro_get_prod_deal_button(){
    return esc_html( get_theme_mod( 'prod_deal_button', __( 'Buy Now', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_title' ) ) :
/**
 * Display Category One Title
*/
function blossom_shop_pro_get_cat_one_title(){
    return esc_html( get_theme_mod( 'cat_one_title', __( 'Best Sellers', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_subtitle' ) ) :
/**
 * Display Category One SubTitle
*/
function blossom_shop_pro_get_cat_one_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_one_subtitle', __( 'Check out our best sellers products.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_featured_title' ) ) :
/**
 * Display Category One Featured Title
*/
function blossom_shop_pro_get_cat_one_featured_title(){
    return esc_html( get_theme_mod( 'cat_one_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_featured_subtitle' ) ) :
/**
 * Display Category One Featured SubTitle
*/
function blossom_shop_pro_get_cat_one_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_one_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_featured_label' ) ) :
/**
 * Display Category One Featured Label
*/
function blossom_shop_pro_get_cat_one_featured_label(){
    return esc_html( get_theme_mod( 'cat_one_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_one_all' ) ) :
/**
 * Display Category One View All
*/
function blossom_shop_pro_get_cat_one_all(){
    return esc_html( get_theme_mod( 'cat_one_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_title' ) ) :
/**
 * Display Category Two Title
*/
function blossom_shop_pro_get_cat_two_title(){
    return esc_html( get_theme_mod( 'cat_two_title', __( 'Featured Products', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_subtitle' ) ) :
/**
 * Display Category Two SubTitle
*/
function blossom_shop_pro_get_cat_two_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_two_subtitle', __( 'Check out our exclusive trending products.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_featured_title' ) ) :
/**
 * Display Category Two Featured Title
*/
function blossom_shop_pro_get_cat_two_featured_title(){
    return esc_html( get_theme_mod( 'cat_two_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_featured_subtitle' ) ) :
/**
 * Display Category Two Featured SubTitle
*/
function blossom_shop_pro_get_cat_two_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_two_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_featured_label' ) ) :
/**
 * Display Category Two Featured Label
*/
function blossom_shop_pro_get_cat_two_featured_label(){
    return esc_html( get_theme_mod( 'cat_two_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_two_all' ) ) :
/**
 * Display Category Two View All
*/
function blossom_shop_pro_get_cat_two_all(){
    return esc_html( get_theme_mod( 'cat_two_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_title' ) ) :
/**
 * Display Category Three Title
*/
function blossom_shop_pro_get_cat_three_title(){
    return esc_html( get_theme_mod( 'cat_three_title', __( 'Products On Sales', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_subtitle' ) ) :
/**
 * Display Category Three SubTitle
*/
function blossom_shop_pro_get_cat_three_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_three_subtitle', __( 'Grab the limited time offers on these products.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_featured_title' ) ) :
/**
 * Display Category Three Featured Title
*/
function blossom_shop_pro_get_cat_three_featured_title(){
    return esc_html( get_theme_mod( 'cat_three_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_featured_subtitle' ) ) :
/**
 * Display Category Three Featured SubTitle
*/
function blossom_shop_pro_get_cat_three_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_three_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_featured_label' ) ) :
/**
 * Display Category Three Featured Label
*/
function blossom_shop_pro_get_cat_three_featured_label(){
    return esc_html( get_theme_mod( 'cat_three_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_three_all' ) ) :
/**
 * Display Category Three View All
*/
function blossom_shop_pro_get_cat_three_all(){
    return esc_html( get_theme_mod( 'cat_three_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_title' ) ) :
/**
 * Display Category Four Title
*/
function blossom_shop_pro_get_cat_four_title(){
    return esc_html( get_theme_mod( 'cat_four_title', __( 'Our Best Reviewed Products', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_subtitle' ) ) :
/**
 * Display Category Four SubTitle
*/
function blossom_shop_pro_get_cat_four_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_four_subtitle', __( 'Top selling products reviewed by our valuable customers.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_featured_title' ) ) :
/**
 * Display Category Four Featured Title
*/
function blossom_shop_pro_get_cat_four_featured_title(){
    return esc_html( get_theme_mod( 'cat_four_featured_title', __( 'STREET TRENDING 2019', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_featured_subtitle' ) ) :
/**
 * Display Category Four Featured SubTitle
*/
function blossom_shop_pro_get_cat_four_featured_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'cat_four_featured_subtitle', __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_featured_label' ) ) :
/**
 * Display Category Four Featured Label
*/
function blossom_shop_pro_get_cat_four_featured_label(){
    return esc_html( get_theme_mod( 'cat_four_featured_label', __( 'DISCOVER NOW', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_cat_four_all' ) ) :
/**
 * Display Category Four View All
*/
function blossom_shop_pro_get_cat_four_all(){
    return esc_html( get_theme_mod( 'cat_four_all', __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_testimonial_title' ) ) :
/**
 * Display Testimonial Title
*/
function blossom_shop_pro_get_testimonial_title(){
    return esc_html( get_theme_mod( 'testimonial_title', __( 'Our Happy Customers', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_testimonial_subtitle' ) ) :
/**
 * Display Testimonial SubTitle
*/
function blossom_shop_pro_get_testimonial_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'testimonial_subtitle', __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_blog_section_title' ) ) :
/**
 * Display Blog Title
*/
function blossom_shop_pro_get_blog_section_title(){
    return esc_html( get_theme_mod( 'blog_section_title', __( 'Our Blog', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_blog_section_subtitle' ) ) :
/**
 * Display Blog SubTitle
*/
function blossom_shop_pro_get_blog_section_subtitle(){
    return wp_kses_post( wpautop( get_theme_mod( 'blog_section_subtitle', __( 'Our recent articles about fashion ideas products.', 'blossom-shop-pro' ) ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_blog_readmore' ) ) :
/**
 * Display Blog Readmore
*/
function blossom_shop_pro_get_blog_readmore(){
    return esc_html( get_theme_mod( 'blog_readmore', __( 'READ MORE', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_blog_view_all' ) ) :
/**
 * Display Blog View All
*/
function blossom_shop_pro_get_blog_view_all(){
    return esc_html( get_theme_mod( 'blog_view_all', __( 'READ ALL POSTS', 'blossom-shop-pro' ) ) );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_footer_copyright' ) ) :
/**
 * Footer Copyright
*/
function blossom_shop_pro_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copyright">';
    if( $copyright ){
        echo wp_kses_post( blossom_shop_pro_apply_theme_shortcode( $copyright ) );
    }else{
        esc_html_e( '&copy; Copyright ', 'blossom-shop-pro' );
        echo date_i18n( esc_html__( 'Y', 'blossom-shop-pro' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
        esc_html_e( 'All Rights Reserved. ', 'blossom-shop-pro' );
    }
    echo '</span>'; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_ed_author_link' ) ) :
/**
 * Show/Hide Author link in footer
*/
function blossom_shop_pro_ed_author_link(){
    $ed_author_link = get_theme_mod( 'ed_author_link', false );
    if( ! $ed_author_link ) {
        echo '<span class="author-link">'; 
        esc_html_e( ' Blossom Shop Pro | Developed By ', 'blossom-shop-pro' );
        echo '<a href="' . esc_url( 'https://blossomthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( ' Blossom Themes', 'blossom-shop-pro' ) . '</a></span>';
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_ed_wp_link' ) ) :
/**
 * Show/Hide WordPress link in footer
*/
function blossom_shop_pro_ed_wp_link(){
    $ed_wp_link = get_theme_mod( 'ed_wp_link', false );
    if( ! $ed_wp_link ) printf( esc_html__( '%1$s Powered by %2$s%3$s', 'blossom-shop-pro' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'blossom-shop-pro' ) ) .'" target="_blank">WordPress</a>.', '</span>' );
}
endif;