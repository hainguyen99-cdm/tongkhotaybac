<?php
/**
 * This file contains the functions hooked in the top bar.
 *
 * @see template-parts > header > block-top-bar.php
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_hook = 'trending_mag_top_bar_contents';

if ( ! function_exists( 'trending_mag_top_bar_left_content' ) ) {

	/**
	 * Prints the html for the top bar left content.
	 * COntent can be changed from customizer.
	 */
	function trending_mag_top_bar_left_content() {

		$trending_mag_panel_name   = 'general_options';
		$trending_mag_section_name = 'top_bar';

		$left_content = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'left_content' );

		if ( 'cta-btn' === $left_content ) {

			$cta_link  = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'cta_link' );
			$cta_label = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'cta_label' );

			?>
			<div class="header-top-block__container__row__col">
				<div class="call-to-action-wrapper">
					<a href="<?php echo esc_url( $cta_link ); ?>" class="button btn-call-to-action"><?php echo esc_html( $cta_label ); ?></a>
				</div>
			</div><!-- // rm-col left  -->
			<?php

		} elseif ( 'custom-text' === $left_content ) {

			$custom_text = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'custom_text' );

			?>
			<div class="header-top-block__container__row__col">
				<div class="custom-text-wrapper">
					<?php echo wp_kses_post( wpautop( $custom_text ) ); ?>
				</div>
			</div><!-- // rm-col left  -->
			<?php

		} else {

			$date_format = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'date_format' );
			$date_format = 'default' === $date_format ? get_option( 'date_format' ) : $date_format;

			?>
			<div class="header-top-block__container__row__col">
				<div class="current-date">
					<span><?php esc_html_e( 'Today', 'trending-mag' ); ?></span>
					<?php echo '<i>' . esc_html( gmdate( $date_format ) ) . '</i>'; ?>
				</div>
			</div><!-- // rm-col left  -->
			<?php

		}

	}
	add_action( $trending_mag_hook, 'trending_mag_top_bar_left_content', 15 );
}


if ( ! function_exists( 'trending_mag_top_bar_menu' ) ) {

	/**
	 * Top bar menu content.
	 */
	function trending_mag_top_bar_menu() {

		?>

		<div class="header-top-block__container__row__col header-top-block__container__row__col--nav">
			<div class="secondary-navigation">
				<?php
				wp_nav_menu(
					array(
						'menu_id'        => 'menu-top-menu',
						'fallback_cb'    => 'trending_mag_nav_menu_fallback',
						'theme_location' => 'top-bar',
					)
				);
				?>
			</div>
		</div><!-- // rm-col center  -->

		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_top_bar_menu', 20 );
}


if ( ! function_exists( 'trending_mag_top_bar_social_links' ) ) {

	/**
	 * Prints the html for the top bar social links.
	 */
	function trending_mag_top_bar_social_links() {

		$trending_mag_panel_name   = 'general_options';
		$trending_mag_section_name = 'social_links';

		if ( ! trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_social_links' ) ) {
			return;
		}

		?>
			<div class="header-top-block__container__row__col">
				<div class="social-icons">
					<?php trending_mag_list_social_links(); ?>
				</div>
			</div><!-- // rm-col right  -->
		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_top_bar_social_links', 25 );
}
