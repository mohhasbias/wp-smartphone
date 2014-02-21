<div class="content-block row"> 
    <a href="<?php the_permalink() ?>" class="product-thumb small-5 columns"> 
      <?php if($price_sale>0): ?>
        <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale-image" />
      <?php endif; ?>
      <img class="lazyload"
        data-lazyload
        src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif"
        data-original="<?php echo theme_thumb($product_image, 103, 143); ?>" 
          alt="<?php the_title(); ?>"  />
    </a>  
    <div class="content small-7 columns">
      <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
        <h3>
          <?php the_title(); ?>
          <?php //echo $search->current_post; ?>
        </h3> 
        <p class="sale_price" ><?php r_print_product_price($post); ?></p>
      </a>      
    </div>
</div><!-- content block #end -->