<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Spa_and_Salon
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function spa_and_salon_body_classes( $classes ) {
  global $post;
  
    if( !is_page_template( 'template-home.php' ) ){
        $classes[] = 'inner';
        // Adds a class of group-blog to blogs with more than 1 published author.
    }

	if ( is_multi_author() ) {
		$classes[] = 'group-blog ';
	}

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
    

    if( spa_and_salon_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }    

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_page() ) {
    	$classes[] = 'hfeed ';
    }
  
    if( is_404() ||  is_search() ){
        $classes[] = 'full-width';
    }
  
    if( ! is_active_sidebar( 'right-sidebar' ) ) {
        $classes[] = 'full-width'; 
    }
  
    if( is_page() ){
        $spa_and_salon_post_class = get_post_meta( $post->ID, 'spa_and_salon_sidebar_layout', true );   
        if( $spa_and_salon_post_class == 'no-sidebar' )
        $classes[] = 'full-width';
    }

	return $classes;
}
add_filter( 'body_class', 'spa_and_salon_body_classes' );

 /**
 * 
 * @link http://www.altafweb.com/2011/12/remove-specific-tag-from-php-string.html
 */
function spa_and_salon_strip_single( $tag, $string ){
    $string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
    $string=preg_replace('/<\/'.$tag.'>/i', '', $string);
    return $string;
}

if( ! function_exists( 'spa_and_salon_breadcrumbs_cb' ) ):  
/**
 * Custom Bread Crumb
 *
 * @link http://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
 */
 
function spa_and_salon_breadcrumbs_cb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'spa_and_salon_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'spa_and_salon_breadcrumb_separator', __( '>', 'spa-and-salon' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'spa_and_salon_breadcrumb_home_text', __( 'Home', 'spa-and-salon' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
      
    $depth = 1;  
    if( get_theme_mod( 'spa_and_salon_ed_breadcrumb' ) ){  
        echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            if( is_home() && ! is_front_page() ){            
                $depth = 2;
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
            }elseif( is_category() ){            
                $depth = 2;
                $thisCat = get_category( get_query_var( 'cat' ), false );
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    $depth ++;  
                }

                if ( $thisCat->parent != 0 ) {
                    $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                    $parent_categories = explode( ',', $parent_categories );

                    foreach ( $parent_categories as $parent_term ) {
                        $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                        if( is_object( $parent_obj ) ){
                            $term_url    = get_term_link( $parent_obj->term_id );
                            $term_name   = $parent_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }

                if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

            }elseif( is_tag() ){            
                $queried_object = get_queried_object();
                $depth = 2;

                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
            }elseif( is_author() ){            
                $depth = 2;
                global $author;
                $userdata = get_userdata( $author );
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
            }elseif( is_day() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'spa-and-salon' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'spa-and-salon' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'spa-and-salon' ) ), get_the_time( __( 'm', 'spa-and-salon' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'spa-and-salon' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'spa-and-salon' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                 
            }elseif( is_month() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'spa-and-salon' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'spa-and-salon' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'spa-and-salon' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( is_year() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'spa-and-salon' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }elseif( is_single() && !is_attachment() ) {
                //For Woocommerce single product            
                if( spa_and_salon_woocommerce_activated() && 'product' === get_post_type() ){ 
                    if ( wc_get_page_id( 'shop' ) ) { 
                        //Displaying Shop link in woocommerce archive page
                        $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                        if ( ! $_name ) {
                            $product_post_type = get_post_type_object( 'product' );
                            $_name = $product_post_type->labels->singular_name;
                        }
                        echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                    }
                
                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );

                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );    
                            if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth++;
                            }
                        }
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    }
                
                    if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                   
                }else{ 
                    //For Post                
                    $cat_object       = get_the_category();
                    $potential_parent = 0;
                    $depth            = 2;
                    
                    if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                        $p = get_post( $post_page );
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                        $depth++;
                    }
                    
                    if( is_array( $cat_object ) ){ //Getting category hierarchy if any
            
                        //Now try to find the deepest term of those that we know of
                        $use_term = key( $cat_object );
                        foreach( $cat_object as $key => $object ){
                            //Can't use the next($cat_object) trick since order is unknown
                            if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                                $use_term = $key;
                                $potential_parent = $object->term_id;
                            }
                        }
                        
                        $cat = $cat_object[$use_term];
                  
                        $cats = get_category_parents( $cat, false, ',' );
                        $cats = explode( ',', $cats );

                        foreach ( $cats as $cat ) {
                            $cat_obj = get_term_by( 'name', $cat, 'category' );
                            if( is_object( $cat_obj ) ){
                                $term_url    = get_term_link( $cat_obj->term_id );
                                $term_name   = $cat_obj->name;
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth ++;
                            }
                        }
                    }
        
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                 
                }        
            }elseif( is_page() ){            
                $depth = 2;
                if( $post->post_parent ){            
                    global $post;
                    $depth = 2;
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    
                    while( $parent_id ){
                        $current_page  = get_post( $parent_id );
                        $breadcrumbs[] = $current_page->ID;
                        $parent_id     = $current_page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                        if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                        $depth++;
                    }

                    if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
                }else{
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
                }
            }elseif( is_search() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'spa-and-salon' ) . esc_html( get_search_query() ) . esc_html__( '"', 'spa-and-salon' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( spa_and_salon_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ 
                //For Woocommerce archive page        
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { 
                    //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                }
                $current_term = $GLOBALS['wp_query']->get_queried_object();
                if( is_product_category() ){
                    $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }           
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $current_term->name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;           
            }elseif( spa_and_salon_woocommerce_activated() && is_shop() ){ //Shop Archive page
                $depth = 2;
                if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                    return;
                }
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
        
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                    
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
                $depth = 2;
                $post_type = get_post_type_object(get_post_type());
                if( get_query_var('paged') ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                    echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'spa-and-salon'), get_query_var('paged') ) . $after;
                }elseif( is_archive() ){
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }else{
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }              
            }elseif( is_attachment() ){            
                $depth  = 2;
                $parent = get_post( $post->post_parent );
                $cat    = get_the_category( $parent->ID );
                if( $cat ){
                    $cat = $cat[0];
                    echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
                }
                if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
            }elseif ( is_404() ){
                if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'spa-and-salon' ) . $after;
            }
            if( get_query_var('paged') ) echo __( ' (Page', 'spa-and-salon' ) . ' ' . get_query_var('paged') . __( ')', 'spa-and-salon' );        
            echo '</div>';
    }
} // end spa_and_salon_breadcrumbs()

