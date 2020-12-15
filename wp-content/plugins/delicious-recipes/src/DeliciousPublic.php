<?php
/**
 * Delecious recipes public functions handler class.
 * 
 * @package Delicious_Recipes
 */
namespace WP_Delicious;

defined( 'ABSPATH' ) || exit;

/**
 * Handle the public functions for frontend of Delicious_Recipes plugin
 * 
 * @since 1.0.0
 */
class DeliciousPublic {
    /**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
    }
    
    /**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {
		
		// Initialize hooks.
		$this->init_hooks();
		$this->includes();

		// Allow 3rd party to remove hooks.
		do_action( 'wp_delicious_public_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'init', array( 'Delicious_Recipes_Shortcodes', 'init' ), 99999999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_scripts' ) );

		// Comments section.
		add_action( 'comment_form_logged_in_after', array( $this, 'dr_comment_form_rating_fields' ) );
		add_action( 'comment_form_after_fields', array( $this, 'dr_comment_form_rating_fields' ) );
		add_action( 'comment_post', array( $this, 'dr_save_comment_rating' ) );
		// add_filter( 'preprocess_comment', array( $this, 'dr_rating_require_rating' ) );
		add_filter( 'comment_text', array( $this, 'dr_add_comment_review_after_text' ) );

		// Posts per page value for recipe archives.
		add_filter( 'pre_get_posts', array( $this, 'recipe_archive_posts_per_page' ) );

		// Display Recipe posts on Home Page. 
		add_action( 'pre_get_posts', array( $this, 'recipe_posts_on_homepage' ) );

		// Display Recipe posts on author archive. 
		add_action( 'pre_get_posts', array( $this, 'recipe_posts_on_archive' ) );

		// Display Archive title.
		add_filter( 'get_the_archive_title', array( $this, 'recipe_archive_title' ), 99 );

		// Display Archive Description.
		add_filter( 'get_the_archive_description', array( $this, 'recipe_archive_description' ), 99 );
		// Add dynamic CSS.
		add_action( 'wp_head', array( $this, 'load_dynamic_css' ), 99 );

		// Add random links for surprise me nav menu
		add_filter( 'wp_nav_menu_objects', array( $this, 'surprise_me_nav_menu_objects' ) );
	}

	/**
	 * Modifies the random recipe link for Surprise Me nav menu
	 *
	 * @since 1.1.1
	 *
	 * @param array $items
	 * @return array modified menu items
	 */
	public function surprise_me_nav_menu_objects( $items ) {

		$cat = get_theme_mod( 'exclude_categories' );
        if( $cat ) $cat = array_diff( array_unique( $cat ), array('') );

        $args = array(
            'post_type'           => DELICIOUS_RECIPE_POST_TYPE,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'category__not_in'    => $cat,
            'orderby'             => 'rand',
            'posts_per_page'      => '1',
        );
        
		if ( ! empty( $items ) && is_array( $items ) ) {
			foreach ( $items as $item ) {
				if( "#dr_surprise_me"  === $item->url ) {
					if ( $options = get_post_meta( $item->ID, '_dr_menu_item', true ) ) {
						$title = $item->post_title;
						$icon  = "fas fa-random";
						if( ! $options['show_text_icon'] && $options['show_icon'] ) {
							$title = sprintf( '<i class="%1$s"></i>', $icon );
						}
						if( $options['show_text_icon'] || ( $options['show_icon'] && $options['show_text'] ) 
						|| ( $options['show_text_icon'] && $options['show_icon'] && $options['show_text'] )
						|| ( $options['show_text_icon'] && $options['show_icon'] ) ) {
							$title = sprintf( '%1$s<span style="margin-%2$s:0.3em;">%3$s</span>', '<i class="'.$icon.'"></i>', is_rtl() ? 'right' : 'left', esc_html( $title ) );
						} 

						if( $options['show_posts'] ) {
							$args['post_type'] = array( DELICIOUS_RECIPE_POST_TYPE, 'post' );
						}

						$random_recipes = get_posts( $args );

						if( ! empty( $random_recipes ) ) {
							$item->title = $title;
							$item->url   = get_permalink( $random_recipes[0]->ID );
						}
					}
				}
			}
		}

		return $items;
	}

	/**
	 * Includes
	 *
	 * @return void
	 */
	private function includes() {
		if ( $this->is_request( 'frontend' ) ) {
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-templates-loader.php';
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-shortcodes.php';
			require plugin_dir_path( __FILE__ ) . '/classes/class-delicious-recipes-template-hooks.php';
		}
	}

