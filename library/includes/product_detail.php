<div id="content-old" class="row">  	
  <div class="small-12 columns">	
    <div class="product-old clearfix-old product_inner-old row">
      <div id="photos-old" class="pro_img-old small-12 columns">
			  <?php 
          $image_array = $General->get_post_image($post->ID);
          if($image_array[0]){?>
          <div class="photo main_photo" > <a href="#productimage"><img src="<?php echo theme_thumb($image_array[0],200); ?>" alt="<?php the_title(); ?>"/></a>
            <div class="zoom"><a href="#productimage"> Zoom </a> </div>
          </div>
        <?php }?>
                      
        <?php if(count($image_array)>1){?>
          <div class="pro_thumb_img"> 
				    <?php if($image_array[1]){?>
              <div class="photo" ><a href="#productimage1" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[1], 75); ?>" alt="<?php the_title(); ?>" /> </a> </div>
            <?php }?>
            <?php if($image_array[2]){?>
              <div class="photo" ><a href="#productimage2" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[2], 75); ?>" alt="<?php the_title(); ?>"  /> </a> </div>
            <?php }?>
            <?php if($image_array[3]){?>
              <div class="photo" ><a href="#productimage3" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[3], 75); ?>" alt="<?php the_title(); ?>" /> </a> </div>
            <?php }?>
            <?php if($image_array[4]){?>
              <div class="photo" > <a href="#productimage4" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[4], 75); ?>" alt="<?php the_title(); ?>" /> </a> </div>
            <?php }?>
            <?php if($image_array[5]){?>
              <div class="photo" > <a href="#productimage5" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[5], 75); ?>" alt="<?php the_title(); ?>" /> </a> </div>
            <?php }?>
            <?php if($image_array[6]){?>
              <div class="photo" > <a href="#productimage6" class="small_thumb"> <img src="<?php echo theme_thumb($image_array[6], 75); ?>" alt="<?php the_title(); ?>" /> </a> </div>
            <?php }?>
          </div>
        <?php }?>
        <?php if($data[ 'productimage' ]){?>
        <div style="display: none;" id="productimage" > <img src="<?php echo $image_array[0]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage1' ]){?>
        <div style="display: none;" id="productimage1"> <img src="<?php echo $image_array[1]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage2' ]){?>
        <div style="display: none;" id="productimage2"> <img src="<?php echo $image_array[2]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage3' ]){?>
        <div style="display: none;" id="productimage3"> <img src="<?php echo $image_array[3]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage4' ]){?>
        <div style="display: none;" id="productimage4"> <img src="<?php echo $image_array[4]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage5' ]){?>
        <div style="display: none;" id="productimage5"> <img src="<?php echo $image_array[5]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
        <?php if($data[ 'productimage6' ]){?>
        <div style="display: none;" id="productimage6"> <img src="<?php echo $image_array[6]; ?>" alt="<?php the_title(); ?>"> </div>
        <?php }?>
      </div>
                           
                            <div class="product_info-old four columns offset-by-one">
                             
                            <?php /*
                            if(get_option('ptthemes_add_to_cart_button_position')=='Above Description' || get_option('ptthemes_add_to_cart_button_position') == '' || get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description') // add to cart button ABOVE description
							{
							*/ ?>
                            <div class="product_details-old panel radius">
                              
                               <?php
					            if($Product->get_product_price_sale($post->ID)>0)
								{
								?>
                                <p><?php _e('Regular Price');?>: <s> <?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); ?> </s></p>
                                <p> <?php _e('Sale Price');?> : <span class="price"> <?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_sale($post->ID),2); ?></span> </p>
                                <?php
								}else
								{
								?>
                                <p> <?php _e('Price');?>:<span class="price"><?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); ?>  </p>  
                                <?php
                                }
								?>
                              
                              
                               <?php if($product_color){?>
                                                    <div class="row_spacer"><strong><?php _e('Color');?>:</strong> 
                                                      <?php echo $product_color; ?>
                                                    </div>
                                                     <?php } ?>
                              
                              
                              <?php if($product_size){?>
                                <div class="row_spacer ">
                                  <strong><?php _e('Size');?>: </strong> 
                                  <?php echo $product_size; ?>  
                                  
                                  
                                  
                                  
                                  <span style="text-decoration: underline;" class="size_chart more" title="size_chart1">+ <?php _e('Size Chart');?></span>
                                  <div style="display: none;" class="size_chart1 hide" > <span class="close">Close X</span>
                                    <?php if ( get_option('ptthemes_size_chart') != "") { ?>
                                    <?php echo stripslashes(get_option('ptthemes_size_chart'));  ?>
                                    <?php } ?>
                                  </div>
                                  <!-- size chart -->
                                </div>
                                <?php }?>
                                
                          </div>
                            <?php
