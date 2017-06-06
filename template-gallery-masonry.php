<?php
/*
Template Name: Gallery Masonry
*/
?>
<?php
/**
 * The template for the Masonry Gallery
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


					echo "<div class='portfolio-container gallery-masonry masonry'>\n\n";

						foreach ( $array_id as $image_id ) {

							$image_caption 	= get_post( $image_id )->post_excerpt;
							$terms_to_print = '';

							$cropped_image = wp_get_attachment_image_src( $image_id, 'glaciar_lite_portfolio' );
							$cropped_image_2x = wp_get_attachment_image_src( $image_id, 'glaciar_lite_portfolio_2x' );
							$image_print = " style='background-image: url(" . esc_url( $cropped_image[0] ) . "); '";

							if( $cropped_image[2] > $cropped_image[1] ){
								$terms_to_print .= 'layout-portrait';
							}else{
							    $terms_to_print .= 'landscape-small';
							}



							echo "\t\t\t<div id='portfolio-item-" . esc_attr( $image_id ) . "' class='portfolio-item " . esc_attr( $terms_to_print ) . "' " . $image_print . '>';
								echo "<style type='text/css'>";
									echo "@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {";
										echo "#portfolio-item-" . esc_attr( $image_id ) . "{ background-image: url(" . esc_url( $cropped_image_2x[0] ) . "); }";
									echo "}";
								echo "</style>\n";
								echo "\t\t\t\t<a href='" . esc_url( $cropped_image_2x[0] ) . "' data-width='" . esc_attr( $cropped_image_2x['1'] ) . "' data-height='" . esc_attr( $cropped_image_2x['2'] ) . "'></a>\n";
								if ( $image_caption ) {
									echo '<div class="portfolio-item-hover">';
								        echo '<h4 class="portfolio-item-title">' . esc_html( $image_caption ) . '<img class="horizontal-lines" alt="lines" src="' . esc_url( get_template_directory_uri() ) . '/images/horizontal.svg"></h4>';
									echo "\t\t\t</div>\n";

								}
								echo "</div>\n";


						}//foreach

					echo "</div><!-- .portfolio_container -->\n\n";


				}//count
				?>

			<?php endwhile; // End of the loop. ?>


			<div class="clearfix"></div>


		</div><!-- /content -->


<?php get_footer(); ?>
