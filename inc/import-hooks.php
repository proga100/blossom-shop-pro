<?php
/**
 * Blossom Shop Pro Import Hooks.
 *
 * @package Blossom_Shop_Pro
 */

/** Import content data*/
if ( !function_exists( 'blossom_shop_pro_import_files' ) ) :
	function blossom_shop_pro_import_files() {
		return array(
			array(
				'import_file_name'           => 'Default Layout',
				'import_file_url'            => 'https://blossomthemesdemo.com/wp-content/uploads/2020/05/blossomshoppro.xml',
				'import_widget_file_url'     => 'https://blossomthemesdemo.com/wp-content/uploads/2020/05/blossomshoppro.wie',
				'import_customizer_file_url' => 'https://blossomthemesdemo.com/wp-content/uploads/2020/05/blossomshoppro.dat',
				'import_preview_image_url'   => get_template_directory_uri() . '/screenshot.png',
				'import_notice'              => __( 'Please wait for about 10 - 15 minutes. Do not close or refresh the page until the import is complete.', 'blossom-shop-pro' ),
				'preview_url'                => 'https://demo.blossomthemes.com/blossom-shop-pro/',
			),  
		);
	}
	add_filter('pt-ocdi/import_files', 'blossom_shop_pro_import_files');
endif;

/** Programmatically set the front page and menu */
if ( !function_exists( 'blossom_shop_pro_after_import' ) ) :
	function blossom_shop_pro_after_import($selected_import) {
		if ( 'Default Layout' === $selected_import['import_file_name'] ) {
			//Set Menu
			$primary   = get_term_by('name', 'Primary Menu', 'nav_menu');
			$secondary = get_term_by('name', 'Secondary Menu', 'nav_menu');
				set_theme_mod('nav_menu_locations', array(
					'primary' => $primary->term_id,
					'secondary' => $secondary->term_id,
				)
			);

			/** Set Front page */
		    $page = get_page_by_path('home'); /** This need to be slug of the page that is assigned as Front page */
		        if ( isset( $page->ID ) ) {
		        update_option( 'page_on_front', $page->ID );
		        update_option( 'show_on_front', 'page' );
		    }
		    
		    /** Blog Page */
		    $postpage = get_page_by_path('blog'); /** This need to be slug of the page that is assigned as Posts page */
		    if( $postpage ){
		        $post_pgid = $postpage->ID;
		        
		        update_option( 'page_for_posts', $post_pgid );
		    }
		}
	}
	add_action('pt-ocdi/after_import', 'blossom_shop_pro_after_import');
endif;

add_filter('pt-ocdi/disable_pt_branding', '__return_true');