endif; // End function_exists

add_action( 'spa_and_salon_breadcrumbs', 'spa_and_salon_breadcrumbs_cb' );

if( ! function_exists( 'spa_and_salon_social_link_cb' ) ):

/**Social Links**/
function spa_and_salon_social_link_cb(){

    $spa_and_salon_button_url_fb = get_theme_mod( 'spa_and_salon_button_url_fb');
    $spa_and_salon_button_url_tw = get_theme_mod( 'spa_and_salon_button_url_tw');
    $spa_and_salon_button_url_ln = get_theme_mod( 'spa_and_salon_button_url_ln');
    $spa_and_salon_button_url_rss = get_theme_mod( 'spa_and_salon_button_url_rss');
    $spa_and_salon_button_url_gp = get_theme_mod( 'spa_and_salon_button_url_gp');
    $spa_and_salon_button_url_pi = get_theme_mod( 'spa_and_salon_button_url_pi');
    $spa_and_salon_button_url_is = get_theme_mod( 'spa_and_salon_button_url_is');
    $spa_and_salon_button_url_yt = get_theme_mod( 'spa_and_salon_button_url_youtube');
    ?>
    <ul class="social-networks">
       <?php if( $spa_and_salon_button_url_fb ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_fb ) ?>"><i class="fa fa-facebook"></i></a></li>
      <?php } if( $spa_and_salon_button_url_tw ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_tw ) ?>"><i class="fa fa-twitter"></i></a></li>
      <?php } if( $spa_and_salon_button_url_ln ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_ln ) ?>"><i class="fa fa-linkedin"></i></a></li>
      <?php } if( $spa_and_salon_button_url_rss ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_rss ) ?>"><i class="fa fa-rss"></i></a></li>
      <?php } if( $spa_and_salon_button_url_gp ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_gp ) ?>"><i class="fa fa-google-plus"></i></a></li>
      <?php } if( $spa_and_salon_button_url_pi ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_pi ) ?>"><i class="fa fa-pinterest-p"></i></a></li>
      <?php }if( $spa_and_salon_button_url_yt ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_yt ) ?>"><i class="fa fa-youtube"></i></a></li>
      <?php } if( $spa_and_salon_button_url_is ){?>
      <li><a href="<?php echo esc_url( $spa_and_salon_button_url_is ) ?>"><i class="fa fa-instagram"></i></a></li>
      <?php } ?>
    </ul>
 <?php } 

 endif;
add_action( 'spa_and_salon_social_link', 'spa_and_salon_social_link_cb' );


