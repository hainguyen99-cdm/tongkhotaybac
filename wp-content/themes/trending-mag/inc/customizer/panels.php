<?php
/**
 * Customizer file for creating customizer panels.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$trending_mag_panels = array(
	'general_options' => array(
		'panel_title' => __( 'General Options', 'trending-mag' ),
		'description' => __( 'This panel has the general options customization of theme general features.', 'trending-mag' ),
	),
	'front_page'      => array(
		'panel_title' => __( 'Front Page', 'trending-mag' ),
		'description' => __( 'This panel has all settings for customizing the static front page. To view the sections, please select Static Front Page option in Homepage Settings panel.', 'trending-mag' ),
	),
	'pre_footer'      => array(
		'panel_title' => __( 'Pre Footer', 'trending-mag' ),
		'description' => __( 'This panel has the settings for your site pre footer sections. By default it will be displayed in your homepage.', 'trending-mag' ),
	),
);

if ( is_array( $trending_mag_panels ) && count( $trending_mag_panels ) > 0 ) {
	$trending_mag_priority = 150;
	foreach ( $trending_mag_panels as $trending_mag_panels_id => $trending_mag_panels_args ) {
		$trending_mag_panel_title = ! empty( $trending_mag_panels_args['panel_title'] ) ? $trending_mag_panels_args['panel_title'] : '';
		$trending_mag_description = ! empty( $trending_mag_panels_args['description'] ) ? $trending_mag_panels_args['description'] : '';

		$wp_customize->add_panel(
			trending_mag_get_customizer_panel_id( $trending_mag_panels_id ),
			array(
				'title'       => $trending_mag_panel_title,
				'description' => $trending_mag_description,
				'priority'    => $trending_mag_priority,
			)
		);

		$trending_mag_priority = $trending_mag_priority + 10;
	}
}

