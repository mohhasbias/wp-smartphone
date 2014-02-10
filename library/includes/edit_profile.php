<?php
global $General,$wpdb;
$userInfo = $General->getLoginUserInfo();
if($_POST)
{
	if($_REQUEST['chagepw'])
	{
		$new_passwd = $_POST['new_passwd'];
		if($new_passwd)
		{
			$user_id = $current_user->data->ID;
			wp_set_password($new_passwd, $user_id);
			$message1 = "Password Changed successfully.";
		}		
	}else
	{
		$user_id = $userInfo['ID'];
		$user_add1 = $_POST['user_add1'];
		$user_add2 = $_POST['user_add2'];
		$user_city = $_POST['user_city'];
		$user_state = $_POST['user_state'];
		$user_country = $_POST['user_country'];
		$user_postalcode = $_POST['user_postalcode'];
		
		$buser_add1 = $_POST['buser_add1'];
		$buser_add2 = $_POST['buser_add2'];
		$buser_city = $_POST['buser_city'];
		$buser_state = $_POST['buser_state'];
		$buser_country = $_POST['buser_country'];
		$buser_postalcode = $_POST['buser_postalcode'];
		$user_address_info = array(
							"user_add1"		=> $user_add1,
							"user_add2"		=> $user_add2,
							"user_city"		=> $user_city,
							"user_state"	=> $user_state,
							"user_country"	=> $user_country,
							"user_postalcode"=> $user_postalcode,
							"buser_name" 	=> $_POST['buser_fname'].'  '.$_POST['buser_lname'],
							"buser_add1"	=> $buser_add1,
							"buser_add2"	=> $buser_add2,
							"buser_city"	=> $buser_city,
							"buser_state"	=> $buser_state,
							"buser_country"	=> $buser_country,
							"buser_postalcode"=> $buser_postalcode,
							);
		update_usermeta($user_id, 'user_address_info', serialize($user_address_info)); // User Address Information Here
		$userName = $_POST['user_fname'].'  '.$_POST['user_lname'];
		$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
		$wpdb->query($updateUsersql);
		$message = "Information Updated successfully.";
	}
}
$userInfo = $General->getLoginUserInfo();
$user_address_info = unserialize(get_user_option('user_address_info', $user_id));
$user_add1 = $user_address_info['user_add1'];
$user_add2 = $user_address_info['user_add2'];
$user_city = $user_address_info['user_city'];
$user_state = $user_address_info['user_state'];
$user_country = $user_address_info['user_country'];
$user_postalcode = $user_address_info['user_postalcode'];
$display_name = $userInfo['display_name'];
$display_name_arr = explode(' ',$display_name);
$user_fname = $display_name_arr[0];
$user_lname = $display_name_arr[2];
$buser_add1 = $user_address_info['buser_add1'];
$buser_add2 = $user_address_info['buser_add2'];
$buser_city = $user_address_info['buser_city'];
$buser_state = $user_address_info['buser_state'];
$buser_country = $user_address_info['buser_country'];
$buser_postalcode = $user_address_info['buser_postalcode'];
$bdisplay_name = $user_address_info['buser_name'];
$display_name_arr = explode(' ',$bdisplay_name);
$buser_fname = $display_name_arr[0];
$buser_lname = $display_name_arr[2];

if($_SESSION['redirect_page'] == '')
{
	$_SESSION['redirect_page'] = $_SERVER['HTTP_REFERER'];
}
if(strstr($_SESSION['redirect_page'],'page=checkout'))
{
	$login_redirect_link = get_option( 'siteurl' ).'/?page=checkout';
}
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
<h3><?php _e('Change Password'); ?></h3>
<form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ).'/?page=account&type=editprofile&chagepw=1'; ?>" method="post">
<?php if($message1) { ?>
  <div class="sucess_msg"> <?php _e('Password Changed successfully.'); ?> </div>
  </td>
  <?php } ?>
