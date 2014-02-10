<?php
global $wpdb;

if($_GET['status']!='' && $_GET['id']!='')
{
	$paymentupdsql = "select option_value from $wpdb->options where option_id='".$_GET['id']."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	if($paymentupdinfo)
	{
		foreach($paymentupdinfo as $paymentupdinfoObj)
		{
			$option_value = unserialize($paymentupdinfoObj->option_value);
			$option_value['isactive'] = $_GET['status'];
			$option_value_str = serialize($option_value);
			$message = "Status Updated Successfully.";
		}
	}
	
	$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_id='".$_GET['id']."'";
	$wpdb->query($updatestatus);
}

///////////update options start//////
if($_GET['payact']=='setting' && $_GET['id']!='')
{
	include_once(TEMPLATEPATH . '/library/includes/admin_paymet_settings.php');
	exit;
}
//////////update options end////////

/*$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id asc";
$paymentinfo = $wpdb->get_results($paymentsql);
if(count($paymentinfo)==0)
{*/
//////////pay settings start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"myaccount@paypal.com",
					"description"	=>	"Example : myaccount@paypal.com",
					);
	$payOpts[] = array(
					"title"			=>	"Cancel Url",
					"fieldname"		=>	"cancel_return",
					"value"			=>	get_option('siteurl')."/?page=cancel_return&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/cancel_return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Return Url",
					"fieldname"		=>	"returnUrl",
					"value"			=>	get_option('siteurl')."/?page=return&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"notify_url",
					"value"			=>	get_option('siteurl')."/?page=notifyurl&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/notifyurl.php",
					);
								
	$paymethodinfo[] = array(
						"name" 		=> 'Paypal',
						"key" 		=> 'paypal',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'1',
						"payOpts"	=>	$payOpts,
						);
	//////////pay settings end////////
	
	//////////google checkout start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"1234567890",
					"description"	=>	"Example : 1234567890"
					);
												
	$paymethodinfo[] = array(
						"name" 		=> 'Google Checkout',
						"key" 		=> 'googlechkout',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'2',
						"payOpts"	=>	$payOpts,
						);

//////////google checkout end////////
//////////authorize.net start////////

$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Login ID",
					"fieldname"		=>	"loginid",
					"value"			=>	"yourname@domain.com",
					"description"	=>	"Example : yourname@domain.com"
					);
	$payOpts[] = array(
					"title"			=>	"Transaction Key",
					"fieldname"		=>	"transkey",
					"value"			=>	"1234567890",
					"description"	=>	"Example : 1234567890",
					);
					
	$paymethodinfo[] = array(
						"name" 		=> 'Authorize.net',
						"key" 		=> 'authorizenet',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'3',
						"payOpts"	=>	$payOpts,
						);

//////////authorize.net end////////
//////////worldpay start////////

	$payOpts = array();	
	$payOpts[] = array(
					"title"			=>	"Instant Id",
					"fieldname"		=>	"instId",
					"value"			=>	"123456",
					"description"	=>	"Example : 123456"
					);
	$payOpts[] = array(
					"title"			=>	"Account Id",
					"fieldname"		=>	"accId1",
					"value"			=>	"12345",
					"description"	=>	"Example : 12345"
					);
											
	$paymethodinfo[] = array(
						"name" 		=> 'Worldpay',
						"key" 		=> 'worldpay',
						"isactive"	=>	'1', // 1->display,0->hide\
						"display_order"=>'4',
						"payOpts"	=>	$payOpts,
						);
//////////worldpay end////////
//////////2co start////////

	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Vendor ID",
					"fieldname"		=>	"vendorid",
					"value"			=>	"1303908",
					"description"	=>	"Enter Vendor ID Example : 1303908"
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"ipnfilepath",
					"value"			=>	get_option('siteurl')."/?page=notifyurl&pmethod=2co",
					"description"	=>	"Example : http://mydomain.com/2co_notifyurl.php",
					);
					
	$paymethodinfo[] = array(
						"name" 		=> '2CO (2Checkout)',
						"key" 		=> '2co',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'5',
						"payOpts"	=>	$payOpts,
						);
	
								
