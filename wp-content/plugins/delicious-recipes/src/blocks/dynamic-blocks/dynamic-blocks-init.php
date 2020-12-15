<?php
/**
 * Init dynamic blocks.
 * 
 * @package Delicious_Recipes/SRC/BLOCKS
 */
// ===== Block Dynamic recipe card. ======== //
require_once dirname( __FILE__ ) . '/class-delicious-dynamic-recipe-card.php';
$dynm_recipe_card = new Delicious_Dynamic_Recipe_Card();
$dynm_recipe_card->register_hooks();

// ===== Block Dynamic instructions. ======== //