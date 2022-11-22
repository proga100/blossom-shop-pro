<?php
/**
 * Client About Section
 * 
 * @package Blossom_Shop_Pro
 */
if( is_active_sidebar( 'about-client' ) ){ ?>
<section id="about_client_section" class="client-section">
	<div class="container">
    	<?php dynamic_sidebar( 'about-client' ); ?>
    </div>
</section><!-- .client-section -->
<?php
}