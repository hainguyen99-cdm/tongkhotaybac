<?php
/**
 * Trending Mag main functions and definitions
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'trending_mag_get_sidebar_layouts' ) ) {

	/**
	 * Returns the array of sidebar layouts.
	 *
	 * @return array
	 */
	function trending_mag_get_sidebar_layouts() {

		$layout = array(
			'no-sidebar'    => esc_html__( 'No Sidebar', 'trending-mag' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'trending-mag' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'trending-mag' ),
		);

		return $layout;
	}
}


if ( ! function_exists( 'trending_mag_post_filter_the_date' ) ) {

	/**
	 * Filters the date function for queries.
	 *
	 * @param string $the_date The formatted date string.
	 * @param string $format   PHP date format. Defaults to 'date_format' option
	 *                         if not specified.
	 * @param string $before   HTML output before the date.
	 * @param string $after    HTML output after the date.
	 */
	function trending_mag_post_filter_the_date( $the_date, $format, $before, $after ) {

		if ( is_single() ) {
			return $the_date;
		}

		$the_date = $before . get_the_date( $format ) . $after;
		return $the_date;

	}
	add_filter( 'the_date', 'trending_mag_post_filter_the_date', 12, 4 );
}


if ( ! function_exists( 'trending_mag_get_image_size' ) ) {

	/**
	 * Returns the image size array.
	 */
	function trending_mag_get_image_size( $type ) {
		$sizes = array(
			'banner_slider'        => array( 700, 525 ),
			'trending_posts'       => array( 100, 25 ),
			'travel_tour'          => array( 700, 525 ),
			'travel_tour_wide'     => array( 800, 450 ),
			'business_news'        => array( 120, 90 ),
			'business_news_wide'   => array( 700, 525 ),
			'recent_news'          => array( 120, 90 ),
			'recent_news_wide'     => array( 700, 525 ),
			'trending_news_slider' => array( 1140, 640 ),
		);

		return isset( $sizes[ $type ] ) ? $sizes[ $type ] : '';
	}
}


if ( ! function_exists( 'trending_mag_get_sidebar_layout_class' ) ) {

	/**
	 * Returns the class string for the theme page or post layout.
	 */
	function trending_mag_get_sidebar_layout_class( $sidebar_id = 'trending_mag_main_sidebar', $is_prefooter = false, $echo = true ) {

		$class = 'full-width';

		if ( ! is_active_sidebar( $sidebar_id ) ) {

			if ( ! $echo ) {
				return $class;
			}

			echo esc_attr( $class );

			return;
		}

		$trending_mag_panel_name   = 'general_options';
		$trending_mag_section_name = 'layouts';
		$layout_for                = 'pre_footer';

		if ( ! $is_prefooter ) {
			if ( is_archive() || is_home() ) {
				$layout_for = 'blogs_and_archives';
			} elseif ( is_single() ) {
				$layout_for = 'single_posts';
			} elseif ( is_page() ) {
				$layout_for = 'single_pages';
			}
		}

		$layout = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, $layout_for );

		if ( 'no-sidebar' !== $layout ) {
			$class = 'left';
		}

		if ( ! $echo ) {
			return $class;
		}

		echo esc_attr( $class );
	}
}



if ( ! function_exists( 'trending_mag_get_sidebar' ) ) {

	/**
	 * Returns the theme sidebar except for the header toggle sidebar.
	 *
	 * @param string $position Sidebar position in template. Accepts left-sidebar || right-sidebar.
	 */
	function trending_mag_get_sidebar( $position, $is_prefooter = false ) {

		$trending_mag_panel_name   = 'general_options';
		$trending_mag_section_name = 'layouts';
		$layout_for                = 'pre_footer';

		if ( ! $is_prefooter ) {
			if ( is_archive() || is_home() ) {
				$layout_for = 'blogs_and_archives';
			} elseif ( is_single() ) {
				$layout_for = 'single_posts';
			} elseif ( is_page() ) {
				$layout_for = 'single_pages';
			}
		}

		$is_position_valid = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, $layout_for ) === $position;

		if ( $is_prefooter && $is_position_valid ) {
			get_template_part( 'template-parts/sidebar/sidebar', 'prefooter' );
			return;
		}
		return $is_position_valid ? get_sidebar() : '';

	}
}


if ( ! function_exists( 'trending_mag_frontpage_section_callbacks' ) ) {

	/**
	 * Returns the array list of frontpage sections callbacks.
	 *
	 * @param bool $keys Whether to return array keys or not.
	 */
	function trending_mag_frontpage_section_callbacks( $keys = false ) {
		$callbacks = apply_filters(
			'trending_mag_frontpage_section_callbacks',
			array(
				'trending_mag_frontpage_section_news_ticker' => __( 'News Ticker', 'trending-mag' ),
				'trending_mag_frontpage_section_banner_slider' => __( 'Banner Slider', 'trending-mag' ),
				'trending_mag_frontpage_section_advertisement' => __( 'Advertisement', 'trending-mag' ),
				'trending_mag_frontpage_section_one'       => __( 'Section One', 'trending-mag' ),
				'trending_mag_frontpage_section_two'       => __( 'Section Two', 'trending-mag' ),
				'trending_mag_frontpage_section_three'     => __( 'Section Three', 'trending-mag' ),
				'trending_mag_frontpage_section_four'      => __( 'Section Four', 'trending-mag' ),
				'trending_mag_frontpage_section_five'      => __( 'Section Five', 'trending-mag' ),
				'trending_mag_frontpage_frontpage_content' => __( 'Frontpage Static Content', 'trending-mag' ),
			)
		);

		if ( ! trending_mag_is_ad_manager_active() ) {
			if ( isset( $callbacks['trending_mag_frontpage_section_advertisement'] ) ) {
				unset( $callbacks['trending_mag_frontpage_section_advertisement'] );
			}
		}

		return $keys ? array_keys( $callbacks ) : $callbacks;
	}
}


