<?php
/**
 * General Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general( $wp_customize ){
    
    /** General Settings */
    $wp_customize->add_panel( 
        'general_settings',
         array(
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'General Settings', 'blossom-shop-pro' ),
            'description' => __( 'Customize Header, Social, Sharing, SEO, Post/Page, Newsletter, Performance and Miscellaneous settings.', 'blossom-shop-pro' ),
        ) 
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general' );