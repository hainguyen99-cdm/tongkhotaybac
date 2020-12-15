<?php

get_header();

?>


<div class="not-found">
	<div class="container">
		<div class="not-found-caption">
			<div class="ex-large"><h1 class="widget-inn-tt-not"><?php esc_html_e( '404', 'trending-mag' ); ?></h1></div>
			<h3 class="s-title"><?php esc_html_e( 'Oops! Page not found', 'trending-mag' ); ?></h3>
			<p><?php esc_html_e( 'Why dont you try searching changing keyword.', 'trending-mag' ); ?></p>
			<div id="content" class="search-again">
				<?php get_search_form(); ?>
			</div><!--/search-again-->
		</div><!--//not-found-caption-->
	</div><!--//container-->
</div><!-- // not-found-page -->


<?php
get_footer();
