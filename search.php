<?php get_header(); ?>

<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

// print_r($search_query);

$search_query["posts_per_page"] = -1;

// print_r($search_query);

$search = new WP_Query($search_query);
?>


<!-- <div class="row"> -->
  <div id="content-old" class="row overflow-visible">
    <div class="ten columns">
    <?php if ( $search->have_posts() ) : ?>
      <div class="ten columns">
      	<header class="options">
      		<h1>
            <?php //global $wp_query; ?>
            <?php printf('%d item ditemukan', $search->found_posts); ?>
          </h1>
      	</header>
      </div>

    	<?php /* Start the Loop */ ?>
  <div class="ten columns">
    <div class="product-old row collapse">
    	<?php 
        while ( $search->have_posts() ) : 
          $search->the_post();
          $data = get_post_meta( $post->ID, 'key', true );
      ?>
        <?php if ($search->current_post == 0): ?>
          <div class="ten columns">
        <?php elseif ($search->current_post%5 == 0): ?>
          </div>
          <div class="ten columns">
        <?php endif; ?>
        <?php if ($search->current_post+1 == $search->found_posts): ?>
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
			  	data-lazyload
                data-src="holder.js/175"
                data-original="<?php echo theme_thumb($data['productimage'], 175); ?>" 
                  alt="<?php the_title(); ?>"  />
            </a>  
            <div class="content">
              <h3>
                <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
                  <?php echo $search->current_post; ?>
                </a>
              </h3>       
              <p class="sale_price" ><?php r_print_product_price($post); ?></p>
            </div>
          </div><!-- content block #end -->
        </div>
    	<?php endwhile; ?>
    </div>
  </div>
      <!-- <hr> -->
      </div> <!-- closing row -->
      <?php  wp_reset_postdata(); ?>
    <?php else : ?>

    	<div id="search" class="no-result ten columns">
    		<!-- <header>
    			<h1><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
    		</header> -->

    		<div class="entry-content">
    			<!-- <p><?php _e( 'Maaf, produk yang anda maksud tidak ada. Silahkan coba lagi dengan kata kunci yang lebih umum.', 'twentytwelve' ); ?></p> -->
    		  <h3>Mohon maaf, produk yang anda maksud tidak ada</h3>
          <p>Coba cari lagi menggunakan kata kunci yang berbeda</p>
          <div class="row">
            <div class="four columns">
              <?php get_search_form(); ?>
            </div>
          </div>
          <p>atau silahkan mampir ke <br/>
              <a class="small radius button" href="<?php echo home_url(); ?>">
                <i class="icon-large icon-home"></i> HALAMAN DEPAN
              </a>
          </p>
        </div><!-- .entry-content -->
      <hr>
    	</div><!-- #post-0 -->
    <?php endif; ?>
  </div>
</div>
  
<!-- </div> -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>