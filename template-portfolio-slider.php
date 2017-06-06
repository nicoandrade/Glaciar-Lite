<?php
/*
Template Name: Portfolio Slider
*/
?>
<?php
/**
 * The template for Portfolio Slider
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

		<?php get_template_part( 'template-parts/portfolio-container', 'slider' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$glaciar_lite_page_content = get_the_content();
				if ( ! empty( $glaciar_lite_page_content ) ) {
				?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				<?php } ?>

			</article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>

		<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>
