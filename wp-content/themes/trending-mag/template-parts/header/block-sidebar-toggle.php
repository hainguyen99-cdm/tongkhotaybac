<?php
/**
 * Template part file for header sidebar toggle section.
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
 * Hook - trending_mag_before_sidebar_toggle
 *
 * @see trending_mag_sidebar_toggle_search_overlay - 10
 */
do_action( 'trending_mag_before_sidebar_toggle' );

get_template_part( 'template-parts/sidebar/sidebar', 'toggle' );

do_action( 'trending_mag_after_sidebar_toggle' );
