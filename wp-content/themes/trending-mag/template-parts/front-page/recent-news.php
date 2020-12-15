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
$trending_mag_section_name = 'section_three';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$number_posts = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' );
$category_ids = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );

$category_one   = isset( $category_ids[0] ) ? $category_ids[0] : '';
$category_two   = isset( $category_ids[1] ) ? $category_ids[1] : '';
$category_three = isset( $category_ids[2] ) ? $category_ids[2] : '';

$hide_category  = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_category' );
$hide_post_meta = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'hide_post_meta' );
?>
<section class="rm-full-widget-area main-content-area-wrap">
	<div class="widget-area-inner layout-3">
		<div class="rm-container">
			<?php trending_mag_frontpage_section_heading( $heading ); ?>
				<div class="rm-row">

					<?php if ( $category_one ) { ?>
					<div class="rm-col left">
						<article class="hentry">
							<?php
							$left_query = new WP_Query(
								array(
									'posts_per_page' => 3,
									'post_status'    => 'publish',
									'posts_per_page' => $number_posts,
									'cat'            => $category_one,
								)
							);
							while ( $left_query->have_posts() ) {
								$left_query->the_post();

								if ( 0 === $left_query->current_post ) {
									?>
									<div class="rm-full-widget-area post-format-block">
										<?php if ( has_post_thumbnail() ) { ?>
										<figure class="thumb is-standard">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(); ?>
											</a>
										</figure><!-- // thumb -->
										<?php } ?>

										<div class="post-detail">
											<?php

											if ( ! $hide_category ) {
												trending_mag_list_post_categories();
											}

											the_title(
												'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
												'</a></h2></div>'
											);
											?>
										</div>
									</div><!-- // rm-full-widget-area post-format-block -->
									<?php
								} else {
									?>
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
												'<div class="widget-inn-tt"><h2 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
												'</a></h2></div>'
											);

											if ( ! $hide_post_meta ) {
												trending_mag_post_meta_data();
											}
											?>
										</div><!-- //  rm-content-bdy-->
									</div>

									<?php
								}
							}
							wp_reset_postdata();
							?>
					</article>
				</div><!-- // rm-col left -->
				<?php } ?>

				<?php if ( $category_two ) { ?>
					<div class="rm-col center">
						<article class="hentry">
							<?php
							$left_query = new WP_Query(
								array(
									'posts_per_page' => 3,
									'post_status'    => 'publish',
									'posts_per_page' => $number_posts,
									'cat'            => $category_two,
								)
							);
							while ( $left_query->have_posts() ) {
								$left_query->the_post();

								if ( 0 === $left_query->current_post ) {
									?>
									<div class="rm-full-widget-area post-format-block">
										<?php if ( has_post_thumbnail() ) { ?>
										<figure class="thumb is-standard">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(); ?>
											</a>
										</figure><!-- // thumb -->
										<?php } ?>

										<div class="post-detail">
											<?php
											if ( ! $hide_category ) {
												trending_mag_list_post_categories();
											}

											the_title(
												'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
												'</a></h2></div>'
											);
											?>
										</div>
									</div><!-- // rm-full-widget-area post-format-block -->
									<?php
								} else {
									?>
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
													'<div class="widget-inn-tt"><h2 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
													'</a></h2></div>'
												);

											if ( ! $hide_post_meta ) {
												trending_mag_post_meta_data();
											}
											?>
										</div><!-- //  rm-content-bdy-->
									</div>

									<?php
								}
							}
							wp_reset_postdata();
							?>
					</article>
				</div><!-- // rm-col center -->
				<?php } ?>


				<?php if ( $category_three ) { ?>
					<div class="rm-col center">
						<article class="hentry">
							<?php
							$left_query = new WP_Query(
								array(
									'posts_per_page' => 3,
									'post_status'    => 'publish',
									'posts_per_page' => $number_posts,
									'cat'            => $category_three,
								)
							);
							while ( $left_query->have_posts() ) {
								$left_query->the_post();

								if ( 0 === $left_query->current_post ) {
									?>
									<div class="rm-full-widget-area post-format-block">
										<?php if ( has_post_thumbnail() ) { ?>
										<figure class="thumb is-standard">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(); ?>
											</a>
										</figure><!-- // thumb -->
										<?php } ?>

										<div class="post-detail">
											<?php

											if ( ! $hide_category ) {
												trending_mag_list_post_categories();
											}

											the_title(
												'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
												'</a></h2></div>'
											);
											?>
										</div>
									</div><!-- // rm-full-widget-area post-format-block -->
									<?php
								} else {
									?>
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
												'<div class="widget-inn-tt"><h2 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
												'</a></h2></div>'
											);

											if ( ! $hide_post_meta ) {
												trending_mag_post_meta_data();
											}
											?>
										</div><!-- //  rm-content-bdy-->
									</div>

									<?php
								}
							}
							wp_reset_postdata();
							?>
					</article>
				</div><!-- // rm-col center -->
				<?php } ?>

			</div><!-- // rm-col left -->
		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner -->
</section><!-- // rm-top-widget-area -->
