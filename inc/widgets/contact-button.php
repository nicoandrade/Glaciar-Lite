<?php

class glaciar_lite_Contact_Button extends WP_Widget{

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'contact-button-widget', // Base ID
            esc_attr__( 'Glaciar Lite - Contact Button', 'glaciar-lite' ), // Name
            array(
                'description' => esc_attr__( 'Display text and a button.', 'glaciar-lite' ),
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

            <div class="widget_glaciar_lite_work_button">
                
                <h4 class="widget_glaciar_lite_work_title"><?php if( ! empty( $title ) ): echo esc_html( $title ); endif; ?></h4>
                <?php if( ! empty( $instance['button-text'] ) ){ ?>
                    <a href="<?php echo esc_url( $instance['url'] ); ?>" class="ql_primary_btn"><?php echo esc_html( $instance['button-text'] ); ?></a>
                <?php } ?>

                <div class="clearfix"></div>
            </div><!-- widget_glaciar_lite_work_button -->

        <?php

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

		$instance['button-text'] = strip_tags( $new_instance['button-text'] );

        $instance['url'] = strip_tags( $new_instance['url'] );


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

        ?>

        <p>

            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title', 'glaciar-lite' ); ?></label><br/>

            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"
                   id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty( $instance['title'] ) ): echo $instance['title']; endif; ?>"
                   class="widefat"/>

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button-text'); ?>"><?php esc_html_e( 'Button Text', 'glaciar-lite' ); ?></label><br />

            <input type="text" name="<?php echo esc_attr( $this->get_field_name('button-text') ); ?>" id="<?php echo esc_attr( $this->get_field_id('button-text') ); ?>" value="<?php if( ! empty( $instance['button-text'] ) ): echo $instance['button-text']; endif; ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php esc_html_e( 'Link URL', 'glaciar-lite' ); ?></label><br />

            <input type="text" name="<?php echo $this->get_field_name('url'); ?>" id="<?php echo $this->get_field_id('url'); ?>" value="<?php if( !empty( $instance['url'] ) ): echo $instance['url']; endif; ?>" class="widefat" />
        </p>





    <?php

    }

}


register_widget( 'glaciar_lite_Contact_Button' );
