<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header(); ?>
<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
	    <h1 class="head"><?php the_title(); ?></h1>
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
     </div> <!-- breadcrumbs #end -->
 


	
                
                
         <div id="content">
 
 
            	
 	   
 
    <div id="post-<?php the_ID(); ?>" >
      <div class="arclist box">
        <ul>
          <?php query_posts('showposts=60'); ?>
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <li>
            <div class="archives-time">
              <?php the_time('M j Y') ?>
            </div>
            <a href="<?php the_permalink() ?>">
            <?php the_title(); ?>
            </a> - <?php echo $post->comment_count ?> </li>
          <?php endwhile; endif; ?>
        </ul>
      </div>
      <!--/arclist -->
    </div>
    <!--/post -->
    
  </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
 </div> <!-- page #end -->

 <?php get_footer(); ?>