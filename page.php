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

<div id="page-old" class="ten columns">
  <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post() ?>
		  <h1><?php the_title(); ?></h1>
      
      <div id="content-old" >
        <div class="content_space-old">			
 					
            		<?php $pagedesc = get_post_meta($post->ID, 'pagedesc', $single = true); ?>
            
        
                    <div id="post-<?php the_ID(); ?>" >
                        <div class="entry"> 
                            <?php the_content(); ?>
                        </div>
                    </div><!--/post-->
                
            <?php endwhile; else : ?>
        
                    <div class="posts">
                        <div class="entry-head"><h2><?php echo get_option('ptthemes_404error_name'); ?></h2></div>
                        <div class="entry-content"><p><?php echo get_option('ptthemes_404solution_name'); ?></p></div>
                    </div>
        
        <?php endif; ?>        

        	</div>
  			  </div> <!-- content #end -->
  </div> <!-- page #end -->

<div class="ten columns">
  <hr>
</div>

<script type="text/javascript">
  jQuery(function($){
    $('#wrapper-old').addClass("overflow-visible");
  });
</script>

<?php get_footer(); ?>