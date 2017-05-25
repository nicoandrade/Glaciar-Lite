<?php
$glaciar_lite_portfolio_display = rwmb_meta( 'glaciar_lite_portfolio_display' );

$posts_per_page = get_theme_mod( 'glaciar_lite_portfolio_items_amount', 12 );

if ( get_query_var( 'paged' ) ) :
    $paged = get_query_var( 'paged' );
elseif ( get_query_var( 'page' ) ) :
    $paged = get_query_var( 'page' );
else :
    $paged = 1;
endif;

$args = array(
    'post_type'      => $glaciar_lite_portfolio_display,
    'paged'          => $paged,
    'posts_per_page' => $posts_per_page,
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

    echo "<div class='glaciar-home-slider' data-post-type='" . esc_attr( $glaciar_lite_portfolio_display ) . "'>\n\n";

            while ( $the_query->have_posts() ) { $the_query->the_post();

                $image_layout = '';

                if ( has_post_thumbnail() ) {
                    $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'glaciar_lite_portfolio' );

                    if ( $portfolio_image[2] > $portfolio_image[1] ) {
                        $image_layout .= 'image-portrait';
                    }
                }

                echo "\t\t\t<div id='portfolio-item-" . esc_attr( $post->ID ) . "' class='slide'>";
                        echo '<h2 class="slide-title">' . esc_html( get_the_title() ) . '</h2>';
                        if ( has_post_thumbnail() ) {
                            echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
                            the_post_thumbnail( 'glaciar_lite_portfolio_2x', array( 'class' => $image_layout ) );
                            echo '</a>';
                        }
                echo "</div>\n";


            }//while

    echo "</div><!-- .glaciar-home-slider -->\n\n";

}// if have posts
wp_reset_postdata();
