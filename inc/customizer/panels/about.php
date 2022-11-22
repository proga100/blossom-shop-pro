<?php
/**
 * About Page Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_about( $wp_customize ) {
    
    $wp_customize->add_panel( 
        'about_page_settings', 
        array(
            'title'       => __( 'About Page Settings', 'blossom-shop-pro' ),
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'description' => __( 'About Page Template Settings.', 'blossom-shop-pro' ),
        ) 
    );

    $wp_customize->add_section(
        'about_template',
        array(
            'title'    => __( 'About Template Section', 'blossom-shop-pro' ),
            'priority' => 10,
            'panel'    => 'about_page_settings',
        )
    );

    $wp_customize->add_setting(
        'about_template_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'about_template_note_text',
            array(
                'section'     => 'about_template',
                'description' => __( 'If the About Page Template assigned page has an featured image this Background Image Will be override by the featured image of respective page. <hr/>', 'blossom-shop-pro' ),
            )
        )
    );

    $wp_customize->add_setting( 'about_background_image',
        array(
            'default'           => get_template_directory_uri() . '/images/page-header-bg.jpg',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'about_background_image',
            array(
                'label'         => esc_html__( 'Background Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Choose background Image of your choice. Recommended size for this image is 1920px by 232px.', 'blossom-shop-pro' ),
                'section'       => 'about_template',
                'type'          => 'image',
            )
        )
    );

    /** About Testimonial Section */
    $wp_customize->add_section(
        'about-testimonial',
        array(
            'title'    => __( 'About Testimonial Section', 'blossom-shop-pro' ),
            'priority' => 30,
            'panel'    => 'about_page_settings',
        )
    );

    /** About Testimonial Title  */
    $wp_customize->add_setting(
        'about_testi_title',
        array(
            'default'           => __( 'Our Happy Customers', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'about_testi_title',
        array(
            'label'           => __( 'About Testimonial Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for about testimonial section.', 'blossom-shop-pro' ),
            'section'         => 'about-testimonial',
            'priority'        => -1,
        )
    );

    $wp_customize->selective_refresh->add_partial( 'about_testi_title', array(
        'selector' => '#about_testimonial_section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_about_testi_title',
    ) );
    
    /** About Testimonial SubTitle  */
    $wp_customize->add_setting(
        'about_testi_subtitle',
        array(
            'default'           => __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'about_testi_subtitle',
        array(
            'label'           => __( 'About Testimonial Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for about testimonial section.', 'blossom-shop-pro' ),
            'section'         => 'about-testimonial',
            'type'            => 'textarea',
            'priority'        => -1,
        )
    );

    $wp_customize->selective_refresh->add_partial( 'about_testi_subtitle', array(
        'selector' => '#about_testimonial_section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_about_testi_subtitle',
    ) );

    $wp_customize->add_setting(
        'about_testi_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'about_testi_note_text',
            array(
                'section'     => 'about-testimonial',
                'description' => __( 'Add "Blossom: Testimonial" widget for about testimonial section.<hr/>', 'blossom-shop-pro' ),
                'priority'        => -1,
            )
        )
    );


    $about_testi_section = $wp_customize->get_section( 'sidebar-widgets-about-testimonial' );
    if ( ! empty( $about_testi_section ) ) {

        $about_testi_section->panel     = 'about_page_settings';
        $about_testi_section->priority  = 30;
        $wp_customize->get_control( 'about_testi_note_text' )->section = 'sidebar-widgets-about-testimonial';
        $wp_customize->get_control( 'about_testi_title' )->section     = 'sidebar-widgets-about-testimonial';
        $wp_customize->get_control( 'about_testi_subtitle' )->section  = 'sidebar-widgets-about-testimonial';
    }

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_about' );