<?php global $is_home; ?>

<?php /*
<script type="text/javascript">var slider_image_path = '<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/slider.js"></script>
<script type="text/javascript">
<?php
if(get_option('ptthemes_homepage_sliderstop_flag'))
{
?>
var slider_speed = 7000;
<?php
}elseif(get_option('ptthemes_sliderspeed_homepage'))
{
?>
var slider_speed = <?php echo get_option('ptthemes_sliderspeed_homepage');?>;
<?php }else
{
?>
var slider_speed = 1800;
<?php
}
?>
*/?>
</script>



<div id="page-old" class="clearfix-old row hide-for-small">
  <div id="content-old" class="ten columns"  >
             	
<?php  
if ( function_exists('dynamic_sidebar') && (is_sidebar_active(1)) ) { // Show on the front page 
  dynamic_sidebar(5); 
} 
?>                
  
      <div class="ten columns">
        <div class="options">
          <h1 class="clearboth-old">
            <a href="<?php echo home_url(); ?>/?page=store">
              &raquo; Produk Terbaru
            </a>
          </h1> 
        </div>
 			</div> 	
        <div class="ten columns products_box">  
          <?php //r_render(TEMPLATEPATH . '/library/includes/tpl_latest_products.php')?>
          <?php 
            $categories = str_replace(',',',-',get_inc_categories("cat_exclude_"));
            r_render(TEMPLATEPATH . "/templates/product-slider.php", array(
              'categories' => $categories,
              'include_artikel' => true,
              'include_sticky_post' => true
              )); 
          ?>
      </div>

<?php global $shortname; ?>
<?php if ( get_option($shortname . '_show_cat_home') ) : ?>             	
  <?php for($i = 0;$i < 10;$i++): ?> 
    <?php $categories = get_option($shortname . '_ctr' . ($i+1)); ?>
    <?php 
    $args = array(
      'include'   => $categories,
    	'title_li'  => __( '' ),
    	'style'     => 'none',
      'echo'      => '0'
    );
    $list_categories = get_categories($args);
    ?>
    <?php if (strlen($categories) > 0 && 
            $categories != -1 && 
            $categories != 1 &&
            $categories != 0 && 
            !empty($list_categories)): ?>
      <div class="ten columns">
        <div class="options">
				  <h1 class="clearboth-old">
            &raquo;
            <?php 
              $list = wp_list_categories($args);
              // $list = ucwords(strtolower($list));
              $list = str_replace(
                  '<br />', ', ', $list);
                  
              $list = rtrim(trim($list), ', ');
              echo $list;
            ?>
          </h1>
        </div>
	    </div>
      <div class="ten columns products_box">  
        <?php //$template = "/library/includes/latest_products" . ($i+1) . ".php"; ?>
        <?php //echo $template; ?>
        <?php 
          r_render(TEMPLATEPATH . "/templates/product-slider.php", 
            array(
              'categories' => $categories,
              'orderby' => 'rand'
                ));
        ?>
      </div>
    <?php //else: echo "template " . ($i+1) . " is hidden<br/>"; ?>
    <?php endif; ?>
  <?php endfor; ?>
<?php endif; ?>
                
                
                
                
              </div>          
              
<!--For Slider -->
 </div>        
 

<div id="seo-text" class="ten columns hide-for-small">
  <?php wp_nav_menu(array(
     'theme_location' => 'seo_texts',
     'depth' => 1,
     'menu_class' => 'accordion',
     'container' => '',
     'walker' => new R_Seo_Text_Walker_Nav_Menu,
     'fallback_cb' => 'r_missing_seo_texts_menu'
     )); ?>
 </div> 
