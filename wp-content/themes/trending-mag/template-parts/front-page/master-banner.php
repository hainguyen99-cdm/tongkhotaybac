<?php
/**
 * Template part for the frontpage main banner slider.
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
$trending_mag_section_name = 'banner_slider';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$slider_layout = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'slider_layout' );
get_template_part( 'template-parts/front-page/layouts/master-banner', $slider_layout );
