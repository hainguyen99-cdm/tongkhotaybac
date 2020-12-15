<?php
/**
 * Template file for the theme footer.
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
		<a id="rm-backtotop">
			<span class="caption"><?php esc_html_e( 'Top', 'trending-mag' ); ?></span>
		</a><!-- // rm-backtotop -->

		<footer class="footer secondary-widget-area">

			<div class="footer-inner">

				<div class="footer-entry">

					<div class="rm-container">

						<?php

						get_template_part( 'template-parts/footer/block', 'footer-widgets' );

						get_template_part( 'template-parts/footer/block', 'footer-about' );

						get_template_part( 'template-parts/footer/block', 'social-links' );

						get_template_part( 'template-parts/footer/block', 'copy-right' );

						?>

					</div><!-- // rm-container -->

				</div><!-- // footer-entry -->

			</div><!-- // footer-inner -->

		</footer><!-- // footer secondary-widget-area -->

	</div><!-- // page-wrap -->

	<?php wp_footer(); ?>
</body>

</html>

