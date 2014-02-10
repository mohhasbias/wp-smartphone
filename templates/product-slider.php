<?php
  global $paged;
  global $Product;
  
  $limit = 20;

  $blogCategoryIdStr = $categories;
  // echo "Categories: " . $categories;
  // query_posts('showposts=' . $limit .'&cat='.$blogCategoryIdStr.'&orderby=rand');
  
  $query = array(
      'showposts' => $limit,
      'paged' => $paged,
      'cat' => $blogCategoryIdStr,
      'ignore_sticky_posts' => 1,
      'post__not_in' => get_option('sticky_posts'),
      'category__not_in' => get_cat_ID('Artikel')
    );

  if( isset($include_artikel) && $include_artikel ){
    unset($query['category__not_in']);
  } 

  if( isset($include_sticky_post) && $include_sticky_post){
    unset($query['ignore_sticky_posts']);
    unset($query['post__not_in']);
  }

  if(isset($orderby)){
    //echo "Order by : " . $orderby;
    $query['orderby'] = $orderby;
  } else {
    //echo "Using default order by (date)";
  }
  
  query_posts($query);
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
      global $post;
      $data = get_post_meta( $post->ID, 'key', true );
      $product_price = $Product->get_product_price($post->ID);
?>
      <?php if ($postcounter % 5 == 0): ?>
        <?php if ($postcounter == 0): ?>
          <div class="products-slide row collapse">
        <?php else: ?>
          </div> <!-- end of products-slide -->
          <div class="products-slide row collapse">
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
              <img class="lazyload"
                <?php $src = $data['productimage']; ?>
                <?php if (strlen($src) > 0): ?>
                  src="<?php echo IMAGE_PATH . '/ajax-loader.gif'; ?>" 
                  data-original="<?php echo theme_thumb($src, 200, 165); ?>"
                <?php else: ?>
                  src="/holder.js/200x165/text:<?php the_title(); ?>"
                <?php endif; ?>
                alt="<?php the_title(); ?>"  
               />
            </a>  
            <div class="content">
              <h3>
                <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                  <?php echo r_wp_html_excerpt(the_title('','',false), 30, '...'); ?>
                </a>
              </h3>       
              <p class="sale_price" >
                <?php r_print_product_price($post); ?>
              </p>
            </div>
          </div>
              <!-- content block #end -->
        </div>
        <?php $postcounter++; ?>
    <?php endwhile; ?>
  </div>
</div>
<?php endif; ?>

<?php wp_reset_query(); ?>