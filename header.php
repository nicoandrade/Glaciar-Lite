<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glaciar Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- WP_Head -->
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>

    <?php
    $header_image = "";
    if ( get_header_image() ){
        $header_image = get_header_image();
    }
    ?>
	<header id="header" class="site-header" <?php echo ( $header_image ) ? 'style="background-image: url(' . esc_url( $header_image ) . ');"' : ''; ?>>
    
        <?php
        $glaciar_lite_site_header_shapes = get_theme_mod( 'glaciar_lite_site_header_shapes', true );
        if( $glaciar_lite_site_header_shapes ){
        ?>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/circle.svg" alt="" class="ql-svg svg-circle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/square.svg" alt="" class="ql-svg svg-square">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/triangle.svg" alt="" class="ql-svg svg-triangle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/circle.svg" alt="" class="ql-svg svg-circle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/circle.svg" alt="" class="ql-svg svg-circle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/square.svg" alt="" class="ql-svg svg-square">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/triangle.svg" alt="" class="ql-svg svg-triangle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/triangle.svg" alt="" class="ql-svg svg-triangle">
        <svg class="ql-svg ql-svg-inline svg-circle" width="34px" height="34px" viewBox="0 0 34 34" >
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.746268657"><g class="g-svg" transform="translate(-547.000000, -7.000000)" stroke-width="4" stroke="#F2F2F2"><g transform="translate(59.000000, -11.000000)"><circle cx="505" cy="35" r="15"></circle></g></g></g>
        </svg>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/circle.svg" alt="" class="ql-svg svg-circle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/circle.svg" alt="" class="ql-svg svg-circle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/triangle.svg" alt="" class="ql-svg svg-triangle">
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/square.svg" alt="" class="ql-svg svg-square">
        <?php } ?>
		<div class="container">
        	<div class="row">

                <div class="logo_container col-md-5 col-sm-12 col-xs-12">
                    <?php
                    $logo = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="ql_logo">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                    if ( has_custom_logo() ) {
                        $logo = get_custom_logo();
                    }
                    ?>
                    <?php if ( is_front_page() ) : ?>
                        <h1 class="site-title"><?php echo wp_kses_post( $logo ); ?>&nbsp;</h1>
                    <?php else : ?>
                        <p class="site-title"><?php echo wp_kses_post( $logo ); ?></p>
                    <?php endif; ?>

                    <button id="ql_nav_btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ql_nav_collapse" aria-expanded="false">
                        <i class="fa fa-navicon"></i>
                    </button>

                </div><!-- /logo_container -->



        		<div class="col-md-7">

                    <div class="collapse navbar-collapse" id="ql_nav_collapse">
                        <nav id="jqueryslidemenu" class="jqueryslidemenu navbar " >
                            <?php
                            wp_nav_menu( array(
                                'theme_location'  => 'primary',
                                'menu_id' => 'primary-menu',
                                'depth'             => 3,
                                'menu_class'        => 'nav',
                                'fallback_cb'       => 'glaciar_lite_bootstrap_navwalker::fallback',
                                'walker'            => new glaciar_lite_bootstrap_navwalker()
                            ));
                            ?>
                        </nav>
                    </div><!-- /ql_nav_collapse -->

                </div><!-- col-md-7 -->

                <div class="clearfix"></div>

        	</div><!-- row-->
        </div><!-- /container -->

	</header>

	<div class="clearfix"></div>



    <div id="container" class="container">

        <main id="main" class="site-main row">
