<?php
$limit = 20;

$posts_per_page_homepage = $limit;
global $paged;
$blogCategoryIdStr =    str_replace(',',',-',get_inc_categories("cat_exclude_"));
// $query = 'showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr . '&ignore_sticky_posts=1' . '&post__not_in=' . get_option('sticky_posts');
$query = array(
  'showposts' => $limit,
  'paged' => $paged,
  'cat' => $blogCategoryIdStr,
  'ignore_sticky_posts' => 1,
  'post__not_in' => get_option('sticky_posts'),
  'category__not_in' => 5025 // exclude category article
);
// echo $query;
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
          <div class="products-slide">
        <?php else: ?>
          </div> <!-- end of products-slide -->
          <div class="products-slide">
        <?php endif; ?>
      <?php endif; ?>
        <div class="two columns<?php global $wp_query; echo ($wp_query->current_post==$wp_query->found_posts-1)? " end":""?>">
          <div class="content_block"> 
            <a href="<?php the_permalink() ?>" class="product_thumb"> 
              <?php if($Product->get_product_price_sale($post->ID)>0): ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale_img" />
              <?php endif; ?>
              <img src="holder.js/160x200" data-src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $data['productimage']; ?>&amp;w=175&amp;zc=1&amp;q=80" 
                  alt="<?php the_title(); ?>"  />
            </a>  
            <div class="content">
              <h3>
                <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
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

<!-- sidebar #end -->