<?php
/**
 * Footer Setting
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'blossom-shop-pro' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Phone */
    $wp_customize->add_setting(
        'phone_label',
        array(
            'default'           => __( 'Phone Number', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'phone_label',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Phone Label', 'blossom-shop-pro' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'phone_label', array(
        'selector' => '.footer-contact-section .section-block  .block-content-wrap .phone-label',
        'render_callback' => 'blossom_shop_pro_get_phone_label',
    ) );
    
    $wp_customize->add_setting(
        'phone',
        array(
            'default'           => '1-888-123-456',
            'sanitize_callback' => 'sanitize_text_field', 
        )
    );
    
    $wp_customize->add_control(
        'phone',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Phone', 'blossom-shop-pro' ),
        )
    );
    
    /** Email */
    $wp_customize->add_setting(
        'email_label',
        array(
            'default'           => __( 'Email', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'email_label',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Email Label', 'blossom-shop-pro' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'email_label', array(
        'selector' => '.footer-contact-section .section-block  .block-content-wrap .email-label',
        'render_callback' => 'blossom_shop_pro_get_email_label',
    ) );

    $wp_customize->add_setting(
        'email',
        array(
            'default'           => __( 'mail@mysite.com', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_email', 
        )
    );
    
    $wp_customize->add_control(
        'email',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Email', 'blossom-shop-pro' ),
        )
    );

    /** Opening Hours */
    $wp_customize->add_setting(
        'opening_hours_label',
        array(
            'default'           => __( 'Opening Hours', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'opening_hours_label',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Opening Hours Label', 'blossom-shop-pro' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'opening_hours_label', array(
        'selector' => '.footer-contact-section .section-block  .block-content-wrap .opening-label',
        'render_callback' => 'blossom_shop_pro_get_opening_hours_label',
    ) );

    $wp_customize->add_setting(
        'opening_hours',
        array(
            'default'           => __( 'Mon - Fri: 7AM - 9PM', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field', 
        )
    );
    
    $wp_customize->add_control(
        'opening_hours',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Opening Hours', 'blossom-shop-pro' ),
        )
    );

    /** Whats App */
    $wp_customize->add_setting(
        'whats_app_label',
        array(
            'default'           => __( 'WHATSAPP', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'whats_app_label',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Whats App Label', 'blossom-shop-pro' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'whats_app_label', array(
        'selector' => '.footer-contact-section .section-block  .block-content-wrap .whatsapp-label',
        'render_callback' => 'blossom_shop_pro_get_whats_app_label',
    ) );

    $wp_customize->add_setting(
        'whats_app',
        array(
            'default'           => '1-888-123-456',
            'sanitize_callback' => 'sanitize_text_field', 
        )
    );
    
    $wp_customize->add_control(
        'whats_app',
        array(
            'type'    => 'text',
            'section' => 'footer_settings',
            'label'   => __( 'Whats App Number', 'blossom-shop-pro' ),
        )
    );

    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'blossom-shop-pro' ),
            'description' => __( 'You can change footer copyright and use your own custom text from here. Use [the-year] shortcode to display current year & [the-site-link] shortcode to display site link.', 'blossom-shop-pro' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.site-info .copyright',
        'render_callback' => 'blossom_shop_pro_get_footer_copyright',
    ) );
    
    /** Hide Author Link */
    $wp_customize->add_setting(
        'ed_author_link',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_author_link',
			array(
				'section' => 'footer_settings',
				'label'	  => __( 'Hide Author Link', 'blossom-shop-pro' ),
			)
		)
	);
    
    $wp_customize->selective_refresh->add_partial( 'ed_author_link', array(
        'selector' => '.site-info .author-link',
        'render_callback' => 'blossom_shop_pro_ed_author_link',
    ) );
    
    /** Hide WordPress Link */
    $wp_customize->add_setting(
        'ed_wp_link',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_wp_link',
			array(
				'section' => 'footer_settings',
				'label'	  => __( 'Hide WordPress Link', 'blossom-shop-pro' ),
			)
		)
	);
    
    $wp_customize->selective_refresh->add_partial( 'ed_wp_link', array(
        'selector' => '.site-info .wp-link',
        'render_callback' => 'blossom_shop_pro_ed_wp_link',
    ) );
    
    $wp_customize->add_setting( 'footer_payment_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Image_Control( $wp_customize, 'footer_payment_image',
            array(
                'label'         => esc_html__( 'Payment Support Image', 'blossom-shop-pro' ),
                'description'   => esc_html__( 'Recommended Image size is 300px by 25px.', 'blossom-shop-pro' ),
                'section'       => 'footer_settings',
                'type'          => 'image'
            )
        )
    );
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_footer' );