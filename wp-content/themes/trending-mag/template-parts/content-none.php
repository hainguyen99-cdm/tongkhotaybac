<?php
/**
 * This is the template part file which will be used by main template files accordingly when no content is found.
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


<div class="not-found">
	<div class="container">
		<div class="not-found-caption">

			<?php
			if ( is_archive() ) {
				get_template_part( 'template-parts/404/content-none', 'archive' );
			} elseif ( is_search() ) {
				get_template_part( 'template-parts/404/content-none', 'search' );
			} else {
				?>
				<div class="ex-large">
					<h1 class="widget-inn-tt-not"><?php esc_html_e( '404', 'trending-mag' ); ?></h1>
				</div>

				<h3 class="s-title"><?php esc_html_e( 'Oops! Page not found', 'trending-mag' ); ?></h3>

				<p><?php esc_html_e( 'Why dont you try searching changing keyword.', 'trending-mag' ); ?></p>
				<?php
			}
			?>

			<div class="search-again">
				<?php get_search_form(); ?>
			</div><!--/search-again-->

		</div><!--//not-found-caption-->
	</div><!--//container-->
</div><!-- // not-found-page -->
