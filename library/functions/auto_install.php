<?php /*078dcd6b6613246bd7d5e272f106d938*/ ?>
<?php
/////////////// GENERAL SETTINGS START ///////////////
$shoppingcart_general_settings = get_option('shoppingcart_general_settings');
if(!$shoppingcart_general_settings || ($shoppingcart_general_settings && count($shoppingcart_general_settings)==0))
{
	$paymethodinfo = array(
						"currency"				=> 'USD',
						"currencysym"			=> '$',
						"site_email"			=> get_option('admin_email'),
						"site_email_name"		=>	get_option('blogname'),
						"tax"					=>	'0.00',
						"is_show_weight"		=>	'1',
						"store_type"			=>	'cart',
						"imagepath"				=>	"",		
						"is_show_coupon"		=>	"1",
						"dash_noof_orders"		=>	"10",
						"is_show_tellafrnd"		=>	"1",
						"is_show_addcomment"	=>	"0",
						"checkout_type"			=>	"cart",
						"is_show_relproducts"	=>	"1",
						"digitalproductpath"	=>	"",
						"is_show_blogpage"		=>	"1",
						"is_show_storepage"		=>	"1",
						"is_show_category"		=>	"1",
						"checkout_method"		=>	"normal",
						"is_show_termcondition"	=>	'1',
						"termcondition"			=>	'Accept Terms and Conditions',
						"loginpagecontent"		=>	'If you are an existing customer of [#$store_name#] or have previously registered you may sign in below or request a new password. Otherwise please enter your information below and an account will be created for you.',												
						"bill_address1"			=>	"1",
						"bill_address2"			=>	"1",																	
						"bill_city"				=>	"1",
						"bill_state"			=>	"1",
						"bill_country"			=>	"1",
						"bill_zip"				=>	"1",
						"is_active_affiliate"	=>	"0",
						"send_email_guest"		=>	"1",						
						);
	update_option("shoppingcart_general_settings",$paymethodinfo);
}
/////////////// GENERAL SETTINGS END ///////////////
/////////////// PAYMENT SETTINGS START ///////////////
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
for($i=0;$i<count($paymethodinfo);$i++)
{
	$payment_method_info = array();
	$payment_method_info  = get_option('payment_method_'.$paymethodinfo[$i]['key']);
	if(!$payment_method_info)
	{
		update_option('payment_method_'.$paymethodinfo[$i]['key'],$paymethodinfo[$i]);
	}
}
/////////////// PAYMENT SETTINGS END ///////////////
/////////////// SHIPPING METHIDS START /////////////// 
$shippingmethodinfo = array();
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Enable Free Shipping?",
				"fieldname"		=>	"free_shipping_amt",
				"value"			=>	"0",
				"description"	=>	"Example : shipping amt = 0 ",
				);
