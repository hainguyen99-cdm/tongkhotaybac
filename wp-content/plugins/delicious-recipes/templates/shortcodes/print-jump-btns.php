<?php
/**
 * The template for displaying recipe print and jump to recipe block.
 *
 * This template can be overridden by copying it to yourtheme/delicious-recipes/print-recipe.php.
 *
 * HOWEVER, on occasion WP Delicious will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://wpdelicious.com/docs/template-structure/
 * @package Delicious_Recipes/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();
?>
    <div class="dr-buttons">
        <?php if ( $global_toggles['enable_jump_to_recipe'] ) : ?>
            <a href="#dr-recipe-meta-main" class="dr-btn-link dr-btn1"><?php echo esc_html( $global_toggles['jump_to_recipe_lbl'] ); ?><svg xmlns="http://www.w3.org/2000/svg" width="9.647" height="14.193" viewBox="0 0 9.647 14.193"><g transform="translate(8.94 0.5) rotate(90)"><path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1"/><path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1"/></g></svg></a>
        <?php endif; ?>

        <?php if ( $global_toggles['enable_jump_to_video'] ) : ?>
            <a href="#dr-video-gallery" class="dr-btn-link dr-btn1"><i class="fas fa-play"></i><?php echo esc_html( $global_toggles['jump_to_video_lbl'] ); ?></a>
        <?php endif; ?>

        <?php 
            if ( $global_toggles['enable_print_recipe'] ) {
                delicious_recipes_get_template_part( 'recipe/print', 'btn' ); 
            }
        ?>
    </div>
<?php

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */