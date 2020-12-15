<?php
/**
 * Footer settings.
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
$trending_mag_section_name = 'footer_options';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'display_footer_widgets' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'display_footer_widgets' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Display Footer Widgets?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'custom_control'    => 'WP_Customize_Cropped_Image_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'footer_logo' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'footer_logo' ),
		'sanitize_callback' => 'absint',
		'flex_width'        => true,
		'flex_height'       => true,
		'width'             => 240,
		'height'            => 80,
		'label'             => esc_html__( 'Footer Logo', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'textarea',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'bio' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'bio' ),
		'sanitize_callback' => 'wp_kses_post',
		'description'       => esc_html__( 'Write a short description about yourself for your visitors.', 'trending-mag' ),
		'label'             => esc_html__( 'Bio', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);

