<?php
/**
 * This file contains the functions hooked in block-bottom-header.php
 *
 * @see template-parts/header/block-bottom-header.php
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_hook = 'trending_mag_bottom_header_contents';

if ( ! function_exists( 'trending_mag_bottom_header_primary_menu' ) ) {

	/**
	 * Hooks theme primary menu.
	 */
	function trending_mag_bottom_header_primary_menu() {

		$class = 'left';

		$enable_search_button  = trending_mag_get_theme_mod( 'general_options', 'header', 'enable_search_button' );
		$enable_header_widgets = is_active_sidebar( 'trending_mag_header_widgets_toggle' ) && trending_mag_get_theme_mod( 'general_options', 'header', 'enable_header_widgets' );

		if ( ! $enable_search_button && ! $enable_header_widgets ) {
			$class = '';
		}

		?>

		<div class="rm-col <?php echo esc_attr( $class ); ?>">

			<div class="primary-navigation-wrap">

				<button class="menu-toggle">
					<span class="hamburger-bar"></span>
					<span class="hamburger-bar"></span>
					<span class="hamburger-bar"></span>
				</button><!-- .menu-toggle -->

				<?php
				wp_nav_menu(
					array(
						'container'       => 'nav',
						'container_id'    => 'site-navigation',
						'container_class' => 'site-navigation',
						'fallback_cb'     => 'trending_mag_nav_menu_fallback',
						'theme_location'  => 'primary-menu',
					)
				);
				?>

			</div><!-- // primary-navigation-wrap -->

		</div><!-- // rm-col -->

		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_bottom_header_primary_menu' );
}


if ( ! function_exists( 'trending_mag_bottom_header_right_toggles' ) ) {

	/**
	 * Hooks the search and sidebar toggle buttons.
	 */
	function trending_mag_bottom_header_right_toggles() {

		$enable_search_button  = trending_mag_get_theme_mod( 'general_options', 'header', 'enable_search_button' );
		$enable_header_widgets = is_active_sidebar( 'trending_mag_header_widgets_toggle' ) && trending_mag_get_theme_mod( 'general_options', 'header', 'enable_header_widgets' );

		if ( ! $enable_search_button && ! $enable_header_widgets ) {
			return;
		}

		?>
		<div class="rm-col right">

			<?php if ( $enable_search_button ) { ?>
				<button class="search-trigger">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			<?php } ?>

			<?php if ( $enable_header_widgets ) { ?>
				<button class="canvas-trigger"><i class="fa fa-bars" aria-hidden="true"></i></button>
			<?php } ?>

		</div><!-- // rm-col -->
		<?php
	}
	add_action( $trending_mag_hook, 'trending_mag_bottom_header_right_toggles', 15 );
}
