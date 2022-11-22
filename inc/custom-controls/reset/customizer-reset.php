<?php
/**
 * Reset Setting of all customizer options.
 * 
 * @package Blossom_Shop_Pro
*/

if ( ! class_exists( 'Blossom_Shop_Pro_Customizer_Reset' ) ) {

    final class Blossom_Shop_Pro_Customizer_Reset {

		private static $instance = null;

		private $wp_customize;

		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {			
			add_action( 'wp_ajax_customizer_reset', array( $this, 'ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
		}

		/**
		 * Store a reference to `WP_Customize_Manager` instance
		 *
		 * @param $wp_customize
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
            
            $wp_customize->add_section(
				'customizer_reset',
				array(
					'title'      => __( 'Customizer Reset', 'blossom-shop-pro' ),
					'priority'   => 1999,
					'capability' => 'edit_theme_options',
				)
			);

			$wp_customize->add_setting( 
				'theme_reset',
				array(
					'default'           => '',
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$description = __( '<p><span class="highlight">ATTENTION!!!</span></p>', 'blossom-shop-pro' );
        	$description .= __( '<p>Please read carefully before you proceed. Please <strong>DO NOT</strong> use this option on <strong>LIVE site</strong>.</p>', 'blossom-shop-pro' );
        	$description .= __( '<p>Use this option to reset customizer settings to default value.</p>', 'blossom-shop-pro' );
        	$description .= __( '<p>This process is <strong>IRREVERSIBLE</strong> and will remove all customizations ever made via customizer till now.</p>', 'blossom-shop-pro' );

			$wp_customize->add_control( 
				new Blossom_Shop_Pro_Customizer_Reset_Control( 
				$wp_customize,
				'theme_reset',
					array(
						'label'       => __( 'Customizer Reset', 'blossom-shop-pro' ),
						'section'     => 'customizer_reset',
						'description' => $description,
					)
				)
			);
		}

		public function ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}

			if ( ! check_ajax_referer( 'blossom-shop-pro-customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}

            $this->set_theme_mod_transient();
			$this->reset_customizer();

			wp_send_json_success();
		}

		public function reset_customizer() {
			$settings = $this->wp_customize->settings();

			// remove theme_mod settings registered in customizer
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
        
        //Function that saves customizer theme option in transient for 7 days.
		public function set_theme_mod_transient(){
            $theme_mods = get_option( 'theme_mods_blossom-shop-pro' );
            if( $theme_mods ) set_transient( 'blossom_shop_pro_theme_mod', $theme_mods, WEEK_IN_SECONDS );
        }
	}
}
Blossom_Shop_Pro_Customizer_Reset::get_instance();