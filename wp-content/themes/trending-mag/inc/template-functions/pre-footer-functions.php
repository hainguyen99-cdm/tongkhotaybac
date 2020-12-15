<?php
/**
 * Code blocks and hooks for the theme pre footer.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_panel_name   = 'general_options';
$trending_mag_section_name = 'pre_footer_options';

$trending_mag_enable = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_pre_footer' );

if ( ! $trending_mag_enable ) {
	return;
}

$trending_mag_hooks = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'pre_footer_visibility' );

$trending_mag_priority = apply_filters( 'trending_mag_prefooter_visibility_priority', 100 );

if ( ! function_exists( 'trending_mag_prefooter_visibility' ) ) {

	/**
	 * Loads the pre footer according to the selected visibility from customizer.
	 */
	function trending_mag_prefooter_visibility() {
		get_template_part( 'template-parts/pre-footer/pre-footer' );
	}

	if ( is_array( $trending_mag_hooks ) && ! empty( $trending_mag_hooks ) ) {
		foreach ( $trending_mag_hooks as $trending_mag_hook ) {
			add_action( $trending_mag_hook, 'trending_mag_prefooter_visibility', $trending_mag_priority );
		}
	}
}


/**
 * Pre footer section functions starts.
 */



if ( ! function_exists( 'trending_mag_prefooter_section_one' ) ) {

	/**
	 * Pre footer section one.
	 */
	function trending_mag_prefooter_section_one() {
		get_template_part( 'template-parts/pre-footer/sections/popular-posts' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_one', 15 );
}


if ( ! function_exists( 'trending_mag_prefooter_section_two' ) ) {

	/**
	 * Pre footer section two.
	 */
	function trending_mag_prefooter_section_two() {
		get_template_part( 'template-parts/pre-footer/sections/most-viewed' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_two', 20 );
}


if ( ! function_exists( 'trending_mag_prefooter_section_three' ) ) {

	/**
	 * Pre footer section three.
	 */
	function trending_mag_prefooter_section_three() {
		get_template_part( 'template-parts/pre-footer/sections/latest-posts' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_three', 25 );
}


if ( ! function_exists( 'trending_mag_prefooter_section_four' ) ) {

	/**
	 * Pre footer section four.
	 */
	function trending_mag_prefooter_section_four() {
		get_template_part( 'template-parts/pre-footer/sections/entertainment-posts' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_four', 30 );
}



if ( ! function_exists( 'trending_mag_prefooter_section_five' ) ) {

	/**
	 * Pre footer section five.
	 */
	function trending_mag_prefooter_section_five() {
		get_template_part( 'template-parts/pre-footer/sections/politics-posts' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_five', 35 );
}



if ( ! function_exists( 'trending_mag_prefooter_section_six' ) ) {

	/**
	 * Pre footer section five.
	 */
	function trending_mag_prefooter_section_six() {
		get_template_part( 'template-parts/pre-footer/sections/foreign-news' );
	}
	add_action( 'trending_mag_prefooter', 'trending_mag_prefooter_section_six', 40 );
}
