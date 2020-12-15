<?php
/**
 * Spa and Salon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Spa_and_Salon
 */

$spa_and_salon_theme_data = wp_get_theme();
if( ! defined( 'SPA_AND_SALON_THEME_VERSION' ) ) define ( 'SPA_AND_SALON_THEME_VERSION', $spa_and_salon_theme_data->get( 'Version' ) );
if( ! defined( 'SPA_AND_SALON_THEME_NAME' ) ) define( 'SPA_AND_SALON_THEME_NAME', $spa_and_salon_theme_data->get( 'Name' ) );
if( ! defined( 'SPA_AND_SALON_THEME_TEXTDOMAIN' ) ) define( 'SPA_AND_SALON_THEME_TEXTDOMAIN', $spa_and_salon_theme_data->get( 'TextDomain' ) );

if ( ! function_exists( 'spa_and_salon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function spa_and_salon_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Spa and Salon, use a find and replace
	 * to change 'spa-and-salon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'spa-and-salon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'spa-and-salon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
        'status',
        'audio', 
        'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'spa_and_salon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	/* Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );

	// Custom Image Size
	set_post_thumbnail_size( 571, 373, true );
	add_image_size( 'spa-and-salon-banner', 1920, 967, true );
    add_image_size( 'spa-and-salon-blog', 780, 437, true );
    add_image_size( 'spa-and-salon-with-sidebar', 846, 515, true );
    add_image_size( 'spa-and-salon-without-sidebar', 1170, 610, true );
    add_image_size( 'spa-and-salon-featured-block', 380, 226, true );
    add_image_size( 'spa-and-salon-recent-post', 65, 65, true );
    add_image_size( 'spa-and-salon-testmonial', 380, 481, true);
    add_image_size( 'spa-and-salon-testmonial-thumb', 160, 159, true);
    add_image_size( 'spa-and-salon-service', 380, 225, true);
    add_image_size( 'spa-and-salon-welcome-note',547, 293, true );
    add_image_size( 'spa-and-salon-schema',600, 60, true );

}
endif;
add_action( 'after_setup_theme', 'spa_and_salon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spa_and_salon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spa_and_salon_content_width', 780 );
}
add_action( 'after_setup_theme', 'spa_and_salon_content_width', 0 );


/**
* Adjust content_width value according to template.
*
* @return void
*/
function spa_and_salon_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = spa_and_salon_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1180;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1180;
	}

}
add_action( 'template_redirect', 'spa_and_salon_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spa_and_salon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'spa-and-salon' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'spa-and-salon' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'spa-and-salon' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'spa-and-salon' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'spa_and_salon_widgets_init' );

if( ! function_exists( 'spa_and_salon_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function spa_and_salon_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css' . $build . '/slick' . $suffix . '.css' );
    wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri().'/css' . $build . '/perfect-scrollbar' . $suffix . '.css' );
	wp_enqueue_style( 'spa-and-salon-google-fonts', spa_and_salon_fonts_url() );
	wp_enqueue_style( 'spa-and-salon-style', get_stylesheet_uri(), array(), SPA_AND_SALON_THEME_VERSION );

	if( spa_and_salon_woocommerce_activated() ) 
    wp_enqueue_style( 'spa-and-salon-woocommerce-style', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array('spa-and-salon-style'), SPA_AND_SALON_THEME_VERSION );

  	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
  	wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js' . $build . '/slick' . $suffix . '.js', array('jquery'), '2.6.0', true );
    wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri(). '/js' . $build . '/perfect-scrollbar' . $suffix . '.js', array('jquery'), SPA_AND_SALON_THEME_VERSION, true  );
	wp_enqueue_script( 'spa-and-salon-js', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), SPA_AND_SALON_THEME_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'spa_and_salon_scripts' );

if( ! function_exists( 'spa_and_salon_admin_scripts' ) ) :
/**
 * Addmin scripts
*/
function spa_and_salon_admin_scripts() {
	wp_enqueue_style( 'spa-and-salon-admin-style',get_template_directory_uri().'/inc/css/admin.css', SPA_AND_SALON_THEME_VERSION, 'screen' );
}
endif;
add_action( 'admin_enqueue_scripts', 'spa_and_salon_admin_scripts' );


if( ! function_exists( 'spa_and_salon_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function spa_and_salon_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'spa_and_salon_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'spa-and-salon' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'spa-and-salon' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=spa-and-salon-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'spa-and-salon' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?spa_and_salon_admin_notice=1"><?php esc_html_e( 'Dismiss', 'spa-and-salon' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'spa_and_salon_admin_notice' );

if( ! function_exists( 'spa_and_salon_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function spa_and_salon_update_admin_notice(){
    if ( isset( $_GET['spa_and_salon_admin_notice'] ) && $_GET['spa_and_salon_admin_notice'] = '1' ) {
        update_option( 'spa_and_salon_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'spa_and_salon_update_admin_notice' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extra.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Featured Post Widget
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Popular Post Widget
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 * Social Links Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/info.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Load plugin for right and no sidebar
 */
if( spa_and_salon_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';