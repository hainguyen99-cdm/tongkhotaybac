<?php
/**
 * This file has the helper functions for the template files.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'trending_mag_list_social_links' ) ) {

	/**
	 * Prints the social link lists.
	 */
	function trending_mag_list_social_links() {

		$trending_mag_panel_name   = 'general_options';
		$trending_mag_section_name = 'social_links';

		if ( ! trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_social_links' ) ) {
			return;
		}

		$social_links = trending_mag_get_social_links();

		if ( ! empty( $social_links ) && is_array( $social_links ) ) { ?>
		<ul>
			<?php
			foreach ( $social_links as $social_link ) {
				$user_social_link = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, $social_link );
				if ( ! empty( $user_social_link ) ) {
					?>
					<li>
						<a href="<?php echo esc_url( $user_social_link ); ?>">
							<i class="fa fa-<?php echo esc_attr( $social_link ); ?>" aria-hidden="true"></i>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
			<?php
		}
	}
}

if ( ! function_exists( 'trending_mag_the_post_navigation' ) ) {

	/**
	 * Prints the custom version of the_post_navigation.
	 */
	function trending_mag_the_post_navigation() {

		if ( ! is_singular() ) {
			return;
		}

		?>
		<div class="post-navigation">
			<div class="nav-links">

				<?php if ( get_previous_post_link() ) { ?>
					<div class="nav-previous">
						<span><?php esc_html_e( 'Prev post', 'trending-mag' ); ?></span>
						<?php previous_post_link( '%link' ); ?>
					</div>
				<?php } ?>

				<?php if ( get_next_post_link() ) { ?>
					<div class="nav-next">
						<span><?php esc_html_e( 'Next post', 'trending-mag' ); ?></span>
						<?php next_post_link( '%link' ); ?>
					</div>
				<?php } ?>

			</div>
		</div><!-- // post-navigation -->
		<?php
	}
}


if ( ! function_exists( 'trending_mag_list_post_categories' ) ) {

	/**
	 * Prints the category listing html.
	 */
	function trending_mag_list_post_categories() {
		if ( is_front_page() || is_archive() || is_single() || is_home() ) {
			?>
			<div class="entry-cats">
				<ul>
					<?php the_category(); ?>
				</ul>
			</div><!-- // entry-cats -->
			<?php
		}
	}
}

if ( ! function_exists( 'trending_mag_frontpage_section_heading' ) ) {

	/**
	 * Prints html for the sections heading title.
	 *
	 * @param string $heading Section heading.
	 */
	function trending_mag_frontpage_section_heading( $heading ) {
		if ( ! $heading ) {
			return;
		}
		?>
		<div class="widget-title">
			<h2 class="title"><?php echo esc_html( $heading ); ?></h2>
		</div>
		<?php
	}
}

if ( ! function_exists( 'trending_mag_post_meta_data' ) ) {

	/**
	 * Prints the html for post meta data that has comments and post dates.
	 */
	function trending_mag_post_meta_data() {

		$comment_count = get_comments_number();

		$date_before = ! is_single() ? '<li class="posted-time"><span><a href="' . esc_url( get_the_permalink() ) . '">' : '<li class="posted-time"><span>';
		$date_after  = ! is_single() ? '</a></span></li>' : '</span></li>';
		?>
		<div class="entry-metas">
			<ul>
				<?php
				the_date( '', $date_before, $date_after );

				echo $comment_count ? wp_kses_post( '<li class="posted-comment"> <span>' . $comment_count . '</span></li>' ) : '';
				?>
			</ul>
		</div><!-- // entry-metas -->
		<?php
	}
}


if ( ! function_exists( 'trending_mag_print_ad' ) ) {

	/**
	 * Prints the ad.
	 *
	 * @param int    $ad_id Advertiesment ID.
	 * @param string $before Html before ad content.
	 * @param string $after Html after ad content.
	 */
	function trending_mag_print_ad( $ad_id, $before = '', $after = '' ) {
		if ( ! trending_mag_is_ad_manager_active() || ! function_exists( 'wishful_ad_manager_print_ad' ) ) {
			return;
		}
		wishful_ad_manager_print_ad( $ad_id, $before, $after );
	}
}




if ( ! function_exists( 'trending_mag_get_post_author_box' ) ) {

	/**
	 * Prints the html for the post author details.
	 */
	function trending_mag_get_post_author_box() {

		if ( ! is_single() ) {
			return;
		}

		$author_id    = get_the_author_meta( 'ID' );
		$display_name = get_the_author_meta( 'display_name' );
		$nickname     = get_the_author_meta( 'nickname' );
		$description  = get_the_author_meta( 'description' );
		?>
		<div class="author-box">
			<div class="top-wrap clearfix">
				<div class="author-thumb">
					<?php echo wp_kses_post( get_avatar( $author_id ) ); ?>
				</div>
				<div class="author-name">
					<?php
						echo $display_name ? wp_kses_post( "<h3>{$display_name}</h3>" ) : '';
						echo $nickname ? wp_kses_post( "<p class='author-professsional'>{$nickname}</p>" ) : '';
						echo $description ? wp_kses_post( "<p class='author-details'>{$description}</p>" ) : '';
					?>
				</div>
			</div>
		</div><!-- // author-box -->
		<?php
	}
}
