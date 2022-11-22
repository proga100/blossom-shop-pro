<?php
/**
 * Front Page Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'blossom-shop-pro' ),
            'description' => __( 'Static Home Page settings.', 'blossom-shop-pro' ),
        ) 
    );    
      
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage' );