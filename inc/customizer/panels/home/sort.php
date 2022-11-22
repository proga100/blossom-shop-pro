<?php
/**
 * Sort front Page Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_sort( $wp_customize ){
    
    /** Sort Front Page Section */
    $wp_customize->add_section(
        'sort_front_page_settings',
        array(
            'title'    => __( 'Sort Front Page Section', 'blossom-shop-pro' ),
            'priority' => 120,
            'panel'    => 'frontpage_settings',
        )
    );
    
    /** Sort Front Page Section Section */
    $wp_customize->add_setting(
		'front_sort', 
		array(
			'default' => array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ),
			'sanitize_callback' => 'blossom_shop_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Sortable_Control(
			$wp_customize,
			'front_sort',
			array(
				'section'     => 'sort_front_page_settings',
				'label'       => __( 'Sort Sections', 'blossom-shop-pro' ),
				'description' => __( 'Sort or toggle front page sections.', 'blossom-shop-pro' ),
				'choices'     => array(
            		'service'	  => __( 'Service Section', 'blossom-shop-pro' ),
                    'recent_product'=> __( 'Recent Product Section', 'blossom-shop-pro' ),
                    'featured'    => __( 'Featured Section', 'blossom-shop-pro' ),
            		'popular_product'=> __( 'Popular Product Section', 'blossom-shop-pro' ),
                    'product_deal'=> __( 'Product Deal Section', 'blossom-shop-pro' ),
                    'cat_one'     => __( 'Category One Section', 'blossom-shop-pro' ),
                    'cat_tab'     => __( 'Category Tab Section', 'blossom-shop-pro' ),
                    'cat_two'     => __( 'Category Two Section', 'blossom-shop-pro' ),
            		'about'       => __( 'About Section', 'blossom-shop-pro' ),
                    'cat_three'   => __( 'Category Three Section', 'blossom-shop-pro' ),
                    'cat_four'    => __( 'Category Four Section', 'blossom-shop-pro' ),
                    'testimonial' => __( 'Testimonial Section', 'blossom-shop-pro' ),
                    'cta'         => __( 'Call To Action Section', 'blossom-shop-pro' ),
                    'blog'        => __( 'Blog Section', 'blossom-shop-pro' ),
                    'client'      => __( 'Client Section', 'blossom-shop-pro' ),
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_sort' );