var $container_isotope, args_isotope, $woocommerce_isotope, args_isotope_woo, portfolio_isotope_int, $portfolio_horizontal;
(function($) {
  "use strict";

$(document).ready(function($) {
    //Scroll Reveal
    window.sr = ScrollReveal();




    if ( $("body").hasClass( "ql_animations" ) ) {
        sr.reveal('#footer .widget', {
            viewOffset: {
                bottom: 150
            },
            duration: 900,
            origin: 'top',
            opacity: 0,
            distance: '40px',
            scale: 1,
            easing: 'cubic-bezier(0.075, 0.82, 0.165, 1)'
        });
        setTimeout(function(){ $("body").removeClass('ql_portfolio_animations'); }, 2000); //Avoid animations conflict with Isotope
    }

    //Anomation at load -----------------
    Pace.on('done', function(event) {

    }); //Pace













    /*
    Portfolio Masonry
    =========================================================
    */
    $container_isotope = $('.portfolio-container');
    //Add preloader
    $container_isotope.prepend('<div class="preloader"><i class="fa fa-cog fa-spin"></i></div>');

    //Isotope parameters
    args_isotope = {
        itemSelector: '.portfolio-item',
        layoutMode: 'packery',
        percentPosition: true,
        transitionDuration: 400
    };
    if ($container_isotope.parent('.portfolio-horizontal').length) {
        args_isotope.packery = {
            isHorizontal: true
        };
        args_isotope.percentPosition = false;
    }

    //Wait to images load
    $container_isotope.imagesLoaded({
        background: true
    }, function($images, $proper, $broken) {

        if ($container_isotope.hasClass('masonry')) {
            //Start Isotope
            portfolio_isotope_int = $container_isotope.isotope(args_isotope);
            $container_isotope.isotope('layout');

            $(".ql_filter .ql_filter_count .current").text($container_isotope.isotope('getItemElements').length);
            $(".ql_filter .ql_filter_count .total").text($container_isotope.isotope('getItemElements').length);
        }

        //Remove preloader
        $container_isotope.find('.preloader').addClass('proloader_hide');

        // filter items when filter link is clicked
        $('body').on('click', '.filter_list a', function(event) {
            event.preventDefault();
            var selector = $(this).attr('data-filter');
            $container_isotope.isotope({
                filter: selector
            });
            var $parent = $(this).parents(".filter_list");
            $parent.find(".active").removeClass('active');
            $(".filter_list").not($parent).find("li").removeClass('active').first().addClass("active");
            $(this).parent().addClass("active");
            var iso = $container_isotope.data('isotope')
            $(".ql_filter .ql_filter_count .current").text(iso.filteredItems.length);
            return false;
        });
                

    }); //images loaded


     // Filter Animations on Scroll
    sr.reveal('.page-template-template-home .ql_filter_count', {
        viewOffset: {
            bottom: 150,
            top: -1500
        },
        reset: true,
        duration: 100,
        origin: 'top',
        opacity: 1,
        scale: 1,
        distance: 0,
        afterReveal: function(domEl) {
            $(domEl).addClass("scrolled");
        },
        afterReset: function(domEl) {
            $(domEl).removeClass("scrolled");
        }
    });
    sr.reveal('.page-template-template-home .ql_filter ul li', {
        viewOffset: {
            bottom: 150,
            top: -1500
        },
        reset: true,
        duration: 600,
        delay: 900,
        origin: 'top',
        easing: 'cubic-bezier(0.075, 0.82, 0.165, 1)'
    }, 50);




    /*
    Portfolio Slider
    =========================================================
    */
    $('.portfolio-slider').imagesLoaded({
        background: true
    }, function($images, $proper, $broken) {

        var $portfolio_slider = $('.portfolio-slider').flickity({
            //contain: true,
            cellSelector: '.portfolio-item',
            arrowShape: {
                x0: 10,
                x1: 60,
                y1: 50,
                x2: 65,
                y2: 45,
                x3: 20
            },
            prevNextButtons: false,
            cellAlign: 'left',
            freeScroll: true
        });

        if ($('.portfolio-slider').length) {
            var portfolio_slider_data = $portfolio_slider.data('flickity');

            $('.portfolio-slider .flickity-page-dots li').each(function(index, el) {
                $(this).append('<div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div><!-- /glaciar-vertical -->');
            });

            //Change Slide
            $('body').on('click', '.portfolio-slider .prevnext-button.prev', function(event) {
                event.preventDefault();
                $portfolio_slider.flickity('previous');
            });
            $('body').on('click', '.portfolio-slider .prevnext-button.next', function(event) {
                event.preventDefault();
                $portfolio_slider.flickity('next');
            });

        }
    });




    /*
    Single Portfolio Horizontal
    =========================================================
    */
    //Call Lightbox
    initPhotoSwipe('.portfolio-slider-single', 'img');



    /*
    AJAX Portfolio Load More
    =========================================================
    */
    $('body').on('click', '.portfolio-load-more', function(event) {
        event.preventDefault();

        var $this = $(this);
        $this.addClass('loading_items');
        var category = $('.ql_filter .active a').attr('data-category');
        var post_type = $('.portfolio-container').attr('data-post-type');
        var offset = $container_isotope.isotope('getItemElements').length;
        

        $.ajax({
        	url: glaciar_lite.admin_ajax,
        	type: 'POST',
        	dataType: 'html',
        	data: {
        		action: 'glaciar_lite_load_portfolio_items',
        		token: glaciar_lite.token,
        		category: category,
                post_type: post_type,
        		offset: offset
        	},
        })
        .done(function(data) {
            
        	if ( data.length > 0 ) {
        		// create new item elements
        		var $items = $(data);

        		$items.addClass('product_added');
        		// Insert items to grid
        		$container_isotope.isotope( 'insert', $items );

        		// layout Isotope after each image loads
        		$container_isotope.imagesLoaded().progress( function() {

        			$container_isotope.isotope('layout');
                    $(".ql_filter .ql_filter_count .current").text($container_isotope.isotope('getItemElements').length);
                    $(".ql_filter .ql_filter_count .total").text($container_isotope.isotope('getItemElements').length);
                    $portfolio_horizontal.flickity('resize');

        		});
        		$items.removeClass('product_added');
        		$this.removeClass('loading_items');

        	}else{
        		$('.portfolio-load-more').hide();
        		$this.removeClass('loading_items');
        	}

        })
        .fail(function() {
            console.log('Fail');
        });
    });


    /*
    // Gallery Masonry
    //===========================================================
    */
    //Call Lightbox
    initPhotoSwipe('.gallery-masonry', 'a');


    /*
    // Gallery Slider
    //===========================================================
    */
    //Call Lightbox
    initPhotoSwipe('.gallery-slider', 'img');





    /*
     * Adds SVG to Page titles
     */
    $(".entry-header, .page-header").append('<ul class="svg-title"><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li><li><div class="glaciar-vertical-simple"><svg x="0px" y="0px" viewBox="0 0 36.9 60.1" style="enable-background:new 0 0 36.9 60.1;" xml:space="preserve"><g transform="translate(-1348.000000, -644.000000)"><g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)"><g><rect x="145.3" y="-9.6" transform="matrix(0.7071 -0.7071 0.7071 0.7071 35.9251 109.6437)" class="st0" width="10" height="42.2"/></g><g><rect x="152.4" y="6.5" transform="matrix(0.7071 -0.7071 0.7071 0.7071 42.7289 126.0694)" class="st0" width="42.2" height="10"/></g><g><path class="st1" d="M184.9,22.8"/></g></g></g></svg></div></li></ul>');

    // Adds Hover effect on menu items -----------------
    $("#jqueryslidemenu ul.nav > li > a").each(function(index, el) {
        $(this).after('<span class="glaciar_lite_nav_active"><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg><svg class="glaciar_lite_nav_active_lines" x="0px" y="0px" viewBox="0 0 17.8 5.8"><polygon points="17.8,5.8 17.8,4.9 8.9,0 8.9,0 8.9,0 8.9,0 8.9,0 0,4.9 0,5.8 8.9,0.9 "/></svg></span>');
    });
    

    $(".ql_scroll_top").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    });

    $('.dropdown-toggle').dropdown();
    $('*[data-toggle="tooltip"]').tooltip();

    $("body").on('click', '#ql_nav_btn', function(event) {
        /* Act on the event */
        $("#header").toggleClass('menu-open');
    });

});//DOM ready
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
//Function to change Home Slider title
function updateSliderTitle(selectedIndex) {
    var slide_title = $('.glaciar-home-slider-fullscreen .slide').eq(selectedIndex).attr('data-title');
    var slide_href = $('.glaciar-home-slider-fullscreen .slide').eq(selectedIndex).attr('data-href');
    if ( '' != slide_title) {
        $('.glaciar-home-slider-fullscreen .slider-fullscreen-controls .slider-fullscreen-title').html('<span><a href="' + slide_href + '">' + slide_title + '</a></span>');
    } else {
        $('.glaciar-home-slider-fullscreen .slider-fullscreen-controls .slider-fullscreen-title').html('');
    }
}
})(jQuery);