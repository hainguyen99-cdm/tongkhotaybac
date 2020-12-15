<?php
/**
 * Pre Footer settings.
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
$trending_mag_section_name = 'pre_footer_options';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'enable_pre_footer' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'enable_pre_footer' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Enable Pre Footer?', 'trending-mag' ),
		'section'           => $trending_mag_section_id,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending_mag_slim_select',
		'custom_control'    => 'Trending_Mag_Customizer_Slim_Select_Control',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'pre_footer_visibility' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'pre_footer_visibility' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Pre Footer Visibility', 'trending-mag' ),
		'description'       => esc_html__( 'Select where you want to display pre footer.', 'trending-mag' ),
		'input_attrs'       => array(
			'multiple' => true,
		),
		'choices'           => array(
			'trending_mag_frontpage'                => __( 'Static Front Page', 'trending-mag' ),
			'trending_mag_archive_after_pagination' => __( 'Blogs and Archives', 'trending-mag' ),
			'trending_mag_singular_after_content_wrapper_ends' => __( 'Single Posts and Pages', 'trending-mag' ),
		),
		'section'           => $trending_mag_section_id,
	)
);
