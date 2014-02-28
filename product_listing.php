<?php
/*
Template Name: Product Listing Page
*/
?>

<?php 
get_header(); 
global $Product,$Cart;
?>

<div>
  <?php r_render(TEMPLATEPATH . "/templates/breadcrumbs.php"); ?>
</div>              

<div id="content-old">
  <div class="row">  
    <div class="small-12 columns">
      <div class="options">
  	    <h2 class="clearboth-old text-left"><?php single_cat_title(); ?></h2> 
      </div>
      <div id="preview"></div>
  	</div>
  </div>
  
  <?php if(have_posts()): ?>
    <div class="row">
      <div id="outer-box" class="small-12 columns">
        <div class="products_box"> 
          <div id="loading-box"></div>  
          <hr>
          <?php while(have_posts()): the_post(); ?>
            <?php 
              $data = get_post_meta( $post->ID, 'key', true );		  
		      $product_image = $data['productimage'];
		      $price_sale = $Product->get_product_price_sale($post->ID);
            ?>
			<?php $path = TEMPLATEPATH . "/templates/product-line-item.php"; ?>
			<?php include($path); ?>
            <?php if ($wp_query->current_post+1 < $wp_query->post_count): ?>
              <hr>
            <?php endif; ?>
          <?php endwhile; ?>
          <hr>
          
          <div class="row">
            <div class="Navi-old ten columns">
              <?php r_show_pagination(); ?>
           </div>
         </div>
        </div>
      </div>
    </div>
  <?php endif; ?>  
                   
</div>

<?php get_footer(); ?>