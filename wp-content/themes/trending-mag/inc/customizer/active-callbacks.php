<?php
/**
 * All the common active callback for the customizer controls.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'trending_mag_customizer_is_top_bar_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_top_bar_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'general_options', 'top_bar', 'enable_top_bar' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}


if ( ! function_exists( 'trending_mag_customizer_is_news_ticker_enabled' ) ) {

	/**
	 * Checks if news ticker is enabled or not.
	 */
	function trending_mag_customizer_is_news_ticker_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'news_ticker', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}


if ( ! function_exists( 'trending_mag_customizer_is_banner_slider_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_banner_slider_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'banner_slider', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}



if ( ! function_exists( 'trending_mag_customizer_is_section_one_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_section_one_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'section_one', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}



if ( ! function_exists( 'trending_mag_customizer_is_section_two_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_section_two_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'section_two', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}



if ( ! function_exists( 'trending_mag_customizer_is_section_three_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_section_three_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'section_three', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}



if ( ! function_exists( 'trending_mag_customizer_is_section_four_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_section_four_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'section_four', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}




if ( ! function_exists( 'trending_mag_customizer_is_section_five_enabled' ) ) {

	/**
	 * Checks if top bar is enabled or not.
	 */
	function trending_mag_customizer_is_section_five_enabled( $control ) {
		$top_bar_id = trending_mag_customizer_fields_settings_id( 'front_page', 'section_five', 'enable_section' );
		return $control->manager->get_setting( $top_bar_id )->value();
	}
}

