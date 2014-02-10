<?php
global $Cart,$General;
$itemsInCartCount = $Cart->cartCount();
$grandTotal = $General->get_currency_symbol().number_format($Cart->getCartAmt(),2);
$userInfo = $General->getLoginUserInfo();
if($_SESSION['checkout_as_guest'] == '') //normal checkout
{
	if(!$userInfo)
	{
		wp_redirect(get_option( 'siteurl' ).'/?page=login');
		exit;
	}
}
$orderId = $_REQUEST['order'];
$order_number = preg_replace('/([0-9]*([_]))/','',$orderId);
$custmer_id = preg_replace('/(([_][0-9]*))/','',$orderId);

$ordersql = "select meta_value from $wpdb->usermeta where meta_key = 'user_order_info' and user_id='".$custmer_id."'";
$orderinfo = $wpdb->get_results($ordersql);
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
		$meta_value = unserialize(unserialize($orderinfoObj->meta_value)); 	
		$orderInformationArray = $meta_value[$order_number-1];
		$user_info = $orderInformationArray[0]['user_info'];
		$cart_info = $orderInformationArray[0]['cart_info'];
		$payment_info = $orderInformationArray[0]['payment_info'];
		$order_info = $orderInformationArray[0]['order_info'];
	}
}
$user_address_info = unserialize(get_user_option('user_address_info', $userInfo['ID']));
?>
<?php get_header(); ?>

<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
		 <h1 class="head"><?php _e(THANK_YOU_TITLE) ?></h1>
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(THANK_YOU_TITLE)); } ?>
     </div> <!-- breadcrumbs #end -->


  <div class="clearfix container_border">
     
    
    
    
  </div>
 
    <div id="content" >
        
     
      <div class="content_spacer">
        <?php
if($payment_info['paydeltype'] == 'prebanktransfer')
{
	$destinationfile =   ABSPATH . "wp-content/uploads/notification/message/payment_success_prebank_transfer.txt";
	$filecontent = __('<p>Thank you, your order has been successfully received.</p>Thank you for shopping at [#$store_name#].');
}else
{
	$destinationfile =   ABSPATH . "wp-content/uploads/notification/message/thankyou.txt";
	$filecontent = '<p>Thank you, your order has been successfully received.</p>
					<p>To complete the order Please transfer amount of <u>[#$order_amt#] </u> out bank with the following information :</p>
					<p>Bank Name : [#$bank_name#]</p>
					<p>Account Number : [#$account_number#]</p>
					<br>
					<p>Please include the following reference : [#$orderId#]</p>
					<br>
					<p>Upon receipt we will process and ship your order.</p>
					<p>Thank you for shopping at [#$store_name#].</p>
				';
	$filecontent = __($filecontent);
}
if(file_exists($destinationfile))
{
	$filecontent = file_get_contents($destinationfile);
}
 ?>
<?php
$store_name = get_option('blogname');
if($payment_info['paydeltype'] == 'prebanktransfer')
{
	$order_id = $order_info['order_id'];
	$order_amt = $order_info['payable_amt'];
	$paymentupdsql = "select option_value from $wpdb->options where option_name='payment_method_".$payment_info['paydeltype']."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	$paymentInfo = unserialize($paymentupdinfo[0]->option_value);
	$payOpts = $paymentInfo['payOpts'];
	$bankInfo = $payOpts[0]['value'];
	$accountinfo = $payOpts[1]['value'];
}

$search_array = array('[#$order_amt#]','[#$bank_name#]','[#$account_number#]','[#$orderId#]','[#$store_name#]');
$replace_array = array($order_amt,$bankInfo,$accountinfo,$order_id,$store_name);
$filecontent = str_replace($search_array,$replace_array,$filecontent);	
echo $filecontent;
?>
        
        </div>
 
  			  </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
 <?php get_footer(); ?>
