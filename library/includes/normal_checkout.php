<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.2.6.min.js"></script>

<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
		<h1 class="head"><?php _e(NORMAL_CHEKCOUT_PAGE_TITLE); ?></h1>
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; Checkout'); } ?>
     </div> <!-- breadcrumbs #end -->



	
                
				
 		 <div class="content_spacer">
           <div id="checkout_content">
        <?php
            if($itemsInCartCount>0)
			{
			?>
        <?php /*?><form action="<?php echo get_option('siteurl'); ?>/?page=confirm" method="post"><?php */?>
        <form method="post" name="checkout_frm" id="checkout_frm" action="<?php echo get_option('siteurl'); ?>/?page=payment&paymentmethod=<?php echo $_SESSION['paymentmethod'];?>">
          <input type="hidden" name="coupon_code" value="<?php echo $_SESSION['couponcode'];?>" />
          <?php if($_GET['msg']=='nopaymethod'){ _e("<div style='color:red'>".SELECT_PAYMETHOD_MSG."</div><br>");}?>
          <?php
                if(isset($_SESSION['display_message']) && $_SESSION['display_message']!='')
				{
					echo '<p style="color:#FF0000">'.$_SESSION['display_message']."<p>";
					$_SESSION['display_message'] = '';
				?>
          <?php }?>
        
          <?php
               	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id";
				$paymentinfo = $wpdb->get_results($paymentsql);
				if($paymentinfo)
				{
				?>
          <h3 class="shipping_cart"> <?php _e(SELECT_PAY_MEHTOD_TEXT); ?></h3>
          <table width="100%" class="table ">
            <?php
                	$paymentOptionArray = array();
					$paymethodKeyarray = array();
					foreach($paymentinfo as $paymentinfoObj)
					{
						$paymentInfo = unserialize($paymentinfoObj->option_value);
						if($paymentInfo['isactive'])
						{
							$paymethodKeyarray[] = $paymentInfo['key'];
							$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
						}
					}
					ksort($paymentOptionArray);
					foreach($paymentOptionArray as $key=>$paymentInfoval)
					{
						for($i=0;$i<count($paymentInfoval);$i++)
						{
							$paymentInfo = $paymentInfoval[$i];
							$jsfunction = 'onclick="showoptions(this.value);"';
							$chked = '';
							if($key==1)
							{
								$chked = 'checked="checked"';
							}
						?>
            <tr>
              <td width="1%"  align="center" class="row3" id="<?php echo $paymentInfo['key'];?>"><input <?php echo $jsfunction;?>  type="radio" value="<?php echo $paymentInfo['key'];?>" id="<?php echo $paymentInfo['key'];?>_id" name="paymentmethod" <?php echo $chked;?> /></td>
              <td class="row3"><?php echo $paymentInfo['name']?></td>
              <?php
							if(file_exists(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php'))
							{
							?>
              <?php
								include_once(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php');
								?>
              <?php
							}
						 ?>
              <?php
						}
					}
					
				?>
            <tr>
              <td  align="center" >&nbsp;</td>
              <td >&nbsp;</td>
          </table>
          <?php
               	}
				?>
          <h3 class="shipping_cart"> <?php _e('Your Selection'); ?> </h3>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table_spacer">
            <tr>
              <td width="60%" class="title"><?php _e('Product Name'); ?></td>
              <td width="10%" align="center" class="title"><?php _e('Qty'); ?></td>
              <td width="15%" align="center" class="title"><?php _e('Price'); ?></td>
              <td width="15%" align="center" class="title"><?php _e('Total'); ?></td>
            </tr>
            <?php
				for($i=0;$i<count($cartInfo);$i++)
				{
				$product_id = $cartInfo[$i]['product_id'];
				$product_name = $cartInfo[$i]['product_name'];
				$product_qty = $cartInfo[$i]['product_qty'];
				$product_att = $cartInfo[$i]['product_att'];
				//$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$product_att);
				$product_price = number_format($cartInfo[$i]['product_gross_price'],2);
				$product_price_total = $cartInfo[$i]['product_gross_price']*$cartInfo[$i]['product_qty'];
				?>
            <tr>
              <td class="row1 " ><?php echo $product_name;
				  if($product_att)
				  {
				  	echo '<br>('.$product_att .')';
                  }
				   ?> </td>
              <td align="center" class="row1 " ><?php echo $product_qty; ?></td>
              <td class="row1 tprice"  ><?php echo $product_price; ?></td>
              <td class="row1 tprice" ><?php echo number_format($product_price_total,2); ?></td>
            </tr>
            <?php
				}
				?>
            <tr>
              <td colspan="3" align="right"  ><?php _e('Sub Total Amount'); ?> : </td>
              <td class=" tprice"><?php echo $grandTotal;?></td>
            </tr>
            <?php
                if($_SESSION['couponcode']){
				?>
            <tr>
              <td colspan="3" align="right"   ><?php _e('Discount Amount'); ?>
                <?php //echo $discount_info['couponcode'];?>
                <?php if($discount_info['dis_per']=='per'){echo '('.$discount_info['dis_amt'].'%)';}?>
                : </td>
              <td class=" tprice" ><?php echo $discount_amt;?></td>
            </tr>
            <?php }?>
            <tr>
              <td colspan="3" align="right" ><?php _e('Tax Amount'); ?> (<?php echo $product_tax;?>%) : </td>
              <td class=" tprice"><?php echo  $General->get_currency_symbol().number_format($taxable_amt,2); ?></td>
            </tr>
            <?php
                $grandTotal1 = $General->get_shipping_amt($_SESSION['shippingmethod'],$Cart->getCartAmt());
				$payableAmt = $General->get_payable_amount($_SESSION['shippingmethod']);
				 if($_SESSION['shippingmethod'])
				 {
				 ?>
            <tr>
              <td colspan="3" align="right"   ><?php echo $General->get_shipping_method($_SESSION['shippingmethod']);?> <?php _e('Amount'); ?> :</td>
              <td class=" tprice"><?php echo $General->get_currency_symbol().number_format($grandTotal1,2);?></td>
            </tr>
            <?php }?>
            <tr>
              <td colspan="3" align="right" class="row2"  ><?php _e('Final Amount'); ?> : </td>
              <td class="total_price "><?php echo $General->get_currency_symbol().number_format($payableAmt,2)?></td>
            </tr>
          </table>
           <?php
          if($General->is_show_term_conditions())
		  {
		  ?>
           <div class="terms_condition clearfix">
          <input type="checkbox" name="termsandconditions" id="termsandconditions" class="checkin2" />&nbsp;
			  <?php
              if($General->get_term_conditions_statement()!='')
              {
                echo $General->get_term_conditions_statement();
              }else
              {
                _e('I accept the terms and conditions');
              }
              ?>
          </div>
          <?php
          }
		  ?>
          <div class="button_bar" >
            <input type="hidden" name="shippingmethod" id="shippingmethod" value="<?php echo $_SESSION['shippingmethod'];?>" />
            <a  href="javascript:void(0);" onclick="history.back();" class="normal_input_btn fl"><?php _e('&laquo; Back'); ?>&nbsp;</a>
            <input type="submit" name="confirm" value="<?php _e('Confirm'); ?> &raquo;" class="highlight_input_btn fr" onclick="return accepttermandconditions();" />
            <!--<a  href="javascript:void(0);" onclick="document.checkout_frm.submit();" class="highlight_button  fr" >Confirm &raquo;</a>--> </div>
        </form>
        <?php
			}else
			{
			wp_redirect(get_option('siteurl').'/?page=cart');
            }
			?>
      </div>
      <div id="checkout_sidebar">
        <?php
		 if($_SESSION['shippingmethod'])
		 {
		 ?>
        <div class="shipping_method">
          <p> <strong> <?php _e(SHIPPING_MEHTOD_TEXT); ?> : </strong> <br />
            <span class="method"> <?php echo $General->get_shipping_method($_SESSION['shippingmethod']);?> </span> </p>
        </div>
        <?php }?>
        <div class="checkout_address">
          <div class="address_info fl">
            <h3><?php _e(BILLING_ADDRESS_TEXT); ?> <span>(<a href="<?php echo get_option('siteurl'); ?>/?page=account&type=editprofile"><u><?php _e('Edit'); ?></u></a>)</span> </h3>
            <div class="address_row"> <b><?php echo $userInfo['display_name'];?></b></div>
            <div class="address_row"><?php echo $user_address_info['user_add1'];?></div>
            <div class="address_row"><?php echo $user_address_info['user_add2'];?></div>
            <div class="address_row"><?php echo $user_address_info['user_city'];?>, <?php echo $user_address_info['user_state'];?>,</div>
            <div class="address_row"><?php echo $user_address_info['user_country'];?> - <?php echo $user_address_info['user_postalcode'];?></div>
          </div>
           <?php
			if(!$General->is_storetype_digital())
			{
			?>
          <div class="address_info fr">
            <h3><?php _e(SHIPPING_ADDRESS_TEXT); ?> <span>(<a href="<?php echo get_option('siteurl'); ?>/?page=account&type=editprofile"><u><?php _e('Edit'); ?></u></a>)</span> </h3>
            <div class="address_row"> <b><?php echo $user_address_info['buser_name'];?></b></div>
            <div class="address_row"><?php echo $user_address_info['buser_add1'];?> </div>
            <div class="address_row"><?php echo $user_address_info['buser_add2'];?></div>
            <div class="address_row"><?php echo $user_address_info['buser_city'];?>, <?php echo $user_address_info['buser_state'];?>, </div>
            <div class="address_row"><?php echo $user_address_info['buser_country'];?> - <?php echo $user_address_info['buser_postalcode'];?></div>
          </div>
         <?php }?>
        </div>
        <!-- checkout Address -->
        <div class="payment_method"><img src="<?php bloginfo('template_directory'); ?>/images/payment_method.png" alt=""   /> </div>
      </div>
    </div>
        
 	                    
  			<!--  </div>  content #end -->
 		 <?php //get_sidebar(); ?>
  </div> <!-- page #end -->
 
<!-- wrapper #end -->
<script>
function accepttermandconditions()
{
	<?php
	if($General->is_show_term_conditions())
	{
	?>
	if(document.getElementById('termsandconditions').checked)
	{
		return true;
	}else
	{
		alert('<?php _e('Please accept the terms and conditions');?>');
		document.getElementById('termsandconditions').focus();
		return false;
	}
	<?php
	}
	?>
}
function showoptions(paymethod)
{
	<?php
	for($i=0;$i<count($paymethodKeyarray);$i++)
	{
	?>
	showoptvar = '<?php echo $paymethodKeyarray[$i]?>options';
	if(eval(document.getElementById(showoptvar)))
	{
		document.getElementById(showoptvar).style.display = 'none';
		if(paymethod=='<?php echo $paymethodKeyarray[$i]?>')
		{
			document.getElementById(showoptvar).style.display = '';
		}
	}
	
	<?php
	}	
	?>
}
<?php
for($i=0;$i<count($paymethodKeyarray);$i++)
{
?>
if(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').checked)
{
	showoptions(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').value);
}
<?php
}	
?>
</script>
<?php get_footer(); ?>
