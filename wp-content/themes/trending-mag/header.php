<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php

	/**
	 * Hook - wp_body_open.
	 *
	 * This hook is generally used by the plugin or child theme developers.
	 */
	do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

	?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'trending-mag' ); ?></a>

	<div class="page-wrap">

		<header class="mastheader rm-header-s1">

			<div class="header-inner">

				<?php

				get_template_part( 'template-parts/header/block', 'top-bar' );

				get_template_part( 'template-parts/header/block', 'logo' );

				get_template_part( 'template-parts/header/block', 'bottom-header' );
				?>

			</div><!-- // header-inner -->

		</header><!-- // mastheader rm-header-s1 -->

		<?php
		get_template_part( 'template-parts/header/block', 'sidebar-toggle' );

