
                <h1 class="single"><?php the_title(); ?></h1>
                 <div class="post_top">
                     <p class="postmetadata">Posted on <?php the_time('F j, Y') ?> by <?php the_author(); ?> in <?php the_category(" , "); ?>  
                   </p>
                   </div>
                
                <div id="post-<?php the_ID(); ?>" class="posts">
				    						                        
 				   
                   
					
                     <?php if ( get_post_meta($post->ID,'image', true) ) { ?>
        <div class="post_img clearfix"> <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;w=500&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>"  class="img"   /></div>
        <?php } ?>
                    
											
					<?php the_content(); ?>
                    
                    
                    <p class="post_bottom clearfix"> 
                       <?php the_tags('  <span class="tags">'.__('Tags : ','Templatic').'', ', ', '</span>    '); ?>
                    
                    <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea"><?php comments_number('0 Comments', '1 Comments', '% Comments'); ?></a></span></p>
					
					<div class="fix"><!----></div><br/>
													
                </div>
                <div class="fix"></div>
                <div class="fix"><!----></div><br/>
                
                   
                <div id="comments"><?php comments_template(); ?></div>
                <?php
				