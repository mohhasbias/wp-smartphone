<?php
global $General;
$post_array = $General->get_post_array($post->ID);
?>
<div class="realated_product_section clearfix">
	<div class="small-12 columns">
	  <div class="options">
	    <h3><?php _e('Related Products');?></h3>
	  </div>
	</div>
  <div class="products_box small-12 columns">
<?php
if($post_array)
{
	$relatedprd_count = 0;
	$total_relatedprd = count($post_array);
	foreach($post_array as $postval)
	{
		$product_id = $postval->ID;
		$product_post_title = $postval->post_title;
		$productlink = $postval->guid;
		if($postval->post_status == 'publish'):
			$image_array = $General->get_post_image($product_id);
			$imagepath = WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$image_array[0]);
			$price_sale = $Product->get_product_price_sale($product_id);
			$product_image = $image_array[0];
			$relatedprd_count++; 
?>
			<?php if($relatedprd_count == 1): ?>
    			<hr>
    		<?php endif; ?>
    		<div class="content-block row"> 
			    <a href="<?php echo $productlink; ?>" class="product-thumb small-5 columns"> 
			      <?php if($price_sale>0): ?>
			        <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php echo $product_post_title; ?>" class="sale-image" />
			      <?php endif; ?>
			      <img class="lazyload"
			        data-lazyload
			        src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif"
			        data-original="<?php echo theme_thumb($product_image, 103, 143); ?>" 
			          alt="<?php echo $product_post_title; ?>"  />
			    </a>  
			    <div class="content small-7 columns">
			      <a href="<?php echo $productlink; ?>" title="Permanent Link to <?php echo $product_post_title; ?>">
			        <h3 style="font-family: 'Open Sans';">
			          <?php echo $product_post_title; ?>
			          <?php //echo $search->current_post; ?>
			        </h3> 
			        <p class="sale_price" ><?php r_print_product_price($postval); ?></p>
			      </a>      
			    </div>
			</div>
	    	<?php if($relatedprd_count < $total_relatedprd && $relatedprd_count < 4): ?>
	    		<hr>
	    	<?php endif; ?>
		<?php endif; ?>
		<?php
		if($relatedprd_count==4)
		{
			break;
		}
	}
	
}
?>
  </div>
</div>
