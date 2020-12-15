<?php
/**
 * This is a template file for the theme sidebar which will be used by archives and singular.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'trending_mag_main_sidebar' ) ) {
	return;
}

?>
<div class="rm-col right sticky-portion">
	<aside id="secondary" class="secondary-widget-area">
		<?php dynamic_sidebar( 'trending_mag_main_sidebar' ); ?>
	</aside><!-- // secondary-widget-area -->
</div><!-- // rm-col right -->