//////////2co end////////
//////////pre bank transfer start////////

	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Bank Information",
					"fieldname"		=>	"bankinfo",
					"value"			=>	"ICICI Bank",
					"description"	=>	"Enter the bank name to which you want to transfer payment"
					);
	$payOpts[] = array(
					"title"			=>	"Account ID",
					"fieldname"		=>	"bank_accountid",
					"value"			=>	"AB1234567890",
					"description"	=>	"Enter your bank Account ID",
					);
					
	$paymethodinfo[] = array(
						"name" 		=> 'Pre Bank Transfer',
						"key" 		=> 'prebanktransfer',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'6',
						"payOpts"	=>	$payOpts,
						);
											
//////////pre bank transfer end////////
//////////pay cash on devivery start////////
	$payOpts = array();
	$paymethodinfo[] = array(
						"name" 		=> 'Pay Cash On Delivery',
						"key" 		=> 'payondelevary',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'7',
						"payOpts"	=>	$payOpts,
						);

//////////pay cash on devivery end////////
///////////////////////////////////////


	
	

						
/*	for($i=0;$i<count($paymethodinfo);$i++)
	{
		$paymethodArray = array(
							"option_name"	=>	'payment_method_'.$paymethodinfo[$i]['key'],
							"option_value"	=>	serialize($paymethodinfo[$i]),
							);
		$wpdb->insert( $wpdb->options, $paymethodArray );
		//print_r(unserialize(serialize($paymethodArray)));
	}*/
//}
for($i=0;$i<count($paymethodinfo);$i++)
{
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_".$paymethodinfo[$i]['key']."' order by option_id asc";
	$paymentinfo = $wpdb->get_results($paymentsql);
	if(count($paymentinfo)==0)
	{
		$paymethodArray = array(
						"option_name"	=>	'payment_method_'.$paymethodinfo[$i]['key'],
						"option_value"	=>	serialize($paymethodinfo[$i]),
						);
		$wpdb->insert( $wpdb->options, $paymethodArray );
	}
}


$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%'";
$paymentinfo = $wpdb->get_results($paymentsql);
?>
<style>
h2 {
	color:#464646;
	font-family:Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
	font-size:24px;
	font-size-adjust:none;
	font-stretch:normal;
	font-style:italic;
	font-variant:normal;
	font-weight:normal;
	line-height:35px;
	margin:0;
	padding:14px 15px 3px 0;
	text-shadow:0 1px 0 #FFFFFF;
}
</style>
<h2>Manage Payment Options</h2>
<?php if($message){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php echo $message;?> </p>
</div>
<?php }?>
<table width="100%"  class="widefat post fixed" >
  <thead>
    <tr>
      <th width="180"><strong>Method Name</strong></th>
      <th width="85"><strong>Is Active</strong></th>
      <th width="85" align="center"><strong>Sort Order</strong></th>
      <th width="85" align="center"><strong>Action</strong></th>
      <th width="85" align="center"><strong>Settings</strong></th>
      <th>&nbsp;</th>
    </tr>
    <?php
if($paymentinfo)
{
	foreach($paymentinfo as $paymentinfoObj)
	{
		$paymentInfo = unserialize($paymentinfoObj->option_value);
		$option_id = $paymentinfoObj->option_id;
		$paymentInfo['option_id'] = $option_id;
		$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
	}
	ksort($paymentOptionArray);
	foreach($paymentOptionArray as $key=>$paymentInfoval)
	{
		for($i=0;$i<count($paymentInfoval);$i++)
		{
			$paymentInfo = $paymentInfoval[$i];
			$option_id = $paymentInfo['option_id'];
		?>
    <tr>
      <td><?php echo $paymentInfo['name'];?></td>
      <td><?php if($paymentInfo['isactive']){echo "Yes";}else{echo "No";}?></td>
      <td><?php echo $paymentInfo['display_order'];?></td>
      <td><?php if($paymentInfo['isactive']==1)
	{
		echo '<a href="'.get_option( 'siteurl' ).'/wp-admin/admin.php?page=paymentoptions&status=0&id='.$option_id.'">Deactivate</a>';
	}else
	{
		echo '<a href="'.get_option( 'siteurl' ).'/wp-admin/admin.php?page=paymentoptions&status=1&id='.$option_id.'">Activate</a>';
	}
	?></td>
      <td><?php
    echo '<a href="'.get_option( 'siteurl' ).'/wp-admin/admin.php?page=paymentoptions&payact=setting&id='.$option_id.'">Settings</a>';
	?></td>
      <td>&nbsp;</td>
    </tr>
    <?php
		}
	}
}
?>
  </thead>
</table>