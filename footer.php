<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glaciar Lite
 */

?>
<?php
$glaciar_lite_portfolio_item_single_layout = rwmb_meta( 'glaciar_lite_portfolio_item_single_layout' );
$glaciar_lite_portfolio_item_single_layout = ( empty( $glaciar_lite_portfolio_item_single_layout ) ) ? 'horizontal' : $glaciar_lite_portfolio_item_single_layout;
?>
        <?php if ( is_page_template( 'template-home-slider.php' ) || is_page_template( 'template-portfolio-slider.php' ) || ( glaciar_lite_is_portfolio_type( get_post_type() ) && 'horizontal' == $glaciar_lite_portfolio_item_single_layout ) || is_page_template( 'template-gallery-slider.php' ) ): ?>
        </div>
    </div>
    <?php else: ?>
        </main><!-- #main -->

    </div><!-- /#container -->
    <?php endif; ?>

    <div class="footer-top">
        <ul><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
    </div>


    <?php
    $footer_sections = array(
                            'first-footer-widgets' => false,
                            'second-footer-widgets' => false,
                            'third-footer-widgets' => false,
                            'fourth-footer-widgets' => false,
                        );
    $footer_count = 0;
    $footer_section_class = "";

    foreach ( $footer_sections as $footer_section => $active ) {
        if ( is_active_sidebar( $footer_section ) ) {
            $footer_sections[$footer_section] = true;
            $footer_count++;
        }//if is_active_sidebar
    }//for each

    switch ( $footer_count ) {
        case 1:
            $footer_section_class = "col-md-12";
            break;
        case 2:
            $footer_section_class = "col-md-6 col-sm-6";
            break;
        case 3:
            $footer_section_class = "col-md-4 col-sm-4";
            break;
        case 4:
            $footer_section_class = "col-md-3 col-sm-6";
            break;
        default:
            $footer_section_class = "col-md-3 col-sm-6";
            break;
    }

    ?>
<div class="footer-wrap">
    <?php
    /*
    *Only show the Footer sections that have widgets
    */
    if ( $footer_count > 0 ) {
    ?>

    <footer id="footer" class="site-footer">
        <div class="container">
            <div class="row">

                <?php
                foreach ( $footer_sections as $footer_section => $active ) {
                    if ( $active ) {
                        echo '<div class="' . esc_attr( $footer_section_class ) . '">';

                            if ( is_active_sidebar( $footer_section ) ) { if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( $footer_section ) ) : else :

                            endif; }//if is_active_sidebar

                        echo '</div>';
                    }//if active
                }//for each
                ?>

            </div><!-- .row -->
        </div><!-- .container -->
        <svg class="glaciar-footer-svg" x="0px" y="0px" viewBox="0 0 38 199" style="enable-background:new 0 0 38 199;" xml:space="preserve">
                <g  transform="translate(-1348.000000, -644.000000)">
                        <g  transform="translate(1367.000000, 743.500000) rotate(-90.000000) translate(-1367.000000, -743.500000) translate(1274.500000, 731.500000)">
                        <path d="M138.5,23.5"/>
                        <path d="M138.9,23.5l22.8-22.8"/>
                        <path d="M184.5,23.5L161.7,0.7"/>
                    </g>
                </g>
            <path d="M30.5,99.1"/>
            <path d="M30.5,98.8L7.7,76"/>
            <path d="M30.5,53.1L7.7,75.9"/>
            <path d="M30.5,145.1"/>
            <path d="M30.5,144.8L7.7,122"/>
            <path d="M30.5,99.1L7.7,121.9"/>
            <path d="M30.5,190.8"/>
            <path d="M30.5,190.4L7.7,167.6"/>
            <path d="M30.5,144.8L7.7,167.5"/>
        </svg>
    </footer><!-- #footer -->
    <?php
    }//if footer_count
    ?>




	<div class="sub-footer">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-8">

                    <p>
                    <?php esc_html_e( '&copy;', 'glaciar-lite' ); echo ' ' . esc_html( date_i18n( __( 'Y', 'glaciar-lite' ) ) ). ' ' . esc_html( get_bloginfo( 'name' ) );  ?>.
                    <?php printf( esc_html__( 'Designed by %s.', 'glaciar-lite' ), '<a href="https://www.quemalabs.com/" rel="designer">Quema Labs</a>' ); ?>
                        
                    </p>

                    <?php
                    if ( has_nav_menu( 'footer-menu' ) ) {
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'footer-menu',
                                'container'       => 'div',
                                'container_id'    => 'footer-menu',
                                'container_class' => 'menu',
                                'menu_id'         => 'menu-footer-items',
                                'menu_class'      => 'menu-items',
                                'depth'           => 1,
                                'fallback_cb'     => '',
                            )
                        );
                    }
                    ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?php get_template_part( '/template-parts/social-menu', 'footer' ); ?>
                </div>

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .sub-footer -->
</div><!-- .footer-wrap -->


<?php wp_footer(); ?>

</body>
</html>
