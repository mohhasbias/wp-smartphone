<?php
if($_REQUEST['user_id'])
{
	$user_id = $_REQUEST['user_id'];
	$user_affiliate_data = get_usermeta($user_id,'user_affiliate_data');	
}else
{
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->data->ID;
	$user_affiliate_data = get_usermeta($user_id,'user_affiliate_data');
}
		
$exportstr = '';
$exportstr .= '<table>
<tr>
	    <td class="title">'. __('Date').' </td>
        <td class="title">'. __('Transaction ID').'</td>
        <td class="title">'. __('Payment Status').' </td>
        <td class="title">'. __('Item Name').' </td>
        <td class="title">'. __('Qty').'</td>
        <td class="title">'. __('Amount').' </td>
        <td class="title">'. __('Currency').' </td>
        <td class="title">'. __('Affiliate Share').' </td>
</tr>';

$record_count = 0;
if($user_affiliate_data)
{
    foreach($user_affiliate_data as $key => $val)
    {
        $showrecordflag = 0;
		$order_user_id = preg_replace('/(([_])[0-9]*)/','',$val['orderNumber']);
		if($_REQUEST['user_id'])
		{
			$user_order_info = get_usermeta($order_user_id,'user_order_info');
		}else
		{
			$user_order_info = unserialize(get_usermeta($order_user_id,'user_order_info'));
		}
		if($_REQUEST['srch_st_date'] != '' && $_REQUEST['srch_end_date'] =='')
		{
			if($val['date'] == $_REQUEST['srch_st_date'] )
			{
				$showrecordflag = 1;
			}
		}else
		if($_REQUEST['srch_st_date'] == '' && $_REQUEST['srch_end_date']!='')
		{
			if($val['date'] == $_REQUEST['srch_end_date'] )
			{
				$showrecordflag = 1;
			}
		}else
		if($_REQUEST['srch_st_date'] != '' && $_REQUEST['srch_st_date'] != '')
		{
			if(strtotime($val['date']) >= strtotime($_REQUEST['srch_st_date']) && strtotime($val['date']) <= strtotime($_REQUEST['srch_end_date']) )
			{
				$showrecordflag = 1;
			}
		}else
		{
			$showrecordflag = 1;
		}
		
		if($showrecordflag)
		{
            $order_number = preg_replace('/([0-9]*([_]))/','',$val['orderNumber']);
			$order_info1 = $user_order_info[$order_number-1][0];
            $cart_info = $order_info1['cart_info']['cart_info'];
            $order_info = $order_info1['order_info'];
            if($order_info['order_status'] == 'approve')
            {
                $record_count++;
                $order_status = $order_info['order_status'];
                $product_name = array();
                $product_qty = 0;
                $total_order_amt = 0;
                for($c=0;$c<count($cart_info);$c++)
                {
                    $product_name[] = $cart_info[$c]['product_name'];
                    $product_qty = $product_qty + $cart_info[$c]['product_qty'];
                }
                $product_name = implode(', ',$product_name);
                $currency = explode(' ',$order_info['payable_amt']);
                $share_amt = ($val['order_amt']*$val['share_amt'])/100;
                $share_total = 0;
                $share_total = $share_total + $share_amt; 
                $total_order_amt = $total_order_amt + $val['order_amt'];
				$exportstr .= '  <tr>
				<td class="row1" >'.date('Y-m-d',strtotime($order_info['order_date'])).'</td>
				<td class="row1" >'.$order_info['order_id'].'</td>
				<td class="row1" >'.$order_info['order_status'].'</td>
				<td class="row1" >'. $product_name.'</td>
				<td class="row1" >'. $product_qty.'</td>
				<td class="row1" >'. number_format($val['order_amt'],2).'</td>
				<td class="row1" >'. $currency[1].'</td>
				<td class="row1" >'. number_format($share_amt,2).'</td>
				</tr> ';
            }			
        }			
    }
}
if($record_count == '0')
{
$exportstr .= '<tr><td colspan="8"> Not a single Sale is available.</td></tr>';
}else
{
$exportstr .= '<tr><td class="title" colspan="4">&nbsp;</td><td class="title">'. __('Total').'</td>
<td class="title">'.number_format($total_order_amt,2).'</td>
<td class="title">&nbsp;</td>
<td class="title">'. number_format($share_total,2).'</td></tr>';
}
echo $exportstr .= '</table>';
header('Content-Description: File Transfer');
header("Content-type: application/force-download");
header('Content-Disposition: inline; filename="report.xls"');
//readfile($exportstr);
?>