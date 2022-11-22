<?php
/**
 * Blossom Shop Pro Template Functions which enhance the theme by hooking into WordPress
 *
 * @package Blossom_Shop_Pro
 */

if( ! function_exists( 'blossom_shop_pro_doctype' ) ) :
/**
 * Doctype Declaration
*/
function blossom_shop_pro_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'blossom_shop_pro_doctype', 'blossom_shop_pro_doctype' );

if( ! function_exists( 'blossom_shop_pro_head' ) ) :
/**
 * Before wp_head 
*/
function blossom_shop_pro_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'blossom_shop_pro_before_wp_head', 'blossom_shop_pro_head' );

if( ! function_exists( 'blossom_shop_pro_page_start' ) ) :
/**
 * Page Start
*/
function blossom_shop_pro_page_start(){ ?>
    <div id="page" class="site">
    <a class="skip-link" href="#about_section"><?php esc_html_e( 'Skip to Content', 'blossom-shop-pro' ); ?></a>
    <?php
}
endif;
add_action( 'blossom_shop_pro_before_header', 'blossom_shop_pro_page_start', 20 );

if( ! function_exists( 'blossom_shop_pro_sticky_bar' ) ) :
/**
 * Sticky Bar
*/
function blossom_shop_pro_sticky_bar(){ 
    $ed_top_bar          = get_theme_mod( 'ed_top_bar', false );
    $notification_text   = get_theme_mod( 'notification_text', __( 'End of Season SALE now on thru 1/21.','blossom-shop-pro' ) );
    $notification_btn_url= get_theme_mod( 'notification_btn_url', '#' );
    $notification_label  = get_theme_mod( 'notification_label', __( 'SHOP NOW', 'blossom-shop-pro' ) );
    $top_bar_type        = get_theme_mod( 'top_bar_type', 'top_button_link' );
    $new_tab      = get_theme_mod( 'ed_open_new_target', false );
    $header_newsletter_shortcode  = get_theme_mod( 'header_newsletter_shortcode' );
    $target = $new_tab ? ' target="_blank"' : '';

    if( $ed_top_bar ){
        if( $top_bar_type == 'top_button_link' && ( $notification_text || ( $notification_label && $notification_btn_url ) ) ) : ?>
            <div class="sticky-t-bar active">
                <div class="sticky-bar-content">
                    <div class="container">
                        <span class="get-notification-text"><?php echo esc_html( $notification_text ); ?></span>
                        <a href="<?php echo esc_url( $notification_btn_url ); ?>" class="btn-readmore"<?php echo $target ?>><?php echo esc_html( $notification_label ); ?></a>
                    </div>
                </div>
                <button class="close"></button>
            </div> <!-- .sticky-t-bar -->
        <?php 
        elseif( is_btnw_activated() && $top_bar_type == 'top_newsletter' && $header_newsletter_shortcode ) : ?>
            <div class="sticky-t-bar active">
                <div class="sticky-bar-content">
                    <div class="container">
                        <?php echo do_shortcode( $header_newsletter_shortcode ); ?>
                    </div>
                </div>
                <button class="close"></button>
            </div> <!-- .sticky-t-bar -->
        <?php endif;
    } 
}
endif;
add_action( 'blossom_shop_pro_header', 'blossom_shop_pro_sticky_bar', 10 );

