<?php
/**
 * All the helper functions for the customizer work ease.
 *
 * @package trending-mag
 */

/**
 * Format the string ready for customizer id.
 *
 * @param string $string Raw or unformated string.
 * @return string Formated string.
 */
function trending_mag_format_string_id_ready( $string ) {
	$string_lower = strtolower( $string );
	return str_replace( array( ' ', '-' ), array( '_', '_' ), $string_lower );
}

/**
 * Returns the panel id.
 *
 * @param string $trending_mag_panel_name Customizer panel name.
 * @return string Panel ID.
 */
function trending_mag_get_customizer_panel_id( $trending_mag_panel_name ) {
	if ( empty( $trending_mag_panel_name ) || ! is_string( $trending_mag_panel_name ) ) {
		return;
	}
	$trending_mag_panel_name = trending_mag_format_string_id_ready( $trending_mag_panel_name );
	return 'trending_mag_panel_' . $trending_mag_panel_name;
}

/**
 * Returns the section ID.
 *
 * @param string $parent_panel Parent panel name or ID.
 * @param string $trending_mag_section_name Name of the customizer section.
 * @return string Section ID.
 */
function trending_mag_get_customizer_section_id( $parent_panel, $trending_mag_section_name ) {
	if ( empty( $parent_panel ) || ! is_string( $parent_panel ) ) {
		return;
	}
	if ( empty( $trending_mag_section_name ) || ! is_string( $trending_mag_section_name ) ) {
		return;
	}

	$trending_mag_section_name = trending_mag_format_string_id_ready( $trending_mag_section_name );
	return trending_mag_get_customizer_panel_id( $parent_panel ) . '_section_' . $trending_mag_section_name;
}

/**
 * Returns the settings ID.
 *
 * @param string $trending_mag_panel_name Customizer panel name.
 * @param string $trending_mag_section_name Section name.
 * @param string $field_name Field name.
 * @return string Section ID.
 */
function trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, $field_name ) {
	$trending_mag_panel_name   = trending_mag_format_string_id_ready( $trending_mag_panel_name );
	$trending_mag_section_name = trending_mag_format_string_id_ready( $trending_mag_section_name );
	$field_name                = trending_mag_format_string_id_ready( $field_name );

	return 'trending_mag_theme_options[' . $trending_mag_panel_name . '][' . $trending_mag_section_name . '][' . $field_name . ']';
}

/**
 * Returns the theme mods.
 *
 * @param string $trending_mag_panel_name Customizer panel name.
 * @param string $trending_mag_section_name Section name.
 * @param string $field_name Field name.
 * @return mixed Theme mod.
 */
function trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, $field_name ) {
	$trending_mag_panel_name   = trending_mag_format_string_id_ready( $trending_mag_panel_name );
	$trending_mag_section_name = trending_mag_format_string_id_ready( $trending_mag_section_name );
	$field_name                = trending_mag_format_string_id_ready( $field_name );

	$default = trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, $field_name );
	$mods    = get_theme_mod( 'trending_mag_theme_options' );

	return isset( $mods[ $trending_mag_panel_name ][ $trending_mag_section_name ][ $field_name ] ) ? $mods[ $trending_mag_panel_name ][ $trending_mag_section_name ][ $field_name ] : $default;
}

/**
 * Retrives the category listings for category listing.
 */
function trending_mag_customizer_get_categories() {
	$cats = array();

	$post_cats = apply_filters(
		'trending_mag_customizer_get_categories',
		get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		)
	);

	if ( ! empty( $post_cats ) && is_array( $post_cats ) && ! is_wp_error( $post_cats ) ) {
		foreach ( $post_cats as $post_cat ) {
			$cat_id   = ! empty( $post_cat->term_id ) ? $post_cat->term_id : '';
			$cat_name = ! empty( $post_cat->name ) ? $post_cat->name : '';

			if ( $cat_name ) {
				$cats[ $cat_id ] = $cat_name;
			}
		}
	}

	return $cats;

}


/**
 * Returns the array of wishful ads.
 */
function trending_mag_customizer_get_ads() {

	$ads = array();

	if ( ! trending_mag_is_ad_manager_active() ) {
		return $ads;
	}

	if ( ! defined( 'WISHFUL_AD_POST_TYPE' ) ) {
		return $ads;
	}

	$the_query = new WP_Query(
		array(
			'post_type'      => WISHFUL_AD_POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		)
	);

	if ( $the_query->have_posts() ) {
		$ads[0] = __( '--Disable--', 'trending-mag' );
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$ads[ get_the_ID() ] = get_the_title();
		}
	}

	wp_reset_postdata();

	return $ads;
}
