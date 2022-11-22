<?php
/**
 * Home Page Layout Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_layout_blog( $wp_customize ) {
    
    /** Blog Page Layout Settings */
    $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Blog Page Layout', 'blossom-shop-pro' ),
            'priority' => 40,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'blog_page_layout', 
        array(
            'default'           => 'classic-layout',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Image_Control(
			$wp_customize,
			'blog_page_layout',
			array(
				'section'	  => 'blog_layout',
				'label'		  => __( 'Blog Page Layout', 'blossom-shop-pro' ),
				'description' => __( 'Choose the blog page layout for your site.', 'blossom-shop-pro' ),
				'choices'	  => array(
                    'classic-layout' => get_template_directory_uri() . '/images/blog/classic.jpg',
                    'grid-layout'    => get_template_directory_uri() . '/images/blog/grid.jpg',
                    'list-layout'    => get_template_directory_uri() . '/images/blog/listing.jpg',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_layout_blog' );