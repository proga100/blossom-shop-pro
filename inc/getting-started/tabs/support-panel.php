<?php
/**
 * Support Panel.
 *
 * @package Blossom_Shop_Pro
 */
?>
<!-- Support panel -->
<div id="support-panel" class="panel-left">
	<div class="toggle-block active">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I activate the theme license?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf( __( 'To activate the theme license, you need to copy the license key from your %1$sBlossom Themes\' Dashboard%2$s and enter the key on the right-hand side of this page. You can log in to your Blossom Themes\' dashboard using the username and password that was sent to your email during the theme purchase.', 'blossom-shop-pro' ), '<a href="'. esc_url( 'https://blossomthemes.com/my-account/' ) .'" target="_blank">', '</a>' ); ?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'What are the benefits of activating the theme license?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'When you activate the theme license, you can enjoy the seamless theme updates and faster support. We solve compatibility issues and bugs, make the theme more secure, and sometimes add extra features with theme updates. So, if you want your website to be safe and secure, you should activate the theme license so that you never miss our theme updates.', 'blossom-shop-pro' ); ?></p>
		</div>
	</div>	

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'How to renew the theme license?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf( __( 'The theme license will be automatically renewed. You will receive multiple reminders in your email before your theme expires. If you want to cancel the auto-renewal, please %1$scontact us%2$s.', 'blossom-shop-pro' ), '<a href="'. esc_url( 'https://blossomthemes.com/support-ticket/' ) .'" target="_blank">', '</a>' );
			?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'What are the benefits of upgrading to the Theme Club?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf( __( 'For just small additional amount of money, you will get access to all our current themes, new theme releases, theme updates, and email support with the %1$sTheme Club%2$s.', 'blossom-shop-pro' ), '<a href="'. esc_url( 'https://blossomthemes.com/theme-club/?utm_source=pro_theme&utm_medium=getting_started&utm_campaign=theme_club_upgrade' ) .'" target="_blank">', '</a>' ); ?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I upgrade to the Theme Club?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php printf ( __( 'To upgrade to the Theme Club, please log in to your %1$sBlossom Themes\' Dashboard%2$s using the username and password created during the purchase. After you log in, click on %3$sView Licenses > View Upgrades%4$s and select the %5$sTheme Club Upgrade%6$s you want.', 'blossom-shop-pro' ), '<a href="'. esc_url( 'https://blossomthemes.com/my-account/' ) .'" target="_blank">', '</a>', '<b>', '</b>', '<b>', '</b>' ); ?></p>
		</div>
	</div>
    
    <div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'Why is my theme not working well?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'If your customizer is not loading properly or you are having issues with the theme, it might be due to the plugin conflict.', 'blossom-shop-pro' ); ?></p>
			<p><?php printf( __( 'To solve the issue, deactivate all the plugins first, except the ones recommended by the theme. Then, hard reload your website using %1$s"Ctrl+Shift+R"%2$s on Windows. If the issues are fixed, start activating the plugins one by one, and reload and check your site each time. This will help you find out the plugin that is causing the problem.', 'blossom-shop-pro' ), '<b>', '</b>' ); ?></p>
			<p><?php printf( __( 'If this didn\'t help, please %1$scontact us%2$s.', 'blossom-shop-pro' ), '<a href="'. esc_url( 'https://blossomthemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
		</div>
	</div>

	<div class="toggle-block">
		<h3 class="toggle-title"><?php esc_html_e( 'How can I solve my issues quickly and get faster support?', 'blossom-shop-pro' ); ?></h3>
		<div class="toggle-content">
			<p><?php esc_html_e( 'Before you send us a support ticket for any issues, please make sure you have updated the theme to the latest version. We might have fixed the bug in the theme update.', 'blossom-shop-pro' ); ?></p>
			<p><?php esc_html_e( 'When you submit the support ticket, please try to provide as much details as possible so that we can solve your problem faster. We recommend you to send us a screenshot(s) with issues explained and your website\'s address (URL).', 'blossom-shop-pro' ); ?></p>
			<p><?php esc_html_e( 'Also, you might experience a slower response time during the weekend, so please bear with us.', 'blossom-shop-pro' ); ?></p>
		</div>
	</div>	
</div><!-- .panel-left support -->