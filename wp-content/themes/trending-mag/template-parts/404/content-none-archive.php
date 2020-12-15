<?php
/**
 * Title template part for search result not found.
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


<div class="ex-large">
	<h1 class="widget-inn-tt-not"><?php esc_html_e( 'Oops!', 'trending-mag' ); ?></h1>
</div>

<h3 class="s-title">
	<?php
		esc_html_e( 'No content found.', 'trending-mag' );
	?>
</h3>

<?php
	printf(
		'<p>' . wp_kses(
			/* translators: 1: link to WP admin new post page. */
			__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'trending-mag' ),
			array(
				'a' => array(
					'href' => array(),
				),
			)
		) . '</p>',
		esc_url( admin_url( 'post-new.php' ) )
	);
