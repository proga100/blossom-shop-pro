<?php
/**
 * General Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout_general( $wp_customize ) {
    
    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'general_layout_settings',
        array(
            'title'    => __( 'General Sidebar Layout', 'blossom-shop-pro' ),
            'priority' => 55,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Page Sidebar Layout', 'blossom-shop-pro' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Post Sidebar Layout', 'blossom-shop-pro' ),
				'description' => __( 'This is the general sidebar layout for posts & custom post. You can override the sidebar layout for individual post in respective post.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'centered'      => get_template_directory_uri() . '/images/1cc.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'general_layout_settings',
				'label'		  => __( 'Default Sidebar Layout', 'blossom-shop-pro' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/1c.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/images/2cl.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/2cr.jpg',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout_general' );