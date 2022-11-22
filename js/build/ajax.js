/*! .isOnScreen() returns bool */
jQuery.fn.isOnScreen = function(){
	
	var win = jQuery(window);
	
	var viewport = {
		top : win.scrollTop(),
		left : win.scrollLeft()
	};
	viewport.right = viewport.left + win.width();
	viewport.bottom = viewport.top + win.height();
	
	var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};

jQuery(document).ready(function($) {

    if (typeof blossom_shop_pro_ajax !== 'undefined') {

        //Start Ajax Pagination
        
        var pageNum = parseInt(blossom_shop_pro_ajax.startPage) + 1;
        var max = parseInt(blossom_shop_pro_ajax.maxPages);
        var nextLink = blossom_shop_pro_ajax.nextLink;
        var autoLoad = blossom_shop_pro_ajax.autoLoad;
        
        if( blossom_shop_pro_ajax.rtl == '1' ){
            rtl = true;
        }else{
            rtl = false;
        }

        if ( autoLoad == 'load_more' ) {
            // Insert the "Load More Posts" link.
            $('.pagination')
            .before('<div class="pagination_holder" style="display: none;"></div>')                
            .after('<div id="load-posts"><a href="javascript:void(0);"><i class="fas fa-sync-alt"></i>' + blossom_shop_pro_ajax.loadmore + '</a></div>');
            if (pageNum == max+1) {
                $('#load-posts a').html('<i class="fas fa-ban"></i>'+blossom_shop_pro_ajax.nomore).addClass('disabled');
            }
            $('#load-posts a').on( 'click', function() {
                if(pageNum <= max && !$(this).hasClass('loading')) {
                    $(this).html('<i class="fas fa-sync-alt fa-spinner"></i>'+blossom_shop_pro_ajax.loading).addClass('loading');

                    $('.pagination_holder').load(nextLink + ' .latest_post', function() {
                        // Update page number and nextLink.
                        pageNum++;
                        var new_url = nextLink;
                        nextLink = nextLink.replace(/(\/?)page(\/|d=)[0-9]+/, '$1page$2'+ pageNum);
                        
                        //Temporary hold the post from pagination and append it to #main
                        var load_html = $('.pagination_holder').html(); 
                        $('.pagination_holder').html('');                                 
                        
                        $('.site-main article:last').after(load_html); // just simply append content without massonry

                        var $this = $('.site-main').find('.entry-content').find('div');
                        if( $this.hasClass('tiled-gallery') ){
                            $.getScript(blossom_shop_pro_ajax.plugin_url + "/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.js");                    
                        }
                        
                        if(pageNum <= max) {
                            $('#load-posts a').html('<i class="fas fa-sync-alt"></i>'+blossom_shop_pro_ajax.loadmore).removeClass('loading');
                        } else {
                            $('#load-posts a').html('<i class="fas fa-ban"></i>'+blossom_shop_pro_ajax.nomore).addClass('disabled').removeClass('loading');
                        }
                    });
                    
                } else {
                    // no more posts
                }

                return false;
            });
            $('.pagination').remove();
        }else if( autoLoad == 'infinite_scroll' ) {
            // autoload
            
            // Placeholder
            $('.pagination').before('<div class="pagination_holder" style="display: none;"></div>');

            var loading_posts = false;
            var last_post = false;
            
            if( $('.blog').length > 0 || $('.search').length > 0 || $('.archive').length > 0 ){

                $(window).on( 'scroll', function() {
                    if (!loading_posts && !last_post) {
                        var lastPostVisible = $('.latest_post').last().isOnScreen();
                        if (lastPostVisible) {
                            if(pageNum <= max) {
                                loading_posts = true;

                                $('.pagination_holder').load(nextLink + ' .latest_post', function() {
                                // Update page number and nextLink.
                                pageNum++;
                                var new_url = nextLink;
                                
                                loading_posts = false;
                                nextLink = nextLink.replace(/(\/?)page(\/|d=)[0-9]+/, '$1page$2'+ pageNum); 
                                
                                //Temporary hold the post from pagination and append it to #main
                                var load_html = $('.pagination_holder').html(); 
                                $('.pagination_holder').html('');                                 
                                
                                $('.site-main article:last').after(load_html); // just simply append content without massonry
                                
                                var $this = $('.site-main').find('.entry-content').find('div');
                                if( $this.hasClass('tiled-gallery') ){
                                    $.getScript(blossom_shop_pro_ajax.plugin_url + "/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.js");                    
                                }                                
                            });

                            } else {
                            // no more posts
                            last_post = true;
                        }
                    }
                }
            });

            }
            
            $('.pagination').remove();    
        } 
        // End Ajax Pagination

        // // Ajax for Add to favourite
        // $('body').on( 'click', '.yith-wcwl-add-to-wishlist', function(){       
        //     var product_id = $(this).attr('id');
        //     var count = $('.favourite .count').text();
        //     $.ajax ({
        //         url     : blossom_shop_pro_ajax.url,  
        //         type    : 'post',
        //         data    : { 'action' : 'blossom_shop_pro_add_favorite_count', 'count' : count },  
        //         success : function(results){
        //             $('.favourite .count').html(results);
        //         }
        //     });
        // });
        
        // // Ajax for remove from favourite
        // $('body').on( 'click', '.remove_from_wishlist', function(){       
        //     var product_id = $(this).attr('id');
        //     var count = $('.favourite .count').text();
        //     $.ajax ({
        //         url     : blossom_shop_pro_ajax.url,  
        //         type    : 'post',
        //         data    : { 'action' : 'blossom_shop_pro_remove_favorite_count', 'count' : count },  
        //         success : function(results){
        //             $('.favourite .count').html(results);
        //         }
        //     });
        // });
    }    
});