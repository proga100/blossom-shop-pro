<?php
/**
 * Category Four Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cat_four( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Category Four Section */
    $wp_customize->add_section(
        'cat_four',
        array(
            'title'    => __( 'Category Four Section', 'blossom-shop-pro' ),
            'priority' => 77,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_cat_four_active',
        )
    );

    /** Category Four Title  */
    $wp_customize->add_setting(
        'cat_four_title',
        array(
            'default'           => __( 'Our Best Reviewed Products', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_title',
        array(
            'label'           => __( 'Category Four Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category four section.', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_four_title', array(
        'selector' => '.fourth-cat-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_cat_four_title',
    ) );

    /** Category Four SubTitle  */
    $wp_customize->add_setting(
        'cat_four_subtitle',
        array(
            'default'           => __( 'Top selling products reviewed by our valuable customers.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_subtitle',
        array(
            'label'           => __( 'Category Four Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category four section.', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_four_subtitle', array(
        'selector' => '.fourth-cat-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_four_subtitle',
    ) );

    /** Category Four Featured Image  */
    $wp_customize->add_setting( 'cat_four_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'cat_four_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'cat_four',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_cat_four_ac'
            )
        )
    );

    /** Category Four Featured Title  */
    $wp_customize->add_setting(
        'cat_four_featured_title',
        array(
            'default'           => __( 'STREET TRENDING 2019', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_featured_title',
        array(
            'label'           => __( 'Category Four Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category four featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
            'active_callback' => 'blossom_shop_pro_cat_four_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_four_featured_title', array(
        'selector' => '.fourth-cat-section h4.pp-title',
        'render_callback' => 'blossom_shop_pro_get_cat_four_featured_title',
    ) );

    /** Category Four Featured SubTitle  */
    $wp_customize->add_setting(
        'cat_four_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_featured_subtitle',
        array(
            'label'           => __( 'Category Four Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category four featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_cat_four_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_four_featured_subtitle', array(
        'selector' => '.fourth-cat-section .pp-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_four_featured_subtitle',
    ) );

    /** Category Four Featured Label */
    $wp_customize->add_setting(
        'cat_four_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cat_four_featured_label',
        array(
            'label'           => __( 'Category Four Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_cat_four_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cat_four_featured_label', array(
        'selector' => '.fourth-cat-section .product-title-wrap .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_four_featured_label',
    ) );

    /** Category Four Featured URL */
    $wp_customize->add_setting(
        'cat_four_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_featured_url',
        array(
            'label'           => __( 'Category Four Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_cat_four_ac'
        )
    ); 

    /** Category Four Content Style */
    $wp_customize->add_setting(
        'cat_four_select',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_four_select',
            array(
                'label'   => __( 'Category Four Content', 'blossom-shop-pro' ),
                'section' => 'cat_four',
                'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
            )
        )
    );

    /** Category Four Content Style */
    $wp_customize->add_setting(
        'cat_four_type',
        array(
            'default'           => 'latest_cat_four',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_four_type',
            array(
                'label'   => __( 'Category Four Content Filter', 'blossom-shop-pro' ),
                'section' => 'cat_four',
                'choices' => array( 
                    'latest_cat_four'       => __( 'Latest Products','blossom-shop-pro' ), 
                    'on_sales_four'         => __( 'On Sale Products','blossom-shop-pro' ), 
                    'number_reviews_four'   => __( 'Based on Reviews','blossom-shop-pro' ), 
                ),   
            )
        )
    );

    /** Category Four Button Label  */
    $wp_customize->add_setting(
        'cat_four_all',
        array(
            'default'           => __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_four_all',
        array(
            'label'           => __( 'Category Four Button Label', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for category four section.', 'blossom-shop-pro' ),
            'section'         => 'cat_four',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_four_all', array(
        'selector' => '.fourth-cat-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_four_all',
    ) );

    /** Category Four layout */
    $wp_customize->add_setting( 
        'cat_four_layout', 
        array(
            'default'           => 'six',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'cat_four_layout',
            array(
                'section'     => 'cat_four',
                'label'       => __( 'Category Four Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the category four layout for your site.', 'blossom-shop-pro' ),
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
    
    /** Category Four Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cat_four' );