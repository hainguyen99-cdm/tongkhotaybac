<?php
/**
 * Section part file for the ad manager plugin support.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trending_mag_is_ad_manager_active() ) {
	return;
}


$ad_id = trending_mag_get_theme_mod( 'front_page', 'advertisement', 'advertisement' );

$before = '
<section class="rm-top-widget-area primary-widget-area">
	<div class="widget-area-inner">
		<div class="rm-container">
			<div class="widget-area-entry">
				<div class="widget text_widget">';
$after  = '
				</div><!-- // widget text_widget -->
			</div><!-- // widget-area-entry -->
		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner -->
</section><!-- // rm-top-widget-area -->
';

trending_mag_print_ad(
	$ad_id,
	$before,
	$after
);
