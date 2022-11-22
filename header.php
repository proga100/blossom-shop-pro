<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blossom_Shop_Pro
 */
    /**
     * Doctype Hook
     * 
     * @hooked blossom_shop_pro_doctype
    */
    do_action( 'blossom_shop_pro_doctype' );
?>
<head itemscope itemtype="http://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked blossom_shop_pro_head
    */
    do_action( 'blossom_shop_pro_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<?php
    
    wp_body_open();
    
    /**
     * Before Header
     *  
     * @hooked blossom_shop_pro_page_start - 20 
    */
    do_action( 'blossom_shop_pro_before_header' );
    
    /**
     * Header
     * @hooked blossom_shop_pro_sticky_bar - 10
     * @hooked blossom_shop_pro_header - 20     
    */
    do_action( 'blossom_shop_pro_header' );
    
    /**
     * Before Content
     * 
     * @hooked blossom_shop_pro_show_banner - 5
     * @hooked blossom_shop_pro_featured_section - 10
    */
    do_action( 'blossom_shop_pro_after_header' );
    
    /**
     * Content
     * 
     * @hooked blossom_shop_pro_content_start
    */
    do_action( 'blossom_shop_pro_content' );