<?php

if ( ! class_exists( 'Trending_Mag_Toggle_One_Control' ) ) :

	/**
	 * Toggle One Custom Control Class
	 *
	 * All section widgets can extend this class
	 *
	 * @since 1.0.0
	 */
	class Trending_Mag_Toggle_One_Control extends WP_Customize_Control {

		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'trending-mag-flat'; // light, ios, trending-mag-flat

		/**
		 * Enqueue scripts and styles
		 */
		public function enqueue() {

			wp_enqueue_style( 'trending-mag-customizer-toggle-one-style', get_template_directory_uri() . '/inc/customizer/controls/toggle/toggle-one/css/toggle-one.css' );

			wp_enqueue_script( 'trending-mag-customizer-toggle-one-script', get_template_directory_uri() . '/inc/customizer/controls/toggle/toggle-one/js/toggle-one.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {
			?>
			<label>
				<div style="display:flex;flex-direction: row;justify-content: flex-start;">
					<span class="customize-control-title" style="flex: 2 0 0; vertical-align: middle;"><?php echo esc_html( $this->label ); ?></span>
					<input id="cb<?php echo esc_attr( $this->instance_number ); ?>" type="checkbox" class="toggle-one toggle-one-<?php echo esc_attr( $this->type ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" 
											<?php
											$this->link();
											checked( $this->value() );
											?>
					 />
					<label for="cb<?php echo esc_attr( $this->instance_number ); ?>" class="toggle-one-btn"></label>
				</div>
				<?php
				if ( ! empty( $this->description ) ) :
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				endif;
				?>
			</label>
			<?php
		}
	}
endif;

/**
 * Sanitization callback function for toggle one control.
 * Uses default wp_validate_boolean
 */
