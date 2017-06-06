<?php

	//HTML5 Shiv ======================================================
	wp_enqueue_script( 'html5shiv', get_theme_file_uri( '/js/html5shiv.js' ), array(), '3.7.3', true );
	//=================================================================

	//hoverIntent Plugin ==============================================
	wp_enqueue_script( 'hoverIntent' );
	//=================================================================

	//photoSwipe and UI Plugin ========================================
	wp_enqueue_script( 'photoswipe', get_theme_file_uri( '/js/photoswipe.js' ), array(), '4.1.1', true);
	wp_enqueue_script( 'glaciar_lite_photo-swipe-default', get_theme_file_uri( '/js/photoswipe-ui-default.js' ), array(), '4.1.1', true);
	//=================================================================

	//Modernizr Plugin ================================================
	wp_enqueue_script( 'glaciar_lite_modernizr', get_theme_file_uri( '/js/modernizr.custom.67069.js' ), '2.8.3', true );
	//=================================================================

	//Pace  ===========================================================
	wp_enqueue_script( 'pace', get_theme_file_uri( '/js/pace.js' ), array(), '1.0.2', true );
	//=================================================================

	//Imageloaded  ====================================================
	wp_enqueue_script( 'imagesloaded', true );
	//=================================================================

	//Isotope  ========================================================
	wp_enqueue_script( 'isotope', get_theme_file_uri( '/js/isotope.pkgd.js' ), array(), '3.0.2', true );
	//=================================================================

	//Packery Mode  ===================================================
	wp_enqueue_script( 'packery-mode', get_theme_file_uri( '/js/packery-mode.pkgd.js' ), array(), '2.0.0', true );
	//=================================================================

	//Flickity  =======================================================
	wp_enqueue_script( 'flickity', get_theme_file_uri( '/js/flickity.pkgd.js' ), array(), '2.0.5', true );
	//=================================================================

	//ScrollReveal  ===================================================
	wp_enqueue_script( 'scrollreveal', get_theme_file_uri( '/js/scrollreveal.js' ), array(), '3.3.4', true );
	//=================================================================

	//Bootstrap JS ====================================================
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/js/bootstrap.js' ), array(), '3.3.7', true );
	//=================================================================

	//Comment Reply ===================================================
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//=================================================================



	//Customs Scripts =================================================
	wp_enqueue_script( 'glaciar_lite_theme-custom', get_theme_file_uri( '/js/script.js' ), array( 'jquery', 'bootstrap' ), '1.0', true );
	$glaciar_lite_custom_js = array(
		'admin_ajax' => admin_url( 'admin-ajax.php' ),
		'token' => wp_create_nonce( 'quemalabs-secret' )
	);
	wp_localize_script( 'glaciar_lite_theme-custom', 'glaciar_lite', $glaciar_lite_custom_js );
	//=================================================================


?>
