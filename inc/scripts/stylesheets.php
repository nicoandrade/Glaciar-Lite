<?php
	//Bootstrap =======================================================
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/css/bootstrap.css' ), array(), '3.3.7', 'all');
	//=================================================================

	//Photoswipe ======================================================
	wp_register_style( 'photoswipe', get_theme_file_uri( '/css/photoswipe.css' ), array(), '4.1.1', 'all' );
	wp_enqueue_style( 'photoswipe' );
	//=================================================================

	//Photoswipe Skin ======================================================
	wp_register_style( 'photoswipe-skin', get_theme_file_uri( '/css/default-skin/default-skin.css' ), array(), '4.1.1', 'all' );
	wp_enqueue_style( 'photoswipe-skin' );
	//=================================================================

	//Flickity ======================================================
	wp_register_style( 'flickity', get_theme_file_uri( '/css/flickity.css' ), array(), '4.1.1', 'all' );
	wp_enqueue_style( 'flickity' );
	//=================================================================


	wp_enqueue_style( 'glaciar_lite_style', get_stylesheet_uri() );
