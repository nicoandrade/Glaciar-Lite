<?php

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @see wp_add_inline_style()
 */
function glaciar_lite_custom_css() {
	/*
	Colors
	*/
	$heroColor = get_theme_mod( 'glaciar_lite_hero_color', '#0037ff' );
	$headings_color = get_theme_mod( 'glaciar_lite_headings_color', '#0037FF' );
	$text_color = get_theme_mod( 'glaciar_lite_text_color', '#777777' );
	$link_color = get_theme_mod( 'glaciar_lite_link_color', '#0037ff' );
	$content_background_color = get_theme_mod( 'glaciar_lite_content_background_color', '#FFFFFF' );
	$footer_background = get_theme_mod( 'glaciar_lite_footer_background', '#f7f7f7' );

	$colors = array(
		'heroColor'      => $heroColor,
		'headings_color' => $headings_color,
		'text_color'     => $text_color,
		'link_color'     => $link_color,
		'content_background_color'     => $content_background_color,
		'footer_background'     => $footer_background,
	);

	$custom_css = glaciar_lite_get_custom_css( $colors );

	wp_add_inline_style( 'glaciar_lite_style', $custom_css );



	/*
	Typography
	*/
	$glaciar_lite_typography_font_family = get_theme_mod( 'glaciar_lite_typography_font_family', 'Muli' );
	$glaciar_lite_typography_font_family_headings = get_theme_mod( 'glaciar_lite_typography_font_family_headings', 'Dosis' );
	$glaciar_lite_typography_subsets = get_theme_mod( 'glaciar_lite_typography_subsets', '' );
	$glaciar_lite_typography_font_size = get_theme_mod( 'glaciar_lite_typography_font_size', '16' );

	$typography = array(
		'font-family' 		   => $glaciar_lite_typography_font_family,
		'font-family-headings' => $glaciar_lite_typography_font_family_headings,
		'font-size'     	   => $glaciar_lite_typography_font_size,
	);

	//Add Google Fonts
	$glaciar_lite_font_subset = '';
	if ( is_array( $glaciar_lite_typography_subsets ) ) {
		$glaciar_lite_font_subset = '&subset=';
		foreach ( $glaciar_lite_typography_subsets as $subset ) {
			$glaciar_lite_font_subset .= $subset . ',';
		}
		$glaciar_lite_font_subset = rtrim( $glaciar_lite_font_subset, ',' );
	}

	$glaciar_lite_google_font = '//fonts.googleapis.com/css?family=' . $glaciar_lite_typography_font_family . ':400,500,700' . $glaciar_lite_font_subset;
	wp_enqueue_style( 'glaciar_lite_google-font', $glaciar_lite_google_font, array(), '1.0', 'all');

	$glaciar_lite_google_font_headings = '//fonts.googleapis.com/css?family=' . $glaciar_lite_typography_font_family_headings . ':400,700' . $glaciar_lite_font_subset;
	wp_enqueue_style( 'glaciar_lite_google-font-headings', $glaciar_lite_google_font_headings, array(), '1.0', 'all');

	$custom_css = glaciar_lite_get_custom_typography_css( $typography );

	wp_add_inline_style( 'glaciar_lite_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'glaciar_lite_custom_css' );



/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function glaciar_lite_get_custom_css( $colors ) {

	//Default colors
	$colors = wp_parse_args( $colors, array(
		'heroColor'            => '#0037ff',
		'headings_color'       => '#0037FF',
		'text_color'           => '#777777',
		'link_color'           => '#0037ff',
		'content_background_color'           => '#FFFFFF',
		'footer_background'     => '#f7f7f7',
	) );
	$heroColor_darker = glaciar_lite_darken_color( $colors['heroColor'], 1.1 );
	$link_color_darker = glaciar_lite_darken_color( $colors['link_color'], 1.2 );
	$heroColor_rgb = hex2rgb( $colors['heroColor'] );

	$css = <<<CSS

	/* Text Color */
	body{
		color: {$colors['text_color']};
	}
	h1:not(.site-title), h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover{
		color: {$colors['headings_color']};
	}
	/* Link Color */
	a{
		color: {$colors['link_color']};
	}
	a:hover{
		color: {$link_color_darker};
	}



	/*============================================
	// Featured Color
	============================================*/

	/* Background Color */
	.pagination .current,
	.pagination li.active a,
	.section-title::before,
	.ql_primary_btn,
	#jqueryslidemenu ul.nav > li > ul > li a:hover,
	#jqueryslidemenu .navbar-toggle .icon-bar,
	.glaciar-home-slider-fullscreen .slider-fullscreen-controls .prevnext-button,
	.pace .pace-progress,
	.woocommerce-page .products .product:hover .product_text,
	.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li span.current,
	.ql_woo_cart_button:hover,
	.ql_woo_cart_close,
	.woocommerce .woocommerce-MyAccount-navigation ul .woocommerce-MyAccount-navigation-link.is-active a,
	.woocommerce_checkout_btn,
	.post-navigation .nav-next a:hover::before, .post-navigation .nav-previous a:hover::before,
	.woocommerce #main .products .product:hover .product_text, 
	.woocommerce-page .products .product:hover .product_text,
	.woocommerce #main .single_add_to_cart_button,
	.glaciar-contact-form input[type='submit'],
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #payment #place_order, .woocommerce-page #payment #place_order
	{
		background-color: {$colors['heroColor']};
	}

	/* Border Color */
	.pagination li.active a,
	.pagination li.active a:hover,
	.section-title::after,
	.pace .pace-activity,
	.ql_woocommerce_categories ul li.current, .ql_woocommerce_categories ul li:hover,
	.woocommerce_checkout_btn,
	.ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field,
	.touch .ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field
	.glaciar-contact-form input[type='text']:focus,
	.glaciar-contact-form input[type='email']:focus,
	.glaciar-contact-form textarea:focus,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active, 
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, 
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, 
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active
	{
		border-color: {$colors['heroColor']};
	}

	/* Color */
	.logo_container .ql_logo,
	.pagination a:hover,
	.pagination li.active a:hover,
	.single .post .entry-footer .metadata ul li a,
	#comments .comment-list .comment.bypostauthor .comment-body,
	#respond input,
	#respond textarea,
	#footer h2, #footer h3, #footer h4,
	.widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a,
	.style-title span,
	.ql_filter ul li.active a,
	.ql_filter ul li a:hover,
	.ql_filter .ql_filter_count .current,
	.portfolio-slider .portfolio-item .portfolio-item-title,
	.portfolio-slider .portfolio-slider-controls .prevnext-button,
	.portfolio-multiple-slider .portfolio-item .portfolio-item-title,
	.portfolio-multiple-slider .portfolio-slider-controls .prevnext-button,
	.single-portfolio-container .portfolio-item .portfolio-item-title,
	#sidebar .widget ul li > a:hover,
	#sidebar .widget_recent_comments ul li a:hover,
	.ql_cart-btn:hover,
	.ql_woocommerce_categories ul li.current, .ql_woocommerce_categories ul li:hover,
	.ql_woocommerce_categories ul li a:hover,
	.woocommerce #main .products .product .price, .woocommerce-page .products .product .price,
	.woocommerce a.added_to_cart,
	.woocommerce div.product .woocommerce-product-rating,
	.woocommerce #main .price,
	.woocommerce #main .single_variation_wrap .price,
	.woocommerce-cart .cart .cart_item .product_text .amount,
	.ql_woo_cart_close:hover,
	#ql_woo_cart ul.cart_list li .product_text .amount,
	#ql_woo_cart .widget_shopping_cart_content .total,
	.woocommerce_checkout_btn:hover,
	.woocommerce .star-rating,
	.widget .amount,
	.post-navigation .nav-next a,
	.post-navigation .nav-previous a,
	.welcome-section .welcome-title,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
	.question,
	.widget #menu-social li a,
	.glaciar-contact-form .glaciar-contact-form-text,
	.glaciar-contact-form input[type='text'],
	.glaciar-contact-form input[type='email'],
	.glaciar-contact-form textarea,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	#jqueryslidemenu ul.nav > li > ul > li.current_page_item a, 
	#jqueryslidemenu ul.nav > li > ul > li.current_page_parent a,
	.ql_woocommerce_categories ul li.current a,
	.sub-footer a:hover
	{
		color: {$colors['heroColor']};
	}

	/* Fill */
	.entry-header .svg-title li .glaciar-vertical-simple .st0,
	.page-header .svg-title li .glaciar-vertical-simple .st0,
	.flickity-prev-next-button .arrow,
	.glaciar-home-slider .flickity-page-dots .dot .is-selected .glaciar-vertical-simple .st0,
	.portfolio-slider .flickity-page-dots .dot.is-selected .glaciar-vertical-simple .st0,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .glaciar-vertical-simple .st0,
	.glaciar-home-slider .flickity-prev-next-button .arrow,
	.glaciar-home-slider .flickity-prev-next-button .arrow,
	.glaciar-home-slider .flickity-page-dots .dot.is-selected .glaciar-vertical-simple .st0
	{
		fill: {$colors['heroColor']};
	}

	/* Stroke */
	.entry-header .svg-title li .glaciar-vertical-simple .st1,
	.page-header .svg-title li .glaciar-vertical-simple .st1,
	.glaciar-vertical path,
	.ql-svg-inline .g-svg,
	#jqueryslidemenu .current_page_item a, #jqueryslidemenu .current_page_parent a,
	.glaciar-home-slider .flickity-page-dots .dot .is-selected .glaciar-vertical-simple .st1,
	.ql_filter .ql_filter_count .glaciar-count-svg path,
	.portfolio-slider .flickity-page-dots .dot.is-selected .glaciar-vertical-simple .st1,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .glaciar-vertical-simple .st1
	{
		stroke: {$colors['heroColor']};
	}

	/* Darker Background Color */
	.no-touch .ql_primary_btn:hover,
	.no-touch .woocommerce #main .single_add_to_cart_button:hover,
	.no-touch .glaciar-contact-form input[type='submit']:hover,
	.no-touch .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.no-touch .woocommerce #payment #place_order:hover, 
	.no-touch .woocommerce-page #payment #place_order:hover
	{
		background-color: {$heroColor_darker};
	}

	/* Faded Background Color */
	.portfolio-container .portfolio-item .portfolio-item-hover,
	.glaciar_lite_team_member .glaciar_lite_team_hover
	{
		background-color: rgba( {$heroColor_rgb['red']}, {$heroColor_rgb['green']}, {$heroColor_rgb['blue']}, 0.88 );
	}

	/* Footer Background Color */
	#footer, .footer-wrap
	{
		background-color: {$colors['footer_background']};
	}
	.footer-top ul li
	{
		border-bottom-color: {$colors['footer_background']};
	}


CSS;

	return $css;
}


/**
 * Returns CSS for the typography styles.
 *
 * @param array $typography typography.
 * @return string CSS.
 */
function glaciar_lite_get_custom_typography_css( $typography  ) {

	//Default colors
	$typography = wp_parse_args( $typography, array(
		'font-family'           => 'Muli',
		'font-family-headings'  => 'Dosis',
		'font-size'             => '16',
	) );

	$css = <<<CSS

	/* Typography */
	body{
		font-family: {$typography['font-family']};
		font-size: {$typography['font-size']}px;
	}
	h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	.metadata,
	.pagination a, .pagination span,
	.ql_primary_btn,
	.ql_secundary_btn,
	.ql_woocommerce_categories ul li,
	.sidebar_btn,
	.woocommerce #main .products .product .product_text, .woocommerce-page .products .product .product_text,
	.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
	.woocommerce #main .price,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce-cart .cart .cart_item .product_text .price
	{
		font-family: {$typography['font-family-headings']};
	}

CSS;

	return $css;
}
