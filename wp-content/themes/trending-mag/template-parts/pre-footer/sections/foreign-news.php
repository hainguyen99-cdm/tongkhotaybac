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
$trending_mag_section_name = 'section_six';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$slider_category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'slider_category' );

$category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );

?>
<div class="half-widget-area layout-6">
	<?php
	trending_mag_frontpage_section_heading( $heading );

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'post_status'    => 'publish',
	);

	if ( ! empty( $slider_category_id ) ) {
		$args['cat'] = $slider_category_id;
	}

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		?>
		<div class="slidder-post-wrap">
			<?php
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				get_template_part( 'template-parts/archives/layout-one' );
			}
			?>
		</div> <!-- // slidder-post-wrap -->
		<?php
	}
	wp_reset_postdata();


	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'post_status'    => 'publish',
	);

	if ( ! empty( $category_id ) ) {
		$args['cat'] = $category_id;
	}

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		?>
		<div class="row">

			<?php
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
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

								trending_mag_post_meta_data();
							?>
						</div><!--rm-content-bdy-->
					</div><!-- // small-widget-area -->
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	wp_reset_postdata();
	?>
</div><!-- // half-widget-area layout-6 -->
