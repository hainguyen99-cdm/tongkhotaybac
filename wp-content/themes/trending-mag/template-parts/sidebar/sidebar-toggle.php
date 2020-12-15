<?php
/**
 * This is a template part file for the header toggle sidebar.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'trending_mag_header_widgets_toggle' ) ) {
	return;
}

?>
<div class="site-overlay"></div>
<aside class="canvas-sidebar secondary-widget-area">
	<div class="canvas-inner">
		<div class="canvas-header">
			<button class="close-canvas"><i class="feather icon-x"></i></button>
		</div>
		<!--// canvas-header -->
		<div class="canvas-entry">
			<?php dynamic_sidebar( 'trending_mag_header_widgets_toggle' ); ?>
		</div><!-- // canvas-entry -->
	</div><!-- // canvas-inner -->
</aside><!-- // canvas-sidebar -->
<?php
