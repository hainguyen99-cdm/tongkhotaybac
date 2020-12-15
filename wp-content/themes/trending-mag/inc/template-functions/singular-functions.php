<?php
/**
 * This file hooks the template functions in singular.php file and its content-singular.php.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'trending_mag_post_sharer_block' ) ) {

	/**
	 * Prints the html which has the sharer buttons.
	 */
	function trending_mag_post_sharer_block() {

		if ( ! is_single() ) {
			return;
		}

		if ( ! function_exists( 'trending_mag_pro_list_sharer_button' ) ) {
			return;
		}

		if ( ! function_exists( 'trending_mag_pro_get_supported_sharer' ) ) {
			return;
		}

		$social_links = trending_mag_pro_get_supported_sharer();

		$args = array();

		if ( is_array( $social_links ) && ! empty( $social_links ) ) {
			foreach ( $social_links as $social_link ) {
				if ( trending_mag_get_theme_mod( 'general_options', 'social_sharer', $social_link ) ) {
					$args[] = $social_link;
				}
			}
		}

		if ( ! $args ) {
			return;
		}

		$count = get_post_meta( get_the_ID(), 'trending_mag_sharer_count', true );

		?>
		<div class="social-sharing clearfix">
			<div class="gm-share-icon">
				<div class="social-share-count">
					<i class="fa fa-share"></i>
					<?php
					if ( '' !== $count ) {
						?>
							<span class="share-number"><?php echo esc_html( $count ); ?></span>
						<?php
					}
					?>
					<span class="share-text"><?php esc_html_e( 'Share', 'trending-mag' ); ?></span>
				</div>
			</div><!--share icon-->
			<div>
				<ul class="social-share-list">
					<?php trending_mag_pro_list_sharer_button( $args ); ?>
				</ul>
			</div><!-- // div -->
			<form id="trigger-sharer-counter" method="post" style="display: none;">
				<input type="hidden" name="trending_mag[sharer][post_id]" value="<?php the_ID(); ?>">
				<?php wp_nonce_field( 'trending_mag_sharer_nonce_action', 'trending_mag_sharer_nonce' ); ?>
			</form>
		</div><!-- // social-sharing -->
		<?php
	}
	add_action( 'trending_mag_content_singular_after_title', 'trending_mag_post_sharer_block' );
}


if ( ! function_exists( 'trending_mag_single_categories_and_meta_data' ) ) {

	/**
	 * Hooks the post meta info functions.
	 */
	function trending_mag_single_categories_and_meta_data() {

		trending_mag_list_post_categories();

		trending_mag_post_meta_data();

	}
	add_action( 'trending_mag_content_singular_after_post_thumbnail', 'trending_mag_single_categories_and_meta_data' );
}


if ( ! function_exists( 'trending_mag_single_post_tags' ) ) {

	/**
	 * Hooks the post navigation and author box functions.
	 */
	function trending_mag_single_post_tags() {
		if ( ! is_single() ) {
			return;
		}

		the_tags();
	}
	add_action( 'trending_mag_content_singular_after_content', 'trending_mag_single_post_tags' );
}





if ( ! function_exists( 'trending_mag_single_post_navigation_and_author_box' ) ) {

	/**
	 * Hooks the post navigation and author box functions.
	 */
	function trending_mag_single_post_navigation_and_author_box() {
		trending_mag_the_post_navigation();

		trending_mag_get_post_author_box();
	}
	add_action( 'trending_mag_content_singular_after_content', 'trending_mag_single_post_navigation_and_author_box', 15 );
}


if ( ! function_exists( 'trending_mag_single_comment_box' ) ) {

	/**
	 * Hooks the post navigation and author box functions.
	 */
	function trending_mag_single_comment_box() {
		if ( ! is_single() ) {
			return;
		}
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
	add_action( 'trending_mag_content_singular_after_content', 'trending_mag_single_comment_box', 20 );
}



if ( ! function_exists( 'trending_mag_single_related_posts' ) ) {

	/**
	 * Hooks the related post section.
	 */
	function trending_mag_single_related_posts() {

		if ( ! is_single() ) {
			return;
		}

		$cat_ids    = array();
		$post_id    = get_the_ID();
		$categories = get_the_category( $post_id );

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
			foreach ( $categories as $category ) :
				array_push( $cat_ids, $category->term_id );
			endforeach;
		endif;

		$current_post_type = get_post_type( $post_id );
		$query_args        = array(
			'category__in'   => $cat_ids,
			'post_type'      => $current_post_type,
			'post_not_in'    => array( $post_id ),
			'posts_per_page' => '3',
		);

		$the_query = new WP_Query( $query_args );

		if ( $the_query->have_posts() ) {
			?>
			<div class="related-posts">

				<div class="widget-title widget-title-d1">
					<h2 class="title"><?php esc_html_e( 'Related Posts', 'trending-mag' ); ?></h2>
				</div>

				<div class="rm-row">

					<?php while ( $the_query->have_posts() ) { ?>
						<?php $the_query->the_post(); ?>
						<div class="rm-col">
							<article class="hentry">
								<div class="rm-full-widget-area post-format-block">

									<?php if ( has_post_thumbnail() ) { ?>
										<figure class="thumb is-standard">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(); ?>
											</a>
										</figure><!-- // thumb -->
									<?php } ?>

									<div class="post-detail">
										<?php
										trending_mag_list_post_categories();

										the_title(
											'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
											'</a></h2></div><!-- // post-title -->'
										);
										?>
									</div>
								</div>
							</article>
						</div><!-- // rm-col left -->
					<?php } ?>

				</div><!-- // rm-row -->

			</div><!-- // related-posts -->
			<?php
		}

		wp_reset_postdata();
	}
	add_action( 'trending_mag_singular_after_content_wrapper_ends', 'trending_mag_single_related_posts' );
}
