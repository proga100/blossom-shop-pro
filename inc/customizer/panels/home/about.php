<?php
/**
 * About Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_about( $wp_customize ){

    /** About Section */
    $wp_customize->add_section(
        'about',
        array(
            'title'    => __( 'About Section', 'blossom-shop-pro' ),
            'priority' => 70,
            'panel'    => 'frontpage_settings',
        )
    );

    /** About layout */
    $wp_customize->add_setting( 
        'about_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'about_layout',
            array(
                'section'     => 'about',
                'label'       => __( 'About Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the about layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/about/one.jpg',
                    'two'       => get_template_directory_uri() . '/images/about/two.jpg',
                ),
                'priority'    => -1
            )
        )
    );

    $wp_customize->add_setting(
        'about_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'about_note_text',
            array(
                'section'     => 'about',
                'description' => __( '<hr/>Add "Blossom: Featured Page" widget for about section.', 'blossom-shop-pro' ),
                'priority'    => -1
            )
        )
    );

    $about_section = $wp_customize->get_section( 'sidebar-widgets-about' );
    if ( ! empty( $about_section ) ) {

        $about_section->panel     = 'frontpage_settings';
        $about_section->priority  = 70;
        $wp_customize->get_control( 'about_note_text' )->section  = 'sidebar-widgets-about';
        $wp_customize->get_control( 'about_layout' )->section     = 'sidebar-widgets-about';
    }  
    
    /** About Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_about' );