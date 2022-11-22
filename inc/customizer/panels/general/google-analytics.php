<?php
/**
 * Google Analytics Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_google_analytics( $wp_customize ) {
    
    /** Google Analytics Settings */
    $wp_customize->add_section(
        'google_analytics_settings',
        array(
            'title'    => __( 'Google Analytics Settings', 'blossom-shop-pro' ),
            'priority' => 90,
            'panel'    => 'general_settings',
        )
    );
    
    /** After Content AD Code */
    $wp_customize->add_setting(
        'google_analytics_ad_code',
        array(
            'default' => '',
        )
    );
        
    $wp_customize->add_control( 
        new WP_Customize_Code_Editor_Control(
            $wp_customize, 
            'google_analytics_ad_code',
            array(
                'section'     => 'google_analytics_settings',
                'label'       => __( 'Analytics Code', 'blossom-shop-pro' ),
                'description' => __( 'Paste your google analytics code here.', 'blossom-shop-pro' ),
                'code_type'   => 'javascript',              
            )
        )       
    );
    
    /** Google Analytics Settings Ends */
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_google_analytics' );