// 							}
							?>
                             
                             <?php 
							 //stock start
							 include(TEMPLATEPATH . '/library/includes/stock_desc_single.php');
							 //stock end
							 ?>
                             
                             <?php /*
                            if(get_option('ptthemes_add_to_cart_button_position')=='Below Description' || get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description') // add to cart button below description
							{
								if(get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
								{
							   		$product_size = $Product->get_product_custom_dl($post->ID,'size','size2');
									$product_color = $Product->get_product_custom_dl($post->ID,'color','color2');
								}
							?>
                            <div class="product_details-old panel radius">
                              
                               <?php
					            if($Product->get_product_price_sale($post->ID)>0)
								{
								?>
                                <p><?php _e('Regular Price');?>: <s> <?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); ?> </s></p>
                                <p> <?php _e('Sale Price');?> : <span class="price"> <?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_sale($post->ID),2); ?></span>  </p>
                                <?php
								}else
								{
								?>
                                <p><?php _e('Price');?>: <span class="price"><?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); ?></span> </p>  
                                <?php
                                }
								?>
                              
                              
                               <?php if($product_color){?>
                                                    <div class="row_spacer"><strong><?php _e('Color');?>:</strong> 
                                                      <?php echo $product_color; ?>
                                                    </div>
                                                     <?php } ?>
                              
                              
                              <?php if($product_size){?>
                                <div class="row_spacer ">
                                  <strong><?php _e('Size');?>: </strong> 
                                  <?php echo $product_size; ?>  
                                  
                                  
                                  
                                  
                                  <span style="text-decoration: underline;" class="size_chart more" title="size_chart1">+ <?php _e('Size Chart');?></span>
                                  <div style="display: none;" class="size_chart1 hide" > <span class="close">Close X</span>
                                    <?php if ( get_option('ptthemes_size_chart') != "") { ?>
                                    <?php echo stripslashes(get_option('ptthemes_size_chart'));  ?>
                                    <?php } ?>
                                  </div>
                                  <!-- size chart -->
                                </div>
                                <?php }?>
                              
                              
                                
                             	
                                
                                
                                 <?php  
									//affiliate link
									if($data['affiliate_link']){  ?>
								   <div class="b_addtocart"><a href="<?php echo $data['affiliate_link'];?>" ><?php _e(BUY_NOW_AFFILIATE);?> </a></div>
								   <?php }else{?>
                                 <?php
                                if($General->is_storetype_shoppingcart() || $General->is_storetype_digital())
								{
									if($General->is_checkoutype_cart())
									{
										if(get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
										{
											include(TEMPLATEPATH . '/library/includes/checkout_cart_2.php');
										}else
										{
											include(TEMPLATEPATH . '/library/includes/checkout_cart.php');
										}
									}else
									{
										include(TEMPLATEPATH . '/library/includes/checkout_buynow.php');
									}
								?>
            <?php
                                }
								elseif($General->is_storetype_catalog())
								{
									if($_REQUEST['msg']=='inqsuccess')
									{
										echo __(INQUIRY_SEND_SUCCESS_MSG)."<Br>";
									}
								?>
                                <a href="<?php echo get_option('siteurl')."/?page=sendenquiry&pid=".$post->ID;?>" class="normal_button fl"><?php _e(SEND_INQUIRY);?> </a>
                                <?php
								}
								?>
								<?php }?>
                          </div>
                            <?php
							} */
							?>
 
                      </div>  <!-- productinfo #end -->
                
                <div class="fix"></div>
                <div class="ten columns">
                  <?php the_content(); ?>
                </div>
                <div class="fix"></div>
                      
        <div class="ten columns">              
          <ul class="fav_link-old inline-list">
            <li class="print-old">
              <a href="#" onclick="window.print();return false;"><i class="icon-print icon-large"></i> <?php _e('Print');?>
              </a> 
            </li>
            <?php if ( get_option('ptthemes_feed_name') != "") { ?>
              <li class="sharethis"><a class="a2a_dd" href="http://www.addtoany.com/subscribe?linkname=http%3A%2F%2Fpt.com&amp;linkurl=http%3A%2F%2F<?php echo stripslashes(get_option('ptthemes_feed_url'));  ?>"><?php _e('Share This');?></a>
              <script type="text/javascript">a2a_linkname="<?php echo stripslashes(get_option('ptthemes_feed_name'));  ?>";a2a_linkurl="<?php echo stripslashes(get_option('ptthemes_feed_url'));  ?>";</script>
              <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/feed.js"></script>
              </li>
            <?php } ?>
            <li class="rss-old">
              <a href="<?php echo get_option('ptthemes_feedburner'); ?>"><i class="icon-rss icon-large"></i> <?php _e('RSS');?>
              </a> 
            </li>
            <?php
                       /*if($General->is_show_tellaFriend())
                       {
                          include(TEMPLATEPATH . '/library/includes/tellafriend.php');
                       } */ ?>
                       <li><?php  edit_post_link('Edit this entry.','',''); ?></li>
          </ul>
        </div>
                      
                                         
        <div class="fix"></div>
        <?php
                 if($General->is_show_related_products())
				 {
				 	include(TEMPLATEPATH . '/library/includes/related_products.php');
				 }
				 ?>
                 <?php
                 if($General->is_show_addcomment())
				 {				 
				 ?>
                <div class="fix"></div>
                <div class="fix"><!----></div><br/>
                
                <p class="post_bottom clearfix">   <?php the_tags(' <span class="tags">'.__('Tags : ','Templatic').'', ', ', '</span>'); ?>  <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea"><?php comments_number('0 Comments', '1 Comments', '% Comments'); ?></a></span></p>   
                <div id="comments"><?php comments_template(); ?></div>
                  <?php
                  }
				  ?>  
         		 </div> <!-- product #end -->
                 
                 
                 
                 
                 
    </div>        
   </div>
		<?php 
				