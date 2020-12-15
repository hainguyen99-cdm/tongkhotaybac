<?php
/**
 * Trending Mag Theme Customizer
 *
 * @package Trending_Mag
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'TRENDING_MAG_INC_CUSTOMIZER_PATH' ) ) {
	define( 'TRENDING_MAG_INC_CUSTOMIZER_PATH', trailingslashit( get_template_directory() ) . 'inc/customizer/' );
}

if ( ! defined( 'TRENDING_MAG_INC_CUSTOMIZER_PATH_URI' ) ) {
	define( 'TRENDING_MAG_INC_CUSTOMIZER_PATH_URI', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/' );
}

if ( ! defined( 'TRENDING_MAG_INC_CUSTOMIZER_ASSETS_PATH' ) ) {
	define( 'TRENDING_MAG_INC_CUSTOMIZER_ASSETS_PATH', TRENDING_MAG_INC_CUSTOMIZER_PATH . 'assets/' );
}

if ( ! defined( 'TRENDING_MAG_INC_CUSTOMIZER_ASSETS_PATH_URI' ) ) {
	define( 'TRENDING_MAG_INC_CUSTOMIZER_ASSETS_PATH_URI', TRENDING_MAG_INC_CUSTOMIZER_PATH_URI . 'assets/' );
}

if ( ! defined( 'TRENDING_MAG_INC_CUSTOMIZER_CONTROLS_PATH' ) ) {
	define( 'TRENDING_MAG_INC_CUSTOMIZER_CONTROLS_PATH', TRENDING_MAG_INC_CUSTOMIZER_PATH . 'controls/' );
}


/**
 * Function to register control and setting.
 */
function trending_mag_register_option( $wp_customize, $option ) {

	// Initialize Setting.
	$wp_customize->add_setting(
		$option['name'],
		array(
			'sanitize_callback' => $option['sanitize_callback'],
			'default'           => isset( $option['default'] ) ? $option['default'] : '',
			'transport'         => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
			'theme_supports'    => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
		)
	);

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['mime_type'] ) ) {
		$control['mime_type'] = $option['mime_type'];
	}

	if ( isset( $option['flex_width'] ) ) {
		$control['flex_width'] = $option['flex_width'];
	}

	if ( isset( $option['flex_height'] ) ) {
		$control['flex_height'] = $option['flex_height'];
	}

	if ( isset( $option['width'] ) ) {
		$control['width'] = $option['width'];
	}

	if ( isset( $option['height'] ) ) {
		$control['height'] = $option['height'];
	}

	if ( ! empty( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}


require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . '/customizer-helpers.php';
require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . '/defaults.php';
require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . '/upsell/load-upsell.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trending_mag_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . '/sanitize-callbacks.php';

	/**
	 * Load custom customizer control for toggle one control
	 */
	require_once TRENDING_MAG_INC_CUSTOMIZER_CONTROLS_PATH . 'toggle/toggle-one/class-toggle-one-control.php';

	/**
	 * Load custom customizer control for sortable one control
	 */
	require_once TRENDING_MAG_INC_CUSTOMIZER_CONTROLS_PATH . 'sortable/sortable-one/class-sortable-one-control.php';

	/**
	 * Load custom customizer control for select one control
	 */
	require_once TRENDING_MAG_INC_CUSTOMIZER_CONTROLS_PATH . 'select/slim-select/class-trending-mag-customizer-slim-select-control.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'trending_mag_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'trending_mag_customize_partial_blogdescription',
			)
		);
	}

	require_once get_template_directory() . '/inc/customizer/active-callbacks.php';

	/**
	 * Register custom panels, sections and fields.
	 */
	require_once get_template_directory() . '/inc/customizer/panels.php';

	$sections = array(
		'general-options',
		'front-page',
		'pre-footer',
	);

	if ( is_array( $sections ) && count( $sections ) > 0 ) {
		foreach ( $sections as $section ) {
			require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . "sections/{$section}.php";
		}
	}

	$fields = array(

		'wp-core',

		// General Options.
		'general-options/top-bar',
		'general-options/header',
		'general-options/sort-sections',
		'general-options/social-links',
		'general-options/sharer',
		'general-options/typography',
		'general-options/layouts',
		'general-options/pre-footer-options',
		'general-options/footer-options',

		// Front Page.
		'front-page/news-ticker',
		'front-page/banner-slider',
		'front-page/advertisement',
		'front-page/section-one',
		'front-page/section-two',
		'front-page/section-three',
		'front-page/section-four',
		'front-page/section-five',

		// Pre Footer.
		'pre-footer/section-one',
		'pre-footer/section-two',
		'pre-footer/section-three',
		'pre-footer/section-four',
		'pre-footer/section-five',
		'pre-footer/section-six',
	);

	if ( is_array( $fields ) && count( $fields ) > 0 ) {
		foreach ( $fields as $field ) {
			require_once TRENDING_MAG_INC_CUSTOMIZER_PATH . "fields/{$field}.php";
		}
	}

}
add_action( 'customize_register', 'trending_mag_customize_register', 10 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function trending_mag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function trending_mag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trending_mag_customize_preview_js() {
	wp_enqueue_script( 'trending-mag-customizer', get_template_directory_uri() . '/assets/src/js/libraries/customizer.js', array( 'customize-preview', 'jquery' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'trending_mag_customize_preview_js' );



/**
 * Rearrange our custom panel.
 *
 * - Site Identity
 * - General Options
 * - Colors
 * - Header Image
 * - Background Image
 * - Menus
 * - Widgets
 * - Homepage Settings
 * - Front Page
 * - Pre - Footer
 * - Additional CSS
 */
function trending_mag_rearrange_customizer( $wp_customize ) {
	$wp_customize->get_panel( trending_mag_get_customizer_panel_id( 'general_options' ) )->priority = 30;
}
add_action( 'customize_register', 'trending_mag_rearrange_customizer', 50 );



