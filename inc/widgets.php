<?php
/**
 * Blossom Shop Pro Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'blossom-shop-pro' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'blossom-shop-pro' ),
        ),
        'service' => array(
            'name'        => __( 'Service Section', 'blossom-shop-pro' ),
            'id'          => 'service', 
            'description' => __( 'Add "Text" and "Blossom: Icon Text" widget for service section.', 'blossom-shop-pro' ),
        ),
        'about' => array(
            'name'        => __( 'About Section', 'blossom-shop-pro' ),
            'id'          => 'about', 
            'description' => __( 'Add "Blossom: Featured Page" widget for about section.', 'blossom-shop-pro' ),
        ),
        'cta' => array(
            'name'        => __( 'Call To Action Section', 'blossom-shop-pro' ),
            'id'          => 'cta', 
            'description' => __( 'Add "Blossom: Call To Action" widget for Call to Action section.', 'blossom-shop-pro' ),
        ),
        'testimonial' => array(
            'name'        => __( 'Testimonial Section', 'blossom-shop-pro' ),
            'id'          => 'testimonial', 
            'description' => __( 'Add "Blossom: Testimonial" widget for testimonial section.', 'blossom-shop-pro' ),
        ),
        'client' => array(
            'name'        => __( 'Client Section', 'blossom-shop-pro' ),
            'id'          => 'client', 
            'description' => __( 'Add "Blossom: Client Logo" widget for client section.', 'blossom-shop-pro' ),
        ),
        'featured' => array(
            'name'        => __( 'Blog Featured Section', 'blossom-shop-pro' ),
            'id'          => 'featured', 
            'description' => __( 'Add "Blossom: Image Text" widget for featured section. It is recommended to upload the same dimension for all the featured boxes to avoid inconsistency.', 'blossom-shop-pro' ),
        ),
        'about-intro' => array(
            'name'        => __( 'About Intro Section', 'blossom-shop-pro' ),
            'id'          => 'about-intro', 
            'description' => __( 'Add "Blossom: Featured Page" widget for about intro section.', 'blossom-shop-pro' ),
        ),
        'about-testimonial' => array(
            'name'        => __( 'About Testimonial Section', 'blossom-shop-pro' ),
            'id'          => 'about-testimonial', 
            'description' => __( 'Add "Blossom: Testimonial" widget for about testimonial section.', 'blossom-shop-pro' ),
        ),
        'about-client' => array(
            'name'        => __( 'About Client Section', 'blossom-shop-pro' ),
            'id'          => 'about-client', 
            'description' => __( 'Add "Blossom: Client Logo" widget for about client section.', 'blossom-shop-pro' ),
        ),
        'contact-form-template' => array(
            'name'        => __( 'Contact Form Section', 'blossom-shop-pro' ),
            'id'          => 'contact-form-template', 
            'description' => __( 'Add "Text" widget for contact form section.', 'blossom-shop-pro' ),
        ),
        'contact-template' => array(
            'name'        => __( 'Contact Section', 'blossom-shop-pro' ),
            'id'          => 'contact-template', 
            'description' => __( 'Add "Blossom: Contact" and "Custom HTML" widget for contact section.', 'blossom-shop-pro' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'blossom-shop-pro' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'blossom-shop-pro' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'blossom-shop-pro' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'blossom-shop-pro' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-five'=> array(
            'name'        => __( 'Footer Five', 'blossom-shop-pro' ),
            'id'          => 'footer-five', 
            'description' => __( 'Add footer five widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-six'=> array(
            'name'        => __( 'Footer Six', 'blossom-shop-pro' ),
            'id'          => 'footer-six', 
            'description' => __( 'Add footer six widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-seven'=> array(
            'name'        => __( 'Footer Seven', 'blossom-shop-pro' ),
            'id'          => 'footer-seven', 
            'description' => __( 'Add footer seven widgets here.', 'blossom-shop-pro' ),
        ),
        'footer-eight'=> array(
            'name'        => __( 'Footer Eight', 'blossom-shop-pro' ),
            'id'          => 'footer-eight', 
            'description' => __( 'Add footer eight widgets here.', 'blossom-shop-pro' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
    
    /** Dynamic sidebars */
    $dynamic_sidebars = blossom_shop_pro_get_dynamnic_sidebar();
    
    foreach( $dynamic_sidebars as $k => $v ){
        if( ! empty( $v ) ){
            register_sidebar( array(
                'name'          => esc_attr( $v ),
                'id'            => esc_attr( $k ),
                'description'   => '',
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );
        }
    }
}
add_action( 'widgets_init', 'blossom_shop_pro_widgets_init' );