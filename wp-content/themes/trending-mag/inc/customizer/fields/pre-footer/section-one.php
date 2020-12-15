<?php
/**
 * Controls fields and settings for the Section One sections of Pre Footer.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_panel_name   = 'pre_footer';
$trending_mag_section_name = 'section_one';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Enable Section?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'text',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'heading' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'heading' ),
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Heading', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);




trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'category' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'category' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Category', 'trending-mag' ),
		'description'       => esc_html__( 'Select a category for your section content.', 'trending-mag' ),
		'choices'           => trending_mag_customizer_get_categories(),
		'section'           => $trending_mag_section_id,
	)
);
