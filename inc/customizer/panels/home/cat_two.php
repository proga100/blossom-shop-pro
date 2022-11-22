<?php
/**
 * Category Two Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cat_two( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }
    
    /** Category Two Section */
    $wp_customize->add_section(
        'cat_two',
        array(
            'title'    => __( 'Category Two Section', 'blossom-shop-pro' ),
            'priority' => 67,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_cat_two_active',
        )
    );

    /** Category Two Title  */
    $wp_customize->add_setting(
        'cat_two_title',
        array(
            'default'           => __( 'Featured Products', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_title',
        array(
            'label'           => __( 'Category Two Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category two section.', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_two_title', array(
        'selector' => '.second-cat-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_cat_two_title',
    ) );

    /** Category Two SubTitle  */
    $wp_customize->add_setting(
        'cat_two_subtitle',
        array(
            'default'           => __( 'Check out our exclusive trending products.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_subtitle',
        array(
            'label'           => __( 'Category Two Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category two section.', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_two_subtitle', array(
        'selector' => '.second-cat-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_two_subtitle',
    ) );

    /** Category Two Featured Image  */
    $wp_customize->add_setting( 'cat_two_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'cat_two_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'cat_two',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_cat_two_ac'
            )
        )
    );

    /** Category Two Featured Title  */
    $wp_customize->add_setting(
        'cat_two_featured_title',
        array(
            'default'           => __( 'STREET TRENDING 2019', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_featured_title',
        array(
            'label'           => __( 'Category Two Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for category two featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
            'active_callback' => 'blossom_shop_pro_cat_two_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_two_featured_title', array(
        'selector' => '.second-cat-section h4.pp-title',
        'render_callback' => 'blossom_shop_pro_get_cat_two_featured_title',
    ) );

    /** Category Two Featured SubTitle  */
    $wp_customize->add_setting(
        'cat_two_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_featured_subtitle',
        array(
            'label'           => __( 'Category Two Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for category two featured section.', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_cat_two_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_two_featured_subtitle', array(
        'selector' => '.second-cat-section .pp-desc',
        'render_callback' => 'blossom_shop_pro_get_cat_two_featured_subtitle',
    ) );

    /** Category Two Featured Label */
    $wp_customize->add_setting(
        'cat_two_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cat_two_featured_label',
        array(
            'label'           => __( 'Category Two Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_cat_two_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'cat_two_featured_label', array(
        'selector' => '.second-cat-section .product-title-wrap .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_two_featured_label',
    ) );

    /** Category Two Featured URL */
    $wp_customize->add_setting(
        'cat_two_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_featured_url',
        array(
            'label'           => __( 'Category Two Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_cat_two_ac'
        )
    ); 

    /** Category Two Content Style */
    $wp_customize->add_setting(
        'cat_two_select',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_two_select',
            array(
                'label'   => __( 'Category Two Content', 'blossom-shop-pro' ),
                'section' => 'cat_two',
                'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
            )
        )
    );

    /** Category One Content Style */
    $wp_customize->add_setting(
        'cat_two_type',
        array(
            'default'           => 'latest_cat_two',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'cat_two_type',
            array(
                'label'   => __( 'Category Two Content Filter', 'blossom-shop-pro' ),
                'section' => 'cat_two',
                'choices' => array( 
                    'latest_cat_two'      => __( 'Latest Products','blossom-shop-pro' ), 
                    'on_sales_two'        => __( 'On Sale Products','blossom-shop-pro' ), 
                    'number_reviews_two'  => __( 'Based on Reviews','blossom-shop-pro' ), 
                ),   
            )
        )
    );

    /** Category Two Button Label  */
    $wp_customize->add_setting(
        'cat_two_all',
        array(
            'default'           => __( 'SHOP ALL PRODUCTS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'cat_two_all',
        array(
            'label'           => __( 'Category Two Button Label', 'blossom-shop-pro' ),
            'description'     => __( 'Add button label for category two section.', 'blossom-shop-pro' ),
            'section'         => 'cat_two',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'cat_two_all', array(
        'selector' => '.second-cat-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_cat_two_all',
    ) );

    /** Category Two layout */
    $wp_customize->add_setting( 
        'cat_two_layout', 
        array(
            'default'           => 'four',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'cat_two_layout',
            array(
                'section'     => 'cat_two',
                'label'       => __( 'Category Two Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the category two layout for your site.', 'blossom-shop-pro' ),
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
    
    /** Category Two Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cat_two' );