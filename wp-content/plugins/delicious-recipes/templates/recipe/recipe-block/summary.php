<?php
/**
 * Recipe Summary tempalte.
 * 
 */
global $recipe;

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();
?>
<div class="dr-post-summary">
    <div class="dr-recipe-summary-inner">
        <div class="dr-image">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'recipe-feat-gallery' ); 
                    ?>
                        <span class="post-pinit-button">
                            <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>/&media=<?php echo esc_url( $recipe->thumbnail ); ?>&description=So%20delicious!" data-pin-custom="true">
                                <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/pinit-sm.png" alt="pinit">
                            </a>
                        </span> 
                    <?php
                } else {
                    delicious_recipes_get_fallback_svg( 'recipe-feat-gallery' );
                }
                if ( $global_toggles['enable_print_recipe'] ) : ?>
                    <div class="dr-buttons">
                        <?php delicious_recipes_get_template_part( 'recipe/print', 'btn' ); ?>
                    </div>
                <?php endif; 
            ?>
        </div>
        <div class="dr-title-wrap">
            <?php if ( $recipe->rating_count && $global_toggles['enable_ratings'] ) : ?>
                <span class="dr-rating">
                    <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/star-version-2.svg" alt="star rating">
                    <?php 
                        $average_rating = $recipe->rating;

                        if ( $average_rating ) {
                            /* translators: %1$s: average rating */
                            echo esc_html( sprintf( __( '%1$s from', 'delicious-recipes' ), $average_rating ) );
                        }
                    ?>
                    <span class="dr-text-red">
                        <a href="#comments"><?php 
                            /* translators: %s: number of comments count */
                            printf( _nx( '%s vote', '%s votes', 'number of comments', 'delicious-recipes' ),  absint( $recipe->rating_count ) ); 
                        ?></a>
                    </span>
                </span>
                <?php endif; ?>
            <h2 class="dr-title"><?php echo esc_html( $recipe->name ); ?></h2>
            <div class="dr-entry-meta">
                <?php if( $global_toggles['enable_author'] ) : ?>
                    <span class="dr-byline">
                        <span class="dr-meta-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13.721" height="14.839" viewBox="0 0 13.721 14.839"><path id="author-c2f536d64c85bd008e6416d3c3d02f35" d="M100.226,67.833a4.383,4.383,0,1,0,4.374-4.1A4.246,4.246,0,0,0,100.226,67.833ZM104.6,78.568H97.74a6.738,6.738,0,0,1,6.859-6.309,6.622,6.622,0,0,1,6.861,6.309Z" transform="translate(-97.74 -63.728)" fill="#374757" opacity="0.55"/></svg>
                            <?php echo esc_html( $global_toggles['author_lbl'] ); ?>:
                        </span>
                        <a href="<?php echo esc_url( get_author_posts_url( $recipe->author_id ) ) ?>" class="fn"><?php echo esc_html( $recipe->author ); ?></a>
                    </span>
                <?php endif; ?>
                <?php 
                    if( ! empty( $recipe->cooking_method ) && $global_toggles['enable_cooking_method'] ) :
                ?>
                    <span class="dr-method">
                        <span class="dr-meta-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.306" height="16.016" viewBox="0 0 17.306 16.016"><g id="Group_4830" data-name="Group 4830" transform="translate(-169.177 -331.059)" opacity="0.55"><path id="Path_30608" data-name="Path 30608" d="M171.16,432.048V430.21c-.093-.026-.182-.046-.268-.076a.666.666,0,0,1,.162-1.292c.051,0,.1,0,.154,0h13.153c.457,0,.735.209.778.576a.666.666,0,0,1-.446.725c-.085.036-.206.129-.208.2-.017.551-.009,1.1-.009,1.7a1.3,1.3,0,0,0,.7-.767.669.669,0,0,1,1.033-.323.66.66,0,0,1,.216.8,2.532,2.532,0,0,1-1.684,1.588.333.333,0,0,0-.274.389c.01,1.2.006,2.4,0,3.6a1.348,1.348,0,0,1-1.5,1.5H172.683a1.345,1.345,0,0,1-1.506-1.5c0-1.191-.006-2.382,0-3.573,0-.238-.049-.354-.3-.432a2.515,2.515,0,0,1-1.614-1.46.687.687,0,0,1,.305-.989.674.674,0,0,1,.922.454A1.331,1.331,0,0,0,171.16,432.048Z" transform="translate(0 -91.753)" fill="#374757"/><path id="Path_30609" data-name="Path 30609" d="M192.329,332.669c.6-.079,1.185-.135,1.758-.237a1.736,1.736,0,0,1,1.548.4,1.891,1.891,0,0,0,1.629.547.613.613,0,0,1,.682.6.648.648,0,0,1-.58.71q-3.92.527-7.841,1.05c-1.759.236-3.519.47-5.277.713a.726.726,0,0,1-.8-.308.666.666,0,0,1,.509-1.015,1.384,1.384,0,0,0,.946-.523c.9-1.26,1.059-1.057,2.46-1.274.313-.048.627-.088.969-.137-.014-.168-.023-.318-.039-.467a1.34,1.34,0,0,1,1.128-1.485q.7-.1,1.4-.176a1.348,1.348,0,0,1,1.434,1.125C192.279,332.331,192.3,332.473,192.329,332.669Zm-2.646.36,1.3-.194-.054-.447-1.3.187Z" transform="translate(-13.29 0)" fill="#374757"/></g></svg>
                            <?php echo esc_html( $global_toggles['cooking_method_lbl'] ); ?>:
                        </span>
                        <?php the_terms( $recipe->ID, 'recipe-cooking-method', '', ', ', '' ); ?>
                    </span>
                <?php endif;
                    if( ! empty( $recipe->recipe_cuisine ) && $global_toggles['enable_cuisine'] ) :
                ?>
                <span class="dr-cuisine">
                    <span class="dr-meta-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.874" height="18.42" viewBox="0 0 19.874 18.42"><g id="Group_4829" data-name="Group 4829" transform="translate(-263.223 -250.745)" opacity="0.55"><path id="Path_30604" data-name="Path 30604" d="M336.987,259.846a8.575,8.575,0,0,1,4.748-7.214,8.822,8.822,0,0,0-5.668,7.2h-.817a7.865,7.865,0,0,1,2.1-5.5,7.507,7.507,0,0,1,5.339-2.5v-.421a3.986,3.986,0,0,1-.5-.144.324.324,0,0,1-.18-.2c-.008-.051.1-.15.179-.178a2.177,2.177,0,0,1,1.552,0c.075.028.171.119.174.184s-.095.147-.167.188a.679.679,0,0,1-.3.094c-.176.006-.234.08-.21.246a1.879,1.879,0,0,1,0,.24,7.849,7.849,0,0,1,7.415,8Zm11.761-3.034a4.108,4.108,0,0,0-2.607-3.406,4.078,4.078,0,0,1,2.183,3.406Z" transform="translate(-68.209 0)" fill="#374757"/><path id="Path_30605" data-name="Path 30605" d="M305.858,459.251c0-.663.011-1.326,0-1.988a.938.938,0,0,1,.416-.811,3.6,3.6,0,0,1,1.87-.584,3.22,3.22,0,0,1,1.568.269c1.348.546,2.7,1.085,4.05,1.627.043.017.087.032.129.05a.941.941,0,0,1,.437,1.544,1.083,1.083,0,0,1-1.343.468c-.463-.155-.918-.337-1.376-.507-.074-.027-.148-.059-.224-.081a.539.539,0,0,0-.738.509.356.356,0,0,0,.282.38c.545.205,1.088.415,1.632.623.111.043.224.081.332.131a.906.906,0,0,0,.886-.072q2.406-1.372,4.823-2.727a1.832,1.832,0,0,1,1.243-.236.851.851,0,0,1,.705,1.072,1.479,1.479,0,0,1-.74,1q-2.108,1.173-4.195,2.385c-.383.222-.736.5-1.11.734a2.057,2.057,0,0,1-1.893.221c-1.143-.4-2.272-.832-3.384-1.313a5.139,5.139,0,0,0-2.943-.3c-.358.06-.422.014-.422-.353Q305.858,460.275,305.858,459.251Z" transform="translate(-40.37 -194.234)" fill="#374757"/><path id="Path_30606" data-name="Path 30606" d="M340.214,429.247v.653H323.538v-.653Z" transform="translate(-57.117 -169.038)" fill="#374757"/><path id="Path_30607" data-name="Path 30607" d="M265.175,480.049c0,.6,0,1.193,0,1.789a.467.467,0,0,1-.522.529q-.457,0-.914,0a.474.474,0,0,1-.514-.523c0-.835,0-1.669,0-2.5,0-.364,0-.729,0-1.093a.49.49,0,0,1,.529-.537c.3-.005.6,0,.894,0a.481.481,0,0,1,.527.532C265.177,478.843,265.175,479.446,265.175,480.049Zm-.716-1.251a.362.362,0,0,0,.355-.332.355.355,0,1,0-.71-.021A.36.36,0,0,0,264.459,478.8Z" transform="translate(0 -214.926)" fill="#374757"/></g></svg>
                        <?php echo esc_html( $global_toggles['cuisine_lbl'] ); ?>:
                    </span>
                    <?php the_terms( $recipe->ID, 'recipe-cuisine', '', ', ', '' ); ?>
                </span>
                <?php endif; 
                    if( ! empty( $recipe->recipe_course ) && $global_toggles['enable_category'] ) :
                ?>
                <span class="dr-category">
                    <span class="dr-meta-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.65" height="15.62" viewBox="0 0 15.65 15.62"><g id="Group_4828" data-name="Group 4828" transform="translate(-614.26 -6213.23)" opacity="0.55"><rect id="Rectangle_1263" data-name="Rectangle 1263" width="6.65" height="6.62" transform="translate(614.26 6213.23)" fill="#374757"/><rect id="Rectangle_1266" data-name="Rectangle 1266" width="6.65" height="6.62" transform="translate(614.26 6222.23)" fill="#374757"/><rect id="Rectangle_1264" data-name="Rectangle 1264" width="6.65" height="6.62" transform="translate(623.26 6213.23)" fill="#374757"/><rect id="Rectangle_1265" data-name="Rectangle 1265" width="6.65" height="6.62" transform="translate(623.26 6222.23)" fill="#374757"/></g></svg>
                        <?php echo esc_html( $global_toggles['category_lbl'] ); ?>:
                    </span>
                    <?php the_terms( $recipe->ID, 'recipe-course', '', ', ', '' ); ?>
                </span>
                <?php endif;
                    if ( ! empty( $recipe->recipe_keys ) && $global_toggles['enable_recipe_keys'] ) :
                ?>
                <span class="dr-category dr-recipe-keys">
                    <span class="dr-meta-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.383" height="20.112" viewBox="0 0 20.383 20.112"><g id="_46a294d0b98db285341e5079be668fb4" data-name="46a294d0b98db285341e5079be668fb4" transform="translate(-9.955 -16.55)" opacity="0.55"><path id="Path_30682" data-name="Path 30682" d="M29.91,26.409a1.718,1.718,0,0,0-1.3-.589h-4a6.319,6.319,0,0,0,.318-1.645,3.186,3.186,0,0,0-.071-.857.109.109,0,0,0,.062-.033l5.16-5.158a.434.434,0,0,0,0-.616l-.834-.834a.434.434,0,0,0-.616,0l-5.16,5.158a.109.109,0,0,0-.033.062,3.194,3.194,0,0,0-.857-.071,7.03,7.03,0,0,0-2.13.487,11.452,11.452,0,0,0-3.716,2.25,4.719,4.719,0,0,0-.9,1.256H11.678A1.726,1.726,0,0,0,9.97,27.779a10.27,10.27,0,0,0,20.352,0A1.727,1.727,0,0,0,29.91,26.409Zm-13.522.553h.347a5.962,5.962,0,0,0-.437.824A3.3,3.3,0,0,1,16.388,26.962Zm6.056-1.142h-.861l1.932-1.932a10.231,10.231,0,0,1-.742,1.418C22.669,25.477,22.559,25.648,22.444,25.82Zm-4.9,4.037,2.895-2.895h1.188A14.1,14.1,0,0,1,20.477,28.3,4.576,4.576,0,0,1,17.547,29.857Zm5.322-6.615L20.29,25.82H18.948a19.348,19.348,0,0,1,2.5-1.834A10.047,10.047,0,0,1,22.869,23.241Zm-3.721,3.721L16.9,29.208a2.187,2.187,0,0,1,.135-.8,5.106,5.106,0,0,1,.815-1.452h1.3Zm1.974,1.988a16.86,16.86,0,0,0,1.645-1.988h.4a9.678,9.678,0,0,1-1.616,2.412,3.6,3.6,0,0,1-2.325,1.079c-.064,0-.129.006-.191.006h-.06A7.073,7.073,0,0,0,21.122,28.95Zm2.408-3.13c.042-.067.081-.133.121-.2s.092-.156.135-.233c-.042.139-.087.285-.141.433Zm-6.148-.609a10.584,10.584,0,0,1,3.392-2.04c.206-.077.4-.143.595-.2l-.233.135a18.909,18.909,0,0,0-3.33,2.529c-.06.06-.121.123-.179.185h-.74A3.672,3.672,0,0,1,17.382,25.211Zm11.806,2.415a9.037,9.037,0,0,1-.782,2.645c-.915.406-2.092,1.011-3.581,1.813-2.184,1.177-4.752,1.21-8.044-1.3a8.877,8.877,0,0,0-5.374-1.757,8.858,8.858,0,0,1-.3-1.4.579.579,0,0,1,.139-.464.571.571,0,0,1,.435-.2h3.777a4.33,4.33,0,0,0-.064.52,3.588,3.588,0,0,0,3.637,3.893c.083,0,.166,0,.25-.008a4.528,4.528,0,0,0,2.918-1.346,10.954,10.954,0,0,0,1.98-3.059h4.444a.574.574,0,0,1,.435.2A.583.583,0,0,1,29.189,27.625Z" transform="translate(0 0)" fill="#374757"/></g></svg>
                        <?php echo esc_html( $global_toggles['recipe_keys_lbl'] ); ?>:
                    </span>
                    <?php
                        foreach( $recipe->recipe_keys as $recipe_key ) {
                            $key              = get_term_by( 'name', $recipe_key, 'recipe-key' );
                            $recipe_key_metas = get_term_meta( $key->term_id, 'dr_taxonomy_metas', true );
                            $key_svg          = isset( $recipe_key_metas['taxonomy_svg'] ) ? $recipe_key_metas['taxonomy_svg'] : '';
                    ?>
                            <a href="<?php echo esc_url( get_term_link( $key, 'recipe-key' ) ); ?>" title="<?php echo esc_attr( $recipe_key ); ?>">
                                <span class="dr-svg-icon">
                                    <?php delicious_recipes_get_tax_icon( $key ); ?>
                                </span>
                                <span class="cat-name"><?php echo esc_attr( $recipe_key ); ?></span>
                            </a>
                    <?php 
                        }
                    ?>
                </span>
            <?php endif;  ?> 
            </div>
        </div>
    </div>
    
    <div class="dr-extra-meta">
        <?php if( ! empty( $recipe->difficulty_level ) && $global_toggles['enable_difficulty_level'] ) : ?>
            <span class="dr-sim-metaa dr-lavel">
                <span class="dr-meta-title">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="38.672" height="38.672" viewBox="0 0 38.672 38.672"><defs><filter id="a" x="8.524" y="5.901" width="21.623" height="32.771" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="b"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="b"/><feComposite in="SourceGraphic"/></filter><filter id="c" x="4.262" y="9.836" width="21.623" height="28.836" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="d"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="d"/><feComposite in="SourceGraphic"/></filter><filter id="e" x="0" y="14.426" width="21.623" height="24.246" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="f"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="f"/><feComposite in="SourceGraphic"/></filter><filter id="g" x="12.787" y="1.967" width="21.623" height="36.705" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="h"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="h"/><feComposite in="SourceGraphic"/></filter><filter id="i" x="17.049" y="0" width="21.623" height="38.672" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="j"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="j"/><feComposite in="SourceGraphic"/></filter></defs><g transform="translate(7.5 4.5)"><g transform="matrix(1, 0, 0, 1, -7.5, -4.5)" filter="url(#a)"><path d="M29.311,20A1.311,1.311,0,0,0,28,21.311V32.459a1.311,1.311,0,1,0,2.623,0V21.311A1.311,1.311,0,0,0,29.311,20Z" transform="translate(-9.98 -7.6)" fill="#e84e3b" stroke="rgba(0,0,0,0)" stroke-width="1"/></g><g transform="matrix(1, 0, 0, 1, -7.5, -4.5)" filter="url(#c)"><path d="M16.311,32A1.311,1.311,0,0,0,15,33.311v7.213a1.311,1.311,0,1,0,2.623,0V33.311A1.311,1.311,0,0,0,16.311,32Z" transform="translate(-1.24 -15.66)" fill="#e84e3b" stroke="rgba(0,0,0,0)" stroke-width="1"/></g><g transform="matrix(1, 0, 0, 1, -7.5, -4.5)" filter="url(#e)"><path d="M3.311,46A1.311,1.311,0,0,0,2,47.311v2.623a1.311,1.311,0,1,0,2.623,0V47.311A1.311,1.311,0,0,0,3.311,46Z" transform="translate(7.5 -25.07)" fill="#e84e3b" stroke="rgba(0,0,0,0)" stroke-width="1"/></g><g transform="matrix(1, 0, 0, 1, -7.5, -4.5)" filter="url(#g)"><path d="M42.311,8A1.311,1.311,0,0,0,41,9.311V24.393a1.311,1.311,0,1,0,2.623,0V9.311A1.311,1.311,0,0,0,42.311,8Z" transform="translate(-18.71 0.47)" fill="#e84e3b" stroke="rgba(0,0,0,0)" stroke-width="1"/></g><g transform="matrix(1, 0, 0, 1, -7.5, -4.5)" filter="url(#i)"><path d="M55.311,2A1.311,1.311,0,0,0,54,3.311V20.36a1.311,1.311,0,0,0,2.623,0V3.311A1.311,1.311,0,0,0,55.311,2Z" transform="translate(-27.45 4.5)" fill="#e84e3b" stroke="rgba(0,0,0,0)" stroke-width="1"/></g></g></svg>
                    <?php echo esc_html( $global_toggles['difficulty_level_lbl'] ); ?>:
                </span>
                <b><?php echo esc_html( $recipe->difficulty_level ); ?></b>
            </span>
        <?php endif; 
        if ( ! empty( $recipe->total_time ) ) : ?>
            <span class="dr-sim-metaa dr-cook-time">
                <span class="dr-meta-title">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34.824" height="34.824" viewBox="0 0 34.824 34.824"><defs><filter id="Path_26354" x="0" y="0" width="34.824" height="34.824" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="blur"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g id="clock_1_" data-name="clock (1)" transform="translate(7.152 3.557)"><g id="Group_2830" data-name="Group 2830" transform="translate(3.009)"><g id="Group_2829" data-name="Group 2829"><path id="Path_26353" data-name="Path 26353" d="M77.272,4.422,76.03,3.18a.6.6,0,0,0-.85.85l1.242,1.242a.6.6,0,0,0,.85-.85ZM89.329,3.18a.6.6,0,0,0-.85,0L87.042,4.618a.6.6,0,1,0,.85.85L89.329,4.03A.6.6,0,0,0,89.329,3.18Zm-10.536,14a.606.606,0,0,0-.806.269L76.911,19.64a.6.6,0,0,0,1.075.537l1.076-2.192A.6.6,0,0,0,78.793,17.179ZM83.457,0h-2.4a.6.6,0,1,0,0,1.2h.6V3.044a.6.6,0,0,0,1.2,0V1.2h.6a.6.6,0,1,0,0-1.2Zm3.066,17.448a.6.6,0,0,0-1.075.537l1.076,2.192A.6.6,0,0,0,87.6,19.64Z" transform="translate(-75.005)" fill="#e84e3b"/></g></g><g id="Alarm_Clock_1_" transform="translate(0.005 0.034)"><g id="Group_2831" data-name="Group 2831" transform="translate(1.843 2.409)"><g transform="matrix(1, 0, 0, 1, -9, -6)" filter="url(#Path_26354)"><path id="Path_26354-2" data-name="Path 26354" d="M54.417,77.824a8.412,8.412,0,1,1,8.412-8.412A8.422,8.422,0,0,1,54.417,77.824Z" transform="translate(-37.01 -55)" fill="#e84e3b"/></g></g><g id="Group_2832" data-name="Group 2832" transform="translate(4.246 4.813)"><path id="Path_26355" data-name="Path 26355" d="M112.014,133.017a6.009,6.009,0,1,1,6.009-6.009A6.016,6.016,0,0,1,112.014,133.017Z" transform="translate(-106.005 -121)" fill="#fff"/></g><g id="Group_2834" data-name="Group 2834" transform="translate(0)"><g id="Group_2833" data-name="Group 2833"><path id="Path_26356" data-name="Path 26356" d="M1.061,1.878a3.6,3.6,0,0,0,0,5.1.6.6,0,0,0,.85,0L6.159,2.728a.6.6,0,0,0,0-.85,3.69,3.69,0,0,0-5.1,0Zm18.4,0a3.69,3.69,0,0,0-5.1,0,.6.6,0,0,0,0,.85l4.248,4.248a.6.6,0,0,0,.85,0,3.6,3.6,0,0,0,0-5.1Z" transform="translate(-0.005 -0.857)" fill="#e84e3b"/></g></g><g id="Group_2835" data-name="Group 2835" transform="translate(7.25 7.216)"><path id="Path_26357" data-name="Path 26357" d="M181.607,187.609a.6.6,0,0,1-.425-1.026l2.227-2.227V181.6a.6.6,0,0,1,1.2,0v3a.6.6,0,0,1-.176.425l-2.4,2.4A.6.6,0,0,1,181.607,187.609Z" transform="translate(-181.006 -181)" fill="#e84e3b"/></g></g></g></svg>
                </span>
                <?php if( ! empty( $recipe->prep_time ) && $global_toggles['enable_prep_time'] ) : 
                ?>
                    <span class="dr-prep-time">
                        <span class="dr-meta-title"><?php echo esc_html( $global_toggles['prep_time_lbl'] ); ?></span>
                        <b><?php echo esc_html( $recipe->prep_time ) ?> <?php echo esc_html( $recipe->prep_time_unit ); ?></b>
                    </span>
                <?php endif;
                if( ! empty( $recipe->cook_time ) && $global_toggles['enable_cook_time'] ) : 
                ?>
                    <span class="dr-cook-time">
                        <span class="dr-meta-title"><?php echo esc_html( $global_toggles['cook_time_lbl'] ); ?></span>
                        <b><?php echo esc_html( $recipe->cook_time ) ?> <?php echo esc_html( $recipe->cook_time_unit ); ?></b>
                    </span>
                <?php endif;
                if( ! empty( $recipe->rest_time ) && $global_toggles['enable_rest_time'] ) : 
                ?>
                    <span class="dr-Rest-time">
                        <span class="dr-meta-title"><?php echo esc_html( $global_toggles['rest_time_lbl'] ); ?></span>
                        <b><?php echo esc_html( $recipe->rest_time ) ?> <?php echo esc_html( $recipe->rest_time_unit ); ?></b>
                    </span>
                <?php endif;
                if( ! empty( $recipe->total_time ) && $global_toggles['enable_total_time'] ) : 
                ?>
                    <span class="dr-total-time">
                        <span class="dr-meta-title"><?php echo esc_html( $global_toggles['total_time_lbl'] ); ?></span>
                        <b><?php echo esc_html( $recipe->total_time ) ?></b>
                    </span>
                <?php endif; ?>
            </span>
        <?php endif; 
        if ( ! empty( $recipe->no_of_servings ) && $global_toggles['enable_servings'] ) :
        ?>
            <span class="dr-sim-metaa dr-yields">
                <span class="dr-meta-title">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40.975" height="38.769" viewBox="0 0 40.975 38.769"><defs><filter id="Path_30603" x="0" y="0" width="40.975" height="38.769" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="blur"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Path_30603)"><path id="Path_30603-2" data-name="Path 30603" d="M25.623,65.891c1.266.678,3.7.471,5.556-1.383,1.838-1.838,2.532-4.525.795-6.321h0c-.009-.007-.038-.038-.045-.045h0c-1.794-1.737-4.48-1.043-6.321.795-1.852,1.854-2.061,4.29-1.383,5.556-.173,1.036-1.6,2.162-2.872,2.891A4.6,4.6,0,0,1,19,63.551a2.956,2.956,0,0,0-.849-2.415c-.061-.061-.234-.209-.234-.209l-4.8-3.742-.438.436,5.212,4.891-.565.565-5.05-5.048-.464.464,5.05,5.05-.478.478-5.048-5.05-.422.42,5.019,5.017-.574.577-4.876-5.162L10,60.3l3.986,5.022s.094.1.136.134a2.958,2.958,0,0,0,2.03.727l.016,0a4.726,4.726,0,0,1,3.807,2.169L12.57,75.766l0,0a.129.129,0,0,1-.019.014,1.167,1.167,0,0,0,0,1.653l.134.134a1.167,1.167,0,0,0,1.653,0,.13.13,0,0,0,.014-.019l0,0,7.2-7.2c1.9,1.9,7.16,7.158,7.16,7.158l0,0s.007.012.014.019A1.153,1.153,0,0,0,30.357,75.9c-.007-.007-.014-.009-.019-.014l0,0s-5.812-5.81-7.423-7.423C23.64,67.272,24.669,66.05,25.623,65.891Zm-.617-3.472A6.009,6.009,0,0,1,25.2,61.38a5.341,5.341,0,0,1,.2-.572,3.4,3.4,0,0,1,.307-.572,4.1,4.1,0,0,1,.865-.9,5.46,5.46,0,0,1,.882-.577,4.075,4.075,0,0,1,.687-.3,1.256,1.256,0,0,1,.279-.066,2.73,2.73,0,0,0-.211.183l-.53.495A13,13,0,0,0,26.231,60.6a2.839,2.839,0,0,0-.274.467c-.087.164-.164.333-.234.5-.145.333-.265.654-.37.931s-.181.513-.227.68a.492.492,0,0,0-.035.267A.5.5,0,0,1,25,63.171,3.815,3.815,0,0,1,25.007,62.419Z" transform="translate(-1 -51.14)" fill="#e84e3b"/></g></svg>
                    <?php echo esc_html( $global_toggles['servings_lbl'] ); ?>:
                </span>
                <b><?php echo esc_html( $recipe->no_of_servings ); ?></b>
            </span>
        <?php endif; 
        if( ! empty( $recipe->recipe_calories ) && $global_toggles['enable_calories'] ) :
        ?>
            <span class="dr-sim-metaa dr-calorie">
                <span class="dr-meta-title">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32.176" height="36.828" viewBox="0 0 32.176 36.828"><defs><filter id="Path_26351" x="0" y="0" width="32.176" height="36.828" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="blur"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g id="flame" transform="translate(-54.168 6)"><g transform="matrix(1, 0, 0, 1, 54.17, -6)" filter="url(#Path_26351)"><path id="Path_26351-2" data-name="Path 26351" d="M66.011,17.127a13.288,13.288,0,0,1-2.278-3.221A7.3,7.3,0,0,1,63.3,9.7a9.065,9.065,0,0,1,1.807-3.889,3.746,3.746,0,0,0,.943,2.75,6.535,6.535,0,0,1,1.493-5.421A11.228,11.228,0,0,1,72.335,0a3.872,3.872,0,0,0-.668,3.692,15.4,15.4,0,0,0,1.768,3.5A7.8,7.8,0,0,1,74.771,10.8a12.633,12.633,0,0,0,.982-2.082,4.114,4.114,0,0,0,.157-2.278,5.842,5.842,0,0,1,1.3,2.828,11.887,11.887,0,0,1,.039,3.339,8.35,8.35,0,0,1-1.139,3.5,6.56,6.56,0,0,1-3.417,2.553A7.768,7.768,0,0,1,66.011,17.127Z" transform="translate(-54.17 6)" fill="#e84e3b"/></g><path id="Path_26352" data-name="Path 26352" d="M153.555,226.112a3.866,3.866,0,0,0,4.635-5.5c0-.039-.039-.039-.039-.079a3.967,3.967,0,0,1-.982,3.457,3.669,3.669,0,0,0-.354-2.985c-.471-.9-1.139-1.728-1.65-2.593a4.175,4.175,0,0,1-.668-2.946,5.18,5.18,0,0,0-1.885,2.907,5.258,5.258,0,0,0,.393,3.457,2.582,2.582,0,0,1-1.061-1.886,4.045,4.045,0,0,0-.982,2.71A4,4,0,0,0,153.555,226.112Z" transform="translate(-84.559 -208.759)" fill="#fff"/></g></svg>
                    <?php echo esc_html( $global_toggles['calories_lbl'] ); ?>:
                </span>
                <b><?php echo esc_html( $recipe->recipe_calories ); ?></b>
            </span>
        <?php endif; 
        if( ! empty( $recipe->best_season ) && $global_toggles['enable_seasons'] ) :
        ?>
            <span class="dr-sim-metaa dr-season">
                <span class="dr-meta-title">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.781" height="37.154" viewBox="0 0 45.781 37.154"><defs><filter id="a" x="4.65" y="4.621" width="25.486" height="25.311" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="b"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="b"/><feComposite in="SourceGraphic"/></filter><filter id="c" x="7.632" y="0" width="19.872" height="21.363" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="d"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="d"/><feComposite in="SourceGraphic"/></filter><filter id="e" x="2.259" y="2.23" width="20.939" height="20.917" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="f"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="f"/><feComposite in="SourceGraphic"/></filter><filter id="g" x="0" y="7.603" width="21.392" height="19.872" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="h"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="h"/><feComposite in="SourceGraphic"/></filter><filter id="i" x="2.23" y="11.938" width="20.968" height="20.917" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="j"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="j"/><feComposite in="SourceGraphic"/></filter><filter id="k" x="11.968" y="2.23" width="20.939" height="20.917" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="l"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="l"/><feComposite in="SourceGraphic"/></filter><filter id="m" x="6.96" y="6.551" width="38.821" height="30.604" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="n"/><feFlood flood-color="#e84e3b" flood-opacity="0.259"/><feComposite operator="in" in2="n"/><feComposite in="SourceGraphic"/></filter></defs><g transform="translate(6.5 -11.3)"><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#a)"><path d="M25.886,35.381a3.921,3.921,0,1,0-5.527,5.03,5.352,5.352,0,0,1,3.509-1.93A7.613,7.613,0,0,1,25.886,35.381Z" transform="translate(-4.75 -22.48)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#c)"><path d="M29.536,20.663a.924.924,0,0,0,.936-.936V18.236a.936.936,0,1,0-1.872,0v1.491A.942.942,0,0,0,29.536,20.663Z" transform="translate(-11.97 -11.3)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#e)"><path d="M11.534,27.579a.926.926,0,0,0,.673.263.976.976,0,0,0,.673-.263.9.9,0,0,0,0-1.316L11.826,25.21a.93.93,0,1,0-1.316,1.316Z" transform="translate(1.03 -16.7)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#g)"><path d="M5.892,44.236a.924.924,0,0,0-.936-.936H3.436a.936.936,0,1,0,0,1.872H4.927A.949.949,0,0,0,5.892,44.236Z" transform="translate(6.5 -29.7)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#i)"><path d="M11.463,58.41,10.41,59.463a.9.9,0,0,0,0,1.316.926.926,0,0,0,.673.263,1.03,1.03,0,0,0,.673-.263l1.053-1.053a.9.9,0,0,0,0-1.316A.936.936,0,0,0,11.463,58.41Z" transform="translate(1.1 -40.19)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#k)"><path d="M44.353,27.842a1.03,1.03,0,0,0,.673-.263l1.053-1.053a.93.93,0,0,0-1.316-1.316L43.71,26.263a.921.921,0,0,0,.643,1.579Z" transform="translate(-22.46 -16.7)" fill="#e84e3b"/></g><g transform="matrix(1, 0, 0, 1, -6.5, 11.3)" filter="url(#m)"><path d="M42.734,43.5a3.97,3.97,0,0,0-.848.088,5.787,5.787,0,0,0-11.2,1.111,3.582,3.582,0,0,0-.556-.058,3.831,3.831,0,1,0,0,7.662h12.6a4.4,4.4,0,0,0,0-8.8Z" transform="translate(-10.34 -27.15)" fill="#e84e3b"/></g><path d="M30.984,40.783a1.132,1.132,0,0,0-.242.025,1.649,1.649,0,0,0-3.192.317,1.021,1.021,0,0,0-.158-.017,1.092,1.092,0,1,0,0,2.183h3.592a1.254,1.254,0,0,0,0-2.508Z" transform="translate(-4.921 -9.937)" fill="#fff"/></g></svg>
                    <?php echo esc_html( $global_toggles['seasons_lbl'] ); ?>:
                </span>
                <b><?php echo esc_html( $recipe->best_season ); ?></b>
            </span>
        <?php endif; ?>
    </div>
    <?php if ( ! empty( $recipe->recipe_description ) && $global_toggles['enable_description'] ) : ?>
        <div class="dr-summary">
            <h3 class="dr-title"><?php echo esc_html( $global_toggles['description_lbl'] ); ?></h3>
            <p><?php echo wp_kses_post( $recipe->recipe_description ); ?></p>
        </div>
    <?php endif; ?>
</div>
<?php
