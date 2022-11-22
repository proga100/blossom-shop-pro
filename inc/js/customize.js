jQuery(document).ready(function($){
    /* Move Fornt page widgets to frontpage panel */
	wp.customize.section( 'sidebar-widgets-service' ).panel( 'frontpage_settings' );
	wp.customize.section( 'sidebar-widgets-service' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-about' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '70' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-testimonial' ).priority( '80' );    
    wp.customize.section( 'sidebar-widgets-cta' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-cta' ).priority( '90' );
    wp.customize.section( 'sidebar-widgets-client' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-client' ).priority( '110' );

    /* Move About Page widgets to About page panel */
    wp.customize.section( 'sidebar-widgets-about-intro' ).panel( 'about_page_settings' );
    wp.customize.section( 'sidebar-widgets-about-intro' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-about-testimonial' ).panel( 'about_page_settings' );
    wp.customize.section( 'sidebar-widgets-about-testimonial' ).priority( '30' );
    wp.customize.section( 'sidebar-widgets-about-client' ).panel( 'about_page_settings' );
    wp.customize.section( 'sidebar-widgets-about-client' ).priority( '40' );

    /* Move Contact page widgets to Contact page panel */
    wp.customize.section( 'sidebar-widgets-contact-form-template' ).panel( 'contact_page_setting' );
    wp.customize.section( 'sidebar-widgets-contact-form-template' ).priority( '20' );
    wp.customize.section( 'sidebar-widgets-contact-template' ).panel( 'contact_page_setting' );
    wp.customize.section( 'sidebar-widgets-contact-template' ).priority( '30' );

    /* Move featured widgets to general settings */
    wp.customize.section( 'sidebar-widgets-featured' ).panel( 'general_settings' );
    wp.customize.section( 'sidebar-widgets-featured' ).priority( '35' );
    
    //Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });  
    
    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( blossom_shop_pro_cdata.home );
            }
        });
    });
    
    /* About Page preview url */
    wp.customize.panel( 'about_page_settings', function( section ){
        section.expanded.bind( function( isExpanded ){
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( blossom_shop_pro_cdata.about );
            }
        });
    });
    
    /* Contact Page preview url */
    wp.customize.panel( 'contact_page_setting', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( blossom_shop_pro_cdata.contact );
            }
        });
    });

    $('#sub-accordion-section-body_settings').on( 'click', '.typography_text', function(e){
        e.preventDefault();
        wp.customize.control( 'ed_googlefont_local' ).focus();        
    });

    $('#sub-accordion-section-performance_settings').on( 'click', '.ed_googlefont_local', function(e){
        e.preventDefault();
        wp.customize.control( 'typography_text' ).focus();        
    });

    $('#sub-accordion-section-slider_layout_settings').on( 'click', '.slider_layout_text', function(e){
        e.preventDefault();
        wp.customize.control( 'ed_banner_section' ).focus();        
    });

    $('#sub-accordion-section-header_image').on( 'click', '.slider_banner_text', function(e){
        e.preventDefault();
        wp.customize.control( 'slider_layout' ).focus();        
    });

    $('#sub-accordion-section-header_layout_settings').on( 'click', '.header_layout_text', function(e){
        e.preventDefault();
        wp.customize.control( 'ed_sticky_header' ).focus();        
    });

    $('#sub-accordion-section-header_settings').on( 'click', '.header_details_text', function(e){
        e.preventDefault();
        wp.customize.control( 'header_layout' ).focus();        
    });

    $('#sub-accordion-section-child_support_settings').on( 'click', '.h-layout', function(e){
        e.preventDefault();
        wp.customize.control( 'header_layout' ).focus();        
    });
});

function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-sidebar-widgets-service':
        preview_section_id = "service_section";
        break;

        case 'accordion-section-recent_product':
        preview_section_id = "recent_product_section";
        break;

        case 'accordion-section-featured_section':
        preview_section_id = "featured_section";
        break;

        case 'accordion-section-popular_product':
        preview_section_id = "popular_product_section";
        break;
        
        case 'accordion-section-prod_deal':
        preview_section_id = "product_deal_section";
        break;

        case 'accordion-section-cat_one':
        preview_section_id = "cat_one_section";
        break;

        case 'accordion-section-cat_tab_section':
        preview_section_id = "cat_tab_section";
        break;

        case 'accordion-section-cat_two':
        preview_section_id = "cat_two_section";
        break;
        
        case 'accordion-section-sidebar-widgets-about':
        preview_section_id = "about_section";
        break;

        case 'accordion-section-cat_three':
        preview_section_id = "cat_three_section";
        break;

        case 'accordion-section-cat_four':
        preview_section_id = "cat_four_section";
        break;

        case 'accordion-section-sidebar-widgets-testimonial':
        preview_section_id = "testimonial_section";
        break;
        
        case 'accordion-section-sidebar-widgets-cta':
        preview_section_id = "cta_section";
        break;

        case 'accordion-section-blog_section':
        preview_section_id = "blog_section";
        break;

        case 'accordion-section-sidebar-widgets-client':
        preview_section_id = "client_section";
        break;
        
        case 'accordion-section-front_sort':
        preview_section_id = "banner_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}