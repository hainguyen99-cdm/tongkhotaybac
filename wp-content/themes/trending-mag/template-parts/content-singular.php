<?php
/**
 * Template part for the single pages and posts.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>



<div <?php post_class( 'rm-single-content-wrap' ); ?>>

	<?php

	do_action( 'trending_mag_content_singular_before_title' );

	the_title(
		'<div class="single-tt-area"><h2 class="single-title">',
		'</h2></div>'
	);

	/**
	 * Hook - trending_mag_content_singular_after_title
	 *
	 * @see trending_mag_post_sharer_block - 10
	 */
	do_action( 'trending_mag_content_singular_after_title' );


	if ( has_post_thumbnail() ) {
		?>
		<figure class="single-inn-img">
			<?php the_post_thumbnail(); ?>
		</figure>
		<?php
	}


	/**
	 * Hook - trending_mag_content_singular_after_post_thumbnail
	 *
	 * @see trending_mag_single_categories_and_meta_data - 10
	 */
	do_action( 'trending_mag_content_singular_after_post_thumbnail' );


	if ( get_the_content() ) {
		?>
		<div class="rm-single-post-content-area clearfix">
			<?php the_content(); ?>
		</div> <!-- // rm-single-post-content-area -->
		<?php
	}

	wp_link_pages();


	/**
	 * Hook - trending_mag_content_singular_after_content
	 *
	 * @see trending_mag_single_post_tags - 10
	 * @see trending_mag_single_post_navigation_and_author_box - 15
	 * @see trending_mag_single_comment_box - 20
	 */
	do_action( 'trending_mag_content_singular_after_content' );

	?>

</div><!-- // rm-single-content-wrap -->

