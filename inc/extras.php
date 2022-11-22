<?php
/**
 * Blossom Shop Pro Standalone Functions.
 *
 * @package Blossom_Shop_Pro
 */

if ( ! function_exists( 'blossom_shop_pro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function blossom_shop_pro_posted_on() {
    $ed_post_date   = get_theme_mod( 'ed_post_date', false );

    if( $ed_post_date ) return false;

	$ed_updated_post_date = get_theme_mod( 'ed_post_update_date', true );
    $on = __( 'on ', 'blossom-shop-pro' );

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		if( $ed_updated_post_date ){
            $time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
            $on = __( 'updated on ', 'blossom-shop-pro' );		  
		}else{
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';  
		}        
	}else{
	   $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
    
    $posted_on = sprintf( '%1$s %2$s', esc_html( $on ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
	
	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'blossom_shop_pro_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function blossom_shop_pro_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'blossom-shop-pro' ),
		'<span itemprop="name"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url">' . esc_html( get_the_author() ) . '</a></span>' 
    );
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person">' . $byline . '</span>';
}
endif;

if( ! function_exists( 'blossom_shop_pro_comment_count' ) ) :
/**
 * Comment Count
*/
function blossom_shop_pro_comment_count(){
    $ed_comments        = get_theme_mod( 'ed_comments', true );

    if ( $ed_comments && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="far fa-comment"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'blossom-shop-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}    
}
endif;

if ( ! function_exists( 'blossom_shop_pro_category' ) ) :
/**
 * Prints categories
 */
function blossom_shop_pro_category(){

    $ed_cat_single  = get_theme_mod( 'ed_category', false );

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && !$ed_cat_single ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ' );
		if ( $categories_list ) {
			echo '<span class="category" itemprop="about">' . $categories_list . '</span>';
		}
	}
}
endif;

if ( ! function_exists( 'blossom_shop_pro_category_slider' ) ) :
/**
 * Prints categories
 */
function blossom_shop_pro_category_slider(){

    if( 'post' === get_post_type() ){
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( ' ' );
        if ( $categories_list ) {
            echo '<div class="cat-links"><span class="cat-links-border"></span><span class="cat-links-inner">' . $categories_list . '</span></div>';
        }
    }
}
endif;

if ( ! function_exists( 'blossom_shop_pro_tag' ) ) :
/**
 * Prints tags
 */
function blossom_shop_pro_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="cat-tags" itemprop="about">' . esc_html__( '%1$sTAGS:%2$s %3$s', 'blossom-shop-pro' ) . '</div>', '<span class="tag-title">', '</span>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_posts_list' ) ) :
/**
 * Returns Latest, Related & Popular Posts
*/
function blossom_shop_pro_get_posts_list( $status ){
    global $post;

    $ed_cat_single  = get_theme_mod( 'ed_category', false );
    
    $args = array(
        'post_type'           => 'post',
        'ignore_sticky_posts' => true
    );
    
    switch( $status ){
        case 'latest':        
        $args['posts_per_page'] = 3;
        $title                  = __( 'Latest Posts', 'blossom-shop-pro' );
        $class                  = 'additional-post';
        $image_size             = 'blossom-shop-blog-list';
        $readmore               = get_theme_mod( 'read_more_text', __( 'READ MORE', 'blossom-shop-pro' ) );
        break;
        
        case 'related':
        $args['posts_per_page'] = 3;
        $args['post__not_in']   = array( $post->ID );
        $args['orderby']        = 'rand';
        $title                  = get_theme_mod( 'related_post_title', __( 'Recommended Articles', 'blossom-shop-pro' ) );
        $readmore               = get_theme_mod( 'read_more_text', __( 'READ MORE', 'blossom-shop-pro' ) );
        $class                  = 'additional-post';
        $image_size             = 'blossom-shop-blog-list';
        $related_tax            = get_theme_mod( 'related_taxonomy', 'cat' );
        if( $related_tax == 'cat' ){
            $cats = get_the_category( $post->ID );        
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
        }elseif( $related_tax == 'tag' ){
            $tags = get_the_tags( $post->ID );
            if( $tags ){
                $t = array();
                foreach( $tags as $tag ){
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;  
            }
        }
        break;        
        
    }
    
    $qry = new WP_Query( $args );
    
    if( $qry->have_posts() ){ ?>    
        <div class="<?php echo esc_attr( $class ); ?>">
    		<?php 
            if( $title ) echo '<h2 class="title">' . esc_html( $title ) . '</h2>'; ?>
            <div class="section-grid">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <article class="post">
    				<figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                        <?php
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );
                            }else{ 
                                blossom_shop_pro_get_fallback_svg( $image_size );//fallback
                            }
                        ?>
                    </a></figure>
    				<div class="content-wrap">
                        <header class="entry-header">
        					<?php
                                blossom_shop_pro_category();
                                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
                            ?>                        
        				</header>
                        <?php if( $readmore ) { ?>
                            <footer class="entry-footer">
                                <div class="button-wrap">
                                    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo esc_html( $readmore ); ?></a>
                                </div>
                            </footer>
                        <?php } ?>
                    </div>
    			</article>
    			<?php }?>
            </div>    		
    	</div>
        <?php
        wp_reset_postdata();
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_site_branding' ) ) :
/**
 * Site Branding
*/
function blossom_shop_pro_site_branding(){
    $site_title       = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    $header_text      = get_theme_mod( 'header_text', 1 );
    if( has_custom_logo() || $site_title || $site_description || $header_text ) :
        if( has_custom_logo() && ( $site_title || $site_description ) && $header_text ) {
            $branding_class = ' text-image';
        }else{
            $branding_class = '';
        } ?>
        <div class="site-branding<?php echo esc_attr( $branding_class ); ?>" itemscope itemtype="http://schema.org/Organization">
            <?php 
            if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                the_custom_logo();
            } 
            if( $site_title || $site_description ) :
                if( $branding_class ) echo '<div class="site-title-wrap">';
                if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                }else{ ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php
                }
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description" itemprop="description"><?php echo $description; ?></p>
                <?php

                }
                if( $branding_class ) echo '</div>';
            endif;
            ?>
        </div>    
    <?php
    endif;
}
endif;

