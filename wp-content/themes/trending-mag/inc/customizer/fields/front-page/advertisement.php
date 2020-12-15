<?php
/**
 * Controls fields and settings for the theme advertisement section.
 * It will only appear when ad manager plugin is active.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trending_mag_is_ad_manager_active() ) {
	return;
}

$trending_mag_panel_name   = 'front_page';
$trending_mag_section_name = 'advertisement';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'advertisement' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'advertisement' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Select Advertisement', 'trending-mag' ),
		'choices'           => trending_mag_customizer_get_ads(),
		'section'           => $trending_mag_section_id,
		'priority'          => 25,
	)
);
