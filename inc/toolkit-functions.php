<?php
/**
 * Toolkit Filters
 *
 * @package Blossom_Shop_Pro
 */

if( ! function_exists( 'blossom_shop_pro_default_image_text_size' ) ) :
    function blossom_shop_pro_default_image_text_size(){
        return 'blossom-shop-featured';
    }
endif;
add_filter( 'bttk_it_img_size', 'blossom_shop_pro_default_image_text_size' );

if( ! function_exists( 'blossom_shop_pro_author_image' ) ) :
   function blossom_shop_pro_author_image(){
       return 'blossom-shop-blog-list';
   }
endif;
add_filter( 'author_bio_img_size', 'blossom_shop_pro_author_image' );

if( ! function_exists( 'blossom_shop_pro_testimonial_widget_filter' ) ) :
/**
 * Filter for Featured page widget
*/
function blossom_shop_pro_testimonial_widget_filter( $html, $args, $instance ){
    $obj = new BlossomThemes_Toolkit_Functions();
    $name   = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
    $designation   = ! empty( $instance['designation'] ) ? $instance['designation'] : '' ;        
    $testimonial = ! empty( $instance['testimonial'] ) ? $instance['testimonial'] : '';
    $image   = ! empty( $instance['image'] ) ? $instance['image'] : '';

    if( $image ){
        /** Added to work for demo testimonial compatible */
        $attachment_id = $image;
        if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
            $attachment_id = $obj->bttk_get_attachment_id( $image );
        }

        $icon_img_size = apply_filters('bttk_testimonial_icon_img_size','thumbnail');
    }
    
    ob_start(); ?>    
        <div class="bttk-testimonial-holder">
            <div class="bttk-testimonial-inner-holder">        
                <div class="text-holder">
                    <?php if( $image ){ ?>
                        <div class="img-holder">
                            <?php echo wp_get_attachment_image( $attachment_id, $icon_img_size, false, 
                                        array( 'alt' => esc_attr( $name )));?>
                        </div>
                    <?php }?>
                    <div class="testimonial-meta">
                       <?php 
                            if( $name ) echo '<span class="name">' . esc_html( $name ) . '</span>';
                            if( isset( $designation ) && $designation!='' ){
                                echo '<span class="designation">' . esc_html( $designation ) . '</span>';
                            }
                        ?>
                    </div>                              
                    <?php if( $testimonial ) echo '<div class="testimonial-content">' . wpautop( wp_kses_post( $testimonial ) ) . '</div>'; ?>
                </div>
            </div>
        </div>
    <?php 
    $html = ob_get_clean();
    return $html;
}
endif;
add_filter( 'blossom_testimonial_widget_filter', 'blossom_shop_pro_testimonial_widget_filter', 10, 3 );

if( ! function_exists( 'blossom_shop_pro_add_subtitle_on_cta_widget' ) ) :
/**
 * Add Subtitle In CTA Widget
*/
function blossom_shop_pro_add_subtitle_on_cta_widget( $widget, $return, $instance ) {

    if ( 'blossomtheme_companion_cta_widget' == $widget->id_base ) {
 
        $cta_extra_subtitle = isset( $instance['cta_extra_subtitle'] ) ? $instance['cta_extra_subtitle'] : '';
        ?>
            <p>
                <label for="<?php echo esc_attr( $widget->get_field_id('cta_extra_subtitle') ); ?>">
                    <?php esc_html_e( 'Subtitle', 'blossom-shop-pro' ); ?>
                </label>
                <input class="text" type="text" id="<?php echo esc_attr( $widget->get_field_id('cta_extra_subtitle') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('cta_extra_subtitle') ); ?>" value="<?php echo isset( $cta_extra_subtitle ) ? esc_html( $cta_extra_subtitle ) : ''; ?>" />
            </p>
        <?php
    }
}
endif;
add_filter( 'in_widget_form', 'blossom_shop_pro_add_subtitle_on_cta_widget', 10, 3 );

if( ! function_exists( 'blossom_shop_pro_save_subtitle_on_cta_widget' ) ) :
/**
 * Add Subtitle In CTA Widget
*/
function blossom_shop_pro_save_subtitle_on_cta_widget( $instance, $new_instance, $old_instance, $widget ) {

    if ( 'blossomtheme_companion_cta_widget' == $widget->id_base && !empty( $new_instance['cta_extra_subtitle'] ) ) {
        $instance['cta_extra_subtitle'] = !empty( $new_instance['cta_extra_subtitle'] ) ? $new_instance['cta_extra_subtitle'] : '';
    } 
    return $instance;
}
endif;
add_filter( 'widget_update_callback', 'blossom_shop_pro_save_subtitle_on_cta_widget', 10, 4 );

if( ! function_exists( 'blossom_shop_pro_dynamic_sidebar_params_on_cta_widget' ) ) :
/**
 * Add Subtitle In CTA Widget
*/
function blossom_shop_pro_dynamic_sidebar_params_on_cta_widget( $params ){

    global $wp_registered_widgets;
    $widget_id  = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if ( isset( $widget_opt[$widget_num]['cta_extra_subtitle'] ) ) {
        $params[0]['before_title'] = '<span class="sub-title">'. esc_html( $widget_opt[$widget_num]['cta_extra_subtitle'] ) . '</span>' . $params[0]['before_title'];
    }
    return $params;
}
endif;
add_filter( 'dynamic_sidebar_params', 'blossom_shop_pro_dynamic_sidebar_params_on_cta_widget' );

if( ! function_exists( 'blossom_shop_pro_defer_js_files' ) ) :
    function blossom_shop_pro_defer_js_files(){
        $defer_js = get_theme_mod( 'ed_defer', false );

        return ( $defer_js ) ? false : true;
    }
endif;
add_filter( 'bttk_public_assets_enqueue', 'blossom_shop_pro_defer_js_files' );
add_filter( 'btif_public_assets_enqueue', 'blossom_shop_pro_defer_js_files' );
add_filter( 'bten_public_assets_enqueue', 'blossom_shop_pro_defer_js_files' );