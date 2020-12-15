<?php
/**
 * Testimonial Section
 * 
 * @package Spa_and_Salon
 */
 
 $spa_and_salon_testimonial_section_title = get_theme_mod( 'spa_and_salon_testimonial_section_title',esc_html__( 'Client Testimonials', 'spa-and-salon' ) );
 $spa_and_salon_testimonial_section_content = get_theme_mod( 'spa_and_salon_testimonial_section_content' );
 $spa_and_salon_testimonial_section_cat = get_theme_mod( 'spa_and_salon_testimonial_section_cat' );
 echo '<div class="container">';
 if( $spa_and_salon_testimonial_section_title || $spa_and_salon_testimonial_section_content ){
    echo '<header class="header">' ;
        if( $spa_and_salon_testimonial_section_title ) echo '<h2>' . esc_html( $spa_and_salon_testimonial_section_title ) . '</h2>';
        if( $spa_and_salon_testimonial_section_content ) echo wpautop( esc_html( $spa_and_salon_testimonial_section_content ) ); 
    echo '</header>';
 }
 
 if( $spa_and_salon_testimonial_section_cat ){
    $testimonial_qry = new WP_Query( array( 'cat' => $spa_and_salon_testimonial_section_cat, 'posts_per_page' => -1, 'ignore_sticky_posts'   => true ) );
    if( $testimonial_qry->have_posts() ){
    ?>
    <div id="slider" class="flexslider">
		<ul class="slides">
        <?php 
        while( $testimonial_qry->have_posts() ){
            $testimonial_qry->the_post();
            ?>
            <li>
				<div class="holder">
				    <div class="row">
				        <?php 
                        echo'<div class="img-holder">';
                            if( has_post_thumbnail() ){ 
                                the_post_thumbnail( 'spa-and-salon-testmonial', array( 'itemprop' => 'image' ) );
                            }else{
                                spa_and_salon_get_fallback_svg( 'spa-and-salon-testmonial' );
                            }
                        echo'</div>'; ?>
				        <div class="text-holder">
					       <div class="holder">
					           <h3 class="name"><?php the_title(); ?></h3>
					           <?php the_content('', false, ''); ?>
					       </div>
				        </div>    
        		    </div>
				</div>
			</li>
            <?php
        }        
        ?>
    	</ul>
    </div>
    <?php
    }
    // rewind
    $testimonial_qry->rewind_posts();
    
    if( $testimonial_qry->have_posts() ){ ?>

    <div id="carousel" class="flexslider">
  	    <ul class="nav-thumb">
  		    <?php 
                while( $testimonial_qry->have_posts() ){
                $testimonial_qry->the_post();
            ?>
            <li>
			<?php
			    if( has_post_thumbnail() ){ 
                    the_post_thumbnail( 'spa-and-salon-testmonial-thumb', array( 'itemprop' => 'image' ) );
                }else{
                    spa_and_salon_get_fallback_svg( 'spa-and-salon-testmonial-thumb' );
                } 
            ?>
    		
    		</li>

    		<?php } ?>
  	    </ul>
    </div>
    <?php
    }
    wp_reset_postdata();
 }
 echo '</div>';