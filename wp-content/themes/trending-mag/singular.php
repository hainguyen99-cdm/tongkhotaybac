<?php
/**
 * The main template file for displaying the single posts.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();


if ( have_posts() ) {
	?>

	<div class="single-post-layout1">

		<div class="rm-container">

			<?php do_action( 'trending_mag_singular_before_content_wrapper_starts' ); ?>

			<div class="rm-row">

				<?php trending_mag_get_sidebar( 'left-sidebar' ); ?>

				<div id="content" class="rm-col <?php trending_mag_get_sidebar_layout_class(); ?>">

					<?php

					/**
					 * Hook - trending_mag_singular_before_loop
					 */
					do_action( 'trending_mag_singular_before_loop' );

					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', 'singular' );
					}

					/**
					 * Hook - trending_mag_singular_after_loop
					 */
					do_action( 'trending_mag_singular_after_loop' );
					?>

				</div><!-- // rm-col -->

				<?php trending_mag_get_sidebar( 'right-sidebar' ); ?>

			</div><!-- // rm-row -->

			<?php do_action( 'trending_mag_singular_after_content_wrapper_ends' ); ?>

		</div><!-- // rm-container -->
	</div><!-- // single-post-layout1 -->

	<?php
} else {
	get_template_part( 'template-parts/content', 'none' );
}


get_footer();
