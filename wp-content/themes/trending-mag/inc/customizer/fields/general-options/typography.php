<?php
/**
 * Controls fields and settings for the typography section.
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
$trending_mag_section_name = 'typography';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );

$trending_mag_fonts = trending_mag_get_fonts();

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'heading_font' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'heading_font' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Heading Font', 'trending-mag' ),
		'description'       => esc_html__( 'Select a font for your theme headings.', 'trending-mag' ),
		'choices'           => $trending_mag_fonts,
		'section'           => $trending_mag_section_id,
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'content_font' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'content_font' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Content Font', 'trending-mag' ),
		'description'       => esc_html__( 'Select a font for your theme paragraphs and contents.', 'trending-mag' ),
		'choices'           => $trending_mag_fonts,
		'section'           => $trending_mag_section_id,
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'number',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'excerpt_length' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'excerpt_length' ),
		'sanitize_callback' => 'absint',
		'label'             => esc_html__( 'Excerpt Length', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
		'active_callback'   => 'trending_mag_customizer_is_news_ticker_enabled',
	)
);