if( ! function_exists( 'blossom_shop_pro_header_search' ) ) :
/**
 * Header Search
*/
function blossom_shop_pro_header_search(){ 
    $ed_search = get_theme_mod( 'ed_header_search', true );
    $header = get_theme_mod( 'header_layout', 'three' );
    if( $ed_search ) : ?>
        <div class="header-search">
            <button class="search-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M86.065,85.194a6.808,6.808,0,1,0-.871.871L89.129,90,90,89.129Zm-1.288-.422a5.583,5.583,0,1,1,1.64-3.953A5.6,5.6,0,0,1,84.777,84.772Z" transform="translate(-74 -74)"/></svg>
                <span class="search-title"><?php esc_html_e( 'Search','blossom-shop-pro' ); ?></span>
            </button>
            <div class="header-search-wrap">
                <?php get_search_form(); ?>
                <button class="close"></button>
            </div>
        </div>
    <?php 
    endif; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_sticky_header' ) ) :
/**
 * Sticky Header
*/
function blossom_shop_pro_sticky_header(){ 
    $ed_cart   = get_theme_mod( 'ed_shopping_cart', true );
    $ed_sticky_header = get_theme_mod( 'ed_sticky_header', true ); 
    if( $ed_sticky_header ) : ?>
        <div class="sticky-header">
            <div class="container">
                <?php blossom_shop_pro_site_branding(); ?>
                <button aria-expanded="false" class="toggle-btn">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
                <div class="nav-wrap">
                    <?php blossom_shop_pro_primary_nagivation(); ?>
                    <div class="right">
                        <?php blossom_shop_pro_header_search(); ?>
                        <?php blossom_shop_pro_user_block(); ?>
                        <?php blossom_shop_pro_favourite_block(); ?>
                        <?php if( is_woocommerce_activated() && $ed_cart ) blossom_shop_pro_wc_cart_count(); ?>             
                    </div>
                </div>
            </div>
        </div>
    <?php 
    endif; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_social_links' ) ) :
/**
 * Social Links 
*/
function blossom_shop_pro_social_links( $echo = true ){ 
    $defaults = array(
        array(
            'font' => 'fab fa-facebook-f',
            'link' => 'https://www.facebook.com/',                        
        ),
        array(
            'font' => 'fab fa-twitter',
            'link' => 'https://twitter.com/',
        ),
        array(
            'font' => 'fab fa-youtube',
            'link' => 'https://www.youtube.com/',
        ),
        array(
            'font' => 'fab fa-instagram',
            'link' => 'https://www.instagram.com/',
        ),
        array(
            'font' => 'fab fa-google-plus-g',
            'link' => 'https://plus.google.com',
        ),
        array(
            'font' => 'fab fa-odnoklassniki',
            'link' => 'https://ok.ru/',
        ),
        array(
            'font' => 'fab fa-vk',
            'link' => 'https://vk.com/',
        ),
        array(
            'font' => 'fab fa-xing',
            'link' => 'https://www.xing.com/',
        )
    );
    $social_links = get_theme_mod( 'social_links', $defaults );
    $ed_social    = get_theme_mod( 'ed_social_links', true ); 
    
    if( $ed_social && $social_links && $echo ){ ?>
    <div class="header-social">
        <ul class="social-networks">
        	<?php 
            foreach( $social_links as $link ){
        	   if( $link['link'] ){ ?>
                <li>
                    <a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow noopener">
                        <i class="<?php echo esc_attr( $link['font'] ); ?>"></i>
                    </a>
                </li>    	   
                <?php
                } 
            } 
            ?>
    	</ul>
    </div>
    <?php    
    }elseif( $ed_social && $social_links ){
        return true;
    }else{
        return false;
    }
    ?>
    <?php                                
}
endif;

if( ! function_exists( 'blossom_shop_pro_form_section' ) ) :
/**
 * Form Icon
*/
function blossom_shop_pro_form_section(){ ?>
    <div class="form-section">
		<span id="btn-search" class="fas fa-search"></span>
	</div>
    <?php
}
endif;

if( ! function_exists( 'blossom_shop_pro_primary_nagivation' ) ) :
/**
 * Primary Navigation.
*/
function blossom_shop_pro_primary_nagivation(){ 
    $enabled_section = array();
    $ed_one_page     = get_theme_mod( 'ed_one_page', false );
    $ed_home_link    = get_theme_mod( 'ed_home_link', true );
    $home_sections   = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    $label_service     = get_theme_mod( 'label_service', __( 'Service', 'blossom-shop-pro' ) );
    $label_recent      = get_theme_mod( 'label_recent', __( 'Recent', 'blossom-shop-pro' ) );
    $label_featured    = get_theme_mod( 'label_featured', __( 'Featured', 'blossom-shop-pro' ) );
    $label_popular     = get_theme_mod( 'label_popular', __( 'Popular', 'blossom-shop-pro' ) );
    $label_deal        = get_theme_mod( 'label_deal', __( 'Deal', 'blossom-shop-pro' ) );
    $label_cat_one     = get_theme_mod( 'label_cat_one', __( 'Category One', 'blossom-shop-pro' ) );
    $label_cat_tab     = get_theme_mod( 'label_cat_tab', __( 'Category Tab', 'blossom-shop-pro' ) );
    $label_cat_two     = get_theme_mod( 'label_cat_two', __( 'Category Two', 'blossom-shop-pro' ) );
    $label_about       = get_theme_mod( 'label_about', __( 'About', 'blossom-shop-pro' ) );
    $label_cat_three   = get_theme_mod( 'label_cat_three', __( 'Category Three', 'blossom-shop-pro' ) );
    $label_cat_four    = get_theme_mod( 'label_cat_four', __( 'Category Four', 'blossom-shop-pro' ) );
    $label_testimonial = get_theme_mod( 'label_testimonial', __( 'Testimonial', 'blossom-shop-pro' ) );
    $label_cta         = get_theme_mod( 'label_cta', __( 'CTA', 'blossom-shop-pro' ) );
    $label_blog        = get_theme_mod( 'label_blog', __( 'Blog', 'blossom-shop-pro' ) );
    $label_client      = get_theme_mod( 'label_client', __( 'Client', 'blossom-shop-pro' ) );
    
    $menu_label = array();
    if( ! empty( $label_service ) ) $menu_label['service'] = $label_service;
    if( ! empty( $label_recent ) ) $menu_label['recent_product'] = $label_recent;
    if( ! empty( $label_featured ) ) $menu_label['featured'] = $label_featured;
    if( ! empty( $label_popular ) ) $menu_label['popular_product'] = $label_popular;
    if( ! empty( $label_deal ) ) $menu_label['product_deal'] = $label_deal;
    if( ! empty( $label_cat_one ) ) $menu_label['cat_one'] = $label_cat_one;
    if( ! empty( $label_cat_tab ) ) $menu_label['cat_tab'] = $label_cat_tab;
    if( ! empty( $label_cat_two ) ) $menu_label['cat_two'] = $label_cat_two;
    if( ! empty( $label_about ) ) $menu_label['about'] = $label_about;
    if( ! empty( $label_cat_three ) ) $menu_label['cat_three'] = $label_cat_three;
    if( ! empty( $label_cat_four ) ) $menu_label['cat_four'] = $label_cat_four;
    if( ! empty( $label_testimonial ) ) $menu_label['testimonial'] = $label_testimonial;
    if( ! empty( $label_cta ) ) $menu_label['cta'] = $label_cta;
    if( ! empty( $label_blog ) ) $menu_label['blog'] = $label_blog;
    if( ! empty( $label_client ) ) $menu_label['client'] = $label_client;
    
    foreach( $home_sections as $section ){
        if( array_key_exists( $section, $menu_label ) ){
            $enabled_section[] = array(
                'id'    => $section . '_section',
                'label' => $menu_label[$section],
            );
        }
    }
    
    if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) { ?>
        <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <button class="toggle-btn">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
    <?php    
    }elseif( $ed_one_page && ( 'page' == get_option( 'show_on_front' ) ) && $enabled_section ){ ?>
        <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <button class="toggle-btn">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
            <ul class="nav-menu">
                <?php if( $ed_home_link ){ ?>
                <li class="<?php if( is_front_page() ) echo esc_attr( 'current-menu-item' ); ?>"><a href="<?php echo esc_url( home_url( '#banner_section' ) ); ?>"><?php esc_html_e( 'Home', 'blossom-shop-pro' ); ?></a></li>
            <?php }
                foreach( $enabled_section as $section ){ 
                    if( $section['label'] ){
            ?>
                    <li><a href="<?php echo esc_url( home_url( '#' . esc_attr( $section['id'] ) ) ); ?>"><?php echo esc_html( $section['label'] );?></a></li>                        
            <?php 
                    } 
                }
            ?>
            </ul>
        </nav>
        <?php
    }else{
    
        if( current_user_can( 'manage_options' ) || has_nav_menu( 'primary' ) ) { ?>
        	<nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <button class="toggle-btn">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
        		<?php
        			wp_nav_menu( array(
        				'theme_location' => 'primary',
        				'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => 'blossom_shop_pro_primary_menu_fallback',
        			) );
        		?>
        	</nav><!-- #site-navigation -->
        <?php
        }
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function blossom_shop_pro_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'blossom-shop-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_secondary_navigation' ) ) :
/**
 * Secondary Navigation
*/
function blossom_shop_pro_secondary_navigation(){
    if( current_user_can( 'manage_options' ) || has_nav_menu( 'secondary' ) ) { ?>
    	<nav class="secondary-menu">
            <button class="toggle-btn">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
    		<?php
    			wp_nav_menu( array(
    				'theme_location' => 'secondary',
    				'menu_id'        => 'secondary-menu',
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => 'blossom_shop_pro_secondary_menu_fallback',
    			) );
    		?>
    	</nav>
        <?php
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_secondary_menu_fallback' ) ) :
/**
 * Fallback for secondary menu
*/
function blossom_shop_pro_secondary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="secondary-menu" class="nav-menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'blossom-shop-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_currency_block' ) ) :
/**
 * currency converter
*/
function blossom_shop_pro_currency_block(){

    $currency_switcher = get_theme_mod( 'currency_switcher_shortcode' );
    if( !empty( $currency_switcher ) ){
        echo '<div class="currency-block">';
        echo do_shortcode( $currency_switcher );   
        echo '</div>';            
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_language_block' ) ) :
/**
 * language converter
*/
function blossom_shop_pro_language_block(){
    
    $language_switcher = get_theme_mod( 'language_switcher_shortcode' );
    if( !empty( $language_switcher ) ){
        echo '<div class="language-block">';
        echo do_shortcode( $language_switcher );   
        echo '</div>';            
    } 
}
endif;

if( ! function_exists( 'blossom_shop_pro_user_block' ) ) :
/**
 * Header User Block
*/
function blossom_shop_pro_user_block(){ 
    $ed_user = get_theme_mod( 'ed_user_login', true ); 

    if( $ed_user && is_woocommerce_activated() && wc_get_page_id( 'myaccount' ) ) : 
        if ( is_user_logged_in() ) {
            $current_user = wp_get_current_user();
            $display_text = $current_user->display_name;
        } else {
            $display_text = __( 'Login', 'blossom-shop-pro' );
            if ( get_option( 'users_can_register' ) ) {
                $display_text = __( 'Login/Register', 'blossom-shop-pro' );
            }
        }
        ?>
        <div class="user-block">
            <a href="<?php the_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g transform="translate(3.52)"><path d="M29.571,13.853a4.427,4.427,0,1,1,4.471-4.427A4.461,4.461,0,0,1,29.571,13.853Zm0-7.609a3.182,3.182,0,1,0,3.214,3.182A3.2,3.2,0,0,0,29.571,6.244Z" transform="translate(-25.1 -5)"/></g><g transform="translate(0 9.173)"><path d="M21.5,63.427H20.243c0-3.076-3.017-5.582-6.734-5.582s-6.752,2.507-6.752,5.582H5.5c0-3.769,3.591-6.827,8.009-6.827S21.5,59.658,21.5,63.427Z" transform="translate(-5.5 -56.6)"/></g></svg><?php echo esc_html( $display_text ); ?>
            </a>
            <?php if ( is_user_logged_in() ): ?>
                <div class="user-block-popup">
                    <?php
                    $orders             = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
                    $edit_account       = get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' );
                    $customer_logout    = get_option( 'woocommerce_logout_endpoint', 'customer-logout' );

                    ?>
                    <?php if( $orders ) : ?> <li><a class="user-order" href="<?php echo esc_url( wc_get_account_endpoint_url( $orders ) ); ?>"><?php esc_html_e( 'My Orders','blossom-shop-pro' ); ?></a></li><?php endif; ?>
                    <?php if( $edit_account ) : ?><li><a class="user-account-edit" href="<?php echo esc_url( wc_get_account_endpoint_url( $edit_account ) ); ?>"><?php esc_html_e( 'Edit Account','blossom-shop-pro' ); ?></a></li><?php endif; ?>
                    <?php if( $customer_logout ) : ?><li><a class="user-account-log" href="<?php echo esc_url( wc_get_account_endpoint_url( $customer_logout ) ); ?>"><?php esc_html_e( 'Logout','blossom-shop-pro' ); ?></a></li><?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endif; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_favourite_block' ) ) :
/**
 * Header favourite Block
*/
function blossom_shop_pro_favourite_block(){ 
    if( is_woocommerce_activated() && is_yith_whislist_activated() ) : 
        $whislist_url = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
        $ed_whislist  = get_theme_mod( 'ed_whislist', true );
        if( $ed_whislist && $whislist_url ) : ?> 
            <div class="favourite-block">
                <a href="<?php echo esc_url( get_permalink( $whislist_url ) ); ?>" class="favourite" title="<?php esc_attr_e( 'View your favourite cart', 'blossom-shop-pro' ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15"><path d="M15.719,9.545A4.339,4.339,0,0,0,12.14,6.413a4.669,4.669,0,0,0-.815-.064,4.374,4.374,0,0,0-3.34,1.6c-.016.016-.032.048-.048.064A7.419,7.419,0,0,0,7.315,7.4,4.353,4.353,0,0,0,4.47,6.349,4.459,4.459,0,0,0,.076,9.784a5.4,5.4,0,0,0,.7,4.17,13.563,13.563,0,0,0,2.573,3A27.341,27.341,0,0,0,7.826,20.25a.182.182,0,0,0,.128.048.232.232,0,0,0,.112-.032A27.657,27.657,0,0,0,13.53,16a9.646,9.646,0,0,0,1.933-2.732A4.722,4.722,0,0,0,15.9,11.8a.227.227,0,0,1,.032-.1V10.424C15.863,10.128,15.8,9.832,15.719,9.545Zm-.92,2a.352.352,0,0,0-.016.128,3.568,3.568,0,0,1-.336,1.134,8.5,8.5,0,0,1-1.742,2.413A24.928,24.928,0,0,1,7.944,19a27.921,27.921,0,0,1-3.835-2.876,12.246,12.246,0,0,1-2.365-2.764,4.314,4.314,0,0,1-.559-3.34A3.362,3.362,0,0,1,4.493,7.451a3.234,3.234,0,0,1,2.125.783c.112.1.224.208.352.336a2.857,2.857,0,0,1,.208.224l.959.959.751-1.119a3.19,3.19,0,0,1,2.461-1.182,4.092,4.092,0,0,1,.623.048A3.22,3.22,0,0,1,14.687,9.88a2.023,2.023,0,0,1,.1.447c.016.064.016.128.032.192v1.023Z" transform="translate(0.073 -6.349)"/></svg>
                    <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                </a>
                <span class="fav-title"><?php esc_html_e( 'Wishlist','blossom-shop-pro' ); ?></span>
            </div>
            <?php
        endif; 
    endif; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_theme_comment' ) ) :
/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function blossom_shop_pro_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
    <?php if ( 'div' != $args['style'] ) : ?>
    <article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
	<?php endif; ?>
    	
        <footer class="comment-meta">
            <div class="comment-author vcard">
        	   <?php if ( $args['avatar_size'] != 0 ) blossom_shop_pro_gravatar( $comment, $args['avatar_size'] ); ?>
               <?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</b> <span class="says">says:</span>', 'blossom-shop-pro' ), get_comment_author_link() ); ?>
        	</div><!-- .comment-author vcard -->
        </footer>
        <div class="comment-metadata commentmetadata">
            <?php esc_html_e( 'Posted on', 'blossom-shop-pro' );?>
            <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
                <time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'blossom-shop-pro' ), get_comment_date(),  get_comment_time() ); ?></time>
            </a>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'blossom-shop-pro' ); ?></p>
            <br />
        <?php endif; ?>
        <div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>        
	<?php if ( 'div' != $args['style'] ) : ?>
    </article><!-- .comment-body -->
	<?php endif; ?>
    
<?php
}
endif;

if( ! function_exists( 'blossom_shop_pro_breadcrumb' ) ) :
/**
 * Breadcrumbs
*/
function blossom_shop_pro_breadcrumb() {
    global $post;
    $post_page = get_option('page_for_posts'); //The ID of the page that displays posts.
    $show_front = get_option('show_on_front'); //What to show on the front page
    $home = get_theme_mod('home_text', __('Home', 'blossom-shop-pro')); // text for the 'Home' link
    $delimiter  = '<i class="fa fa-angle-right"></i>';
    $before     = '<span class="current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb

    if( get_theme_mod( 'ed_breadcrumb', true ) ){
            
        $depth = 1;
        echo '<div class="breadcrumb-wrapper"><div class="container" >
                <div id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList"> 
                    <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="' . esc_url( home_url() ) . '"><span itemprop="name">' . esc_html( $home ) . '</span></a>
                        <meta itemprop="position" content="'. absint( $depth ).'" />
                        <span class="separator">' .  $delimiter  . '</span>
                    </span>';
        if( is_home() ){
            $depth = 2;
            echo $before . '<a itemprop="item" href="'. esc_url( get_the_permalink() ) .'"><span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> '. $after;
            
        }elseif( is_category() ){
            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );

            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                        $depth ++;
                    }
                }
            }
            echo $before . ' <a itemprop="item" href="' . esc_url( get_term_link( $thisCat->term_id) ) . '"><span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> ' . $after;
        
        }elseif( is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
        
            $depth = 2;
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            
            if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }

            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $ancestor ) ) . '"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                        $depth++;
                    }
                }
            }           
            echo $before .'<a itemprop="item" href="' . esc_url( get_term_link( $current_term->term_id ) ) . '"><span itemprop="name">'. esc_html( $current_term->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            
        }elseif( is_woocommerce_activated() && is_shop() ){ //Shop Archive page

            $depth = 2;
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                return;
            }
            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }
            echo $before .'<a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">'. esc_html( $_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 

        }elseif( is_tax( 'blossom_portfolio_categories' ) ){
            $depth = 2;
            $queried_object = get_queried_object();
            $taxonomy = 'blossom_portfolio_categories';
            $ancestors = get_ancestors( $queried_object->term_id, $taxonomy );
            if( !empty( $ancestors ) ){
            $termz = get_term( $ancestors[0], $taxonomy );
            $ancestors_title = !empty( $termz->name ) ? esc_html( $termz->name ) : ''; 
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $termz->term_id ) ) . '"><span itemprop="name">' . $ancestors_title . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }
            
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( $queried_object->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        }elseif( is_tag() ){
            
            $queried_object = get_queried_object();
            $depth = 2;

            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_author() ){
            
            $depth = 2;
            global $author;

            $userdata = get_userdata( $author );
            echo $before . '<a itemprop="item" href="' . esc_url( get_author_posts_url( $author ) ) . '"><span itemprop="name">' . esc_html( $userdata->display_name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
     
        }elseif( is_search() ){
            
            $depth = 2;
            $request_uri = $_SERVER['REQUEST_URI'];
            echo $before .'<a itemprop="item" href="'. esc_url( $request_uri ) .'"><span itemprop="name">'. esc_html__( 'Search Results for "', 'blossom-shop-pro' ) . esc_html( get_search_query() ) . esc_html__( '"', 'blossom-shop-pro' ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_day() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ), get_the_time( __( 'm', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'blossom-shop-pro' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth ++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_day_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ), get_the_time( __( 'm', 'blossom-shop-pro' ) ), get_the_time( __( 'd', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'd', 'blossom-shop-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_month() ){
            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
            $depth++;
            echo $before .'<a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ), get_the_time( __( 'm', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'F', 'blossom-shop-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_year() ){
            
            $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) ) . '"><span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'blossom-shop-pro' ) ) ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;

        }elseif( is_single() && !is_attachment() ){
            
            if( is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
                
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $shop_url ) . '"><span itemprop="name">' . esc_html( $_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /> <span class="separator">' . $delimiter . '</span></span> ';
                    $depth++;
                }
            
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                    $depth ++;
                }
                
                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }elseif( get_post_type() != 'post' ){
                $depth = 2;
                $post_type = get_post_type_object( get_post_type() );
                
                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   printf( '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a><meta itemprop="position" content="%3$s" />', esc_url( get_post_type_archive_link( get_post_type() ) ), $label, $depth );
                   echo '<meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                   $depth ++;    
                }

                if( get_post_type() =='blossom-portfolio' ){
                    // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   $portfolio_link = blossom_shop_pro_get_page_template_url( 'templates/blossom-portfolio.php' );
                   echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.esc_url( $portfolio_link) .'" itemprop="item"><span itemprop="name">'.esc_html($label).'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                   $depth ++;    
                }

                echo $before .'<a href="' . esc_url( get_the_permalink() ) . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                $depth            = 2;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';  
                    $depth++;
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object )
                    {
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term = $key;
                            $potential_parent = $object->term_id;
                        }
                    }
                    
                    $cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo ' <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span> ';
                            $depth ++;
                        }
                    }
                }

                 echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;     
                
            }
        
        }elseif( is_tax() ){
            $depth = 2;
            $queried_object = get_queried_object();
            $taxonomy = get_taxonomy( $queried_object->taxonomy );
            $ancestors = get_ancestors( $queried_object->term_id, $taxonomy->name );
            if( !empty( $ancestors ) ){
            $termz = get_term( $ancestors[0], $taxonomy );
            $ancestors_title = !empty( $termz->name ) ? esc_html( $termz->name ) : ''; 
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_term_link( $termz->term_id ) ) . '"><span itemprop="name">' . $ancestors_title . ' </span></a><meta itemprop="position" content="'. absint( $depth ).'"/><span class="separator">' . $delimiter . '</span></span> ';
                $depth++;
            }
            
            echo $before . '<a itemprop="item" href="' . esc_url( get_term_link( $queried_object->term_id ) ) . '"><span itemprop="name">' . esc_html( $queried_object->name ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            print_r($post_type->name);
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'blossom-shop-pro'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( 'milan'. post_type_archive_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }

        }elseif( is_attachment() ){
            
            $depth = 2;
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            echo  $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
           $depth = 2;
            echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;

        }elseif( is_page() && $post->post_parent ){
            
            global $post;
            $depth = 2;
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $current_page = get_post( $parent_id );
                $breadcrumbs[] = $current_page->ID;
                $parent_id  = $current_page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                echo '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . $delimiter . '</span> ';
                $depth++;
            }

            echo ' <span class="separator">' .  $delimiter . '</span> ' . $before .'<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'blossom-shop-pro' ) . $after;
        }
        
        if( get_query_var('paged') ) echo __( ' (Page', 'blossom-shop-pro' ) . ' ' . get_query_var('paged') . __( ')', 'blossom-shop-pro' );
        
        echo '</div></div></div><!-- .breadcrumb-wrapper -->';
        
    }  
}
endif;

