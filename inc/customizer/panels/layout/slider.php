<?php
/**
 * Slider Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout_slider( $wp_customize ) {
    
    /** Blog Page Layout Settings */
    $wp_customize->add_section(
        'slider_layout_settings',
        array(
            'title'    => __( 'Slider Layout', 'blossom-shop-pro' ),
            'priority' => 30,
            'panel'    => 'layout_settings',
        )
    );
    
    $wp_customize->add_setting( 
        'slider_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'slider_layout',
			array(
				'section'	  => 'slider_layout_settings',
				'label'		  => __( 'Slider Layout', 'blossom-shop-pro' ),
				'description' => __( 'Choose the layout of the slider for your site.', 'blossom-shop-pro' ),
				'choices'	  => array(
                    'one'   => get_template_directory_uri() . '/images/slider/one.jpg',
                    'two'   => get_template_directory_uri() . '/images/slider/two.jpg',
                    'three' => get_template_directory_uri() . '/images/slider/three.jpg',
                    'four'  => get_template_directory_uri() . '/images/slider/four.jpg',
                    'five'  => get_template_directory_uri() . '/images/slider/five.jpg',
                    'six'   => get_template_directory_uri() . '/images/slider/six.jpg',
				)
			)
		)
	);

    $wp_customize->add_setting(
        'slider_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'slider_layout_text',
            array(
                'section'     => 'slider_layout_settings',
                'description' => sprintf( __( '%1$sClick here%2$s to go to slider settings.', 'blossom-shop-pro' ), '<span class="text-inner-link slider_layout_text">', '</span>' ),
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout_slider' );