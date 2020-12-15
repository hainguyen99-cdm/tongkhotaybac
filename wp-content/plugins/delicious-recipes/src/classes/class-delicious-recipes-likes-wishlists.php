<?php
/**
 * Recipes Likes / wishlists Class
 *
 * @package Delicious_Recipes
*/
class Delicious_Recipes_Likes_Wishlists {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'wp_ajax_recipe_likes', [ $this, 'recipe_like_cb' ] );
        add_action( 'wp_ajax_nopriv_recipe_likes', [ $this, 'recipe_like_cb' ] );
        add_action( 'delicious_recipes_like_button', [ $this, 'recipe_like_button' ], 10 );
    }

    /**
     * Get Real IP Address from client.
     *
     * @return void
     */
    public function get_real_ip_address(){
        if( getenv( 'HTTP_CLIENT_IP' ) ){
            $ip = getenv( 'HTTP_CLIENT_IP' );
        }elseif( getenv( 'HTTP_X_FORWARDED_FOR' ) ){
            $ip = getenv('HTTP_X_FORWARDED_FOR' );
        }elseif( getenv( 'HTTP_X_FORWARDED' ) ){
            $ip = getenv( 'HTTP_X_FORWARDED' );
        }elseif( getenv( 'HTTP_FORWARDED_FOR' ) ){
            $ip = getenv( 'HTTP_FORWARDED_FOR' );
        }elseif( getenv( 'HTTP_FORWARDED' ) ){
            $ip = getenv( 'HTTP_FORWARDED' );
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * Check if user can like the recipes post
     *
     * @param integer $id
     * @return boolean
     */
    public function can_like( $id = 0 ) {
        // Return early if $id is not set.
        if( ! $id ){
            return false;
        }

        $ip_list = ( $ip = get_post_meta( $id, '_recipe_likes_ip', true ) ) ? $ip  : array();

        if( ( $ip_list == '' ) || ( is_array( $ip_list ) && ! in_array( $this->get_real_ip_address(), $ip_list ) ) ){
            return true;
        }

        return false;
    }

    /**
     * Like button template
     *
     * @return void
     */
    public function recipe_like_button(){
        global $recipe;
        $like_count = $this->get_recipe_like_count( $recipe->ID );

        delicious_recipes_get_template( 'recipe/recipe-like.php', [
            'like_count' => $like_count,
            'id'         => $recipe->ID,
            'can_like'   => $this->can_like( $recipe->ID ) 
        ] );
    }

    /**
     * AJAX callback for recipe likes.
     *
     * @return void
     */
    public function recipe_like_cb(){
        $post_id = intval( $_POST['id'] );
        $likes   = ( $count = get_post_meta( $post_id, '_recipe_likes', true ) ) ? absint( $count ) : 0;
        $ip_list = ( $ip = get_post_meta( $post_id, '_recipe_likes_ip', true ) ) ? $ip : array();
        $likes   = $likes + 1;
        
        if( $this->can_like( $post_id ) ){            
            $ip_list[] = $this->get_real_ip_address();            
            update_post_meta( $post_id, '_recipe_likes', $likes );
            update_post_meta( $post_id, '_recipe_likes_ip', $ip_list );
        } else {
            wp_send_json_error(); 
        }
        $like_count = $this->get_recipe_like_count( $post_id );
        /* translators: %s: number of likes */
        wp_send_json_success( [ 'likes' => sprintf( _nx( '%s Like', '%s Likes', $like_count, 'number of likes', 'delicious-recipes' ), $like_count ) ] );
    }

    /**
     * Get recipe likes count
     *
     * @param [type] $post_id
     * @return void
     */
    public function get_recipe_like_count( $post_id ){
        $count = get_post_meta( $post_id, '_recipe_likes', true );
        if( $count ){
            return $count;
        }else{
            return 0;
        }   
    }
}

new Delicious_Recipes_Likes_Wishlists();
