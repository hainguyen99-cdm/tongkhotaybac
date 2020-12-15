<?php
/**
 * This file handles the default values for customizer.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'trending_mag_customizer_defaults' ) ) {


	/**
	 * Returns the customizer defaults.
	 *
	 * @param string $trending_mag_panel_name Customizer panel name.
	 * @param string $trending_mag_section_name Section name.
	 * @param string $field_name Field name.
	 * @return mixed Customizer default values.
	 */
	function trending_mag_customizer_defaults( $trending_mag_panel_name, $trending_mag_section_name, $field_name ) {
		$trending_mag_panel_name   = trending_mag_format_string_id_ready( $trending_mag_panel_name );
		$trending_mag_section_name = trending_mag_format_string_id_ready( $trending_mag_section_name );
		$field_name                = trending_mag_format_string_id_ready( $field_name );

		$defaults = array(
			'title_tagline'   => array(
				'title_tagline' => array(
					'line_height' => 2,
					'header_ad'   => 0,
				),
			),
			'colors'          => array(
				'colors' => array(
					'primary_color'   => '#EA2027',
					'secondary_color' => '#F79F1F',
				),
			),
			'general_options' => array(
				'top_bar'            => array(
					'enable_top_bar' => true,
					'left_content'   => 'date',
					'date_format'    => 'default',
					'cta_label'      => esc_html__( 'Subscribe', 'trending-mag' ),
				),
				'layouts'            => array(
					'blogs_and_archives_listings' => 'layout-one',
					'blogs_and_archives'          => 'right-sidebar',
					'single_posts'                => 'right-sidebar',
					'single_pages'                => 'right-sidebar',
					'pre_footer'                  => 'right-sidebar',
				),
				'social_links'       => array(
					'enable_social_links' => false,
				),
				'typography'         => array(
					'heading_font'   => 'Roboto:300,400,500,700,900&display=swap',
					'content_font'   => 'Lato:400,400i,700,700i',
					'excerpt_length' => 55,
				),
				'pre_footer_options' => array(
					'enable_pre_footer'     => true,
					'pre_footer_visibility' => 'frontpage',
				),
				'footer_options'     => array(
					'display_footer_widgets' => true,
					'display_site_identity'  => true,
				),
			),
			'front_page'      => array(
				'news_ticker'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Trending Posts', 'trending-mag' ),
				),
				'banner_slider' => array(
					'enable_section' => true,
					'slider_layout'  => 'layout-one',
				),
				'advertisement' => array(
					'advertisement' => 0,
				),
				'section_one'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Main News', 'trending-mag' ),
				),
				'section_two'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Business News', 'trending-mag' ),
					'excerpt_length' => 55,
				),
				'section_three' => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Recent News', 'trending-mag' ),
				),
				'section_four'  => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Trending News', 'trending-mag' ),
				),
				'section_five'  => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Travel & Tour', 'trending-mag' ),
					'excerpt_length' => 55,
				),
			),

			'pre_footer'      => array(
				'section_one'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Popular Posts', 'trending-mag' ),
				),
				'section_two'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Most Viewed', 'trending-mag' ),
				),
				'section_three' => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Latest Posts', 'trending-mag' ),
				),
				'section_four'  => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Entertainment Posts', 'trending-mag' ),
				),
				'section_five'  => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Politics Posts', 'trending-mag' ),
				),
				'section_six'   => array(
					'enable_section' => true,
					'heading'        => esc_html__( 'Foreign News', 'trending-mag' ),
				),
			),
		);

		return isset( $defaults[ $trending_mag_panel_name ][ $trending_mag_section_name ][ $field_name ] ) ? $defaults[ $trending_mag_panel_name ][ $trending_mag_section_name ][ $field_name ] : '';

	}
}
