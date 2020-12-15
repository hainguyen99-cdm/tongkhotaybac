<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Polity Lite
 */
 
$polity_lite_show_footerinfo_sections 	   = esc_attr( get_theme_mod('polity_lite_show_footerinfo_sections', false) ); 
$polity_lite_show_header_footer_social_icons_sections        = esc_attr( get_theme_mod('polity_lite_show_header_footer_social_icons_sections', false) ); 
?>

<div class="site-footer">
           <div class="container fixfooter">  
                    
          <?php if ( is_active_sidebar( 'footer-widget-column-1' ) ) : ?>
                <div class="widget-column-1">  
                    <?php dynamic_sidebar( 'footer-widget-column-1' ); ?>
                </div>
           <?php endif; ?>
          
          <?php if ( is_active_sidebar( 'footer-widget-column-2' ) ) : ?>
                <div class="widget-column-2">  
                    <?php dynamic_sidebar( 'footer-widget-column-2' ); ?>
                </div>
           <?php endif; ?>
           
           <?php if ( is_active_sidebar( 'footer-widget-column-3' ) ) : ?>
                <div class="widget-column-3">  
                    <?php dynamic_sidebar( 'footer-widget-column-3' ); ?>
                </div>
           <?php endif; ?> 
           
           <?php if ( is_active_sidebar( 'footer-widget-column-4' ) ) : ?>
                <div class="widget-column-4">  
                    <?php dynamic_sidebar( 'footer-widget-column-4' ); ?>
                </div>
           <?php endif; ?>          
           
           <div class="clear"></div>
           
                    
     <?php if( $polity_lite_show_footerinfo_sections != ''){ ?>   
      <div class="footer_getintouch"> 
          <?php $polity_lite_footerphone = get_theme_mod('polity_lite_footerphone');
               if( !empty($polity_lite_footerphone) ){ ?>              
                 <div class="ftr3colbx">
                     <i class="fas fa-phone-volume"></i>               
                     <span><?php echo esc_html($polity_lite_footerphone); ?></span>   
                 </div>       
         <?php } ?>          
         
         <?php 
            $email = get_theme_mod('polity_lite_footeremail');
               if( !empty($email) ){ ?>                
                 <div class="ftr3colbx pinkbox">
                     <i class="fas fa-envelope-open-text"></i>
                     <span>
                        <a href="<?php echo esc_url('mailto:'.sanitize_email($email)); ?>"><?php echo sanitize_email($email); ?></a>
                    </span> 
                </div>            
         <?php } ?> 
         
         <?php if( $polity_lite_show_header_footer_social_icons_sections != ''){ ?>                
                    <div class="topsocial_icons ftr3colbx">                                                
					   <?php $polity_lite_facebook_link = get_theme_mod('polity_lite_facebook_link');
                        if( !empty($polity_lite_facebook_link) ){ ?>
                        <a class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($polity_lite_facebook_link); ?>"></a>
                       <?php } ?>
                    
                       <?php $polity_lite_twitter_link = get_theme_mod('polity_lite_twitter_link');
                        if( !empty($polity_lite_twitter_link) ){ ?>
                        <a class="fab fa-twitter" target="_blank" href="<?php echo esc_url($polity_lite_twitter_link); ?>"></a>
                       <?php } ?>
                
                      <?php $polity_lite_googleplus_link = get_theme_mod('polity_lite_googleplus_link');
                        if( !empty($polity_lite_googleplus_link) ){ ?>
                        <a class="fab fa-google-plus" target="_blank" href="<?php echo esc_url($polity_lite_googleplus_link); ?>"></a>
                      <?php }?>
                
                      <?php $polity_lite_linkedin_link = get_theme_mod('polity_lite_linkedin_link');
                        if( !empty($polity_lite_linkedin_link) ){ ?>
                        <a class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($polity_lite_linkedin_link); ?>"></a>
                      <?php } ?> 
                      
                      <?php $polity_lite_instagram_link = get_theme_mod('polity_lite_instagram_link');
                        if( !empty($polity_lite_instagram_link) ){ ?>
                        <a class="fab fa-instagram" target="_blank" href="<?php echo esc_url($polity_lite_instagram_link); ?>"></a>
                      <?php } ?> 
                 </div><!--end .topsocial_icons--> 
               <?php } ?> 
         
         
         
         
      </div><!--end .footer_getintouch-->                 
    <?php } ?>
                 
    <div class="clear"></div>   
           
      </div><!--end .container-->            

        <div class="copyrigh-wrapper"> 
            <div class="container">               
                <div class="center">
				   <?php bloginfo('name'); ?> - <?php esc_html_e('Theme by Grace Themes','polity-lite'); ?>  
                </div>
                <div class="clear"></div>                                
             </div><!--end .container-->             
        </div><!--end .copyrigh-wrapper-->  
                             
     </div><!--end #site-footer-->
</div><!--#end templatelayout-->
<?php wp_footer(); ?>
</body>
</html>