<?php
/**
 * Controls fields and settings for the theme header.
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
$trending_mag_section_name = 'header';

$trending_mag_header_options = array(
	'enable_search_button'  => __( 'Enable Search Button', 'trending-mag' ),
	'enable_header_widgets' => __( 'Enable Header Widgets', 'trending-mag' ),
);

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );

if ( ! empty( $trending_mag_header_options ) && is_array( $trending_mag_header_options ) ) {
	foreach ( $trending_mag_header_options as $trending_mag_header_option ) {
		trending_mag_register_option(
			$wp_customize,
			array(
				'type'              => 'trending-mag-flat',
				'custom_control'    => 'Trending_Mag_Toggle_One_Control',
				'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_header_option ),
				'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_header_option ),
				'sanitize_callback' => 'wp_validate_boolean',
				'label'             => esc_html( ucfirst( $trending_mag_header_option ) ),
				'section'           => $trending_mag_section_id,
			)
		);
	}
}