if ( ! function_exists( 'spa_and_salon_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function spa_and_salon_excerpt_more($more) {
  return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'spa_and_salon_excerpt_more' );


if ( ! function_exists( 'spa_and_salon_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function spa_and_salon_excerpt_length( $length ) {
    if( is_page_template('template-home.php') ){
        return 20;
    }else{  
        return $length;
    }
}
endif;
add_filter( 'excerpt_length', 'spa_and_salon_excerpt_length', 999 );

if( ! function_exists( 'spa_and_salon_get_sections' ) ):
    
/** Function to get Sections */
 function spa_and_salon_get_sections(){
    
    $spa_and_salon_sections = array(
        'banner-section' => array(
            'class' => 'banner-section',
            'id' => 'banner'
        ),
        'featured-section' => array(
            'class' => 'promotional-block',
            'id' => 'featured'
        ), 
        'about-section' => array(
            'class' => 'welcome-note',
            'id' => 'about'
        ),
        'service-section' => array(
            'class' => 'services',
            'id' => 'service'
        ),
        'testimonial-section' => array(
            'class' => 'testimonial',
            'id' => 'testimonial'
        )              
    );
    
    $spa_and_salon_enabled_section = array();
    foreach ( $spa_and_salon_sections as $spa_and_salon_section ) {
        
        if ( esc_attr( get_theme_mod( 'spa_and_salon_ed_' . $spa_and_salon_section['id'] . '_section' ) ) == 1 ){
            $spa_and_salon_enabled_section[] = array(
                'id' => $spa_and_salon_section['id'],
                'class' => $spa_and_salon_section['class']
            );
        }
    }
    return $spa_and_salon_enabled_section;
 }

endif;

if( ! function_exists( 'spa_and_salon_banner_cb' ) ):
 /** CallBack function for Banner */
 function spa_and_salon_banner_cb(){
    $spa_and_salon_ed_banner_section = get_theme_mod( 'spa_and_salon_ed_banner_section' );
    $spa_and_salon_banner_post       = get_theme_mod( 'spa_and_salon_banner_post' );
    $spa_and_salon_banner_read_more  = get_theme_mod( 'spa_and_salon_banner_read_more',esc_html__( 'Get Started', 'spa-and-salon' ) );
    $spa_and_salon_enabled_sections  = spa_and_salon_get_sections();

    if( $spa_and_salon_ed_banner_section  &&  true == $spa_and_salon_banner_post ){
        $banner_qry = new WP_Query( array( 'p' => $spa_and_salon_banner_post ) );
        if( $banner_qry->have_posts() ){
            while( $banner_qry->have_posts() ){
                $banner_qry->the_post();
                if( has_post_thumbnail() ){
                    the_post_thumbnail( 'spa-and-salon-banner', array( 'itemprop' => 'image' ) );
                    ?>
                    <div class="banner-text">
                        <div class="container">
                            <div class="text">
                                <strong class="title"><?php the_title(); ?></strong>
                                <?php the_excerpt(); ?>
                                <?php if( $spa_and_salon_banner_read_more ): ?>
                                <a href="<?php the_permalink(); ?> " class="btn-green"><?php echo esc_html( $spa_and_salon_banner_read_more ); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if( $spa_and_salon_enabled_sections ) echo '<div class="arrow-down"></div>';
                }
            }
            wp_reset_postdata();
        }
    }                
}

 endif;
 
 add_action( 'spa_and_salon_banner', 'spa_and_salon_banner_cb' );



if( ! function_exists( 'spa_and_salon_featured_cb' ) ):
/** CallBack function for featured Section */
function spa_and_salon_featured_cb(){
 $spa_and_salon_featured_post_one = get_theme_mod( 'spa_and_salon_featured_post_one' );
 $spa_and_salon_featured_post_two = get_theme_mod( 'spa_and_salon_featured_post_two' );
 $spa_and_salon_featured_post_three = get_theme_mod( 'spa_and_salon_featured_post_three' );
 $spa_and_salon_favicon_one = get_theme_mod( 'spa_and_salon_favicon-one', esc_html__( 'money', 'spa-and-salon' ) );
 $spa_and_salon_favicon_two = get_theme_mod( 'spa_and_salon_favicon-two', esc_html__( 'thumbs-up', 'spa-and-salon' ) );
 $spa_and_salon_favicon_three = get_theme_mod( 'spa_and_salon_favicon-three', esc_html__( 'shopping-cart', 'spa-and-salon' ) );

 ?>
    <div class="container">

      <?php 
        if( $spa_and_salon_featured_post_one || $spa_and_salon_featured_post_two || $spa_and_salon_featured_post_three ){
            
            $spa_and_salon_featured_posts = array( $spa_and_salon_featured_post_one, $spa_and_salon_featured_post_two, $spa_and_salon_featured_post_three );
            $spa_and_salon_featured_posts = array_filter( $spa_and_salon_featured_posts );
            
            $spa_and_salon_favicon = array( $spa_and_salon_favicon_one, $spa_and_salon_favicon_two, $spa_and_salon_favicon_three );
            $spa_and_salon_favicon = array_filter( $spa_and_salon_favicon );
            
            $featured_qry = new WP_Query( array( 
                'post_type'             => 'post',
                'posts_per_page'        => -1,
                'post__in'              => $spa_and_salon_featured_posts,
                'orderby'               => 'post__in',
                'ignore_sticky_posts'   => true
            ) );
            $count = 0;

            if( $featured_qry->have_posts() ){
        ?>
        <div class="row">
          <?php
            while( $featured_qry->have_posts() ){
              $featured_qry->the_post();
          ?>
              <div class="col">
                  <?php                   
                    echo '<div class="img-holder">';
                        echo '<a href="'.  esc_url( get_permalink() )  .'" >';
                        if( has_post_thumbnail() ){ 
                            the_post_thumbnail( 'spa-and-salon-featured-block', array( 'itemprop' => 'image' ) );
                        }else{
                            spa_and_salon_get_fallback_svg( 'spa-and-salon-featured-block' );
                        } 
                        echo '</a>';

                          if( isset($spa_and_salon_favicon[$count] ) ){ ?>
                            <div class="icon-holder">
                              <span class="fa fa-<?php echo esc_html( $spa_and_salon_favicon[$count] ); ?>"></span>
                            </div>
                          <?php } 
                    echo'</div>'; ?>
                    <div class="text-holder">
                      <strong class="title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></strong>
                        <?php the_excerpt(); ?>
                          
                    </div>
              </div> 
              <?php
                $count ++;
            }
            wp_reset_postdata(); 
          ?>
        </div>
      <?php }   
        }
      ?>
    </div>
<?php }
 
 endif;
 add_action( 'spa_and_salon_featured', 'spa_and_salon_featured_cb' ); 

if( ! function_exists( 'spa_and_salon_footer_credit' ) ):
/**
 * Footer Credits 
*/
function spa_and_salon_footer_credit(){
    $copyright_text = get_theme_mod( 'spa_and_salon_footer_copyright_text' );

    $text  = '<div class="site-info"><div class="container"><span class="copyright">';
    if( $copyright_text ){
        $text .= wp_kses_post( $copyright_text ); 
    }else{
        $text .= esc_html__( '&copy; ', 'spa-and-salon' ) . date_i18n( esc_html__( 'Y', 'spa-and-salon' ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'. esc_html__( '. All Rights Reserved.', 'spa-and-salon' );
    }
    $text .= '</span>';
    $text .= '<span class="by">' . esc_html__( ' Spa And Salon | Developed By ', 'spa-and-salon' ) . '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'spa-and-salon' ) . '</a>.';
    $text .= sprintf( esc_html__( ' Powered by: %s', 'spa-and-salon' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'spa-and-salon' ) ) .'" target="_blank">WordPress</a>.' );
    if ( function_exists( 'the_privacy_policy_link' ) ) {
       $text .= get_the_privacy_policy_link();
    }
    $text .= '</span></div></div>';
    echo apply_filters( 'spa_and_salon_footer_text', $text );    
}
add_action( 'spa_and_salon_footer', 'spa_and_salon_footer_credit' );
endif;

if( ! function_exists( 'spa_and_salon_sidebar_layout' ) ):
/**
 * Return sidebar layouts for pages
*/
function spa_and_salon_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'spa_and_salon_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'spa_and_salon_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}
endif;

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'spa_and_salon_woocommerce_activated' ) ) {
  function spa_and_salon_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}

