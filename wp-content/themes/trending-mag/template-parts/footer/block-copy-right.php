<?php
/**
 * Template part file for the footer bottom section.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start();
?>
<div class="rm-copy-right">
	<p><?php esc_html_e( 'Trending Mag by', 'trending-mag' ); ?> <a href="<?php echo esc_url( 'https://wishfulthemes.com/' ); ?>"><?php esc_html_e( 'Wishful Themes', 'trending-mag' ); ?></a> | <?php esc_html_e( 'Powered by', 'trending-mag' ); ?> <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>"><?php esc_html_e( 'WordPress', 'trending-mag' ); ?></a></p>
</div><!-- // rm-copy-right -->
<?php
$copyright = ob_get_clean();

$copyright = apply_filters( 'trending_mag_footer_copyright', $copyright );

echo wp_kses_post( $copyright );