<div class="myorders ">
     <div class="myorders_col myorders_col_2 fl">
        <div class="myorder_form_row ">
        <label>
        <?php _e('New Password'); ?> <span class="indicates">*</span>
        <input type="password" name="new_passwd" id="new_passwd"  class="myorder_text" />
        </label>        
        </div>
        <div class="myorder_form_row ">
        <label>
        <?php _e('Confirm New Password'); ?> <span class="indicates">*</span>
        <input type="password" name="cnew_passwd" id="cnew_passwd"  class="myorder_text" />
          <input type="submit" name="Update" value="<?php _e('Update') ?>" class="highlight_input_btn fl" onclick="return chk_form_pw();" />
        
        </label>
        
         </div>
       
    </div>
</div>
</form>
<script language="javascript" type="application/javascript">
function chk_form_pw()
{
	if(document.getElementById('new_passwd').value == '')
	{
		alert("<?php _e('Please enter New Password') ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value.length < 4 )
	{
		alert("<?php _e('Please enter New Password minimum 5 chars') ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value == '')
	{
		alert("<?php _e('Please enter Confirm New Password') ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value.length < 4 )
	{
		alert("<?php _e('Please enter Confirm New Password minimum 5 chars') ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value != document.getElementById('cnew_passwd').value)
	{
		alert("<?php _e('New Password and Confirm New Password should be same') ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
}
</script>

<h3 class="clearfix"><?php _e(PERSONAL_INFO_TEXT);?>
<?php
if($login_redirect_link){?>
<input type="button" name="<?php _e('Checkout');?>" value="<?php _e('Checkout');?>" onclick="window.location.href='<?php echo $login_redirect_link;?>'"  class="highlight_input_btn fr" />
<?php }?>
</h3>
<form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ).'/?page=account&type=editprofile'; ?>" method="post">
  <?php if($message) { ?>
  <div class="sucess_msg"> <?php _e(MYACC_INFO_UPDATE_MSG);?> </div>
  </td>
  <?php } ?>
  <div class="myorders ">
    <div class="myorders_col fl">
      <h5><?php _e(USER_INFO_TEXT);?> </h5>
      <div class="myorder_form_row ">
        <label>
        <?php _e('First Name') ?> <span class="indicates">*</span>
        </label>
        <input type="text" name="user_fname" id="user_fname" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Last Name') ?>
        </label>
        <input type="text" name="user_lname" id="user_lname" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_lname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Address1') ?> <?php echo $bill_address1;?>
        </label>
        <input type="text" name="user_add1" id="user_add1" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_add1)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Address2') ?> <?php echo $bill_address2;?>
        </label>
        <input type="text" name="user_add2" id="user_add2" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_add2)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('City') ?> <?php echo $bill_city;?>
        </label>
        <input type="text" name="user_city" id="user_city" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_city)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('State') ?> <?php echo $bill_state;?>
        </label>
        <input type="text" name="user_state" id="user_state" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_state)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Country') ?> <?php echo $bill_country;?>
        </label>
        <input type="text" name="user_country" id="user_country" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_country)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Postal Code') ?> <?php echo $bill_zip;?>
        </label>
        <input type="text" name="user_postalcode" id="user_postalcode" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_postalcode)); ?>" size="25" tabindex="20" />
      </div>
    </div>
    <!-- my order col_1 End -->
    <?php
    if(!$General->is_storetype_digital())
	{
	?>
    <div class="myorders_col fr">
      <h5><?php _e(SHIPPING_INFO_TEXT);?></h5>
      <p><input type="checkbox" class="checkin" name="copybilladd" id="copybilladd" onClick="copy_billing_address();" > <?php _e('same as');?> <?php _e(USER_INFO_TEXT);?></p>
      <div class="myorder_form_row ">
        <label>
        <?php _e('First Name') ?>
        </label>
        <input type="text" name="buser_fname" id="buser_fname" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_fname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Last Name') ?>
        </label>
        <input type="text" name="buser_lname" id="buser_lname" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_lname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Address1') ?>
        </label>
        <input type="text" name="buser_add1" id="buser_add1" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_add1)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Address2') ?>
        </label>
        <input type="text" name="buser_add2" id="buser_add2" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_add2)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('City') ?>
        </label>
        <input type="text" name="buser_city" id="buser_city" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_city)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('State') ?>
        </label>
        <input type="text" name="buser_state" id="buser_state" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_state)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Country') ?>
        </label>
        <input type="text" name="buser_country" id="buser_country" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_country)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e('Postal Code') ?>
        </label>
        <input type="text" name="buser_postalcode" id="buser_postalcode" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_postalcode)); ?>" size="25" tabindex="20" />
      </div>
    </div>
    <?php }?>
    <!-- my order col_1 End -->
  </div>
  <?php
  if($login_redirect_link)
  {
  ?>
  <input type="button" name="<?php _e('Checkout');?>" value="<?php _e('Checkout');?>" onclick="window.location.href='<?php echo $login_redirect_link;?>'"  class="highlight_input_btn fl" />
  <?php }?>
  <input type="submit" name="Update" value="<?php _e("Update");?>" class="highlight_input_btn fr" onclick="return chk_form_profile();" />
