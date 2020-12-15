<?php
/**
 * Controls fields and settings for the Section Three sections of frontpage.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_panel_name   = 'front_page';
$trending_mag_section_name = 'section_three';
$trending_mag_section_id   = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


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
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'hide_category' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'hide_category' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Hide Category?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
		'active_callback'   => 'trending_mag_customizer_is_section_three_enabled',
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'hide_post_meta' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'hide_post_meta' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Hide Post Meta?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
		'active_callback'   => 'trending_mag_customizer_is_section_three_enabled',
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
		'active_callback'   => 'trending_mag_customizer_is_section_three_enabled',
	)
);




trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'number',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' ),
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Number Of Posts', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
		'active_callback'   => 'trending_mag_customizer_is_news_ticker_enabled',
	)
);





trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending_mag_slim_select',
		'custom_control'    => 'Trending_Mag_Customizer_Slim_Select_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'category' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'category' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Category', 'trending-mag' ),
		'description'       => esc_html__( 'Select categories for your contents. Max Limit: 3 Categories.', 'trending-mag' ),
		'choices'           => trending_mag_customizer_get_categories(),
		'input_attrs'       => array(
			'multiple' => true,
			'limit'    => 3,
		),
		'section'           => $trending_mag_section_id,
		'active_callback'   => 'trending_mag_customizer_is_section_three_enabled',
	)
);