if( ! function_exists( 'blossom_shop_pro_header' ) ) :
/**
 * Header Start
*/
function blossom_shop_pro_header(){ 

    $header_array = array( 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve' );
    $header = get_theme_mod( 'header_layout', 'three' );
    if( in_array( $header, $header_array ) ){            
        get_template_part( 'headers/' . $header );
    }
}
endif;
add_action( 'blossom_shop_pro_header', 'blossom_shop_pro_header', 20 );

if( ! function_exists( 'blossom_shop_pro_show_banner' ) ) :
/**
 * Display Banner section in Show banner
*/
function blossom_shop_pro_show_banner(){

    $ed_banner           = get_theme_mod( 'ed_banner_section', 'slider_banner' );
    if( is_home() && $ed_banner ) get_template_part( 'sections/home/banner' );
}
endif;
add_action( 'blossom_shop_pro_after_header', 'blossom_shop_pro_show_banner', 5 );

if( ! function_exists( 'blossom_shop_pro_featured_section' ) ) :
/**
 * Featured Section
*/
function blossom_shop_pro_featured_section(){ 
    if( is_home() && is_active_sidebar( 'featured' ) ) { ?>
        <section class="blog-page-feature-section">
            <div class="container">
                <?php dynamic_sidebar( 'featured' ); ?>
            </div>
        </section> <!-- .blog-page-feature-section -->
    <?php 
    }
}
endif;
add_action( 'blossom_shop_pro_after_header', 'blossom_shop_pro_featured_section', 10 );

if( ! function_exists( 'blossom_shop_pro_content_start' ) ) :
/**
 * Content Start
 *   
*/
function blossom_shop_pro_content_start(){


    $home_sections      = blossom_shop_pro_get_home_sections();
    $background_image   = blossom_shop_pro_singular_post_thumbnail();
    $shop_background_image   = get_theme_mod( 'shop_background_image', false );
    $add_style_one = '';

    $shop_background_class = ( is_woocommerce_activated() && is_shop() && $shop_background_image ) ? ' has-bgimg' : '';

    if( is_woocommerce_activated() && is_shop() && $shop_background_image ) { 
        $add_style_one = 'style="background-image: url(\'' . esc_url( $shop_background_image ) . '\')"' ;
    }
    if ( ! is_home() && ! is_front_page() ) blossom_shop_pro_breadcrumb();
    
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>
        <div id="content" class="site-content">            
        <?php if( ! is_home() && !( is_woocommerce_activated() && is_product() ) ) : ?>
            <header class="page-header<?php echo esc_attr( $shop_background_class ); ?>" <?php if( is_singular() || is_404() ) : ?> style="background-image: url('<?php echo esc_url( $background_image ); ?>')" <?php endif; ?> <?php echo $add_style_one; ?>>
                <div class="container">
        			<?php        
                        if( is_archive() ){ 
                            if( is_author() ){
                                $author_title = get_the_author_meta( 'display_name' );
                                $author_description = get_the_author_meta( 'description' ); ?>
                                <div class="author-section">
                                    <figure class="author-img"><?php blossom_shop_pro_gravatar( get_the_author_meta( 'ID' ), 120 ); ?></figure>
                                    <div class="author-content-wrap">
                                        <?php 
                                            echo '<h3 class="author-name">' . esc_html__( 'All Posts By: ','blossom-shop-pro' ) . esc_html( $author_title ) . '</h3>';
                                            echo '<div class="author-content">' . wpautop( wp_kses_post( $author_description ) ) . '</div>';
                                            blossom_shop_pro_author_social();
                                        ?>      
                                    </div>
                                </div>
                                <?php 
                            }
                            else{
        					    the_archive_description( '<span class="sub-title">', '</span>' );
                                the_archive_title();
                            }             
                        }
                        
                        if( is_search() ){ 
                            echo '<span class="sub-title">' . esc_html__( 'SEARCH RESULTS FOR:', 'blossom-shop-pro' ) . '</span>';
                            get_search_form();
                        }
                        
                        if( is_page() ){
                            the_title( '<h1 class="page-title">', '</h1>' );
                        }

                        if( is_404() ) {
                            echo '<h1 class="page-title">' . esc_html__( 'Uh-Oh...','blossom-shop-pro' ) . '</h1>';
                            echo '<div class="page-desc">' . esc_html__( 'The page you are looking for may have been moved, deleted, or possibly never existed.','blossom-shop-pro' ) . '</div>';
                        }

                        if( is_single() ) {
                            blossom_shop_pro_category();
                            the_title( '<h1 class="entry-title">', '</h1>' );
                            if( 'post' === get_post_type() ){
                                echo '<div class="entry-meta">';
                                blossom_shop_pro_posted_on();
                                blossom_shop_pro_comment_count();
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
    		</header>
        <?php
    endif;

     ?> <div class="container">
    <?php 
    }
}
endif;
add_action( 'blossom_shop_pro_content', 'blossom_shop_pro_content_start' );

if ( ! function_exists( 'blossom_shop_pro_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function blossom_shop_pro_post_thumbnail() {
	global $wp_query;
    $image_size  = 'thumbnail';
    $sidebar     = blossom_shop_pro_sidebar();
    $image_size  = blossom_shop_pro_blog_layout_image_size(); 
    $ed_blog_image = get_theme_mod( 'ed_blog_image', false );
    if( is_home() || is_archive() || is_search() ){        
        echo '<figure class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
        if( has_post_thumbnail() && ! $ed_blog_image ){                        
            the_post_thumbnail( $image_size, array( 'itemprop' => 'image' ) );    
        }elseif( has_post_thumbnail() && $ed_blog_image ){                        
            the_post_thumbnail();    
        }else{
            blossom_shop_pro_get_fallback_svg( $image_size );//fallback    
        }        
        echo '</a></figure>';
    }
}
endif;
add_action( 'blossom_shop_pro_before_post_entry_content', 'blossom_shop_pro_post_thumbnail', 10 );

if( ! function_exists( 'blossom_shop_pro_entry_header' ) ) :
/**
 * Entry Header
*/
function blossom_shop_pro_entry_header(){
    $blog_layout    = get_theme_mod( 'blog_page_layout', 'classic-layout' );

    if( is_single() ) {
        return false;
    } ?>
    <header class="entry-header">
        <?php             
            if( $blog_layout == 'classic-layout' ) echo '<div class="entry-meta">';
            blossom_shop_pro_category();
            if( $blog_layout == 'classic-layout' ) echo '</div>';

            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );       
            if( 'post' === get_post_type() && $blog_layout != 'classic-layout' ){
                echo '<div class="entry-meta">';
                blossom_shop_pro_posted_on();
                blossom_shop_pro_comment_count();
                echo '</div>';
            }
        ?>
    </header>         
    <?php    
}
endif;
add_action( 'blossom_shop_pro_post_entry_content', 'blossom_shop_pro_entry_header', 10 );

if( ! function_exists( 'blossom_shop_pro_entry_content' ) ) :
/**
 * Entry Content
*/
function blossom_shop_pro_entry_content(){ 
    $ed_excerpt = get_theme_mod( 'ed_excerpt', true ); ?>
    <div class="entry-content" itemprop="text">
		<?php
			if( is_singular() || ! $ed_excerpt || ( get_post_format() != false ) ){
                the_content();    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blossom-shop-pro' ),
    				'after'  => '</div>',
    			) );
            }else{
                the_excerpt();
            }
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'blossom_shop_pro_page_entry_content', 'blossom_shop_pro_entry_content', 15 );
add_action( 'blossom_shop_pro_post_entry_content', 'blossom_shop_pro_entry_content', 15 );

