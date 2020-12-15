<?php
/**
 * Template part for the frontpage main banner slider.
 * Layout type: Default ( Layout One )
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
$trending_mag_section_name = 'banner_slider';

$number_posts = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' );
$category_id  = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );

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

if ( $the_query->have_posts() ) {
	$hide_category  = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_category' );
	$hide_post_meta = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_post_meta' );
	?>
	<section id="content" class="mastbanner rm-banner-s3">
		<div class="banner-inner">
			<div class="rm-container">
				<div class="banner-entry">
					<div class="slick-wrap rm-banner-slider-s3">
						<article class="hentry">
							<div class="rm-row">

								<div class="rm-col full-width">

									<div class="rm-banner-s3-slider-wrap">
									<?php
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										?>
											<div class="rm-widget-area-wraper">
												<div class="rm-widget-bg" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
													<div class="post-detail">
														<?php
														if ( ! $hide_category ) {
															trending_mag_list_post_categories();
														}

														the_title(
															'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
															'</a></h2></div>'
														);

														if ( ! $hide_post_meta ) {
															trending_mag_post_meta_data();
														}
														?>
													</div><!-- // post-content -->
												</div>
											</div><!-- // rm-widget-area-wraper-->
										<?php } ?>
									</div><!-- // rm-banner-s3-slider-wrap-->
								</div>

							</div>
						</article>
						<!--// hentry -->
					</div>
					<!-- //slick wrap -->
				</div>
				<!-- // banner-entry -->
			</div>
			<!-- // rm-container -->
		</div>
		<!-- // banner-inner -->
	</section><!-- // mastbanner rm-banner-s2 -->
	<?php
}
wp_reset_postdata();
