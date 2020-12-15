<?php
/**
 * Print Recipe Screen file.
 * 
 * @package Delicious_Recipes/Templates
 */
global $recipe;
$recipe_global = delicious_recipes_get_global_settings();

$embedRecipeLink = isset( $recipe_global['embedRecipeLink']['0'] ) && 'yes' === $recipe_global['embedRecipeLink']['0'] ? true : false;
$displaySocialSharingInfo = isset( $recipe_global['displaySocialSharingInfo']['0'] ) && 'yes' === $recipe_global['displaySocialSharingInfo']['0'] ? true : false;
$embedAuthorInfo = isset( $recipe_global['embedAuthorInfo']['0'] ) && 'yes' === $recipe_global['embedAuthorInfo']['0'] ? true : false;
$socials_enabled = ( isset( $recipe_global['socialShare']['0']['enable']['0'] ) 
&& 'yes' === $recipe_global['socialShare']['0']['enable']['0'] ) 
|| ( isset( $recipe_global['socialShare']['1']['enable']['0'] ) 
&& 'yes' === $recipe_global['socialShare']['1']['enable']['0'] ) ? true : false;
// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();

$asset_script_path = '/min/';
$min_prefix    = '.min';

if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
	$asset_script_path = '/';
	$min_prefix    = '';
}

?><!DOCTYPE html>
<html>
<head>
	<title><?php the_title(); ?></title>
	<link rel="stylesheet" href="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . '/assets/public/css' . $asset_script_path . 'recipe-print' . $min_prefix . '.css'; ?>" media="screen,print">
	<?php delicious_recipes_get_template( 'global/dynamic-css.php' ); ?>
