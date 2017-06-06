<?php
/*
Template Name: Portfolio Masonry
*/
?>
<?php
/**
 * The template for Portfolio Masonry
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

get_header(); ?>

	<div id="content" class="col-md-12">

		<header class="entry-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<?php get_template_part( 'template-parts/portfolio-container', 'portfolio-masonry' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			$glaciar_lite_page_content = get_the_content();
			if ( ! empty( $glaciar_lite_page_content ) ) {
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				
				</article><!-- #post-## -->
			<?php } ?>

		<?php endwhile; // End of the loop. ?>

		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
