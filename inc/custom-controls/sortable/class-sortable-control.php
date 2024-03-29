<?php
/**
 * Blossom Shop Pro Customizer Sortable Control.
 * 
 * @package Blossom_Shop_Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Blossom_Shop_Pro_Sortable_Control' ) ){
    /**
     * Sortable control (uses checkboxes).
     */
    class Blossom_Shop_Pro_Sortable_Control extends WP_Customize_Control {
    
    	public $type = 'sortable';
        
        public $option_type = 'theme_mod';
        
    	public function enqueue() {
            wp_enqueue_style( 'blossom-shop-pro-sortable', get_template_directory_uri() . '/inc/custom-controls/sortable/sortable.css', null );
    		wp_enqueue_script( 'blossom-shop-pro-sortable', get_template_directory_uri() . '/inc/custom-controls/sortable/sortable.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), false, true );
    	}
    
    	public function to_json() {
    		parent::to_json();
    
    		$this->json['default'] = $this->setting->default;
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		}
    		
    		$this->json['value']   = maybe_unserialize( $this->value() );
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['id']      = $this->id;
    
    		if ( 'user_meta' === $this->option_type ) {
    			$this->json['value'] = get_user_meta( get_current_user_id(), $this->id, true );
    		}
    
    		$this->json['inputAttrs'] = '';
    		foreach ( $this->input_attrs as $attr => $value ) {
    			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
    		}
    		$this->json['inputAttrs'] = maybe_serialize( $this->input_attrs() );
    
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * @see WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 */
    	protected function content_template() {
    		?>
    		<label class='sortable'>
    			<span class="customize-control-title">
    				{{{ data.label }}}
    			</span>
    			<# if ( data.description ) { #>
    				<span class="description customize-control-description">{{{ data.description }}}</span>
    			<# } #>
    
    			<ul class="sortable">
    				<# _.each( data.value, function( choiceID ) { #>
    					<li {{{ data.inputAttrs }}} class='sortable-item' data-value='{{ choiceID }}'>
    						<i class='dashicons dashicons-menu'></i>
    						<i class="dashicons dashicons-visibility visibility"></i>
    						{{{ data.choices[ choiceID ] }}}
    					</li>
    				<# }); #>
    				<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
    					<# if ( -1 === data.value.indexOf( choiceID ) ) { #>
    						<li {{{ data.inputAttrs }}} class='sortable-item invisible' data-value='{{ choiceID }}'>
    							<i class='dashicons dashicons-menu'></i>
    							<i class="dashicons dashicons-visibility visibility"></i>
    							{{{ data.choices[ choiceID ] }}}
    						</li>
    					<# } #>
    				<# }); #>
    			</ul>
    		</label>
    
    		<?php
    	}

        protected function render_content(){
        }
    }
}