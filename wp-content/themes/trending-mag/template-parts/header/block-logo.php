<?php
/**
 * This is a template-part file for the theme header logo.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$header_image = get_header_image();

do_action( 'trending_mag_before_header_logo' );
?>
<div class="rm-logo-block"  style="background-image:url(<?php echo esc_url( $header_image ); ?>); background-size: cover;">
	<div class="rm-container">
		<div class="rm-row">
			<?php

			/**
			 * Hook - trending_mag_header_logo_contents
			 *
			 * @see trending_mag_header_site_identity - 10
			 * @see trending_mag_header_ad - 15
			 */
			do_action( 'trending_mag_header_logo_contents' );
			?>

		</div><!-- // rm-row -->
	</div><!-- // rm-container -->
</div><!-- // rm-logo-block -->
<?php
do_action( 'trending_mag_after_header_logo' );
