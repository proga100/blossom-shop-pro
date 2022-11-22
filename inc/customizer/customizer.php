<?php
/**
 * Blossom Shop Pro Theme Customizer
 *
 * @package Blossom_Shop_Pro
 */

/**
 * Requiring customizer panels & sections
*/
$blossom_shop_pro_panels       = array( 'appearance', 'layout', 'typography', 'home', 'about', 'contact', 'general' );
$blossom_shop_pro_sections     = array( 'site', 'child-theme-support', 'footer' );
$blossom_shop_pro_sub_sections = array(
    'appearance' => array( 'background', 'color' ),
    'layout'     => array( 'header', 'slider', 'blog', 'single-product', 'general', 'pagination' ),
    'typography' => array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
    'home'       => array( 'banner', 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'sort', 'onepage' ),
    'general'    => array( 'topbar', 'performance', 'sidebar', 'header', 'social', 'share', 'seo', 'post-page', 'instagram', 'newsletter', 'misc', 'shop', 'google-analytics' ),    
);

foreach( $blossom_shop_pro_sections as $s ){
    require get_template_directory() . '/inc/customizer/sections/' . $s . '.php';
}

foreach( $blossom_shop_pro_panels as $p ){
   require get_template_directory() . '/inc/customizer/panels/' . $p . '.php';
}

foreach( $blossom_shop_pro_sub_sections as $k => $v ){
    foreach( $v as $w ){        
        require get_template_directory() . '/inc/customizer/panels/' . $k . '/' . $w . '.php';
    }
}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blossom_shop_pro_customize_preview_js() {
	wp_enqueue_script( 'blossom-shop-pro-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), BLOSSOM_SHOP_PRO_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'blossom_shop_pro_customize_preview_js' );

function blossom_shop_pro_customize_script(){
    $array = array(
        'home'    => get_permalink( get_option( 'page_on_front' ) ),
        'about'   => blossom_shop_pro_get_page_template_url( 'templates/about.php' ),
        'service' => blossom_shop_pro_get_page_template_url( 'templates/service.php' ),
        'contact' => blossom_shop_pro_get_page_template_url( 'templates/contact.php' ),
    );
    wp_enqueue_style( 'blossom-shop-pro-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), BLOSSOM_SHOP_PRO_THEME_VERSION );
    wp_enqueue_script( 'blossom-shop-pro-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), BLOSSOM_SHOP_PRO_THEME_VERSION, true );
    wp_localize_script( 'blossom-shop-pro-customize', 'blossom_shop_pro_cdata', $array );

    wp_localize_script( 'blossom-shop-pro-repeater', 'blossom_shop_pro_customize',
        array(
            'nonce' => wp_create_nonce( 'blossom_shop_pro_customize_nonce' )
        )
    );
}
add_action( 'customize_controls_enqueue_scripts', 'blossom_shop_pro_customize_script' );

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/customizer-notice/class-customizer-notice.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';

$config_customizer = array(
	'recommended_plugins' => array(
		//change the slug for respective plugin recomendation
        'blossomthemes-toolkit' => array(
			'recommended' => true,
			'description' => sprintf(
				/* translators: %s: plugin name */
				esc_html__( 'If you want to take full advantage of the features this theme has to offer, please install and activate %s plugin.', 'blossom-shop-pro' ), '<strong>BlossomThemes Toolkit</strong>'
			),
		),
	),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'blossom-shop-pro' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'blossom-shop-pro' ),
	'activate_button_label'     => esc_html__( 'Activate', 'blossom-shop-pro' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'blossom-shop-pro' ),
);
Blossom_Shop_Pro_Customizer_Notice::init( apply_filters( 'blossom_shop_pro_customizer_notice_array', $config_customizer ) );