<?php
/**
 * Delicious Recipes Functions.
 *
 * @package Blossom_Recipe
 */

if( ! function_exists( 'blossom_recipe_prep_time' ) ) :
/**
 * Prep Time.
 */
function blossom_recipe_prep_time(){
    global $recipe;
    if( $recipe->total_time ) : ?>
        <span class="cook-time">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="29.99" height="29.99"
                viewBox="0 0 29.99 29.99">
                <defs>
                    <filter id="a" x="0" y="0" width="29.99" height="29.99" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="3" result="b" />
                        <feFlood flood-color="#e84e3b" flood-opacity="0.259" />
                        <feComposite operator="in" in2="b" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                </defs>
                <g transform="translate(7.682 4.259)">
                    <g transform="translate(2.146)">
                        <path
                            d="M76.621,3.152l-.885-.885a.428.428,0,1,0-.606.606l.885.885a.428.428,0,0,0,.606-.606Zm8.593-.885a.428.428,0,0,0-.606,0L83.584,3.291a.428.428,0,1,0,.606.606l1.025-1.024a.428.428,0,0,0,0-.606ZM77.7,12.243a.432.432,0,0,0-.575.192L76.363,14a.428.428,0,0,0,.766.383l.767-1.562a.429.429,0,0,0-.192-.575ZM81.028,0H79.316a.428.428,0,1,0,0,.856h.428V2.17a.428.428,0,1,0,.856,0V.856h.428a.428.428,0,1,0,0-.856Zm2.185,12.435a.428.428,0,0,0-.766.383l.767,1.562A.428.428,0,0,0,83.981,14Z"
                            transform="translate(-75.005)" fill="#e84e3b" />
                    </g>
                    <g transform="translate(0.005 0.024)">
                        <g transform="translate(1.313 1.717)">
                            <g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#a)">
                                <path d="M52,72.99a6,6,0,1,1,6-6A6,6,0,0,1,52,72.99Z" transform="translate(-37 -55)"
                                    fill="#e84e3b" />
                            </g>
                        </g>
                        <g transform="translate(3.026 3.43)">
                            <path d="M110.287,129.564a4.282,4.282,0,1,1,4.282-4.282A4.287,4.287,0,0,1,110.287,129.564Z"
                                transform="translate(-106.005 -121)" fill="#fff" />
                        </g>
                        <g transform="translate(0)">
                            <path
                                d="M.758,1.585a2.568,2.568,0,0,0,0,3.633.428.428,0,0,0,.606,0L4.391,2.19a.428.428,0,0,0,0-.606,2.63,2.63,0,0,0-3.633,0Zm13.111,0a2.63,2.63,0,0,0-3.633,0,.428.428,0,0,0,0,.606l3.028,3.028a.428.428,0,0,0,.606,0,2.568,2.568,0,0,0,0-3.633Z"
                                transform="translate(-0.005 -0.857)" fill="#e84e3b" />
                        </g>
                        <g transform="translate(5.167 5.143)">
                            <path
                                d="M181.434,185.71a.428.428,0,0,1-.3-.731l1.587-1.587v-1.964a.428.428,0,1,1,.856,0v2.141a.428.428,0,0,1-.125.3l-1.713,1.713A.427.427,0,0,1,181.434,185.71Z"
                                transform="translate(-181.006 -181)" fill="#e84e3b" />
                        </g>
                    </g>
                </g>
            </svg>
            <span class="meta-text"><?php echo esc_html( $recipe->total_time ); ?></span>
        </span>
    <?php endif;
}
endif;

if( ! function_exists( 'blossom_recipe_difficulty_level' ) ) :
/**
 * Difficulty Level.
 */
function blossom_recipe_difficulty_level(){
    global $recipe;
    if( $recipe->difficulty_level ) : ?>
        <span class="cook-difficulty">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28.728" height="32.25"
                viewBox="0 0 28.728 32.25">
                <defs>
                    <filter id="a" x="0" y="0" width="28.728" height="32.25" filterUnits="userSpaceOnUse">
                        <feOffset dy="3" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="3" result="b" />
                        <feFlood flood-color="#e84e3b" flood-opacity="0.259" />
                        <feComposite operator="in" in2="b" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                </defs>
                <g transform="translate(-54.168 6)">
                    <g transform="matrix(1, 0, 0, 1, 54.17, -6)" filter="url(#a)">
                        <path
                            d="M65.32,12.962A10.057,10.057,0,0,1,63.6,10.524a5.527,5.527,0,0,1-.327-3.181A6.861,6.861,0,0,1,64.636,4.4a2.835,2.835,0,0,0,.713,2.081,4.946,4.946,0,0,1,1.13-4.1A8.5,8.5,0,0,1,70.106,0,2.93,2.93,0,0,0,69.6,2.795,11.653,11.653,0,0,0,70.938,5.44a5.905,5.905,0,0,1,1.011,2.735A9.561,9.561,0,0,0,72.692,6.6a3.113,3.113,0,0,0,.119-1.724,4.421,4.421,0,0,1,.981,2.14,9,9,0,0,1,.03,2.527,6.32,6.32,0,0,1-.862,2.646,4.964,4.964,0,0,1-2.586,1.932A5.879,5.879,0,0,1,65.32,12.962Z"
                            transform="translate(-54.17 6)" fill="#e84e3b" />
                    </g>
                    <path
                        d="M152.924,223.524a2.926,2.926,0,0,0,3.508-4.162c0-.03-.03-.03-.03-.059a3,3,0,0,1-.743,2.616,2.777,2.777,0,0,0-.268-2.259c-.357-.684-.862-1.308-1.249-1.962a3.16,3.16,0,0,1-.505-2.23,3.92,3.92,0,0,0-1.427,2.2,3.98,3.98,0,0,0,.3,2.616,1.954,1.954,0,0,1-.8-1.427,3.061,3.061,0,0,0-.743,2.051A3.028,3.028,0,0,0,152.924,223.524Z"
                        transform="translate(-85.345 -210.391)" fill="#fff" />
                </g>
            </svg>
            <span class="meta-text"><?php echo esc_html( ucfirst( $recipe->difficulty_level ) ); ?></span>
        </span>
    <?php endif;
}
endif;

if( ! function_exists( 'blossom_recipe_recipe_category' ) ) :
/**
 * Difficulty Level.
 */
function blossom_recipe_recipe_category(){
    global $recipe;
    if ( ! empty( $recipe->ID ) ) : ?>
        <span class="post-cat">
            <?php the_terms( $recipe->ID, 'recipe-course', '', '', '' ); ?>
        </span>
    <?php endif;
}
endif;

if( ! function_exists( 'blossom_recipe_recipe_rating' ) ) :
/**
 * Rating
 */
function blossom_recipe_recipe_rating(){
    global $recipe;
    if ( $recipe->rating ): ?>
        <span class="post-rating">
            <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/star-rating.svg" alt="star rating">
            <span class="meta-text"><?php echo esc_html( $recipe->rating ); ?></span>
        </span>
    <?php endif;
}
endif;