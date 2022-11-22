<?php
/**
 * Recent Product Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_recent_product( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }

    /** Recent Product Section */
    $wp_customize->add_section(
        'recent_product',
        array(
            'title'    => __( 'Recent Product Section', 'blossom-shop-pro' ),
            'priority' => 30,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_recent_product_active',
        )
    );

    /** Recent Product Title  */
    $wp_customize->add_setting(
        'recent_product_title',
        array(
            'default'           => __( 'New Arrivals', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'recent_product_title',
        array(
            'label'           => __( 'Recent Product Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for recent product section.', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'recent_product_title', array(
        'selector' => '.recent-prod-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_recent_product_title',
    ) );

    /** Recent Product SubTitle  */
    $wp_customize->add_setting(
        'recent_product_subtitle',
        array(
            'default'           => __( 'Add our new arrivals to your weekly lineup.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'recent_product_subtitle',
        array(
            'label'           => __( 'Recent Product Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for recent product section.', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
            'type'            => 'textarea',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'recent_product_subtitle', array(
        'selector' => '.recent-prod-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_recent_product_subtitle',
    ) );

    /** Recent Product Featured Image  */
    $wp_customize->add_setting( 'recent_product_featured_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'recent_product_featured_image',
            array(
                'label'         => esc_html__( 'Featured Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose Image of your choice. Recommended size for this image is 1920px by 1080px.', 'blossom-shop-pro' ),
                'section'       => 'recent_product',
                'type'          => 'image',
                'active_callback' => 'blossom_shop_pro_recent_product_ac'
            )
        )
    );

    /** Recent Product Featured Title  */
    $wp_customize->add_setting(
        'recent_product_featured_title',
        array(
            'default'           => __( 'The Biggest Street Style Trends', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'recent_product_featured_title',
        array(
            'label'           => __( 'Recent Product Featured Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for recent product featured section.', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
            'active_callback' => 'blossom_shop_pro_recent_product_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'recent_product_featured_title', array(
        'selector' => '.recent-prod-section h4.rp-title',
        'render_callback' => 'blossom_shop_pro_get_recent_product_featured_title',
    ) );

    /** Recent Product Featured SubTitle  */
    $wp_customize->add_setting(
        'recent_product_featured_subtitle',
        array(
            'default'           => __( 'SUMMER EXCLUSIVE COLLECTION', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'recent_product_featured_subtitle',
        array(
            'label'           => __( 'Recent Product Featured SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for recent product featured section.', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_recent_product_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'recent_product_featured_subtitle', array(
        'selector' => '.recent-prod-section .rp-desc',
        'render_callback' => 'blossom_shop_pro_get_recent_product_featured_subtitle',
    ) );

    /** Recent Product Featured Label */
    $wp_customize->add_setting(
        'recent_product_featured_label',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'recent_product_featured_label',
        array(
            'label'           => __( 'Recent Product Featured Button Label', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_recent_product_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'recent_product_featured_label', array(
        'selector' => '.recent-prod-section .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_recent_product_featured_label',
    ) );

    /** Recent Product Featured URL */
    $wp_customize->add_setting(
        'recent_product_featured_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'recent_product_featured_url',
        array(
            'label'           => __( 'Recent Product Featured Button URL', 'blossom-shop-pro' ),
            'section'         => 'recent_product',
            'type'            => 'url',
            'active_callback' => 'blossom_shop_pro_recent_product_ac'
        )
    ); 

    /** Recent product Content Style */
    $wp_customize->add_setting(
        'recent_product_type',
        array(
            'default'           => 'latest_products',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'recent_product_type',
            array(
                'label'   => __( 'Recent Product Content Filter', 'blossom-shop-pro' ),
                'section' => 'recent_product',
                'choices' => array( 
                    'latest_products'   => __( 'Latest Products','blossom-shop-pro' ), 
                    'single_products'   => __( 'Select Products','blossom-shop-pro' ), 
                    'cat_products'      => __( 'Product Category','blossom-shop-pro' ),
                ),   
            )
        )
    );

    /** Recent Products Category */
    $wp_customize->add_setting(
        'rp_cat',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'rp_cat',
            array(
                'label'           => __( 'Recent Products Category', 'blossom-shop-pro' ),
                'section'         => 'recent_product',
                'choices'         => blossom_shop_pro_get_categories( true, 'product_cat' ),
                'active_callback' => 'blossom_shop_pro_recent_product_ac'    
            )
        )
    );
    
    /** Recent Product Custom */
    $wp_customize->add_setting( 
        new Blossom_Shop_Pro_Repeater_Setting( 
            $wp_customize, 
            'rp_custom', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Blossom_Shop_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Control_Repeater(
            $wp_customize,
            'rp_custom',
            array(
                'section' => 'recent_product',                
                'label'   => __( 'Select Products', 'blossom-shop-pro' ),
                'fields'  => array(
                    'product' => array(
                        'type'    => 'select',
                        'label'   => __( 'Select Product', 'blossom-shop-pro' ),
                        'choices' => blossom_shop_pro_get_posts( 'product' )
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'Product', 'blossom-shop-pro' ),
                ),
                'active_callback' => 'blossom_shop_pro_recent_product_ac',
                'limit'           => 10,                        
            )
        )
    );

    /** No. of products */
    $wp_customize->add_setting(
        'no_of_products',
        array(
            'default'           => 5,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Slider_Control( 
            $wp_customize,
            'no_of_products',
            array(
                'section'     => 'recent_product',
                'label'       => __( 'Number of Products', 'blossom-shop-pro' ),
                'description' => __( 'Choose the number of products you want to display', 'blossom-shop-pro' ),
                'choices'     => array(
                    'min'   => 1,
                    'max'   => 20,
                    'step'  => 1,
                ),
                'active_callback' => 'blossom_shop_pro_recent_product_ac',                 
            )
        )
    );    

    /** Recent product layout */
    $wp_customize->add_setting( 
        'recent_product_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'recent_product_layout',
            array(
                'section'     => 'recent_product',
                'label'       => __( 'Recent Product Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the recent product layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/recent-product/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/recent-product/two.jpg',
                    'three'     => get_template_directory_uri() . '/images/recent-product/three.jpg',
                    'four'      => get_template_directory_uri() . '/images/recent-product/four.jpg',
                    'five'      => get_template_directory_uri() . '/images/recent-product/five.jpg',
                    'six'       => get_template_directory_uri() . '/images/recent-product/six.jpg',
                )
            )
        )
    );
    
    /** Recent Product Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_recent_product' );