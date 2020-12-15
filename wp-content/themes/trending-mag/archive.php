<?php
/**
 * Template file for rendering post archives.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


get_header();

get_template_part( 'template-parts/posts-listings' );

get_footer();

