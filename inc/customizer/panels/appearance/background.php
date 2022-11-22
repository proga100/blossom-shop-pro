<?php
/**
 * Background Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_appearance_background( $wp_customize ) {
    
    /** Body Background */
    $wp_customize->add_setting( 
        'body_bg', 
        array(
            'default'           => 'image',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Buttonset_Control(
			$wp_customize,
			'body_bg',
			array(
				'section'	  => 'background_image',
				'label'       => __( 'Body Background', 'blossom-shop-pro' ),
                'description' => __( 'Choose body background as image or pattern.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'image'   => __( 'Image', 'blossom-shop-pro' ),
                    'pattern' => __( 'Pattern', 'blossom-shop-pro' ),
				),
                'priority'    => 5
			)
		)
	);
    
    /** Background Pattern */
    $wp_customize->add_setting( 
        'bg_pattern', array(
            'default'           => 'nobg',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'bg_pattern',
			array(
				'section'		  => 'background_image',
				'label'			  => __( 'Background Pattern', 'blossom-shop-pro' ),
				'description'	  => __( 'Choose from any of 64 awesome background patterns for your site background.', 'blossom-shop-pro' ),
				'choices'         => blossom_shop_pro_get_patterns(),
                'active_callback' => 'blossom_shop_pro_body_bg_choice'
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_appearance_background' );