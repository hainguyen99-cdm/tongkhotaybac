<?php

if ( ! class_exists( 'Trending_Mag_Sortable_One_Control' ) ) :

	/**
	 * Sortable One Custom Control Class
	 *
	 * All section widgets can extend this class
	 *
	 * @since 1.0.0
	 */
	class Trending_Mag_Sortable_One_Control extends WP_Customize_Control {

		/**
		 * Declare the control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'trending-mag-sortable-one';

		public $disable_key;

		/**
		 * Enqueue scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'trending-mag-customizer-sortable-one-style', get_template_directory_uri() . '/inc/customizer/controls/sortable/sortable-one/css/sortable-one.css', array(), '1.0.0', 'all' );
			wp_enqueue_script( 'trending-mag-customizer-sortable-one-script', get_template_directory_uri() . '/inc/customizer/controls/sortable/sortable-one/js/sortable-one.js', array( 'jquery' ), '1.0.0', true );
		}

		/**
		 * Render the control's content.
		 */
		public function render_content() {

			$options = array();

			$values  = $this->value();
			$values  = is_string( $values ) && ! empty( $values ) ? explode( ',', $values ) : '';
			$choices = $this->choices;

			// Do nothing if we don't have choices.
			if ( empty( $choices ) || ! is_array( $choices ) ) {
				printf( '<span class="customize-control-title">%s</span>', esc_html__( 'Please provide options (choices) for sorting.', 'trending-mag' ) );
				return;
			}

			// Display label.
			if ( ! empty( $this->label ) ) {
				printf( '<span class="customize-control-title">%s</span>', esc_html( $this->label ) );
			}

			// Display description.
			if ( ! empty( $this->description ) ) {
				printf( '<span class="description customize-control-description">%s</span>', wp_kses_post( $this->description ) );
			}

			if ( ! empty( $values ) && is_array( $values ) ) {
				// Get individual item.
				foreach ( $values as $value ) {

					// Separate item with option.
					$value = explode( ':', $value );

					// Build the array and remove options not listed on choices.
					if ( array_key_exists( $value[0], $choices ) ) {
						$options[ $value[0] ] = $value[1] ? '1' : '0';
					}
				}
			}

			// If there are new options, add it at the end.
			foreach ( $choices as $key => $val ) {
				if ( ! array_key_exists( $key, $options ) ) {
					$options[ $key ] = '0';
				}
			}

			?>

			<ul class="sortable-one-options-list"><!--multicheck-sortable-list-->

				<?php foreach ( $options as $key => $value ) { ?>

					<li>
						<label class="sortable-one-check-label sortable-one-options-handle"><!--multicheck-sortable-item-->
						<?php
							$disable = isset( $this->disableKey ) && ( $this->disableKey === $key ) ? esc_attr( 'disabled' ) : '';
						?>
							<input name="<?php echo esc_attr( $key ); ?>" class="sortable-one-options-item" type="hidden" value="<?php echo esc_attr( $value ); ?>" 
													<?php
													checked( $value );
													echo esc_attr( $disable );
													?>
							/>
							<!-- <em></em> -->
							<i class="dashicons dashicons-menu"></i><!-- multicheck-sortable-handle -->
							<?php echo esc_html( $choices[ $key ] ); ?>
						</label>
					</li>

				<?php } // end choices. ?>

					<li class="sortable-one-options-hideme">
						<input type="hidden" class="sortable-one-options" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
					</li>

			</ul><!-- .sortable-options-list -->

			<?php
		}
	}
endif;

if ( ! function_exists( 'trending_mag_sanitize_sortable_one' ) ) :
	/**
	 * Sanitization callback function for sortable one control.
	 */
	function trending_mag_sanitize_sortable_one( $input, $setting ) {

		$output = array();

		$choices = $setting->manager->get_control( $setting->id )->choices;

		$items = explode( ',', $input );

		if ( ! $items ) {
			return null;
		}

		foreach ( $items as $item ) {
			$item = explode( ':', $item );

			if ( isset( $item[0] ) && isset( $item[1] ) ) {
				if ( array_key_exists( $item[0], $choices ) ) {
					$status   = $item[1] ? '1' : '0';
					$output[] = trim( $item[0] . ':' . $status );
				}
			}
		}

		return trim( esc_attr( implode( ',', $output ) ) );
	}
endif;
