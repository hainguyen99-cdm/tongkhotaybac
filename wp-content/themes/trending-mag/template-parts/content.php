<?php
/**
 * Template part file for the blogs and archives pages.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$listing_layout = trending_mag_get_theme_mod( 'general_options', 'layouts', 'blogs_and_archives_listings' );

get_template_part( "template-parts/archives/{$listing_layout}" );
