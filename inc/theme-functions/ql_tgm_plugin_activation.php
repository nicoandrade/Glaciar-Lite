<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/theme-functions/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'glaciar_lite_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function glaciar_lite_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'               => 'Kirki Toolkit',
            'slug'               => 'kirki',
            'version'           => '2.0.7',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'Jetpack by WordPress.com',
            'slug'               => 'jetpack',
            'version'           => '4.6.0',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'version'           => '4.10.1',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'Multiple Portfolios',
            'slug'               => 'multiple-portfolios',
            'version'           => '1.0.0',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'WP Instagram Widget',
            'slug'               => 'wp-instagram-widget',
            'version'           => '1.9.8',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'glaciar-lite',
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

}
