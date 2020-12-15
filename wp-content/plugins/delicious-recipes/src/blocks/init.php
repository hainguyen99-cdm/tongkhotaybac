<?php
/**
 * Init Gutenberg Blocks
 * 
 * @package Delicious_Recipes
 */
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
// add_action( 'enqueue_block_assets', 'delicious_recipes_gb_block_assets' );
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function delicious_recipes_gb_block_assets() { // phpcs:ignore
	// Styles.
	wp_enqueue_style(
		'delicious-recipes-gb-style-css', // Handle.
		plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . '/assets/blocks/blocks.css', // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}


add_action( 'enqueue_block_editor_assets', 'delicious_recipes_gb_editor_assets' );
/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function delicious_recipes_gb_editor_assets() { // phpcs:ignore
	$global_settings = delicious_recipes_get_global_settings();
	// Scripts.
	wp_enqueue_script(
		'delicious-recipes-gb-block-js', // Handle.
		plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/admin/build/blocks.js',
		array( 'jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		rand(),
		true
	);
	wp_localize_script( 'delicious-recipes-gb-block-js', 'delrcp', array( 
		'setting_options' => $global_settings, 
		'ajaxURL' => admin_url( 'admin-ajax.php' ),
		'pluginURL' => DELICIOUS_RECIPES_PLUGIN_URL
	) );
	
	// Styles.
	wp_enqueue_style(
		'delicious-recipes-gb-style-css', // Handle.
		plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) . 'assets/blocks/blocks.css', // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}

add_filter( 'block_categories', 'delicious_recipes_block_categories', 10, 2 );
/**
 * Register new Block Category
 */
function delicious_recipes_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'delicious-recipes',
				'title' => __( 'Delicious Recipes', 'delicious-recipes' ),
				// 'icon'  => '',
			),
		)
	);
}

// List by Trip Types Block.
require_once dirname( __FILE__ ) . '/handpicked-recipes/block.php';
require_once dirname( __FILE__ ) . '/recipe-by-tax/block.php';
require_once dirname( __FILE__ ) . '/recipe-card/block.php';
// require_once dirname( __FILE__ ) . '/dynamic-blocks/dynamic-blocks-init.php';
