<?php
/**
 * Template file for the theme pre footer.
 *
 * @package trending-mag
 * @see inc/template-functions/pre-footer-functions.php
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


do_action( 'trending_mag_before_pre_footer' );

?>
<section class="rm-half-widget-area main-content-area-wrap">

	<div class="half-widget-area-inner ">

		<div class="rm-container">

			<div class="rm-row">

				<?php trending_mag_get_sidebar( 'left-sidebar', true ); ?>

				<div class="rm-col <?php trending_mag_get_sidebar_layout_class( 'trending_mag_prefooter_sidebar', true ); ?>">

					<?php do_action( 'trending_mag_prefooter' ); ?>

				</div><!-- // rm-col left -->

				<?php trending_mag_get_sidebar( 'right-sidebar', true ); ?>

			</div><!-- // rm-row -->
		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner layout-4 -->
</section><!-- // rm-full-widget-area main-content-area-wrap -->

<?php
do_action( 'trending_mag_after_pre_footer' );
