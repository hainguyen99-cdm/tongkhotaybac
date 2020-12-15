<?php
/**
 * Loads the upsell button in customizer.
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
 * Loads upsell scripts when customizer loads.
 */
function trending_mag_load_upsell_scripts() {
	wp_enqueue_style( 'trending-mag-upsell', get_template_directory_uri() . '/inc/customizer/upsell/lib/upgrade.css', array(), '1.0.0', 'all' );
	wp_enqueue_script( 'trending-mag-upsell', get_template_directory_uri() . '/inc/customizer/upsell/lib/upgrade.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'trending_mag_load_upsell_scripts' );



/**
 * Load upsell.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trending_mag_load_upsell( $wp_customize ) {

	require_once get_template_directory() . '/inc/customizer/upsell/lib/class-trending-mag-customizer-upsell.php';

	if ( class_exists( 'Trending_Mag_Customizer_Upsell' ) ) {
		$wp_customize->register_section_type( 'Trending_Mag_Customizer_Upsell' );

		$wp_customize->add_section(
			new Trending_Mag_Customizer_Upsell(
				$wp_customize,
				'trending_mag_pro',
				array(
					'title'       => esc_html__( 'Trending Mag Pro', 'trending-mag' ),
					'button_text' => esc_html__( 'Buy Pro', 'trending-mag' ),
					'button_url'  => 'https://www.wishfulthemes.com/themes/trending-mag-pro/',
					'priority'    => 1,
				)
			)
		);
	}

}
add_action( 'customize_register', 'trending_mag_load_upsell' );
