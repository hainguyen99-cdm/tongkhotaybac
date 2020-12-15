<?php
/**
 * Controls fields and settings for the theme social sharer.
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
$trending_mag_section_name = 'social_sharer';

if ( ! function_exists( 'trending_mag_pro_get_supported_sharer' ) ) {
	return;
}

$trending_mag_social_links = trending_mag_pro_get_supported_sharer();

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );

if ( ! empty( $trending_mag_social_links ) && is_array( $trending_mag_social_links ) ) {
	foreach ( $trending_mag_social_links as $trending_mag_social_link ) {
		trending_mag_register_option(
			$wp_customize,
			array(
				'type'              => 'trending-mag-flat',
				'custom_control'    => 'Trending_Mag_Toggle_One_Control',
				'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_social_link ),
				'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_social_link ),
				'sanitize_callback' => 'wp_validate_boolean',
				'label'             => esc_html( ucfirst( $trending_mag_social_link ) ),
				'section'           => $trending_mag_section_id,
			)
		);
	}
}

