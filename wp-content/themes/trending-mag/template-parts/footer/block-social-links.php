<?php
/**
 * Template part file for the footer social links.
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
$trending_mag_section_name = 'social_links';

if ( ! trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_social_links' ) ) {
	return;
}

?>
<div class="rm-social-media">
	<?php trending_mag_list_social_links(); ?>
</div><!-- // rm-social-media -->
