<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spa and Salon
 */

$enabled_sections = spa_and_salon_get_sections();
$spa_and_salon_ed_banner_section   = get_theme_mod('spa_and_salon_ed_banner_section ');
$spa_and_salon_ed_featured_section = get_theme_mod('spa_and_salon_ed_featured_section');
                            
 
if( 'posts' == get_option( 'show_on_front' ) ){
    include( get_home_template() );
}elseif( $enabled_sections ){
    get_header();
        foreach( $enabled_sections as $spa_and_salon_section ){ ?>
            <section class="<?php echo esc_attr( $spa_and_salon_section['class'] ); ?>" id="<?php echo esc_attr( $spa_and_salon_section['id'] ); ?>">
                <?php get_template_part( 'sections/section', esc_attr( $spa_and_salon_section['id'] ) ); ?>
            </section>
            <?php
        }
    get_footer();    
}else{ 
    include( get_page_template() ); 
}