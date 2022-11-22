<?php
/**
 * Featured Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_featured( $wp_customize ) {
    
    /** Featured Area Settings */
    $wp_customize->add_section(
        'featured_section',
        array(
            'title'    => __( 'Featured Section', 'blossom-shop-pro' ),
            'priority' => 40,
            'panel'    => 'frontpage_settings',
            'active_callback' => 'blossom_shop_pro_featured_active',
        )
    );

    /** Featured layout */
    $wp_customize->add_setting( 
        'featured_layout', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Radio_Image_Control(
            $wp_customize,
            'featured_layout',
            array(
                'section'     => 'featured_section',
                'label'       => __( 'Featured Layout', 'blossom-shop-pro' ),
                'description' => __( 'Choose the featured layout for your site.', 'blossom-shop-pro' ),
                'choices'     => array(
                    'one'      => get_template_directory_uri() . '/images/featured/one.jpg',
                    'two'      => get_template_directory_uri() . '/images/featured/two.jpg',
                    'three'    => get_template_directory_uri() . '/images/featured/three.jpg',
                    'four'     => get_template_directory_uri() . '/images/featured/four.jpg',
                    'five'     => get_template_directory_uri() . '/images/featured/five.jpg',
                    'six'      => get_template_directory_uri() . '/images/featured/six.jpg',
                )
            )
        )
    );

    /** Category Two Title  */
    $wp_customize->add_setting(
        'featured_button_title',
        array(
            'default'           => __( 'DISCOVER NOW', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'featured_button_title',
        array(
            'label'           => __( 'Button Title', 'blossom-shop-pro' ),
            'description'     => __( 'Add title for the button.', 'blossom-shop-pro' ),
            'section'         => 'featured_section',
            'active_callback' => 'blossom_shop_pro_featured_ac'
        )
    );
    
    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 
        'featured_type', 
        array(
            'default'           => 'feat_page',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Buttonset_Control(
			$wp_customize,
			'featured_type',
			array(
				'section'	  => 'featured_section',
				'label'       => __( 'Featured Content Type', 'blossom-shop-pro' ),
                'description' => __( 'Choose featured content type.', 'blossom-shop-pro' ),
				'choices'	  => blossom_shop_pro_featured_options(),
			)
		)
	);
    
    /** Featured Content One */
    $wp_customize->add_setting(
		'featured_content_one',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'featured_content_one',
    		array(
                'label'	          => __( 'Featured Content One', 'blossom-shop-pro' ),
    			'section'         => 'featured_section',
    			'choices'         => blossom_shop_pro_get_posts( 'page' ),	
                'active_callback' => 'blossom_shop_pro_featured_ac'
     		)
		)
	);
    
    /** Featured Content Two */
    $wp_customize->add_setting(
		'featured_content_two',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'featured_content_two',
    		array(
                'label'	          => __( 'Featured Content Two', 'blossom-shop-pro' ),
    			'section'         => 'featured_section',
    			'choices'         => blossom_shop_pro_get_posts( 'page' ),
                'active_callback' => 'blossom_shop_pro_featured_ac'	
     		)
		)
	);
    
    /** Featured Content Three */
    $wp_customize->add_setting(
		'featured_content_three',
		array(
			'default'			=> '',
			'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Shop_Pro_Select_Control(
    		$wp_customize,
    		'featured_content_three',
    		array(
                'label'	          => __( 'Featured Content Three', 'blossom-shop-pro' ),
    			'section'         => 'featured_section',
    			'choices'         => blossom_shop_pro_get_posts( 'page' ),	
                'active_callback' => 'blossom_shop_pro_featured_ac'
     		)
		)
	);

    /** Featured Content Four */
    $wp_customize->add_setting(
        'featured_content_four',
        array(
            'default'           => '',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Select_Control(
            $wp_customize,
            'featured_content_four',
            array(
                'label'           => __( 'Featured Content Four', 'blossom-shop-pro' ),
                'section'         => 'featured_section',
                'choices'         => blossom_shop_pro_get_posts( 'page' ),  
                'active_callback' => 'blossom_shop_pro_featured_ac'
            )
        )
    );
    
    if( is_woocommerce_activated() ) {
        /** Featured Category One */
        $wp_customize->add_setting(
            'cat_featured_one',
            array(
                'default'           => '',
                'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Select_Control(
                $wp_customize,
                'cat_featured_one',
                array(
                    'label'   => __( 'Featured Category One', 'blossom-shop-pro' ),
                    'section' => 'featured_section',
                    'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
                    'active_callback' => 'blossom_shop_pro_featured_ac'
                )
            )
        );

        /** Featured Category Two */
        $wp_customize->add_setting(
            'cat_featured_two',
            array(
                'default'           => '',
                'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Select_Control(
                $wp_customize,
                'cat_featured_two',
                array(
                    'label'   => __( 'Featured Category Two', 'blossom-shop-pro' ),
                    'section' => 'featured_section',
                    'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
                    'active_callback' => 'blossom_shop_pro_featured_ac'
                )
            )
        );

        /** Featured Category Two */
        $wp_customize->add_setting(
            'cat_featured_three',
            array(
                'default'           => '',
                'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Select_Control(
                $wp_customize,
                'cat_featured_three',
                array(
                    'label'   => __( 'Featured Category Three', 'blossom-shop-pro' ),
                    'section' => 'featured_section',
                    'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
                    'active_callback' => 'blossom_shop_pro_featured_ac'
                )
            )
        );
        
        /** Featured Category Two */
        $wp_customize->add_setting(
            'cat_featured_four',
            array(
                'default'           => '',
                'sanitize_callback' => 'blossom_shop_pro_sanitize_select'
            )
        );

        $wp_customize->add_control(
            new Blossom_Shop_Pro_Select_Control(
                $wp_customize,
                'cat_featured_four',
                array(
                    'label'   => __( 'Featured Category Four', 'blossom-shop-pro' ),
                    'section' => 'featured_section',
                    'choices' => blossom_shop_pro_get_categories( true, 'product_cat' ),
                    'active_callback' => 'blossom_shop_pro_featured_ac'
                )
            )
        );
    }


    /** Add Featured Content */
    $wp_customize->add_setting( 
        new Blossom_Shop_Pro_Repeater_Setting( 
            $wp_customize, 
            'featured_custom', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Blossom_Shop_Pro_Repeater_Setting', 'sanitize_repeater_setting' ),                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Control_Repeater(
			$wp_customize,
			'featured_custom',
			array(
				'section' => 'featured_section',				
				'label'	  => __( 'Add featured content', 'blossom-shop-pro' ),
                'fields'  => array(
                    'thumbnail' => array(
                        'type'  => 'image', 
                        'label' => __( 'Add Image', 'blossom-shop-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'blossom-shop-pro' ),
                    ),
                    'link'     => array(
                        'type'  => 'text',
                        'label' => __( 'Link', 'blossom-shop-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'featured content', 'blossom-shop-pro' ),
                    'field' => 'title'
                ),
                'choices'   => array(
                    'limit' => 4,
                ),
                'active_callback' => 'blossom_shop_pro_featured_ac'                                              
			)
		)
	);
    /** Featured Area Settings Ends */
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_featured' );

if ( ! function_exists( 'blossom_shop_pro_featured_options' ) ) :
    /**
     * @return array Content type options
     */
    function blossom_shop_pro_featured_options() {
        $featured_options = array(
            'feat_page'      => __( 'Page', 'blossom-shop-pro' ),
            'feat_custom'    => __( 'Custom', 'blossom-shop-pro' ),
        );
        if ( is_woocommerce_activated() ) {
            $featured_options = array_merge( $featured_options, array( 'feat_cat' => __( 'Category','blossom-shop-pro' ) ) );
        }
        $output = apply_filters( 'blossom_shop_pro_featured_options', $featured_options );
        return $output;
    }
endif;