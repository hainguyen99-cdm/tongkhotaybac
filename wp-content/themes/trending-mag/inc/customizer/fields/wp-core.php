<?php
/**
 * This file sets the custom controls in the WordPress customizer core panel
 * and sections.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * ===================
 * Static Front Page
 * ===================
 */

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( 'static_front_page', 'static_front_page', 'display_static_content' ),
		'default'           => trending_mag_customizer_defaults( 'static_front_page', 'static_front_page', 'display_static_content' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Display Static Content?', 'trending-mag' ),
		'section'           => 'static_front_page',
		'priority'          => 10,
		'active_callback'   => function() {
			return 'page' === get_option( 'show_on_front' );
		},
	)
);

/**
 * ===================
 * Static Front Page
 * ===================
 */



/**
 * ===================
 * Site Identity
 * ===================
 */

trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( 'title_tagline', 'title_tagline', 'hide_site_title' ),
		'default'           => trending_mag_customizer_defaults( 'title_tagline', 'title_tagline', 'hide_site_title' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Hide Site Title?', 'trending-mag' ),
		'section'           => 'title_tagline',
		'priority'          => 10,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'trending-mag-flat',
		'custom_control'    => 'Trending_Mag_Toggle_One_Control',
		'name'              => trending_mag_customizer_fields_settings_id( 'title_tagline', 'title_tagline', 'hide_tagline' ),
		'default'           => trending_mag_customizer_defaults( 'title_tagline', 'title_tagline', 'hide_tagline' ),
		'sanitize_callback' => 'wp_validate_boolean',
		'label'             => esc_html__( 'Hide Tagline?', 'trending-mag' ),
		'section'           => 'title_tagline',
		'priority'          => 15,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'range',
		'name'              => trending_mag_customizer_fields_settings_id( 'title_tagline', 'title_tagline', 'line_height' ),
		'default'           => trending_mag_customizer_defaults( 'title_tagline', 'title_tagline', 'line_height' ),
		'sanitize_callback' => 'esc_html',
		'label'             => esc_html__( 'Line Height', 'trending-mag' ),
		'description'       => esc_html__( 'Space between your site title and tagline', 'trending-mag' ),
		'section'           => 'title_tagline',
		'input_attrs'       => array(
			'min'  => 0,
			'max'  => 10,
			'step' => 1,
		),
		'priority'          => 20,
	)
);



if ( trending_mag_is_ad_manager_active() ) {


	trending_mag_register_option(
		$wp_customize,
		array(
			'type'              => 'select',
			'name'              => trending_mag_customizer_fields_settings_id( 'title_tagline', 'title_tagline', 'header_ad' ),
			'default'           => trending_mag_customizer_defaults( 'title_tagline', 'title_tagline', 'header_ad' ),
			'sanitize_callback' => 'trending_mag_sanitize_select',
			'label'             => esc_html__( 'Header Ad', 'trending-mag' ),
			'choices'           => trending_mag_customizer_get_ads(),
			'section'           => 'title_tagline',
			'priority'          => 25,
		)
	);


}


/**
 * ===================
 * Site Identity
 * ===================
 */



/**
 * ===================
 * Colors Options
 * ===================
 */


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'color',
		'custom_control'    => 'WP_Customize_Color_Control',
		'name'              => trending_mag_customizer_fields_settings_id( 'colors', 'colors', 'primary_color' ),
		'default'           => trending_mag_customizer_defaults( 'colors', 'colors', 'primary_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'label'             => esc_html__( 'Primary Color', 'trending-mag' ),
		'section'           => 'colors',
		'priority'          => 15,
	)
);


trending_mag_register_option(
	$wp_customize,
	array(
		'type'              => 'color',
		'custom_control'    => 'WP_Customize_Color_Control',
		'name'              => trending_mag_customizer_fields_settings_id( 'colors', 'colors', 'secondary_color' ),
		'default'           => trending_mag_customizer_defaults( 'colors', 'colors', 'secondary_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
		'label'             => esc_html__( 'Secondary Color', 'trending-mag' ),
		'section'           => 'colors',
		'priority'          => 20,
	)
);

/**
 * ===================
 * Colors Options
 * ===================
 */