if( ! function_exists( 'blossom_shop_pro_entry_footer' ) ) :
/**
 * Entry Footer
*/
function blossom_shop_pro_entry_footer(){ 
    $readmore = get_theme_mod( 'read_more_text', __( 'READ MORE', 'blossom-shop-pro' ) );
    $blog_layout = get_theme_mod( 'blog_page_layout', 'classic-layout' ); ?>
	<footer class="entry-footer">
		<?php
			if( is_single() ){
			    blossom_shop_pro_tag();
			}
            
            if( is_home() || is_archive() || is_search() ){
                echo '<div class="button-wrap"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-readmore">' . esc_html( $readmore ) . '</a></div>';    
            }

            if( 'post' === get_post_type() && $blog_layout == 'classic-layout' && !is_single() ){
                echo '<div class="entry-right">';
                blossom_shop_pro_posted_on();
                blossom_shop_pro_comment_count();
                echo '</div>';
            }
            
            if( get_edit_post_link() ){
                edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'blossom-shop-pro' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
            }
		?>
	</footer><!-- .entry-footer -->
	<?php 
}
endif;
add_action( 'blossom_shop_pro_page_entry_content', 'blossom_shop_pro_entry_footer', 20 );
add_action( 'blossom_shop_pro_post_entry_content', 'blossom_shop_pro_entry_footer', 20 );

