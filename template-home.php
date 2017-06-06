<?php
/*
Template Name: Home
*/
?>
<?php
/**
 * The template for the default Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

get_header(); ?>

	<div id="content" class="col-md-12">

		<div class="welcome-section">
            <h2 class="welcome-title"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h2>
        </div><!-- /welcome-section -->


		<?php get_template_part( 'template-parts/portfolio-container', 'home' ); ?>


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