if( ! function_exists( 'blossom_shop_pro_sidebar' ) ) :
/**
 * Return sidebar layouts for pages/posts
*/
function blossom_shop_pro_sidebar( $class = false ){
    global $post;
    $return      = $return = $class ? 'full-width' : false; //Fullwidth
    $layout      = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( ( is_front_page() && is_home() ) || is_home() ){ //blog/home page
         
        $home_sidebar = get_theme_mod( 'home_page_sidebar', 'sidebar' );
        
        if( $layout == 'no-sidebar' ){  
            $return = $class ? 'full-width' : false; //Fullwidth        
        }elseif( is_active_sidebar( $home_sidebar ) ){
            if( $class ){                
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; 
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';                
            }else{
                $return = $home_sidebar; //With Sidebar
            }
        }else{
            $return = $class ? 'full-width' : false; //Fullwidth
        }                
    }
    
    if( is_archive() ){
        //archive page
        $archive_sidebar = get_theme_mod( 'archive_page_sidebar', 'sidebar' );
        $cat_sidebar     = get_theme_mod( 'cat_archive_page_sidebar', 'default-sidebar' );
        $tag_sidebar     = get_theme_mod( 'tag_archive_page_sidebar', 'default-sidebar' );
        $date_sidebar    = get_theme_mod( 'date_archive_page_sidebar', 'default-sidebar' );
        $author_sidebar  = get_theme_mod( 'author_archive_page_sidebar', 'default-sidebar' );
        
        if( is_category() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( $cat_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $cat_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $cat_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }                
        }elseif( is_tag() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $tag_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $tag_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $tag_sidebar;
                }           
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }           
        }elseif( is_author() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $author_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $author_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $author_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }            
        }elseif( is_date() ){            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( ( $date_sidebar == 'default-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }elseif( is_active_sidebar( $date_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $date_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }
        }elseif( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ){ //For Woocommerce            
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( is_active_sidebar( 'shop-sidebar' ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
                }else{
                    $return = 'shop-sidebar';
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }       
        }else{
            if( $layout == 'no-sidebar' ){
                $return = $class ? 'full-width' : false; //Fullwidth
            }elseif( is_active_sidebar( $archive_sidebar ) ){
                if( $class ){
                    if( $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $layout == 'left-sidebar' ) $return = 'leftsidebar'; //With Sidebar
                }else{
                    $return = $archive_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }                      
        }        
    }
    
    if( is_singular() ){         
        $post_sidebar = get_theme_mod( 'single_post_sidebar', 'sidebar' ); //Global sidebar for single post from customizer
        $page_sidebar = get_theme_mod( 'single_page_sidebar', 'sidebar' ); //Global Sidebar for single page from customizer
        $page_layout  = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' ); //Global Layout/Position for Pages
        $post_layout  = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' ); //Global Layout/Position for Posts        
        
        /**
         * Individual post/page layout
        */
        if( get_post_meta( $post->ID, '_blossom_shop_pro_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_blossom_shop_pro_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        /**
         * Individual post/page sidebar
        */     
        if( get_post_meta( $post->ID, '_blossom_shop_pro_sidebar', true ) ){
            $single_sidebar = get_post_meta( $post->ID, '_blossom_shop_pro_sidebar', true );
        }else{
            $single_sidebar = 'default-sidebar';
        }
        
        if( is_page() ){
            $template = array( 'templates/contact.php', 'templates/about.php', 'templates/blossom-portfolio.php', 'templates/landing-page.php' );
            if( is_page_template( $template ) ) {
                $return = $class ? 'full-width' : false;
            }elseif( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar' ) ){
                $return = $class ? 'full-width' : false;
            }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
                $return = $class ? 'full-width centered' : false;
            }elseif( $single_sidebar == 'default-sidebar' && is_active_sidebar( $page_sidebar ) ){
                if( $class ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                }else{
                    $return = $page_sidebar;
                }
            }elseif( is_active_sidebar( $single_sidebar ) ){
                if( $class ){
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                    if( ( $sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                }else{
                    $return = $single_sidebar;
                }
            }else{
                $return = $class ? 'full-width' : false; //Fullwidth
            }

            if( is_woocommerce_activated() && ( is_cart() || is_checkout() ) ) {
                $return = $class ? 'full-width' : false; //Fullwidth
            }
        }
        
        if( is_single() ){
            if( 'product' === get_post_type() ){ //For Product Post Type
                if( $post_layout == 'no-sidebar' || $post_layout == 'centered' ){
                    $return = $class ? 'full-width' : false; //Fullwidth
                }elseif( is_active_sidebar( 'shop-sidebar' ) ){
                    if( $class ){
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }else{
                        $return = 'shop-sidebar';
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }elseif( 'post' === get_post_type() ){ //For default post type
                if( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ){
                    $return = $class ? 'full-width' : false;
                }elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( $single_sidebar == 'default-sidebar' && is_active_sidebar( $post_sidebar ) ){
                    if( $class ){
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                    }else{
                        $return = $post_sidebar;
                    }
                }elseif( is_active_sidebar( $single_sidebar ) ){
                    if( $class ){
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) $return = 'rightsidebar';
                        if( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) $return = 'leftsidebar';
                    }else{
                        $return = $single_sidebar;
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }else{ //Custom Post Type
                if( $post_layout == 'no-sidebar' ){
                    $return = $class ? 'full-width' : false;
                }elseif( $post_layout == 'centered' ){
                    $return = $class ? 'full-width centered' : false;
                }elseif( is_active_sidebar( $post_sidebar ) ){
                    if( $class ){
                        if( $post_layout == 'right-sidebar' ) $return = 'rightsidebar';
                        if( $post_layout == 'left-sidebar' ) $return = 'leftsidebar';
                    }else{
                        $return = $post_sidebar;
                    }
                }else{
                    $return = $class ? 'full-width' : false; //Fullwidth
                }
            }
        }
    } 
        
    if( is_search() ){
        $search_sidebar = get_theme_mod( 'search_page_sidebar', 'sidebar' );       
        
        if( $layout == 'no-sidebar' ){
            $return = $class ? 'full-width' : false;
        }elseif( is_active_sidebar( $search_sidebar ) ){
            if( $class ){
                if( $layout == 'right-sidebar' ) $return = 'rightsidebar';
                if( $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                $return = $search_sidebar;
            }
        }else{
            $return = $class ? 'full-width' : false; //Fullwidth
        }        
    }
      
    return $return; 
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function blossom_shop_pro_get_posts( $post_type = 'post', $slug = false ){    
    $args = array(
    	'posts_per_page'   => 100,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'blossom-shop-pro' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = $posts->post_title;
            }else{
                $post_options[ $posts->ID ] = $posts->post_title;    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_categories' ) ) :
/**
 * Function to list post categories in customizer options
*/
function blossom_shop_pro_get_categories( $select = true, $taxonomy = 'category', $slug = false ){    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 
        'hide_empty' => false,
        'taxonomy'   => $taxonomy 
    );
    
    $catlists = get_terms( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'blossom-shop-pro' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_id_from_page' ) ) :
/**
 * Get page ids from page name.
*/
function blossom_shop_pro_get_id_from_page( $slider_pages ){
    if( $slider_pages ){
        $ids = array();
        foreach( $slider_pages as $p ){
             if( !empty( $p['page'] ) ){
                $page_ids = get_page_by_title( $p['page'] );
                $ids[] = $page_ids->ID;
             }
        }   
        return $ids;
    }else{
        return false;
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_patterns' ) ) :
/**
 * Function to list Custom Pattern
*/
function blossom_shop_pro_get_patterns(){
    $patterns = array();
    $patterns['nobg'] = get_template_directory_uri() . '/images/patterns_thumb/' . 'nobg.png';
    for( $i=0; $i<38; $i++ ){
        $patterns['pattern'.$i] = get_template_directory_uri() . '/images/patterns_thumb/' . 'pattern' . $i .'.png';
    }
    for( $j=1; $j<26; $j++ ){
        $patterns['hbg'.$j] = get_template_directory_uri() . '/images/patterns_thumb/' . 'hbg' . $j . '.png';
    }
    return $patterns;
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_dynamnic_sidebar' ) ) :
/**
 * Function to list dynamic sidebar
*/
function blossom_shop_pro_get_dynamnic_sidebar( $nosidebar = false, $sidebar = false, $default = false ){
    $sidebar_arr = array();
    $sidebars = get_theme_mod( 'sidebar' );
    
    if( $default ) $sidebar_arr['default-sidebar'] = __( 'Default Sidebar', 'blossom-shop-pro' );
    if( $sidebar ) $sidebar_arr['sidebar'] = __( 'Sidebar', 'blossom-shop-pro' );
    
    if( $sidebars ){        
        foreach( $sidebars as $sidebar ){            
            $id = $sidebar['name'] ? sanitize_title( $sidebar['name'] ) : 'blossom-shop-pro-sidebar-one';
            $sidebar_arr[$id] = $sidebar['name'];
        }
    }
    
    if( $nosidebar ) $sidebar_arr['no-sidebar'] = __( 'No Sidebar', 'blossom-shop-pro' );
    
    return $sidebar_arr;
}
endif;

if( ! function_exists( 'blossom_shop_pro_create_post' ) ) :
/**
 * A function used to programmatically create a post and assign a page template in WordPress. 
 *
 * @link https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
 * @link https://tommcfarlin.com/programmatically-set-a-wordpress-template/
 */
function blossom_shop_pro_create_post( $title, $slug, $template ){

	// Setup the author, page
	$author_id = 1;
    
    // Look for the page by the specified title. Set the ID to -1 if it doesn't exist.
    // Otherwise, set it to the page's ID.
    $page = get_page_by_title( $title, OBJECT, 'page' );
    $page_id = ( null == $page ) ? -1 : $page->ID;
    
	// If the page doesn't already exist, then create it
	if( $page_id == -1 ){

		// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status' =>	'closed',
				'ping_status'	 =>	'closed',
				'post_author'	 =>	$author_id,
				'post_name'		 =>	$slug,
				'post_title'	 =>	$title,
				'post_status'	 =>	'publish',
				'post_type'		 =>	'page'
			)
		);
        
        if( $post_id ) update_post_meta( $post_id, '_wp_page_template', $template );

	// Otherwise, we'll stop
	}else{
	   update_post_meta( $page_id, '_wp_page_template', $template );
	} // end if

} // end programmatically_create_post
endif;

if( ! function_exists( 'blossom_shop_pro_get_page_template_url' ) ) :
/**
 * Returns page template url if not found returns home page url
*/
function blossom_shop_pro_get_page_template_url( $page_template ){
    $args = array(
        'meta_key'   => '_wp_page_template',
        'meta_value' => $page_template,
        'post_type'  => 'page',
        'fields'     => 'ids',
    );
    
    $posts_array = get_posts( $args );
    
    $url = ( $posts_array ) ? get_permalink( $posts_array[0] ) : get_permalink( get_option( 'page_on_front' ) );
    return $url;    
}
endif;

if( ! function_exists( 'blossom_shop_pro_author_social' ) ) :
/**
 * Author Social Links
*/
function blossom_shop_pro_author_social(){
    $id      = get_the_author_meta( 'ID' );
    $socials = get_user_meta( $id, '_blossom_shop_pro_user_social_icons', true );
    $fonts   = array(
        'facebook'     => 'fab fa-facebook-f', 
        'twitter'      => 'fab fa-twitter',
        'instagram'    => 'fab fa-instagram',
        'snapchat'     => 'fab fa-snapchat',
        'pinterest'    => 'fab fa-pinterest',
        'linkedin'     => 'fab fa-linkedin-in',
        'youtube'      => 'fab fa-youtube'
    );
    
    if( $socials ){
        echo '<div class="author-social"><ul class="social-list">';
        foreach( $socials as $key => $link ){            
            if( $link ) echo '<li><a href="' . esc_url( $link ) . '" target="_blank" rel="nofollow noopener" title="' . esc_attr( $key ) . '"><i class="' . esc_attr( $fonts[$key] ) . '"></i></a></li>';
        }
        echo '</ul></div>';
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_home_sections' ) ) :
/**
 * Returns Home Sections 
*/
function blossom_shop_pro_get_home_sections(){
    $ed_banner     = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    $home_sections = get_theme_mod( 'front_sort', array( 'service', 'recent_product', 'featured', 'popular_product', 'product_deal', 'cat_one', 'cat_tab', 'cat_two', 'about', 'cat_three', 'cat_four', 'testimonial', 'cta', 'blog', 'client' ) );
    
    $enabled_section = array();
    
    if( $ed_banner == 'static_banner' || $ed_banner == 'slider_banner' || $ed_banner == 'static_nl_banner' || ( is_woocommerce_activated() && $ed_banner == 'static_product' ) ) array_push( $enabled_section, 'banner' );
    
    foreach( $home_sections as $v ){
        array_push( $enabled_section, $v );
    } 
    
    return apply_filters( 'blossom_shop_pro_home_sections', $enabled_section );
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function blossom_shop_pro_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'blossom_shop_pro_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function blossom_shop_pro_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = blossom_shop_pro_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#f2f2f2;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function blossom_shop_pro_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if ( ! function_exists( 'blossom_shop_pro_apply_theme_shortcode' ) ) :
/**
 * Footer Shortcode
*/
function blossom_shop_pro_apply_theme_shortcode( $string ) {
    if ( empty( $string ) ) {
        return $string;
    }
    $search = array( '[the-year]', '[the-site-link]' );
    $replace = array(
        date_i18n( esc_html__( 'Y', 'blossom-shop-pro' ) ),
        '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
    );
    $string = str_replace( $search, $replace, $string );
    return $string;
}
endif;

/**
 * Is Blossom Theme Toolkit active or not
*/
function is_bttk_activated(){
    return class_exists( 'Blossomthemes_Toolkit' ) ? true : false;
}

/**
 * Is BlossomThemes Email Newsletters active or not
*/
function is_btnw_activated(){
    return class_exists( 'Blossomthemes_Email_Newsletter' ) ? true : false;        
}

/**
 * Is BlossomThemes Social Feed active or not
*/
function is_btif_activated(){
    return class_exists( 'Blossomthemes_Instagram_Feed' ) ? true : false;
}

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Check if Contact Form 7 Plugin is installed
*/
function is_cf7_activated(){
    return class_exists( 'WPCF7' ) ? true : false;
}

/**
 * Is Customizer Search active or not
 */
function is_customizer_search_activated() {
    return class_exists('Customizer_Search') ? true : false;
}

/**
 * Query Jetpack activation
*/
function is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}

/**
 * Query Yith activation
 */
function is_yith_compare_activated() {
    return class_exists( 'YITH_WOOCOMPARE' ) ? true : false;
}

/**
 * Query Yith activation
 */
function is_yith_quickview_activated() {
    return class_exists( 'YITH_WCQV' ) ? true : false;
}

/**
 * Query Yith activation
 */
function is_yith_whislist_activated() {
    return class_exists( 'YITH_WCWL' ) ? true : false;
}


if( ! function_exists( 'blossom_shop_pro_payment_method' ) ) :
/**
 * Back to top
*/
function blossom_shop_pro_payment_method(){ 
    $image = get_theme_mod( 'footer_payment_image' ); 
    if( $image ) : ?>
        <div class="payment-method">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'payment-image', 'blossom-shop-pro' ) ?>">
        </div>
        <?php 
    endif;
}
endif;

if( ! function_exists( 'blossom_shop_pro_back_to_top' ) ) :
/**
 * Back to top
*/
function blossom_shop_pro_back_to_top(){ ?>
    <button id="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <?php
}
endif;

if ( ! function_exists( 'blossom_shop_pro_countdown' ) ) :
/**
 * Countdown Code
*/
function blossom_shop_pro_countdown() { 
    $countdown_value        = get_theme_mod( 'countdown_timer', '2021-08-20' );
    $countdown_timer        = new DateTime( $countdown_value );
    $today                  = new DateTime( date('Y-m-d') );
    $countdown              = '';
    $home_sections          = blossom_shop_pro_get_home_sections();

    if( in_array( 'product_deal', $home_sections ) ){
        if( $countdown_timer > $today ){ ?>
            
            <div class="countdown-block">
                <span class="days"></span>
                <h5 class="countdown-title">
                    <?php esc_html_e( 'Days', 'blossom-shop-pro' ); ?>
                </h5>
            </div>
            <div class="countdown-block">
                <span class="hours"></span>
                <h5 class="countdown-title">
                    <?php esc_html_e( 'Hours', 'blossom-shop-pro' ); ?>
                </h5>
            </div>
            <div class="countdown-block">
                <span class="minutes"></span>
                <h5 class="countdown-title">
                    <?php esc_html_e( 'Minutes', 'blossom-shop-pro' ); ?>
                </h5>
            </div>
            <div class="countdown-block">
                <span class="seconds"></span>
                <h5 class="countdown-title">
                    <?php esc_html_e( 'Seconds', 'blossom-shop-pro' ); ?>
                </h5>
            </div>
        <?php
        }
    }    
}
endif;

if ( ! function_exists( 'blossom_shop_pro_get_views' ) ) :
/**
 * Function to get the post view count 
 */
function blossom_shop_pro_get_views( $post_id ){
    $count_key = '_blossom_shop_pro_view_count';
    $count = get_post_meta( $post_id, $count_key, true );
    if( $count == '' ){        
        return __( '0 View', 'blossom-shop-pro' );
    }elseif( $count <= 1 ){
        return $count. __(' View', 'blossom-shop-pro' );
    }else{
        return $count. __(' Views', 'blossom-shop-pro' );    
    }    
}
endif;

if ( ! function_exists( 'blossom_shop_pro_singular_post_thumbnail' ) ) :
/**
 * Singular Images
*/
function blossom_shop_pro_singular_post_thumbnail() {
    $return = '';
    $ed_featured = get_theme_mod( 'ed_featured_image', true );    

    if( is_singular() ){
        $image_size = 'blossom-shop-single';
        if( is_single() ){
            if( $ed_featured ) $return .= get_the_post_thumbnail_url( '', $image_size );
        }elseif( is_page_template( 'templates/contact.php' ) ){
            $background_image = get_theme_mod( 'contact_background_image', get_template_directory_uri() .'/images/page-header-bg.jpg' );
            if( has_post_thumbnail() ) :
                $return .= get_the_post_thumbnail_url( '', $image_size );
            else:
                $return .= $background_image;
            endif;
        }elseif( is_page_template( 'templates/about.php' ) ){
            $background_image = get_theme_mod( 'about_background_image', get_template_directory_uri() .'/images/page-header-bg.jpg' );
            if( has_post_thumbnail() ) :
                $return .= get_the_post_thumbnail_url( '', $image_size );
            else:
                $return .= $background_image;
            endif;
        }elseif( is_page_template( 'templates/blossom-portfolio.php' ) ){
            $background_image = get_theme_mod( 'header_background_image', get_template_directory_uri() .'/images/page-header-bg.jpg' );
            if( has_post_thumbnail() ) :
                $return .= get_the_post_thumbnail_url( '', $image_size );
            else:
                $return .= $background_image;
            endif;
        }else{
            $background_image = get_theme_mod( 'header_background_image', get_template_directory_uri() .'/images/page-header-bg.jpg' );
            if( has_post_thumbnail() ) :
                $return .= get_the_post_thumbnail_url( '', $image_size );
            else:
                $return .= $background_image;
            endif;
        }
    }if( is_404() ){
        $return =  get_template_directory_uri() .'/images/error-page-bg.jpg';
    }

    return $return;
}
endif;

if ( ! function_exists( 'blossom_shop_pro_blog_layout_image_size' ) ) :
/**
 * Blog Layout Image Size
*/
function blossom_shop_pro_blog_layout_image_size() {
    $blog_layout  = get_theme_mod( 'blog_page_layout', 'classic-layout' );
    $sidebar      = blossom_shop_pro_sidebar();

    if( $blog_layout == 'classic-layout') { 
        $image_size = ( $sidebar ) ? 'blossom-shop-blog' : 'blossom-shop-blog-full';
    }elseif( $blog_layout == 'grid-layout' ){ 
        $image_size = 'blossom-shop-blog-list';
    }elseif( $blog_layout == 'list-layout' ) {
        $image_size = 'blossom-shop-blog';    
    }else{
        $image_size = 'blossom-shop-blog';
    }

    return $image_size;
}
endif;

if ( ! function_exists( 'blossom_shop_pro_slider_image_sizes' ) ) :
/**
 * Slider Layout Image Size
*/
function blossom_shop_pro_slider_image_sizes() {
    $slider_layout  = get_theme_mod( 'slider_layout', 'one' );

    if( $slider_layout == 'two' ) { 
        $image_size = 'blossom-shop-slider-two';
    }elseif( $slider_layout == 'four' || $slider_layout == 'six' ){ 
        $image_size = 'blossom-shop-slider-three';
    }elseif( $slider_layout == 'five' ){ 
        $image_size = 'blossom-shop-slider-four';
    }else{
        $image_size = 'blossom-shop-slider';
    }

    return $image_size;
}
endif;

if ( ! function_exists('blossom_shop_pro_onsale_product_count' ) ) :
/**
 * Onsale Product Count
*/
function blossom_shop_pro_onsale_product_count( $cat_id = 0 ) {
    
    $args = array(
        'post_type' => 'product',
        'post_status' => 'published',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $cat_id
            ),
            array(
                'taxonomy' => 'product_visibility',
                'terms' => array('exclude-from-catalog'),
                'field' => 'name',
                'operator' => 'NOT IN',
            ),
        ),
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'relation' => 'OR',
                array(
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array(
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            ),
        )
    );

    $qry    = new WP_Query($args);
    $count  = $qry->found_posts;
    wp_reset_postdata();
    
    if( $count ) {
        return '<span class="product-count onsale-product-count"><span class="item-count">' . absint($count) . '</span><span class="item-texts item-texts-onsale">' . esc_html__( 'Sale!', 'blossom-shop-pro' ) . '</span></span>';
    }else{
        return false;
    }

}
endif;

if( ! function_exists( 'blossom_shop_pro_get_category_tabs' ) ) :
/**
 * Query for Special Pricing Tabs
*/
function  blossom_shop_pro_get_category_tabs(){

    $show_category_tabs = get_theme_mod( 'cat_tab_custom' );
    if( taxonomy_exists( 'product_cat' ) && $show_category_tabs ){
        
        $terms_array = array();
        
        foreach ( $show_category_tabs  as $show_category_tab ) {
            $choose_cat = ( isset( $show_category_tab['choose_cat'] ) && $show_category_tab['choose_cat'] ) ? $show_category_tab['choose_cat'] : '';
            $terms_array[] = $choose_cat;
        }

        if( $terms_array ){
            $index = 1;
            $first_category = '';
            echo '<div class="tab-btn-wrap">';            
            foreach( $terms_array as $terms ){
                $t = get_term_by( 'id', $terms, 'product_cat' );
                $class_active = ( $index == 1 ) ? ' active' : '';
                $class_add = ( $index != 1 ) ? ' ajax' : '';
                echo '<button data-id="'. esc_attr( $t->slug ) . '" class="tab-'. absint( $index ) .' tab-btn' . esc_attr( $class_add ) . esc_attr( $class_active )  . '">' . esc_html( $t->name ) . '</button>';
                if( $index == 1 ) $first_category = $t->slug;
                $index++;
            }
            echo '</div>';
            echo '<div class="tab-content-wrap"><span class="item-loader"><i class="fas fa-spinner fa-spin"></i></span>';            
            blossom_shop_pro_get_category_tab_contents( $first_category );
            echo '</div>';
        }
    }
}
endif;

if( ! function_exists( 'blossom_shop_pro_get_category_tab_contents' ) ) :
/**
 * Query for Special Pricing Tabs
*/
function blossom_shop_pro_get_category_tab_contents( $cat = '' ){

    if( taxonomy_exists( 'product_cat' ) ){
        
        $ed_crop_all    = get_theme_mod( 'ed_crop_all', false );
        $image_size = ( $ed_crop_all ) ? 'full' : 'blossom-shop-recent';

        if( isset( $_GET['bsp_theme_nonce'] ) && wp_verify_nonce( $_GET['bsp_theme_nonce'], 'blossom_shop_pro_theme_nonce' ) ){
            var_dump($_GET['bsp_theme_type']);
            var_dump($_GET['bsp_theme_nonce']);
            $args['post_type']      = 'product';
            $args['posts_per_page'] = 8;
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $_GET['bsp_theme_type'],
                )
            );
            $id = $_GET['bsp_theme_type'];
        }else{
            $args['post_type']      = 'product';
            $args['posts_per_page'] = -1;
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $cat,
                )
            );
            $id = $cat;
        }



        // $args = array(
        //     'post_type'      => 'product',
        //     'post_status'    => 'publish',
        //     'tax_query' => array(
        //         array(
        //             'taxonomy' => 'product_cat',
        //             'field'    => 'slug',
        //             'terms'    => $cat,
        //         ),
        //     ),
        //     'posts_per_page' => 8,
        // );
        
        $qry = new WP_Query( $args );
     
        if( $qry->have_posts() ) : ?> 
            <div data-id="<?php echo esc_attr( $id ); ?>" class="tab-content <?php echo esc_attr( $id ); ?>">
                <div class="tabs-product owl-carousel">
                    <?php
                    while( $qry->have_posts() ){
                        $qry->the_post(); global $product; ?>
                        <div class="item">                              
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( $image_size );    
                                    }else{
                                        blossom_shop_pro_get_fallback_svg( $image_size );
                                    }
                                    ?>
                                </a>
                                <?php if( is_yith_whislist_activated() ) echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                                <?php if( is_yith_quickview_activated() ) echo do_shortcode( '[yith_quick_view]' ); ?>
                                <?php if( is_yith_compare_activated() ) echo do_shortcode( '[yith_compare_button]' ); ?>
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                            <div class="product-content">
                                <?php                            
                                    the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 
                                ?>
                            </div>                              
                            <?php woocommerce_template_single_price(); //price ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         */
        do_action( 'wp_body_open' );
    }
endif;

if ( ! function_exists( 'blossom_shop_pro_comment_toggle' ) ):
/**
 * Function toggle comment section position
*/
function blossom_shop_pro_comment_toggle(){
    $comment_postion = get_theme_mod( 'toggle_comments', false );

    if ( $comment_postion ) {
        $priority = 17;
    }else{
        $priority = 45;
    }
    return intval( $priority ) ;
}
endif;

if ( is_customizer_search_activated () ):
    function blossom_shop_pro_plugin_actions(){
        $customizer_search = Customizer_Search::instance();
        remove_action( 'customize_controls_print_footer_scripts', array( $customizer_search, 'footer_scripts') );
        add_action( 'customize_controls_print_footer_scripts',function(){
            echo '<script type="text/html" id="tmpl-search-button">
                <button type="button" class="customize-search-toggle dashicons dashicons-search" aria-expanded="false"><span class="screen-reader-text">' . __( "Search", "blossom-shop-pro" ) .'</span></button>
            </script>
            <script type="text/html" id="tmpl-search-form">
                <div id="accordion-section-customizer-search" class="open">
                    <h4 class="customizer-search-section accordion-section-title">
                        <span class="search-input">' . __( "Search", "blossom-shop-pro" ) .'</span>
                        <span class="search-field-wrapper">
                            <input type="text" placeholder="'.__( "Search...", "blossom-shop-pro" ).'" name="customizer-search-input" autofocus="autofocus" id="customizer-search-input" class="customizer-search-input">
                            <button type="button" class="button clear-search" tabindex="0">' . __( "Clear", "blossom-shop-pro" ) .'</button>
                        </span>
                    </h4>
                </div>
            </script>
            ';
        });
    }
    add_action('init','blossom_shop_pro_plugin_actions');
endif;