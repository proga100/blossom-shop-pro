<?php
/**
 * Shop Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_shop( $wp_customize ) {
    
    /** Shop Settings */
    $wp_customize->add_section(
        'shop_settings',
        array(
            'title'    => __( 'Shop Settings', 'blossom-shop-pro' ),
            'priority' => 90,
            'panel'    => 'general_settings',
            'active_callback' => 'is_woocommerce_activated'
        )
    );

    $wp_customize->add_setting( 'shop_background_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'shop_background_image',
            array(
                'label'         => esc_html__( 'Shop Background Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 550px.', 'blossom-shop-pro' ),
                'section'       => 'shop_settings',
                'type'          => 'image',
            )
        )
    );

    /** Shop Page Description */
    $wp_customize->add_setting( 
        'ed_shop_archive_description', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_shop_archive_description',
            array(
                'section'         => 'shop_settings',
                'label'           => __( 'Shop Page Description', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to show Shop Page Description.', 'blossom-shop-pro' ),
            )
        )
    );
    
    /** $shop_archive_description */
    $wp_customize->add_setting( 
        'shop_archive_description', 
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post'
        ) 
    );
    
    $wp_customize->add_control(
        'shop_archive_description',
        array(
            'section'         => 'shop_settings',
            'label'           => __( 'Description For Shop Page', 'blossom-shop-pro' ),
            'description'     => __( 'Write new description for Shop Page to overwrite the default description.', 'blossom-shop-pro' ),
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_shop_description_ac'
        )
    );
        
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_shop' );