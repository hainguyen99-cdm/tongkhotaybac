<?php
/**
 * Controls fields and settings for the Politics Posts sections of Pre Footer.
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
$trending_mag_section_name = 'top_bar';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'enable_top_bar' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'enable_top_bar' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Enable Top Bar?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'left_content' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'left_content' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Left Content', 'trending-mag' ),
		'description'       => esc_html__( 'Select what you want to display at the top bar left content.', 'trending-mag' ),
		'choices'           => array(
			'date'        => esc_html__( "Today's Date", 'trending-mag' ),
			'cta-btn'     => esc_html__( 'Call To Action', 'trending-mag' ),
			'custom-text' => esc_html__( 'Custom Text', 'trending-mag' ),
		),
		'active_callback'   => 'trending_mag_customizer_is_top_bar_enabled',
		'section'           => $trending_mag_section_id,
	)
);


/**
 * If left content is date.
 */

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'date_format' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'date_format' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Date Format', 'trending-mag' ),
		'description'       => esc_html__( 'If WP Default is selected, then admin settings date format will be used.', 'trending-mag' ),
		'choices'           => array(
			'default' => esc_html__( 'WP Default', 'trending-mag' ),
			'F j, Y'  => esc_html( gmdate( 'F j, Y' ) . ' [ F j, y ]' ),
			'Y-m-d'   => esc_html( gmdate( 'Y-m-d' ) . ' [ Y-m-d ]' ),
			'm/d/Y'   => esc_html( gmdate( 'm/d/Y' ) . ' [ m/d/Y ]' ),
			'd/m/Y'   => esc_html( gmdate( 'd/m/Y' ) . ' [ d/m/Y ]' ),
		),
		'active_callback'   => function( $control ) {
			$is_top_bar      = trending_mag_customizer_is_top_bar_enabled( $control );
			$left_content_id = trending_mag_customizer_fields_settings_id( 'general_options', 'top_bar', 'left_content' );

			$left_content = $control->manager->get_setting( $left_content_id )->value();
			return $is_top_bar && 'date' === $left_content;

		},
		'section'           => $trending_mag_section_id,
	)
);


/**
 * If left content is call to action.
 */

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'url',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'cta_link' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'cta_link' ),
		'sanitize_callback' => 'esc_url_raw',
		'label'             => esc_html__( 'Call To Action Link', 'trending-mag' ),
		'description'       => esc_html__( 'Enter link for your call to action button.', 'trending-mag' ),
		'input_attrs'       => array(
			'placeholder' => esc_attr( 'https://' ),
		),
		'active_callback'   => function( $control ) {
			$is_top_bar      = trending_mag_customizer_is_top_bar_enabled( $control );
			$left_content_id = trending_mag_customizer_fields_settings_id( 'general_options', 'top_bar', 'left_content' );

			$left_content = $control->manager->get_setting( $left_content_id )->value();
			return $is_top_bar && 'cta-btn' === $left_content;

		},
		'section'           => $trending_mag_section_id,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'text',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'cta_label' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'cta_label' ),
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Call To Action Label', 'trending-mag' ),
		'description'       => esc_html__( 'Label for your call to action button.', 'trending-mag' ),
		'active_callback'   => function( $control ) {
			$is_top_bar      = trending_mag_customizer_is_top_bar_enabled( $control );
			$left_content_id = trending_mag_customizer_fields_settings_id( 'general_options', 'top_bar', 'Left Content' );

			$left_content = $control->manager->get_setting( $left_content_id )->value();
			return $is_top_bar && 'cta-btn' === $left_content;

		},
		'section'           => $trending_mag_section_id,
	)
);



/**
 * If left content is custom text.
 */

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'text',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'custom_text' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'custom_text' ),
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Custom Text', 'trending-mag' ),
		'description'       => esc_html__( 'Enter your custom text to display in top bar left corner.', 'trending-mag' ),
		'active_callback'   => function( $control ) {
			$is_top_bar      = trending_mag_customizer_is_top_bar_enabled( $control );
			$left_content_id = trending_mag_customizer_fields_settings_id( 'general_options', 'top_bar', 'Left Content' );

			$left_content = $control->manager->get_setting( $left_content_id )->value();
			return $is_top_bar && 'custom-text' === $left_content;

		},
		'section'           => $trending_mag_section_id,
	)
);
