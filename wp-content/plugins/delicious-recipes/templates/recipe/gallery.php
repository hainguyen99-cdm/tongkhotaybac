<?php
/**
 * Recipe single page gallery images.
 */
global $recipe;

// Check for images.
if ( ! isset( $recipe->thumbnail_id ) || empty( $recipe->thumbnail_id ) ) {
    return;
}
?>
<figure class="dr-feature-image">
    <?php
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'recipe-feat-gallery' ); 
        } else {
            echo wp_get_attachment_image( $recipe->thumbnail_id, 'recipe-feat-gallery' );
        }
    ?>
    <span class="post-pinit-button">
        <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>/&media=<?php echo esc_url( $recipe->thumbnail ); ?>&description=So%20delicious!" data-pin-custom="true">
            <img src="<?php echo plugin_dir_url( DELICIOUS_RECIPES_PLUGIN_FILE ) ?>/assets/images/pinit-sm.png" alt="pinit">
        </a>
    </span>
    <?php if ( isset( $recipe->image_gallery ) && ! empty( $recipe->image_gallery ) ) : ?>
        <a href="#" class="view-gallery-btn del-recipe-gallery-link">
            <b><?php echo esc_html__( 'View Gallery', 'delicious-recipes' ); ?></b>
            <span><?php 
                /* translators: %1$s: gallery images count */
                echo sprintf( _nx( '%1$s photo', '%1$s photos', count( $recipe->image_gallery ), 'delicious-recipes' ), number_format_i18n( count( $recipe->image_gallery ) ) ); 
            ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14.796" height="10.354" viewBox="0 0 14.796 10.354"><g transform="translate(0.75 1.061)"><path d="M7820.11-1126.021l4.117,4.116-4.117,4.116" transform="translate(-7811.241 1126.021)" fill="none" stroke="#374757" stroke-linecap="round" stroke-width="1.5"/><path d="M6555.283-354.415h-12.624" transform="translate(-6542.659 358.532)" fill="none" stroke="#374757" stroke-linecap="round" stroke-width="1.5"/></g></svg>
        </a>
        <div class="del-recipe-gallery">
            <?php foreach( $recipe->image_gallery as $key => $img ) : 
                $image_id = isset( $img['imageID'] ) ? $img['imageID'] : false;
                if ( $image_id ) :
                    $image_url = wp_get_attachment_image_url( $image_id, 'recipe-feat-gallery' );
                    ?>
                        <a href="<?php echo esc_url( $image_url ); ?>"></a>
                    <?php 
                endif;
            endforeach; ?>
        </div>
    <?php endif; ?>
</figure>
<?php
