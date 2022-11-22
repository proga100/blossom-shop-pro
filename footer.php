<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Shop_Pro
 */
    
    /**
     * After Content
     * 
     * @hooked blossom_shop_pro_content_end - 20
    */
    do_action( 'blossom_shop_pro_before_footer' );
    
    /**
     * Before footer
     * 
     * @hooked blossom_shop_pro_instagram - 10
     * @hooked blossom_shop_pro_newsletter - 20
    */
    do_action( 'blossom_shop_pro_before_footer_start' );

    /**
     * Footer
     * @hooked blossom_shop_pro_footer_start  - 10
     * @hooked blossom_shop_pro_footer_one  - 15
     * @hooked blossom_shop_pro_footer_contact - 20
     * @hooked blossom_shop_pro_footer_two    - 30
     * @hooked blossom_shop_pro_footer_bottom - 40
     * @hooked blossom_shop_pro_footer_end    - 50
    */
    do_action( 'blossom_shop_pro_footer' );
    
    /**
     * After Footer
     * 
     * @hooked blossom_shop_pro_page_end    - 20
    */
    do_action( 'blossom_shop_pro_after_footer' );

    wp_footer(); ?>

</body>
</html>