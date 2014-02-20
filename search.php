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
  <div id="content-old" class="row">
    <div class="small-12 columns">
    <?php if ( $search->have_posts() ) : ?>
	  <div class="row">
		  <div class="small-12 columns">
			<header class="options panel">
				<h1>
				<?php //global $wp_query; ?>
				<?php printf('%d item ditemukan', $search->found_posts); ?>
			  </h1>
			</header>
		  </div>
	  </div>

    	<?php /* Start the Loop */ ?>

    	<?php 
        while ( $search->have_posts() ) : 
          $search->the_post();
          $data = get_post_meta( $post->ID, 'key', true );
      ?>
          <div class="content-block row"> 
            <a href="<?php the_permalink() ?>" class="product-thumb small-5 columns"> 
              <?php if($Product->get_product_price_sale($post->ID)>0): ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/sale.png" alt="<?php the_title(); ?>" class="sale-image" />
              <?php endif; ?>
              <img class="lazyload"
			  	data-lazyload
                src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif"
                data-original="<?php echo theme_thumb($data['productimage'], 103, 143); ?>" 
                  alt="<?php the_title(); ?>"  />
            </a>  
            <div class="content small-7 columns">
              <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
              	<h3 style="font-size: 95%; margin-top: -3px;">
                  <?php the_title(); ?>
                  <?php //echo $search->current_post; ?>
              	</h3> 
				<p class="sale_price" ><?php r_print_product_price($post); ?></p>
              </a>      
            </div>
          </div><!-- content block #end -->
		  <?php if ($search->current_post+1 < $search->found_posts): ?>
		  	<hr>
		  <?php endif; ?>
    	<?php endwhile; ?>
      <!-- <hr> -->
      </div> <!-- closing row -->
      <?php  wp_reset_postdata(); ?>
    <?php else : ?>

    	<div id="search" class="no-result row">

    		<div class="entry-content small-12 columns">
    			<!-- <p><?php _e( 'Maaf, produk yang anda maksud tidak ada. Silahkan coba lagi dengan kata kunci yang lebih umum.', 'twentytwelve' ); ?></p> -->
    		  <h3>Mohon maaf, produk yang anda maksud tidak ada</h3>
          <p>Coba cari lagi menggunakan kata kunci yang berbeda</p> 
          <p>atau mampir ke <a class="tiny button" href="<?php echo home_url(); ?>">
                <i class="icon-large icon-home"></i> HALAMAN DEPAN
              </a>
          </p>
        </div><!-- .entry-content -->
    	</div><!-- #post-0 -->
    <?php endif; ?>
  </div>
</div>
  
<!-- </div> -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>