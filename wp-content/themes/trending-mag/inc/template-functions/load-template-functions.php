<?php
/**
 * This file loads all the files of template-functions folder.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_template_function_dir = get_template_directory() . '/inc/template-functions';

require_once "{$trending_mag_template_function_dir}/header/top-bar.php";
require_once "{$trending_mag_template_function_dir}/header/logo.php";
require_once "{$trending_mag_template_function_dir}/header/bottom-header.php";
require_once "{$trending_mag_template_function_dir}/header/sidebar-toggle.php";

require_once "{$trending_mag_template_function_dir}/frontpage-functions.php";

require_once "{$trending_mag_template_function_dir}/singular-functions.php";

if ( ! function_exists( 'trending_mag_hook_template_functions_to_wp_head' ) ) {

	/**
	 * Need to hook in wp_head due to priority issues.
	 */
	function trending_mag_hook_template_functions_to_wp_head() {
		$trending_mag_template_function_dir = get_template_directory() . '/inc/template-functions';
		require_once "{$trending_mag_template_function_dir}/pre-footer-functions.php";
	}
	add_action( 'wp_head', 'trending_mag_hook_template_functions_to_wp_head' );
}

