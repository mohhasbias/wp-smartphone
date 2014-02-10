<div class="slide_wl">
  <div id="featured">
    <?php

    global $shortname;
    $category = get_option($shortname . '_slide_ctr');
    $post_number = get_option($shortname . '_slide_no');

    global $post;
    $latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');
    foreach($latest_menus as $post) :
      setup_postdata($post);
 
      $imagearray = $General->get_post_image($post->ID);
    ?>

    <div class="content">
      <?php if ( $imagearray[0] ) : ?> 
          <a href="<?php the_permalink() ?>" title="<?php echo $post_title; ?>" class="right" > 
            <img data-src="holder.js/200x200" src="<?php echo theme_thumb($imagearray[0], 175); ?>" alt="<?php the_title(); ?>"/>
          </a> 
      <?php 
        else : 
          echo ''; 
        endif; 
      ?>
                
      <h3><a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>   </h3>
                     
      <p class="featured-excerpt"><?php echo bm_better_excerpt(170, ' ... '); ?> </p>
                            
      <div >
        <a  href="<?php the_permalink(); ?>"  class="radius small button" > View Details </a> 
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
