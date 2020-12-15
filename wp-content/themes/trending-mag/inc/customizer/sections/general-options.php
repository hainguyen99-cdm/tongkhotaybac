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


$trending_mag_panel_name = 'general_options';

/**
 * These array keys gets converted to required keys from function below.
 */
$trending_mag_sections = array(
	'Top Bar'            => array(
		'section_title' => __( 'Top Bar', 'trending-mag' ),
	),
	'Header'             => array(
		'section_title' => __( 'Header', 'trending-mag' ),
	),
	'Layouts'            => array(
		'section_title' => __( 'Layouts', 'trending-mag' ),
		'description'   => __( 'Customize theme layouts.', 'trending-mag' ),
	),
	'Social Links'       => array(
		'section_title' => __( 'Social Links', 'trending-mag' ),
	),
	'Social Sharer'      => array(
		'section_title' => __( 'Social Sharer', 'trending-mag' ),
	),
	'Typography'         => array(
		'section_title' => __( 'Typography', 'trending-mag' ),
	),
	'Sort Sections'      => array(
		'section_title' => __( 'Sort Sections', 'trending-mag' ),
		'description'   => __( 'Sort your static frontpage sections', 'trending-mag' ),
	),
	'Pre Footer Options' => array(
		'section_title' => __( 'Pre Footer Options', 'trending-mag' ),
	),
	'Footer Options'     => array(
		'section_title' => __( 'Footer Options', 'trending-mag' ),
	),
);

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
