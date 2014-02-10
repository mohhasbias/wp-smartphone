<h3><?php _e('My Orders');?>  </h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
  <tr>
    <td class="title"><?php _e('Order Number');?></td>
    <td width="25%" align="center" class="title"><?php _e('Date');?></td>
    <td width="10%" align="center" class="title"><?php _e('Price');?></td>
    <td width="10%" align="center" class="title"><?php _e('Status');?></td>
  </tr>
  <?php
$userInfo = $General->getLoginUserInfo();
$ordersql = "select meta_value from $wpdb->usermeta where meta_key = 'user_order_info' and user_id='".$userInfo['ID']."'";
$orderinfo = $wpdb->get_results($ordersql);
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
		$meta_value_arr = array();
		$meta_value = unserialize(unserialize($orderinfoObj->meta_value));
		if($meta_value)
		{
			foreach($meta_value as $oid=>$ovalue)
			{
				$user_info = $ovalue[0]['user_info'];
				$cart_info = $ovalue[0]['cart_info'];
				$payment_info = $ovalue[0]['payment_info'];
				$order_info = $ovalue[0]['order_info'];
			?>
	  <tr>
		<td class="row1"><a href="<?php echo get_option('siteurl');?>/?page=order_detail&oid=<?php echo $order_info['order_id'];?>"><?php echo $order_info['order_id'];?></a></td>
		<td align="center" class="row1"><?php echo date(get_option('date_format'),strtotime($order_info['order_date']));?></td>
		<td align="center" class="row1 tprice"><?php echo $cart_info['cart_amt'];?></td>
		<td align="center" class="remove"><?php echo $General->getOrderStatus($order_info['order_status']);?></td>
	  </tr>
	  <?php
			}
		}else
		{
		?>
        <tr><td colspan="4">
			<?php _e("<p>Not a single Order placed</p>");?>
         </td></tr>
		<?php
        }
	}
}
?>
</table>