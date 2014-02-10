<?php
global $General;
$post_array = $General->get_post_array($post->ID);
?>
<div class="realated_product_section clearfix">
	<div class="ten columns">
	  <div class="options">
	    <h1><?php _e('Related Products');?></h1>
	  </div>
	</div>
  <ul class="realated_products inline-list ten columns">
<?php
if($post_array)
{
	$relatedprd_count = 0;
	foreach($post_array as $postval)
	{
		$product_id = $postval->ID;
		$product_post_title = $postval->post_title;
		$productlink = $postval->guid;
		if($postval->post_status == 'publish')
		{
	?>
		<?php
	$image_array = $General->get_post_image($product_id);
	$imagepath = WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$image_array[0]);
	if($image_array[0]!='' && file_exists($imagepath))
	{
		$relatedprd_count++;
		if($relatedprd_count == 4):
	?>
		<li class="two-half columns end">
		<?php else: ?>
		<li class="two-half columns">
		<?php endif; ?>
      <div class="content_block text-center thumb">
		<?php
				if($Product->get_product_price_sale($product_id)>0)
				{
				?>
				<img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale_img" />
				<?php
				}else
				{
				?>
				<?php
				}
				?>
		
		 <a href="<?php echo $productlink;?>" class="product_thumb" ><img src="<?php echo theme_thumb($image_array[0],139); ?>" title="<?php echo $product_post_title;?>" alt="<?php echo $product_post_title;?>"/></a>
		  <?php
		}
		?>
    <br />
      <a href="<?php echo $productlink;?>"><?php echo $product_post_title;?></a> 
      </div>
    </li>
		<?php
		}
		if($relatedprd_count==4)
		{
			break;
		}
	}
	
}
?>
  </ul>
</div>
