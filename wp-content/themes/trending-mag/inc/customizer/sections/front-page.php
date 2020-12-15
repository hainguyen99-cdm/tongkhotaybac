<?php
/**
 * Create theme customizer sections.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$trending_mag_panel_name = 'front_page';

/**
 * These array keys gets converted to required keys from function below.
 */
$trending_mag_sections = array(
	'News Ticker'   => array(
		'section_title' => __( 'News Ticker', 'trending-mag' ),
	),
	'Banner Slider' => array(
		'section_title' => __( 'Banner Slider', 'trending-mag' ),
	),
	'Advertisement' => array(
		'section_title' => __( 'Advertisement', 'trending-mag' ),
	),
	'Section One'   => array(
		'section_title' => __( 'Section One', 'trending-mag' ),
	),
	'Section Two'   => array(
		'section_title' => __( 'Section Two', 'trending-mag' ),
	),
	'Section Three' => array(
		'section_title' => __( 'Section Three', 'trending-mag' ),
	),
	'section_four'  => array(
		'section_title' => __( 'Section Four', 'trending-mag' ),
	),
	'Section Five'  => array(
		'section_title' => __( 'Section Five', 'trending-mag' ),
	),
);

if ( ! trending_mag_is_ad_manager_active() ) {
	unset( $trending_mag_sections['Advertisement'] );
}

if ( is_array( $trending_mag_sections ) && count( $trending_mag_sections ) > 0 ) {
	$trending_mag_priority = 10;
	foreach ( $trending_mag_sections as $trending_mag_section_id => $trending_mag_sections_args ) {
		$trending_mag_section_title = ! empty( $trending_mag_sections_args['section_title'] ) ? $trending_mag_sections_args['section_title'] : '';
		$trending_mag_description   = ! empty( $trending_mag_sections_args['description'] ) ? $trending_mag_sections_args['description'] : '';

		$wp_customize->add_section(
			trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_id ),
			array(
				'title'       => $trending_mag_section_title,
				'panel'       => trending_mag_get_customizer_panel_id( $trending_mag_panel_name ),
				'description' => $trending_mag_description,
				'priority'    => $trending_mag_priority,
			)
		);

		$trending_mag_priority = $trending_mag_priority + 5;

	}
}
