<?php
/**
 * Loads all the styles and scripts.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Trending_Mag_Load_Assets' ) ) {

	/**
	 * Loads all the styles and scripts.
	 */
	class Trending_Mag_Load_Assets {

		/**
		 * Current version.
		 *
		 * @var string
		 */
		public $theme_version;

		/**
		 * Assets handle.
		 *
		 * @var string
		 */
		public $handle;

		/**
		 * Whether or not to use minified version.
		 *
		 * @var bool
		 */
		public $use_minified;

		/**
		 * File suffix.
		 *
		 * @var string
		 */
		public $suffix;

		/**
		 * Initialize class.
		 */
		public function __construct() {
			$this->theme_version = wp_get_theme()->get( 'Version' );
			$this->handle        = wp_get_theme()->get( 'TextDomain' );
			$this->use_minified  = defined( 'SCRIPT_DEBUG' ) && ! SCRIPT_DEBUG;
			$this->suffix        = $this->use_minified ? '.min' : '';

			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_assets' ) );
		}

		/**
		 * Load styles and scripts for frontend.
		 */
		public function frontend_assets() {
			$this->frontend_styles();
			$this->frontend_scripts();
		}

		/**
		 * Register and enqueue all the frontend css and stylesheets.
		 */
		public function frontend_styles() {

			$root_uri = get_template_directory_uri();

			$heading_font = trending_mag_get_theme_mod( 'general_options', 'typography', 'heading_font' );
			$content_font = trending_mag_get_theme_mod( 'general_options', 'typography', 'content_font' );

			// Fonts.
			wp_enqueue_style( "{$this->handle}-fonts-headings", "https://fonts.googleapis.com/css?family={$heading_font}", array(), '1.0.0', 'all' );
			wp_enqueue_style( "{$this->handle}-fonts-contents", "https://fonts.googleapis.com/css?family={$content_font}", array(), '1.0.0', 'all' );

			// Styles.
			wp_enqueue_style( "{$this->handle}-stylesheet", get_stylesheet_uri(), array(), $this->theme_version, 'all' );
			wp_enqueue_style( "{$this->handle}-main", "{$root_uri}/assets/dist/css/main-style{$this->suffix}.css", array(), $this->theme_version, 'all' );
		}

		/**
		 * Register and enqueue all the frontend scripts.
		 */
		public function frontend_scripts() {

			$root_uri = get_template_directory_uri();

			if ( is_singular() ) {
				wp_enqueue_script( 'comment-reply' );
			}

			wp_enqueue_script( "{$this->handle}-navigation", "{$root_uri}/assets/src/js/libraries/navigation{$this->suffix}.js", array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( "{$this->handle}-slick", "{$root_uri}/assets/src/js/libraries/slick{$this->suffix}.js", array( 'jquery' ), '1.8.0', true );
			wp_enqueue_script( "{$this->handle}-theia-sticky-sidebar", "{$root_uri}/assets/src/js/libraries/theia-sticky-sidebar{$this->suffix}.js", array( 'jquery' ), 'v1.7.0', true );
			wp_enqueue_script( "{$this->handle}-webticker", "{$root_uri}/assets/src/js/libraries/webticker{$this->suffix}.js", array( 'jquery' ), '2.2.0', true );

			wp_enqueue_script( "{$this->handle}-custom", "{$root_uri}/assets/src/js/custom/custom-scripts{$this->suffix}.js", array( 'jquery' ), $this->theme_version, true );

		}
	}

	new Trending_Mag_Load_Assets();

}
