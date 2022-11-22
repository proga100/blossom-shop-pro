<?php
/**
 * Typography H1 Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_typography_h1( $wp_customize ) {
    
    /** Body Settings */
    $wp_customize->add_section(
        'h1_settings',
        array(
            'title'    => __( 'H1 Settings (Content)', 'blossom-shop-pro' ),
            'priority' => 15,
            'panel'    => 'typography_settings'
        )
    );
    
    /** H1 Font */
    $wp_customize->add_setting( 
        'h1_font', 
        array(
            'default' => array(                                			
                'font-family' => 'Nunito Sans',
                'variant'     => '700',
            ),
            'sanitize_callback' => array( 'Blossom_Shop_Pro_Fonts', 'sanitize_typography' )
        ) 
    );

	$wp_customize->add_control( 
        new Blossom_Shop_Pro_Typography_Control( 
            $wp_customize, 
            'h1_font', 
            array(
                'label'   => __( 'H1 Font', 'blossom-shop-pro' ),
                'section' => 'h1_settings',
            ) 
        ) 
    );
        
    /** Font Size*/
    $wp_customize->add_setting( 
        'h1_font_size', 
        array(
            'default'           => 49,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Slider_Control( 
			$wp_customize,
			'h1_font_size',
			array(
				'section' => 'h1_settings',
				'label'	  => __( 'H1 Font Size', 'blossom-shop-pro' ),
                'choices' => array(
					'min' 	=> 10,
					'max' 	=> 75,
					'step'	=> 1,
				)                 
			)
		)
	);
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_typography_h1' );