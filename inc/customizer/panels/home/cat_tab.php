<?php
/**
 * Category Tab Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_cat_tab( $wp_customize ){

    if( ! is_woocommerce_activated() ){
        return false;
    }

    /** Category Tab Section */
    $wp_customize->add_section(
        'cat_tab_section',
        array(
            'title'    => __( 'Category Tab Section', 'blossom-shop-pro' ),
            'priority' => 65,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_cat_tab_active',
        )
    );

    /** Category Tab Custom */
    $wp_customize->add_setting( 
        new Blossom_Shop_Pro_Repeater_Setting( 
            $wp_customize, 
            'cat_tab_custom', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Blossom_Shop_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Control_Repeater(
            $wp_customize,
            'cat_tab_custom',
            array(
                'section' => 'cat_tab_section',                
                'label'   => __( 'Category Tabs', 'blossom-shop-pro' ),
                'fields'  => array(
                    'choose_cat' => array(
                        'type'    => 'select',
                        'label'   => __( 'Choose Category for Tabs', 'blossom-shop-pro' ),
                        'choices' => blossom_shop_pro_get_categories( true, 'product_cat' )
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'category', 'blossom-shop-pro' ),
                ),
                'limit'           => 8,                        
            )
        )
    );

    /** Category Tab Section Ends */  

}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_cat_tab' );