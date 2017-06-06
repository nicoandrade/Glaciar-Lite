<?php
$term_list = wp_get_post_terms( $post->ID, get_post_type() . '_category', array( "fields" => "slugs" ) );
$terms_to_print = '';
$image_print = '';

if ( has_post_thumbnail() ) {
	$portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'glaciar_lite_portfolio' );
	$portfolio_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id(), 'glaciar_lite_portfolio_2x' );
	$glaciar_lite_portfolio_item_layout = rwmb_meta( 'glaciar_lite_portfolio_item_layout' );
	if( $portfolio_image[2] > $portfolio_image[1] ){
		$terms_to_print .= 'layout-portrait';
	}else if ( $glaciar_lite_portfolio_item_layout ) {
		$terms_to_print .= $glaciar_lite_portfolio_item_layout;
	}else{
	    $terms_to_print .= 'landscape-small';
	}
$image_print = "' style='background-image: url(" . esc_url( $portfolio_image[0] ) . "); '>\n";
}

if ( ! is_wp_error( $term_list ) ) {
	foreach ( $term_list as $term_slug ) {
		$terms_to_print .= ' ' . $term_slug;
	}
}
echo "\t\t\t<div id='portfolio-item-" . esc_attr( $post->ID ) . "' class='portfolio-item " . esc_attr( $terms_to_print ) . $image_print;
    echo "\t\t\t\t<a href='" . esc_url( get_permalink() ) . "'></a>\n";
	echo '<div class="portfolio-item-hover">';
        echo '<h4 class="portfolio-item-title">' . esc_html( get_the_title() ) . '<img class="horizontal-lines" alt="lines" src="' . esc_url( get_template_directory_uri() ) . '/images/horizontal.svg"></h4>';
        if ( ! is_wp_error( $term_list ) ) {
		    echo '<ul class="portfolio-item-categories">';
				foreach ( $term_list as $term_slug ) {
					echo '<li>' . esc_html( $term_slug ) . '</li>';
				}
			echo "</ul>\n";
		}
	echo "\t\t\t</div>\n";
echo "</div>\n";
