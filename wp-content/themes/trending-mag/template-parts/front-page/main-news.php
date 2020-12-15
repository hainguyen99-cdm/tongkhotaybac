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
$trending_mag_section_name = 'section_one';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );
?>
<section class="rm-full-widget-area main-content-area-wrap full-layout-1">
	<div class="widget-area-inner layout-1">
		<div class="rm-container">
			<?php
			trending_mag_frontpage_section_heading( $heading );

			$left_args = array(
				'post_type'      => 'post',
				'offset'         => 1,
				'posts_per_page' => 2,
				'post_status'    => 'publish',
			);

			if ( ! empty( $category_id ) ) {
				$left_args['cat'] = $category_id;
			}

			$left_query = new WP_Query( $left_args );

			?>
			<div class="rm-row">

			<?php
			if ( $left_query->have_posts() ) {
				?>
					<div class="rm-col left">

						<article class="hentry">

							<?php

							while ( $left_query->have_posts() ) {
								$left_query->the_post();
								?>
								<div class="rm-full-widget-area post-format-block half-top">

									<?php if ( has_post_thumbnail() ) { ?>
									<figure class="thumb is-standard">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</figure><!-- // thumb -->
									<?php } ?>

									<div class="post-detail">
										<?php
										trending_mag_list_post_categories();

										the_title(
											'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
											'</a></h2></div>'
										);
										?>
									</div>
								</div><!-- // rm-full-widget-area post-format-block -->
								<?php
							}
							?>


						</article>


					</div><!-- // rm-col left -->
					<?php
			}
			wp_reset_postdata();




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

			?>
				<div class="rm-col right">

					<div class="hentry">
						<div class="rm-full-widget-area post-format-block">
						<?php
						while ( $right_query->have_posts() ) {
							$right_query->the_post();
							get_template_part( 'template-parts/archives/layout-one' );
						}
						?>
						</div>
					</div>

				</div><!-- // rm-col right -->

			<?php wp_reset_postdata(); ?>

			</div><!-- // rm-row -->

		</div><!-- // rm-container -->
	</div><!-- // widget-area-inner -->
</section><!-- // rm-top-widget-area -->
<?php