</form>
<script  type="text/javascript" >
function chk_form_profile()
{
	if(document.getElementById('user_fname').value == '')
	{
		alert("Please enter <?php _e('First Name') ?>");
		document.getElementById('user_fname').focus();
		return false;
	}
	<?php
	if($mandotary_info['bill_address1'])
	{
	?>
		if(document.getElementById('user_add1').value=='')
		{
			alert('Please enter <?php _e('Address1') ?>');
			document.getElementById('user_add1').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_address2'])
	{
	?>
		if(document.getElementById('user_add2').value=='')
		{
			alert('Please enter <?php _e('Address2') ?>');
			document.getElementById('user_add2').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_city'])
	{
	?>
		if(document.getElementById('user_city').value=='')
		{
			alert('Please enter <?php _e('City') ?>');
			document.getElementById('user_city').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_state'])
	{
	?>
		if(document.getElementById('user_state').value=='')
		{
			alert('Please enter <?php _e('State') ?>');
			document.getElementById('user_state').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_country'])
	{
	?>
		if(document.getElementById('user_country').value=='')
		{
			alert('Please enter <?php _e('Country') ?>');
			document.getElementById('user_country').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_zip'])
	{
	?>
		if(document.getElementById('user_postalcode').value=='')
		{
			alert('Please enter <?php _e('Postal Code') ?>');
			document.getElementById('user_postalcode').focus();
			return false;
		}
	<?php
	}
	?>
	document.registerform.submit();
}
function copy_billing_address()
{
	if(document.getElementById('copybilladd').checked)
	{
		
		document.getElementById('buser_fname').value = document.getElementById('user_fname').value;
		document.getElementById('buser_lname').value = document.getElementById('user_lname').value;
		document.getElementById('buser_add1').value = document.getElementById('user_add1').value;
		document.getElementById('buser_add2').value = document.getElementById('user_add2').value;
		document.getElementById('buser_city').value = document.getElementById('user_city').value;
		document.getElementById('buser_state').value = document.getElementById('user_state').value;
		document.getElementById('buser_country').value = document.getElementById('user_country').value;
		document.getElementById('buser_postalcode').value = document.getElementById('user_postalcode').value;
	}else
	{
		document.getElementById('buser_fname').value = '';
		document.getElementById('buser_lname').value = '';
		document.getElementById('buser_add1').value = '';
		document.getElementById('buser_add2').value = '';
		document.getElementById('buser_city').value = '';
		document.getElementById('buser_state').value = '';
		document.getElementById('buser_country').value = '';
		document.getElementById('buser_postalcode').value = '';
	}
}
</script>
