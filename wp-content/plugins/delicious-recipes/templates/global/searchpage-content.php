<?php
/**
 * Search page content template
 * 
 * @package Delicious_Recipes
 */
$global_settings        = delicious_recipes_get_global_settings();
$default_posts_per_page = isset ( $global_settings['recipePerPage'] ) && ( ! empty( $global_settings['recipePerPage'] ) ) ? $global_settings['recipePerPage'] : get_option( 'posts_per_page' );
$enable_search_bar      = isset( $global_settings['displaySearchBar']['0'] ) && 'yes' === $global_settings['displaySearchBar']['0'] ? true : false;

?>
<div class="dr-advance-search">
    <?php if( $enable_search_bar ) : ?>
        <header class="page-header">
            <div class="container">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label>
                        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'delicious-recipes' ); ?></span>
                        <input class="search-field" placeholder="<?php esc_attr_e( 'Type & hit enter', 'delicious-recipes' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>"
                            name="s" type="search">
                            <input type="hidden" name="post_type" value="<?php echo esc_attr( DELICIOUS_RECIPE_POST_TYPE ); ?>">
                    </label>
                    <input class="search-submit" value="<?php esc_attr_e( 'Search', 'delicious-recipes' ); ?>" type="submit">
                </form>
            </div>
        </header>
    <?php endif; ?>
    <?php 
        /**
         * Search page top filters.
         */
        do_action( 'delicious_recipes_search_top_filters' );
    ?>
    <?php 
        $recipe_search_args = array(
            'post_type'      => DELICIOUS_RECIPE_POST_TYPE,
            'posts_per_page' => absint( $default_posts_per_page ),
            'paged'          => get_query_var( 'paged', 1 )
        );

        if ( isset( $_GET['ingredient'] ) && ! empty( $_GET['ingredient'] ) ) {
            $recipe_search_args['meta_query'] = [
                [
                    'key'     => 'delicious_recipes_metadata',
                    'value'   => sanitize_text_field( $_GET['ingredient'] ),
                    'compare' => 'LIKE'
                ]
            ];
        }

        $recipe_search = new WP_Query( $recipe_search_args );
    ?>
    <div class="container">
        <?php
            if ( $recipe_search->have_posts() ) :
        ?>
                <div class="dr-search-item-wrap" itemscope itemtype="http://schema.org/ItemList">
                    <?php 
                        $position = 1;
                        while( $recipe_search->have_posts() ) : $recipe_search->the_post();
                            /**
                             * Get search page single block - recipe.
                             */
                            $data = array(
                                'position'  => $position
                            );
                                delicious_recipes_get_template( 'recipes-grid.php', $data );
                            $position++;
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div><!-- .dr-search-item-wrap -->
        <?php 
            else :
        ?>
                <span class="no-result">
                    <?php esc_html_e( 'Recipes not found.', 'delicious-recipes' ); ?>
                </span>
        <?php
            endif;
        ?>
        
        <nav class="navigation pagination" role="navigation" aria-label="Posts">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'delicious-recipes' ); ?></h2>
            <div class="nav-links">
                <?php 
                    /**
                     * Get Pagination.
                     */
                    $total_pages = $recipe_search->max_num_pages;
                    $big         = 999999999;                      // need an unlikely integer
            
                    if ( $total_pages > 1 ){
                        $current_page = max( 1, get_query_var('paged') );
            
                        echo paginate_links(array(
                            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format'    => '?paged=%#%',
                            'current'   => absint( $current_page ),
                            'total'     => absint( $total_pages ),
                            'prev_text' => __( 'Prev', 'delicious-recipes' ) .
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689">
                                <g transform="translate(17.729 11.628) rotate(180)">
                                    <path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none"
                                        stroke="#374757" stroke-linecap="round" stroke-width="1.5" />
                                    <path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="#374757"
                                        stroke-linecap="round" stroke-width="1.5" />
                                </g>
                            </svg>',
                            'next_text' => __( "Next", 'delicious-recipes' ) .
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18.479" height="12.689" viewBox="0 0 18.479 12.689"><g transform="translate(0.75 1.061)">
                                    <path d="M7820.11-1126.021l5.284,5.284-5.284,5.284" transform="translate(-7808.726 1126.021)" fill="none"
                                        stroke="#374757" stroke-linecap="round" stroke-width="1.5" />
                                    <path d="M6558.865-354.415H6542.66" transform="translate(-6542.66 359.699)" fill="none" stroke="#374757"
                                        stroke-linecap="round" stroke-width="1.5" />
                                </g>
                            </svg>',
                        ));
                    }
                ?>
            </div>
        </nav>
	</div>
</div><!-- .dr-advance-search -->

<script type="text/html" id="tmpl-search-block-tmp">
    <#
    if ( data.length > 0 ) {
        _.each( data, function( val ){
    #>
    <div class="dr-archive-single">
        <figure>
            <a href="{{val.permalink}}">
                <# 
                if ( val.thumbnail ) { 
                    #>
                        {{{val.thumbnail}}}
                    <# 
                } else { 
                    #>
                    <?php delicious_recipes_get_fallback_svg( 'recipe-archive-grid' ); ?>
                    <# 
                } 
                #>
            </a>
            <# 
                if ( val.thumbnail ) { 
                    #>
                        <span class="post-pinit-button">
                            <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url={{val.permalink}}/&media={{val.thumbnail_url}}&description=So%20delicious!" data-pin-custom="true">
                                <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/pinit-sm.png" alt="pinit">
                            </a>
                        </span>
                    <# 
                }
            #>
            <# 
                if ( val.recipe_keys.length > 0 ) { 
                    #>
                        <span class="dr-category">
                    <#
                        _.each( val.recipe_keys, function( recipe_key ) {
                        #>
                            <a href="{{recipe_key.link}}" title="{{recipe_key.key}}">
                                {{{recipe_key.icon}}}
                                <span class="cat-name">{{recipe_key.key}}</span>
                            </a>
                        <# 
                        });
                    #>
                        </span> 
                    <#
                }
            #>
        </figure>
        <div class="dr-archive-details">
            <h2 class="dr-archive-list-title">
                <a href="{{val.permalink}}">
                {{{val.title}}}
                </a>
            </h2>
            <div class="dr-entry-meta">
                <# 
                if ( val.total_time ) { 
                    #>
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
                        <span class="dr-meta-title">{{val.total_time}}</span>
                    </span>
                    <# 
                }
                if ( val.difficulty_level ) { 
                    #>
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
                        <span class="dr-meta-title">{{val.difficulty_level}}</span>
                    </span>
                    <# 
                } 
                #>
            </div>
        </div>
    </div>
    <#
        });
    } else { 
        #>
        <span class="no-result">
            <?php esc_html_e( 'Recipes not found.', 'delicious-recipes' ); ?>
        </span>
        <# 
    }
    #>
</script>
