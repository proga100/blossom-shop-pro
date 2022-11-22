<?php
/**
 * Popular Product Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_popular_product( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Popular Product Section */
    $wp_customize->add_section(
        'popular_product',
        array(
            'title'    => __( 'Popular Product Section', 'blossom-shop-pro' ),
            'priority' => 50,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_popular_product_active',
        )
    );

    /** Popular Product Title  */
    $wp_customize->add_setting(
        'popular_product_title',
        array(
            'default'           => __( 'Popular Products', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_title',
        array(
            'label'           => __( 'Popular Product Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for Popular product section.', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_product_title', array(
        'selector' => '.popular-prod-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_popular_product_title',
    ) );

    /** Popular Product SubTitle  */
    $wp_customize->add_setting(
        'popular_product_subtitle',
        array(
            'default'           => __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_subtitle',
        array(
            'label'           => __( 'Popular Product Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for Popular product section.', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_product_subtitle', array(
        'selector' => '.popular-prod-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_popular_product_subtitle',
    ) );

    /** Popular Product Featured Image  */
    $wp_customize->add_setting( 'popular_product_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'popular_product_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'popular_product',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_popular_product_ac'
            )
        )
    );

    /** Popular Product Featured Title  */
    $wp_customize->add_setting(
        'popular_product_featured_title',
        array(
            'default'           => __( 'STREET TRENDING 2019', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_featured_title',
        array(
            'label'           => __( 'Popular Product Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for popular product featured section.', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'active_callback' => 'blossom_shop_pro_popular_product_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_product_featured_title', array(
        'selector' => '.popular-prod-section h4.pp-title',
        'render_callback' => 'blossom_shop_pro_get_popular_product_featured_title',
    ) );

    /** Popular Product Featured SubTitle  */
    $wp_customize->add_setting(
        'popular_product_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_featured_subtitle',
        array(
            'label'           => __( 'Popular Product Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for popular product featured section.', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_popular_product_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_product_featured_subtitle', array(
        'selector' => '.popular-prod-section .pp-desc',
        'render_callback' => 'blossom_shop_pro_get_popular_product_featured_subtitle',
    ) );

    /** Popular Product Featured Label */
    $wp_customize->add_setting(
        'popular_product_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'popular_product_featured_label',
        array(
            'label'           => __( 'Popular Product Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_popular_product_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'popular_product_featured_label', array(
        'selector' => '.popular-prod-section .product-title-wrap .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_popular_product_featured_label',
    ) );

    /** Popular Product Featured URL */
    $wp_customize->add_setting(
        'popular_product_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_featured_url',
        array(
            'label'           => __( 'Popular Product Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_popular_product_ac'
        )
    ); 

    /** Popular product Content Style */
    $wp_customize->add_setting(
        'popular_product_type',
        array(
            'default'           => 'from_views',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'popular_product_type',
            array(
                'label'   => __( 'Popular Product Content Filter', 'blossom-shop-pro' ),
                'section' => 'popular_product',
                'choices' => array( 
                    'from_views'        => __( 'Popular from Views','blossom-shop-pro' ), 
                    'from_comment'      => __( 'Popular from Comments','blossom-shop-pro' ), 
                ),   
            )
        )
    );

    /** Popular Product Button Label  */
    $wp_customize->add_setting(
        'popular_product_all',
        array(
            'default'           => __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_all',
        array(
            'label'           => __( 'Popular Product Button Label', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for Popular product section.', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'popular_product_all', array(
        'selector' => '.popular-prod-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_popular_product_all',
    ) );

    $wp_customize->add_setting(
        'popular_product_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'popular_product_link',
        array(
            'label'           => __( 'Button Link', 'blossom-shop-pro' ),
            'section'         => 'popular_product',
            'type'            => 'text',
        )
    );

    /** Popular product layout */
    $wp_customize->add_setting( 
        'popular_product_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'popular_product_layout',
            array(
                'section'     => 'popular_product',
                'label'       => __( 'Popular Product Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the popular product layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/popular-product/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/popular-product/two.jpg',
                    'three'     => get_template_directory_uri() . '/images/popular-product/three.jpg',
                    'four'      => get_template_directory_uri() . '/images/popular-product/four.jpg',
                    'five'      => get_template_directory_uri() . '/images/popular-product/five.jpg',
                    'six'       => get_template_directory_uri() . '/images/popular-product/six.jpg',
                )
            )
        )
    );
    
    /** Popular Product Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_popular_product' );