<?php

	/*
	Sidebar
	===================================
	*/

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'glaciar-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/*
	Footer
	===================================
	*/
	register_sidebar( array(
		'name'          => esc_html__( 'First Footer Widgets Area', 'glaciar-lite' ),
		'id'            => 'first-footer-widgets',
		'description'   => esc_html__( 'These are widgets for the first footer area', 'glaciar-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Second Footer Widgets Area', 'glaciar-lite' ),
		'id'            => 'second-footer-widgets',
		'description'   => esc_html__( 'These are widgets for the second footer area', 'glaciar-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Third Footer Widgets Area', 'glaciar-lite' ),
		'id'            => 'third-footer-widgets',
		'description'   => esc_html__( 'These are widgets for the third footer area', 'glaciar-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Fourth Footer Widgets Area', 'glaciar-lite' ),
		'id'            => 'fourth-footer-widgets',
		'description'   => esc_html__( 'These are widgets for the fourth footer area', 'glaciar-lite' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
