<div id="content" class="col-md-5">

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="post-content">

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glaciar-lite' ),
                            'after'  => '</div>',
                        ));
                    ?>
                </div><!-- .entry-content -->

                <div class="clearfix"></div>

                <?php if( has_term( '', get_post_type() . '_category', $post->ID ) ): ?>
                <footer class="entry-footer">
        			<div class="portfolio-metadata">
                        <ul>
                            <li class="meta_categories">
                                <?php echo get_the_term_list( $post->ID, get_post_type() . '_category', '', ' ' ); ?>
                            </li>
                        </ul>
        	            <div class="clearfix"></div>
        	        </div><!-- /metadata -->
        	    </footer><!-- .entry-footer -->
            <?php endif; ?>

            </div><!-- /post_content -->

        </article><!-- #post-## -->

        <?php glaciar_lite_post_navigation(); ?>

    <?php endwhile; // End of the loop.?>

</div><!-- /content -->

<div class="col-md-7">





<?php echo "<div class='single-portfolio-container'>\n\n"; ?>

    <?php

    if ( has_post_thumbnail() ) {
        $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        $image_post = get_post(get_post_thumbnail_id() );
        $item_class = '';
        if( $portfolio_image[2] > $portfolio_image[1] ){
    		$item_class = 'portfolio-item-portrait';
    	}
    }

    echo "\t\t\t<div id='portfolio-item-" . esc_attr( $post->ID ) . "' class='portfolio-item " . esc_attr( $item_class ) . "'>";
        echo "\t\t\t\t<a href='" . esc_url( $portfolio_image[0] ) . "' data-width='" . esc_attr( $portfolio_image[1] ) . "' data-height='" . esc_attr( $portfolio_image[2] ) . "'>\n";
            the_post_thumbnail( 'glaciar_lite_portfolio_2x' );
        echo "</a>\n";
        if ( ! empty( $image_post->post_excerpt ) ) {
            echo '<h4 class="portfolio-item-title">' . esc_html( $image_post->post_excerpt ) . '</h4>';
        }
    echo "</div>\n";

    $portfolio_images = rwmb_meta( 'glaciar_lite_portfolio_item_images', $args = array( 'size' => 'full' ), $post->ID );


    foreach ( $portfolio_images as $image ) {
        $image_post = get_post( $image['ID'] );
        $item_class = '';
        if( $image['height'] > $image['width'] ){
    		$item_class = 'portfolio-item-portrait';
    	}
        echo "\t\t\t<div class='portfolio-item " . $item_class . "'>";
            echo "\t\t\t\t<a href='" . esc_url( $image['full_url'] ) . "' data-width='" . esc_attr( $image['width'] ) . "' data-height='" . esc_attr( $image['height'] ) . "'>\n";
            echo wp_get_attachment_image( $image['ID'], 'glaciar_lite_portfolio_2x' );
            echo "</a>\n";
            if ( ! empty( $image_post->post_excerpt ) ) {
                echo '<h4 class="portfolio-item-title">' . esc_html( $image_post->post_excerpt ) . '</h4>';
            }
        echo "</div>\n";
    }

    ?>

<?php echo "</div><!-- .single-portfolio-container -->\n\n"; ?>

</div><!-- .col-md-12 -->
