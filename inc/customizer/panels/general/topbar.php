<?php
/**
 * Top Bar Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_top_bar( $wp_customize ) {
    
    /** Top Bar Settings */
    $wp_customize->add_section(
        'top_bar_settings',
        array(
            'title'    => __( 'Top Bar Settings', 'blossom-shop-pro' ),
            'priority' => 5,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Top Bar */
    $wp_customize->add_setting( 
        'ed_top_bar', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_top_bar',
            array(
                'section'        => 'top_bar_settings',
                'label'          => __( 'Enable Top Bar', 'blossom-shop-pro' ),
                'description'    => __( 'Enable to show top bar on top of header.', 'blossom-shop-pro' ),
            )
        )
    );

    /** Top Bar Type */    
    $wp_customize->add_setting( 
        'top_bar_type', 
        array(
            'default'           => 'top_button_link',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Buttonset_Control(
            $wp_customize,
            'top_bar_type',
            array(
                'section'     => 'top_bar_settings',
                'label'       => __( 'Top Bar Type', 'blossom-shop-pro' ),
                'description' => __( 'You can add button link or newsletter in top bar', 'blossom-shop-pro' ),
                'active_callback'=> 'blossom_shop_pro_topbar',
                'choices'     => array(
                    'top_button_link'   => __( 'Button Link', 'blossom-shop-pro' ),
                    'top_newsletter'    => __( 'Newsletter', 'blossom-shop-pro' ),
                ),
            )
        )
    );

     /** Notification Text */
    $wp_customize->add_setting(
        'notification_text',
        array(
            'default'           => __( 'End of Season SALE now on thru 1/21.','blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage', 
        )
    );
    
    $wp_customize->add_control(
        'notification_text',
        array(
            'type'    => 'text',
            'section' => 'top_bar_settings',
            'label'   => __( 'Title', 'blossom-shop-pro' ),
            'active_callback' => 'blossom_shop_pro_topbar',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'notification_text', array(
        'selector' => '.sticky-bar-content .container span.get-notification-text',
        'render_callback' => 'blossom_shop_pro_get_notification_text',
    ) ); 

    /** Notification Button */
    $wp_customize->add_setting(
        'notification_label',
        array(
            'default'           => __( 'SHOP NOW','blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage', 
        )
    );
    
    $wp_customize->add_control(
        'notification_label',
        array(
            'type'    => 'text',
            'section' => 'top_bar_settings',
            'label'   => __( 'Button Label', 'blossom-shop-pro' ),
            'active_callback' => 'blossom_shop_pro_topbar',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'notification_label', array(
        'selector' => '.sticky-bar-content .container a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_notification_label',
    ) );

    /** Notification Button URL*/
    $wp_customize->add_setting(
        'notification_btn_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw', 
        )
    );
    
    $wp_customize->add_control(
        'notification_btn_url',
        array(
            'type'    => 'url',
            'section' => 'top_bar_settings',
            'label'   => __( 'Button URL', 'blossom-shop-pro' ),
            'active_callback' => 'blossom_shop_pro_topbar',
        )
    );

    /** Enable Notification in New Tab */
    $wp_customize->add_setting( 
        'ed_open_new_target', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_open_new_target',
            array(
                'section'         => 'top_bar_settings',
                'label'           => __( 'Enable to open in new window', 'blossom-shop-pro' ),
                'description'     => __( 'Enable/Disable to show the url to go in next window', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_topbar',

            )
        )
    );      

    $wp_customize->add_setting( 
        'top_bar_background_color', 
        array(
            'default'           => '#dde9ed',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'top_bar_background_color', 
            array(
                'label'       => __( 'Background Color', 'blossom-shop-pro' ),
                'description' => __( 'Background color for the topbar.', 'blossom-shop-pro' ),
                'section'     => 'top_bar_settings',
                'active_callback' => 'blossom_shop_pro_topbar',
            )
        )
    );   

    $wp_customize->add_setting( 
        'topbar_font_color', 
        array(
            'default'           => '#202020',
            'sanitize_callback' => 'sanitize_hex_color',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'topbar_font_color', 
            array(
                'label'       => __( 'Top Bar Font Color', 'blossom-shop-pro' ),
                'description' => __( 'Font color of the top bar section.', 'blossom-shop-pro' ),
                'section'     => 'top_bar_settings',
                'active_callback' => 'blossom_shop_pro_topbar',
            )
        )
    ); 

    /** Top Bar Newsletter Shortcode */
    if (is_btnw_activated()) {
        $wp_customize->add_setting(
            'header_newsletter_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field' 
            )
        );
        
        $wp_customize->add_control(
            'header_newsletter_shortcode',
            array(
                'type'            => 'text',
                'section'         => 'top_bar_settings',
                'label'           => __( 'Header Newsletter Shortcode', 'blossom-shop-pro' ),
                'description'     => __( 'Enter the shortcode here.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_topbar',
            )
        );
    }else{

        $wp_customize->add_setting(
            'header_newsletter_note',
            array(
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Plugin_Recommend_Control(
                $wp_customize,
                'header_newsletter_note',
                array(
                    'section' => 'top_bar_settings',
                    'label' => __('Header Newsletter Shortcode', 'blossom-shop-pro'),
                    'capability' => 'install_plugins',
                    'plugin_slug' => 'blossomthemes-email-newsletter',
                    'description' => sprintf(__('Please install and activate the recommended plugin %1$sBlossomThemes Email Newsletter%2$s.', 'blossom-shop-pro'), '<strong>', '</strong>'),
                    'active_callback' => 'blossom_shop_pro_topbar',
                )
            )
        );

    }
    
    /** Top Bar Settings Ends */
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_top_bar' );