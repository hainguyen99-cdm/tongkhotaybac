<?php
/**
 * This file contains the functions hooked in block-sidebar-toggle.php
 *
 * @see template-parts/header/block-sidebar-toggle.php
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'trending_mag_sidebar_toggle_search_overlay' ) ) {

	/**
	 * Hooks the search form that will be triggered from bottom header search button.
	 */
	function trending_mag_sidebar_toggle_search_overlay() {
		?>
		<div class="search-overlay-holder">
			<div class="rm-container">
				<div class="search-wrapper">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
						<input type="search" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e( 'Enter Keyword', 'trending-mag' ); ?>">
						<input type="submit" id="submit" value="Search">
					</form>
					<a href="#" class="form-close">
						<svg width="20" height="20" class="close-search-overlay">
							<line y2="100%" x2="0" y1="0" x1="100%" stroke-width="1.1" stroke="#000"></line>
							<line y2="100%" x2="100%" y1="0%" x1="0%" stroke-width="1.1" stroke="#000"></line>
						</svg>
					</a>
				</div>
			</div><!-- // rm-container -->
		</div><!-- // search-overlay-holder -->
		<?php
	}
	add_action( 'trending_mag_before_sidebar_toggle', 'trending_mag_sidebar_toggle_search_overlay' );
}
