<?php
/**
 * Post Page Settings
 *
 * @package Blossom_Shop_Pro
 */

function blossom_shop_pro_customize_register_general_post_page( $wp_customize ) {
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Posts(Blog) & Pages Settings', 'blossom-shop-pro' ),
            'priority' => 50,
            'panel'    => 'general_settings',
        )
    );
    
    /** Prefix Archive Page */
    $wp_customize->add_setting( 
        'ed_prefix_archive', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_prefix_archive',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Prefix in Archive Page', 'blossom-shop-pro' ),
                'description' => __( 'Enable to hide prefix in archive page.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Blog Excerpt */
    $wp_customize->add_setting( 
        'ed_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_excerpt',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Enable Blog Excerpt', 'blossom-shop-pro' ),
                'description' => __( 'Enable to show excerpt or disable to show full post content.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Excerpt Length */
    $wp_customize->add_setting( 
        'excerpt_length', 
        array(
            'default'           => 55,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Slider_Control( 
			$wp_customize,
			'excerpt_length',
			array(
				'section'	  => 'post_page_settings',
				'label'		  => __( 'Excerpt Length', 'blossom-shop-pro' ),
				'description' => __( 'Automatically generated excerpt length (in words).', 'blossom-shop-pro' ),
                'choices'	  => array(
					'min' 	=> 10,
					'max' 	=> 100,
					'step'	=> 5,
				)                 
			)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'read_more_text',
        array(
            'default'           => __( 'READ MORE', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'read_more_text',
        array(
            'type'    => 'text',
            'section' => 'post_page_settings',
            'label'   => __( 'Read More Text', 'blossom-shop-pro' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'read_more_text', array(
        'selector' => '.entry-footer .btn-readmore',
        'render_callback' => 'blossom_shop_pro_get_read_more',
    ) );

    /** Blog Post Image Crop */
    $wp_customize->add_setting(
        'ed_blog_image',
        array(
            'default' => false,
            'sanitize_callback' => 'blossom_Shop_pro_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control(
            $wp_customize,
            'ed_blog_image',
            array(
                'section' => 'post_page_settings',
                'label' => __('Blog Post Image Crop', 'blossom-shop-pro'),
                'description' => __('Enable to avoid automatic cropping of featured image in home, archive and search posts.', 'blossom-shop-pro'),
            )
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'post_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Note_Control( 
			$wp_customize,
			'post_note_text',
			array(
				'section'	  => 'post_page_settings',
                'description' => sprintf( __( '%s These options affect your individual posts.', 'blossom-shop-pro' ), '<hr/>' ),
			)
		)
    );
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_author',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Author Section', 'blossom-shop-pro' ),
                'description' => __( 'Enable to hide author section.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Show Related Posts */
    $wp_customize->add_setting( 
        'ed_related', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Show Related Posts', 'blossom-shop-pro' ),
                'description' => __( 'Enable to show related posts in single page.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => __( 'Recommended Articles', 'blossom-shop-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => __( 'Related Posts Section Title', 'blossom-shop-pro' ),
            'active_callback' => 'blossom_shop_pro_post_page_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector' => '.additional-post .title',
        'render_callback' => 'blossom_shop_pro_get_related_title',
    ) );
    
    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 
        'related_taxonomy', 
        array(
            'default'           => 'cat',
            'sanitize_callback' => 'blossom_shop_pro_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Radio_Buttonset_Control(
			$wp_customize,
			'related_taxonomy',
			array(
				'section'	  => 'post_page_settings',
				'label'       => __( 'Related Post Taxonomy', 'blossom-shop-pro' ),
                'description' => __( 'Choose Categories/Tags to display related post based on in Single Post.', 'blossom-shop-pro' ),
				'choices'	  => array(
					'cat'   => __( 'Category', 'blossom-shop-pro' ),
                    'tag'   => __( 'Tags', 'blossom-shop-pro' ),
				),
                'active_callback' => 'blossom_shop_pro_post_page_ac'
			)
		)
	);

    /** Hide Social Float */
    $wp_customize->add_setting( 
        'ed_social_float', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'ed_social_float',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Enable Social Sticky', 'blossom-shop-pro' ),
                'description' => __( 'Enable to float article meta.', 'blossom-shop-pro' ),
            )
        )
    );
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Comments', 'blossom-shop-pro' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'blossom-shop-pro' ),
			)
		)
	);

    /** Comment Section After Content */
    $wp_customize->add_setting( 
        'toggle_comments', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Shop_Pro_Toggle_Control( 
            $wp_customize,
            'toggle_comments',
            array(
                'section'     => 'post_page_settings',
                'label'       => __( 'Toggle Comment Section', 'blossom-shop-pro' ),
                'description' => __( 'Enable to show comment section after post content. Refresh site for changes.', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_comments_toggle'
            )
        )
    );
    
    /** Hide Category */
    $wp_customize->add_setting( 
        'ed_category', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_category',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Category', 'blossom-shop-pro' ),
                'description' => __( 'Enable to hide category.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_post_date',
			array(
				'section'     => 'post_page_settings',
				'label'	      => __( 'Hide Posted Date', 'blossom-shop-pro' ),
                'description' => __( 'Enable to hide posted date.', 'blossom-shop-pro' ),
			)
		)
	);
    
    /** Show Featured Image */
    $wp_customize->add_setting( 
        'ed_featured_image', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_shop_pro_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Shop_Pro_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'         => 'post_page_settings',
				'label'	          => __( 'Show Featured Image', 'blossom-shop-pro' ),
                'description'     => __( 'Enable to show featured image in post detail (single post).', 'blossom-shop-pro' ),
                'active_callback' => 'blossom_shop_pro_post_page_ac'
			)
		)
	);

    /** Posts(Blog) & Pages Settings Ends */
    
}
add_action( 'customize_register', 'blossom_shop_pro_customize_register_general_post_page' );