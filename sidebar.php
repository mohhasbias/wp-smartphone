<?php 
session_start();
ob_start();

global $Cart,$General;
$itemsInCartCount = $Cart->cartCount();
$cartInfo = $Cart->getcartInfo();
?>
<div id="sidebar-old">
	<div class="sidebar_top-old">
    <div class="sidebar_bottom-old">
      <?php
        if($General->is_storetype_shoppingcart() || $General->is_storetype_digital())
	      {
	    ?>
        <div class="widget">
          <?php //include (TEMPLATEPATH . ‘/searchform.php’); ?>
          <div class="title">
            <h3><?php _e(SHOPPING_CART_TEXT);?></h3>
          </div>
       
          <?php
            if($itemsInCartCount>0)
	          {
          ?>
      	    <div class="shipping_section clearfix" id="cart_content_sidebar">
              <div class="shipping_title clearfix"> <span class="pro_s"> <?php _e('Product');?></span> <span class="pro_q"> <?php _e('Qty');?></span> <span class="pro_p"> <?php _e('Price');?></span> </div>
              <?php
                for($i=0;$i<count($cartInfo);$i++)
                {
		 	            $grandTotal = $General->get_currency_symbol().number_format($Cart->getCartAmt(),2);
		          ?>
                  <div class="shipping_row clearfix"> 
                    <span class="pro_s"> 
                      <?php echo $cartInfo[$i]['product_name'];?> 
                      <?php 
  			                if($cartInfo[$i]['product_att'])
  			                {
  				                echo "<br>".$cartInfo[$i]['product_att'];
  			                }
                      ?>
                    </span> 
                    <span class="pro_q">
                      <?php echo $cartInfo[$i]['product_qty'];?>
                    </span> <span class="pro_p"> 
                      <?php echo $General->get_currency_symbol().number_format($cartInfo[$i]['product_gross_price'],2);?>
                    </span> 
                  </div>
                <?php }?>
                <div class="shipping_total">
                  <?php _e('Total');?> : <?php echo $grandTotal;?> 
                </div>
                <p class="fl" ><a class="reveal small button radius" href="<?php echo get_option('siteurl');?>/?page=cart #page-old"><i class="icon-shopping-cart icon-large"></i> <?php _e(VIEW_CART_TEXT);?></a></p>
                <!-- <div class="b_checkout"><a href="<?php echo get_option('siteurl');?>/?page=cart"><?php _e(CHECKOUT_TEXT);?></a> </div> -->
              </div> 
              <?php
	          }else
	          {
	            ?>
              <div class="shipping_section clearfix" id="cart_content_sidebar"><strong><?php _e(SHOPPING_CART_EMPTY_MSG);?></strong></div>
              <?php
            }
		        ?>
          </div> <!-- widget #end-->
          <?php
        }
	      ?>   
        
        
       

		<?php if ( function_exists('dynamic_sidebar') && (is_sidebar_active(3)) ) { // Show on the front page ?>
				<?php dynamic_sidebar(4); ?>  
		 <?php } ?>
         	 

         </div>
    </div> <!-- siderbar #end -->
 </div>