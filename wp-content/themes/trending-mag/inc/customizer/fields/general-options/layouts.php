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
$trending_mag_section_name = 'layouts';

$trending_mag_section_id = trending_mag_get_customizer_section_id( $trending_mag_panel_name, $trending_mag_section_name );

$trending_mag_layouts = trending_mag_get_sidebar_layouts();


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'blogs_and_archives_listings' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'blogs_and_archives_listings' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Blogs and Archives Listings', 'trending-mag' ),
		'description'       => esc_html__( 'Choose content listing style for your blogs and archive pages.', 'trending-mag' ),
		'choices'           => array(
			'layout-one' => __( 'Layout One', 'trending-mag' ),
			'layout-two' => __( 'Layout Two', 'trending-mag' ),
		),
		'section'           => $trending_mag_section_id,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'blogs_and_archives' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'blogs_and_archives' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Blogs and Archives', 'trending-mag' ),
		'description'       => esc_html__( 'Choose layout for your site archives and blog pages.', 'trending-mag' ),
		'choices'           => $trending_mag_layouts,
		'section'           => $trending_mag_section_id,
	)
);




trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'single_posts' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'single_posts' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Single Posts', 'trending-mag' ),
		'description'       => esc_html__( 'Choose layout for your site single posts.', 'trending-mag' ),
		'choices'           => $trending_mag_layouts,
		'section'           => $trending_mag_section_id,
	)
);



trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'single_pages' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'single_pages' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Single Pages', 'trending-mag' ),
		'description'       => esc_html__( 'Choose layout for your site single pages.', 'trending-mag' ),
		'choices'           => $trending_mag_layouts,
		'section'           => $trending_mag_section_id,
	)
);




trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'select',
		'name'              => trending_mag_customizer_fields_settings_id( $trending_mag_panel_name, $trending_mag_section_name, 'pre_footer' ),
		'default'           => trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, 'pre_footer' ),
		'sanitize_callback' => 'trending_mag_sanitize_select',
		'label'             => esc_html__( 'Pre Footer', 'trending-mag' ),
		'description'       => esc_html__( 'Choose layout for your site pre footer.', 'trending-mag' ),
		'choices'           => $trending_mag_layouts,
		'section'           => $trending_mag_section_id,
	)
);
