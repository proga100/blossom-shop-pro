<?php
/**
 * One Page Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_onepage( $wp_customize ){
    
    /** Sort Front Page Section */
    $wp_customize->add_section(
        'one_page_settings',
        array(
            'title'    => __( 'One Page Settings', 'blossom-shop-pro' ),
            'priority' => 130,
            'panel'    => 'frontpage_settings',
        )
    );
    
    /** Blog Options */
    $wp_customize->add_setting(
        'ed_one_page',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control(
            $wp_customize,
            'ed_one_page',
            array(
                'label'       => __( 'Enable Section Menu', 'blossom-shop-pro' ),
                'description' => __( 'Enable to make home page one page scrolling with section menu.', 'blossom-shop-pro' ),
                'section'     => 'one_page_settings',
            )            
        )
    );
    
    /** Blog Options */
    $wp_customize->add_setting(
        'ed_home_link',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control(
            $wp_customize,
            'ed_home_link',
            array(
                'label'           => __( 'Home Link', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to display "Home" link in section menu.', 'blossom-shop-pro' ),
                'section'         => 'one_page_settings',
                'active_callback' => 'blossom_shop_pro_header_ac'
            )            
        )
    );
    
    /** Service Section Menu Label  */
    $wp_customize->add_setting(
        'label_service',
        array(
            'default'           => __( 'Service', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_service',
        array(
            'label'           => __( 'Service Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Recent Product Section Menu Label  */
    $wp_customize->add_setting(
        'label_recent',
        array(
            'default'           => __( 'Recent', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_recent',
        array(
            'label'           => __( 'Recent Product Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Featured Section Menu Label  */
    $wp_customize->add_setting(
        'label_featured',
        array(
            'default'           => __( 'Featured', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_featured',
        array(
            'label'           => __( 'Featured Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Popular Product Section Menu Label  */
    $wp_customize->add_setting(
        'label_popular',
        array(
            'default'           => __( 'Popular', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_popular',
        array(
            'label'           => __( 'Popular Product Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Product Deal Section Menu Label  */
    $wp_customize->add_setting(
        'label_deal',
        array(
            'default'           => __( 'Deal', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_deal',
        array(
            'label'           => __( 'Product Deal Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Category One Section Menu Label  */
    $wp_customize->add_setting(
        'label_cat_one',
        array(
            'default'           => __( 'Category One', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cat_one',
        array(
            'label'           => __( 'Category One Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Category Tab Section Menu Label  */
    $wp_customize->add_setting(
        'label_cat_tab',
        array(
            'default'           => __( 'Category Tab', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cat_tab',
        array(
            'label'           => __( 'Category Tab Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Category Two Section Menu Label  */
    $wp_customize->add_setting(
        'label_cat_two',
        array(
            'default'           => __( 'Category Two', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cat_two',
        array(
            'label'           => __( 'Category Two Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** About Section Menu Label  */
    $wp_customize->add_setting(
        'label_about',
        array(
            'default'           => __( 'About', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_about',
        array(
            'label'           => __( 'About Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Category Three Section Menu Label  */
    $wp_customize->add_setting(
        'label_cat_three',
        array(
            'default'           => __( 'Category Three', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cat_three',
        array(
            'label'           => __( 'Category Three Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Category Four Section Menu Label  */
    $wp_customize->add_setting(
        'label_cat_four',
        array(
            'default'           => __( 'Category Four', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cat_four',
        array(
            'label'           => __( 'Category Four Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

        
    /** Testimonial Section Menu Label  */
    $wp_customize->add_setting(
        'label_testimonial',
        array(
            'default'           => __( 'Testimonial', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_testimonial',
        array(
            'label'           => __( 'Testimonial Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** CTA Section Menu Label  */
    $wp_customize->add_setting(
        'label_cta',
        array(
            'default'           => __( 'CTA', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_cta',
        array(
            'label'           => __( 'CTA Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );
        
    /** Blog Section Menu Label  */
    $wp_customize->add_setting(
        'label_blog',
        array(
            'default'           => __( 'Blog', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_blog',
        array(
            'label'           => __( 'Blog Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );

    /** Client Menu Label  */
    $wp_customize->add_setting(
        'label_client',
        array(
            'default'           => __( 'Service', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'label_client',
        array(
            'label'           => __( 'Client Section Menu Label', 'blossom-shop-pro' ),
            'description'     => __( 'Left blank to hide the section in the menu.', 'blossom-shop-pro' ),
            'section'         => 'one_page_settings',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_header_ac'
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_onepage' );