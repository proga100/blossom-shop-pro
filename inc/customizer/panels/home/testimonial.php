<?php
/**
 * Testimonial Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_testimonial( $wp_customize ){

    /** Testimonial Section */
    $wp_customize->add_section(
        'testimonial',
        array(
            'title'    => __( 'Testimonial Section', 'blossom-shop-pro' ),
            'priority' => 80,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Testimonial Title  */
    $wp_customize->add_setting(
        'testimonial_title',
        array(
            'default'           => __( 'Our Happy Customers', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_title',
        array(
            'label'           => __( 'Testimonial Section Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for testimonial section.', 'blossom-shop-pro' ),
            'section'         => 'testimonial',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_title', array(
        'selector' => '.testimonial-section h2.section-title',
        'render_callback' => 'blossom_shop_pro_get_testimonial_title',
    ) );
    
    /** Testimonial SubTitle  */
    $wp_customize->add_setting(
        'testimonial_subtitle',
        array(
            'default'           => __( 'Words of praise by our valuable customers', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'testimonial_subtitle',
        array(
            'label'           => __( 'Testimonial Section SubTitle', 'blossom-shop-pro' ),
            'description'     => __( 'Add subtitle for testimonial section.', 'blossom-shop-pro' ),
            'section'         => 'testimonial',
            'type'            => 'textarea',
            'priority'    => -1
        )
    );

    $wp_customize->selective_refresh->add_partial( 'testimonial_subtitle', array(
        'selector' => '.testimonial-section .section-desc',
        'render_callback' => 'blossom_shop_pro_get_testimonial_title',
    ) );

    /** Testimonial layout */
    $wp_customize->add_setting( 
        'testimonial_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'testimonial_layout',
            array(
                'section'     => 'testimonial',
                'label'       => __( 'Testimonial Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the testimonial layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/testimonial/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/testimonial/two.jpg',
                    'three'     => get_template_directory_uri() . '/images/testimonial/three.jpg',
                ),
                'priority'    => -1
            )
        )
    );

    $wp_customize->add_setting(
        'testimonial_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'testimonial_note_text',
            array(
                'section'     => 'testimonial',
                'description' => __( '<hr/>Add "Blossom: Testimonial" widget for testimonial section.', 'blossom-shop-pro' ),
                'priority'    => -1
            )
        )
    );

    $testimonial_section = $wp_customize->get_section( 'sidebar-widgets-testimonial' );
    if ( ! empty( $testimonial_section ) ) {

        $testimonial_section->panel     = 'frontpage_settings';
        $testimonial_section->priority  = 80;
        $wp_customize->get_control( 'testimonial_note_text' )->section = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_title' )->section     = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_subtitle' )->section  = 'sidebar-widgets-testimonial';
        $wp_customize->get_control( 'testimonial_layout' )->section    = 'sidebar-widgets-testimonial';
    }  
    
    /** Testimonial Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_testimonial' );