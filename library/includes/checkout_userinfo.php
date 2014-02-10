<?php
$chekcout_method = $General->get_checkout_method();

if($userInfo) //simple checkout
{
?>
<div class="checkout_address">
  <div class="address_info fl">
	<h3><?php _e('Billing Address'); ?> </h3>
	<div class="address_row"> <b><?php echo $userInfo['display_name'];?></b></div>
	<div class="address_row"><?php echo $user_address_info['user_add1'];?></div>
	<div class="address_row"><?php echo $user_address_info['user_add2'];?></div>
	<div class="address_row"><?php echo $user_address_info['user_city'];?>, <?php echo $user_address_info['user_state'];?>,</div>
	<div class="address_row"><?php echo $user_address_info['user_country'];?> - <?php echo $user_address_info['user_postalcode'];?></div>
  </div>
  <div class="address_info fr">
	<h3><?php _e('Shipping Address'); ?> <span>(<a href="<?php echo get_option('siteurl'); ?>/?page=account&type=editprofile"><u><?php _e('Edit'); ?></u></a>)</span> </h3>
	<div class="address_row"> <b><?php echo $user_address_info['buser_name'];?></b></div>
	<div class="address_row"><?php echo $user_address_info['buser_add1'];?> </div>
	<div class="address_row"><?php echo $user_address_info['buser_add2'];?></div>
	<div class="address_row"><?php echo $user_address_info['buser_city'];?>, <?php echo $user_address_info['buser_state'];?>, </div>
	<div class="address_row"><?php echo $user_address_info['buser_country'];?> - <?php echo $user_address_info['buser_postalcode'];?></div>
  </div>
</div>
<?php
}else  //single page checkout
{
?>
<div class="checkout_address">
  <div class="address_info fl">
	<h3><?php _e('User Information');?></h3>
	<div class="address_row"><?php _e('Your Name');?> <span class="indicates">*</span><input type="text" name="user_fname" id="user_fname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25"  /></div>
    <div class="address_row"><?php _e('Email');?> <span class="indicates">*</span> <input type="text" name="user_email" id="user_email" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" /></div>

  <?php
    if(!$General->is_storetype_digital())
	{
	?>
    <?php
	$mandotary_info = $General->get_userinfo_mandatory_fields();
	if($mandotary_info['bill_address1'])
	{
		$bill_address1 = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_address2'])
	{
		$bill_address2 = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_city'])
	{
		$bill_city = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_state'])
	{
		$bill_state = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_country'])
	{
		$bill_country = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_zip'])
	{
		$bill_zip = ' <span class="indicates">*</span>';
	}
	?>
    <h4><?php _e('Billing Address');?></h4>
    <div class="address_row"><?php _e('Address');?> <?php echo $bill_address1;?> <input type="text" name="user_add1" id="user_add1" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_add1)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('City');?> <?php echo $bill_state;?> <input type="text" name="user_city" id="user_city" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_city)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('State');?> <?php echo $bill_state;?> <input type="text" name="user_state" id="user_state" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_state)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('Country');?> <?php echo $bill_country;?> <input type="text" name="user_country" id="user_country" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_country)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('Postalcode');?> <?php echo $bill_zip;?> <input type="text" name="user_postalcode" id="user_postalcode" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_postalcode)); ?>" size="25" /></div>
   <h4><?php _e('Shipping Address');?></h4> <span><input type="checkbox" name="copybilladd" id="copybilladd" onClick="copy_billing_address();" >same as above</span>
   <div class="address_row"><?php _e('Address');?> <input type="text" name="buser_add1" id="buser_add1" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_add1)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('City');?> <input type="text" name="buser_city" id="buser_city" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_city)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('State');?> <input type="text" name="buser_state" id="buser_state" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_state)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('Country');?>  <input type="text" name="buser_country" id="buser_country" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_country)); ?>" size="25" /></div>
    <div class="address_row"><?php _e('Postalcode');?> <input type="text" name="buser_postalcode" id="buser_postalcode" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_postalcode)); ?>" size="25" /></div> 
    <?php
	}
	?>
    </div>
  </div>
<script language="javascript" language="javascript">
function copy_billing_address()
{
	if(document.getElementById('copybilladd').checked)
	{
		document.getElementById('buser_add1').value = document.getElementById('user_add1').value;
		document.getElementById('buser_city').value = document.getElementById('user_city').value;
		document.getElementById('buser_state').value = document.getElementById('user_state').value;
		document.getElementById('buser_country').value = document.getElementById('user_country').value;
		document.getElementById('buser_postalcode').value = document.getElementById('user_postalcode').value;
	}else
	{
		document.getElementById('buser_add1').value = '';
		document.getElementById('buser_city').value = '';
		document.getElementById('buser_state').value = '';
		document.getElementById('buser_country').value = '';
		document.getElementById('buser_postalcode').value = '';
	}
}
</script>
<?php
}
?>