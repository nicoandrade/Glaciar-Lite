<?php
$term_list = wp_get_post_terms( $post->ID, get_post_type() . '_category', array( "fields" => "slugs" ) );
$terms_to_print = '';

if ( has_post_thumbnail() ) {
	$portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'glaciar_lite_portfolio' );
	$glaciar_lite_portfolio_item_layout = rwmb_meta( 'glaciar_lite_portfolio_item_layout' );

}

foreach ( $term_list as $term_slug ) {
	$terms_to_print .= ' ' . $term_slug;
}

echo "\t\t\t<div id='portfolio-item-" . esc_attr( $post->ID ) . "' class='portfolio-item " . esc_attr( $terms_to_print ) ."'>";
    echo "\t\t\t\t<a href='" . esc_url( get_permalink() ) . "'>\n";
		the_post_thumbnail( 'glaciar_lite_portfolio_2x' );
	echo "</a>\n";
        echo '<h4 class="portfolio-item-title">' . esc_html( get_the_title() ) . '</h4>';

echo "</div>\n";