if ( ! function_exists('blossom_shop_pro_get_affiliate_shop' ) ):
/**
 * Affiliate Link
 */
function blossom_shop_pro_get_affiliate_shop() {
    $affiliate_code = get_post_meta( get_the_ID(), '_shop_pro_affiliate_code', true );
    $section_title = get_theme_mod( 'affiliate_widget_single_label', __( 'Shop This Look', 'blossom-shop-pro' ) );

    if ( $affiliate_code ) {
        echo '<div class="post-shop-wrap">';
        if ( $section_title ) echo '<section class="header"><h2 class="title">' . esc_html( $section_title ) . '</h2></section>';
        echo htmlspecialchars_decode( stripslashes( $affiliate_code ) );
        echo '</div>';
    }
}
endif;
add_action( 'blossom_shop_pro_after_post_content', 'blossom_shop_pro_get_affiliate_shop', 15 );

if( ! function_exists( 'blossom_shop_pro_navigation' ) ) :
/**
 * Navigation
*/
function blossom_shop_pro_navigation(){
    if( is_single() ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if( $prev_post || $next_post ) { ?>            
            <nav class="post-navigation pagination" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'blossom-shop-pro' ); ?></h2>
                <div class="nav-links">
                    <?php if( $prev_post ){ ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                            <span class="meta-nav"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><defs><style>.arla{fill:#999596;}</style></defs><path class="arla" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(22 16) rotate(180)"/></svg><?php esc_html_e( 'Previous Post', 'blossom-shop-pro' ); ?></span>
                            <span class="post-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                        </a>
                        <figure class="post-img">
                            <?php
                            $prev_img = get_post_thumbnail_id( $prev_post->ID );
                            if( $prev_img ){
                                $prev_url = wp_get_attachment_image_url( $prev_img, 'thumbnail' );
                                echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0', $prev_post ) . '">';                                        
                            }else{
                                blossom_shop_pro_get_fallback_svg( 'thumbnail' );
                            }
                            ?>
                        </figure>
                    </div>
                    <?php } ?>
                    <?php if( $next_post ){ ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                            <span class="meta-nav"><?php esc_html_e( 'Next Post', 'blossom-shop-pro' ); ?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8"><defs><style>.arra{fill:#999596;}</style></defs><path class="arra" d="M16.01,11H8v2h8.01v3L22,12,16.01,8Z" transform="translate(-8 -8)"/></svg></span>
                            <span class="post-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                        </a>
                        <figure class="post-img">
                            <?php
                            $next_img = get_post_thumbnail_id( $next_post->ID );
                            if( $next_img ){
                                $next_url = wp_get_attachment_image_url( $next_img, 'thumbnail' );
                                echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0', $next_post ) . '">';                                        
                            }else{
                                blossom_shop_pro_get_fallback_svg( 'thumbnail' );
                            }
                            ?>
                        </figure>
                    </div>
                    <?php } ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        $pagination = get_theme_mod( 'pagination_type', 'numbered' );
        
        switch( $pagination ){
            case 'default': // Default Pagination
            
            the_posts_navigation();
            
            break;
            
            case 'numbered': // Numbered Pagination
            
            the_posts_pagination( array(
                'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M152.485 396.284l19.626-19.626c4.753-4.753 4.675-12.484-.173-17.14L91.22 282H436c6.627 0 12-5.373 12-12v-28c0-6.627-5.373-12-12-12H91.22l80.717-77.518c4.849-4.656 4.927-12.387.173-17.14l-19.626-19.626c-4.686-4.686-12.284-4.686-16.971 0L3.716 247.515c-4.686 4.686-4.686 12.284 0 16.971l131.799 131.799c4.686 4.685 12.284 4.685 16.97-.001z"></path></svg>',
                'next_text'          => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M295.515 115.716l-19.626 19.626c-4.753 4.753-4.675 12.484.173 17.14L356.78 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h344.78l-80.717 77.518c-4.849 4.656-4.927 12.387-.173 17.14l19.626 19.626c4.686 4.686 12.284 4.686 16.971 0l131.799-131.799c4.686-4.686 4.686-12.284 0-16.971L312.485 115.716c-4.686-4.686-12.284-4.686-16.97 0z"></path></svg>',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blossom-shop-pro' ) . ' </span>',
            ) );
            
            break;
            
            case 'load_more': // Load More Button
            case 'infinite_scroll': // Auto Infinite Scroll
            
            echo '<div class="pagination"></div>';
            
            break;
            
            default:
            
            the_posts_navigation();
            
            break;
        }
    }
}
endif;
add_action( 'blossom_shop_pro_after_post_content', 'blossom_shop_pro_navigation', 25 );
add_action( 'blossom_shop_pro_after_posts_content', 'blossom_shop_pro_navigation' );

if( ! function_exists( 'blossom_shop_pro_author' ) ) :
/**
 * Author Section
*/
function blossom_shop_pro_author(){ 
    $ed_author_section = get_theme_mod( 'ed_author', false );
    $author_title = get_the_author_meta( 'display_name' );
    $author_description = get_the_author_meta( 'description' );
    if( !$ed_author_section && $author_title && $author_description ) { ?>
        <div class="author-section">
            <figure class="author-img"><?php blossom_shop_pro_gravatar( get_the_author_meta( 'ID' ), 120 ); ?></figure>
            <div class="author-content-wrap">
                <?php 
                    echo '<h3 class="author-name">' . esc_html( $author_title ) . '</h3>';
                    echo '<div class="author-content">' . wpautop( wp_kses_post( $author_description ) ) . '</div>';
                    blossom_shop_pro_author_social();
                ?>      
            </div>
        </div>
    <?php
    }
}
endif;
add_action( 'blossom_shop_pro_after_post_content', 'blossom_shop_pro_author', 20 );

if( ! function_exists( 'blossom_shop_pro_related_posts' ) ) :
/**
 * Related Posts 
*/
function blossom_shop_pro_related_posts(){ 
    $ed_related_post = get_theme_mod( 'ed_related', true );
    
    if( $ed_related_post ){
        blossom_shop_pro_get_posts_list( 'related' );    
    }
}
endif;                                                                               
add_action( 'blossom_shop_pro_after_post_content', 'blossom_shop_pro_related_posts', 35 );

if( ! function_exists( 'blossom_shop_pro_latest_posts' ) ) :
/**
 * Latest Posts
*/
function blossom_shop_pro_latest_posts(){ 
    blossom_shop_pro_get_posts_list( 'latest' );
}
endif;
add_action( 'blossom_shop_pro_latest_posts', 'blossom_shop_pro_latest_posts' );

if( ! function_exists( 'blossom_shop_pro_comment' ) ) :
/**
 * Comments Template 
*/
function blossom_shop_pro_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if( get_theme_mod( 'ed_comments', true ) && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'blossom_shop_pro_after_post_content', 'blossom_shop_pro_comment', blossom_shop_pro_comment_toggle() );
add_action( 'blossom_shop_pro_after_page_content', 'blossom_shop_pro_comment' );

if( ! function_exists( 'blossom_shop_pro_content_end' ) ) :
/**
 * Content End
*/
function blossom_shop_pro_content_end(){ 
    $home_sections = blossom_shop_pro_get_home_sections(); 
    if( ! ( is_front_page() && ! is_home() && $home_sections ) ){ ?>            
        </div><!-- .container -->        
    </div><!-- .site-content -->
    <?php
    }
}
endif;
add_action( 'blossom_shop_pro_before_footer', 'blossom_shop_pro_content_end', 20 );

if( ! function_exists( 'blossom_shop_pro_instagram' ) ) :
/**
 * Blossom Instagram
*/
function blossom_shop_pro_instagram(){
    if( is_btif_activated() ){
        $ed_instagram = get_theme_mod( 'ed_instagram', false );
        if( $ed_instagram ){
            echo '<div class="instagram-section">';
            echo do_shortcode( '[blossomthemes_instagram_feed]' );
            echo '</div>';    
        }
    }
}
endif;
add_action( 'blossom_shop_pro_before_footer_start', 'blossom_shop_pro_instagram', 10 );

if( ! function_exists( 'blossom_shop_pro_newsletter' ) ) :
/**
 * Blossom Newsletter
*/
function blossom_shop_pro_newsletter(){
    $ed_newsletter = get_theme_mod( 'ed_newsletter', false );
    $newsletter = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter && !empty( $newsletter ) ){
        echo '<section class="newsletter-section">';
        echo do_shortcode( $newsletter );   
        echo '</section>';            
    }
}
endif;
add_action( 'blossom_shop_pro_before_footer_start', 'blossom_shop_pro_newsletter', 20 );

