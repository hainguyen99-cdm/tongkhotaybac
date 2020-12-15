<?php
/**
 * Handles the breadcrumb functions.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'trending_mag_get_breadcrumb' ) ) {

	/**
	 * Prints the breadcrumb html.
	 */
	function trending_mag_get_breadcrumb() {
		?>
		<div class="rm-container">
			<div class="rm-breadcrumb">
				<?php trending_mag_breadcrumbs_trail(); ?>
			</div>
		</div>
		<?php
	}
}


if ( ! function_exists( 'trending_mag_breadcrumbs_trail' ) ) {

	/**
	 * Shows a breadcrumb for all types of pages.
	 */
	function trending_mag_breadcrumbs_trail() {

		// Return if is static front page.
		if ( is_front_page() ) {
			return;
		}

		// Yoast breadcrumbs.
		if ( function_exists( 'yoast_breadcrumb' )
		&& true === WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {
			return yoast_breadcrumb();
		}

		// SEOPress breadcrumbs.
		if ( function_exists( 'seopress_display_breadcrumbs' ) ) {
			return seopress_display_breadcrumbs();
		}

		// Rank Math breadcrumbs.
		if ( function_exists( 'rank_math_the_breadcrumbs' ) && RankMath\Helper::get_settings( 'general.breadcrumbs' ) ) {
			return rank_math_the_breadcrumbs();
		}

		if ( ! class_exists( 'Trending_Mag_Breadcrumb_Trail' ) ) {
			require_once get_template_directory() . '/inc/classes/class-trending-mag-breadcrumb-trail.php';
		}

		$breadcrumb = new Trending_Mag_Breadcrumb_Trail(
			array(
				'show_browse' => false,
			)
		);
		return $breadcrumb->trail();
	}
}
