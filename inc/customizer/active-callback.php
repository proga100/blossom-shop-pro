<?php
/**
 * Active Callback
 * 
 * @package Blossom_Shop_Pro
*/

/**
 * Active Callback for Banner Slider
*/
function blossom_shop_pro_banner_ac( $control ){
    $banner           = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type      = $control->manager->get_setting( 'slider_type' )->value();
    $slider_caption   = $control->manager->get_setting( 'slider_caption' )->value();
    $slider_animation = $control->manager->get_setting( 'slider_animation' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' || $banner == 'static_product' ) ) return true;
    if ( $control_id == 'header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' || $banner == 'static_product' ) ) return true;
    if ( $control_id == 'external_header_video' && ( $banner == 'static_banner' || $banner == 'static_nl_banner' || $banner == 'static_product' ) ) return true;
    if ( $control_id == 'banner_title' && ( $banner == 'static_banner' || $banner == 'static_product' ) ) return true;
    if ( $control_id == 'banner_subtitle' && ( $banner == 'static_banner' || $banner == 'static_product' ) ) return true;
    if ( $control_id == 'banner_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'banner_caption_layout' && $banner != 'no_banner' ) return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'include_repetitive_posts' && $banner == 'slider_banner' && ( $slider_type == 'latest_posts' || $slider_type == 'cat' ) ) return true;
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_speed' && $banner == 'slider_banner' && $slider_animation == '' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;                    
    if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'slider_cat_product' && $banner == 'slider_banner' && $slider_type == 'cat_products' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'slider_pages' && $banner == 'slider_banner' && $slider_type == 'pages' ) return true;
    if ( $control_id == 'slider_custom' && $banner == 'slider_banner' && $slider_type == 'custom' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_banner_text' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'hr' && $banner == 'slider_banner' ) return true;
    
    return false;
}

/**
 * Active Callback
*/
function blossom_shop_pro_header_ac( $control ){
    
    $ed_one_page = $control->manager->get_setting( 'ed_one_page' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'ed_home_link' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_service' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_recent' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_featured' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_popular' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_deal' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_cat_one' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_cat_tab' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_cat_two' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_about' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_cat_three' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_cat_four' && $ed_one_page == true ) return true; 
    if ( $control_id == 'label_testimonial' && $ed_one_page == true ) return true;
    if ( $control_id == 'label_cta' && $ed_one_page == true ) return true;   
    if ( $control_id == 'label_blog' && $ed_one_page == true ) return true;
    if ( $control_id == 'label_client' && $ed_one_page == true ) return true;   
    
    return false;
}

/**
 * Active Callback for Blog View All Button
*/
function blossom_shop_pro_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}

/**
 * Active Callback for Body Background
*/
function blossom_shop_pro_body_bg_choice( $control ){
    
    $body_bg    = $control->manager->get_setting( 'body_bg' )->value();
    $control_id = $control->id;
         
    if ( $control_id == 'background_image' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_preset' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_position' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_size' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_repeat' && $body_bg == 'image' ) return true;
    if ( $control_id == 'background_attachment' && $body_bg == 'image' ) return true;
    if ( $control_id == 'bg_pattern' && $body_bg == 'pattern' ) return true;
    
    return false;
}

/**
 * Active Callback for post/page
*/
function blossom_shop_pro_post_page_ac( $control ){
    
    $ed_related = $control->manager->get_setting( 'ed_related' )->value();
    $control_id = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related == true ) return true;
    if ( $control_id == 'related_taxonomy' && $ed_related == true ) return true;
    if ( $control_id == 'ed_featured_image' ) return true;
    
    return false;
}

/**
 * Active Callback for comment toggle.
*/
function blossom_shop_pro_comments_toggle( $control ){
    
    $comment_toggle = $control->manager->get_setting( 'ed_comments' )->value();
    
    if ( $comment_toggle == true ) return true;
    
    return false;
}


/**
 * Active Callback for pagination
*/
function blossom_shop_pro_loading_ac( $control ){
    
    $pagination_type = $control->manager->get_setting( 'pagination_type' )->value();
    
    if ( $pagination_type == 'load_more' ) return true;
    
    return false;
}

/**
 * Active Callback for Shop page description
*/
function blossom_shop_pro_shop_description_ac( $control ){
    $ed_shop_archive_desc = $control->manager->get_setting( 'ed_shop_archive_description' )->value();
    $control_id = $control->id;
    
    if( $control_id == 'shop_archive_description' && $ed_shop_archive_desc == true && is_woocommerce_activated() ) return true;
    
    return false;
}

/**
 * Active Callback for featuerd content
*/
function blossom_shop_pro_featured_ac( $control ){
    
    $featured_type   = $control->manager->get_setting( 'featured_type' )->value();
    $layout          = $control->manager->get_setting( 'featured_layout' )->value();
    $control_id      = $control->id;
    
    if ( $featured_type == 'feat_page' && ( 
        $control_id == 'featured_content_one' || 
        $control_id == 'featured_content_two' ||
        $control_id == 'featured_content_three'
    ) ) return true;

    if ( $featured_type == 'feat_page' && $layout != 'one' && $control_id == 'featured_content_four') return true;

    if ( $featured_type == 'feat_cat' && ( 
        $control_id == 'cat_featured_one' || 
        $control_id == 'cat_featured_two' ||
        $control_id == 'cat_featured_three'
    ) ) return true;

    if ( $featured_type == 'feat_cat' && $layout != 'one' && $control_id == 'cat_featured_four') return true;

    if ( $control_id == 'featured_custom' && $featured_type == 'feat_custom' ) return true;
    if ( $control_id == 'featured_button_title' &&  ( $featured_type == 'feat_page' || $featured_type == 'feat_custom' ) ) return true;
    
    return false;
}

