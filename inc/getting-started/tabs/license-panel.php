<?php
/**
 * Right Buttons Panel.
 *
 * @package Blossom_Shop_Pro
 */
?>
<div class="panel-right">
	<!-- Activate license -->
	<div class="panel-aside">
		<?php if( 'valid' == $status ){ ?>
    		<h4><?php esc_html_e( 'Sweet, your license is active!', 'blossom-shop-pro' ); ?></h4>    
    		<!-- Activation message -->
    		<p><em><?php echo esc_html( $message ); ?></em></p>
		<?php } else { ?>
			<h4><?php printf( __( 'Activate %1$s License. Never Miss The Theme Updates!', 'blossom-shop-pro' ), BLOSSOM_SHOP_PRO_THEME_NAME ); ?></h4>
    		<p>
    			<?php printf( __( 'You can find your license key in the %1$sDownloads%2$s section of your Blossom Themes Dashboard.', 'blossom-shop-pro' ), '<a href="' . esc_url( 'https://blossomthemes.com/my-account/' ) .'" target="_blank">', '</a>' ); ?>
    		</p>
            <p><em><?php echo esc_html( $message ); ?></em></p>
		<?php } ?>

		<!-- License setting -->
		<form class="enter-license" method="post" action="options.php">
			<?php settings_fields( $this->theme_slug . '-license' ); ?>

			<input id="<?php echo esc_attr( $this->theme_slug ); ?>_license_key" name="<?php echo esc_attr( $this->theme_slug ); ?>_license_key" type="text" class="regular-text license-key-input" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php echo esc_attr( $strings['license-key'] ); ?>"/>

			<!-- If we have a license -->
			<?php
				wp_nonce_field( $this->theme_slug . '_nonce', $this->theme_slug . '_nonce' );
				if ( 'valid' == $status ) { ?>
					<input type="submit" class="button-primary" name="<?php echo esc_attr( $this->theme_slug ); ?>_license_deactivate" value="<?php echo esc_attr( $strings['deactivate-license'] ); ?>"/>
				<?php } else if ( $license ) { ?>
					<input type="submit" class="button-primary" name="<?php echo esc_attr( $this->theme_slug ); ?>_license_activate" value="<?php echo esc_attr( $strings['activate-license'] ); ?>"/>
				<?php }
                submit_button(); 
            ?>
		</form><!-- .enter-license -->
	</div><!-- .panel-aside license -->

	<!-- Knowledge base -->
	<div class="panel-aside">
		<h4><?php esc_html_e( 'Visit the Knowledge Base', 'blossom-shop-pro' ); ?></h4>
		<p><?php esc_html_e( 'Need help with using the WordPress as quickly as possible? Visit our well-organized Knowledge Base!', 'blossom-shop-pro' ); ?></p>
		<p><?php esc_html_e( 'Our Knowledge Base has step-by-step tutorials, from installing the WordPress to working with themes and more.', 'blossom-shop-pro' ); ?></p>

		<a class="button button-primary" href="https://docs.blossomthemes.com/docs/blossom-shop-pro/" title="<?php esc_attr_e( 'Visit the knowledge base', 'blossom-shop-pro' ); ?>" target="_blank">
            <?php esc_html_e( 'Visit the Knowledge Base', 'blossom-shop-pro' ); ?>
        </a>
	</div><!-- .panel-aside knowledge base -->

	<div class="panel-aside">
		<h4><?php _e( 'Submit your site for social share', 'blossom-shop-pro' ); ?></h4>
		<p><?php _e( 'We regularly share and feature websites made using our themes on our social media accounts( Facebook, Instagram, Twitter and Pinterest ).', 'blossom-shop-pro' ); ?></p>
		<p><?php _e( 'If you would like to get your website shared and featured, please submit your website by clicking the link below.', 'blossom-shop-pro' ); ?></p>

		<a class="button button-primary" href="<?php echo esc_url( 'https://blossomthemes.com/submit-your-site-for-social-share/' ); ?>" title="<?php esc_attr_e( 'Submit your site for social share', 'blossom-shop-pro' ); ?>" target="_blank"><?php _e( 'Submit Here', 'blossom-shop-pro' ); ?></a>
	</div><!-- .panel-aside knowledge base -->
</div><!-- .panel-right -->
