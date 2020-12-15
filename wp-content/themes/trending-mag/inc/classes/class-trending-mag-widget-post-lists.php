<?php
/**
 * Class file for creating the section widget.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Trending_Mag_Widget_Post_Lists' ) ) {

	/**
	 * Class file for creating the section widget.
	 */
	class Trending_Mag_Widget_Post_Lists extends WP_Widget {


		/**
		 * Sets up the widgets name etc.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'Trending_Mag_Widget_Post_Lists',
				'description' => __( 'Post listing widget with thumbnail.', 'trending-mag' ),
			);
			parent::__construct( 'Trending_Mag_Widget_Post_Lists', 'Trending Mag Post Lists', $widget_ops );
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

			echo isset( $args['before_widget'] ) ? $args['before_widget'] : null; //phpcs:ignore
			?>
			<div class="secondary-widget-area-content layout1">

				<?php
				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; //phpcs:ignore
				}

				$open_in_new = ! empty( $instance['open_in_new'] ) ? 'target=_blank' : null;

				$query_args = array(
					'post_type'      => 'post',
					'posts_per_page' => ! empty( $instance['total_posts'] ) ? $instance['total_posts'] : 5,
					'tax_query'      => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => isset( $instance['category'] ) ? $instance['category'] : null,
						),
					),
				);

				$the_query = new WP_Query( $query_args );

				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>

						<div class="small-widget-area">

							<div class="img-holder">
								<figure class="thumb is-standard">
									<a href="<?php the_permalink(); ?>" <?php echo esc_attr( $open_in_new ); ?>>
										<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
									</a>
								</figure><!-- // thumb -->
							</div>

							<div class="rm-content-bdy">

								<?php
								the_title(
									'<div class="widget-inn-tt"><h5 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '" ' . esc_attr( $open_in_new ) . '>',
									'</a></h5></div>'
								);

								trending_mag_post_meta_data();

								?>

							</div><!-- //  rm-content-bdy-->
						</div><!-- // small-widget-area -->

						<?php
					}
				} else {
					?>
					<div class="small-widget-area">
						<div class="rm-content-bdy">
							<h3><?php esc_html_e( 'No Posts Available', 'trending-mag' ); ?></h3>
						</div>
					</div>
					<?php
				}

				wp_reset_postdata();
				?>


			</div><!-- //secondary-widget-area-content layout1 -->
			<?php
			echo isset( $args['after_widget'] ) ? $args['after_widget'] : null; //phpcs:ignore
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {

			$title       = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Main News', 'trending-mag' );
			$total_posts = ! empty( $instance['total_posts'] ) ? $instance['total_posts'] : 5;
			$open_in_new = ! empty( $instance['open_in_new'] ) ? $instance['open_in_new'] : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<strong><?php esc_html_e( 'Title:', 'trending-mag' ); ?></strong>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
					<strong><?php esc_html_e( 'Select Category:', 'trending-mag' ); ?></strong>
				</label>
				<?php
				wp_dropdown_categories(
					array(
						'taxonomy'        => 'category',
						'show_option_all' => esc_html__( 'Select Category', 'trending-mag' ),
						'name'            => $this->get_field_name( 'category' ),
						'id'              => $this->get_field_id( 'category' ),
						'class'           => 'widefat',
						'value_field'     => 'slug',
						'hide_empty'      => 1,
						'selected'        => isset( $instance['category'] ) ? $instance['category'] : '',
					)
				);
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'total_posts' ) ); ?>">
					<strong><?php esc_html_e( 'Total Posts:', 'trending-mag' ); ?></strong>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'total_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'total_posts' ) ); ?>" type="number" min="1" value="<?php echo esc_attr( $total_posts ); ?>">
			</p>
			<p>
				<label>
					<input type="checkbox" <?php checked( $open_in_new, 'yes' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'open-in-new' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'open_in_new' ) ); ?>" value="yes">
					<span><?php esc_html_e( 'Open Post In New Tab', 'trending-mag' ); ?></span>
				</label>
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

			$instance['category']    = ( ! empty( $new_instance['category'] ) ) ? sanitize_key( $new_instance['category'] ) : '';
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : __( 'Main News', 'trending-mag' );
			$instance['total_posts'] = ( ! empty( $new_instance['total_posts'] ) ) ? absint( $new_instance['total_posts'] ) : 5;
			$instance['open_in_new'] = ( ! empty( $new_instance['open_in_new'] ) ) ? sanitize_key( $new_instance['open_in_new'] ) : '';
			return $instance;
		}
	}
}


if ( ! function_exists( 'trending_mag_widget_post_lists' ) ) {

	/**
	 * Init widget.
	 */
	function trending_mag_widget_post_lists() {
		register_widget( 'Trending_Mag_Widget_Post_Lists' );
	}
	add_action( 'widgets_init', 'trending_mag_widget_post_lists' );
}
