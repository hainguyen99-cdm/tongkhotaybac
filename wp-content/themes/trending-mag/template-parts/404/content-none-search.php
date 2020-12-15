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
		/* translators: %s is the search query result. */
		echo sprintf( esc_html__( 'No results found for: %s', 'trending-mag' ), get_search_query() );
	?>
</h3>

<p><?php esc_html_e( 'May be try another search?', 'trending-mag' ); ?></p>
