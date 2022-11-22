<?php
/**
 * Service Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_service( $wp_customize ){

    /** Service Section */
    $wp_customize->add_section(
        'service',
        array(
            'title'    => __( 'Service Section', 'blossom-shop-pro' ),
            'priority' => 20,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Service Background */
    $wp_customize->add_setting(
        'service_background',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control(
            $wp_customize,
            'service_background',
            array(
                'label'       => __( 'Enable Background', 'blossom-shop-pro' ),
                'description' => __( 'Enable to add gray background on the service section.', 'blossom-shop-pro' ),
                'section'     => 'service',
                'priority'    => -1
            )            
        )
    );

    /** Service layout */
    $wp_customize->add_setting( 
        'service_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'service_layout',
            array(
                'section'     => 'service',
                'label'       => __( 'Service Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the service layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/services/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/services/two.jpg',
                    'three'     => get_template_directory_uri() . '/images/services/three.jpg',
                ),
                'priority'    => -1
            )
        )
    );

    $wp_customize->add_setting(
        'service_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'service_note_text',
            array(
                'section'     => 'service',
                'description' => __( '<hr/>Add "Text" and "Blossom: Icon Text" widget for service section.', 'blossom-shop-pro' ),
                'priority'    => -1
            )
        )
    );

    $service_section = $wp_customize->get_section( 'sidebar-widgets-service' );
    if ( ! empty( $service_section ) ) {

        $service_section->panel     = 'frontpage_settings';
        $service_section->priority  = 20;
        $wp_customize->get_control( 'service_note_text' )->section = 'sidebar-widgets-service';
        $wp_customize->get_control( 'service_layout' )->section    = 'sidebar-widgets-service';
        $wp_customize->get_control( 'service_background' )->section= 'sidebar-widgets-service';
    }  
    
    /** service Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_service' );