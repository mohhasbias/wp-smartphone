<?php
/*
Template Name: Store Page
*/
?>
<?php get_header(); ?>


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

<div id="page-old"  class="container_16-old clearfix-old">
	<div class="ten columns">
  		<?php r_render(TEMPLATEPATH . "/templates/breadcrumbs.php", array(
  				'page_name' => 'Store'
  			)); ?>
	</div>

 	<aside class="three columns">
 		<div class="row collapse">
 			<div class="ten columns">
 		 		<?php get_sidebar(); ?>
 		 	</div>
 		 </div>
	</aside>

 <div id="content-old" class="seven columns"> 
 	<div class="row">
 		<div class="ten columns">
 			<div class="options"> 
 				<h2 class="head-old"><?php _e('Store');?></h2>
 			</div>
 		</div>
 	</div>  
    

<?php
$limit = 20; // number of posts per page for store page

$posts_per_page_homepage = $limit;
global $paged;
$blogCategoryIdStr = str_replace(',',',-',get_inc_categories("cat_exclude_"));
query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr);
?>



	<?php if(have_posts()): ?>
 	<div class="row">
      <div id="outer-box" class="ten columns">       
        <div class="products_box">  
          <div class="row">
            <div class="Navi-old ten columns">
              <?php r_show_pagination(); ?>
            </div>
          </div>
          <div id="loading-box"></div>        
          <div class="row collapse">
            <?php
        		  $postcounter = 0;
              while(have_posts()):
                $postcounter++;
        			  the_post();
                $data = get_post_meta( $post->ID, 'key', true );
                $product_price = $Product->get_product_price($post->ID);
            ?>
              <?php if ($wp_query->current_post == 0): ?>
                <div class="row collapse">
              <?php elseif ($wp_query->current_post%4 == 0): ?>
                </div>
                <div class="row collapse">
              <?php endif; ?>
              <?php if($wp_query->current_post < $wp_query->post_count-1): ?>
                <div class="two-half columns">
              <?php else: ?>
                <div class="two-half columns end">
              <?php endif; ?>
                <div class="content_block thumb">
                  <a href="<?php the_permalink(); ?>">
                    <?php if($Product->get_product_price_sale($post->ID)>0) : ?>
                      <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale_img" />
                    <?php endif; ?>
                    <img
                      <?php $src = $data['productimage']; ?>
                      <?php if (strlen($src) > 0): ?>
                        src="<?php echo theme_thumb($src,170); ?>"
                      <?php else: ?>
                        src="holder.js/150"
                      <?php endif; ?>
                      alt="<?php the_title(); ?>"
                    />
                  </a>
                  <h3>
                    <a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h3>
                  <p class="sale_price" ><?php r_print_product_price($post); ?></p>          
                </div>
              </div>
            <?php endwhile; ?>
              </div> <!-- end of row -->
          </div> <!-- end of row -->
          <div class="row">
            <div class="Navi-old ten columns">
              <?php r_show_pagination(); ?>
           </div>
         </div>
        </div>
      </div>
    </div>
	<?php endif; ?>
		
  </div> <!-- content #end -->
  </div> <!-- page #end -->

<div class="ten columns">
  <hr>
</div>
  
 <?php get_footer(); ?>
  <!-- sidebar #end -->