jQuery(document).ready(function($) {

    var slider_auto, slider_loop, rtl, scrollOffset;
    
    if( blossom_shop_pro_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( blossom_shop_pro_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( blossom_shop_pro_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    //sticky t bar js
    var winWidth = $(window).width();
    var containWidth = $('.sticky-bar-content .container').width();
    var result = (parseInt(winWidth) - parseInt(containWidth)) / 2;
    $('.sticky-t-bar .close').css('right', result);

    $('.sticky-t-bar .close').on( 'click', function(){
        $('.sticky-bar-content').slideToggle();
        $('.sticky-t-bar').toggleClass('active');
    });

    //header search toggle js
    $('.header-search .search-toggle').on( 'click', function(e){
        $(this).parent('.header-search').addClass('active');
        $('body').addClass('search-active');
        e.stopPropagation();
    });

    $('.header-search .search-form').on( 'click', function(e){
        e.stopPropagation();
    });

    $(window).on( 'click', function(){
        $('.header-search').removeClass('active');
        $('body').removeClass('search-active');
    });

    $(window).on( 'keyup', function(e){
        if(e.key == 'Escape') {
            $('.header-search').removeClass('active');
            $('body').removeClass('search-active');
        }
    });

    //responsive menu toggle
    $('.menu-item-has-children').prepend('<button class="submenu-toggle"><i class="fas fa-chevron-down"></i></button>');
    $('.menu-item-has-children .submenu-toggle').on( 'click', function(){
        $(this).siblings('ul').slideToggle();
        $(this).toggleClass('active');
    });

    $('.secondary-menu button.toggle-btn').on( 'click', function(){
        $('.secondary-menu .nav-menu').slideToggle();
    });

    $('.main-navigation button.toggle-btn, .sticky-header .container > button.toggle-btn').on( 'click', function(){
        $(this).parent('.main-navigation').addClass('menu-toggled');
        $('.sticky-header').addClass('menu-on');
        $(this).attr('aria-expanded', true);
    });

    $('.main-navigation .nav-menu, .sticky-header .nav-wrap .max-mega-menu').prepend('<button class="close"></button>');
    $('.main-navigation .close').on( 'click', function(){
        $('.main-navigation').removeClass('menu-toggled');
        $('.sticky-header').removeClass('menu-on');
        $('.main-navigation .toggle-btn').attr('aria-expanded', false);
    });

    $('.nav-wrap .close').on( 'click', function(){
        $('.main-navigation').removeClass('menu-toggled');
        $('.sticky-header').removeClass('menu-on');
        $('.main-navigation .toggle-btn').attr('aria-expanded', false);
    });



    //for accessibility
    $('.main-navigation ul li a, .secondary-menu ul li a, .mega-menu-wrap ul li a').on( 'focus', function () {
        $(this).parents('li').addClass('focused');
    }).on( 'blur', function () {
        $(this).parents('li').removeClass('focused');
    });

    //banner slider js
    $('.site-banner.banner-five .item-wrap').owlCarousel({
        items       : 4,
        margin      : 30,
        autoplay    : slider_auto,
        loop        : slider_loop,
        nav         : false,
        dots        : true,
        autoplaySpeed : 800,
        autoplayTimeout: blossom_shop_pro_data.speed,
        lazyLoad    : true,
        rtl         : rtl,
        responsive  : {
            0 : {
                items: 1,
            }, 
            768 : {
                items: 2,
            }, 
            1025 : {
                items: 3,
            }, 
            1367 : {
                items: 4,
            }
        }
    });

    $('.site-banner.banner-two .item-wrap').owlCarousel({
        items       : 3,
        autoplay    : slider_auto,
        loop        : slider_loop,
        nav         : false,
        dots        : true,
        autoplaySpeed : 800,
        autoplayTimeout: blossom_shop_pro_data.speed,
        lazyLoad    : true,
        rtl         : rtl,
        responsive  : {
            0 : {
                items: 1,
            }, 
            768 : {
                items: 2,
            }, 
            1025 : {
                items: 3,
            }
        }
    });

    $('.site-banner .item-wrap').owlCarousel({
        items      : 1,
        autoplay   : slider_auto,
        loop       : slider_loop,
        nav        : false,
        dots       : true,
        autoplaySpeed : 800,
        autoplayTimeout: blossom_shop_pro_data.speed,
        lazyLoad   : true,
        rtl        : rtl,
        animateOut : blossom_shop_pro_data.animation,
    });

    //banner cat border
    $('.site-banner .item-wrap .item').each(function(){
        var catWidth = $(this).find('.cat-links-inner').width();
        var containerWidth = $(this).find('.container').width();
        var widthResult = (parseInt(containerWidth) - parseInt(catWidth)) - 20;
        $(this).find('.cat-links-border').css('width', widthResult);
    });

    //recent product slider js
    if( blossom_shop_pro_data.recent_product === 'one' || blossom_shop_pro_data.recent_product === 'two' ) {
        if($('.recent-prod-slider .item').length <= 4){
            owlLoop = false;
        }else {
            owlLoop = true;
        }
        $('.recent-prod-slider').owlCarousel({
            items: 4,
            autoplay: false,
            loop: owlLoop,
            nav: true,
            dots: true,
            autoplaySpeed: 800,
            autoplayTimeout: 3000,
            autoplayHoverPause : true,
            margin: 20,
            rtl: rtl,
            responsive : {
                0 : {
                    items: 1,
                    nav: false,
                }, 
                768 : {
                    items: 2,
                    nav: true,
                },
                1025 : {
                    items: 3,
                }, 
                1200 : {
                    items: 4,
                }
            }
        });
    }

    //testimonial slider js
    if($('.testimonial-section.style-one .widget').length == 1){
        owlLoop = false;
    }else {
        owlLoop = true;
    }
    $('.testimonial-section.style-one .section-grid').owlCarousel({
        items: 1,
        autoplay: true,
        loop: owlLoop,
        nav: true,
        dots: true,
        autoplaySpeed: 800,
        autoplayTimeout: 3000,
        autoplayHoverPause : true,
        rtl: rtl,
        responsive : {
            0 : {
                nav: false,
            }, 
            768 : {
                nav: true,
            }
        }
    });

    if($('.testimonial-section.style-two .widget').length <= 3 && $('.testimonial-section.style-three .widget').length <= 3){
        owlLoop = false;
    }else {
        owlLoop = true;
    }
    $('.testimonial-section.style-two .section-grid, .testimonial-section.style-three .section-grid').owlCarousel({
        items: 3,
        autoplay: false,
        loop: owlLoop,
        nav: true,
        dots: true,
        autoplaySpeed: 800,
        autoplayTimeout: 3000,
        autoplayHoverPause : true,
        rtl: rtl,
        responsive : {
            0 : {
                nav: false,
                items: 1,
            }, 
            768 : {
                nav: true,
                items: 2,
            }, 
            1025 : {
                items: 3,
            }
        }
    });

    //client section
    if($('.client-section:not(.style-two) .image-holder').length <= 6){
        owlLoop = false;
    }else {
        owlLoop = true;
    }
    $('.client-section:not(.style-two) .blossom-inner-wrap').addClass('owl-carousel');
    $('.client-section:not(.style-two) .blossom-inner-wrap').owlCarousel({
        items: 6,
        autoplay: true,
        loop: owlLoop,
        nav: true,
        dots: false,
        autoplaySpeed: 800,
        autoplayTimeout: 3000,
        autoplayHoverPause : true,
        rtl: rtl,
        responsive : {
            0 : {
                items: 1,
            }, 
            768 : {
                items: 3,
            }, 
            1025 : {
                items: 5,
            },
            1200 : {
                items: 6,
            }
        }
    });

    //back to top
    $(window).on( 'scroll', function(){
        if($(this).scrollTop() > 200) {
            $('#back-to-top').addClass('active');
        }else {
            $('#back-to-top').removeClass('active');
        }
    });

    $('#back-to-top').on( 'click', function(){
        $('html, body').animate({
            scrollTop: 0
        }, 600);
    });

    //blog page feature section js
    $('.blog-page-feature-section .bttk-itw-holder').addClass('owl-carousel');

    $('.blog-page-feature-section .bttk-itw-holder, .trending-section .section-grid').owlCarousel({
        items: 3,
        autoplay: false,
        loop: true,
        nav: true,
        dots: false,
        autoplayHoverPause : true,
        margin: 30,
        rtl: rtl,
        responsive : {
            0 : {
                items: 1,
            },
            768 : {
                items: 2,
            },
            1025 : {
                items: 3,
            }
        }
    });

    $('.cat-tab-section .tab-content[data-id] .tabs-product').owlCarousel({
        items: 4,
        autoplay: false,
        loop: true,
        nav: false,
        dots: true,
        autoplayHoverPause : true,
        margin: 30,
        rtl: rtl,
        responsive : {
            0 : {
                items: 1,
            },
            768 : {
                items: 2,
            },
            1025 : {
                items: 3,
            },
            1200 : {
                items: 4,
            }
        }
    });

    if ( ! ( blossom_shop_pro_data.countdown === undefined || blossom_shop_pro_data.countdown.length == 0 ) ) {
        $('.days').countdown( blossom_shop_pro_data.countdown, function(event) {
            $(this).html(event.strftime('%D'));
        });
        $('.hours').countdown( blossom_shop_pro_data.countdown, function(event) {
            $(this).html(event.strftime('%H'));
        });
        $('.minutes').countdown( blossom_shop_pro_data.countdown, function(event) {
            $(this).html(event.strftime('%M'));
        });
        $('.seconds').countdown( blossom_shop_pro_data.countdown, function(event) {
            $(this).html(event.strftime('%S'));
        });
    }

    //customscrollbar for header cart
    $(window).on("load",function(){
        $(".cart-block ul.product_list_widget").mCustomScrollbar();
    });

    //sticky header 
    if( blossom_shop_pro_data.sticky == '1' ){
        var adminHeight = $('.admin-bar #wpadminbar').outerHeight();
        var headerHeight = $('.site-header').outerHeight();
        
        if($(window).width() > 600){
            $('.admin-bar .sticky-header').css('margin-top', adminHeight);
        }
        
        $(window).on('resize', function() {
            if($(window).width() >= 600){
                $('.admin-bar .sticky-header').css('margin-top', adminHeight);
            }
            else {
                $('.admin-bar .sticky-header').css('margin-top', '0px');
            }    
        });
        $(window).on( 'scroll', function(){
            if($(this).scrollTop() > headerHeight) {
                $('.sticky-header').addClass('sticky');
            }else {
                $('.sticky-header').removeClass('sticky');
            }
        });

        var stickyHeaderHeight = $('.sticky-header').outerHeight();
        $('.single .site-main .sticky-meta .article-meta').css('top', stickyHeaderHeight);
        $('.single.admin-bar .site-main .sticky-meta .article-meta').css('top', stickyHeaderHeight + 46);
    }
    
    /** Lightbox */
    if( blossom_shop_pro_data.lightbox == '1' ){        
        $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],[data-fancybox]").fancybox({
        	buttons: [
            "zoom",
            //"share",
            "slideShow",
            "fullScreen",
            //"download",
            //"thumbs",
            "close"
            ]
        });        
    }
    
    /**
    * First Letter of word to Drop Cap
    * https://stackoverflow.com/questions/5458605/first-word-selector 
    * https://paulund.co.uk/capitalize-first-letter-string-javascript
    */
    $.fn.wrapStart = function (numWords) { 
        var node = this.contents().filter(function () { 
            return this.nodeType == 3; 
        }).first(),
        text = node.text(),
        first = text.split(" ", numWords).join(" ");
        firstLetter = first.charAt(0);
        finale = '<span class="dropcap">' + firstLetter + '</span>' + first.slice(1);

        if (!node.length)
            return;

        node[0].nodeValue = text.slice(first.length);        
        node.before(finale);        
    };
    
    if( ( $('.post-template-default').length > 0 || ( $('.page-template-default').length > 0 && $('.home').length == 0 ) ) && blossom_shop_pro_data.drop_cap == 1 ){
        $('.entry-content p').wrapStart(1);
    }
    
    //Sticky widget
    if( blossom_shop_pro_data.sticky_widget == '1' ){
        $("body").addClass('sticky-wdgt-enabled');
    }

    /** One page Scroll */
    var stickyHeight = $('.sticky-header').outerHeight();
    if($('.site-header').hasClass('sticky-enabled')) {
        scrollOffset = parseInt(stickyHeight) + 50;
    }else {
        scrollOffset = 50;
    }
    if( blossom_shop_pro_data.one_page == '1' ){
        $('.main-navigation').onePageNav({
            currentClass: 'current-menu-item',
            changeHash: false,
            scrollSpeed: 1500,
            scrollThreshold: 0.5,
            filter: '',
            easing: 'swing', 
            scrollOffset: scrollOffset,       
        });

        $('.main-navigation ul li').on( 'click', function() {
            $('.main-navigation').removeClass('menu-toggled');
        });
    }

    $('.bsp-style-one .site-main .flex-control-thumbs').addClass('owl-carousel');
    $('.bsp-style-one .site-main .flex-control-thumbs').owlCarousel({
        items: 4,
        autoplay: false,
        loop: false,
        nav: true,
        dots: false,
        margin: 10,
        rtl: rtl,
        lazyLoad: false,
    });

    $('body:not(.bsp-style-one) .site-main .flex-control-thumbs').slick({
        infinite: false,
        vertical:true,
        verticalSwiping:true,
        slidesToShow: 5,
        slidesToScroll: 1,
    });

    $('body').on( 'click', '.tab-btn-wrap button', function(){
        var $this = $(this);
        var id = $this.data("id");
        if( ! $('.tab-btn-wrap button').hasClass('ajax-process') ){
            if( ! $this.hasClass('ajax') ){
                //console.log('button');
                $('.tab-btn-wrap button').removeClass('active');
                $this.addClass('active');
                $('.tab-content').hide();
                $('.'+id).show();
            }
        }
    });


    $('body').on( 'click', '.tab-btn-wrap button.ajax', function(){
        var $this = $(this);
        var id = $this.data("id");
        
        $('.tab-btn-wrap button').addClass('ajax-process');
        $('.item-loader').show();
        $('.tab-btn-wrap button').removeClass('active');
        $this.addClass('active');
        
        $('#temp').load( blossom_shop_pro_data.home_url + ' .tab-content', 'bsp_theme_nonce='+blossom_shop_pro_data.theme_nonce+'&bsp_theme_type='+id, function(){
            var load_html = $('#temp').html();

            $('#temp').html('');
            $('.tab-content').hide();
            $('.tab-content-wrap').append(load_html);

            owl = $('.cat-tab-section .tab-content[data-id] .tabs-product');

            owl.owlCarousel({
                items: 4,
                autoplay: false,
                loop: true,
                nav: false,
                dots: true,
                autoplayHoverPause : true,
                margin: 30,
                rtl: rtl,
                responsive : {
                    0 : {
                        items: 1,
                    },
                    768 : {
                        items: 2,
                    },
                    1025 : {
                        items: 3,
                    },
                    1200 : {
                        items: 4,
                    }
                }
            });
            $('.tab-btn-wrap button').removeClass('ajax-process');
            $this.removeClass('ajax');
            $('.item-loader').hide();
        });        
    });
    
    //js for accesibility compatible in IE edge
    $(".nav-menu li a, .products li a").on( 'focus', function(){
        $(this).parents("li").addClass("hover");
     }).on( 'blur', function(){
        $(this).parents("li").removeClass("hover");
     });

     $(".recent-prod-image a, .popular-prod-image a, .cat-image a, .product-image a").on( 'focus', function(){
        $(this).parents(".item").addClass("hover");
     }).on( 'blur', function(){
        $(this).parents(".item").removeClass("hover");
     });

     $(".user-block a").on( 'focus', function(){
        $(this).parents(".user-block").addClass("hover");
     }).on( 'blur', function(){
        $(this).parents(".user-block").removeClass("hover");
     });

     $(".cart-block a").on( 'focus', function(){
        $(this).parents(".cart-block").addClass("hover");
     }).on( 'blur', function(){
        $(this).parents(".cart-block").removeClass("hover");
     });

});