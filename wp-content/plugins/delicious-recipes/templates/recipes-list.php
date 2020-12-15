<?php
/**
 * The template for displaying recipe content in archive.
 *
 * This template can be overridden by copying it to yourtheme/delicious-recipes/recipes-list.php.
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
$img_size = apply_filters( 'recipes_list_img_size', 'recipe-archive-list' );
?>
<article class="recipe-post" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <figure class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php if( $recipe->thumbnail ) : 
                the_post_thumbnail( $img_size ); 
            else:
                delicious_recipes_get_fallback_svg( $img_size );
            endif; ?>
        </a>
        <?php if ( $recipe->thumbnail ) : ?>
            <span class="post-pinit-button">
                <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>/&media=<?php echo esc_url( $recipe->thumbnail ); ?>&description=So%20delicious!" data-pin-custom="true">
                    <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/pinit-sm.png" alt="pinit">
                </a>
            </span>
        <?php endif; ?>
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
    </figure>
    <div class="content-wrap">
        <header class="entry-header">
            <?php if ( ! empty( $recipe->recipe_course ) ) : ?>
                <span class="post-cat">
                    <?php the_terms( $recipe->ID, 'recipe-course', '', '', '' ); ?>
                </span>
            <?php endif; ?>
            <h2 class="entry-title" itemprop="name">
                <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <?php if( isset( $position ) && ! empty( $position ) ) : ?>
                <meta itemprop="position" content="<?php echo $position; ?>"/>
            <?php endif; ?>

            <div class="entry-meta">
                <span class="posted-on">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="33" height="31" viewBox="0 0 33 31"><defs><filter id="Rectangle_1344" x="0" y="0" width="33" height="31" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="blur"/><feFlood flood-color="#e84e3b" flood-opacity="0.102"/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g id="Group_5559" data-name="Group 5559" transform="translate(-534.481 -811)"><g transform="matrix(1, 0, 0, 1, 534.48, 811)" filter="url(#Rectangle_1344)"><rect id="Rectangle_1344-2" data-name="Rectangle 1344" width="15" height="13" transform="translate(9 6)" fill="#fff"/></g><path id="Path_30675" data-name="Path 30675" d="M5.84,23.3a2.279,2.279,0,0,1-2.277-2.277V10.1A2.279,2.279,0,0,1,5.84,7.821H7.206V6.455a.455.455,0,0,1,.911,0V7.821h6.375V6.455a.455.455,0,0,1,.911,0V7.821h1.366A2.28,2.28,0,0,1,19.044,10.1V21.026A2.279,2.279,0,0,1,16.767,23.3ZM4.474,21.026A1.367,1.367,0,0,0,5.84,22.392H16.767a1.368,1.368,0,0,0,1.366-1.366V12.374H4.474ZM5.84,8.732A1.367,1.367,0,0,0,4.474,10.1v1.366h13.66V10.1a1.368,1.368,0,0,0-1.366-1.366Z" transform="translate(539.437 808)" fill="#abadb4"/><g id="Group_5542" data-name="Group 5542" transform="translate(547.149 822.506)"><path id="Path_30676" data-name="Path 30676" d="M1036.473-439.908a.828.828,0,0,1,.831.814.832.832,0,0,1-.833.838.831.831,0,0,1-.825-.822A.826.826,0,0,1,1036.473-439.908Z" transform="translate(-1035.646 439.908)" fill="#374757"/><path id="Path_30677" data-name="Path 30677" d="M1105.926-439.908a.826.826,0,0,1,.831.826.832.832,0,0,1-.821.826.831.831,0,0,1-.836-.823A.827.827,0,0,1,1105.926-439.908Z" transform="translate(-1099.534 439.908)" fill="#374757"/><path id="Path_30678" data-name="Path 30678" d="M1071.255-439.909a.821.821,0,0,1,.81.844.825.825,0,0,1-.847.809.825.825,0,0,1-.8-.851A.821.821,0,0,1,1071.255-439.909Z" transform="translate(-1067.628 439.909)" fill="#374757"/><path id="Path_30679" data-name="Path 30679" d="M1036.473-439.908a.828.828,0,0,1,.831.814.832.832,0,0,1-.833.838.831.831,0,0,1-.825-.822A.826.826,0,0,1,1036.473-439.908Z" transform="translate(-1035.646 443.397)" fill="#374757"/><path id="Path_30680" data-name="Path 30680" d="M1105.926-439.908a.826.826,0,0,1,.831.826.832.832,0,0,1-.821.826.831.831,0,0,1-.836-.823A.827.827,0,0,1,1105.926-439.908Z" transform="translate(-1099.534 443.397)" fill="#374757"/><path id="Path_30681" data-name="Path 30681" d="M1071.255-439.909a.821.821,0,0,1,.81.844.825.825,0,0,1-.847.809.825.825,0,0,1-.8-.851A.821.821,0,0,1,1071.255-439.909Z" transform="translate(-1067.628 443.397)" fill="#374757"/></g></g></svg>
                    <time><?php echo esc_html( delicious_recipes_get_formated_date( $recipe->date_published ) ); ?></time>
                </span>
                <span class="comment">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35.556" height="36.263"
                        viewBox="0 0 35.556 36.263">
                        <defs>
                            <filter id="a" x="0" y="0" width="35.556" height="36.263" filterUnits="userSpaceOnUse">
                                <feOffset dy="3" input="SourceAlpha" />
                                <feGaussianBlur stdDeviation="3" result="b" />
                                <feFlood flood-color="#e84e3b" flood-opacity="0.102" />
                                <feComposite operator="in" in2="b" />
                                <feComposite in="SourceGraphic" />
                            </filter>
                        </defs>
                        <g transform="translate(-867.5 -4569.5)">
                            <g transform="matrix(1, 0, 0, 1, 867.5, 4569.5)" filter="url(#a)">
                                <path
                                    d="M14.191,128H2.365A2.574,2.574,0,0,0,0,130.365v7.1a2.316,2.316,0,0,0,2.365,2.365H3.548v4.73l4.73-4.73h5.913a2.638,2.638,0,0,0,2.365-2.365v-7.1A2.574,2.574,0,0,0,14.191,128Z"
                                    transform="translate(9.5 -121.5)" fill="#fff" stroke="rgba(55,71,87,0.42)" stroke-width="1" />
                            </g>
                            <path
                                d="M1036.824-439.908a1.181,1.181,0,0,1,1.185,1.161,1.186,1.186,0,0,1-1.187,1.2,1.184,1.184,0,0,1-1.176-1.172A1.177,1.177,0,0,1,1036.824-439.908Z"
                                transform="translate(-155.676 5020.165)" fill="#374757" />
                            <path
                                d="M1106.277-439.908a1.178,1.178,0,0,1,1.185,1.178,1.186,1.186,0,0,1-1.171,1.178,1.184,1.184,0,0,1-1.193-1.173A1.179,1.179,0,0,1,1106.277-439.908Z"
                                transform="translate(-217.195 5020.165)" fill="#374757" />
                            <path
                                d="M1071.613-439.909a1.171,1.171,0,0,1,1.155,1.2,1.177,1.177,0,0,1-1.207,1.153,1.177,1.177,0,0,1-1.146-1.214A1.171,1.171,0,0,1,1071.613-439.909Z"
                                transform="translate(-186.473 5020.166)" fill="#374757" />
                        </g>
                    </svg>
                    <span class="meta-text"><?php echo sprintf( _nx( '%s Comment', '%s Comments', $recipe->comments_number, 'number of comments', 'delicious-recipes' ), number_format_i18n( $recipe->comments_number ) ); ?></span>
                </span>
                <?php if ( $recipe->rating ): ?>
                    <span class="post-rating">
                    <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/star-rating.svg" alt="star rating">
                        <span class="meta-text"><?php echo esc_html( $recipe->rating ); ?></span>
                    </span>
                <?php endif; ?>
            </div>
            <div class="floated-meta">
                <?php 
                    /*
                    * Get Recipes Social Share
                    */
                    delicious_recipes_social_share(); 

                    /**
                     * Recipe Like button
                     */
                    do_action( 'delicious_recipes_like_button' );
                ?>
            </div>
        </header>
        <?php if ( ! empty( $recipe->recipe_description ) ) : ?>
            <div class="entry-content">
                <?php echo wp_kses_post( $recipe->recipe_description ); ?>
            </div>
        <?php endif; ?>
        <footer class="entry-footer">
            <span class="byline">
                <a href="<?php echo esc_url( get_author_posts_url( $recipe->author_id ) ) ?>">
                    <?php echo get_avatar( $recipe->author_id, 32 ); ?>
                    <b class="fn"><?php echo esc_html( $recipe->author ); ?></b>
                </a>
            </span>
            <?php if( $recipe->total_time ) : ?>
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
                    <span class="meta-text"><?php echo sprintf( '%1$s', esc_html( $recipe->total_time ) ); ?></span>
                </span>
            <?php endif; ?>
            <?php if( $recipe->difficulty_level ) : ?>
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
                    <span class="meta-text"><?php echo esc_html( $recipe->difficulty_level ); ?></span>
                </span>
            <?php endif; ?>
        </footer>
    </div>
</article>
<?php
