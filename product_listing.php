<?php
/*
Template Name: Product Listing Page
*/
?>

<?php 
get_header(); 
global $Product,$Cart;
?>

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
  <div class="row">  
    <div class="ten columns">
      <div class="options">
  	    <h2 class="clearboth-old text-left"><?php single_cat_title(); ?></h2> 
      </div>
      <div id="preview"></div>
  	</div>
  </div>
  <div class="row">
    <div class="ten columns">
      <div id="category-description">
        <?php echo '<b>'.category_description().'</b>'; ?>
      </div>
    </div>
  </div>
  <!-- <div class="ten columns text-right">
    <a style="color:black;" href="#" class="switch_thumb swap"><?php _e('Switch Thumb');?></a>
  </div> -->
  
  <?php if(have_posts()): ?>
    <div class="row">
      <div id="outer-box" class="ten columns">
        <!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-latest.js"></script> -->
        <!--<script type="text/javascript">
         /* $(document).ready(function(){
            $("a.switch_thumb").toggle(function(){
      	      $(this).addClass("swap"); 
      	      $("ul.display").fadeOut("fast", function() {
                $(this).fadeIn("fast").removeClass("thumb_view");
              });
      	    }, function () {
      	      $(this).removeClass("swap");
      	      $("ul.display").fadeOut("fast", function() {
      		      $(this).fadeIn("fast").addClass("thumb_view"); 
      		    });
      	    });
          }); */
        </script>-->
        
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
                   
</div>

<div class="ten columns">
  <hr>
</div>

<?php get_footer(); ?>