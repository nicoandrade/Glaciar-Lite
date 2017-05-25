<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Glaciar Lite
 */

get_header(); ?>

	<?php

	if ( glaciar_lite_is_portfolio_type( get_post_type() ) ) :

		get_template_part( 'template-parts/single-portfolio', 'horizontal' );

	else:
	?>
	<?php
	$glaciar_lite_content_class = 'col-md-8';
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$glaciar_lite_content_class = 'col-md-12';
	}
	?>

		<div id="content" class="site-content <?php echo esc_attr( $glaciar_lite_content_class ); ?>" role="content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<div class="row">
					<div class="col-md-9 col-md-push-3">
						<?php glaciar_lite_post_navigation(); ?>
					</div><!-- .col-md-9 -->
				</div><!-- .row -->

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</div><!-- #content -->



		<?php get_sidebar(); ?>

	<?php endif; ?>


<?php get_footer(); ?>
