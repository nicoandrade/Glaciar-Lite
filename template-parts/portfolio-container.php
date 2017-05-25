<?php get_template_part( 'template-parts/portfolio-filters' ); ?>

<?php
$posts_per_page = get_theme_mod( 'glaciar_lite_portfolio_items_amount', 12 );
global $the_query; //For Pagination to work

if ( get_query_var( 'paged' ) ) :
    $paged = get_query_var( 'paged' );
elseif ( get_query_var( 'page' ) ) :
    $paged = get_query_var( 'page' );
else :
    $paged = 1;
endif;

$glaciar_lite_portfolio_display = rwmb_meta( 'glaciar_lite_portfolio_display' );
if ( empty( $glaciar_lite_portfolio_display ) ) {
    $glaciar_lite_portfolio_display = 'portfolio';
}
$args = array(
    'post_type'      => $glaciar_lite_portfolio_display,
    'paged'          => $paged,
    'posts_per_page' => $posts_per_page,
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

    echo "<div class='portfolio-container masonry' data-post-type='" . esc_attr( $glaciar_lite_portfolio_display ) . "'>\n\n";

            while ( $the_query->have_posts() ) { $the_query->the_post();

                get_template_part( 'template-parts/content-portfolio', 'portfolio' );

            }//while

    echo "</div><!-- .portfolio_container -->\n\n";

    $glaciar_lite_portfolio_infinitescroll_enable = get_theme_mod( 'glaciar_lite_portfolio_infinitescroll_enable', true );
    $count_posts = wp_count_posts( $glaciar_lite_portfolio_display );

    if ( $glaciar_lite_portfolio_infinitescroll_enable && $count_posts->publish > $posts_per_page ) {
        echo '<div class="portfolio-load-wrapper">';
            echo '<a href="#" class="portfolio-load-more">' . esc_html__( 'Load More', 'glaciar-lite' ) . '<i class="fa fa-spinner fa-pulse fa-fw"></i></a>';
        echo '</div>';
    }else{
        get_template_part( 'template-parts/pagination', 'portfolio' );
    }

}// if have posts
wp_reset_postdata();
?>
