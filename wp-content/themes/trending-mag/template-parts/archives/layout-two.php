<?php
/**
 * Another layout style for the archives content listings
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
<div <?php post_class( 'small-widget-area' ); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="img-holder">
			<figure class="thumb is-standard">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure><!-- // thumb -->
		</div>
	<?php } ?>

	<div class="rm-content-bdy">

		<?php

		trending_mag_list_post_categories();

		the_title(
			'<div class="widget-inn-tt"><h2 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
			'</a></h2></div>'
		);

		trending_mag_post_meta_data();

		the_excerpt();
		?>

	</div><!-- //  rm-content-bdy-->
</div>
