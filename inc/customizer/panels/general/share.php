<?php
/**
 * Social Sharing Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_sharing( $wp_customize ) {
	
    /** Social Sharing */
    $wp_customize->add_section(
        'social_sharing',
        array(
            'title'    => __( 'Social Sharing', 'blossom-shop-pro' ),
            'priority' => 31,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Sharing Buttons */
    $wp_customize->add_setting(
        'ed_social_sharing',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_social_sharing',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Enable Social Sharing Buttons', 'blossom-shop-pro' ),
                'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Enable Social Sharing Buttons */
    $wp_customize->add_setting(
        'ed_og_tags',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_og_tags',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Enable Open Graph Meta Tags', 'blossom-shop-pro' ),
                'description' => __( 'Disable this option if you\'re using Jetpack, Yoast or other plugin to maintain Open Graph meta tags.', 'blossom-shop-pro' ),
			)
		)
	);

    /** Read More Text */
    $wp_customize->add_setting(
        'share_title',
        array(
            'default'           => __( 'Share', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'share_title',
        array(
            'type'    => 'text',
            'section' => 'social_sharing',
            'label'   => __( 'Social Share Title', 'blossom-shop-pro' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'share_title', array(
        'selector' => '.article-meta .social-share .share-title',
        'render_callback' => 'blossom_shop_pro_get_share_title',
    ) );
    
    /** Social Sharing Buttons */
    $wp_customize->add_setting(
		'social_share', 
		array(
			'default' => array( 'facebook', 'twitter', 'pinterest', 'linkedin' ),
			'sanitize_callback' => 'blossom_shop_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Sortable_Control(
			$wp_customize,
			'social_share',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Social Sharing Buttons', 'blossom-shop-pro' ),
				'description' => __( 'Sort or toggle social sharing buttons.', 'blossom-shop-pro' ),
				'choices'     => array(
            		'facebook'  => __( 'Facebook', 'blossom-shop-pro' ),
            		'twitter'   => __( 'Twitter', 'blossom-shop-pro' ),
            		'pinterest' => __( 'Pinterest', 'blossom-shop-pro' ),
                    'linkedin'  => __( 'Linkedin', 'blossom-shop-pro' ),            		
            		'email'     => __( 'Email', 'blossom-shop-pro' ),
            		'reddit'    => __( 'Reddit', 'blossom-shop-pro' ),
                    'tumblr'    => __( 'Tumblr', 'blossom-shop-pro' ),
                    'digg'      => __( 'Digg', 'blossom-shop-pro' ),
                    'weibo'     => __( 'Weibo', 'blossom-shop-pro' ),
                    'xing'      => __( 'Xing', 'blossom-shop-pro' ),
                    'vk'        => __( 'VK', 'blossom-shop-pro' ),
                    'pocket'    => __( 'GetPocket', 'blossom-shop-pro' ),  
                    'whatsapp'  => __( 'Whatsapp', 'blossom-shop-pro' ),
                    'telegram'  => __( 'Telegram', 'blossom-shop-pro' ),           
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_sharing' );