if( ! function_exists( 'spa_and_salon_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function spa_and_salon_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'spa-and-salon' ) : __( 'Name', 'spa-and-salon' ) );
    $email    = ( $req ? __( 'Email*', 'spa-and-salon' ) : __( 'Email', 'spa-and-salon' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'spa-and-salon' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'spa-and-salon' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'spa-and-salon' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'spa-and-salon' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'spa_and_salon_change_comment_form_default_fields' );

if( ! function_exists( 'spa_and_salon_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function spa_and_salon_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'spa-and-salon' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'spa-and-salon' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'spa_and_salon_change_comment_form_defaults' );

if( ! function_exists( 'spa_and_salon_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function spa_and_salon_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'spa-and-salon-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = spa_and_salon_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( spa_and_salon_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"      => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => spa_and_salon_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'spa_and_salon_single_post_schema' );

if( ! function_exists( 'spa_and_salon_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function spa_and_salon_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'spa_and_salon_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function spa_and_salon_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'spa_and_salon_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function spa_and_salon_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = spa_and_salon_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedddd;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'spa_and_salon_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function spa_and_salon_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Marcellus, translate this to 'off'. Do not translate into your own language.
    */
    $marcellus = _x( 'on', 'Marcellus font: on or off', 'spa-and-salon' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Lato, translate this to 'off'. Do not translate into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'spa-and-salon' );

    if ( 'off' !== $marcellus || 'off' !== $lato ) {
        $font_families = array();

        if( 'off' !== $marcellus ){
            $font_families[] = 'Marcellus';
        }

        if( 'off' !== $lato ){
            $font_families[] = 'Lato:400,700';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;