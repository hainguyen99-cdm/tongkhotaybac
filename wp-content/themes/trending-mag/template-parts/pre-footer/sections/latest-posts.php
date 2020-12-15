<?php
/**
 * Template part for the prefooter section.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trending_mag_panel_name   = 'pre_footer';
$trending_mag_section_name = 'section_three';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );

?>
<div class="half-widget-area layout-3">
	<?php trending_mag_frontpage_section_heading( $heading ); ?>

	<div class="row">
		<?php

		$args_one = array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		);

		if ( ! empty( $category_id ) ) {
			$args_one['cat'] = $category_id;
		}

		$query_one = new WP_Query( $args_one );
		if ( $query_one->have_posts() ) {
			?>
			<div class="col-12 col-lg-6">
			<?php
			while ( $query_one->have_posts() ) {
				$query_one->the_post();
				get_template_part( 'template-parts/archives/layout-one' );
			}
			?>
			</div><!-- //col-lg-6 -->
			<?php
		}
		wp_reset_postdata();


		$args_two = array(
			'post_type'           => 'post',
			'posts_per_page'      => 4,
			'offset'              => 1,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
		);

		if ( ! empty( $category_id ) ) {
			$args_two['cat'] = $category_id;
		}

		$query_two = new WP_Query( $args_two );

		if ( $query_two->have_posts() ) {
			?>
			<div class="col-12 col-lg-6">
				<?php
				while ( $query_two->have_posts() ) {
					$query_two->the_post();
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
									'<div class="widget-inn-tt"><h5 class="tt-in"><a href="' . esc_url( get_the_permalink() ) . '">',
									'</a></h5></div>'
								);

								trending_mag_post_meta_data();
							?>
						</div><!--rm-content-bdy-->
					</div><!-- // small-widget-area -->
				<?php } ?>
			</div>
			<?php
		}
		wp_reset_postdata();
		?>

	</div><!-- //row -->
</div><!-- // half-widget-area layout-3 -->
