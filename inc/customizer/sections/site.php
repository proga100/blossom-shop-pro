<?php
/**
 * Site Title Setting
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register( $wp_customize ) {
	
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
	
	if( isset( $wp_customize->selective_refresh ) ){
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'blossom_shop_pro_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'blossom_shop_pro_customize_partial_blogdescription',
		) );
	}
    
    /** Site Title Font */
    $wp_customize->add_setting( 
        'site_title_font', 
        array(
            'default' => array(                                			
                'font-family' => 'Cormorant',
                'variant'     => 'regular',
            ),
            'sanitize_callback' => array( 'Blossom_Shop_Pro_Fonts', 'sanitize_typography' )
        ) 
    );

	$wp_customize->add_control( 
        new Blossom_Shop_Pro_Typography_Control( 
            $wp_customize, 
            'site_title_font', 
            array(
                'label'       => __( 'Site Title Font', 'blossom-shop-pro' ),
                'description' => __( 'Site title and tagline font.', 'blossom-shop-pro' ),
                'section'     => 'title_tagline',
                'priority'    => 60, 
            ) 
        ) 
    );
    
    /** Site Title Font Size*/
    $wp_customize->add_setting( 
        'site_title_font_size', 
        array(
            'default'           => 20,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Slider_Control( 
			$wp_customize,
			'site_title_font_size',
			array(
				'section'	  => 'title_tagline',
				'label'		  => __( 'Site Title Font Size', 'blossom-shop-pro' ),
				'description' => __( 'Change the font size of your site title.', 'blossom-shop-pro' ),
                'priority'    => 65,
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 200,
					'step'	=> 1,
				)                 
			)
		)
	);
    
    /** Site Title Color*/
    $wp_customize->add_setting( 
        'site_title_color', 
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'site_title_color', 
            array(
                'label'       => __( 'Site Title Color', 'blossom-shop-pro' ),
                'description' => __( 'Site Title color of the theme.', 'blossom-shop-pro' ),
                'section'     => 'title_tagline',
                'priority'    => 66,
            )
        )
    );

    /** Site Logo Size */
    $wp_customize->add_setting(
        'site_logo_size',
        array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint',
            'default' => 70, 
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'site_logo_size',
        array(
            'type' => 'number',
            'section' => 'title_tagline', 
            'label' => __( 'Set the width(px) of your Site Logo', 'blossom-shop-pro' ),
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register' );