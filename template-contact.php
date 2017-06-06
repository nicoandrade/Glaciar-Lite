<?php
/*
Template Name: Contact
*/
?>
<?php
/**
 * The template for displaying a Contact Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glaciar Lite
 */

get_header(); ?>

	<div id="content" class="col-md-12">

			<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'page' ); ?>
						
						<?php
						$glaciar_lite_map_image = wp_get_attachment_image( absint( get_theme_mod( 'glaciar_lite_map_image' ) ), 'large' );
						$google_api_key = get_theme_mod( 'glaciar_lite_map_key' );
						echo '<div class="glaciar-contact-image">';
						if ( $glaciar_lite_map_image ) {
							
							echo wp_kses_post( $glaciar_lite_map_image );
							
						}
						echo '</div>';
						?>
						<div class="glaciar-contact-form <?php echo ( ! $glaciar_lite_map_image ) ? 'no-image' : ''; echo ( ! $google_api_key ) ? ' no-map' : ''; ?>">
							<?php
							$glaciar_lite_contact_text = get_theme_mod( 'glaciar_lite_contact_text', esc_html__( 'Hi there, you can contact me here if you have any question about morbi leo risus, porta ac consectetur ac, vestibulum at eros.', 'glaciar-lite' ) );
							?>
							<div class="glaciar-contact-form-text"><?php echo wp_kses_post( $glaciar_lite_contact_text ); ?></div>
							<?php
							$glaciar_lite_contact_email = get_theme_mod( 'glaciar_lite_contact_email', '' );
							$glaciar_lite_to_email = '';
							if ( $glaciar_lite_contact_email ) {
								$glaciar_lite_to_email = ' to="' . esc_attr( $glaciar_lite_contact_email ). '"';
							}
							
							
							if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'contact-form' ) ) {
								echo do_shortcode( '
									[contact-form' . $glaciar_lite_to_email . ']
									[contact-field label="' . esc_attr__( 'Name', 'glaciar-lite' ) . '" type="name" required="true" /]
									[contact-field label="' . esc_attr__( 'Email', 'glaciar-lite' ) . '" type="email" required="true" /]
									[contact-field label="' . esc_attr__( 'Comment', 'glaciar-lite' ) . '" type="textarea" required="true" /]
									[/contact-form]
									' );
							};
							?>
						</div>

								

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
		
			<div class="clearfix"></div>

	</div><!-- /content -->

<?php get_footer(); ?>