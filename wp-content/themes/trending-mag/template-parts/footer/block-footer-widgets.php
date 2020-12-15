<?php
/**
 * Template part file for the footer.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! trending_mag_get_theme_mod( 'general_options', 'footer_options', 'display_footer_widgets' ) ) {
	return;
}

$footer_widgets = array(
	'trending-mag-footer-widgets',
	'trending-mag-footer-widgets-2',
	'trending-mag-footer-widgets-3',
);

?>
<div class="rm-row">

	<?php
	foreach ( $footer_widgets as $footer_widget_id ) {

		if ( is_active_sidebar( $footer_widget_id ) ) {
			?>
			<div class="rm-col">
				<?php dynamic_sidebar( $footer_widget_id ); ?>
			</div><!-- //  rm-col left-->
			<?php
		}
	}
	?>

</div><!-- //  rm-row-->
