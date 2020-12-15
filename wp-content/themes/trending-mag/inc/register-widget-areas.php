<?php
/**
 * Register our theme widget areas.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'trending_mag_register_widget_areas' ) ) {

	/**
	 * Register the required sidebar or widget areas.
	 */
	function trending_mag_register_widget_areas() {

		/**
		 * Main sidebar.
		 */
		register_sidebar(
			array(
				'id'            => 'trending_mag_main_sidebar',
				'name'          => esc_html__( 'Main Sidebar', 'trending-mag' ),
				'description'   => esc_html__( 'Widget area for theme main sidebar. It is located at pages, posts, blogs and archives.', 'trending-mag' ),
				'before_widget' => '<div id="%1$s" class="secondary-widget-area-content layout1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h2 class="title">',
				'after_title'   => '</h2></div>',
			)
		);

		/**
		 * Pre Footer sidebar.
		 */
		register_sidebar(
			array(
				'id'            => 'trending_mag_prefooter_sidebar',
				'name'          => esc_html__( 'Pre Footer Sidebar', 'trending-mag' ),
				'description'   => esc_html__( 'Widget area for theme pre footer.', 'trending-mag' ),
				'before_widget' => '<div id="%1$s" class="secondary-widget-area-content %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title widget-title-d2"><h2 class="title">',
				'after_title'   => '</h2></div>',
			)
		);

		/**
		 * Header toggle sidebar.
		 */
		register_sidebar(
			array(
				'id'            => 'trending_mag_header_widgets_toggle',
				'name'          => esc_html__( 'Header Widgets Toggle', 'trending-mag' ),
				'description'   => esc_html__( 'Widget area for theme header toggle panel.', 'trending-mag' ),
				'before_widget' => '<div id="%1$s" class="secondary-widget-area-content %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title widget-title-d2"><h2 class="title">',
				'after_title'   => '</h2></div>',
			)
		);

		register_sidebars(
			3,
			array(
				'id'            => 'trending-mag-footer-widgets',
				'name'          => esc_html__( 'Footer Widgets', 'trending-mag' ) . esc_html( ' %d' ),
				'before_widget' => '<div id="%1$s" class="rm-footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h2 class="title">',
				'after_title'   => '</h2></div>',
			)
		);

	}
	add_action( 'widgets_init', 'trending_mag_register_widget_areas' );
}
