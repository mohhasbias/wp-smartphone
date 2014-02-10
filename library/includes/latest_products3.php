<?php

$limit = 20;

global $paged;
$blogCategoryIdStr = get_option('ptthemes_ctr3');
query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr.'&orderby=rand');
?>
<?php
if(have_posts()):
?>
  <div class="products-slider">
<?php
		$postcounter = 0;
    while(have_posts()):
      // $postcounter++;
			the_post();
      $data = get_post_meta( $post->ID, 'key', true );
      $product_price = $Product->get_product_price($post->ID);
?>
      <?php if ($postcounter % 5 == 0): ?>
        <?php if ($postcounter == 0): ?>
          <div class="products-slide">
        <?php else: ?>
          </div> <!-- end of products-slide -->
          <div class="products-slide">
        <?php endif; ?>
      <?php endif; ?>
      <?php global $wp_query; ?>
      <?php if ($postcounter+1 == $wp_query->found_posts): ?>
        <div class="two columns end">
      <?php else: ?>
        <div class="two columns">
      <?php endif; ?>
          <div class="content_block"> 
            <a href="<?php the_permalink() ?>" class="product_thumb"> 
              <?php if($Product->get_product_price_sale($post->ID)>0): ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale_img" />
              <?php endif; ?>
              <img data-src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $data['productimage']; ?>&amp;w=175&amp;zc=1&amp;q=80" 
                  alt="<?php the_title(); ?>"  />
            </a>  
            <div class="content">
              <h6>
                <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
                </a>
              </h6>       
              <p class="sale_price" ><?php r_print_product_price($post); ?></p>
            </div>
          </div>
              <!-- content block #end -->
        </div>
        <?php $postcounter++; ?>
    <?php endwhile; ?>
  </div>
</div>
<?php endif; ?>