if ( ! function_exists( 'trending_mag_the_excerpt' ) ) {

	/**
	 * Prints the excerpt with modified length, if provided.
	 */
	function trending_mag_the_excerpt( $length = false, $echo = true, $post = null ) {
		$excerpt = get_the_excerpt( $post );

		if ( $length ) {

			$excerpt_more = trending_mag_get_theme_mod( 'general_options', 'typography', 'excerpt_more' );

			if ( 'default' === $excerpt_more || ! $excerpt_more ) {
				$more = ' [...]';
			}

			if ( 'dots' === $excerpt_more ) {
				$more = '...';
			}

			if ( 'link' === $excerpt_more ) {
				$more = ' <a class="read-more-link" href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( '<< Read More >>', 'trending-mag' ) . '</a>';
			}

			$excerpt = wp_trim_words( $excerpt, $length, $more );
		}

		if ( ! $echo ) {
			return $excerpt;
		}

		echo wp_kses_post( wpautop( $excerpt ) );
	}
}


if ( ! function_exists( 'trending_mag_get_social_links' ) ) {

	/**
	 * Returns the array of social links.
	 */
	function trending_mag_get_social_links() {
		return apply_filters(
			'trending_mag_social_links',
			array(
				'facebook',
				'twitter',
				'instagram',
				'linkedin',
			)
		);
	}
}



if ( ! function_exists( 'trending_mag_get_fonts' ) ) :
	/**
	 * Function to load choices of google font family.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function trending_mag_get_fonts() {

		$fonts = array(
			'Cormorant+Garamond:400,400i,500,500i,600,600i,700,700i&display=swap' => esc_html( 'Cormorant Garamond' ),
			'Caveat:400,700'                          => esc_html( 'Caveat' ),
			'Dancing+Script:400,700'                  => esc_html( 'Dancing Script' ),
			'Heebo:400,500,700,800'                   => esc_html( 'Heebo' ),
			'Kelly+Slab'                              => esc_html( 'Kelly Slab' ),
			'Lato:400,400i,700,700i'                  => esc_html( 'Lato' ),
			'Roboto:300,400,500,700,900&display=swap' => esc_html( 'Roboto' ),
			'Geo:400,400i|Great+Vibes|Lato:300,400,700&display=swap' => esc_html( 'Geo' ),
			'Poppins:300,400,500,600,700,800,900&display=swap' => esc_html( 'Poppins' ),
			'Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i' => esc_html( 'Montserrat' ),
			'Nunito+Sans:400,400i,600,600i,700,700i'  => esc_html( 'Nunito Sans' ),
			'Open+Sans:400,400i,600,600i,700,700i,800,800i' => esc_html( 'Open Sans' ),
			'Oswald:400,500,600,700'                  => esc_html( 'Oswald' ),
			'Pacifico'                                => esc_html( 'Pacifico' ),
			'Playfair+Display:400,400i,700,700i'      => esc_html( 'Playfair Display' ),
			'Ubuntu:400,400i,500,500i,700,700i'       => esc_html( 'Ubuntu' ),
		);

		return apply_filters( 'trending_mag_fonts', $fonts );

	}
endif;


/**
 * Set excerpt length according to the customizer value.
 */
function trending_mag_custom_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	$custom_length = trending_mag_get_theme_mod( 'general_options', 'typography', 'excerpt_length' );

	return $custom_length ? intval( $custom_length ) : $length;
}
add_filter( 'excerpt_length', 'trending_mag_custom_excerpt_length', 999 );



if ( ! function_exists( 'trending_mag_nav_menu_fallback' ) ) {
	/**
	 * Fallback for wp_nav_menu
	 *
	 * @since 1.0.0
	 */
	function trending_mag_nav_menu_fallback() {
		?>
		<ul class="menu">
			<?php
			if ( current_user_can( 'edit_theme_options' ) ) {
				?>
				<li class="menu-item"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Add Menu', 'trending-mag' ); ?></a></li>
				<?php
			}
			?>
		</ul>
		<?php
	}
}


if ( ! function_exists( 'trending_mag_is_ad_enable' ) ) {

	/**
	 * Checks whether or not we can use ad manager plugin.
	 *
	 * @return bool
	 */
	function trending_mag_is_ad_manager_active() {
		return function_exists( 'wishful_ad_manager' );
	}
}


require_once get_template_directory() . '/inc/includes.php';
