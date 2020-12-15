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

$on_front = get_option( 'show_on_front' );

if ( 'page' === $on_front && is_front_page() ) {
	get_template_part( 'front-page' );
} elseif ( is_home() || is_archive() ) {
	get_template_part( 'archive' );
} elseif ( is_singular() ) {
	get_template_part( 'singular' );
} elseif ( is_search() ) {
	get_template_part( 'search' );
} else {
	get_template_part( '404' );
}
