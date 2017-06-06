<?php

class glaciar_lite_Portfolio extends WP_Widget{

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'glaciar_lite_portfolio', // Base ID
            esc_attr__( 'Glaciar Lite - Portfolio', 'glaciar-lite' ), // Name
            array(
                'description' => esc_attr__( 'Display items from Portfolios.', 'glaciar-lite' ),
            )
        );
    }



    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ){

        echo $args['before_widget'];

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        ?>
            <?php if( ! empty( $title ) ): echo $args['before_title'] . $title . $args['after_title']; endif; ?>
            <?php
            echo '<div class="widget-portfolio-wrap">';

            if ( ! empty( $instance['portfolio'] ) ) {
                $post_type = $instance['portfolio'];
            }else{
                $post_type = 'portfolio';
            }


                $query_args = array(
                    'post_type' => $post_type,
                    'posts_per_page' => 6
                );

                $the_query = new WP_Query( $query_args );
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) { $the_query->the_post();

                        if ( has_post_thumbnail() ) {
                            echo '<div class="widget-portfolio-item">';
                                echo '<a href="' . esc_url( get_permalink() ) . '">';
                                    the_post_thumbnail( 'thumbnail' );
                                echo '</a>';
                            echo '</div>';
                        }

                    }//while

                }else{// if have posts
                    esc_html_e( 'No items to show.', 'glaciar-lite' );
                }

            echo '</div>';

        echo $args['after_widget'];

    }





    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['portfolio'] = strip_tags( $new_instance['portfolio'] );

        return $instance;

    }






    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $instance['portfolio'] = ! empty( $instance['portfolio'] ) ? $instance['portfolio'] : 'portfolio';
        ?>

        <p>

            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'glaciar-lite' ); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"
                   id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php if( ! empty( $instance['title'] ) ): echo $instance['title']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'portfolio' ); ?>"><?php esc_html_e( 'Select Portfolio', 'glaciar-lite' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'portfolio' ); ?>" name="<?php echo $this->get_field_name( 'portfolio' ); ?>">
            <?php
            if ( class_exists( 'Multiple_Portfolios' ) ) {

                $glaciar_lite_portfolio_types = Multiple_Portfolios::get_post_types();
                foreach ( $glaciar_lite_portfolio_types as $item ) {
                    ?>
                    <option value='<?php echo esc_attr( $item['slug'] ) ?>' <?php selected( $instance['portfolio'], $item['slug'] )?>><?php echo esc_attr( $item['name'] ) ?></option>";
                    <?php
                }
            }
            ?>
			</select>
		</p>

    <?php

    }

}


register_widget( 'glaciar_lite_Portfolio' );
