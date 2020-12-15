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
$trending_mag_section_name = 'section_two';

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
	<div class="widget-area-inner layout-2">
		<div class="rm-container">
			<?php trending_mag_frontpage_section_heading( $heading ); ?>
			<div class="rm-row">
				<div class="rm-col left">
					<div class="row">

						<?php

						$left_args = array(
							'post_type'           => 'post',
							'offset'              => 1,
							'ignore_sticky_posts' => 1,
							'posts_per_page'      => $number_posts ? $number_posts : 8,
							'post_status'         => 'publish',
						);

						if ( ! empty( $category_id ) ) {
							$left_args['cat'] = $category_id;
						}

						$left_query = new WP_Query( $left_args );

						while ( $left_query->have_posts() ) {
							$left_query->the_post();
							?>
							<div class="col-12 col-lg-6">
								<div class="small-widget-area">
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
										the_title(
											'<div class="widget-inn-tt"><h5 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
											'</a></h5></div>'
										);

										if ( ! $hide_post_meta ) {
											trending_mag_post_meta_data();
										}
										?>
									</div><!-- //  rm-content-bdy-->
								</div><!-- // small-widget-area-->
							</div><!-- // col-12 col-lg-6-->
							<?php
						}
						wp_reset_postdata();
						?>

					</div><!-- // row-->
				</div><!-- // rm-col right -->

				<div class="rm-col right">

					<?php

					$right_args = array(
						'post_type'           => 'post',
						'posts_per_page'      => 1,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
					);

					if ( ! empty( $category_id ) ) {
						$right_args['cat'] = $category_id;
					}

					$right_query = new WP_Query( $right_args );

					while ( $right_query->have_posts() ) {
						$right_query->the_post();
						?>
					<article class="hentry">
						<div class="rm-full-widget-area">
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

									the_title(
										'<div class="widget-inn-tt"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
										'</a></h2></div>'
									);

									if ( ! $hide_post_meta ) {
										trending_mag_post_meta_data();
									}

									trending_mag_the_excerpt( trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'excerpt_length' ) );
									?>
								</div><!--rm-content-bdy-->
							</div><!--rm-widget-content-->
						</div>
					</article>
						<?php
					}
					wp_reset_postdata();
					?>
				</div>
			</div><!-- // rm-col left -->
		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner -->
</section><!-- // rm-top-widget-area -->

