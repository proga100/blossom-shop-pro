<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Shop_Pro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); if( ! is_single() ) echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php 
        /**
         * @hooked blossom_shop_pro_post_thumbnail - 10
        */
        do_action( 'blossom_shop_pro_before_post_entry_content' );
        
        if( ! is_single() ) echo '<div class="content-wrap">';
        if( is_single() ) {
            echo '<div class="article-meta">';
            blossom_shop_pro_social_share();
            echo '</div>';
        } 

        /**
         * @hooked blossom_shop_pro_entry_header  - 10 
         * @hooked blossom_shop_pro_entry_content - 15
         * @hooked blossom_shop_pro_entry_footer  - 20
        */
        do_action( 'blossom_shop_pro_post_entry_content' );

        if( ! is_single() ) echo '</div>';
    ?>
    <?php if( is_home() ) blossom_shop_pro_get_affiliate_shop(); ?>
</article><!-- #post-<?php the_ID(); ?> -->