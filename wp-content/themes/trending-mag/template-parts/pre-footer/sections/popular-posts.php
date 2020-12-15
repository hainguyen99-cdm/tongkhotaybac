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
$trending_mag_section_name = 'section_one';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );

$category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );

?>
<div class="half-widget-area layout-1">

	<?php
	trending_mag_frontpage_section_heading( $heading );

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
		while ( $query_one->have_posts() ) {
			$query_one->the_post();
			get_template_part( 'template-parts/archives/layout-one' );
		}
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
		<div class="row">
			<?php
			while ( $query_two->have_posts() ) {
				$query_two->the_post();
				?>
			<div class="col-12 col-lg-6">
				<div class="rm-widget-area-wraper">
					<div class="rm-widget-bg" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
						<div class="post-detail">
							<?php
							trending_mag_list_post_categories();

							the_title(
								'<div class="post-title"><h2><a href="' . esc_url( get_the_permalink() ) . '">',
								'</a></h2></div>'
							);

							trending_mag_post_meta_data();
							?>
						</div>
					</div>
				</div>
			</div>
			<!--col-lg-6-->
			<?php } ?>
		</div>
		<?php
	}
	wp_reset_postdata();
	?>
</div><!-- // half-widget-area layout-1 -->
