<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Glaciar Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function glaciar_lite_body_classes( $classes ) {

    $glaciar_lite_theme_data = wp_get_theme();

    $classes[] = sanitize_title( $glaciar_lite_theme_data['Name'] );
    $classes[] = 'v' . $glaciar_lite_theme_data['Version'];

    $glaciar_lite_slider_fullscreen = get_theme_mod( 'glaciar_lite_slider_fullscreen', false );
    if ( class_exists( 'WooCommerce' ) ){
        if ( is_shop() && $glaciar_lite_slider_fullscreen || isset( $_GET[ 'fullscreen_slider' ] ) ) {
            $classes[] = 'slider-fullscreen';
        }
    }

    // Add Animations Class
    $glaciar_lite_site_animations = get_theme_mod( 'glaciar_lite_site_animations', 'true' );
    if ( 'true' == $glaciar_lite_site_animations ) {
        $classes[] = 'ql_animations ql_portfolio_animations';
    }


    //Add Single Portfolio layout classes
    if ( is_single() && glaciar_lite_is_portfolio_type( get_post_type() ) ) :

		$glaciar_lite_portfolio_item_single_layout = rwmb_meta( 'glaciar_lite_portfolio_item_single_layout' );
        $glaciar_lite_portfolio_item_single_layout = ( empty( $glaciar_lite_portfolio_item_single_layout ) ) ? 'horizontal' : $glaciar_lite_portfolio_item_single_layout;

        $classes[] = 'portfolio_layout_' . $glaciar_lite_portfolio_item_single_layout;

	endif;

	return $classes;
}
add_filter( 'body_class', 'glaciar_lite_body_classes' );


if ( ! function_exists( 'glaciar_lite_new_content_more' ) ){
    function glaciar_lite_new_content_more($more) {
           global $post;
           return ' <br><a href="' . esc_url( get_permalink() ) . '" class="more-link read-more">' . esc_html__( 'Read more', 'glaciar-lite' ) . ' <i class="fa fa-angle-right"></i></a>';
    }
}// end function_exists
    add_filter( 'the_content_more_link', 'glaciar_lite_new_content_more' );


/**
 * Meta Slider configurations
 */
function glaciar_lite_metaslider_default_slideshow_properties( $params ) {
        $params['width'] = 1450;
        $params['height'] = 700;
	return $params;
}
add_filter( 'metaslider_default_parameters', 'glaciar_lite_metaslider_default_slideshow_properties', 10, 1 );

/**
 * Meta Slider referall ID
 */
function glaciar_lite_metaslider_hoplink( $link ) {
    return "https://getdpd.com/cart/hoplink/15318?referrer=24l934xmnt6sc8gs";

}
add_filter( 'metaslider_hoplink', 'glaciar_lite_metaslider_hoplink', 10, 1 );

/**
 * Retrieve sliders from Meta Slider plugin
 */
function glaciar_lite_all_meta_sliders( $sort_key = 'date' ) {

    $sliders = array();

    // list the tabs
    $args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'orderby' => $sort_key,
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    $args = apply_filters( 'metaslider_all_meta_sliders_args', $args );

    // WP_Query causes issues with other plugins using admin_footer to insert scripts
    // use get_posts instead
    $all_sliders = get_posts( $args );

    foreach( $all_sliders as $slideshow ) {

        $sliders[] = array(
            'title' => $slideshow->post_title,
            'id' => $slideshow->ID
        );

    }

    return $sliders;

}


/**
 * Convert HEX colors to RGB
 */
function hex2rgb( $colour ) {
    $colour = str_replace("#", "", $colour);
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function get_portfolios_slug(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $glaciar_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $glaciar_lite_portfolio_types_slugs = array();
        foreach ( $glaciar_lite_portfolio_types as $portfolio ) {
            $glaciar_lite_portfolio_types_slugs[] = $portfolio['slug'];
        }
        return $glaciar_lite_portfolio_types_slugs;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'glaciar-lite' ) );
    }

 }


/**
* Return portfolios as option for Meta Box
*
* @return array
*/
function get_portfolios_options(){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $glaciar_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $glaciar_lite_portfolio_types_option = array();
        foreach ( $glaciar_lite_portfolio_types as $portfolio ) {
            $glaciar_lite_portfolio_types_option[$portfolio['slug']] = $portfolio['name'];
        }
        return $glaciar_lite_portfolio_types_option;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'glaciar-lite' ) );
    }

}


