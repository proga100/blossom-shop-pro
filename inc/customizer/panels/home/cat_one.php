<?php
/**
 * Category One Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cat_one( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Category One Section */
    $wp_customize->add_section(
        'cat_one',
        array(
            'title'    => __( 'Category One Section', 'blossom-shop-pro' ),
            'priority' => 63,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_cat_one_active',
        )
    );

    /** Category One Title  */
    $wp_customize->add_setting(
        'cat_one_title',
        array(
            'default'           => __( 'Best Sellers', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_title',
        array(
            'label'           => __( 'Category One Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category one section.', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_one_title', array(
        'selector' => '.first-cat-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_cat_one_title',
    ) );

    /** Category One SubTitle  */
    $wp_customize->add_setting(
        'cat_one_subtitle',
        array(
            'default'           => __( 'Check out our best sellers products.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_subtitle',
        array(
            'label'           => __( 'Category One Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category one section.', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_one_subtitle', array(
        'selector' => '.first-cat-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_one_subtitle',
    ) );

    /** Category One Featured Image  */
    $wp_customize->add_setting( 'cat_one_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'cat_one_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'cat_one',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_cat_one_ac'
            )
        )
    );

    /** Category One Featured Title  */
    $wp_customize->add_setting(
        'cat_one_featured_title',
        array(
            'default'           => __( 'STREET TRENDING 2019', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_featured_title',
        array(
            'label'           => __( 'Category One Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category one featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
            'active_callback' => 'blossom_shop_pro_cat_one_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_one_featured_title', array(
        'selector' => '.first-cat-section h4.pp-title',
        'render_callback' => 'blossom_shop_pro_get_cat_one_featured_title',
    ) );

    /** Category One Featured SubTitle  */
    $wp_customize->add_setting(
        'cat_one_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_featured_subtitle',
        array(
            'label'           => __( 'Category One Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category one featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_cat_one_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_one_featured_subtitle', array(
        'selector' => '.first-cat-section .pp-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_one_featured_subtitle',
    ) );

    /** Category One Featured Label */
    $wp_customize->add_setting(
        'cat_one_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cat_one_featured_label',
        array(
            'label'           => __( 'Category One Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_cat_one_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cat_one_featured_label', array(
        'selector' => '.first-cat-section .product-title-wrap .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_one_featured_label',
    ) );

    /** Category One Featured URL */
    $wp_customize->add_setting(
        'cat_one_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_featured_url',
        array(
            'label'           => __( 'Category One Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_cat_one_ac'
        )
    ); 

    /** Category One Content Style */
    $wp_customize->add_setting(
        'cat_one_select',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_one_select',
            array(
                'label'   => __( 'Category One Content', 'blossom-shop-pro' ),
                'section' => 'cat_one',
                'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
            )
        )
    );

    /** Category One Content Style */
    $wp_customize->add_setting(
        'cat_one_type',
        array(
            'default'           => 'latest_cat_one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_one_type',
            array(
                'label'   => __( 'Category One Content Filter', 'blossom-shop-pro' ),
                'section' => 'cat_one',
                'choices' => array( 
                    'latest_cat_one'      => __( 'Latest Products','blossom-shop-pro' ), 
                    'on_sales_one'        => __( 'On Sale Products','blossom-shop-pro' ), 
                    'number_reviews_one'  => __( 'Based on Reviews','blossom-shop-pro' ), 
                ),   
            )
        )
    );

    /** Category One Button Label  */
    $wp_customize->add_setting(
        'cat_one_all',
        array(
            'default'           => __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_one_all',
        array(
            'label'           => __( 'Category One Button Label', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for category one section.', 'blossom-shop-pro' ),
            'section'         => 'cat_one',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_one_all', array(
        'selector' => '.first-cat-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_one_all',
    ) );

    /** Category One layout */
    $wp_customize->add_setting( 
        'cat_one_layout', 
        array(
            'default'           => 'three',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'cat_one_layout',
            array(
                'section'     => 'cat_one',
                'label'       => __( 'Category One Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the category one layout for your site.', 'blossom-shop-pro' ),
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
    
    /** Category One Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cat_one' );