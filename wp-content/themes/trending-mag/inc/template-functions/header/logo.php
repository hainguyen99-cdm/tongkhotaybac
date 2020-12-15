<?php
/**
 * This file contains the functions hooked in header logo section.
 *
 * @see template-parts/header/block-logo.php
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_hook = 'trending_mag_header_logo_contents';

if ( ! function_exists( 'trending_mag_header_site_identity' ) ) {

	/**
	 * Prints the html for site identity and logo.
	 */
	function trending_mag_header_site_identity() {
		$panel   = 'title_tagline';
		$section = 'title_tagline';

		$site_title = ! trending_mag_get_theme_mod( $panel, $section, 'hide_site_title' ) ? get_bloginfo() : '';
		$tagline    = ! trending_mag_get_theme_mod( $panel, $section, 'hide_tagline' ) && get_bloginfo( 'description' ) ? sprintf( '<p class="site-description">%s</p>', esc_html( get_bloginfo( 'description' ) ) ) : '';
		$has_logo   = function_exists( 'has_custom_logo' ) && function_exists( 'the_custom_logo' ) && has_custom_logo();

		?>
		<div class="rm-col left">

			<?php
			if ( $has_logo ) {
				?>
				<div class="site-identity">
					<?php the_custom_logo(); ?>
				</div><!-- // site-identity -->
			<?php } ?>

			<?php if ( $site_title || $tagline ) { ?>
				<div class="site-branding-text" >
					<?php if ( $site_title ) { ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo esc_html( $site_title ); ?></a>
						</h1>
					<?php } ?>
					<?php echo wp_kses_post( $tagline ); ?>
				</div>
			<?php } ?>

		</div><!-- // rm-col left -->
		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_header_site_identity' );
}


if ( ! function_exists( 'trending_mag_header_ad' ) ) {

	/**
	 * Space for header ad.
	 */
	function trending_mag_header_ad() {

		$ad_id = trending_mag_get_theme_mod( 'title_tagline', 'title_tagline', 'header_ad' );

		trending_mag_print_ad(
			$ad_id,
			'<div class="rm-col right"><div class="rm-top-ad">',
			'</div><!-- // site-identity --></div><!-- // rm-col right -->'
		);
		?>
		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_header_ad', 15 );
}
