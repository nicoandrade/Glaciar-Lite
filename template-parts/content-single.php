<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
            <?php the_post_thumbnail( 'glaciar_lite_post_single' ); ?>
        </div><!-- /post-image -->
    <?php endif; ?>

	<div class="row">
		<div class="col-md-3">
			<?php if ( 'post' === get_post_type() ) : ?>
			<footer class="entry-footer">
				<div class="metadata">
		            <?php glaciar_lite_metadata(); ?>
		            <div class="clearfix"></div>
		        </div><!-- /metadata -->

				<svg class="glaciar-horizontal" x="0px" y="0px" viewBox="0 0 198.1 36.9" style="enable-background:new 0 0 198.1 36.9;" xml:space="preserve">
					<g transform="translate(-1348.000000, -644.000000)">
							<g transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)">
								<path class="st0" d="M184.9,161.3l-22.8,22.8"/><path class="st0" d="M184.9,160.8l-22.8-22.8"/><path class="st0" d="M184.9,115.3l-22.8,22.8"/><path class="st0" d="M184.9,114.8l-22.8-22.8"/><path class="st0" d="M184.9,69.3l-22.8,22.8"/><path class="st0" d="M184.9,68.8l-22.8-22.8"/><path class="st0" d="M184.9,23.3l-22.8,22.8"/><path class="st0" d="M184.9,22.8L162.2,0.1"/>
						</g>
					</g>
				</svg>
		    </footer><!-- .entry-footer -->
		    <?php endif; ?>
		</div><!-- .col-md-3 -->

		<div class="col-md-9">

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
						) );
					?>
				</div><!-- .entry-content -->

				<div class="clearfix"></div>

			</div><!-- /post_content -->

		</div><!-- .col-md-9 -->
	</div><!-- .row -->

</article><!-- #post-## -->
