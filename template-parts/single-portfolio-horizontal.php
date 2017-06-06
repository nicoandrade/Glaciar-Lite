        <div id="content" class="col-md-12">

            <header class="entry-header">
                <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

        </div><!-- /content -->

    </main><!-- #main -->

</div><!-- /#container -->


<?php echo "<div class='portfolio-container portfolio-slider portfolio-slider-single'>\n\n"; ?>

    <?php

    if ( has_post_thumbnail() ) {
        $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        $image_post = get_post( get_post_thumbnail_id() );
    }

    echo "\t\t\t<div id='portfolio-item-" . esc_attr( $post->ID ) . "' class='portfolio-item'>";
        echo "\t\t\t\t<a href='" . esc_url( $portfolio_image[0] ) . "' data-width='" . esc_attr( $portfolio_image[1] ) . "' data-height='" . esc_attr( $portfolio_image[2] ) . "'>\n";
            the_post_thumbnail( 'glaciar_lite_portfolio' );
        echo "</a>\n";
        if ( ! empty( $image_post->post_excerpt ) ) {
            echo '<h4 class="portfolio-item-title">' . esc_html( $image_post->post_excerpt ) . '</h4>';
        }
    echo "</div>\n";

    $portfolio_images = rwmb_meta( 'glaciar_lite_portfolio_item_images', $args = array(  'size' => 'full'  ), $post->ID );


    foreach ( $portfolio_images as $image ) {
        $image_post = get_post( $image['ID'] );
        echo "\t\t\t<div class='portfolio-item'>";
        echo "\t\t\t\t<a href='" . esc_url( $image['full_url'] ) . "' data-width='" . esc_attr( $image['width'] ) . "' data-height='" . esc_attr( $image['height'] ) . "'>\n";
        echo wp_get_attachment_image( $image['ID'], 'glaciar_lite_portfolio' );
        echo "</a>\n";
        if ( ! empty( $image_post->post_excerpt ) ) {
            echo '<h4 class="portfolio-item-title">' . esc_html( $image_post->post_excerpt ) . '</h4>';
        }
        echo "</div>\n";
    }

    echo '<div class="portfolio-slider-controls"><a href="#" class="prevnext-button prev"><i class="glaciar-icon-chevron-left"></i></a><a href="#" class="prevnext-button next"><i class="glaciar-icon-chevron-right"></i></a></div>';
    ?>

<?php echo "</div><!-- .portfolio_container -->\n\n"; ?>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php the_title( '<h2 hidden>', '</h2>' ); ?>

                    <div class="post-content">

                        <div class="entry-content">
                            <?php the_content(); ?>
                            <?php
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glaciar-lite' ),
                                    'after'  => '</div>',
                                 ) );
                            ?>
                        </div><!-- .entry-content -->

                        <div class="clearfix"></div>

                    </div><!-- /post_content -->

                </article><!-- #post-## -->

                <?php glaciar_lite_post_navigation(); ?>

            <?php endwhile; // End of the loop.?>

        </div><!-- .col-md-12 -->
