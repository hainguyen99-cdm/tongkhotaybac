<?php
/**
 * Template part file for the footer bottom section.
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
$trending_mag_section_name = 'footer_options';
$footer_logo               = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'footer_logo' );

?>
<div class="rm-about-widget">
	<?php
	if ( $footer_logo ) {
		?>
		<div class="site-identity-foot">
			<figure><?php echo wp_get_attachment_image( $footer_logo, false ); // phpcs:ignore ?></figure>
		</div><!-- // site-identity -->
		<?php
	}

	$bio = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'bio' );
	if ( $bio ) {
		echo wp_kses_post( "<p class='rm-abt-content'>{$bio}</p>" );
	}

	?>

</div><!-- // rm-about-widget -->
