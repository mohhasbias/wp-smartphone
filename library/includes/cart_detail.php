<?php 
session_start();
ob_start();
global $Cart,$General;
$_REQUEST['coupon_code'] = $_REQUEST['eval_coupon_code'];
$_SESSION['checkout_as_guest'] = $_REQUEST['checkout_as_guest']; 
$shippingmehod_arr = $General->get_shipping_mehod();
if(count($shippingmehod_arr)==1)
{
	$shippingmethod_code = $shippingmehod_arr[0];
	$shippingmethod = $General->get_shipping_method($shippingmethod_code);
}
if($shippingmethod_code)
{
	$_SESSION['shippingmethod'] = $shippingmethod_code;
}
$itemsInCartCount = $Cart->cartCount();
$cartInfo = $Cart->getcartInfo();
$grandTotal = $General->get_currency_symbol().number_format($Cart->getCartAmt(),2);
$product_tax = $General->get_product_tax();
$taxable_amt = $General->get_tax_amount();
$payable_amt = $General->get_payable_amount();

$paymentsql = "select * from $wpdb->options where option_name like 'shipping_method_%'";
$paymentinfo = $wpdb->get_results($paymentsql);
if($paymentinfo)
{
	$shippingcount = 0;
	foreach($paymentinfo as $paymentinfoObj)
	{
		$paymentInfo = unserialize($paymentinfoObj->option_value);
		if($paymentInfo['isactive'])
		{
			$shippingcount++;
			$shippingmethod = $paymentInfo['key'];
		}
	}
}
if($shippingcount == 1)
{
	$shipping_amt = $General->get_shipping_amt($shippingmethod,$Cart->getCartAmt());
	$payable_amt = $General->get_payable_amount($shippingmethod);
}
?>
<script>
function evaluate_coupon_amt()
{
	var coupon_code = document.getElementById('coupon_code').value;
	if(coupon_code == '')
	{
		alert('<?php _e(ENTER_COUPON_CODE_MSG); ?>');
		return false;
	}else
	{
		document.getElementById('eval_coupon_code').value = coupon_code;
		document.evaluate_coupon.submit();
	}
	return true;
}
</script>
<?php //get_header(); ?>

<?php /*
<div class="ten columns">
  <div class="breadcrumbs panel radius">
    <?php if ( get_option( 'ptthemes_breadcrumbs' )): ?> 
      <?php yoast_breadcrumb('','Shopping Cart'); ?>
    <?php endif; ?>
  </div>
</div>
*/?>

<?php /*
<aside class="three columns">
  <?php get_sidebar(); ?>
</aside>
*/?>