if( ! function_exists( 'blossom_shop_pro_footer_start' ) ) :
/**
 * Footer Start
*/
function blossom_shop_pro_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
    <?php
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_start', 10 );

if( ! function_exists( 'blossom_shop_pro_footer_one' ) ) :
/**
 * Footer Top
*/
function blossom_shop_pro_footer_one(){    
    $footer_sidebars = array( 'footer-five', 'footer-six', 'footer-seven', 'footer-eight' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-top">
            <div class="container">
                <div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
                    <div class="col">
                       <?php dynamic_sidebar( $active ); ?> 
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <?php 
    }
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_one', 15 );

if( ! function_exists( 'blossom_shop_pro_footer_contact' ) ) :
/**
 * Blossom Footer Contact
*/
function blossom_shop_pro_footer_contact(){ 

    $phone_label = get_theme_mod( 'phone_label', __( 'Phone Number', 'blossom-shop-pro' ) );
    $phone       = get_theme_mod( 'phone', '1-888-123-456' );
    $email_label = get_theme_mod( 'email_label', __( 'Email', 'blossom-shop-pro' ) );
    $email       = get_theme_mod( 'email', 'mail@mysite.com' );
    $opening_hours_label = get_theme_mod( 'opening_hours_label', __( 'Opening Hours', 'blossom-shop-pro' ) );
    $opening_hours       = get_theme_mod( 'opening_hours', 'Mon - Fri: 7AM - 9PM' );
    $whats_app_label     = get_theme_mod( 'whats_app_label', __( 'Whats App', 'blossom-shop-pro' ) );
    $whats_app           = get_theme_mod( 'whats_app', '1-888-123-456' );

    if( !empty( $phone_label ) || !empty( $phone ) || !empty( $email_label ) || !empty( $email ) || !empty( $opening_hours_label ) || !empty( $opening_hours ) || !empty( $whats_app_label ) || !empty( $whats_app ) ) : ?>
        <section class="footer-contact-section">
            <div class="container">
                <?php if( !empty( $phone_label ) || !empty( $phone ) ) : ?>
                    <div class="section-block">
                        <div class="block-img">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path d="M10.08,7a24.625,24.625,0,0,0,.9,5.18l-2.4,2.4A29.651,29.651,0,0,1,7.06,7h3.02M29.8,31.04a25.505,25.505,0,0,0,5.2.9v2.98a30.853,30.853,0,0,1-7.6-1.5l2.4-2.38M12,3H5A2.006,2.006,0,0,0,3,5,34,34,0,0,0,37,39a2.006,2.006,0,0,0,2-2V30.02a2.006,2.006,0,0,0-2-2,22.814,22.814,0,0,1-7.14-1.14,1.679,1.679,0,0,0-.62-.1,2.049,2.049,0,0,0-1.42.58l-4.4,4.4A30.3,30.3,0,0,1,10.24,18.58l4.4-4.4a2.007,2.007,0,0,0,.5-2.04A22.721,22.721,0,0,1,14,5a2.006,2.006,0,0,0-2-2Z" transform="translate(-3 -3)" fill="#868e96"/></svg>
                        </div>
                        <div class="block-content-wrap">
                            <?php if( !empty( $phone_label ) ) echo '<h4 class="block-title phone-label">' . esc_html( $phone_label ) . '</h4>';
                            if( !empty( $phone ) ) echo '<span class="block-content phone"><a href="' . esc_url( 'tel:' . $phone ) . '">' . esc_html( $phone ) . '</a></span>'; ?>
                        </div>
                    </div>
                <?php endif; ?>
                    
                <?php if( !empty( $email_label ) || !empty( $email ) ) : ?>
                    <div class="section-block">
                        <div class="block-img">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"><path d="M22,1.95a20,20,0,0,0,0,40H32v-4H22a16.2,16.2,0,0,1-16-16,16.2,16.2,0,0,1,16-16,16.2,16.2,0,0,1,16,16v2.86a3.233,3.233,0,0,1-3,3.14,3.233,3.233,0,0,1-3-3.14V21.95a10,10,0,1,0-2.92,7.06A7.406,7.406,0,0,0,35,31.95a7.026,7.026,0,0,0,7-7.14V21.95A20.007,20.007,0,0,0,22,1.95Zm0,26a6,6,0,1,1,6-6A5.992,5.992,0,0,1,22,27.95Z" transform="translate(-2 -1.95)" fill="#868e96"/></svg>
                        </div>
                        <div class="block-content-wrap">
                            <?php if( !empty( $email_label ) ) echo '<h4 class="block-title email-label">' . esc_html( $email_label ) . '</h4>';
                            if( !empty( $email ) ) echo '<span class="block-content email"><a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a></span>'; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( !empty( $opening_hours_label ) || !empty( $opening_hours ) ) : ?>
                    <div class="section-block">
                        <div class="block-img">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><g transform="translate(0 0)"><path d="M20,2A18,18,0,1,0,38,20,18.053,18.053,0,0,0,20,2Zm0,32.4A14.4,14.4,0,1,1,34.4,20,14.419,14.419,0,0,1,20,34.4Z" transform="translate(-2 -2)" fill="#868e96"/><path d="M13.7,7H11V17.8l9.36,5.76,1.44-2.34-8.1-4.86Z" transform="translate(5.2 2)" fill="#868e96"/></g></svg>
                        </div>
                        <div class="block-content-wrap">
                            <?php if( !empty( $opening_hours_label ) ) echo '<h4 class="block-title opening-label">' . esc_html( $opening_hours_label ) . '</h4>';
                            if( !empty( $opening_hours ) ) echo '<span class="block-content opening">' . esc_html( $opening_hours ) . '</span>'; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( !empty( $whats_app_label ) || !empty( $whats_app ) ) : ?>
                    <div class="section-block">
                        <div class="block-img">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"><path d="M36,17.538A17.608,17.608,0,0,1,18.332,35.077,17.783,17.783,0,0,1,9.791,32.9L0,36l3.195-9.414A17.287,17.287,0,0,1,.653,17.54a17.674,17.674,0,0,1,35.347,0ZM18.331,2.793A14.822,14.822,0,0,0,3.468,17.54,14.609,14.609,0,0,0,6.3,26.188L4.446,31.65l5.711-1.8A14.784,14.784,0,1,0,18.331,2.793Zm8.918,18.786c-.105-.175-.393-.282-.82-.513-.445-.214-2.566-1.242-2.974-1.383-.388-.144-.677-.214-.965.213s-1.122,1.4-1.372,1.683c-.267.285-.516.321-.945.108a11.777,11.777,0,0,1-3.479-2.137,12.723,12.723,0,0,1-2.409-2.974c-.258-.434-.03-.664.186-.876.2-.195.435-.507.65-.756a2.625,2.625,0,0,0,.437-.71.813.813,0,0,0-.036-.763c-.107-.214-.979-2.325-1.337-3.187s-.718-.717-.969-.717-.543-.036-.837-.036a1.6,1.6,0,0,0-1.158.541,4.806,4.806,0,0,0-1.515,3.583A8.271,8.271,0,0,0,11.478,18.1c.216.285,2.992,4.758,7.4,6.48s4.4,1.153,5.2,1.082A4.413,4.413,0,0,0,27,23.622,3.646,3.646,0,0,0,27.249,21.579Z" fill="#868e96"/></svg>
                        </div>
                        <div class="block-content-wrap">
                            <?php if( !empty( $whats_app_label ) ) echo '<h4 class="block-title whatsapp-label">' . esc_html( $whats_app_label ) . '</h4>';
                            if( !empty( $whats_app ) ) echo '<span class="block-content whatsapp"><a href="' . esc_url( 'https://wa.me/' . preg_replace( '/\D/', '', $whats_app ) ) . '" target="_blank" rel="noopener">' . esc_html( $whats_app ) . '</a></span>'; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section> <!-- .footer-contact-section -->
    <?php
    endif; 
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_contact', 20 );

if( ! function_exists( 'blossom_shop_pro_footer_two' ) ) :
/**
 * Footer Top
*/
function blossom_shop_pro_footer_two(){    
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;
    
    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }
                 
    if( $active_sidebars ){ ?>
        <div class="footer-t">
    		<div class="container">
    			<div class="grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_two', 30 );

if( ! function_exists( 'blossom_shop_pro_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function blossom_shop_pro_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="container">
			<div class="site-info">            
            <?php
                blossom_shop_pro_get_footer_copyright();
                blossom_shop_pro_ed_author_link();
                blossom_shop_pro_ed_wp_link();
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link();
                }
            ?>               
            </div>
            <?php 
                blossom_shop_pro_payment_method();
                blossom_shop_pro_back_to_top(); 
            ?>
		</div>
	</div>
    <?php
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_bottom', 40 );

if( ! function_exists( 'blossom_shop_pro_footer_end' ) ) :
/**
 * Footer End 
*/
function blossom_shop_pro_footer_end(){ ?>
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'blossom_shop_pro_footer', 'blossom_shop_pro_footer_end', 50 );

if( ! function_exists( 'blossom_shop_pro_page_end' ) ) :
/**
 * Page End
*/
function blossom_shop_pro_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'blossom_shop_pro_after_footer', 'blossom_shop_pro_page_end', 20 );

if( ! function_exists( 'blossom_shop_pro_posts_per_page_count' ) ):
/**
*   Counts the Number of total posts in Archive, Search and Author
*/
function blossom_shop_pro_posts_per_page_count(){
    $pagination = get_theme_mod( 'pagination_type','numbered' );
    global $wp_query;
    if( is_archive() || is_search() && $wp_query->found_posts > 0 ) {
        if( $pagination != 'infinite_scroll' && $pagination != 'load_more' ) :
            $posts_per_page = get_option( 'posts_per_page' );
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $start_post_number = 0;
            $end_post_number   = 0;

            if( $wp_query->found_posts > 0 && !( is_woocommerce_activated() && is_shop() ) ):                
                $start_post_number = 1;
                if( $wp_query->found_posts < $posts_per_page  ) {
                    $end_post_number = $wp_query->found_posts;
                }else{
                    $end_post_number = $posts_per_page;
                }

                if( $paged > 1 ){
                    $start_post_number = $posts_per_page * ( $paged - 1 ) + 1;
                    if( $wp_query->found_posts < ( $posts_per_page * $paged )  ) {
                        $end_post_number = $wp_query->found_posts;
                    }else{
                        $end_post_number = $paged * $posts_per_page;
                    }
                }

                printf( esc_html__( '%1$s Showing:  %2$s - %3$s of %4$s RESULTS %5$s', 'blossom-shop-pro' ), '<span class="post-count">', absint( $start_post_number ), absint( $end_post_number ), esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
            endif;
        else :
            printf( esc_html__( '%1$s Showing: %2$s RESULTS %3$s', 'blossom-shop-pro' ), '<span class="post-count">', esc_html( number_format_i18n( $wp_query->found_posts ) ), '</span>' );
        endif;
    }
}
endif; 
add_action( 'blossom_shop_pro_before_posts_content' , 'blossom_shop_pro_posts_per_page_count', 10 );