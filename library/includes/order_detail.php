<?php
global $Cart,$General,$wpdb;
$userInfo = $General->getLoginUserInfo();
if(!$userInfo)
{
	wp_redirect(get_option( 'siteurl' ).'/?page=login');
	exit;
}
?>
<?php get_header(); ?>
<div class="breadcrumb clearfix">
	 <h1 class="head"><?php _e("Order Detail Page");?></h1>
     <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; Order Detail'); } ?>
 </div> <!-- breadcrumbs #end -->

<div id="page" class="clearfix">

     <div id="content">      
            
            
          <?php
		$userInfo = $General->getLoginUserInfo();
		$ordersql = "select meta_value from $wpdb->usermeta where meta_key = 'user_order_info' and user_id='".$userInfo['ID']."'";
		$orderinfo = $wpdb->get_results($ordersql);
		$orderId = $_GET['oid'];
		$order_number = preg_replace('/([0-9]*([_]))/','',$orderId);
		
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
		 ?>
        <?php echo $General->get_order_detailinfo_tableformat($orderInformationArray[0]); ?>         
            
 </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
 <?php get_footer(); ?>