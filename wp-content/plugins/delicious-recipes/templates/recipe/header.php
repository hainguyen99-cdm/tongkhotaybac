<?php
/**
 * Recipe page header.
 */
global $recipe;

// Get global toggles.
$global_toggles = delicious_recipes_get_global_toggles_and_labels();
$recipe_global  = delicious_recipes_get_global_settings();
?>
<header class="dr-entry-header">
    <?php 
        $enableRecipeSingleHead = isset( $recipe_global['enableRecipeSingleHead'][0] ) && 'yes' === $recipe_global['enableRecipeSingleHead'][0] ? true : false;

        if ( $enableRecipeSingleHead ) :
    ?>
        <div class="dr-category">
            <?php the_terms( $recipe->ID, 'recipe-course', '', '', '' ); ?>
        </div>
        <h1 class="dr-entry-title"><?php echo esc_html( $recipe->name ); ?></h1>
        <div class="dr-entry-meta">
            <?php if ( $global_toggles['enable_recipe_author'] ): ?>
                <span class="dr-byline">
                    <?php echo get_avatar( $recipe->author_id, 32 ); ?>
                    <a href="<?php echo esc_url( get_author_posts_url( $recipe->author_id ) ) ?>" class="fn"><?php echo esc_html( $recipe->author ); ?></a>
                </span>
            <?php endif; ?>

            <?php if ( $global_toggles['enable_published_date'] ): ?>
                <span class="dr-posted-on">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="33" height="31" viewBox="0 0 33 31"><defs><filter id="Rectangle_1344" x="0" y="0" width="33" height="31" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="blur"/><feFlood flood-color="#e84e3b" flood-opacity="0.102"/><feComposite operator="in" in2="blur"/><feComposite in="SourceGraphic"/></filter></defs><g id="Group_5559" data-name="Group 5559" transform="translate(-534.481 -811)"><g transform="matrix(1, 0, 0, 1, 534.48, 811)" filter="url(#Rectangle_1344)"><rect id="Rectangle_1344-2" data-name="Rectangle 1344" width="15" height="13" transform="translate(9 6)" fill="#fff"/></g><path id="Path_30675" data-name="Path 30675" d="M5.84,23.3a2.279,2.279,0,0,1-2.277-2.277V10.1A2.279,2.279,0,0,1,5.84,7.821H7.206V6.455a.455.455,0,0,1,.911,0V7.821h6.375V6.455a.455.455,0,0,1,.911,0V7.821h1.366A2.28,2.28,0,0,1,19.044,10.1V21.026A2.279,2.279,0,0,1,16.767,23.3ZM4.474,21.026A1.367,1.367,0,0,0,5.84,22.392H16.767a1.368,1.368,0,0,0,1.366-1.366V12.374H4.474ZM5.84,8.732A1.367,1.367,0,0,0,4.474,10.1v1.366h13.66V10.1a1.368,1.368,0,0,0-1.366-1.366Z" transform="translate(539.437 808)" fill="#abadb4"/><g id="Group_5542" data-name="Group 5542" transform="translate(547.149 822.506)"><path id="Path_30676" data-name="Path 30676" d="M1036.473-439.908a.828.828,0,0,1,.831.814.832.832,0,0,1-.833.838.831.831,0,0,1-.825-.822A.826.826,0,0,1,1036.473-439.908Z" transform="translate(-1035.646 439.908)" fill="#374757"/><path id="Path_30677" data-name="Path 30677" d="M1105.926-439.908a.826.826,0,0,1,.831.826.832.832,0,0,1-.821.826.831.831,0,0,1-.836-.823A.827.827,0,0,1,1105.926-439.908Z" transform="translate(-1099.534 439.908)" fill="#374757"/><path id="Path_30678" data-name="Path 30678" d="M1071.255-439.909a.821.821,0,0,1,.81.844.825.825,0,0,1-.847.809.825.825,0,0,1-.8-.851A.821.821,0,0,1,1071.255-439.909Z" transform="translate(-1067.628 439.909)" fill="#374757"/><path id="Path_30679" data-name="Path 30679" d="M1036.473-439.908a.828.828,0,0,1,.831.814.832.832,0,0,1-.833.838.831.831,0,0,1-.825-.822A.826.826,0,0,1,1036.473-439.908Z" transform="translate(-1035.646 443.397)" fill="#374757"/><path id="Path_30680" data-name="Path 30680" d="M1105.926-439.908a.826.826,0,0,1,.831.826.832.832,0,0,1-.821.826.831.831,0,0,1-.836-.823A.827.827,0,0,1,1105.926-439.908Z" transform="translate(-1099.534 443.397)" fill="#374757"/><path id="Path_30681" data-name="Path 30681" d="M1071.255-439.909a.821.821,0,0,1,.81.844.825.825,0,0,1-.847.809.825.825,0,0,1-.8-.851A.821.821,0,0,1,1071.255-439.909Z" transform="translate(-1067.628 443.397)" fill="#374757"/></g></g></svg>
                    <time><?php echo esc_html( delicious_recipes_get_formated_date( $recipe->date_published ) ); ?></time>
                </span>
            <?php endif; ?>

            <?php if ( $global_toggles['enable_comments'] ): ?>
                <span class="dr-comment">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35.556" height="36.263" viewBox="0 0 35.556 36.263"><defs><filter id="a" x="0" y="0" width="35.556" height="36.263" filterUnits="userSpaceOnUse"><feOffset dy="3" input="SourceAlpha"/><feGaussianBlur stdDeviation="3" result="b"/><feFlood flood-color="#e84e3b" flood-opacity="0.102"/><feComposite operator="in" in2="b"/><feComposite in="SourceGraphic"/></filter></defs><g transform="translate(-867.5 -4569.5)"><g transform="matrix(1, 0, 0, 1, 867.5, 4569.5)" filter="url(#a)"><path d="M14.191,128H2.365A2.574,2.574,0,0,0,0,130.365v7.1a2.316,2.316,0,0,0,2.365,2.365H3.548v4.73l4.73-4.73h5.913a2.638,2.638,0,0,0,2.365-2.365v-7.1A2.574,2.574,0,0,0,14.191,128Z" transform="translate(9.5 -121.5)" fill="#fff" stroke="rgba(55,71,87,0.42)" stroke-width="1"/></g><path d="M1036.824-439.908a1.181,1.181,0,0,1,1.185,1.161,1.186,1.186,0,0,1-1.187,1.2,1.184,1.184,0,0,1-1.176-1.172A1.177,1.177,0,0,1,1036.824-439.908Z" transform="translate(-155.677 5020.164)" fill="#374757"/><path d="M1106.277-439.908a1.178,1.178,0,0,1,1.185,1.178,1.186,1.186,0,0,1-1.171,1.178,1.184,1.184,0,0,1-1.193-1.173A1.179,1.179,0,0,1,1106.277-439.908Z" transform="translate(-217.195 5020.164)" fill="#374757"/><path d="M1071.613-439.909a1.171,1.171,0,0,1,1.155,1.2,1.177,1.177,0,0,1-1.207,1.153,1.177,1.177,0,0,1-1.146-1.214A1.171,1.171,0,0,1,1071.613-439.909Z" transform="translate(-186.473 5020.166)" fill="#374757"/></g></svg>
                    <a href="#comments"><?php 
                        /* translators: %s: total comments count */
                        echo sprintf( _nx( '%s Comment', '%s Comments', number_format_i18n( $recipe->comments_number ), 'number of comments', 'delicious-recipes' ), number_format_i18n( $recipe->comments_number ) ); 
                    ?></a>
                </span>
            <?php endif; ?>

            <?php if ( $recipe->rating && $global_toggles['enable_ratings'] ): ?>
                <span class="dr-rating">
                    <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/star-rating.svg" alt="star rating">
                    <a href="#comments"><?php echo esc_html( $recipe->rating ); ?></a>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ( isset( $recipe->recipe_subtitle )  && ! empty( $recipe->recipe_subtitle ) ) : ?>
        <div class="dr-info">
            <?php echo wp_kses_post( $recipe->recipe_subtitle ) ?>
        </div>
    <?php endif; ?>
    <div class="dr-buttons">
        <?php if ( $global_toggles['enable_jump_to_recipe'] ) : ?>
            <a href="#dr-recipe-meta-main" class="dr-btn-link dr-btn1"><?php echo esc_html( $global_toggles['jump_to_recipe_lbl'] ); ?> <svg xmlns="http://www.w3.org/2000/svg" width="9.647" height="14.193" viewBox="0 0 9.647 14.193"><g transform="translate(8.94 0.5) rotate(90)"><path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1"/><path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="#232323" stroke-linecap="round" stroke-width="1"/></g></svg></a>
        <?php endif; ?>

        <?php if ( ! empty( $recipe->video_gallery ) && $global_toggles['enable_jump_to_video'] ) : ?>
            <a href="#dr-video-gallery" class="dr-btn-link dr-btn1"><i class="fas fa-play"></i><?php echo esc_html( $global_toggles['jump_to_video_lbl'] ); ?></a>
        <?php endif; ?>

        <?php
            if ( $global_toggles['enable_print_recipe'] ) {
                delicious_recipes_get_template_part( 'recipe/print', 'btn' );
            }
        ?>
    </div>
</header>
<?php
