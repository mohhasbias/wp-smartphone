<?php 
session_start();
ob_start();
get_header(); 
global $Product,$Cart, $General;
$product_price = $Product->get_product_price($post->ID);
$product_cart_price = $Product->get_product_price_no_currency($post->ID);
$product_qty = $Product->get_product_qty($post->ID);
$product_size = $Product->get_product_custom_dl($post->ID,'size');
$product_color = $Product->get_product_custom_dl($post->ID,'color');
$product_tax = $General->get_product_tax();
$customarray = array('size','color');
//$product_custom_dl_jscript = $Product->get_product_custom_dl_jscript($post->ID,$customarray);
$data = get_post_meta( $post->ID, 'key', true );
?>
<?php get_header(); ?>

  
<script> var closebutton='<?php bloginfo('template_directory'); ?>/library/js/closebox.png'; </script>
<!--<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/fancyzoom.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/thickbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($) {
	$('div.photo a').fancyZoom({scaleImg: true, closeOnClick: true});
	$('#medium_box_link').fancyZoom({width:400, height:300});
	$('#large_box_link').fancyZoom();
	$('#flash_box_link').fancyZoom();
});
</script>

<div class="two columns">
  <?php 
    r_render(
            TEMPLATEPATH . '/templates/popover-menu.php', 
            array(
              'maintainHover' => false
              ));
  ?>
</div>
<div id="search" class="eight columns">
  <?php get_search_form(); ?>
</div>                
                
<!-- <div id="page-old" class="ten columns"> -->
  <div class="ten columns">
    <?php r_render(TEMPLATEPATH . "/templates/breadcrumbs.php"); ?>
  </div>
  <aside class="three columns">
    <div class="row collapse">
      <div class="ten columns">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </aside>
  <div id="content-old" class="seven columns">    

    <?php
		$blogCategoryIdStr = get_inc_categories("cat_exclude_");
		$blogCategoryIdArr = explode(',',$blogCategoryIdStr);
		if(have_posts())
		{
			$post_count = 1;
			while(have_posts())
			{
				$post_count++;
				the_post();
				$cagInfo = get_the_category();
				$postCatId = $cagInfo[0]->term_id;
				if(!in_array($postCatId,$blogCategoryIdArr))  //DISPLAY PRODUCT
				{
          ?>
          <div class="row">
            <div class="ten columns">
              <div class="options">
                <h1 class="head-old">
                  <?php the_title(); ?>
                </h1> 
              </div>
              <div id="sharer">
                <!-- Place this tag where you want the +1 button to render -->
                <g:plusone annotation="inline"></g:plusone>
                <!-- Place this render call where appropriate -->
                <script type="text/javascript">
                  window.___gcfg = {lang: 'id'};
                  (function() {
                    var po = document.createElement('script'); 
                    po.type = 'text/javascript'; 
                    po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(po, s);
                  })();
                </script>
              </div>
            </div>
          </div>
          <?php 
					include(TEMPLATEPATH . '/library/includes/product_detail.php');
				}else ///DISPLAY BLOG POST
				{
					include(TEMPLATEPATH . '/library/includes/blog_detail.php');
				}
 
			  if($post_count>1)
			  {
				  break;
			  }
			}

		}else
		{
			?>
      <?php global $shortname; ?>
      <div class="posts">
        <div class="entry-head">
          <h2><?php echo get_option($shortname . '_404error_name'); ?></h2>
        </div>
        <div class="entry-content">
          <p><?php echo get_option($shortname . '_404solution_name'); ?></p>
        </div>
      </div>
  <?php
		}
		 ?>       

  <!-- merapikan keyword plugin STT2 -->
  <div style="max-height:32px;overflow:auto;clear:both;font-size:10px;font-family:Arial;width:auto;line-height:16px;padding:5px 5px;">
  <?php if(function_exists('stt_terms_list')) echo stt_terms_list() ;?></div>			

  </div> <!-- content #end -->

<div class="ten columns">
  <hr/>
</div>
<!-- </div>  --><!-- page #end -->
 <?php get_footer(); ?>