$payOpts = array();
$shippingmethodinfo[] = array(
					"name" 		=> 'Free Shipping',
					"key" 		=> 'free_shipping',
					"isactive"	=>	'1', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Shipping Amount",
				"fieldname"		=>	"flat_rate_amt",
				"value"			=>	"0",
				"description"	=>	"Example : enter a value that will be added as default for shipping when someone goes throught checkout"
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Flat Rate Shipping',
					"key" 		=> 'flat_rate',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Price Shipping 1",
				"fieldname"		=>	"price_shipping1",
				"value"			=>	"10->100=1",
				"description"	=>	'Example : if total price is between $10 and $100 then shipping price is $1 so the equation is -> <strong>10->100=1</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 2",
				"fieldname"		=>	"price_shipping2",
				"value"			=>	"101->200=10",
				"description"	=>	'Example : if total price is between $101 and $200 then shipping price is $10 so the equation is -> <strong>101->200=10</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 3",
				"fieldname"		=>	"price_shipping3",
				"value"			=>	"201->300=20",
				"description"	=>	'Example : if total price is between $201 and $300 then shipping price is $20 so the equation is -> <strong>201->300=20</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 4",
				"fieldname"		=>	"price_shipping4",
				"value"			=>	"301->500=50",
				"description"	=>	'Example : if total price is between $301 and $500 then shipping price is $50 so the equation is -> <strong>301->500=50</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 5",
				"fieldname"		=>	"price_shipping5",
				"value"			=>	"501->1000=60",
				"description"	=>	'Example : if total price is between $301 and $500 then shipping price is $60 so the equation is -> <strong>301->500=60</strong>'
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Price Base Shipping',
					"key" 		=> 'price_base',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Weight Shipping 1",
				"fieldname"		=>	"price_shipping1",
				"value"			=>	"1->10=10",
				"description"	=>	"Example : if total weight is between 1 lbs and 10 lbs then shipping price is $10 so the equation is -> <strong>1->10=10</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 2",
				"fieldname"		=>	"price_shipping2",
				"value"			=>	"11->51=20",
				"description"	=>	"Example : if total weight is between 11 lbs and 51 lbs then shipping price is $20 so the equation is -> <strong>11->51=20</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 3",
				"fieldname"		=>	"price_shipping3",
				"value"			=>	"51->100=30",
				"description"	=>	"Example : if total weight is between 51 lbs and 100 lbs then shipping price is $30 so the equation is -> <strong>51->100=30</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 4",
				"fieldname"		=>	"price_shipping4",
				"value"			=>	"101->150=40",
				"description"	=>	"Example : if total weight is between 101 lbs and 150 lbs then shipping price is $40 so the equation is -> <strong>101->150=40</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 5",
				"fieldname"		=>	"price_shipping5",
				"value"			=>	"151->200=40",
				"description"	=>	"Example : if total weight is between 101 lbs and 150 lbs then shipping price is $40 so the equation is -> <strong>151->200=40</strong>"
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Weight Base Shipping',
					"key" 		=> 'weight_base',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
						
for($i=0;$i<count($shippingmethodinfo);$i++)
{
	$shipping_method_info = array();
	$shipping_method_info  = get_option('shipping_method_'.$shippingmethodinfo[$i]['key']);
	if(!$shipping_method_info)
	{
		update_option('shipping_method_'.$shippingmethodinfo[$i]['key'],$shippingmethodinfo[$i]);
	}
}
/////////////// SHIPPING METHIDS END ///////////////
/////////////// DISCOUNT COUPON START ///////////////
$discount_coupons = array();
$discount_coupons  = get_option('discount_coupons');
if(!$discount_coupons)
{
	$discount_coupons_arr[] = array(
						"couponcode"	=>	'friend_discount',
						"dis_per"		=>	'15',
						"dis_amt"		=>	'',
						);
	$discount_coupons_arr[] = array(
						"couponcode"	=>	'customer_discount',
						"dis_per"		=>	'10',
						"dis_amt"		=>	'',
						);
	update_option('discount_coupons',$discount_coupons_arr);
}
/////////////// DISCOUNT COUPON END ///////////////
/////////////// TERMS & products START ///////////////
$category_array = array('Blog','Feature','Beauty &amp; Fragrance','Books',array('Digital Products','Icons','Wordpress Theme'),'Electronics','Kids',array('Men','Coats &amp; Jackets','Hats, Gloves &amp; Scarves','Shirts &amp; Ties'),array('Shoe','Boots','Sandals'));

$post_array = array();
$post_author = $wpdb->get_var("SELECT ID FROM $wpdb->users order by ID asc limit 1");
$post_info = array();
$post_info[] = array(
					"post_title"	=>	'Blog Post1',
					"post_content"	=>	'Description for Blog Post1',
					);
$post_info[] = array(
					"post_title"	=>	'Blog Post2',
					"post_content"	=>	'Description for Blog Post2',
					);
$post_info[] = array(
					"post_title"	=>	'Blog Post3',
					"post_content"	=>	'Description for Blog Post3',
					);					
$post_array['Blog'] = $post_info;

$post_info = array();
////product 1 start///
$post_meta = array();
$dummy_image_path = get_template_directory_uri().'/images/dummy/';
$post_meta = array(
					"productimage"			=> $dummy_image_path.'ad-290x300.png',	
					"productimage1"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage2"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage3"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage4"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage5"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage6"			=> $dummy_image_path.'30536_nokia6080_200.jpg',		
					"price"					=> '50',	
					"specialprice"			=> '30',	
					"size"					=> 'small,smaller,mideum',
					"color"					=> 'red,green,blue',
					"posttype"				=> 'product',
				);
$post_info[] = array(
					"post_title"	=>	'Icons1',
					"post_content"	=>	'Description for Beauty Product',
					"post_meta"		=>	$post_meta,
					"post_feature"	=>	1,
					);
////product 1 end///
////product 2 start///
$post_meta = array();
$post_meta = array(
					"productimage"			=> $dummy_image_path.'30536_nokia6080_200.jpg',
					"productimage1"			=> $dummy_image_path.'cellphone01.jpg',	
					"productimage2"			=> $dummy_image_path.'cellphone02.jpg',
					"productimage3"			=> $dummy_image_path.'cellphone04.jpg',
					"productimage4"			=> $dummy_image_path.'cellphone05.jpg',
					"productimage5"			=> $dummy_image_path.'cellphone06.jpg',
					"productimage6"			=> $dummy_image_path.'30536_nokia6080_200.jpg',
					"price"					=> '50',	
					"specialprice"			=> '30',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
				);
$post_info[] = array(
					"post_title"	=>	'Icons2',
					"post_content"	=>	'Description for Fragrance Product',
					"post_meta"		=>	$post_meta,
					"post_feature"	=>	1,
					);
////product 2 end///
			
$post_array['Icons'] = $post_info;
//===================================================================================//
////product 1 start///
$post_meta = array();
$dummy_image_path = get_template_directory_uri().'/images/dummy/';
$post_meta = array(
					"productimage"			=> $dummy_image_path.'ad-290x300.png',	
					"productimage1"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage2"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage3"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage4"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage5"			=> $dummy_image_path.'ad-290x300.png',		
					"productimage6"			=> $dummy_image_path.'30536_nokia6080_200.jpg',		
					"price"					=> '50',	
					"specialprice"			=> '30',	
					"size"					=> 'small,smaller,mideum',
					"color"					=> 'red,green,blue',
					"posttype"				=> 'product',
				);
$post_info[] = array(
					"post_title"	=>	'Beauty Product',
					"post_content"	=>	'Description for Beauty Product',
					"post_meta"		=>	$post_meta,
					"post_feature"	=>	1,
					);
////product 1 end///
////product 2 start///
$post_meta = array();
$post_meta = array(
					"productimage"			=> $dummy_image_path.'30536_nokia6080_200.jpg',
					"productimage1"			=> $dummy_image_path.'cellphone01.jpg',	
					"productimage2"			=> $dummy_image_path.'cellphone02.jpg',
					"productimage3"			=> $dummy_image_path.'cellphone04.jpg',
					"productimage4"			=> $dummy_image_path.'cellphone05.jpg',
					"productimage5"			=> $dummy_image_path.'cellphone06.jpg',
					"productimage6"			=> $dummy_image_path.'30536_nokia6080_200.jpg',
					"price"					=> '50',	
					"specialprice"			=> '30',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
				);
$post_info[] = array(
					"post_title"	=>	'Fragrance Product',
					"post_content"	=>	'Description for Fragrance Product',
					"post_meta"		=>	$post_meta,
					"post_feature"	=>	1,
					);
////product 2 end///
////product 3 start///
$post_meta = array();
$post_meta = array(
					"productimage"			=> 'image3.jpg',	
					"productimage1"			=> 'image31.jpg',	
					"productimage2"			=> 'image32.jpg',	
					"productimage3"			=> 'image33.jpg',	
					"productimage4"			=> 'image34.jpg',	
					"productimage5"			=> 'image35.jpg',	
					"productimage6"			=> 'image36.jpg',	
					"price"					=> '50',	
					"specialprice"			=> '30',	
					"size"					=> 'small,smaller,mideum',
					"color"					=> 'red,green,blue',
					"posttype"				=> 'product',
				);
$post_info[] = array(
					"post_title"	=>	'Beauty Fragrance',
					"post_content"	=>	'Description for Beauty Fragrance',
					"post_meta"		=>	$post_meta,
					);
////product 3 end///				
$post_array['Beauty &amp; Fragrance'] = $post_info;

$feature_cat_name = 'Feature';
$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");
for($c=0;$c<count($category_array);$c++)
{
	$cat_name = $category_array[$c];
	if(is_array($cat_name))
	{
		$parent_cat_id = '0';
		$cat_name_arr = $cat_name;
		for($i=0;$i<count($cat_name_arr);$i++)
		{
			$cat_id = '';
			$cat_name = $cat_name_arr[$i];
			$cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$cat_name\"");
			if($cat_id=='')
			{
				$srch_arr = array(' &amp; ',' ');
				$replace_arr = array('-','-');
				$slug = str_replace($srch_arr,$replace_arr,$cat_name);
				$cat_sql = "insert into $wpdb->terms (name,slug) values (\"$cat_name\",\"$slug\")";
				$wpdb->query($cat_sql);
				$last_cat_id = $wpdb->get_var("SELECT max(term_id) FROM $wpdb->terms");
				$cat_id  = $last_cat_id;
				$count = count($post_array[$cat_name]);
				$tt_sql = "insert into $wpdb->term_taxonomy (term_id,taxonomy,parent,count) values (\"$last_cat_id\",'category',\"$parent_cat_id\",\"$count\")";
				$wpdb->query($tt_sql);
				$last_tt_id = $wpdb->get_var("SELECT max(term_taxonomy_id) FROM $wpdb->term_taxonomy");
				if($post_array[$cat_name])
				{
					$post_info_arr = $post_array[$cat_name];
					if(count($post_info_arr)>0)
					{
						for($p=0;$p<count($post_info_arr);$p++)
						{
							$post_title = $post_info_arr[$p]['post_title'];
							$post_content = $post_info_arr[$p]['post_content'];
							$post_date = date('Y-m-d H:s:i');
							$post_name = str_replace(array("'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," "),'',$post_title);
							$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_name=\"$post_name\"");
							if($post_name_count>0)
							{
								$post_name = $post_name.'-'.($post_name_count+1);
							}
							$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_content,post_title,post_name) values (\"$post_author\", \"$post_date\", \"$post_date\", \"$post_content\", \"$post_title\", \"$post_name\")";
							$wpdb->query($post_sql);
							$guid = get_option('siteurl')."/?p=$last_postid";
							$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
							$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
							$wpdb->query($guid_sql);
							$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
							$wpdb->query($ter_relation_sql);
							$post_feature = $post_info_arr[$p]['post_feature'];
							if($post_feature && $feature_cat_id)
							{
								$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$feature_cat_id\")";
								$wpdb->query($ter_relation_sql);
								$tt_update_sql = "update $wpdb->term_taxonomy set count=count+1 where term_id=\"$feature_cat_id\"";
								$wpdb->query($tt_update_sql);
							}
						}
					}
				}				
			}else
			{
				$last_cat_id = $cat_id;
				$count = count($post_array[$cat_name]);
				$last_tt_id = $wpdb->get_var("SELECT tt.term_taxonomy_id FROM $wpdb->term_taxonomy tt where tt.term_id=\"$last_cat_id\" and tt.taxonomy='category'");
				if($post_array[$cat_name])
				{
					$post_info_arr = $post_array[$cat_name];
					if(count($post_info_arr)>0)
					{
						for($p=0;$p<count($post_info_arr);$p++)
						{
							$post_title = $post_info_arr[$p]['post_title'];
							$post_content = $post_info_arr[$p]['post_content'];
							$post_date = date('Y-m-d H:s:i');
							$post_name = str_replace(array("'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," "),'',$post_title);
							$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_name=\"$post_name\"");
							if($post_name_count>0)
							{
								$post_name = $post_name.'-'.($post_name_count+1);
							}
							$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_content,post_title,post_name) values (\"$post_author\", \"$post_date\", \"$post_date\", \"$post_content\", \"$post_title\", \"$post_name\")";
							$wpdb->query($post_sql);
							$guid = get_option('siteurl')."/?p=$last_postid";
							$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
							$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
							$wpdb->query($guid_sql);
							update_post_meta( $last_post_id, 'key', $post_info_arr[$p]['post_meta'] );
							$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
							$wpdb->query($ter_relation_sql);
							$post_feature = $post_info_arr[$p]['post_feature'];
							if($post_feature && $feature_cat_id)
							{
								$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$feature_cat_id\")";
								$wpdb->query($ter_relation_sql);
								$tt_update_sql = "update $wpdb->term_taxonomy set count=count+1 where term_id=\"$feature_cat_id\"";
								$wpdb->query($tt_update_sql);
							}
						}
					}
				}
				$tt_update_sql = "update $wpdb->term_taxonomy set count=count+$count where term_id=\"$last_cat_id\"";
				$wpdb->query($tt_update_sql);
			}
			if($i==0)
			{
				$parent_cat_id = $last_cat_id;
			}
		}
	}else
	{
		$cat_id = '';
		$cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$cat_name\"");
		if($cat_id=='')
		{
			$srch_arr = array(' &amp; ',' ');
			$replace_arr = array('-','-');
			$slug = str_replace($srch_arr,$replace_arr,$cat_name);
			$cat_sql = "insert into $wpdb->terms (name,slug) values (\"$cat_name\",\"$slug\")";
			$wpdb->query($cat_sql);
			$last_cat_id = $wpdb->get_var("SELECT max(term_id) FROM $wpdb->terms");
			$count = count($post_array[$cat_name]);
			$parent_cat_id = 0;
			$tt_sql = "insert into $wpdb->term_taxonomy (term_id,taxonomy,parent,count) values (\"$last_cat_id\",'category',\"$parent_cat_id\",\"$count\")";
			$wpdb->query($tt_sql);
			$last_tt_id = $wpdb->get_var("SELECT max(term_taxonomy_id) FROM $wpdb->term_taxonomy");
			if($post_array[$cat_name])
			{
				$post_info_arr = $post_array[$cat_name];
				if(count($post_info_arr)>0)
				{
					for($p=0;$p<count($post_info_arr);$p++)
					{
						$post_title = $post_info_arr[$p]['post_title'];
						$post_content = $post_info_arr[$p]['post_content'];
						$post_date = date('Y-m-d H:s:i');
						$post_name = str_replace(array("'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," "),'',$post_title);
						$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_name=\"$post_name\"");
						if($post_name_count>0)
						{
							$post_name = $post_name.'-'.($post_name_count+1);
						}
						$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_content,post_title,post_name) values (\"$post_author\", \"$post_date\", \"$post_date\", \"$post_content\", \"$post_title\", \"$post_name\")";
						$wpdb->query($post_sql);
						$guid = get_option('siteurl')."/?p=$last_postid";
						$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
						$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
						$wpdb->query($guid_sql);
						update_post_meta( $last_post_id, 'key', $post_info_arr[$p]['post_meta'] );
						$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
						$wpdb->query($ter_relation_sql);
						$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");
						$post_feature = $post_info_arr[$p]['post_feature'];
						if($post_feature && $feature_cat_id)
						{
							$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$feature_cat_id\")";
							$wpdb->query($ter_relation_sql);
							$tt_update_sql = "update $wpdb->term_taxonomy set count=count+1 where term_id=\"$feature_cat_id\"";
							$wpdb->query($tt_update_sql);
						}
					}
				}
			}	
		}else
		{
			$last_cat_id = $cat_id;
			$count = count($post_array[$cat_name]);
			$tt_update_sql = "update $wpdb->term_taxonomy set count=count+$count where term_id=\"$last_cat_id\"";
			$wpdb->query($tt_update_sql);
			$last_tt_id = $wpdb->get_var("SELECT tt.term_taxonomy_id FROM $wpdb->term_taxonomy tt where tt.term_id=\"$last_cat_id\" and tt.taxonomy='category'");
			if($post_array[$cat_name])
			{
				$post_info_arr = $post_array[$cat_name];
				if(count($post_info_arr)>0)
				{
					for($p=0;$p<count($post_info_arr);$p++)
					{
						$post_title = $post_info_arr[$p]['post_title'];
						$post_content = $post_info_arr[$p]['post_content'];
						$post_date = date('Y-m-d H:s:i');
						$post_name = str_replace(array("'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," "),'',$post_title);
						$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_name=\"$post_name\"");
						if($post_name_count>0)
						{
							$post_name = $post_name.'-'.($post_name_count+1);
						}
						$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_content,post_title,post_name) values (\"$post_author\", \"$post_date\", \"$post_date\", \"$post_content\", \"$post_title\", \"$post_name\")";
						$wpdb->query($post_sql);
						$guid = get_option('siteurl')."/?p=$last_postid";
						$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
						$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
						$wpdb->query($guid_sql);
						update_post_meta( $last_post_id, 'key', $post_info_arr[$p]['post_meta'] );
						$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
						$wpdb->query($ter_relation_sql);
						$post_feature = $post_info_arr[$p]['post_feature'];
						$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");
						if($post_feature && $feature_cat_id)
						{
							$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$feature_cat_id\")";
							$wpdb->query($ter_relation_sql);
							$tt_update_sql = "update $wpdb->term_taxonomy set count=count+1 where term_id=\"$feature_cat_id\"";
							$wpdb->query($tt_update_sql);
						}
					}
				}
			}
		}
	}
}
/////////////// TERMS END ///////////////
/////////////// Design Settings START ///////////////
$blog_cat_name = 'Blog';
$blog_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$blog_cat_name\"");
update_option("cat_exclude_$blog_cat_id",$blog_cat_id);
update_option("ptthemes_breadcrumbs",'true');
update_option("ptthemes_add_to_cart_button_position",'Below Description');
/////////////// Design Settings END ///////////////
/////////////// WIDGET SETTINGS START ///////////////
$feature_cat_name = 'Feature';
$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");

//print_r(get_option('widget_widget_text'));
$home_slider_info[] = array(
					"title"				=>	'Slider',
					"category"			=>	$feature_cat_id,
					"post_number"		=>	'5',
					"post_link"			=>	'',
					);
$home_slider_info['_multiwidget'] = '1';

update_option('widget_widget_posts1',$home_slider_info);
$home_slider_widget_info = get_option('widget_widget_posts1');
krsort($home_slider_widget_info);
foreach($home_slider_widget_info as $key1=>$val1)
{
	$home_slider_widget_info_key = $key1;
	if(is_int($home_slider_widget_info_key))
	{
		break;
	}
}
		
$home_banner_info[] = array(
					"title"			=>	'',
					"advt1"			=>	$dummy_image_path.'ad-290x300.png',
					"advt_link1"	=>	'http://cepoko.com',
					"advt2"			=>	'',
					"advt_link2"	=>	'',
					);
$home_banner_info['_multiwidget'] = '1';

update_option('widget_widget_text',$home_banner_info);
$home_banner_widget_info = get_option('widget_widget_text');
krsort($home_banner_widget_info);
foreach($home_banner_widget_info as $key=>$val)
{
	$home_banner_widget_info_key = $key;
	if(is_int($home_banner_widget_info_key))
	{
		break;
	}
}
$wp_inactive_widgets = get_option('sidebars_widgets');
$wp_inactive_widgets["sidebar-1"] = array('widget_posts1-'.$home_slider_widget_info_key);
$wp_inactive_widgets["sidebar-2"] = array('widget_text-'.$home_banner_widget_info_key);
update_option('sidebars_widgets',$wp_inactive_widgets);
//echo "<pre>";
//print_r(get_option('sidebars_widgets'));
//print_r(get_option('widget_widget_posts1'));
//print_r(get_option('widget_widget_text'));
/////////////// WIDGET SETTINGS END ///////////////
?>
