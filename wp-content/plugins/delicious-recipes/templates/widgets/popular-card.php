<?php
/**
 * The template for displaying recipe content in card layout for widgets.
 *
 * This template can be overridden by copying it to yourtheme/delicious-recipes/widgets/popular-card.php.
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

global $recipe;
$img_size = apply_filters( 'popular_card_img_size', 'recipe-feat-tall' );

?>
<li>
    <div class="dr-fav-recipe-fig">
        <a href="<?php echo esc_url( $recipe->permalink ); ?>">
            <?php if( $recipe->thumbnail ) : 
                the_post_thumbnail( $img_size ); 
            else:
                delicious_recipes_get_fallback_svg( $img_size );
            endif; ?>
        </a>
        <?php if ( ! empty( $recipe->recipe_keys ) ) : ?>
            <span class="dr-category">
                <?php
                    foreach( $recipe->recipe_keys as $recipe_key ) {
                        $key              = get_term_by( 'name', $recipe_key, 'recipe-key' );
                        $recipe_key_metas = get_term_meta( $key->term_id, 'dr_taxonomy_metas', true );
                        $key_svg          = isset( $recipe_key_metas['taxonomy_svg'] ) ? $recipe_key_metas['taxonomy_svg'] : '';
                ?>
                <a href="<?php echo esc_url( get_term_link( $key, 'recipe-key' ) ); ?>" title="<?php echo esc_attr( $recipe_key ); ?>">
                <?php delicious_recipes_get_tax_icon( $key ); ?>
                    <span class="cat-name"><?php echo esc_attr( $recipe_key ); ?></span>
                </a>
                <?php } ?>
            </span>
        <?php endif; ?>
    </div>

    <header class="dr-fav-header">
        <h3 class="dr-fav-recipe-title">
            <a href="<?php echo esc_url( $recipe->permalink ); ?>"><?php echo esc_html( $recipe->name ); ?></a>
        </h3>
        <div class="dr-entry-meta">
        <?php if( $recipe->total_time ) : ?>
            <span class="dr-time">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.99" height="29.99" viewBox="0 0 29.99 29.99">
                    <defs>
                    <filter id="Path_26354" x="0" y="0" width="29.99" height="29.99" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"></feOffset>
                        <feGaussianBlur stdDeviation="3" result="blur"></feGaussianBlur>
                        <feFlood flood-color="#e84e3b" flood-opacity="0.259"></feFlood>
                        <feComposite operator="in" in2="blur"></feComposite>
                        <feComposite in="SourceGraphic"></feComposite>
                    </filter>
                    </defs>
                    <g id="clock_1_" data-name="clock (1)" transform="translate(7.682 4.259)">
                    <g id="Group_2830" data-name="Group 2830" transform="translate(2.146)">
                        <g id="Group_2829" data-name="Group 2829">
                        <path id="Path_26353" data-name="Path 26353" d="M76.621,3.152l-.885-.885a.428.428,0,1,0-.606.606l.885.885a.428.428,0,0,0,.606-.606Zm8.593-.885a.428.428,0,0,0-.606,0L83.584,3.291a.428.428,0,1,0,.606.606l1.025-1.024a.428.428,0,0,0,0-.606ZM77.7,12.243a.432.432,0,0,0-.575.192L76.363,14a.428.428,0,0,0,.766.383l.767-1.562a.429.429,0,0,0-.192-.575ZM81.028,0H79.316a.428.428,0,1,0,0,.856h.428V2.17a.428.428,0,1,0,.856,0V.856h.428a.428.428,0,1,0,0-.856Zm2.185,12.435a.428.428,0,0,0-.766.383l.767,1.562A.428.428,0,0,0,83.981,14Z" transform="translate(-75.005)" fill="#e84e3b"></path>
                        </g>
                    </g>
                    <g id="Alarm_Clock_1_" transform="translate(0.005 0.024)">
                        <g id="Group_2831" data-name="Group 2831" transform="translate(1.313 1.717)">
                        <g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_26354)">
                            <path id="Path_26354-2" data-name="Path 26354" d="M52,72.99a6,6,0,1,1,6-6A6,6,0,0,1,52,72.99Z" transform="translate(-37 -55)" fill="#e84e3b"></path>
                        </g>
                        </g>
                        <g id="Group_2832" data-name="Group 2832" transform="translate(3.026 3.43)">
                        <path id="Path_26355" data-name="Path 26355" d="M110.287,129.564a4.282,4.282,0,1,1,4.282-4.282A4.287,4.287,0,0,1,110.287,129.564Z" transform="translate(-106.005 -121)" fill="#fff"></path>
                        </g>
                        <g id="Group_2834" data-name="Group 2834" transform="translate(0)">
                        <g id="Group_2833" data-name="Group 2833">
                            <path id="Path_26356" data-name="Path 26356" d="M.758,1.585a2.568,2.568,0,0,0,0,3.633.428.428,0,0,0,.606,0L4.391,2.19a.428.428,0,0,0,0-.606,2.63,2.63,0,0,0-3.633,0Zm13.111,0a2.63,2.63,0,0,0-3.633,0,.428.428,0,0,0,0,.606l3.028,3.028a.428.428,0,0,0,.606,0,2.568,2.568,0,0,0,0-3.633Z" transform="translate(-0.005 -0.857)" fill="#e84e3b"></path>
                        </g>
                        </g>
                        <g id="Group_2835" data-name="Group 2835" transform="translate(5.167 5.143)">
                        <path id="Path_26357" data-name="Path 26357" d="M181.434,185.71a.428.428,0,0,1-.3-.731l1.587-1.587v-1.964a.428.428,0,1,1,.856,0v2.141a.428.428,0,0,1-.125.3l-1.713,1.713A.427.427,0,0,1,181.434,185.71Z" transform="translate(-181.006 -181)" fill="#e84e3b"></path>
                        </g>
                    </g>
                    </g>
                </svg>
                <span class="dr-meta-title"><?php echo esc_html( $recipe->total_time ); ?></span>
            </span>
        <?php endif; ?>
        <?php if( $recipe->difficulty_level ) : ?>    
            <span class="dr-level">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28.728" height="32.25" viewBox="0 0 28.728 32.25">
                    <defs>
                    <filter id="Path_26351" x="0" y="0" width="28.728" height="32.25" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha"></feOffset>
                        <feGaussianBlur stdDeviation="3" result="blur"></feGaussianBlur>
                        <feFlood flood-color="#e84e3b" flood-opacity="0.259"></feFlood>
                        <feComposite operator="in" in2="blur"></feComposite>
                        <feComposite in="SourceGraphic"></feComposite>
                    </filter>
                    </defs>
                    <g id="flame" transform="translate(-54.168 6)">
                    <g transform="matrix(1, 0, 0, 1, 54.17, -6)" filter="url(#Path_26351)">
                        <path id="Path_26351-2" data-name="Path 26351" d="M65.32,12.962A10.057,10.057,0,0,1,63.6,10.524a5.527,5.527,0,0,1-.327-3.181A6.861,6.861,0,0,1,64.636,4.4a2.835,2.835,0,0,0,.713,2.081,4.946,4.946,0,0,1,1.13-4.1A8.5,8.5,0,0,1,70.106,0,2.93,2.93,0,0,0,69.6,2.795,11.653,11.653,0,0,0,70.938,5.44a5.905,5.905,0,0,1,1.011,2.735A9.561,9.561,0,0,0,72.692,6.6a3.113,3.113,0,0,0,.119-1.724,4.421,4.421,0,0,1,.981,2.14,9,9,0,0,1,.03,2.527,6.32,6.32,0,0,1-.862,2.646,4.964,4.964,0,0,1-2.586,1.932A5.879,5.879,0,0,1,65.32,12.962Z" transform="translate(-54.17 6)" fill="#e84e3b"></path>
                    </g>
                    <path id="Path_26352" data-name="Path 26352" d="M152.924,223.524a2.926,2.926,0,0,0,3.508-4.162c0-.03-.03-.03-.03-.059a3,3,0,0,1-.743,2.616,2.777,2.777,0,0,0-.268-2.259c-.357-.684-.862-1.308-1.249-1.962a3.16,3.16,0,0,1-.505-2.23,3.92,3.92,0,0,0-1.427,2.2,3.98,3.98,0,0,0,.3,2.616,1.954,1.954,0,0,1-.8-1.427,3.061,3.061,0,0,0-.743,2.051A3.028,3.028,0,0,0,152.924,223.524Z" transform="translate(-85.345 -210.391)" fill="#fff"></path>
                    </g>
                </svg>
                <span class="dr-meta-title"><?php echo esc_html( $recipe->difficulty_level ); ?></span>
            </span>
        <?php endif; ?>
        </div>
    </header>
</li>
<?php

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */