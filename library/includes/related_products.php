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
	foreach($post_array as $postval)
	{
		$product_id = $postval->ID;
		$product_post_title = $postval->post_title;
		$productlink = $postval->guid;
		if($postval->post_status == 'publish'):
			$image_array = $General->get_post_image($product_id);
			$imagepath = WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$image_array[0]);
			$relatedprd_count++; 
?>
			<?php if($relatedprd_count == 1): ?>
    		<hr>
    	<?php endif; ?>
			<div class="content-block row">
	    	<div class="product-thumb small-5 columns">			
					<?php if($image_array[0]!='' && file_exists($imagepath)): ?>
							<?php if($Product->get_product_price_sale($product_id)>0): ?>
								<img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale-image" />
							<?php endif; ?>						
							<a href="<?php echo $productlink;?>">
					 			<img src="<?php echo theme_thumb($image_array[0],103, 143); ?>" title="<?php echo $product_post_title;?>" alt="<?php echo $product_post_title;?>"/>
				 			</a>
					<?php endif; ?>
				</div>
	    	<div class="small-7 columns">
	      	<a href="<?php echo $productlink;?>"><?php echo $product_post_title;?></a> 
      	</div>
    	</div>
    	<?php if($relatedprd_count < count($post_array)): ?>
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
