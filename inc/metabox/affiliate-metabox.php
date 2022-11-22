<?php 
/**
* Metabox for Affiliate Box
*
* @package Blossom_Shop_Pro
*
*/ 

function blossom_shop_pro_add_affiliate_box(){
    
    add_meta_box( 
        'blossom_shop_pro_affiliate_box',
        __( 'Affiliate Box', 'blossom-shop-pro' ),
        'blossom_shop_pro_affiliate_box_callback', 
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'blossom_shop_pro_add_affiliate_box' );

/**
 * Callback for Additional Info for Team
*/
function blossom_shop_pro_affiliate_box_callback(){
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'blossom_shop_pro_affiliate_nonce' );
    
    $code = get_post_meta( $post->ID, '_shop_pro_affiliate_code', true );
    ?>
        
    <div class="clearfix">
        <label class="bold-label float-left input_label" for="blossom_shop_pro_affiliate_code"><?php _e( 'Affiliate Code :', 'blossom-shop-pro' ); ?></label>
        <div class="below_row_input float-left">
            <pre>
            <textarea id="blossom_shop_pro_affiliate_code" name="blossom_shop_pro_affiliate_code"><?php echo htmlspecialchars_decode( stripslashes( $code ) ); ?></textarea>
            </pre>
        </div>
    </div>
    <?php
}

function blossom_shop_pro_save_affiliate_code( $post_id ){
    // Check if our nonce is set.
	if ( ! isset( $_POST['blossom_shop_pro_affiliate_nonce'] ) || ! wp_verify_nonce( $_POST['blossom_shop_pro_affiliate_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;		
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}
    
    if ( ! isset( $_POST['blossom_shop_pro_affiliate_code'] ) ) {
		return;
	}
    
    // Sanitize user input.
	$code = htmlspecialchars_decode( stripslashes( $_POST['blossom_shop_pro_affiliate_code'] ) );
    
	// Update the meta field in the database.
	update_post_meta( $post_id, '_shop_pro_affiliate_code', $code );
    
}
add_action( 'save_post', 'blossom_shop_pro_save_affiliate_code' );