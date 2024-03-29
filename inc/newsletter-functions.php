<?php

if( ! function_exists( 'blossom_shop_pro_newsletter_bg_image_size' ) ) :
    function blossom_shop_pro_newsletter_bg_image_size(){
        return 'full';
    }
endif;
add_filter( 'bt_newsletter_img_size', 'blossom_shop_pro_newsletter_bg_image_size' );

if( ! function_exists( 'blossom_shop_pro_newsletter_bg_color' ) ) :
    function blossom_shop_pro_newsletter_bg_color(){
        return '#dde9ed';
    }
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'blossom_shop_pro_newsletter_bg_color' );

if( ! function_exists( 'blossom_shop_pro_add_inner_div' ) ) :
    function blossom_shop_pro_add_inner_div(){
        return true;
    }
endif;
add_filter( 'bt_newsletter_shortcode_inner_wrap_display', 'blossom_shop_pro_add_inner_div' );

if( ! function_exists( 'blossom_shop_pro_start_inner_div' ) ) :
    function blossom_shop_pro_start_inner_div(){
        echo '<div class="newsletter-inner-wrapper">';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_start', 'blossom_shop_pro_start_inner_div' );

if( ! function_exists( 'blossom_shop_pro_end_inner_div' ) ) :
    function blossom_shop_pro_end_inner_div(){
        echo '</div>';
    }
endif;
add_action( 'bt_newsletter_shortcode_inner_wrap_close', 'blossom_shop_pro_end_inner_div' );