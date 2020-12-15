<?php
/**
 * Controls fields and settings for the theme social links.
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
$trending_mag_section_name = 'social_links';

$trending_mag_social_links = trending_mag_get_social_links();

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'enable_social_links' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'enable_social_links' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Enable Social Links?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);


if ( ! empty( $trending_mag_social_links ) && is_array( $trending_mag_social_links ) ) {
	foreach ( $trending_mag_social_links as $trending_mag_social_link ) {
		trending_mag_register_option(
			$wp_customize,
			array(
				'type'              => 'url',
				'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_social_link ),
				'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, $trending_mag_social_link ),
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html( ucfirst( $trending_mag_social_link ) ),
				'input_attrs'       => array(
					'placeholder' => esc_attr( "{$trending_mag_social_link}.com" ),
				),
				'section'           => $trending_mag_section_id,
			)
		);
	}
}

