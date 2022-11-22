<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Blossom_Shop_Pro
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://blossomthemes.com', // Site where EDD is hosted
		'item_name'      => 'Blossom Shop Pro', // Name of theme
		'theme_slug'     => 'blossom-shop-pro', // Theme slug
		'version'        => '2.1.8', // The current version of this theme
		'author'         => 'Blossom Themes', // The author of this theme
		'download_id'    => '65597', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
		'item_id'        => '',
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'blossom-shop-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'blossom-shop-pro' ),
		'license-key'               => __( 'License Key', 'blossom-shop-pro' ),
		'license-action'            => __( 'License Action', 'blossom-shop-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'blossom-shop-pro' ),
		'activate-license'          => __( 'Activate License', 'blossom-shop-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'blossom-shop-pro' ),
		'renew'                     => __( 'Renew?', 'blossom-shop-pro' ),
		'unlimited'                 => __( 'unlimited', 'blossom-shop-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'blossom-shop-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'blossom-shop-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'blossom-shop-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'blossom-shop-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'blossom-shop-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'blossom-shop-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'blossom-shop-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'blossom-shop-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'blossom-shop-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'blossom-shop-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'blossom-shop-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'blossom-shop-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'blossom-shop-pro' ),
	)

);
