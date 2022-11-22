<?php
/**
 * Header Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_header( $wp_customize ) {
    
    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'blossom-shop-pro' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );

    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_sticky_header',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_sticky_header',
            array(
                'section'       => 'header_settings',
                'label'         => __( 'Sticky Header', 'blossom-shop-pro' ),
                'description'   => __( 'Enable to stick header at top.', 'blossom-shop-pro' ),
            )
        )
    );

    /** Enable Header Search */
    $wp_customize->add_setting( 
        'ed_header_search', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_header_search',
            array(
                'section'     => 'header_settings',
                'label'       => __( 'Enable Header Search', 'blossom-shop-pro' ),
                'description' => __( 'Enable to show Search button in header.', 'blossom-shop-pro' ),
            )
        )
    );

    /** Currency Switcher Shortcode */
    $wp_customize->add_setting(
        'currency_switcher_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'currency_switcher_shortcode',
        array(
            'type'        => 'text',
            'section'     => 'header_settings',
            'label'       => __( 'Currency Switcher Shortcode', 'blossom-shop-pro' ),
            'description' => __( 'Enter the shortcode here. Ex. [woocs]', 'blossom-shop-pro' ),
        )
    ); 

    /** Language Switcher Shortcode */
    $wp_customize->add_setting(
        'language_switcher_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'language_switcher_shortcode',
        array(
            'type'        => 'text',
            'section'     => 'header_settings',
            'label'       => __( 'Language Switcher Shortcode', 'blossom-shop-pro' ),
            'description' => __( 'Enter the shortcode here.', 'blossom-shop-pro' ),
        )
    ); 
    
    /** User Login */
    $wp_customize->add_setting( 
        'ed_user_login', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_user_login',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'User Login', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to show user login in the header.', 'blossom-shop-pro' ),
                'active_callback' => 'is_woocommerce_activated',
            )
        )
    );

    /** Wishlist Cart */
    $wp_customize->add_setting( 
        'ed_whislist', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_whislist',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'Wishlist Cart', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to show Wishlist cart in the header.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_woo_plugins_activated',
            )
        )
    );

    /** Shopping Cart */
    $wp_customize->add_setting( 
        'ed_shopping_cart', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_shopping_cart',
            array(
                'section'         => 'header_settings',
                'label'           => __( 'Shopping Cart', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to show Shopping cart in the header.', 'blossom-shop-pro' ),
                'active_callback' => 'is_woocommerce_activated'
            )
        )
    );

    $wp_customize->add_setting( 'header_background_image',
        array(
            'default'           => get_template_directory_uri() . '/images/page-header-bg.jpg',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'header_background_image',
            array(
                'label'         => esc_html__( 'Header Background Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose background Image of your choice. Recommended size for this image is 1920px by 232px.', 'blossom-shop-pro' ),
                'section'       => 'header_settings',
                'type'          => 'image',
            )
        )
    );

    $wp_customize->add_setting(
        'header_details_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'header_details_text',
            array(
                'section'     => 'header_settings',
                'description' => sprintf( __( '%1$sClick here%2$s to select the layout of slider banner.', 'blossom-shop-pro' ), '<span class="text-inner-link header_details_text">', '</span>' ),
            )
        )
    );
    
    /** Header Settings Ends */
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_header' );