</head>
<body>
	<?php 
		$allowPrintCustomization = isset( $recipe_global['allowPrintCustomization']['0'] ) && 'yes' === $recipe_global['allowPrintCustomization']['0'] ? true : false;

		if ( $allowPrintCustomization ) :
			$printOptions = isset( $recipe_global['printOptions'] ) ? $recipe_global['printOptions'] : array();
			if ( ! empty( $printOptions ) ) :
				?>
					<div id="dr-print-options" class="dr-clearfix">
						<h3><?php esc_html_e( 'Print Options:', 'delicious-recipes' ) ?></h3>
						<?php foreach( $printOptions as $key => $printOPT ) : 
							$name   =  isset( $printOPT['key'] ) ? $printOPT['key'] : '';
							$enable = isset( $printOPT['enable']['0'] ) && 'yes' === $printOPT['enable']['0'] ? true : false;	
						?>
							<div class="dr-print-block">
								<input id="print_options_<?php echo esc_attr( sanitize_title( $name ) ); ?>" type="checkbox" name="print_options" value="1" <?php checked( $enable, true ); ?> />
								<label for="print_options_<?php echo esc_attr( sanitize_title( $name ) ); ?>"><?php echo esc_html( $name ); ?></label>
							</div>
						<?php endforeach; ?>
					</div>
				<?php 
			endif;
		endif;
	?>
	<button class="dr-button" onclick="window.print();"><?php esc_html_e( 'Print', 'delicious-recipes' ) ?></button>
	<div class="dr-print-outer-wrap">
		<div id="dr-page1" class="dr-print-header">
		<?php 
			$printLogoImage = isset( $recipe_global['printLogoImage'] ) && ! empty( $recipe_global['printLogoImage'] ) ? $recipe_global['printLogoImage'] : false;

			if ( $printLogoImage ) :
		?>
				<div class="dr-logo">
					<?php echo wp_get_attachment_image( $printLogoImage, 'full' ); ?>
				</div>
		<?php 
			endif;
		?>
			<h1 id="dr-print-title" class="dr-print-title"><?php the_title();?></h1>
			<div class="dr-print-img">
				<?php the_post_thumbnail( 'recipe-feat-print' ); ?>
			</div>
		</div><!-- #dr-page1 -->

		<div id="dr-page2" class="dr-print-page dr-print-ingredients">
			<div class="dr-ingredient-meta-wrap">
				<?php if ( $recipe->rating_count ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="31.979" viewBox="7 0 30 20.979">
							<defs>
								<filter id="star_5_" x="0" y="0" width="32" height="31.979" filterUnits="userSpaceOnUse">
								<feOffset dy="3" input="SourceAlpha"/>
								<feGaussianBlur stdDeviation="3" result="blur"/>
								<feFlood flood-color="#e84e3b" flood-opacity="0.161"/>
								<feComposite operator="in" in2="blur"/>
								<feComposite in="SourceGraphic"/>
								</filter>
							</defs>
							<g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#star_5_)">
								<path id="star_5_2" data-name="star (5)" d="M13.628,5.015l-4.3-.657L7.4.249a.455.455,0,0,0-.792,0L4.675,4.358l-4.3.657a.437.437,0,0,0-.247.738l3.127,3.2-.739,4.531a.438.438,0,0,0,.643.453L7,11.817l3.844,2.125a.438.438,0,0,0,.643-.453l-.739-4.531,3.127-3.2a.438.438,0,0,0-.247-.738Z" transform="translate(9 5.98)" fill="#374757" opacity="0.6"/>
							</g>
						</svg>
						<b><?php esc_html_e( 'Ratings', 'delicious-recipes' ); ?></b>
						<span><?php 
							/* translators: %1$s: rating %2$s: total ratings count */
							echo esc_html( sprintf( __( '%1$s from %2$s votes', 'delicious-recipes' ), $recipe->rating, $recipe->rating_count ) ); 
						?></span>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $recipe->cooking_method ) && $global_toggles['enable_cooking_method'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="18.148" height="16.796" viewBox="0 0 18.148 16.796">
							<g id="Group_19" data-name="Group 19" transform="translate(-169.177 -331.059)" opacity="0.55">
								<path id="Path_30608" data-name="Path 30608" d="M171.257,432.2v-1.927c-.1-.027-.191-.048-.281-.08a.7.7,0,0,1,.17-1.355c.053,0,.108,0,.161,0H185.1c.479,0,.771.22.816.6a.7.7,0,0,1-.468.761c-.089.038-.216.135-.218.209-.018.578-.01,1.157-.01,1.783a1.362,1.362,0,0,0,.738-.8.7.7,0,0,1,1.084-.339.692.692,0,0,1,.226.837,2.656,2.656,0,0,1-1.766,1.665.349.349,0,0,0-.288.408c.01,1.26.006,2.52,0,3.78a1.413,1.413,0,0,1-1.577,1.572H172.853a1.41,1.41,0,0,1-1.58-1.568c0-1.249-.007-2.5,0-3.747,0-.249-.051-.371-.316-.453a2.637,2.637,0,0,1-1.692-1.531.721.721,0,0,1,.32-1.037.707.707,0,0,1,.967.476A1.4,1.4,0,0,0,171.257,432.2Z" transform="translate(0 -91.459)" fill="#374757"/>
								<path id="Path_30609" data-name="Path 30609" d="M192.767,332.748c.634-.083,1.243-.142,1.843-.248a1.821,1.821,0,0,1,1.624.416,1.983,1.983,0,0,0,1.709.574.643.643,0,0,1,.716.628.679.679,0,0,1-.608.745q-4.111.553-8.223,1.1c-1.845.247-3.69.492-5.534.748a.761.761,0,0,1-.844-.323.7.7,0,0,1,.534-1.064,1.451,1.451,0,0,0,.992-.548c.939-1.322,1.111-1.109,2.579-1.336.328-.051.657-.093,1.017-.143-.015-.176-.024-.333-.041-.489a1.4,1.4,0,0,1,1.183-1.557q.734-.11,1.473-.185a1.414,1.414,0,0,1,1.5,1.18C192.714,332.393,192.735,332.542,192.767,332.748Zm-2.774.377,1.36-.2-.057-.468-1.36.2Z" transform="translate(-13.248)" fill="#374757"/>
							</g>
						</svg>
						<b><?php echo esc_html( $global_toggles['cooking_method_lbl'] ); ?></b>
						<?php the_terms( $recipe->ID, 'recipe-cooking-method', '<span>', ', ', '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $recipe->recipe_cuisine ) && $global_toggles['enable_cuisine'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20.39" viewBox="0 0 22 20.39">
							<g id="Group_9" data-name="Group 9" transform="translate(-263.223 -250.745)" opacity="0.6">
								<path id="Path_30604" data-name="Path 30604" d="M337.173,260.819a9.492,9.492,0,0,1,5.256-7.986,9.765,9.765,0,0,0-6.274,7.965h-.9a8.706,8.706,0,0,1,2.321-6.083,8.31,8.31,0,0,1,5.91-2.768v-.466a4.413,4.413,0,0,1-.553-.159.359.359,0,0,1-.2-.223c-.009-.056.114-.166.2-.2a2.41,2.41,0,0,1,1.718,0c.083.031.19.132.192.2s-.1.163-.185.208a.752.752,0,0,1-.332.1c-.2.006-.259.089-.233.273a2.073,2.073,0,0,1,0,.265,8.689,8.689,0,0,1,8.209,8.861Zm13.018-3.358c-.066-1.545-1.552-3.5-2.885-3.771a4.514,4.514,0,0,1,2.417,3.771Z" transform="translate(-67.801)" fill="#374757"/>
								<path id="Path_30605" data-name="Path 30605" d="M305.859,459.615c0-.734.012-1.468,0-2.2a1.039,1.039,0,0,1,.46-.9,3.988,3.988,0,0,1,2.07-.647,3.564,3.564,0,0,1,1.736.3c1.492.6,2.988,1.2,4.483,1.8.048.019.1.035.143.056a1.042,1.042,0,0,1,.483,1.709,1.2,1.2,0,0,1-1.487.519c-.513-.171-1.016-.373-1.523-.561-.082-.03-.164-.065-.248-.089a.6.6,0,0,0-.816.564.394.394,0,0,0,.312.421c.6.227,1.2.459,1.806.69.123.047.248.09.368.145a1,1,0,0,0,.981-.08q2.664-1.518,5.338-3.018a2.028,2.028,0,0,1,1.375-.261.942.942,0,0,1,.781,1.187,1.637,1.637,0,0,1-.819,1.11q-2.333,1.3-4.643,2.64c-.424.245-.815.548-1.229.812a2.277,2.277,0,0,1-2.1.245c-1.265-.444-2.514-.921-3.746-1.453a5.688,5.688,0,0,0-3.258-.33c-.4.067-.467.015-.467-.391Q305.858,460.748,305.859,459.615Z" transform="translate(-40.128 -193.071)" fill="#374757"/>
								<path id="Path_30606" data-name="Path 30606" d="M342,429.247v.723h-18.46v-.723Z" transform="translate(-56.775 -168.026)" fill="#374757"/>
								<path id="Path_30607" data-name="Path 30607" d="M265.384,480.3c0,.66,0,1.32,0,1.98a.517.517,0,0,1-.577.585q-.506,0-1.012,0a.525.525,0,0,1-.569-.579c0-.924,0-1.848,0-2.772,0-.4,0-.807,0-1.21a.543.543,0,0,1,.585-.594c.33-.006.66-.005.99,0a.533.533,0,0,1,.583.589C265.385,478.965,265.384,479.632,265.384,480.3Zm-.793-1.385a.4.4,0,0,0,.393-.367.393.393,0,1,0-.786-.024A.4.4,0,0,0,264.591,478.915Z" transform="translate(0 -213.639)" fill="#374757"/>
							</g>
						</svg>
						<b><?php echo esc_html( $global_toggles['cuisine_lbl'] ); ?></b>
						<?php the_terms( $recipe->ID, 'recipe-cuisine', '<span>', ', ', '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $recipe->recipe_course ) && $global_toggles['enable_category'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="13.973" viewBox="0 0 14 13.973">
							<g id="Group_8" data-name="Group 8" transform="translate(-614.26 -6213.23)" opacity="0.6">
								<rect id="Rectangle_1263" data-name="Rectangle 1263" width="5.949" height="5.922" transform="translate(614.26 6213.23)" fill="#374757"/>
								<rect id="Rectangle_1266" data-name="Rectangle 1266" width="5.949" height="5.922" transform="translate(614.26 6221.282)" fill="#374757"/>
								<rect id="Rectangle_1264" data-name="Rectangle 1264" width="5.949" height="5.922" transform="translate(622.311 6213.23)" fill="#374757"/>
								<rect id="Rectangle_1265" data-name="Rectangle 1265" width="5.949" height="5.922" transform="translate(622.311 6221.282)" fill="#374757"/>
							</g>
						</svg>
						<b><?php echo esc_html( $global_toggles['category_lbl'] ); ?></b>
						<?php the_terms( $recipe->ID, 'recipe-course', '<span>', ', ', '</span>' ); ?>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $recipe->difficulty_level ) && $global_toggles['enable_difficulty_level'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="15.334" height="15.334" viewBox="0 0 15.334 15.334"><g transform="translate(-62.834 -0.328)" opacity="0.6"><path d="M29.022,20A1.022,1.022,0,0,0,28,21.022v8.69a1.022,1.022,0,1,0,2.045,0v-8.69A1.022,1.022,0,0,0,29.022,20Z" transform="translate(41.479 -15.072)" fill="#374757"/><path d="M16.022,32A1.022,1.022,0,0,0,15,33.022v5.623a1.022,1.022,0,1,0,2.045,0V33.022A1.022,1.022,0,0,0,16.022,32Z" transform="translate(51.156 -24.005)" fill="#374757"/><path d="M3.022,46A1.022,1.022,0,0,0,2,47.022v2.045a1.022,1.022,0,0,0,2.045,0V47.022A1.022,1.022,0,0,0,3.022,46Z" transform="translate(60.834 -34.427)" fill="#374757"/><path d="M42.022,8A1.022,1.022,0,0,0,41,9.022V20.779a1.022,1.022,0,0,0,2.045,0V9.022A1.022,1.022,0,0,0,42.022,8Z" transform="translate(31.801 -6.138)" fill="#374757"/><path d="M55.022,2A1.022,1.022,0,0,0,54,3.022v13.29a1.022,1.022,0,0,0,2.045,0V3.022A1.022,1.022,0,0,0,55.022,2Z" transform="translate(22.124 -1.672)" fill="#374757"/></g></svg>
						<b><?php echo esc_html( $global_toggles['difficulty_level_lbl'] ); ?></b>
						<?php echo esc_html( $recipe->difficulty_level ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $recipe->prep_time ) || ! empty( $recipe->cook_time ) || ! empty( $recipe->rest_time ) ) : ?>
					<div class="dr-ingredient-meta dr-ingredient-time">
						<div class="meta-title-wrap">
							<svg xmlns="http://www.w3.org/2000/svg" width="19.51" height="19.51" viewBox="0 0 19.51 19.51">
								<g id="clock_1_" data-name="clock (1)" transform="translate(-0.005)" opacity="0.6">
									<g id="Group_2830" data-name="Group 2830" transform="translate(3.009)">
									<g id="Group_2829" data-name="Group 2829">
										<path id="Path_26353" data-name="Path 26353" d="M77.116,4.207,75.96,3.025a.551.551,0,0,0-.791,0,.58.58,0,0,0,0,.808l1.156,1.181a.551.551,0,0,0,.791,0A.58.58,0,0,0,77.116,4.207ZM88.342,3.025a.551.551,0,0,0-.791,0L86.212,4.392a.58.58,0,0,0,0,.808A.551.551,0,0,0,87,5.2l1.339-1.367A.58.58,0,0,0,88.342,3.025Zm-9.81,13.317a.559.559,0,0,0-.751.256l-1,2.085a.578.578,0,0,0,.25.767.551.551,0,0,0,.25.06.559.559,0,0,0,.5-.316l1-2.085A.578.578,0,0,0,78.532,16.342ZM82.874,0H80.636a.565.565,0,0,0-.559.572.565.565,0,0,0,.559.572H81.2V2.9a.56.56,0,1,0,1.119,0V1.143h.559a.565.565,0,0,0,.559-.572A.565.565,0,0,0,82.874,0Zm2.855,16.6a.556.556,0,0,0-.751-.256.578.578,0,0,0-.25.767l1,2.085a.559.559,0,0,0,.5.316.551.551,0,0,0,.25-.06.578.578,0,0,0,.25-.767Z" transform="translate(-75.005)" fill="#374757"/>
									</g>
									</g>
									<g id="Alarm_Clock_1_" transform="translate(0.005 0.034)">
									<path id="Subtraction_2" data-name="Subtraction 2" d="M7.912,15.825a7.912,7.912,0,1,1,7.912-7.913A7.921,7.921,0,0,1,7.912,15.825Zm0-13.564a5.652,5.652,0,1,0,5.652,5.651A5.657,5.657,0,0,0,7.912,2.261Z" transform="translate(1.843 2.409)" fill="#374757"/>
									<g id="Group_2834" data-name="Group 2834" transform="translate(0)">
										<g id="Group_2833" data-name="Group 2833">
										<path id="Path_26356" data-name="Path 26356" d="M1.01,1.878A3.675,3.675,0,0,0,0,4.427a3.675,3.675,0,0,0,1,2.549.552.552,0,0,0,.808,0L5.859,2.728a.623.623,0,0,0,0-.85,3.388,3.388,0,0,0-4.849,0Zm17.5,0a3.388,3.388,0,0,0-4.849,0,.623.623,0,0,0,0,.85L17.7,6.976a.552.552,0,0,0,.808,0,3.675,3.675,0,0,0,1-2.549,3.675,3.675,0,0,0-1-2.549Z" transform="translate(-0.005 -0.857)" fill="#374757"/>
										</g>
									</g>
									<g id="Group_2835" data-name="Group 2835" transform="translate(6.822 6.645)">
										<path id="Path_26357" data-name="Path 26357" d="M181.607,187.609a.6.6,0,0,1-.425-1.026l2.227-2.227V181.6a.6.6,0,0,1,1.2,0v3a.6.6,0,0,1-.176.425l-2.4,2.4A.6.6,0,0,1,181.607,187.609Z" transform="translate(-181.006 -181)" fill="#374757"/>
									</g>
									</g>
								</g>
							</svg>
							<b><?php esc_html_e( 'Time', 'delicious-recipes' ) ?></b>
						</div>
						<div class="meta-wrap">
							<?php if ( ! empty( $recipe->prep_time ) && $global_toggles['enable_prep_time'] ) : ?>
								<span><?php echo esc_html( $global_toggles['prep_time_lbl'] ); ?>: <?php echo esc_html( $recipe->prep_time ) ?> <?php echo esc_html( $recipe->prep_time_unit ) ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->cook_time )  && $global_toggles['enable_cook_time'] ) : ?>
								<span><?php echo esc_html( $global_toggles['cook_time_lbl'] ); ?>: <?php echo esc_html( $recipe->cook_time ) ?> <?php echo esc_html( $recipe->cook_time_unit ) ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->rest_time ) && $global_toggles['enable_rest_time'] ) : ?>
								<span><?php echo esc_html( $global_toggles['rest_time_lbl'] ); ?>: <?php echo esc_html( $recipe->rest_time ) ?> <?php echo esc_html( $recipe->rest_time_unit ) ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $recipe->total_time ) && $global_toggles['enable_total_time'] ) : ?>
								<span class="total-time"><?php echo esc_html( $global_toggles['total_time_lbl'] ); ?>: <?php echo esc_html( $recipe->total_time ) ?></span>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $recipe->no_of_servings ) && $global_toggles['enable_servings'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="20.763" height="18.77" viewBox="0 0 20.763 18.77">
							<path id="Path_30603" data-name="Path 30603" d="M24.12,65.049a4.574,4.574,0,0,0,5.022-1.25c1.661-1.661,2.288-4.089.718-5.712h0c-.008-.006-.034-.034-.04-.04h0c-1.621-1.57-4.049-.943-5.712.718a4.578,4.578,0,0,0-1.25,5.022c-.157.936-1.443,1.954-2.6,2.612a4.158,4.158,0,0,1-2.127-3.464,2.672,2.672,0,0,0-.767-2.182c-.055-.055-.212-.189-.212-.189l-4.339-3.382-.4.394L17.13,62l-.511.511-4.564-4.562-.42.42L16.2,62.928l-.432.432L11.206,58.8l-.381.379,4.536,4.534-.519.521-4.407-4.666L10,60l3.6,4.538s.085.087.123.121a2.673,2.673,0,0,0,1.835.657l.015,0a4.271,4.271,0,0,1,3.441,1.96l-6.693,6.7,0,0a.116.116,0,0,1-.017.013,1.055,1.055,0,0,0,0,1.494l.121.121a1.055,1.055,0,0,0,1.494,0,.118.118,0,0,0,.013-.017l0,0,6.5-6.5c1.716,1.714,6.471,6.469,6.471,6.469l0,0s.006.011.013.017A1.042,1.042,0,0,0,28.4,74.094c-.006-.006-.013-.008-.017-.013l0,0s-5.252-5.25-6.708-6.708C22.327,66.3,23.257,65.193,24.12,65.049Zm-.557-3.138a5.431,5.431,0,0,1,.174-.939,4.827,4.827,0,0,1,.178-.517,3.069,3.069,0,0,1,.278-.517,3.7,3.7,0,0,1,.782-.809,4.935,4.935,0,0,1,.8-.521,3.683,3.683,0,0,1,.621-.267,1.135,1.135,0,0,1,.252-.059,2.467,2.467,0,0,0-.191.165l-.479.447a11.748,11.748,0,0,0-1.305,1.375,2.566,2.566,0,0,0-.248.422c-.078.148-.148.3-.212.451-.131.3-.239.591-.335.841s-.163.464-.206.614a.445.445,0,0,0-.032.242.449.449,0,0,1-.076-.248A3.448,3.448,0,0,1,23.562,61.911Z" transform="translate(-10 -57.142)" fill="#374757" opacity="0.6"/>
						</svg>
						<b><?php echo esc_html( $global_toggles['servings_lbl'] ); ?></b>
						<span id="dr-servings"><?php echo esc_html( $recipe->no_of_servings ); ?></span>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $recipe->recipe_calories ) && $global_toggles['enable_calories'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32.877" height="37.76" viewBox="7 0 32.877 20.76">
							<defs>
								<filter id="Subtraction_1" x="0" y="0" width="32.877" height="37.76" filterUnits="userSpaceOnUse">
								<feOffset dy="3" input="SourceAlpha"/>
								<feGaussianBlur stdDeviation="3" result="blur"/>
								<feFlood flood-color="#e84e3b" flood-opacity="0.259"/>
								<feComposite operator="in" in2="blur"/>
								<feComposite in="SourceGraphic"/>
								</filter>
							</defs>
							<g id="flame" transform="translate(-54.168 6)">
								<g transform="matrix(1, 0, 0, 1, 54.17, -6)" filter="url(#Subtraction_1)">
								<path id="Subtraction_1-2" data-name="Subtraction 1" d="M8.051,19.76a7.467,7.467,0,0,1-5.068-1.786,13.916,13.916,0,0,1-2.391-3.38,7.659,7.659,0,0,1-.453-4.411A9.539,9.539,0,0,1,2.035,6.1a3.943,3.943,0,0,0,.989,2.886A6.809,6.809,0,0,1,4.591,3.3,11.76,11.76,0,0,1,9.621,0a4.083,4.083,0,0,0-.7,3.876A12.775,12.775,0,0,0,10.4,6.921l0,0c.122.2.248.412.369.619a8.229,8.229,0,0,1,1.4,3.792q.092-.173.185-.346a10.761,10.761,0,0,0,.845-1.839,4.277,4.277,0,0,0,.165-2.392,6.167,6.167,0,0,1,1.36,2.968,12.349,12.349,0,0,1,.041,3.5,8.643,8.643,0,0,1-1.2,3.669,6.878,6.878,0,0,1-3.587,2.68A11.167,11.167,0,0,1,8.051,19.76ZM4.426,11.74A4.239,4.239,0,0,0,3.4,14.585a4.227,4.227,0,0,0,2.722,3.627,3.708,3.708,0,0,0,1.351.259,4.1,4.1,0,0,0,3.507-2.156,3.757,3.757,0,0,0,.006-3.874.054.054,0,0,0-.021-.041.057.057,0,0,1-.02-.03,4.192,4.192,0,0,1-1.031,3.618,3.9,3.9,0,0,0-.371-3.134,16.082,16.082,0,0,0-.987-1.577c-.254-.374-.517-.759-.744-1.144a4.276,4.276,0,0,1-.7-3.092,5.454,5.454,0,0,0-1.979,3.051,5.52,5.52,0,0,0,.412,3.628A2.718,2.718,0,0,1,4.426,11.74Z" transform="translate(9 6)" fill="#374757" opacity="0.6"/>
								</g>
							</g>
						</svg>
						<b><?php echo esc_html( $global_toggles['calories_lbl'] ); ?></b>
						<span><?php echo esc_html( $recipe->recipe_calories ); ?></span>
					</div>
				<?php endif; ?>
				<?php if( ! empty( $recipe->best_season ) && $global_toggles['enable_seasons'] ) : ?>
					<div class="dr-ingredient-meta">
						<svg xmlns="http://www.w3.org/2000/svg" width="27.78" height="19.154" viewBox="0 0 27.78 19.154"><g transform="translate(-29.762 -494)"><path d="M25.886,35.381a3.921,3.921,0,1,0-5.527,5.03,5.352,5.352,0,0,1,3.509-1.93A7.613,7.613,0,0,1,25.886,35.381Z" transform="translate(16.012 465.521)" fill="#374757" opacity="0.6"/><path d="M29.536,20.663a.924.924,0,0,0,.936-.936V18.236a.936.936,0,1,0-1.872,0v1.491A.942.942,0,0,0,29.536,20.663Z" transform="translate(8.795 476.7)" fill="#374757" opacity="0.6"/><path d="M11.534,27.579a.926.926,0,0,0,.673.263.976.976,0,0,0,.673-.263.9.9,0,0,0,0-1.316L11.826,25.21a.93.93,0,1,0-1.316,1.316Z" transform="translate(21.796 471.305)" fill="#374757" opacity="0.6"/><path d="M5.892,44.236a.924.924,0,0,0-.936-.936H3.436a.936.936,0,1,0,0,1.872H4.927A.949.949,0,0,0,5.892,44.236Z" transform="translate(27.262 458.303)" fill="#374757" opacity="0.6"/><path d="M11.463,58.41,10.41,59.463a.9.9,0,0,0,0,1.316.926.926,0,0,0,.673.263,1.03,1.03,0,0,0,.673-.263l1.053-1.053a.9.9,0,0,0,0-1.316A.936.936,0,0,0,11.463,58.41Z" transform="translate(21.867 447.814)" fill="#374757" opacity="0.6"/><path d="M44.353,27.842a1.03,1.03,0,0,0,.673-.263l1.053-1.053a.93.93,0,0,0-1.316-1.316L43.71,26.263a.921.921,0,0,0,.643,1.579Z" transform="translate(-1.695 471.305)" fill="#374757" opacity="0.6"/><path d="M42.734,43.5a3.97,3.97,0,0,0-.848.088,5.787,5.787,0,0,0-11.2,1.111,3.582,3.582,0,0,0-.556-.058,3.831,3.831,0,1,0,0,7.662h12.6a4.4,4.4,0,0,0,0-8.8Z" transform="translate(10.422 460.851)" fill="#374757" opacity="0.6"/><path d="M30.984,40.783a1.132,1.132,0,0,0-.242.025,1.649,1.649,0,0,0-3.192.317,1.021,1.021,0,0,0-.158-.017,1.092,1.092,0,1,0,0,2.183h3.592a1.254,1.254,0,0,0,0-2.508Z" transform="translate(22.341 466.763)" fill="#fff" opacity="0.5"/></g></svg>
						<b><?php echo esc_html( $global_toggles['seasons_lbl'] ); ?></b>
						<span><?php echo esc_html( $recipe->best_season ); ?></span>
					</div>
				<?php endif; ?>
			</div>
			<div class="dr-print-block-wrap">
				<?php if( isset( $recipe->ingredients ) && ! empty( $recipe->ingredients ) ) : ?>
					<div class="dr-print-block dr-ingredients-wrap">
						<div class="dr-pring-block-header">
							<div class="dr-print-block-title">
								<span><?php echo esc_html( $recipe->ingredient_title ); ?></span>
							</div>
						</div>
						<div class="dr-pring-block-content">
							<?php 
							echo '<ul>';
							$ingredient_string_format = isset( $global_settings['ingredientStringFormat'] ) ? $global_settings['ingredientStringFormat'] : '{qty} {unit} {ingredient} {notes}';
								
								foreach( $recipe->ingredients as $key => $ingre_section ) {
									$section_title = isset( $ingre_section['sectionTitle'] ) ? $ingre_section['sectionTitle'] : '';
									$ingre         = isset( $ingre_section['ingredients'] ) ? $ingre_section['ingredients'] : array();
									
									foreach( $ingre as $ingre_key => $ingredient ) { 			
										$ingredient_qty  = isset( $ingredient['quantity'] ) ? $ingredient['quantity'] : 0;
										$ingredient_unit = isset( $ingredient['unit'] ) ? $ingredient['unit'] : '';
										$unit_text       = ! empty( $ingredient_unit ) ? delicious_recipes_get_unit_text( $ingredient_unit, $ingredient_qty ) : '';
				
										$ingredient_keys = array(
											'{qty}'        => isset( $ingredient['quantity'] ) ? '<span class="ingredient_quantity" data-original="'. $ingredient['quantity'] .'" data-recipe="'. $recipe->ID .'">' . $ingredient['quantity'] . '</span>' : '',
											'{unit}'       => $unit_text,
											'{ingredient}' => isset( $ingredient['ingredient'] ) ? $ingredient['ingredient'] : '',
											'{notes}'      => isset( $ingredient['notes'] ) && ! empty( $ingredient['notes'] ) ? '<span class="ingredient-notes" >(' . $ingredient['notes'] . ')</span>' : '',
										);
										$ingre_string = str_replace( array_keys( $ingredient_keys ), $ingredient_keys, $ingredient_string_format );
									
										echo '<li>';
											echo wp_kses_post( $ingre_string );
										echo '</li>';
									}
								}
								echo '</ul>';
							?>
						</div>
					</div>
				<?php endif; ?>
				<?php if( $recipe->recipe_description ) : ?>
				<div class="dr-print-block dr-description-wrap">
					<div class="dr-pring-block-header">
						<div class="dr-print-block-title">
							<span><?php esc_html_e( 'Description', 'delicious-recipes' ); ?></span>
						</div>
					</div>
					<div class="dr-pring-block-content">
						<?php echo wp_kses_post( $recipe->recipe_description ); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if( isset( $recipe->instructions ) && ! empty( $recipe->instructions ) ) : ?>
			<div id="dr-page3" class="dr-print-page dr-print-instructions">
				<div class="dr-print-block">
					<div class="dr-pring-block-header">
						<div class="dr-print-block-title">
							<span><?php echo esc_html( $recipe->instruction_title ); ?></span>
						</div>
					</div>
					<?php 
						echo '<div class="dr-pring-block-content">';
							echo '<ol>';
								foreach( $recipe->instructions as $key => $intruct_section ) {
									echo '<div class="dr-subtitle">'. esc_html( $intruct_section['sectionTitle'] ) .'</div>';
									if( isset( $intruct_section['instruction'] ) && ! empty( $intruct_section['instruction'] ) ) {
										foreach( $intruct_section['instruction'] as $inst_key => $instruct ) { 
											$instruction_title = isset( $instruct['instructionTitle'] ) ? $instruct['instructionTitle'] : '';
											$instruction       = isset( $instruct['instruction'] ) ? $instruct['instruction'] : '';
											$instruction_notes = isset( $instruct['instructionNotes'] ) ? $instruct['instructionNotes'] : '';
											$instruction_image = isset( $instruct['image'] ) && ! empty( $instruct['image'] ) ? $instruct['image'] : false;
											$instruction_video = isset( $instruct['videoURL'] ) && ! empty( $instruct['videoURL'] ) ? $instruct['videoURL'] : false;
										
											echo '<li>';
												echo esc_html( $instruction_title );
												
												if ( $instruction_image ) {
													$instruct_image = wp_get_attachment_image( $instruction_image, 'full' );
														echo wp_kses_post( $instruct_image );
												}
												
												echo wp_kses_post( $instruction );
												if ( ! empty( $instruction_notes ) ) {
													echo '<div class="dr-list-tips">';
														echo esc_html( $instruction_notes );
													echo '</div>';
												}
											echo '</li>';
										}
									}
								}
							echo '</ol>';
						echo '</div>';
					?>
				</div>
			</div>
		<?php endif; ?>

		<div id="dr-page5" class="dr-print-page dr-print-nutrition">
			<div class="dr-print-block dr-wrp-only-nut">
				<?php delicious_recipes_get_template( 'recipe/recipe-block/nutrition.php' ); ?>
			</div>
			<div class="dr-print-block dr-wrap-notes-keywords">
				<?php if ( ! empty( $recipe->notes ) && $global_toggles['enable_notes'] ) :
					?>
						<div class="dr-note">
							<div class="dr-print-block-title">
								<span><?php echo esc_html( $global_toggles['notes_lbl'] ); ?></span>
							</div>
							<?php echo wp_kses_post( $recipe->notes ); ?>
						</div>
					<?php
				endif;

				if ( ! empty( $recipe->keywords ) && $global_toggles['enable_keywords'] ) :
					?>
						<div class="dr-keywords">
							<span class="dr-meta-title"><?php echo esc_html( $global_toggles['keywords_lbl'] ); ?>:</span>
							<?php echo wp_kses_post( $recipe->keywords ); ?>
						</div>
					<?php
				endif; ?>
			</div>
			<?php if ( $displaySocialSharingInfo && $socials_enabled ) : 
				$recipeShareTitle = isset( $recipe_global['recipeShareTitle'] ) ? $recipe_global['recipeShareTitle'] : '';	
			?>
				<div class="dr-print-cta dr-wrap-social-share">
					<div class="dr-cta-title"><?php echo esc_html( $recipeShareTitle ); ?></div>
					<?php if ( isset( $recipe_global['socialShare'] ) && ! empty( $recipe_global['socialShare'] ) ) : ?>
						<?php foreach( $recipe_global['socialShare'] as $key => $share ) : 
							if ( ! isset( $share['enable']['0'] ) || 'yes' !== $share['enable']['0'] ) {
								continue;
							}    
								?>
								<?php if ( isset( $share['content'] ) && ! empty( $share['content'] ) ) : ?>
                                    <div class="dr-share-content">
                                        <?php echo wp_kses_post( $share['content'] ); ?>
                                    </div>
                                <?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $embedRecipeLink )  :
				$recipe_link_label = isset( $recipe_global['recipeLinkLabel'] ) ? $recipe_global['recipeLinkLabel'] : '';	
			?>
				<div class="dr-print-block-footer">
					<b><?php echo esc_html( $recipe_link_label ); ?></b>
					<span>
						<a href="<?php the_permalink(); ?>" target="_blank"><?php the_permalink(); ?></a>
					</span>
				</div>
			<?php endif; ?>
		</div>

		<div id="dr-page6" class="dr-print-page dr-print-author">
			<?php  
				$authorImage       = isset( $recipe_global['authorImage'] ) ? $recipe_global['authorImage'] : false;
				$authorName        = isset( $recipe_global['authorName'] ) ? $recipe_global['authorName'] : '';
				$authorSubtitle    = isset( $recipe_global['authorSubtitle'] ) ? $recipe_global['authorSubtitle'] : '';
				$authorDescription = isset( $recipe_global['authorDescription'] ) ? $recipe_global['authorDescription'] : '';

				// Social Profiles.
				$author_social_links = apply_filters( 'delicious_recipes_author_social_links', ['facebook','instagram','pinterest','twitter','youtube','snapchat','linkedin'] );

			?>

			<?php if ( $embedAuthorInfo && $authorName ) :
				?>
				<div class="dr-print-block">
					<div class="dr-wrap-author-profile">
						<div class="dr-pring-block-img-wrap">
							<?php if ( $authorImage ) : ?>
								<div class="dr-print-block-img">
									<?php echo wp_kses_post( wp_get_attachment_image( $authorImage ) ); ?>
								</div>
							<?php endif; ?>
							<div class="dr-print-block-header">
								<div class="dr-print-block-title">
									<span><?php echo esc_html( $authorName ); ?></span>
								</div>
								<span class="dr-print-block-subtitle"><?php echo esc_html( $authorSubtitle ); ?></span>
								<div class="dr-print-block-desc">
									<p><?php echo wp_kses_post( $authorDescription ); ?></p>
								</div>
							</div>
						</div>
						<ul class="dr-author-social">
							<?php foreach( $author_social_links as $social ) : 
								$social_link = isset( $recipe_global[$social.'Link'] ) ? trim( $recipe_global[$social.'Link'], '/\\' ) : false;

								if ( $social_link ) :
							?>
									<li>
										<a href="<?php echo esc_url( $social_link ); ?>" target="_blank">
											<img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/print-img/<?php echo esc_html( $social ) ?>.png" alt="">
											<span class="social-name"><?php echo esc_url( $social_link ); ?>/</span>
										</a>
									</li>
							<?php 
								endif;
							endforeach; ?>
						</ul>
					</div>					
				</div>
			<?php endif;

			$thankyouMessage = isset( $recipe_global['thankyouMessage'] ) ? $recipe_global['thankyouMessage'] : false;

			if ( $thankyouMessage ) :
			?>
				<div class="dr-pring-block-content dr-wrap-thankyou">
					<?php echo wp_kses_post( $thankyouMessage ); ?>
				</div>
			<?php endif; 
			
			/**
			 * action hook for additionals.
			 */
			do_action( 'delicious_recipes_print_additionals' );
			?>
		</div>
	</div><!-- .dr-print-outer-wrap -->
	<script type="text/javascript">
		var print_options = document.getElementsByTagName('input');
		for (var i = 0, len = print_options.length; i < len; i++) {
			if ( print_options[i].getAttribute("name") == "print_options"){
				update_print_options( print_options[i] );
			}
		}

		document.addEventListener("click", function (e) {
			update_print_options( e.target );
		});

		function update_print_options( printOpt ){

			if (printOpt.id == "print_options_title" && typeof document.getElementById('dr-print-title') != 'undefined') {
				if ( printOpt.checked ){
					document.getElementById('dr-print-title').style.display = 'block';
				} else {
					document.getElementById('dr-print-title').style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_nutrition" && typeof document.getElementsByClassName('dr-wrp-only-nut')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-wrp-only-nut')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-wrp-only-nut')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_info" && typeof document.getElementsByClassName('dr-ingredient-meta-wrap')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-ingredient-meta-wrap')[0].style.display = 'flex';
				} else {
					document.getElementsByClassName('dr-ingredient-meta-wrap')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_description" && typeof document.getElementsByClassName('dr-description-wrap')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-description-wrap')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-description-wrap')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_images" && typeof document.getElementsByClassName('dr-print-img')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-print-img')[0].style.display = 'block';
					var print_images = document.getElementsByTagName('img');
					for (var i = 0, len = print_images.length; i < len; i++) {
						print_images[i].style.display = 'inline-block';
					}
				} else {
					document.getElementsByClassName('dr-print-img')[0].style.display = 'none';
					var print_images = document.getElementsByTagName('img');
					for (var i = 0, len = print_images.length; i < len; i++) {
						print_images[i].style.display = 'none';
					}
				}
			}

			if (printOpt.id == "print_options_ingredients" && typeof document.getElementsByClassName('dr-ingredients-wrap')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-ingredients-wrap')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-ingredients-wrap')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_instructions" && typeof document.getElementsByClassName('dr-print-instructions')[0] != 'undefined' ) {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-print-instructions')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-print-instructions')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_notes" && typeof document.getElementsByClassName('dr-wrap-notes-keywords')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-wrap-notes-keywords')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-wrap-notes-keywords')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_social-share" && typeof document.getElementsByClassName('dr-wrap-social-share')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-wrap-social-share')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-wrap-social-share')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_author-bio" && typeof document.getElementsByClassName('dr-wrap-author-profile')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-wrap-author-profile')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-wrap-author-profile')[0].style.display = 'none';
				}
			}

			if (printOpt.id == "print_options_thank-you-note" && typeof document.getElementsByClassName('dr-wrap-thankyou')[0] != 'undefined') {
				if ( printOpt.checked ){
					document.getElementsByClassName('dr-wrap-thankyou')[0].style.display = 'block';
				} else {
					document.getElementsByClassName('dr-wrap-thankyou')[0].style.display = 'none';
				}
			}
		}
		const print_props = {
			original_servings: "<?php echo ! empty( $recipe->no_of_servings )  ? esc_attr( $recipe->no_of_servings ) : 1; ?>",
			recipe: "<?php echo esc_attr( $recipe->ID ); ?>"
 		}
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . '/assets/public/js/math.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo esc_url( plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ) . '/assets/public/js/recipe-print.js'; ?>" /></script>
</body>
</html>