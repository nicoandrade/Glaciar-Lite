<?php

$glaciar_lite_portfolio_display = rwmb_meta( 'glaciar_lite_portfolio_display' );
if ( empty( $glaciar_lite_portfolio_display ) ) {
    $glaciar_lite_portfolio_display = 'portfolio';
}
//Portfolio Categories
$terms = get_terms( array(
    'taxonomy' => $glaciar_lite_portfolio_display . '_category'
) );
?>
<?php if ( ! is_wp_error( $terms ) ): ?>
    <div class="ql_filter filter_list">
        <ul>
            <li class="active"><a href="#" data-category="all" data-filter="*" ><?php esc_html_e( 'All', 'glaciar-lite' ); ?></a></li>
            <?php foreach ( $terms as $term ) { ?>
                    <li><a href="#" data-category="<?php echo esc_attr( $term->slug ); ?>" data-filter=".<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
        <div class="ql_filter_count">
            <span class="current">0</span>
            <span class="total">0</span>
            <svg class="glaciar-count-svg" x="0px" y="0px" viewBox="0 0 38 199" style="enable-background:new 0 0 38 199;" xml:space="preserve">
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
        </div>
    </div><!-- /ql_filter -->
<?php endif; ?>
