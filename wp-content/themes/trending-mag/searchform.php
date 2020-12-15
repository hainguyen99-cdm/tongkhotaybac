<?php
/**
 * Displays custom search form.
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
<form method="get" action="<?php echo esc_url( home_url() ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'trending-mag' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Enter Keyword', 'trending-mag' ); ?>" value="<?php the_search_query(); ?>" name="s">
		<button type="submit" class="search-submit">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>
	</label>
</form>
