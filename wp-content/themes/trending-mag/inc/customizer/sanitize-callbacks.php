<?php
/**
 * All the customizer settings sanization functions.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'trending_mag_sanitize_select' ) ) {

	/**
	 * Sanitization callback function for select field.
	 */
	function trending_mag_sanitize_select( $input, $setting ) {

		/**
		 * Bail early if the $input is empty.
		 * It prevents the false validation notification.
		 */
		if ( empty( $input ) ) {
			return $input;
		}

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		$attrs   = $setting->manager->get_control( $setting->id )->input_attrs;

		$is_multiple = ! empty( $attrs['multiple'] ) ? $attrs['multiple'] : false;

		if ( $is_multiple ) {
			$valid_data = array();
			if ( is_array( $input ) && ! empty( $input ) ) {
				foreach ( $input as $ids ) {
					$found = ! empty( $choices[ $ids ] ) ? $choices[ $ids ] : false;
					if ( $found ) {
						array_push( $valid_data, $ids );
					}
				}
			}

			if ( count( $valid_data ) > 0 ) {
				/**
				 * Return the valid data.
				 */
				return $valid_data;
			}
		} else {
			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

	}
}


/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function trending_mag_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
