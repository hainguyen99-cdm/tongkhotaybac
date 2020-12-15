<?php
/**
 * Template part for the frontpage main banner slider.
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
$trending_mag_section_name = 'news_ticker';

$enable_section = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'enable_section' );

if ( ! $enable_section ) {
	return;
}

$heading      = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'heading' );
$number_posts = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'number_of_posts' );

$category_id = trending_mag_get_theme_mod( $trending_mag_panel_name, $trending_mag_section_name, 'category' );


$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $number_posts,
);

if ( ! empty( $category_id ) ) {
	$args['cat'] = $category_id;
}

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {
	?>
	<section class="rm-ticker-widget-area ">
		<div class="ticker-area-inner">
			<div class="rm-container">
				<div class="widget-area-entry">
					<div class="widget text_widget">
						<div class="nt_wrapper">

							<?php if ( $heading ) { ?>
								<div class="nt_title pull-left"><?php echo esc_html( $heading ); ?></div>
							<?php } ?>

							<ul id="webticker">

								<?php
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									?>
									<li>
										<a href="<?php the_permalink(); ?>">
											<figure><img src="<?php the_post_thumbnail_url(); ?>"></figure>
											<?php the_title( '<span>', '</span>' ); ?>
										</a>
									</li>
									<?php
								}
								?>

							</ul>

						</div>
					</div><!-- // widget text_widget -->
				</div><!-- // widget-area-entry -->
			</div><!-- // rm-container -->
		</div><!-- // widget-area-inner -->
	</section><!-- // rm-top-widget-area -->
	<?php
}

wp_reset_postdata();