/**
 * Return only slug from all portfolios CPT
 *
 * @return array
 */
 function glaciar_lite_is_portfolio_category( $category ){

    if ( class_exists( 'Multiple_Portfolios' ) ) {

        $glaciar_lite_portfolio_types = Multiple_Portfolios::get_post_types();
        $taxonomy_objects = get_object_taxonomies( 'portfolio' );

        foreach ( $glaciar_lite_portfolio_types as $portfolio ) {
            $taxonomy_objects = get_object_taxonomies( $portfolio );
            $portfolio_tax_category = $taxonomy_objects[0]; //portfolio_category
            if ( $category == $portfolio_tax_category ) {
                return true;
            }
        }
        return false;
    }else{
        return new WP_Error( 'plugin_missing', esc_html__( 'Multiple Portfolios plugin not installed', 'glaciar-lite' ) );
    }

 }


/**
* Avoid undefined functions if Meta Box is not activated
*
* @return bool
*/
if ( ! function_exists( 'rwmb_meta' ) ) {
    function rwmb_meta( $key, $args = '', $post_id = null ) {
        return false;
    }
}


/**
* Check if the post type is a Portfolio post type
*
* @return bool
*/
if ( ! function_exists( 'glaciar_lite_is_portfolio_type' ) ) {
    function glaciar_lite_is_portfolio_type( $post_type ) {

    	$glaciar_lite_portfolios_post_types = get_portfolios_slug();
        if ( ! is_wp_error( $glaciar_lite_portfolios_post_types ) ) {
        	if ( in_array( $post_type, $glaciar_lite_portfolios_post_types ) ) :
                return true;
            else:
                return false;
            endif;
        }else{
            return false;
        }

    }
}


/**
* Display Portfolio or Post navigation
*
* @return html
*/
if ( ! function_exists( 'glaciar_lite_post_navigation' ) ) {
    function glaciar_lite_post_navigation() {

        $post_nav_bck = '';
        $post_nav_bck_next = '';
        $prev_post = get_previous_post();
        if ( ! empty( $prev_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'glaciar_lite_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;
        $next_post = get_next_post();
        if ( ! empty( $next_post ) ):
            $portfolio_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'glaciar_lite_portfolio' );
            if ( ! empty( $portfolio_image ) ) {
                $post_nav_bck_next = ' style="background-image: url(' . esc_url( $portfolio_image[0] ) . ');"';
            }
        endif;

        if ( ! empty( $prev_post ) || ! empty( $next_post ) ):
        ?>
            <nav class="navigation post-navigation" >
                <div class="nav-links">
                    <?php if ( ! empty( $prev_post ) ): ?>
                    <div class="nav-previous" <?php echo $post_nav_bck; ?>>
                        <?php
                        $prev_text = __( 'Previous Post', 'glaciar-lite' );
                        if ( glaciar_lite_is_portfolio_type( get_post_type() ) ) {
                            $prev_text = __( 'Previous Project', 'glaciar-lite' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev"><span><?php echo esc_html( $prev_text ); ?></span><?php echo esc_html( $prev_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $next_post ) ): ?>
                    <div class="nav-next" <?php echo $post_nav_bck_next; ?>>
                        <?php
                        $next_text = __( 'Next Post', 'glaciar-lite' );
                        if ( glaciar_lite_is_portfolio_type( get_post_type() ) ) {
                            $next_text = __( 'Next Project', 'glaciar-lite' );
                        }
                        ?>
                        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next"><span><?php echo esc_html( $next_text ); ?></span><?php echo esc_html( $next_post->post_title ); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php endif;

    }
}

/**
* Return a darker color in HEX
*
* @return string
*/
function glaciar_lite_darken_color( $rgb, $darker = 2 ) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}

/**
 * Enqueues front-end CSS for retina images of portfolio.
 *
 * @see wp_add_inline_style()
 */
function glaciar_lite_portfolio_retina_images() {

    $custom_css = glaciar_lite_get_portfolio_retina_css();

    wp_add_inline_style( 'glaciar_lite_style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'glaciar_lite_portfolio_retina_images' );


/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function glaciar_lite_get_portfolio_retina_css() {


    $glaciar_lite_portfolio_display = rwmb_meta( 'glaciar_lite_portfolio_display' );
    $glaciar_lite_retina_css = '';

    $args = array(
        'post_type'      => $glaciar_lite_portfolio_display,
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {


        while ( $the_query->have_posts() ) { $the_query->the_post();

            if ( has_post_thumbnail() ) {
                $portfolio_image_2x = wp_get_attachment_image_src( get_post_thumbnail_id(), 'glaciar_lite_portfolio_2x' );

                $glaciar_lite_retina_css .= "@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {";
                $glaciar_lite_retina_css .= "#portfolio-item-" . esc_attr( get_the_ID() ) . "{ background-image: url(" . esc_url( $portfolio_image_2x[0] ) . "); }";
                $glaciar_lite_retina_css .=  "}\n";
            }
            
        }//while


    }// if have posts
    wp_reset_postdata();


    $css = <<<CSS

    /*============================================
    // Retina Images
    ============================================*/
    {$glaciar_lite_retina_css}
    


CSS;

    return $css;
}

