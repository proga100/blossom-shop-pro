<?php
/**
 * Product Deal Section
 * 
 * @package Blossom_Shop_Pro
 */
if( is_woocommerce_activated() ) {
    $sec_title  = get_theme_mod( 'prod_deal_title', __( 'HOT DEAL THIS WEEK', 'blossom-shop-pro' ) );
    $sub_title  = get_theme_mod( 'prod_deal_subtitle', __( 'FLAT 40% OFF EVERYTHING', 'blossom-shop-pro' ) );
    $url 		= get_theme_mod( 'prod_deal_button_url', '#' );
    $label    	= get_theme_mod( 'prod_deal_button', __( 'BUY NOW', 'blossom-shop-pro' ) );
    $prod_deal_image = get_theme_mod( 'prod_deal_background' );
    $countdown_timer = get_theme_mod( 'countdown_timer', '2021-08-20' );

    if( $countdown_timer ) : ?>
        <section id="product_deal_section" class="prod-deal-section">   
            <div class="grid">     
                <?php if( $prod_deal_image ) {
                    echo '<div class="image-wrapper">'; 
                    blossom_shop_pro_homepage_featured_image( 'prod_deal_background' );     
                    echo '</div>'; 
                } ?>
                <div class="content-wrapper">
                    <?php if( $sec_title || $sub_title ){ ?>
                        <div class="title-wrap">	
                            <?php 
                                if( $sec_title ) echo '<h2 class="section-title">' . esc_html( $sec_title ) . '</h2>';
                                if( $sub_title ) echo '<div class="section-desc">' . wpautop( wp_kses_post( $sub_title ) ) . '</div>'; 
                            ?>
                		</div>
                    <?php } ?>
                    <div class="section-grid">
            			<?php blossom_shop_pro_countdown(); ?>
            		</div>
            		<?php if( $url && $label ){ ?>
                        <div class="button-wrap">
                			<a href="<?php echo esc_url( $url ); ?>" class="bttn"><?php echo esc_html( $label ); ?></a>
                		</div>
                    <?php } ?>
                </div>
            </div>
        </section> <!-- .prod-deal-section -->
    <?php endif;
}