/**
 * Active Callback for recent product content
*/
function blossom_shop_pro_recent_product_ac( $control ){
    
    $recent_product_type   = $control->manager->get_setting( 'recent_product_type' )->value();
    $layout          = $control->manager->get_setting( 'recent_product_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'rp_cat' && $recent_product_type == 'cat_products' ) return true;
    if ( $control_id == 'rp_custom' && $recent_product_type == 'single_products' ) return true;
    if ( $control_id == 'no_of_products' && ( $layout == 'one' || $layout == 'two' ) && ( $recent_product_type == 'latest_products' ) ) return true;
    if ( $control_id == 'recent_product_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'recent_product_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'recent_product_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'recent_product_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'recent_product_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for popular product content
*/
function blossom_shop_pro_popular_product_ac( $control ){
    
    $layout          = $control->manager->get_setting( 'popular_product_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'popular_product_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'popular_product_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'popular_product_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'popular_product_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'popular_product_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for category one content
*/
function blossom_shop_pro_cat_one_ac( $control ){
    
    $layout          = $control->manager->get_setting( 'cat_one_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'cat_one_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_one_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_one_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_one_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_one_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for category two content
*/
function blossom_shop_pro_cat_two_ac( $control ){
    
    $layout          = $control->manager->get_setting( 'cat_two_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'cat_two_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_two_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_two_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_two_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_two_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for category three content
*/
function blossom_shop_pro_cat_three_ac( $control ){
    
    $layout          = $control->manager->get_setting( 'cat_three_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'cat_three_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_three_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_three_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_three_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_three_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for category four content
*/
function blossom_shop_pro_cat_four_ac( $control ){
    
    $layout          = $control->manager->get_setting( 'cat_four_layout' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'cat_four_featured_image' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_four_featured_title' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_four_featured_subtitle' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_four_featured_url' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    if ( $control_id == 'cat_four_featured_label' && !( $layout == 'one' || $layout == 'two' ) ) return true;
    
    return false;
}

/**
 * Active Callback for wishlist cart
*/
function blossom_shop_pro_woo_plugins_activated(){
    
    if ( is_woocommerce_activated() && is_yith_whislist_activated() ) return true;    
    return false;
}

/**
 * Active Callback for recent product active
*/
function blossom_shop_pro_recent_product_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );

    if ( in_array( 'recent_product', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for featured active
*/
function blossom_shop_pro_featured_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'featured', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for product deal active
*/
function blossom_shop_pro_product_deal_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'product_deal', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for popular product active
*/
function blossom_shop_pro_popular_product_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'popular_product', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for category one active
*/
function blossom_shop_pro_cat_one_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'cat_one', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for category tab active
*/
function blossom_shop_pro_cat_tab_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'cat_tab', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for category two active
*/
function blossom_shop_pro_cat_two_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'cat_two', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for category three active
*/
function blossom_shop_pro_cat_three_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'cat_three', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for category four active
*/
function blossom_shop_pro_cat_four_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'cat_four', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for blog active
*/
function blossom_shop_pro_blog_active(){
    
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    if ( in_array( 'blog', $home_sections ) ) return true;    
    return false;
}

/**
 * Active Callback for Top Bar.
*/
function blossom_shop_pro_topbar( $control ){
    
    $ed_top_bar    = $control->manager->get_setting( 'ed_top_bar' )->value();
    $top_bar_type  = $control->manager->get_setting( 'top_bar_type' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'top_bar_type' && $ed_top_bar ) return true;
    if ( $control_id == 'notification_text' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'notification_label' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'notification_btn_url' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'ed_open_new_target' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'top_bar_background_color' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'topbar_font_color' && $ed_top_bar && $top_bar_type == 'top_button_link' ) return true;
    if ( $control_id == 'header_newsletter_shortcode' && $ed_top_bar && $top_bar_type == 'top_newsletter' ) return true;
    if ( $control_id == 'header_newsletter_note' && $ed_top_bar && $top_bar_type == 'top_newsletter' ) return true;

    return false;
}

function blossom_shop_pro_colors_callback( $control ){
    
    $child_theme_support    = $control->manager->get_setting( 'child_additional_support' )->value();
    $control_id             = $control->id;
    
    if ( $control_id == 'primary_color' && $child_theme_support == 'default' ) return true;
    if ( $control_id == 'secondary_color' && $child_theme_support == 'default' ) return true;
    if ( $control_id == 'primary_color_be' && $child_theme_support == 'ecommerce' ) return true;
    if ( $control_id == 'secondary_color_be' && $child_theme_support == 'ecommerce' ) return true;

    return false;
}

function blossom_shop_pro_fonts_callback( $control ){
    $child_theme_support    = $control->manager->get_setting( 'child_additional_support' )->value();
    $control_id             = $control->id;

    if ( $control_id == 'primary_font' && $child_theme_support == 'default' ) return true;
    if ( $control_id == 'secondary_font' && $child_theme_support == 'default' ) return true;

    if ( $control_id == 'primary_font_be' && $child_theme_support == 'ecommerce' ) return true;
    if ( $control_id == 'secondary_font_be' && $child_theme_support == 'ecommerce' ) return true;

    return false;
}