<div id="page-old" class="clearfix-old ten columns">
<div class="breadcrumb-old clearfix-old">
		<h1 class="head-old"><?php _e(SHOPPING_CART_PAGE_TITLE); ?> (<?php echo $itemsInCartCount . " items";?>)</h1>
    <?php// if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; Shopping Cart'); } ?>
     </div> <!-- breadcrumbs #end -->


	
     
     
         <div id="content-old" class="shopping-cart">      
				
			<?php
            if($itemsInCartCount>0)
			{
			?>
            <?php if($_GET['msg']=='emptycart'){ echo "<div style='color:red'>".CART_EMPTY_MSG." </div>";}?> <br />
            <form action="<?php echo get_option('siteurl'); ?>/?page=cart&cartact=upd" method="post" name="updatecart">
              <input type="hidden" name="cartprdid" value="<?php echo $i; ?>" />
              <table class="ten">
                <tr>
                  <td colspan="2" class="title"><?php _e('Product(s)'); ?></td>
                  <td class="title"><?php _e('Price'); ?></td>
                  <td class="title"><?php _e('Qty'); ?></td>
                  <td class="title"><?php _e('Total'); ?></td>
                </tr>
                <?php
                        for($i=0;$i<count($cartInfo);$i++)
                        {                        
                        $product_image = $cartInfo[$i]['product_image'];
                        $product_id = $cartInfo[$i]['product_id'];
                        $product_name = $cartInfo[$i]['product_name'];
                        $product_qty = $cartInfo[$i]['product_qty'];
                        $product_att = $cartInfo[$i]['product_att'];
                        //$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$product_att);
                        $product_price = number_format($cartInfo[$i]['product_gross_price'],2);
                        $product_price_total = $cartInfo[$i]['product_gross_price']*$cartInfo[$i]['product_qty'];
                        ?>
                <?php /*?><form action="<?php echo get_option('siteurl'); ?>/?page=cart&cartact=upd&prm=<?php echo $i; ?>" method="post"><input type="hidden" name="cartprdid" value="<?php echo $i; ?>" /><?php */?>
                <tr>
                  <td class="row1 bnone" >
                  <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image; ?>&amp;w=130&amp;zc=1&amp;q=80" alt=""  class="product_thum" /></td>
                  <td class="row1"><strong><?php echo $product_name;?> </strong>
                      <?php
                                if($product_att!='')
                                {
                                echo '<br>('.$product_att.')'; 
                                }
                                ?>
                      <br />
                    <a href="<?php echo get_option('siteurl'); ?>/?page=cart&cartact=rmv&prm=<?php echo $i; ?>" title="Remove from Cart" class="remove_item-old tiny radius button"><i class="icon-remove"></i> <?php _e('Remove Item'); ?></a> </td>
                  <td align="center" valign="top" class="row1 tprice" ><?php echo $product_price; ?></td>
                  <td align="center" valign="top" class="row1 tprice"   ><input type="text" name="product_qty[]" size="8" value="<?php echo $product_qty; ?>" class="qty" />
                  </td>
                  <td valign="top" class="row1 tprice "    ><?php echo number_format($product_price_total,2); ?></td>
                  <?php /*?><td align="center" valign="top" class="row1" ><input type="image" src="<?php bloginfo('template_directory'); ?>/images/update.png" alt="update"  /> </td><?php */?>
                </tr>
                <?php /*?></form><?php */?>
                <?php
                        }
                        ?>
                <tr>
                  <td colspan="2" align="right" class="row1" ></td>
                  <td align="center" class="row1" ></td>
                  <td align="center" class="row1 tprice" ><!--<a  href="javascript:void(0);" onclick="document.updatecart.submit();" class="normal_button " >Update Cart</a> -->
                      <input type="submit" name="<?php _e('Update Cart'); ?>" value="Update Cart" class="b_update_cart" />
                  </td>
                  <td align="left" class="row1 tprice" >&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" ></td>
                  <td align="right" >&nbsp;</td>
                  <td colspan="2" align="right"  ><?php _e('Sub Total Amount'); ?></td>
                  <td align="left" class=" tprice" ><?php echo  $grandTotal; ?></td>
                </tr>
                <?php
                         if($product_tax)
                         {
                         ?>
                <tr>
                  <td align="right" ></td>
                  <td align="right"  >&nbsp;</td>
                  <td colspan="2" align="right"  ><?php _e('Tax Amount'); ?>
                    (<?php echo $product_tax;?>%) </td>
                  <td align="left" class=" tprice" ><?php echo  $General->get_currency_symbol().number_format($taxable_amt,2); ?></td>
                </tr>
                <?php
                         }
                         ?>
                <?php
                         if($shippingmethod)
                         {
                         ?>
                <tr>
                  <td align="right"  ></td>
                  <td colspan="3" align="right" ><?php echo $General->get_shipping_method($shippingmethod);?> <?php _e('Amount'); ?> :</td>
                  <td align="left" class=" tprice" ><?php echo  $General->get_currency_symbol().number_format($shipping_amt,2); ?></td>
                </tr>
                <?php }?>
                <?php 
                          $couponInfo = $General->get_coupon_deduction();
                          $cart_discount_amt = $General->get_currency_symbol().number_format($General->get_discount_amount($_SESSION['couponcode'],$Cart->getCartAmt()),2);
                          if($couponInfo){?>
                <tr>
                  <td colspan="2">&nbsp;</td>
                  <td colspan="2" align="right" ><?php echo $couponInfo;?> : </td>
                  <td align="left" class=" tprice" ><?php echo  $cart_discount_amt; ?></td>
                </tr>
                <?php }?>
                <tr>
                  <td colspan="2" align="left" class="total_amount_title"  >&nbsp;</td>
                  <td colspan="2" align="right" class="total_amount_title" ><strong>
                    <?php _e('Total Amount'); ?>
                    : </strong></td>
                  <td  class="total_price"><?php echo  $General->get_currency_symbol().number_format($payable_amt,2); ?></td>
                </tr>
              </table>
           </form>
            <form action="<?php echo get_option('siteurl'); ?>/?page=checkout" method="post" name="checkout_frm">
              <?php
                        $paymentsql = "select * from $wpdb->options where option_name like 'shipping_method_%'";
                        $paymentinfo = $wpdb->get_results($paymentsql);
                        if($paymentinfo)
                        {
                        ?>
              <table width="100%" <?php if($shippingcount==1){ ?> style="display:none;"<?php }?>>
                <tr>
                  <td colspan="2" style="text-decoration:underline;"><strong><?php _e('Shipping Methods'); ?></strong></td>
                </tr>
                <?php
                            $shippingcount = 0;
                            foreach($paymentinfo as $paymentinfoObj)
                            {
                                $paymentInfo = unserialize($paymentinfoObj->option_value);
                                if($paymentInfo['isactive'])
                                {
                                $shippingcount++;
                        ?>
                <tr>
                  <td><?php echo $paymentInfo['name']?></td>
                  <td><input type="radio" value="<?php echo $paymentInfo['key'];?>" name="shippingmethod" checked="checked" /></td>
                </tr>
                <?php
                                }
                            }
                        ?>
              </table>
              <?php
                        }
                        ?>
              <!-- <br /> -->
              <?php
                        if($General->is_show_coupon()){
                        ?>
              <div class="button_bar2">
                <div class="coupon_code">
                  <table border="0" cellpadding="3" cellspacing="3"  >
                    <?php if($_REQUEST['msg']=='invalidcoupon'){?>
                    <tr>
                      <td  colspan="2" style="color:#FF0000"><?php _e(INVALID_COUPON_MSG); ?><br />
                        <br /></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td class="table_td_align" ><?php _e('Discount Code'); ?> : </td>
                      <td class="table_td_align"><input type="text" class="coupon_text fl" value="<?php echo $_SESSION['eval_coupon_code'];?>" name="coupon_code" id="coupon_code" />
                       <?php /*?><!-- <a href="javascript:void(0);"  onclick="evaluate_coupon_amt();"  class="fl normal_button" >Recalculate</a>--> <?php */?>
                        <input type="button" onclick="evaluate_coupon_amt();" name="Recalculate" value="<?php _e('Recalculate'); ?>" class="normal_input_btn fl recalculate" />
                      </td>
                    </tr>
                  </table>
                </div>
               
                 <!--<a href="javascript:void(0);" onclick="document.checkout_frm.submit();" class="highlight_button fr checkout_spacer" >Check Out  &raquo; </a>--> </div>
              <!-- button bar #end -->
              <?php }?>
              <table class="ten">
                <tr>
                  <td>
              <a href="<?php echo get_option('siteurl'); ?>" class="fl-old continue_spacer-old radius button">&laquo; <?php _e('Continue Shopping'); ?>  </a>
                <!-- <input type="submit" name="Update" value="Checkout" class="b_checkout2 checkout_spacer fr " /> -->
                  </td>
                </tr>
              </table>
              <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td></td>
                  <td align="right"></td>
                </tr>
              </table> -->
            </form>
            <form action="<?php ?>" method="post" name="evaluate_coupon">
              <input type="hidden" name="cartact" value="eval_coupon" />
              <input type="hidden" name="eval_coupon_code" id="eval_coupon_code" value="" />
            </form>
            <?php
			}else
			{
			?>
        	 <h3><?php _e(EMPTY_CART_MSG); ?> </h3> <br />
          <a href="<?php echo get_option('siteurl');?>" class="highlight_button fl">&laquo; <?php _e('Continue Shopping'); ?> </a>
          <?php
		  	 $_SESSION['couponcode'] = '';
            }
			?>
  			  </div> <!-- content #end -->
  </div> <!-- page #end -->
  <div class="ten columns">
    <hr>
  </div>
 <?php get_footer(); ?>


