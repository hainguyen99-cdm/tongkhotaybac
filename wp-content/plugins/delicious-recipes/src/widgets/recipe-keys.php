<?php
/**
 * Adds Recipe Keys Widget.
 * @package Delicious_Recipes
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Delicious_Recipe_Keys_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'delicious_recipe_keys_widget', // Base ID
            __( 'Delicious: Recipe Keys', 'delicious-recipes' ), // Name
            array( 
                'description' => __( 'A Recipe Keys Widget for Delicious Recipes.', 'delicious-recipes' ),
                'classname'   => 'dr-recipe-keys'
            ) // Args
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
    public function widget( $args, $instance ) {

        if ( is_active_widget( false, false, $this->id_base, true ) ) {
            wp_enqueue_script( 'all', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/fontawesome/all.min.js', array( 'jquery' ), '5.14.0', true );
        }

        extract( $args );
        $title    = apply_filters( 'widget_title', $instance['title'] );
        $taxonomy = 'recipe-key';

        echo $before_widget;

        ob_start();

        if ( ! empty( $title ) ) {
            echo $before_title . esc_html( $title ) . $after_title;
        }

        $recipe_keys = get_terms( array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ) );

        $data = array (
            'recipe_keys' => $recipe_keys,
            'taxonomy'    => $taxonomy
        );

        delicious_recipes_get_template( 'widgets/recipe-keys.php', $data );

        $html = ob_get_clean();
        echo apply_filters( 'wp_delicious_recipe_keys_widget', $html, $args, $instance );
        
        echo $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title    = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Recipe Keys', 'delicious-recipes' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'delicious-recipes' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
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
        $instance = array();
        $instance['title']    = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // class Delicious_Recipe_Keys_Widget
