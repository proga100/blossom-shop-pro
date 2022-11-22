<?php
/**
 * Typography Body Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_typography_body( $wp_customize ) {
    
    /** Body Settings */
    $wp_customize->add_section(
        'body_settings',
        array(
            'title'    => __( 'Body Settings', 'blossom-shop-pro' ),
            'priority' => 10,
            'panel'    => 'typography_settings'
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'google_fonts_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'google_fonts_text',
            array(
                'section'     => 'body_settings',
                'description' => sprintf( __( '%1$sClick here%2$s to see the list of supported Google Fonts.', 'blossom-shop-pro' ), '<a href="' . esc_url( 'https://fonts.google.com/' ) . '" target="_blank">', '</a>' ),
            )
        )
    );

    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Nunito Sans',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'blossom-shop-pro' ),
                'description' => __( 'Primary font of the site.', 'blossom-shop-pro' ),
    			'section'     => 'body_settings',
    			'choices'     => blossom_shop_pro_get_all_fonts(),	
                'active_callback' => 'blossom_shop_pro_fonts_callback',
     		)
		)
	);
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Cormorant',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'blossom-shop-pro' ),
                'description' => __( 'Secondary font of the site.', 'blossom-shop-pro' ),
    			'section'     => 'body_settings',
    			'choices'     => blossom_shop_pro_get_all_fonts(),	
                'active_callback' => 'blossom_shop_pro_fonts_callback',
     		)
		)
	);  

     /** Blossom Ecommerce */
    /** Primary Font */
    $wp_customize->add_setting(
        'primary_font_be',
        array(
            'default'           => 'DM Sans',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'primary_font_be',
            array(
                'label'       => __( 'Primary Font', 'blossom-shop-pro' ),
                'description' => __( 'Primary font of the site.', 'blossom-shop-pro' ),
                'section'     => 'body_settings',
                'choices'     => blossom_shop_pro_get_all_fonts(),
                'active_callback' => 'blossom_shop_pro_fonts_callback',
            )
        )
    );
    
    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font_be',
        array(
            'default'           => 'DM Serif Display',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'secondary_font_be',
            array(
                'label'       => __( 'Secondary Font', 'blossom-shop-pro' ),
                'description' => __( 'Secondary font of the site.', 'blossom-shop-pro' ),
                'section'     => 'body_settings',
                'choices'     => blossom_shop_pro_get_all_fonts(),
                'active_callback' => 'blossom_shop_pro_fonts_callback',
            )
        )
    );
        
    /** Font Size*/
    $wp_customize->add_setting( 
        'font_size', 
        array(
            'default'           => 20,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Slider_Control( 
			$wp_customize,
			'font_size',
			array(
				'section'	  => 'body_settings',
				'label'		  => __( 'Font Size', 'blossom-shop-pro' ),
				'description' => __( 'Change the font size of your site.', 'blossom-shop-pro' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 50,
					'step'	=> 1,
				)                 
			)
		)
	);

    /** Note */
    $wp_customize->add_setting(
        'typography_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'typography_text',
            array(
                'section'     => 'body_settings',
                'description' => sprintf( __( 'To load google fonts from your own server instead from google\'s CDN enable the %1$sLocally Host Google Fonts%2$s option in Performance Settings.', 'blossom-shop-pro' ), '<span class="text-inner-link typography_text">', '</span>' ),
            )
        )
    );
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_typography_body' );