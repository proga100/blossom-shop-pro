<?php
/**
 * Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout( $wp_customize ) {
    
    /** Layout Settings */
    $wp_customize->add_panel( 
        'layout_settings',
         array(
            'priority'    => 30,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Layout Settings', 'blossom-shop-pro' ),
            'description' => __( 'Change different page layout from here.', 'blossom-shop-pro' ),
        ) 
    );
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout' );