	/**
	 * Load Frontend Scripts
	 *
	 * @return void
	 */
	public function load_frontend_scripts() {

		$asset_script_path = '/min/';
		$min_prefix    = '.min';

		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$asset_script_path = '/';
			$min_prefix    = '';
		}

		// Fonts Enqueue.
		wp_enqueue_style( 'google-font-questrial', 'https://fonts.googleapis.com/css2?family=Questrial&display=swap' );
		wp_enqueue_style( 'google-font-noto-serif', 'https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap' );
		wp_enqueue_style( 'google-font-cookie', 'https://fonts.googleapis.com/css2?family=Cookie&display=swap' );

		wp_register_script( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/select2/select2.min.js', array( 'jquery' ), '4.0.13', true );
		wp_enqueue_style( 'select2', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/select2/select2.min.css', array(), '4.0.13', 'all' );

		wp_enqueue_style( 'magnific-popup', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/magnific-popup/magnific-popup.min.css', array(), '1.1.0', 'all' );

		wp_enqueue_style( 'delicious-recipes-single', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/public/css' . $asset_script_path . 'delicious-recipes-public' . $min_prefix . '.css', array(), DELICIOUS_RECIPES_VERSION, 'all' );

		wp_enqueue_style( 'jquery-rateyo', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/jquery-rateyo/jquery.rateyo.min.css', array(), '2.3.2', 'all' );
		wp_enqueue_script( 'jquery-rateyo',  plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/jquery-rateyo/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', true );

		wp_enqueue_style( 'owl-carousel', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/owl-carousel/owl.carousel.min.css', array(), '2.3.4', 'all' );
		wp_enqueue_script( 'owl-carousel',  plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'magnific-popup', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/magnific-popup/magnic-popup.min.js', array( 'jquery' ), '1.1.0', true );

		wp_enqueue_script( 'math-min', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/public/js/math.min.js', array( 'jquery' ), '5.1.2', true );
		
		wp_enqueue_script( 'delicious-recipes-single', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/public/js' . $asset_script_path . 'delicious-recipes-public' . $min_prefix . '.js', array( 'jquery', 'wp-util', 'select2' ), DELICIOUS_RECIPES_VERSION, true );
		
		$delicious_recipes = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'delicious-recipes-single', 'delicious_recipes', $delicious_recipes );

		wp_enqueue_script( 'all', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/fontawesome/all.min.js', array( 'jquery' ), '5.14.0', true );

		wp_enqueue_script( 'pintrest', plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/lib/pintrest/pintrest.min.js', array( 'jquery' ), '5.14.0', true  );
	}
	
	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Add rating field to comment form;
	 *
	 * @return void
	 */
	public function dr_comment_form_rating_fields() {
		if ( is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$global_toggles  = delicious_recipes_get_global_toggles_and_labels();

			if( $global_toggles['enable_ratings'] ) :
				?>
					<label for="rating"><?php echo esc_html( $global_toggles['ratings_lbl'] ); ?></label>
					<fieldset id="dr-comment-rating-field" class="dr-comment-rating">
						<div class="dr-comment-form-rating"></div>
						<input type="hidden" required="required" name="rating" value="0" >
					</fieldset>
				<?php
			endif;
		}
	}

	/**
	 * Save comment form.
	 *
	 * @return void
	 */
	public function dr_save_comment_rating( $comment_id ) {
		if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) ) {
			$rating = floatval( $_POST['rating'] );

			add_comment_meta( $comment_id, 'rating', $rating );
		}
	}

	/**
	 * Comment Text.
	 *
	 * @param [type] $comment_text
	 * @return void
	 */
	public function dr_add_comment_review_after_text( $comment_text ) {
		if ( ! is_singular( DELICIOUS_RECIPE_POST_TYPE ) ) {
			return $comment_text;
		}
		$global_toggles  = delicious_recipes_get_global_toggles_and_labels();
		$rating          = get_comment_meta( get_comment_ID(), 'rating', true );
		if ( $rating && $global_toggles['enable_ratings'] ) {
			$stars = '<p class="dr-star-rating">';
			$stars .= '<div data-rateyo-read-only="true" data-rateyo-rating="'. esc_attr( $rating ) .'" class="dr-comment-form-rating"></div>';
			$stars .= '</p>';
			$comment_text = $comment_text . $stars;
			return $comment_text;
		} else {
			return $comment_text;
		}
	}

	/**
	 * Require Ratings.
	 *
	 * @param [type] $commentdata
	 * @return void
	 */
	function dr_rating_require_rating( $commentdata ) {

		if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
		wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'delicious-recipes' ) );

		return $commentdata;
	}

	/**
	 * Filter posts per page value for recipe.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_archive_posts_per_page( $query ) {
		if ( ! is_admin() && ( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) || is_recipe_taxonomy() ) ) {

			$options                = delicious_recipes_get_global_settings();
			$default_posts_per_page = ( isset ( $options['recipePerPage'] ) && ( !empty( $options['recipePerPage'] ) ) ) ? $options['recipePerPage'] : get_option( 'posts_per_page' );

			if ( $query->is_main_query() ) {
				$query->set( 'posts_per_page', $default_posts_per_page );
				return $query;
			}
		}
	}

	/**
	 * Display recipe posts as post on Homepage.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_posts_on_homepage( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			if ( $query->is_home() ) {

				// Get global toggles.
				$global_toggles = delicious_recipes_get_global_toggles_and_labels();

				if( ! $global_toggles['display_recipes_on_home_page'] ) {
					return;
				}

				$post_type = $query->get( 'post_type' );
				if( $post_type == '' || $post_type == 'post' ) {
					$post_type = array( 'post', DELICIOUS_RECIPE_POST_TYPE );
				}
				else if( is_array( $post_type ) ) {
					if( in_array( 'post', $post_type ) && ! in_array( DELICIOUS_RECIPE_POST_TYPE, $post_type ) ) {
						$post_type[] = DELICIOUS_RECIPE_POST_TYPE;
					}
				}

				$query->set( 'post_type', $post_type );

			}
			remove_action( 'pre_get_posts', 'recipe_posts_on_homepage' );
		}
	}

	/**
	 * Recipe posts only in archive.
	 *
	 * @param [type] $query
	 * @return void
	 */
	public function recipe_posts_on_archive( $query ) {
		$global_settings = delicious_recipes_get_global_settings();
		$recipe_author   = isset( $global_settings['recipeAuthor'] ) && ! empty( $global_settings['recipeAuthor'] ) ? $global_settings['recipeAuthor'] : false;

		if( $recipe_author && is_author() && empty( $query->query_vars['suppress_filters'] ) ) {
			$query->set( 'post_type', array(
					'post', 
					DELICIOUS_RECIPE_POST_TYPE
				));
			return $query;
		}
	}

	/**
	 * Recipe archive title.
	 *
	 * @param [type] $title
	 * @return void
	 */
	public function recipe_archive_title( $title ) {
		$global_settings = delicious_recipes_get_global_settings();
		$archive_title = isset( $global_settings['archiveTitle'] ) && ! empty( $global_settings['archiveTitle'] ) ? $global_settings['archiveTitle'] : __('Recipe Index', 'delicious-recipes');

		if( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$title = sprintf( esc_html( $archive_title ), post_type_archive_title( '', false ) );
		}
		return $title;
	}

	/**
	 * Recipe archive description.
	 *
	 * @param [type] $title
	 * @return void
	 */
	public function recipe_archive_description( $description ) {
		$global_settings = delicious_recipes_get_global_settings();
		$archive_description = isset( $global_settings['archiveDescription'] ) && ! empty( $global_settings['archiveDescription'] ) ? $global_settings['archiveDescription'] : '';

		if( is_post_type_archive( DELICIOUS_RECIPE_POST_TYPE ) ) {
			$description = $archive_description;
		}
		return wpautop( wp_kses_post( $description ) );
	}

	/**
	 * Load Dynamic CSS values.
	 *
	 * @return void
	 */
	public function load_dynamic_css() {
		$recipe_templates = [
			'templates/pages/recipe-courses.php',
			'templates/pages/recipe-cooking-methods.php',
			'templates/pages/recipe-cuisines.php',
			'templates/pages/recipe-keys.php',
			'templates/pages/recipe-tags.php'
		];

		if ( is_recipe() || is_recipe_taxonomy() || is_archive( DELICIOUS_RECIPE_POST_TYPE ) 
		|| is_page_template( $recipe_templates ) || is_recipe_search() || is_recipe_block() || is_recipe_shortcode() ) {
			delicious_recipes_get_template( 'global/dynamic-css.php' );
		}
	}

}
