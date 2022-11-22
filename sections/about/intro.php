<?php
/**
 * Intro About Section
 * 
 * @package Blossom_Shop_Pro
 */
if( is_active_sidebar( 'about-intro' ) ){ ?>
<section id="about_intro_section" class="intro-about-section">
	<div class="container">
    	<?php dynamic_sidebar( 'about-intro' ); ?>
	</div>
</section><!-- .intro-about-section -->
<?php
}