<?php
/**
 * Color Setting
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_color( $wp_customize ) {
    
    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#dde9ed',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'blossom-shop-pro' ),
                'description' => __( 'Primary color of the theme.', 'blossom-shop-pro' ),
                'section'     => 'colors',
                'priority'    => 5,
                'active_callback' => 'blossom_shop_pro_colors_callback',
            )
        )
    );
    
    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#ee7f4b',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'blossom-shop-pro' ),
                'description' => __( 'Secondary color of the theme.', 'blossom-shop-pro' ),
                'section'     => 'colors',
                'priority'    => 5,
                'active_callback' => 'blossom_shop_pro_colors_callback',
            )
        )
    );

    // Blossom Ecommerce
    /** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color_be', 
        array(
            'default'           => '#dde9ed',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color_be', 
            array(
                'label'       => __( 'Primary Color', 'blossom-shop-pro' ),
                'description' => __( 'Primary color of the theme.', 'blossom-shop-pro' ),
                'section'     => 'colors',
                'priority'    => 5,
                'active_callback' => 'blossom_shop_pro_colors_callback',
            )
        )
    );

    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color_be', 
        array(
            'default'           => '#f25529',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color_be', 
            array(
                'label'       => __( 'Secondary Color', 'blossom-shop-pro' ),
                'description' => __( 'Secondary color of the theme.', 'blossom-shop-pro' ),
                'section'     => 'colors',
                'priority'    => 5,
                'active_callback' => 'blossom_shop_pro_colors_callback',
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_color' );