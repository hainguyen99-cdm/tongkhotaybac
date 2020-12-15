<?php
/**
 * Settings for section sorting for the frontpage.
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
$trending_mag_section_name = 'sort_sections';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );

$trending_mag_choices = trending_mag_frontpage_section_callbacks();

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-sortable-one',
		'custom_control'    => 'Trending_Mag_Sortable_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'sections' ),
		'sanitize_callback' => 'trending_mag_sanitize_sortable_one',
		'label'             => esc_html__( 'Sections', 'trending-mag' ),
		'choices'           => $trending_mag_choices,
		'section'           => $trending_mag_section_id,
	)
);
