<?php
/**
 * Template Name: About Page
 * 
 * @package Blossom_Shop_Pro
 */

get_header(); 

    get_template_part( 'sections/about/intro' );

    echo '</div><!-- .container --></div><!-- .site-content -->';
    get_template_part( 'sections/about/testimonial' );
    get_template_part( 'sections/about/client' );
    
get_footer();