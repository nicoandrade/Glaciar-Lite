<?php
/*
Template Name: Gallery Slider
*/
?>
<?php
/**
 * The template for the Slider Gallery
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

get_header(); ?>

		<div id="content" class="col-md-12">


			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<?php
					$glaciar_lite_page_content = get_the_content();
					if ( ! empty( $glaciar_lite_page_content ) ) {
					?>
						<div class="entry-content">
							<?php
		                	//Remove the original Gallery Shortcode from the content
		                	function glaciar_lite_remove_gallery( $content ) {
								$patron = '/\[(\[?)(gallery)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/';
								return preg_replace( $patron, '', $content );
							}
							add_filter( 'the_content', 'glaciar_lite_remove_gallery');
							//------------------------------------------------------<
		                	?>
							<?php the_content(); ?>

							</div><!-- .entry-content -->


					<?php } ?>

				</article><!-- #post-## -->


				<?php
				$post_content = get_the_content();
				preg_match( '/\[gallery.*ids=.(.*).\]/', $post_content, $ids );
				$array_id = explode( ",", $ids[1] );


				if ( count( $array_id ) > 1 ) {
				?>
		</div><!-- /content -->

	</main><!-- #main -->

</div><!-- /#container -->

<?php

echo "<div class='portfolio-container portfolio-slider gallery-slider'>\n\n";

	foreach ( $array_id as $image_id ) {

		$image_caption 	= get_post( $image_id )->post_excerpt;
		$cropped_image = wp_get_attachment_image_src( $image_id, 'glaciar_lite_portfolio' );
		$cropped_image_2x = wp_get_attachment_image_src( $image_id, 'glaciar_lite_portfolio_2x' );

		echo "\t\t\t<div id='portfolio-item-" . esc_attr( $image_id ) . "' class='portfolio-item'>";
		    echo '<a href="' . esc_url( $cropped_image_2x[0] ) . '" data-width="' . esc_attr( $cropped_image_2x['1'] ) . '" data-height="' . esc_attr( $cropped_image_2x['2'] ) . '">';
				echo wp_get_attachment_image( $image_id, 'glaciar_lite_portfolio' );
			echo "</a>\n";
			if( $image_caption ){
		        echo '<h4 class="portfolio-item-title">' . esc_html( $image_caption ) . '</h4>';
			}

		echo "</div>\n";

	}//foreach
	echo '<div class="portfolio-slider-controls"><a href="#" class="prevnext-button prev"><i class="glaciar-icon-chevron-left"></i></a><a href="#" class="prevnext-button next"><i class="glaciar-icon-chevron-right"></i></a></div>';

echo "</div><!-- .gallery-slider -->\n\n";

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">

			<?php
			}//count
			?>

			<?php endwhile; // End of the loop. ?>


			<div class="clearfix"></div>


		</div><!-- /content -->


<?php get_footer(); ?>
