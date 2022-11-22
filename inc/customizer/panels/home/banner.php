<?php
/**
 * Banner Section
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_frontpage_banner( $wp_customize ) {
	
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'blossom-shop-pro' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'blossom_shop_pro_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'blossom_shop_pro_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'blossom_shop_pro_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'slider_banner',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'blossom-shop-pro' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'blossom-shop-pro' ),
    			'section'     => 'header_image',
    			'choices'     => blossom_shop_pro_banner_types(),
                'priority' => 5	
     		)            
		)
	);
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Find Your Best Holiday', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Title', 'blossom-shop-pro' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.site-banner .banner-caption h2.banner-title',
        'render_callback' => 'blossom_shop_pro_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Find great adventure holidays and activities around the planet.', 'blossom-shop-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Sub Title', 'blossom-shop-pro' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector' => '.site-banner .banner-caption .banner-desc',
        'render_callback' => 'blossom_shop_pro_get_banner_subtitle',
    ) );
    
    /** Banner Label */
    $wp_customize->add_setting(
        'banner_label',
        array(
            'default'           => __( 'Purchase', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_label',
        array(
            'label'           => __( 'Banner Label', 'blossom-shop-pro' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_label', array(
        'selector' => '.site-banner .banner-caption a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_banner_label',
    ) );
    
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link',
        array(
            'label'           => __( 'Banner Link', 'blossom-shop-pro' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );
    
    /** Banner Newsletter */
    $wp_customize->add_setting(
        'banner_newsletter',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'banner_newsletter',
        array(
            'label'           => __( 'Banner Newsletter', 'blossom-shop-pro' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );
    
    /** Slider Content Style */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	  => __( 'Slider Content Style', 'blossom-shop-pro' ),
    			'section' => 'header_image',
    			'choices' => blossom_shop_pro_banner_options(),
                'active_callback' => 'blossom_shop_pro_banner_ac'	
     		)
		)
	);
    
    /** Slider Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	          => __( 'Slider Category', 'blossom-shop-pro' ),
    			'section'         => 'header_image',
    			'choices'         => blossom_shop_pro_get_categories(),
                'active_callback' => 'blossom_shop_pro_banner_ac'	
     		)
		)
	);

    if( is_woocommerce_activated() ) {

        /** Slider Products Category */
        $wp_customize->add_setting(
            'slider_cat_product',
            array(
                'default'           => '',
                'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Select_Control(
                $wp_customize,
                'slider_cat_product',
                array(
                    'label'           => __( 'Products Category', 'blossom-shop-pro' ),
                    'section'         => 'header_image',
                    'choices'         => blossom_shop_pro_get_categories( true, 'product_cat' ),
                    'active_callback' => 'blossom_shop_pro_banner_ac'   
                )
            )
        );
    }
    
    /** No. of slides */
    $wp_customize->add_setting(
        'no_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Slider_Control( 
			$wp_customize,
			'no_of_slides',
			array(
				'section'     => 'header_image',
                'label'       => __( 'Number of Slides', 'blossom-shop-pro' ),
                'description' => __( 'Choose the number of slides you want to display', 'blossom-shop-pro' ),
                'choices'	  => array(
					'min' 	=> 1,
					'max' 	=> 20,
					'step'	=> 1,
				),
                'active_callback' => 'blossom_shop_pro_banner_ac'                 
			)
		)
	);
    
    /** Slider Pages */
    $wp_customize->add_setting( 
        new Blossom_Shop_Pro_Repeater_Setting( 
            $wp_customize, 
            'slider_pages', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Blossom_Shop_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Control_Repeater(
			$wp_customize,
			'slider_pages',
			array(
				'section' => 'header_image',				
				'label'	  => __( 'Slider Pages ', 'blossom-shop-pro' ),
				'fields'  => array(
                    'page' => array(
                        'type'    => 'select',
                        'label'   => __( 'Select Page for slider', 'blossom-shop-pro' ),
                        'choices' => blossom_shop_pro_get_posts( 'page', true )
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'pages', 'blossom-shop-pro' ),
                    'field' => 'page'
                ),
                'active_callback' => 'blossom_shop_pro_banner_ac'                        
			)
		)
	);
    
    /** Add Slides */
    $wp_customize->add_setting( 
        new Blossom_Shop_Pro_Repeater_Setting( 
            $wp_customize, 
            'slider_custom', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Blossom_Shop_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Control_Repeater(
			$wp_customize,
			'slider_custom',
			array(
				'section' => 'header_image',				
				'label'	  => __( 'Add Sliders', 'blossom-shop-pro' ),
                'fields'  => array(
                    'thumbnail' => array(
                        'type'  => 'image', 
                        'label' => __( 'Add Image', 'blossom-shop-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'textarea',
                        'label' => __( 'Title', 'blossom-shop-pro' ),
                    ),
                    'subtitle'   => array(
                        'type'  => 'text',
                        'label' => __( 'Subtitle', 'blossom-shop-pro' ),
                    ),
                    'link'     => array(
                        'type'  => 'text',
                        'label' => __( 'Link', 'blossom-shop-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'Slide', 'blossom-shop-pro' ),
                    'field' => 'title'
                ),
                'active_callback' => 'blossom_shop_pro_banner_ac'                                              
			)
		)
	);
    
    /** HR */
    $wp_customize->add_setting(
        'hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'hr',
            array(
                'section'     => 'header_image',
                'description' => '<hr/>',
                'active_callback' => 'blossom_shop_pro_banner_ac'
            )
        )
    ); 

    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'slider_caption',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Caption', 'blossom-shop-pro' ),
                'description' => __( 'Enable slider caption.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_banner_ac'
            )
        )
    );

    $wp_customize->add_setting( 
        'banner_caption_layout', 
        array(
            'default'           => 'left',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Buttonset_Control(
            $wp_customize,
            'banner_caption_layout',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Banner Caption Alignment', 'blossom-shop-pro' ),
                'description' => __( 'Choose alignment for banner caption.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'left'      => __( 'Left', 'blossom-shop-pro' ),
                    'centered'  => __( 'Center', 'blossom-shop-pro' ),
                    'right'     => __( 'Right', 'blossom-shop-pro' ),
                ),
                'active_callback' => 'blossom_shop_pro_banner_ac' 
            )
        )
    );

    /** Repetitive Posts */
    $wp_customize->add_setting(
        'include_repetitive_posts',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'include_repetitive_posts',
            array(
                'section'       => 'header_image',
                'label'         => __( 'Include Repetitive Posts', 'blossom-shop-pro' ),
                'description'   => __( 'Enable to add posts included in slider in blog page too.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_banner_ac'
            )
        )
    );
    
    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'slider_auto',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Auto', 'blossom-shop-pro' ),
                'description' => __( 'Enable slider auto transition.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_banner_ac'
			)
		)
	);
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'blossom-shop-pro' ),
                'description' => __( 'Enable slider loop.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_banner_ac'
			)
		)
	);

    /** No. of slides */
    $wp_customize->add_setting(
        'slider_speed',
        array(
            'default'           => 3000,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Slider_Control( 
            $wp_customize,
            'slider_speed',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Slider Speed', 'blossom-shop-pro' ),
                'description' => __( 'Controls the speed of slider.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'min'   => 1000,
                    'max'   => 15000,
                    'step'  => 100,
                ),
                'active_callback' => 'blossom_shop_pro_banner_ac'                 
            )
        )
    );
    
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'blossom-shop-pro' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'bounceOut'      => __( 'Bounce Out', 'blossom-shop-pro' ),
                    'bounceOutLeft'  => __( 'Bounce Out Left', 'blossom-shop-pro' ),
                    'bounceOutRight' => __( 'Bounce Out Right', 'blossom-shop-pro' ),
                    'bounceOutUp'    => __( 'Bounce Out Up', 'blossom-shop-pro' ),
                    'bounceOutDown'  => __( 'Bounce Out Down', 'blossom-shop-pro' ),
                    'fadeOut'        => __( 'Fade Out', 'blossom-shop-pro' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'blossom-shop-pro' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'blossom-shop-pro' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'blossom-shop-pro' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'blossom-shop-pro' ),
                    'flipOutX'       => __( 'Flip OutX', 'blossom-shop-pro' ),
                    'flipOutY'       => __( 'Flip OutY', 'blossom-shop-pro' ),
                    'hinge'          => __( 'Hinge', 'blossom-shop-pro' ),
                    'pulse'          => __( 'Pulse', 'blossom-shop-pro' ),
                    'rollOut'        => __( 'Roll Out', 'blossom-shop-pro' ),
                    'rotateOut'      => __( 'Rotate Out', 'blossom-shop-pro' ),
                    'rubberBand'     => __( 'Rubber Band', 'blossom-shop-pro' ),
                    'shake'          => __( 'Shake', 'blossom-shop-pro' ),
                    ''               => __( 'Slide', 'blossom-shop-pro' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'blossom-shop-pro' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'blossom-shop-pro' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'blossom-shop-pro' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'blossom-shop-pro' ),
                    'swing'          => __( 'Swing', 'blossom-shop-pro' ),
                    'tada'           => __( 'Tada', 'blossom-shop-pro' ),
                    'zoomOut'        => __( 'Zoom Out', 'blossom-shop-pro' ),
                    'zoomOutLeft'    => __( 'Zoom Out Left', 'blossom-shop-pro' ),
                    'zoomOutRight'   => __( 'Zoom Out Right', 'blossom-shop-pro' ),
                    'zoomOutUp'      => __( 'Zoom Out Up', 'blossom-shop-pro' ),
                    'zoomOutDown'    => __( 'Zoom Out Down', 'blossom-shop-pro' ),                    
                ),
                'active_callback' => 'blossom_shop_pro_banner_ac'                                	
     		)
		)
	);
    
    /** Readmore Text */
    $wp_customize->add_setting(
        'slider_readmore',
        array(
            'default'           => __( 'SHOP NEW ARRIVALS', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'slider_readmore',
        array(
            'type'            => 'text',
            'section'         => 'header_image',
            'label'           => __( 'Slider Read More', 'blossom-shop-pro' ),
            'active_callback' => 'blossom_shop_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'slider_readmore', array(
        'selector' => '.site-banner .banner-caption .button-wrap a.btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_slider_readmore',
    ) );

    $wp_customize->add_setting(
        'slider_banner_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
            $wp_customize,
            'slider_banner_text',
            array(
                'section'     => 'header_image',
                'description' => sprintf( __( '%1$sClick here%2$s to select the layout of slider banner.', 'blossom-shop-pro' ), '<span class="text-inner-link slider_banner_text">', '</span>' ),
                'active_callback' => 'blossom_shop_pro_banner_ac'
            )
        )
    );
    /** Slider Settings Ends */  
      
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_frontpage_banner' );

if ( ! function_exists( 'blossom_shop_pro_banner_types' ) ) :
    /**
     * @return array Content type options
     */
    function blossom_shop_pro_banner_types() {
        $banner_options = array(
            'no_banner'        => __( 'Disable Banner Section', 'blossom-shop-pro' ),
            'static_banner'    => __( 'Static/Video CTA Banner', 'blossom-shop-pro' ),
            'static_nl_banner' => __( 'Static/Video Newsletter Banner', 'blossom-shop-pro' ),
            'slider_banner'    => __( 'Banner as Slider', 'blossom-shop-pro' ),
        );
        if ( is_woocommerce_activated() ) {
            $banner_options = array_merge( $banner_options, array( 'static_product' => __( 'Static/Video Product Search','blossom-shop-pro' ) ) );
        }
        $output = apply_filters( 'blossom_shop_pro_banner_types', $banner_options );
        return $output;
    }
endif;

if ( ! function_exists( 'blossom_shop_pro_banner_options' ) ) :
    /**
     * @return array Content type options
     */
    function blossom_shop_pro_banner_options() {
        $banner_types = array(
            'latest_posts' => __( 'Latest Posts', 'blossom-shop-pro' ),
            'cat'          => __( 'Category', 'blossom-shop-pro' ),
            'pages'        => __( 'Pages', 'blossom-shop-pro' ),
            'custom'       => __( 'Custom', 'blossom-shop-pro' ),
        );
        if ( is_woocommerce_activated() ) {
            $banner_types = array_merge( $banner_types, array( 'latest_products' => __( 'Latest Products','blossom-shop-pro' ), 'cat_products' => __( 'Products Category','blossom-shop-pro' ) ) );
        }
        $output = apply_filters( 'blossom_shop_pro_banner_options', $banner_types );
        return $output;
    }
endif;