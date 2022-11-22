<?php
/**
 * Child Theme Settings
 *
 *@package Blossom_Shop_Pro
*/

function blossom_shop_pro_customize_register_general_child_support( $wp_customize ) {

	/** Child Support Settings */
    $wp_customize->add_section(
        'child_support_settings',
        array(
            'title'    => __( 'Child Theme Support Settings', 'blossom-shop-pro' ),
            'priority' => 24,
        )
    );

    /** Child Support Description */
    $wp_customize->add_setting( 
        'child_additional_support', 
        array(
            'default'           => 'default',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        ) 
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control( 
            $wp_customize,
            'child_additional_support',
            array(
                'section'     => 'child_support_settings',
                'label'       => __( 'Child Theme Style', 'blossom-shop-pro' ),
                'description' => __( 'Select respective child theme style from the drop-down below.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'default'   => __( 'Default', 'blossom-shop-pro' ),
                    'ecommerce' => __( 'Blossom Ecommerce', 'blossom-shop-pro' )
                ),
            )
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'blossom_ecommerce_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'blossom_ecommerce_text',
            array(
                'section'     => 'child_support_settings',
                'description' => sprintf(__( 'To achieve the exact layout of "Blossom Ecommerce" child theme, please select the %1$ssecond header layout%2$s', 'blossom-shop-pro' ), '<span class="child-inner-link h-layout">', '</span>' ),
                'active_callback' => 'blossom_shop_pro_theme_support_callback',
            )
        )
    );

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_child_support' );

/**
* Active Callback
*/
function blossom_shop_pro_theme_support_callback( $control ){

    $child_theme_support    = $control->manager->get_setting( 'child_additional_support' )->value();
    $control_id             = $control->id;

    if ( $control_id == 'blossom_ecommerce_text' && $child_theme_support == 'ecommerce' ) return true;        

    return false;
}