<?php
/**
 * Main template file for this theme.
 * It handles the frontpage and homepage and can also works as
 * the fallback for other templates.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'page' === get_option( 'show_on_front' ) ) {
	get_header();

	do_action( 'trending_mag_frontpage' );

	get_footer();

} else {
	get_template_part( 'index' );
}
