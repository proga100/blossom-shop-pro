<?php
/**
 * Typography Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_typography( $wp_customize ) {
    
    /** Typography */
    $wp_customize->add_panel(
        'typography_settings',
        array(
            'title'       => __( 'Typography', 'blossom-shop-pro' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 35,
            'description' => __( 'Body and Content\'s H1 to H6 Typography settings.', 'blossom-shop-pro' ),
        )
    );   
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_typography' );