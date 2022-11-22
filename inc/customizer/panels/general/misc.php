<?php
/**
 * Miscellaneous Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_misc( $wp_customize ) {
    
    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'misc_settings',
        array(
            'title'    => __( 'Misc Settings', 'blossom-shop-pro' ),
            'priority' => 85,
            'panel'    => 'general_settings',
        )
    );
    
    /** Admin Bar */
    $wp_customize->add_setting(
        'ed_adminbar',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_adminbar',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Admin Bar', 'blossom-shop-pro' ),
				'description'	=> __( 'Disable to hide Admin Bar in frontend when logged in.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Lightbox */
    $wp_customize->add_setting(
        'ed_lightbox',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_lightbox',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Lightbox', 'blossom-shop-pro' ),
				'description'	=> __( 'A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'blossom-shop-pro' ),
			)
		)
	);
       
    /** Last Widget Sticky */
    $wp_customize->add_setting(
        'ed_last_widget_sticky',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_last_widget_sticky',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Last Widget Sticky', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable to stick last widget in sidebar.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Drop Cap */
    $wp_customize->add_setting(
        'ed_drop_cap',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_drop_cap',
			array(
				'section'		=> 'misc_settings',
				'label'			=> __( 'Drop Cap', 'blossom-shop-pro' ),
				'description'	=> __( 'Enable to show first letter of word in post/page content in drop cap.', 'blossom-shop-pro' ),
			)
		)
	);       

    /** Crop Disable */
    $wp_customize->add_setting( 
        'ed_crop_all', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_crop_all',
            array(
                'section'     => 'misc_settings',
                'label'       => __( 'Product Image Crop', 'blossom-shop-pro' ),
                'description' => __( 'Enable this to disable automatic cropping of product images on homepage sections.', 'blossom-shop-pro' ),
            )
        )
    );
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_misc' );