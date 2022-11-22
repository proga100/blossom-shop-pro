<?php
/**
 * Product Single Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout_single_product( $wp_customize ) {
    
    /** Product Single Layout Settings */
    $wp_customize->add_section(
        'product_layout_settings',
        array(
            'title'    => __( 'Product Single Layout', 'blossom-shop-pro' ),
            'priority' => 50,
            'panel'    => 'layout_settings',
            'active_callback' => 'is_woocommerce_activated',
        )
    );
    
    $wp_customize->add_setting( 
        'single_product_layout', 
        array(
            'default'           => 'bsp-style-one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'single_product_layout',
			array(
				'section'	  => 'product_layout_settings',
				'label'		  => __( 'Single Product Layout', 'blossom-shop-pro' ),
				'description' => __( 'Choose the layout of the single-product for your site.', 'blossom-shop-pro' ),
				'choices'	  => array(
                    'bsp-style-one'   => get_template_directory_uri() . '/images/single-product/one.jpg',
                    'bsp-style-two'   => get_template_directory_uri() . '/images/single-product/two.jpg',
                    'bsp-style-three' => get_template_directory_uri() . '/images/single-product/three.jpg',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout_single_product' );