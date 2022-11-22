<?php
/**
 * Performance Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_performance( $wp_customize ) {
    
    /** Performance Settings */
    $wp_customize->add_section(
        'performance_settings',
        array(
            'title'    => __( 'Performance Settings', 'blossom-shop-pro' ),
            'priority' => 60,
            'panel'    => 'general_settings',
        )
    );
    
    /** Lazy Load */
    $wp_customize->add_setting(
        'ed_lazy_load',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_lazy_load',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable lazy loading of featured images.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Lazy Load Content Images */
    $wp_customize->add_setting(
        'ed_lazy_load_cimage',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_lazy_load_cimage',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load Content Images', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable lazy loading of images inside page/post content.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Lazy Load Gravatar */
    $wp_customize->add_setting(
        'ed_lazyload_gravatar',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_lazyload_gravatar',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Lazy Load Gravatar', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable lazy loading of gravatar image.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Defer JavaScript */
    $wp_customize->add_setting(
        'ed_defer',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_defer',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Defer JavaScript', 'blossom-shop-pro' ),
				'description'	=> __( 'Adds "defer" attribute to sript tags to improve page download speed.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Sticky Header */
    $wp_customize->add_setting(
        'ed_ver',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_ver',
			array(
				'section'		=> 'performance_settings',
				'label'			=> __( 'Remove ver parameters', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable to remove "ver" parameter from CSS and JS file calls.', 'blossom-shop-pro' ),
			)
		)
	);

    /** Locally Host Google Fonts */
    $wp_customize->add_setting(
        'ed_googlefont_local',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_googlefont_local',
            array(
                'section'       => 'performance_settings',
                'label'         => __( 'Locally Host Google Fonts', 'blossom-shop-pro' ),
                'description'   => sprintf( __( 'Enable to load google fonts from your own server instead from google\'s CDN. This solves privacy concerns with Google\'s CDN and their sometimes less-than-transparent policies. %1$sBack to Typography%2$s', 'blossom-shop-pro' ), '<span class="text-inner-link ed_googlefont_local">', '</span>' )
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_performance' );