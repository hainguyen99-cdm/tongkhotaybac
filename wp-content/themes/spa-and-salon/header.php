<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Spa_and_Salon
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
	<?php wp_body_open(); ?>
    
    <div class="mobile-nav">
		<button class="toggle-button">
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
			<span class="toggle-bar"></span>
		</button>
		<div class="mobile-nav-wrap">
			<nav class="main-navigation" id="mobile-navigation"  role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'spa-and-salon' ); ?></a>
		<header id="masthead" class="site-header <?php if( !is_page_template( 'template-home.php' ) ) { echo 'header-inner'; }  ?>" role="banner" itemscope itemtype="https://schema.org/WPHeader">
			<div class="container">
				<div class="header-t">

					<?php $spa_and_salon_ph = get_theme_mod( 'spa_and_salon_ph', esc_html__( '01-234566789', 'spa-and-salon' ) );

					$social_links = get_theme_mod( 'spa_and_salon_social_ed_header' );
					if( $social_links ) do_action( 'spa_and_salon_social_link' ); 

					if( $spa_and_salon_ph ){ ?>
						<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $spa_and_salon_ph ) ); ?>" class="tel-link">
							<span class="fa fa-phone"></span>
							<?php echo esc_html( $spa_and_salon_ph ); ?></a>
						<?php } ?>
					</div>
					<div class="header-b">
						<div class="site-branding" itemscope itemtype="https://schema.org/Organization">
							<?php 
							if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
								the_custom_logo();
							} 
							?>
							<?php if ( is_front_page() ) : ?>
								<h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php endif;
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
									<?php
								endif; ?>
							</div> <!-- .site-branding -->

							<nav class="main-navigation" id="site-navigation"  role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
							</nav><!-- #site-navigation -->

						</div>
					</div>
				</header><!-- #masthead -->

				<?php if( !( is_front_page() || is_page_template( 'template-home.php' ) || is_404() ) ){ ?>
					<div class="breadcrumbs">
						<div class="container">
							<?php do_action( 'spa_and_salon_breadcrumbs' ); ?>
						</div>
					</div>
				<?php } 
				echo '<div id="acc-content"><!-- done for accessiblity purpose -->';
				$enabled_sections = spa_and_salon_get_sections();
				if( is_home() || ! $enabled_sections || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ) {
					echo '<div class="wrapper">';
					echo '<div class="container">';
					echo '<div id="content" class="site-content">';

					if( is_search() ){ echo '<div class="row">'; }
				}
