<?php
/**
 * Template part for the frontpage main banner slider.
 * Layout type: Layout One
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
	<section id="content" class="mastbanner rm-banner-s1">
		<div class="banner-inner">
			<div class="rm-container">
				<div class="banner-entry">
					<div class="slick-wrap rm-banner-slider-s1">
						<article class="hentry">
							<div class="main-rm-banner-slider-s1">

								<?php
								while ( $the_query->have_posts() ) {
									$the_query->the_post();

									$post_format = get_post_format();
									$icon_type   = '';
									if ( 'gallery' === $post_format ) {
										$icon_type = 'icon-image';
									}

									if ( 'video' === $post_format ) {
										$icon_type = 'icon-video';
									}
									?>
									<div <?php post_class( 'slides' ); ?>>

										<a href="<?php the_permalink(); ?>">
											<figure class="thumb standard" style="background-image:url(<?php the_post_thumbnail_url( trending_mag_get_image_size( 'banner_slider' ) ); ?>);">
												<?php if ( $post_format ) { ?>
												<div class="is-post-format">
													<span class="<?php echo esc_attr( "is-{$post_format}" ); ?>"><i class="feather <?php echo esc_attr( $icon_type ); ?>"></i></span>
												</div><!-- // is-post-format -->
												<?php } ?>
											</figure><!-- // thumb -->
										</a>

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
									</div><!-- // rm-col -->
								<?php } ?>

							</div><!-- // main-rm-banner-slider-s1 -->
						</article><!--// hentry -->
					</div><!-- //slick wrap -->
				</div><!-- // banner-entry -->
			</div><!-- // rm-container -->
		</div><!-- // banner-inner -->
	</section><!-- // mastbanner rm-banner-s1 -->
	<?php
}
wp_reset_postdata();
