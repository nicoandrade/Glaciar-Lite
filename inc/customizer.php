<?php
/**
 * Glaciar Lite Theme Customizer.
 *
 * @package Glaciar Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function glaciar_lite_customize_register( $wp_customize ) {


	/**
	 * Control for the PRO buttons
	 */
	class glaciar_lite_Pro_Version extends WP_Customize_Control{
		public function render_content(){
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	/*
    Colors
    ===================================================== */
    	/*
		Featured
		------------------------------ */
		$wp_customize->add_setting( 'glaciar_lite_hero_color', array( 'default' => '#0037FF', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glaciar_lite_hero_color', array(
			'label'        => esc_attr__( 'Featured Color', 'glaciar-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Headings
		------------------------------ */
		$wp_customize->add_setting( 'glaciar_lite_headings_color', array( 'default' => '#0037FF', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glaciar_lite_headings_color', array(
			'label'        => esc_attr__( 'Headings Color', 'glaciar-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Text
		------------------------------ */
		$wp_customize->add_setting( 'glaciar_lite_text_color', array( 'default' => '#808080', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glaciar_lite_text_color', array(
			'label'        => esc_attr__( 'Text Color', 'glaciar-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Link
		------------------------------ */
		$wp_customize->add_setting( 'glaciar_lite_link_color', array( 'default' => '#0037FF', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glaciar_lite_link_color', array(
			'label'        => esc_attr__( 'Link Color', 'glaciar-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Footer Background
		------------------------------ */
		$wp_customize->add_setting( 'glaciar_lite_footer_background', array( 'default' => '#f7f7f7', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glaciar_lite_footer_background', array(
			'label'        => esc_attr__( 'Footer Background Color', 'glaciar-lite' ),
			'section'    => 'colors',
		) ) );



	/*
    Portfolio Options
    ===================================================== */
	$wp_customize->add_section( 'glaciar_lite_portfolio_options_section', array(
			'title' => esc_attr__( 'Portfolio Options', 'glaciar-lite' ),
			'priority' => 160,
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'glaciar_lite_portfolio_items_amount', array(
			'type'        => 'number',
			'settings'    => 'glaciar_lite_portfolio_items_amount',
			'label'       => esc_attr__( "Number of items", 'glaciar-lite' ),
			'description' => esc_attr__( 'Number of items displayed per page.', 'glaciar-lite' ),
			'section'     => 'glaciar_lite_portfolio_options_section',
			'default'     => 12,
		) );

	}else{
		$wp_customize->add_setting( 'glaciar_lite_portfolio_items_amount_info', array( 'default' => '', 'sanitize_callback' => 'glaciar_lite_sanitize_text', ) );
		$wp_customize->add_control( new glaciar_lite_Display_Text_Control( $wp_customize, 'glaciar_lite_portfolio_items_amount_info', array(
			'section' => 'glaciar_lite_portfolio_options_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'Please install %1$s Kirki Toolkit %2$s plugin to see more settings.', 'glaciar-lite' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) .'">', '</a>' ),
		) ) );

	}

	$wp_customize->add_setting( 'glaciar_lite_portfolio_infinitescroll_enable', array( 'default' => true, 'sanitize_callback' => 'glaciar_lite_sanitize_bool', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'glaciar_lite_portfolio_infinitescroll_enable', array(
		'section' => 'glaciar_lite_portfolio_options_section', // Required, core or custom.
		'label' => esc_attr__( "Load More Button?", 'glaciar-lite' ),
		'description' => esc_attr__( 'Select if you want a "Load More" button instead of the default pagination.', 'glaciar-lite' ),
		'type'    => 'checkbox',
		'priority' => 80
	) );



    /*
    Site Options
    ===================================================== */
	$wp_customize->add_section( 'glaciar_lite_site_options_section', array(
			'title' => esc_attr__( 'Site Options', 'glaciar-lite' ),
			'priority' => 140,
	) );

	$animations_options = array(
			'true' => esc_attr__( 'Enable', 'glaciar-lite' ),
			'false' => esc_attr__( 'Disable', 'glaciar-lite' ),
		);
	$wp_customize->add_setting( 'glaciar_lite_site_animations', array( 'default' => 'true', 'sanitize_callback' => 'glaciar_lite_sanitize_text', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'glaciar_lite_site_animations', array(
        'label'   => esc_attr__( 'Enable/Disable Site Animations', 'glaciar-lite' ),
        'section' => 'glaciar_lite_site_options_section',
        'settings'   => 'glaciar_lite_site_animations',
        'type'       => 'select',
        'choices'    => $animations_options,
    ));

    $wp_customize->add_setting( 'glaciar_lite_site_header_shapes', array( 'default' => true, 'sanitize_callback' => 'glaciar_lite_sanitize_bool', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'glaciar_lite_site_header_shapes', array(
		'section' => 'glaciar_lite_site_options_section', // Required, core or custom.
		'label' => esc_attr__( "Show Header shapes?", 'glaciar-lite' ),
		'description' => esc_attr__( 'Select if you want to show the triangles, squares and circles on your header.', 'glaciar-lite' ),
		'type'    => 'checkbox',
		'priority' => 80
	) );






	/*
	Typography
	------------------------------ */
	$wp_customize->add_section( 'glaciar_lite_typography_section', array(
		'title' => esc_attr__( 'Typography', 'glaciar-lite' ),
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'glaciar_lite_typography_font_family', array(
		    'type'     => 'select',
		    'settings' => 'glaciar_lite_typography_font_family',
		    'label'    => esc_html__( 'Font Family', 'glaciar-lite' ),
		    'section'  => 'glaciar_lite_typography_section',
		    'default'  => 'Muli',
		    'priority' => 20,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'glaciar_lite_typography_font_family_headings', array(
		    'type'     => 'select',
		    'settings' => 'glaciar_lite_typography_font_family_headings',
		    'label'    => esc_html__( 'Headings Font Family', 'glaciar-lite' ),
		    'section'  => 'glaciar_lite_typography_section',
		    'default'  => 'Dosis',
		    'priority' => 22,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'glaciar_lite_typography_subsets', array(
		    'type'        => 'multicheck',
		    'settings'    => 'glaciar_lite_typography_subsets',
		    'label'       => esc_html__( 'Google-Font subsets', 'glaciar-lite' ),
		    'description' => esc_html__( "The subsets used from Google's API.", 'glaciar-lite' ),
		    'section'     => 'glaciar_lite_typography_section',
		    'default'     => '',
		    'priority'    => 23,
		    'choices'     => Kirki_Fonts::get_google_font_subsets(),
		    'output'      => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-subset',
		        ),
		    ),
		) );

		Kirki::add_field( 'glaciar_lite_typography_font_size', array(
		    'type'      => 'slider',
		    'settings'  => 'glaciar_lite_typography_font_size',
		    'label'     => esc_html__( 'Font Size', 'glaciar-lite' ),
		    'section'   => 'glaciar_lite_typography_section',
		    'default'   => 16,
		    'priority'  => 25,
		    'choices'   => array(
		        'min'   => 7,
		        'max'   => 48,
		        'step'  => 1,
		    ),
		    'output' => array(
		        array(
		            'element'  => 'html',
		            'property' => 'font-size',
		            'units'    => 'px',
		        ),
		    ),
		    'transport' => 'postMessage',
		    'js_vars'   => array(
		        array(
		            'element'  => 'html',
		            'function' => 'css',
		            'property' => 'font-size',
		            'units'    => 'px'
		        ),
		    ),
		) );

	}else{

		$wp_customize->add_setting( 'glaciar_lite_typography_not_kirki', array( 'default' => '', 'sanitize_callback' => 'glaciar_lite_sanitize_text', ) );
		$wp_customize->add_control( new glaciar_lite_Display_Text_Control( $wp_customize, 'glaciar_lite_typography_not_kirki', array(
			'section' => 'glaciar_lite_typography_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'To change typography make sure you have installed the %1$s Kirki Toolkit %2$s plugin.', 'glaciar-lite' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) . '">', '</a>' ),
		) ) );

	}//if Kirki exists


	/*
	Contact Page
	------------------------------ */
	$wp_customize->add_section( 'glaciar_lite_map_section', array(
		'title' => esc_attr__( 'Contact Page', 'glaciar-lite' ),
		'description' => esc_attr__( "Display a map and your contact information. You'll have to create a page using the 'Contact' page template.", 'glaciar-lite' ),
	) );

	$wp_customize->add_setting( 'glaciar_lite_map_image', array( 'default' => '', 'transport' => 'postMessage', 'sanitize_callback' => 'attachment_url_to_postid', 'type' => 'theme_mod' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'glaciar_lite_map_image', array(
        'label'    => esc_attr__( 'Contact Page Image', 'glaciar-lite' ),
        'section'  => 'glaciar_lite_map_section',
        'settings' => 'glaciar_lite_map_image',
    ) ) );

	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'contact-form' ) ) {
		$wp_customize->add_setting( 'glaciar_lite_contact_email', array( 'default' => '', 'sanitize_callback' => 'glaciar_lite_sanitize_text', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( 'glaciar_lite_contact_email', array(
			'type' => 'text',
			'section' => 'glaciar_lite_map_section', // Required, core or custom.
			'label' => esc_attr__( "Destination Email", 'glaciar-lite' ),
			'description' => esc_html__( "Email that will receive the messages from the contact form", 'glaciar-lite' )
		) );

		$wp_customize->add_setting( 'glaciar_lite_contact_text', array( 'default' => esc_html__( 'Hi there, you can contact me here if you have any question about morbi leo risus, porta ac consectetur ac, vestibulum at eros.', 'glaciar-lite' ), 'sanitize_callback' => 'glaciar_lite_sanitize_text', 'type' => 'theme_mod', 'transport' => 'postMessage' ) );
		$wp_customize->add_control( 'glaciar_lite_contact_text', array(
			'type' => 'textarea',
			'section' => 'glaciar_lite_map_section', // Required, core or custom.
			'label' => esc_attr__( "Form Text", 'glaciar-lite' )
		) );

	}else{
		$wp_customize->add_setting( 'glaciar_lite_contact_form', array( 'default' => '', 'sanitize_callback' => 'glaciar_lite_sanitize_text', ) );
		$wp_customize->add_control( new glaciar_lite_Display_Text_Control( $wp_customize, 'glaciar_lite_contact_form', array(
			'section' => 'glaciar_lite_map_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'Please activate the Contact Form module of %1$s Jetpack %2$s plugin.', 'glaciar-lite' ), '<a href="' . get_admin_url( null, 'admin.php?page=jetpack_modules' ) .'">', '</a>' ),
		) ) );
	}
	

	/*
	PRO Version
	------------------------------ */
	$wp_customize->add_section( 'glaciar_lite_pro_section', array(
		'title' => esc_attr__( 'PRO version', 'glaciar-lite' ),
		'priority' => 5,
	) );
	$wp_customize->add_setting( 'glaciar_lite_probtn', array( 'default' => '', 'sanitize_callback' => 'glaciar_lite_sanitize_text', ) );
	$wp_customize->add_control( new glaciar_lite_Display_Text_Control( $wp_customize, 'glaciar_lite_probtn', array(
		'section' => 'glaciar_lite_pro_section', // Required, core or custom.
		'label' => sprintf( __( 'Check out the PRO version for more features. %1$s View PRO version %2$s', 'glaciar-lite' ), '<a target="_blank" class="button" href="https://www.quemalabs.com/theme/glaciar/" style="width: 80%; margin: 10px auto; display: block; text-align: center;">', '</a>' ),
	) ) );



}
add_action( 'customize_register', 'glaciar_lite_customize_register' );











/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function glaciar_lite_customize_preview_js() {

	wp_register_script( 'glaciar_lite_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'glaciar_lite_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'glaciar_lite_customizer_preview' );

}
add_action( 'customize_preview_init', 'glaciar_lite_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function glaciar_lite_customize_js() {

	wp_enqueue_script( 'glaciar_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls' ), '20151024', true );

}
add_action( 'customize_controls_enqueue_scripts', 'glaciar_lite_customize_js' );










/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function glaciar_lite_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, glaciar_lite_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function glaciar_lite_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize return pro version text
 */
function glaciar_lite_pro_version( $input ) {
    return $input;
}


/**
 * Sanitize Text
 */
function glaciar_lite_sanitize_text( $str ) {
	return sanitize_text_field( $str );
}

/**
 * Sanitize Textarea
 */
function glaciar_lite_sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

/**
 * Sanitize URL
 */
function glaciar_lite_sanitize_url( $url ) {
	return esc_url( $url );
}

/**
 * Sanitize Boolean
 */
function glaciar_lite_sanitize_bool( $string ) {
	return (bool)$string;
}

/**
 * Sanitize Text with html
 */
function glaciar_lite_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize array for multicheck
 * http://stackoverflow.com/a/22007205
 */
function glaciar_lite_sanitize_multicheck( $values ) {

    $multi_values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $multi_values ) ) ? array_map( 'sanitize_title', $multi_values ) : array();
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function glaciar_lite_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
}




/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class glaciar_lite_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	        ?>
			<p><?php echo wp_kses( $this->label, $wp_kses_args ); ?></p>
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_glaciar_lite_get_image_src', 'glaciar_lite_get_image_src' );
add_action( 'wp_ajax_glaciar_lite_get_image_src', 'glaciar_lite_get_image_src' );

function glaciar_lite_get_image_src() {
	if ( isset( $_POST['image_id'] ) ){
		$image_id = sanitize_text_field( wp_unslash( $_POST['image_id'] ) );
	}else{
		return false;
	}
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo wp_kses_post( $image );
	die();
}
