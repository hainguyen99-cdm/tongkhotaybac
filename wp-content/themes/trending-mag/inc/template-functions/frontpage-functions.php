<?php
/**
 * Hooks the frontpage functions and code blocks.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'trending_mag_frontpage_section_news_ticker' ) ) {

	/**
	 * News Ticker.
	 */
	function trending_mag_frontpage_section_news_ticker() {
		get_template_part( 'template-parts/front-page/news-ticker' );
	}
}

if ( ! function_exists( 'trending_mag_frontpage_section_banner_slider' ) ) {

	/**
	 * Banner Slider.
	 */
	function trending_mag_frontpage_section_banner_slider() {
		get_template_part( 'template-parts/front-page/master-banner' );
	}
}

if ( ! function_exists( 'trending_mag_frontpage_section_advertisement' ) ) {

	/**
	 * Section advertisement.
	 */
	function trending_mag_frontpage_section_advertisement() {
		get_template_part( 'template-parts/front-page/advertisement' );
	}
}

if ( ! function_exists( 'trending_mag_frontpage_section_one' ) ) {

	/**
	 * Section One.
	 */
	function trending_mag_frontpage_section_one() {
		get_template_part( 'template-parts/front-page/main-news' );
	}
}


if ( ! function_exists( 'trending_mag_frontpage_section_two' ) ) {

	/**
	 * Section two.
	 */
	function trending_mag_frontpage_section_two() {
		get_template_part( 'template-parts/front-page/business-news' );
	}
}



if ( ! function_exists( 'trending_mag_frontpage_section_three' ) ) {

	/**
	 * Section three.
	 */
	function trending_mag_frontpage_section_three() {
		get_template_part( 'template-parts/front-page/recent-news' );
	}
}



if ( ! function_exists( 'trending_mag_frontpage_section_four' ) ) {

	/**
	 * Section five.
	 */
	function trending_mag_frontpage_section_four() {
		get_template_part( 'template-parts/front-page/trending-news' );
	}
}



if ( ! function_exists( 'trending_mag_frontpage_section_five' ) ) {

	/**
	 * Section six.
	 */
	function trending_mag_frontpage_section_five() {
		get_template_part( 'template-parts/front-page/travel-tour' );
	}
}



if ( ! function_exists( 'trending_mag_frontpage_frontpage_content' ) ) {

	/**
	 * Section six.
	 */
	function trending_mag_frontpage_frontpage_content() {

		if ( ! trending_mag_get_theme_mod( 'static_front_page', 'static_front_page', 'display_static_content' ) ) {
			return;
		}

		if ( ! get_the_content() ) {
			return;
		}

		?>
		<section class="rm-full-widget-area main-content-area-wrap rm-static-page-content">
			<div class="static-page-content-inner">
				<div class="rm-container">

					<?php
					the_title(
						'<div class="widget-title"><h2 class="title">',
						'</h2></div>'
					);
					?>

					<div class="rm-row">
						<div class="col-12">
							<?php
							the_content();

							wp_link_pages();
							?>
						</div>
					</div>

				</div>
			</div>
		</section>
		<?php
	}
}



if ( ! function_exists( 'trending_mag_frontpage_sections' ) ) {

	/**
	 * Hooks the frontpage sections.
	 */
	function trending_mag_frontpage_sections() {

		$default  = trending_mag_frontpage_section_callbacks( true );
		$sections = trending_mag_get_theme_mod( 'general_options', 'sort_sections', 'sections' );

		$sorted_string = ! empty( $sections ) ? str_replace( ':0', '', $sections ) : '';
		$sorted_array  = ! empty( $sorted_string ) ? explode( ',', $sorted_string ) : $default;

		$sorted_array = apply_filters( 'trending_mag_frontpage_sorted_sections_array', $sorted_array );

		if ( ! empty( $sorted_array ) && is_array( $sorted_array ) ) {
			$priority = 5;
			foreach ( $sorted_array as $section_key ) {
				add_action( 'trending_mag_frontpage', $section_key, $priority );
				$priority = $priority + 5;
			}
		}

	}
	add_action( 'wp_head', 'trending_mag_frontpage_sections' );
}
