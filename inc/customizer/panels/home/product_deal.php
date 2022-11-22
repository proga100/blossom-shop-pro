<?php
/**
 * Product Deal Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_prod_deal( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Product Deal Section */
    $wp_customize->add_section(
        'prod_deal',
        array(
            'title'    => __( 'Product Deal Section', 'blossom-shop-pro' ),
            'priority' => 60,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_product_deal_active',
        )
    );

    /** Product Deal Title  */
    $wp_customize->add_setting(
        'prod_deal_title',
        array(
            'default'           => __( 'HOT DEAL THIS WEEK', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'prod_deal_title',
        array(
            'label'           => __( 'Product Deal Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for product deal section.', 'blossom-shop-pro' ),
            'section'         => 'prod_deal',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'prod_deal_title', array(
        'selector' => '.prod-deal-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_prod_deal_title',
    ) );

    /** Product Deal SubTitle  */
    $wp_customize->add_setting(
        'prod_deal_subtitle',
        array(
            'default'           => __( 'FLAT 40% OFF EVERYTHING', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'prod_deal_subtitle',
        array(
            'label'           => __( 'Product Deal Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for product deal section.', 'blossom-shop-pro' ),
            'section'         => 'prod_deal',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'prod_deal_subtitle', array(
        'selector' => '.prod-deal-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_prod_deal_subtitle',
    ) );

    /** Countdown Timer */
    $wp_customize->add_setting(
        'countdown_timer',
        array(
            'default'           => '2021-08-20', 
            'sanitize_callback' => 'blossom_shop_pro_sanitize_date'
        )
    );
    
     $wp_customize->add_control(
        'countdown_timer',
        array(
            'label'           => __( 'Event Time', 'blossom-shop-pro' ),
            'description'     => __( 'Select upcoming event time.', 'blossom-shop-pro' ),
            'section'         => 'prod_deal',
            'type'            => 'date',
        )            
    );
    
    /** Product Deal Button Label  */
    $wp_customize->add_setting(
        'prod_deal_button',
        array(
            'default'           => __( 'BUY NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'prod_deal_button',
        array(
            'label'           => __( 'Product Deal Section Button', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for product deal section.', 'blossom-shop-pro' ),
            'section'         => 'prod_deal',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'prod_deal_button', array(
        'selector' => '.prod-deal-section .button-wrap a.bttn',
        'render_callback' => 'blossom_shop_pro_get_prod_deal_button',
    ) );

    /** Product Deal Button Label  */
    $wp_customize->add_setting(
        'prod_deal_button_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'prod_deal_button_url',
        array(
            'label'           => __( 'Product Deal Section Button', 'blossom-shop-pro' ),
            'description'     => __( 'Add button url for product deal section.', 'blossom-shop-pro' ),
            'section'         => 'prod_deal',
            'type'            => 'url',
        )
    );

    /** Product Deal Background  */
    $wp_customize->add_setting( 'prod_deal_background',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'prod_deal_background',
            array(
                'label'         => esc_html__( 'Choose Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice in png format. Recommended size for this image is 950px by 600px.', 'blossom-shop-pro' ),
                'section'       => 'prod_deal',
                'type'          => 'image',
            )
        )
    );
    
    /** Product Deal Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_prod_deal' );