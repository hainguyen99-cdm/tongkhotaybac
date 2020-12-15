<?php
/**
 * Template part for the frontpage main Section One.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$trending_mag_panel_name   = 'front_page';
$trending_mag_section_name = 'section_five';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$number_posts   = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' );
$category_id    = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );
$hide_category  = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_category' );
$hide_post_meta = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_post_meta' );
?>
<section class="rm-full-widget-area main-content-area-wrap">
	<div class="widget-area-inner layout-5">
		<div class="rm-container">
			<?php trending_mag_frontpage_section_heading( $heading ); ?>
			<div class="row">

				<?php

				$args = array(
					'post_type'           => 'post',
					'posts_per_page'      => $number_posts,
					'ignore_sticky_posts' => 1,
					'post_status'         => 'publish',
				);

				if ( ! empty( $category_id ) ) {
					$args['cat'] = $category_id;
				}

				$the_query = new WP_Query( $args );

				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
					<div class="col-12 col-lg-3">
						<div class="rm-widget-content">

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

								if ( ! $hide_category ) {
									trending_mag_list_post_categories();
								}

								if ( ! $hide_post_meta ) {
									trending_mag_post_meta_data();
								}

								the_title(
									'<div class="widget-inn-tt"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
									'</a></h2></div>'
								);

								trending_mag_the_excerpt( trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'excerpt_length' ) );

								?>
							</div>
						</div><!--rm-widget-content-->
					</div><!-- // col-lg-4 -->

					<?php
				}
				wp_reset_postdata();
				?>

			</div><!-- // row -->
		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner layout-4 -->
</section><!-- // rm-full-widget-area main-content-area-wrap -->
