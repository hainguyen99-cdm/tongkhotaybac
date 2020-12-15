<?php
/**
 * Class file for the dynamic custom css and scripts.
 *
 * @package trending-mag
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Trending_Mag_Dynamic_Assets' ) ) {

	/**
	 * Class for generating dynamic css for the theme.
	 *
	 * @see Trending_Mag_Load_Assets
	 */
	class Trending_Mag_Dynamic_Assets extends Trending_Mag_Load_Assets {

		/**
		 * Theme primary color.
		 *
		 * @var string
		 */
		private $primary_color = '#EA2027';

		/**
		 * Theme secondary color.
		 *
		 * @var string
		 */
		private $secondary_color = '#F79F1F';

		/**
		 * Initialize class.
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'wp_head', array( $this, 'in_header' ), 50 );
		}

		/**
		 * All the codes that are need to be executed in wp_head.
		 */
		public function in_header() {
			$this->primary_color   = sanitize_hex_color( trending_mag_get_theme_mod( 'colors', 'colors', 'primary_color' ) );
			$this->secondary_color = sanitize_hex_color( trending_mag_get_theme_mod( 'colors', 'colors', 'secondary_color' ) );
			$this->dynamic_styles();
		}

		/**
		 * Generates the css with escaped css value.
		 */
		public function render_css( $selector, $property, $value ) {
			$css = $selector . '{ ' . $property . ':' . esc_attr( $value ) . '; }';
			return $css;
		}

		/**
		 * Minifies the css for performance optimization.
		 */
		public function minify_css( $custom_css ) {
			$custom_css = preg_replace( '/\/\*((?!\*\/).)*\*\//', '', $custom_css );
			$custom_css = preg_replace( '/\s{2,}/', ' ', $custom_css );
			$custom_css = preg_replace( '/\s*([:;{}])\s*/', '$1', $custom_css );
			$custom_css = preg_replace( '/;}/', '}', $custom_css );
			return $custom_css;
		}


		public function gradient_colors() {
			$primary_color   = $this->primary_color;
			$secondary_color = $this->secondary_color;

			$selectors = '
			.rm-header-s1 .bottom-header,
			.entry-cats ul li a,
			.widget-title.widget-title-d1
			';

			/**
			 * The value is already being escaped.
			 */
			$gradient_colors = $this->render_css(
				$selectors,
				'background',
				'linear-gradient(to right, ' . $primary_color . ' 0%, ' . $secondary_color . ' 100%)'
			);

			return $gradient_colors;
		}

		public function primary_colors() {
			$primary_color = $this->primary_color;

			$color_selector = '
			a:hover,
			.editor-entry a,
			.widget_rss ul li a,
			.widget_meta a:hover,
			.rm-featured-cats a:hover,
			.entry-metas ul li a:hover,
			#gc-backtotop span.caption,
			.widget_archive a:hover,
			.widget_categories a:hover,
			.widget_recent_entries a:hover,
			.widget_product_categories a:hover,
			.widget_rss li a:hover,
			.widget_pages li a:hover,
			.widget_nav_menu li a:hover,
			.rm-custom-cats-widget a:hover span,
			.rm-banner-s2 .entry-cats ul li a:hover,
			.rm-banner-s3 .entry-cats ul li a:hover,
			.comments-area .comment-body .reply a:hover,
			.comments-area .comment-body .reply a:focus,
			.woocommerce-widget-layered-nav ul li a:hover,
			.rm-banner-s3 .owl-carousel .owl-nav button:hover,
			.archive-page-wrap .mega-archive-box .rm-breadcrumb ul li a:hover,
			.rm-pagination nav.pagination .nav-links .page-numbers.next:hover,
			.rm-pagination nav.pagination .nav-links .page-numbers.prev:hover,
			.single-page-s2 .single-s2-top-inner .entry-metas ul li a:hover,
			.single-page-s2 .single-s2-top-inner .entry-cats ul li a:hover,
			.single-page-s3 .single-s3-top-inner .entry-metas ul li a:hover,
			.single-page-s3 .single-s3-top-inner .entry-cats ul li a:hover,
			#rm-backtotop span.caption:hover,
			.post-navigation .nav-previous a, .post-navigation .nav-next a
			';

			$bg_selector = '
			.rm-ticker-widget-area .ticker-area-inner .text_widget .nt_wrapper .nt_title:before,
			button,
			input[type=button],
			input[type=reset],
			input[type=submit],
			.rm-button-primary:hover,
			.calendar_wrap caption,
			.is-post-format span,
			.archive-page-wrap .cat-post-count,
			.rm-featured-cats .cat-post-count,
			.rm-banner-s1 .owl-dots .owl-dot.active,
			.rm-banner-s2 .owl-carousel .owl-nav button,
			.rm-social-widget .social-icons ul li a:hover,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
			.jetpack_subscription_widget input[type=submit],
			.secondary-widget-area .rm-instagram-widget .follow-permalink a:hover,
			.rm-footer-widget .widget-title,
			.secondary-widget-area-content .widget-title
			';

			$border_bottom_selector = '
			.widget-title.widget-title-d2
			';

			/**
			 * The value is already being escaped.
			 */
			$primary_colors = $this->render_css(
				$color_selector,
				'color',
				$primary_color . '!important'
			);

			$primary_colors .= $this->render_css(
				$bg_selector,
				'background-color',
				$primary_color . '!important'
			);

			$primary_colors .= $this->render_css(
				$border_bottom_selector,
				'border-bottom-color',
				$primary_color . '!important'
			);

			$primary_colors .= $this->render_css(
				'.slick-arrow:before',
				'border-right-color',
				$primary_color . '!important'
			);

			$primary_colors .= $this->render_css(
				'.next.slick-arrow:before',
				'border-left-color',
				$primary_color . '!important'
			);
			return $primary_colors;
		}

		/**
		 * Prints the generated css.
		 */
		public function get_css() {

			$fonts        = trending_mag_get_fonts();
			$heading_font = trending_mag_get_theme_mod( 'general_options', 'typography', 'heading_font' );
			$content_font = trending_mag_get_theme_mod( 'general_options', 'typography', 'content_font' );

			$heading_font_family = ! empty( $fonts[ $heading_font ] ) ? $fonts[ $heading_font ] : '';
			$content_font_family = ! empty( $fonts[ $content_font ] ) ? $fonts[ $content_font ] : '';

			$headings = 'q,h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,blockquote';
			$contents = 'body,button,input,select,textarea';

			$custom_css  = $this->render_css( '.page-wrap', 'background', 'unset' );
			$custom_css .= $this->render_css( '.rm-logo-block .rm-container .site-branding-text', 'line-height', trending_mag_get_theme_mod( 'title_tagline', 'title_tagline', 'line_height' ) );
			$custom_css .= $this->render_css( '#webticker', 'font', 'unset !important' );
			$custom_css .= $this->render_css( $headings, 'font-family', $heading_font_family );
			$custom_css .= $this->render_css( $contents, 'font-family', $content_font_family );

			$custom_css .= $this->gradient_colors();
			$custom_css .= $this->primary_colors();

			echo $this->minify_css( apply_filters( 'trending_mag_dynamic_css', $custom_css ) ); // phpcs:ignore
		}

		/**
		 * Style tag for the dynamic css styles.
		 * The other css fixes are below our dynamic styles.
		 */
		public function dynamic_styles() {
			?>
			<style id="<?php echo esc_attr( $this->handle ); ?>-dynamic-styles-<?php echo esc_attr( $this->theme_version ); ?>">
				<?php $this->get_css(); ?>
				.entry-cats ul li a:hover {
					color: #ffffff !important;
				}
				.mastheader .search-trigger, .mastheader .canvas-trigger{
					background: none !important;
				}
			</style>
			<?php
		}

	}

	new Trending_Mag_Dynamic_Assets();
}
