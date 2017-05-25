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
							
							echo $glaciar_lite_map_image;
							
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
						$google_api_key = get_theme_mod( 'glaciar_lite_map_key' );
						if ( ! empty( $google_api_key ) ) {
						    echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_api_key ) . '&sensor=false"></script>';
						?>

						<script type="text/javascript">
						    //When the window has finished loading create our google map below
						    google.maps.event.addDomListener(window, 'load', init);

						    function init() {
						        // Basic options for a simple Google Map
						        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
						        var mapOptions = {

						        	scrollwheel: false,
						            // How zoomed in you want the map to start at (always required)
						            zoom: parseInt('<?php echo absint( get_theme_mod( 'glaciar_lite_map_zoom', '13' ) ) ; ?>'),

						            // The latitude and longitude to center the map (always required)
						            center: new google.maps.LatLng( <?php echo get_theme_mod( 'glaciar_lite_map_lat_long', '40.725987, -74.002447' ) ; ?>), // New York

						            // How you would like to style the map. 
						            // This is where you would paste any style found on Snazzy Maps.
						            styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
						        };

						        // Get the HTML DOM element that will contain your map 
						        // We are using a div with id="map" seen below in the <body>
						        var mapElement = document.getElementById('map');

						        // Create the Google Map using our element and options defined above
						        var map = new google.maps.Map(mapElement, mapOptions);

						        // Let's also add a marker while we're at it
						        var marker = new google.maps.Marker({
						            position: new google.maps.LatLng(<?php echo get_theme_mod( 'glaciar_lite_map_lat_long', '40.725987, -74.002447' ); ?>),
						            map: map,
						            title: 'Snazzy!'
						        });
						    }
						</script>
						<div id="map-section" class="map-section">
						   <div id="map" class="map-wrap"></div>
						</div><!-- map-section -->
						<?php
						}//if map key
						?>				

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