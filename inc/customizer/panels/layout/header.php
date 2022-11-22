<?php
/**
 * Header Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout_header( $wp_customize ) {
    
    /** Header Layout Settings */
    $wp_customize->add_section(
        'header_layout_settings',
        array(
            'title'    => __( 'Header Layout', 'blossom-shop-pro' ),
            'priority' => 10,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'header_layout', 
        array(
            'default'           => 'three',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'header_layout',
			array(
				'section'	  => 'header_layout_settings',
				'label'		  => __( 'Header Layout', 'blossom-shop-pro' ),
				'description' => __( 'Choose the layout of the header for your site.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'one'   => get_template_directory_uri() . '/images/header/one.jpg',
					'two'   => get_template_directory_uri() . '/images/header/two.jpg',
                    'three' => get_template_directory_uri() . '/images/header/three.jpg',
                    'four'  => get_template_directory_uri() . '/images/header/four.jpg',
                    'five'  => get_template_directory_uri() . '/images/header/five.jpg',
                    'six'   => get_template_directory_uri() . '/images/header/six.jpg',
                    'seven' => get_template_directory_uri() . '/images/header/seven.jpg',
                    'eight' => get_template_directory_uri() . '/images/header/eight.jpg',
                    'nine'  => get_template_directory_uri() . '/images/header/nine.jpg',
                    'ten'   => get_template_directory_uri() . '/images/header/ten.jpg',
                    'eleven'=> get_template_directory_uri() . '/images/header/eleven.jpg',
                    'twelve'=> get_template_directory_uri() . '/images/header/twelve.jpg',
				)
			)
		)
	);

    $wp_customize->add_setting(
        'header_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'header_layout_text',
            array(
                'section'     => 'header_layout_settings',
                'description' => sprintf( __( '%1$sClick here%2$s to go to header settings.', 'blossom-shop-pro' ), '<span class="text-inner-link header_layout_text">', '</span>' ),
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout_header' );