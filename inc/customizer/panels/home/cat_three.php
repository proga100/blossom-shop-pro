<?php
/**
 * Category Three Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cat_three( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Category Three Section */
    $wp_customize->add_section(
        'cat_three',
        array(
            'title'    => __( 'Category Three Section', 'blossom-shop-pro' ),
            'priority' => 73,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_cat_three_active',
        )
    );

    /** Category Three Title  */
    $wp_customize->add_setting(
        'cat_three_title',
        array(
            'default'           => __( 'Products On Sales', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_title',
        array(
            'label'           => __( 'Category Three Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category three section.', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_three_title', array(
        'selector' => '.third-cat-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_cat_three_title',
    ) );

    /** Category Three SubTitle  */
    $wp_customize->add_setting(
        'cat_three_subtitle',
        array(
            'default'           => __( 'Grab the limited time offers on these products.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_subtitle',
        array(
            'label'           => __( 'Category Three Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category three section.', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_three_subtitle', array(
        'selector' => '.third-cat-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_three_subtitle',
    ) );

    /** Category Three Featured Image  */
    $wp_customize->add_setting( 'cat_three_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'cat_three_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'cat_three',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_cat_three_ac'
            )
        )
    );

    /** Category Three Featured Title  */
    $wp_customize->add_setting(
        'cat_three_featured_title',
        array(
            'default'           => __( 'STREET TRENDING 2019', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_featured_title',
        array(
            'label'           => __( 'Category Three Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category three featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
            'active_callback' => 'blossom_shop_pro_cat_three_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_three_featured_title', array(
        'selector' => '.third-cat-section h4.pp-title',
        'render_callback' => 'blossom_shop_pro_get_cat_three_featured_title',
    ) );

    /** Category Three Featured SubTitle  */
    $wp_customize->add_setting(
        'cat_three_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_featured_subtitle',
        array(
            'label'           => __( 'Category Three Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category three featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_cat_three_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_three_featured_subtitle', array(
        'selector' => '.third-cat-section .pp-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_three_featured_subtitle',
    ) );

    /** Category Three Featured Label */
    $wp_customize->add_setting(
        'cat_three_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cat_three_featured_label',
        array(
            'label'           => __( 'Category Three Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_cat_three_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cat_three_featured_label', array(
        'selector' => '.third-cat-section .product-title-wrap .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_three_featured_label',
    ) );

    /** Category Three Featured URL */
    $wp_customize->add_setting(
        'cat_three_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_featured_url',
        array(
            'label'           => __( 'Category Three Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_cat_three_ac'
        )
    ); 

    /** Category Three Content Style */
    $wp_customize->add_setting(
        'cat_three_select',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_three_select',
            array(
                'label'   => __( 'Category Three Content', 'blossom-shop-pro' ),
                'section' => 'cat_three',
                'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
            )
        )
    );

    /** Category Three Content Style */
    $wp_customize->add_setting(
        'cat_three_type',
        array(
            'default'           => 'latest_cat_three',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_three_type',
            array(
                'label'   => __( 'Category Three Content Filter', 'blossom-shop-pro' ),
                'section' => 'cat_three',
                'choices' => array( 
                    'latest_cat_three'        => __( 'Latest Products','blossom-shop-pro' ), 
                    'on_sales_three'          => __( 'On Sale Products','blossom-shop-pro' ), 
                    'number_reviews_three'    => __( 'Based on Reviews','blossom-shop-pro' ), 
                ),   
            )
        )
    );

    /** Category Three Button Label  */
    $wp_customize->add_setting(
        'cat_three_all',
        array(
            'default'           => __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_three_all',
        array(
            'label'           => __( 'Category Three Button Label', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for category three section.', 'blossom-shop-pro' ),
            'section'         => 'cat_three',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_three_all', array(
        'selector' => '.third-cat-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_three_all',
    ) );

    /** Category Three layout */
    $wp_customize->add_setting( 
        'cat_three_layout', 
        array(
            'default'           => 'five',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'cat_three_layout',
            array(
                'section'     => 'cat_three',
                'label'       => __( 'Category Three Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the category three layout for your site.', 'blossom-shop-pro' ),
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
    
    /** Category Three Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cat_three' );