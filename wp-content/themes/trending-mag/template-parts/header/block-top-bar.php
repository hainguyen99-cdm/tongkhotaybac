<?php
/**
 * Template part file for the header top bar.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$trending_mag_panel_name   = 'general_options';
$trending_mag_section_name = 'top_bar';

$enable_top_bar = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_top_bar' );

if ( ! $enable_top_bar ) {
	return;
}



do_action( 'trending_mag_before_top_bar' );

?>
<div class="header-top-block">
	<div class="rm-container header-top-block__container">
		<div class="header-top-block__container__row">

			<?php

			/**
			 * Hook - trending_mag_top_bar_contents
			 *
			 * @see trending_mag_top_bar_left_content - 15
			 * @see trending_mag_top_bar_menu - 20
			 * @see trending_mag_top_bar_social_links - 25
			 */
			do_action( 'trending_mag_top_bar_contents' );
			?>

		</div><!-- // rm-row  -->
	</div><!-- // rm-container  -->
</div><!-- //  header-top-block  -->
<?php
do_action( 'trending_mag_after_top_bar' );

