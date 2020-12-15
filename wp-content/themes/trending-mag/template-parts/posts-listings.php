<?php
/**
 * Template part file for listing the posts.
 * This file can be used by the archives, blogs, search or whatever the file which is used
 * to list the posts as archives.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( have_posts() ) {
	?>
	<div class="archive-page-layout1">

		<?php trending_mag_get_breadcrumb(); ?>

		<div class="rm-container">


			<div class="rm-row">

				<?php trending_mag_get_sidebar( 'left-sidebar' ); ?>

				<div id="content" class="rm-col <?php trending_mag_get_sidebar_layout_class(); ?>">

					<?php
					if ( is_search() ) {
						?>
						<div class="widget-title widget-title-d1">
							<h2 class="title">
								<?php
								/* translators: %s is the search query result. */
								echo sprintf( esc_html__( 'Results for: %s', 'trending-mag' ), get_search_query() );
								?>
							</h2>
						</div>
						<?php
					}

					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content' );
					}
					?>

					<div class="rm-pagination">

						<div class="pagination-entry">

							<div class="rm-ajax-load-pagination"></div><!-- // rm-ajax-load-pagination -->

							<div class="rm-standard-pagination">
								<?php the_posts_pagination(); ?>
							</div><!-- // rm-standard-pagination -->

						</div><!-- // pagination-entry -->

					</div><!-- // rm-pagination -->

					<?php do_action( 'trending_mag_archive_after_pagination' ); ?>

				</div><!-- // rm-col -->

				<?php trending_mag_get_sidebar( 'right-sidebar' ); ?>

			</div><!-- // rm-row -->


		</div><!-- // rm-container -->


	</div><!-- // archive-page-layout1 -->
	<?php
} else {
	get_template_part( 'template-parts/content', 'none' );
}
