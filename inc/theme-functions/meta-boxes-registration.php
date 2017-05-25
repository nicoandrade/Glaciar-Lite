<?php
add_filter( 'rwmb_meta_boxes', 'glaciar_lite_meta_boxes' );

function glaciar_lite_meta_boxes( $meta_boxes ) {

    $prefix = 'glaciar_lite_';
	
	if( ! is_wp_error( get_portfolios_options() ) ){

	    $meta_boxes[] = array(
			'title' => __( 'Select Portfolio to display', 'glaciar-lite' ),
	        'post_types' => 'page',
			'fields' => array(
				array(
					'name'    => esc_html__( 'Select', 'glaciar-lite' ),
					'id'      => "{$prefix}portfolio_display",
					'type'    => 'select',
					'options' => get_portfolios_options(),
				),
			),
		);

	}

	if( ! is_wp_error( get_portfolios_slug() ) ){

	    $meta_boxes[] = array(
			'title' => __( 'Portfolio Item Options', 'glaciar-lite' ),
	        'post_types' => get_portfolios_slug(),
			'fields' => array(
				array(
					'name'    => esc_html__( 'Select layout', 'glaciar-lite' ),
	                'desc'  => esc_html__( 'Portrait images will automatically set as portrait items.', 'glaciar-lite' ),
					'id'      => "{$prefix}portfolio_item_layout",
					'type'    => 'select',
					'options' => array(
	                    'landscape'     => esc_html__( 'Landscape', 'glaciar-lite' ),
	                    'landscape-big' => esc_html__( 'Landscape Big', 'glaciar-lite' ),
	                ),
	            ),
	            array(
					'name'             => esc_html__( 'Portfolio images', 'glaciar-lite' ),
					'id'               => "{$prefix}portfolio_item_images",
					'type'             => 'image_advanced',
					// Delete image from Media Library when remove it from post meta?
					// Note: it might affect other posts if you use same image for multiple posts
					'force_delete'     => false,
					// Maximum image uploads
					'max_file_uploads' => 0,
					// Display the "Uploaded 1/2 files" status
					'max_status'       => false,
	    		),
	        ),
		);
		
	}


    return $meta_boxes;
}
