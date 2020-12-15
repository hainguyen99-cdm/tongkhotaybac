<?php
/**
 * Template part file for header primary menu section.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


do_action( 'trending_mag_before_bottom_header' );
?>
<div class="bottom-header">

	<div class="rm-container">

		<div class="rm-row">

			<?php

			/**
			 * Hook - trending_mag_bottom_header_contents
			 *
			 * @see trending_mag_bottom_header_primary_menu - 10
			 * @see trending_mag_bottom_header_right_toggles - 15
			 */
			do_action( 'trending_mag_bottom_header_contents' );
			?>

		</div><!-- // rm-row -->

	</div><!-- // rm-container -->

</div><!-- // bottom-header -->
<?php
do_action( 'trending_mag_after_bottom_header' );
