<?php
/*
Template Name: Product Listing Page
*/
?>
<?php get_header(); ?>
<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
			<?php if (is_category()) { ?>
			<h1  class="head" ><?php echo get_option('ptthemes_browsing_category'); ?> <?php echo single_cat_title(); ?> </h1>  

			<?php } elseif (is_day()) { ?>
			<h1  class="head"><?php echo get_option('ptthemes_browsing_day'); ?> <?php the_time('F jS, Y'); ?> </h1>

			<?php } elseif (is_month()) { ?>
			<h1  class="head"><?php echo get_option('ptthemes_browsing_month'); ?> <?php the_time('F, Y'); ?> </h1>

			<?php } elseif (is_year()) { ?>
			<h1  class="head"><?php echo get_option('ptthemes_browsing_year'); ?> <?php the_time('Y'); ?> </h1>
			
			<?php } elseif (is_author()) { ?>
			<h1  class="head"><?php echo get_option('ptthemes_browsing_author'); ?> <?php echo $curauth->nickname; ?> </h1>
							
			<?php } elseif (is_tag()) { ?>
			<h1  class="head"><?php echo get_option('ptthemes_browsing_tag'); ?> <?php echo single_tag_title('', true); ?> </h1>
			<?php }  elseif ($_GET['page']=='Blog') { ?>
            <h1  class="head"><?php _e('Blog');?></h1>
            <?php } ?>
            
      	  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',  ' &raquo; ' . $_GET['page']); } ?>
     </div> <!-- breadcrumbs #end -->


         <div id="content">
              <?php
			if(isset($_GET['author_name'])) :
			$curauth = get_userdatabylogin($author_name);
			else :
			$curauth = get_userdata(intval($author));
			endif;
		?>
        <?php
       if(!is_category())
	   {
	    $totalpost_count = 0;
		$limit = 1000;
		$blogCategoryIdStr = get_inc_categories("cat_exclude_");
		query_posts('showposts=' . $limit . '&cat='.$blogCategoryIdStr);
		if(have_posts())
		{
			while(have_posts())
			{
				 the_post();
				$totalpost_count++;
			}
		}
		}
		?>
    <?php if (is_paged()) $is_paged = true; ?>
	
 
			<?php if(have_posts()) : ?>
			<?php 
			if(!is_category())
			{
				global $posts_per_page;
				$limit = $posts_per_page;
				global $paged;
				$blogCategoryIdStr = get_inc_categories("cat_exclude_");
				query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr);
			}
			while(have_posts()) : the_post() ?>
        
                <div id="post-<?php the_ID(); ?>" class="posts">
				    						                        
                    
					<div class="post_top">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            
                    <p class="postmetadata">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?> in <?php the_category(" , "); ?>  
                   </p>
                    </div>
					
					<?php if (( get_post_meta($post->ID,'image', true) ) && (get_option( 'ptthemes_timthumb_all' )) ) { ?>
                
                        <a title="Link to <?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=95&amp;w=95&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" class="fll" style="margin-right:10px; margin-bottom:10px" /></a>          	
                        							
                    <?php } ?>
						
					<?php if ( get_option( 'ptthemes_postcontent_full' )) { ?> 
					
					    <?php //the_content(); ?>
                        <?php echo bm_better_excerpt(200, ' ... '); ?>
					
					<?php } else { ?>
					
					    <?php the_excerpt(); ?>
						
					<?php } ?>
					
					<div class="fix"><!----></div>
					
					<p class="post_bottom clearfix"> <span class="tags"><?php the_tags(); ?> </span>    <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea"><?php comments_number('0 Comments', '1 Comments', '% Comments'); ?></a></span></p>
											
                </div><!--/post-->                            
        
            <?php endwhile; ?>
			
			<div class="pagination">
			
                <?php if (function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?><?php } ?>
						
            </div>
			
           
        
            <?php endif; ?>
			
		
</div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
 </div>
 <?php get_footer(); ?>