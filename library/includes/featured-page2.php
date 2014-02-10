<?php global $is_home; ?>

<div id="page" class="clearfix">
 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/slider.js"></script>


<div id="slider">
 	<div class="slider_top">
		<div class="slider_bottom">

                 	 <?php  if ( function_exists('dynamic_sidebar') && (is_sidebar_active(1)) ) { // Show on the front page ?>
							<?php  dynamic_sidebar(1); ?>  
                     <?php } ?>
                </div>
              </div>
            </div> <!-- slider #end -->
            <div class="front_advt" >
            	 <?php if ( function_exists('dynamic_sidebar') && (is_sidebar_active(2)) ) { // Show on the front page ?>
						<?php dynamic_sidebar(2); ?>  
                 <?php } ?>
            </div>
              
              <div class="clearfix"></div>
              
             <br />
              <h4><?php _e("Latest Products");?></h4>
              <?php include(TEMPLATEPATH . '/library/includes/tpl_latest_products.php'); ?>
              
            

         
<!--For Slider -->
 </div>         