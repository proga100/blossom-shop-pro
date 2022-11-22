<?php
/**
 * Cta Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cta( $wp_customize ){

    /** Cta Section */
    $wp_customize->add_section(
        'cta',
        array(
            'title'    => __( 'Call To Action Section', 'blossom-shop-pro' ),
            'priority' => 90,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Cta layout */
    $wp_customize->add_setting( 
        'cta_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'cta_layout',
            array(
                'section'     => 'cta',
                'label'       => __( 'Cta Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the call to action layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/cta/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/cta/two.jpg',
                    'three'     => get_template_directory_uri() . '/images/cta/three.jpg',
                ),
                'priority'    => -1
            )
        )
    );

    $wp_customize->add_setting(
        'cta_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'cta_note_text',
            array(
                'section'     => 'cta',
                'description' => __( '<hr/>Add "Blossom: Call To Action" widget for Call to Action section.', 'blossom-shop-pro' ),
                'priority'    => -1
            )
        )
    );

    $cta_section = $wp_customize->get_section( 'sidebar-widgets-cta' );
    if ( ! empty( $cta_section ) ) {

        $cta_section->panel     = 'frontpage_settings';
        $cta_section->priority  = 90;
        $wp_customize->get_control( 'cta_note_text' )->section  = 'sidebar-widgets-cta';
        $wp_customize->get_control( 'cta_layout' )->section     = 'sidebar-widgets-cta';
    }  
    
    /** Cta Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cta' );