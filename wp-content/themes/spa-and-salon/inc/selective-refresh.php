<?php
/**
 * Partial refresh functions.
 *
 * @package spa_and_salon
 *
 */

if ( ! function_exists( 'pranayama_yoga_pro_customize_partial_blogname' ) ) :

	function pranayama_yoga_pro_customize_partial_blogname() {
		return bloginfo( 'name' );
	}

endif;

if ( ! function_exists( 'pranayama_yoga_pro_customize_partial_blogdescription' ) ) :
	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	function pranayama_yoga_pro_customize_partial_blogdescription() {
		return bloginfo( 'description' );
	}
	
endif;

if ( ! function_exists( 'spa_and_salon_banner_read_more_selective_refresh' ) ) :
	/**
	 * Banner Read More
	 *
	 */
	function spa_and_salon_banner_read_more_selective_refresh() {
		$read_more_label = get_theme_mod( 'spa_and_salon_banner_read_more', esc_html__( 'Get Started', 'spa-and-salon' ) );

		if ( $read_more_label ) {
			return esc_html( $read_more_label );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_about_read_more_selective_refresh' ) ) :
	/**
	 * About Read More Label
	 *
	 */
	function spa_and_salon_about_read_more_selective_refresh() {
		$learn_more_label = get_theme_mod( 'spa_and_salon_about_read_more', esc_html__( 'Read More', 'spa-and-salon' ) );

		if ( $learn_more_label ) {
			return esc_html( $learn_more_label );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_service_post_title_selective_refresh' ) ) :
	/**
	 * Services Heading
	 *
	 */
	function spa_and_salon_service_post_title_selective_refresh() {
		$services_heading = get_theme_mod( 'spa_and_salon_service_post_title', esc_html__( 'Our Services', 'spa-and-salon' ) );

		if ( $services_heading ) {
			return esc_html( $services_heading );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_service_post_content_selective_refresh' ) ) :
	/**
	 * Services Description
	 *
	 */
	function spa_and_salon_service_post_content_selective_refresh() {
		$services_desc = get_theme_mod( 'spa_and_salon_service_post_content' );

		if ( $services_desc ) {
			return esc_html( $services_desc );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_testimonial_section_title_selective_refresh' ) ) :
	/**
	 * Testimonial Heading
	 *
	 */
	function spa_and_salon_testimonial_section_title_selective_refresh() {
		$testimonial_heading = get_theme_mod( 'spa_and_salon_testimonial_section_title', esc_html__( 'Client Testimonials', 'spa-and-salon' ) );

		if ( $testimonial_heading ) {
			return esc_html( $testimonial_heading );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_testimonial_section_content_selective_refresh' ) ) :
	/**
	 * Testimonial Content
	 *
	 */
	function spa_and_salon_testimonial_section_content_selective_refresh() {
		$testimonial_desc = get_theme_mod( 'spa_and_salon_testimonial_section_content' );

		if ( $testimonial_desc ) {
			return esc_html( $testimonial_desc );
		} else {
			return false;
		}
	}
endif;


if ( ! function_exists( 'spa_and_salon_social_info_selective_refresh' ) ) :
	/**
	 * Social Label
	 *
	 */
	function spa_and_salon_social_info_selective_refresh() {
		$social_label = get_theme_mod( 'spa_and_salon_social_info',esc_html__( 'Follow Us On', 'spa-and-salon' ) );

		if ( $social_label ) {
			return esc_html( $social_label );
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'spa_and_salon_ph_selective_refresh' ) ) :
	/**
	 * Header Phone Settings Label
	 *
	 */
	function spa_and_salon_ph_selective_refresh() {
		$phone_label = get_theme_mod( 'spa_and_salon_ph',esc_html__( '01-234566789', 'spa-and-salon' ));

		if ( $phone_label ) {
			return esc_html( $phone_label );
		} else {
			return false;
		}
	}
endif;






