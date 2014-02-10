<?php
global $Cart,$General,$wpdb;
$userInfo = $General->getLoginUserInfo();
$_SESSION['checkout_as_guest'] = '';
if($userInfo && $_GET['action'] != 'logout')
{
	wp_redirect(get_option( 'siteurl' ).'/?page=account');
	exit;
}
require( 'wp-load.php' );
require(ABSPATH.'wp-includes/registration.php');

// Redirect to https login if forced to use SSL
if ( force_ssl_admin() && !is_ssl() ) {
	if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
		wp_redirect(preg_replace('|^http://|', 'https://', $_SERVER['REQUEST_URI']));
		exit();
	} else {
		wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
}

	$message = apply_filters('login_message', $message);
	if ( !empty( $message ) ) echo $message . "\n";



/**
 * Handles registering a new user.
 *
 * @param string $user_login User's username for logging in
 * @param string $user_email User's email address to send password and add
 * @return int|WP_Error Either user's ID or error on failure.
 */
function register_new_user($user_login, $user_email) {
	global $wpdb,$General;
	$errors = new WP_Error();

	$user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $user_login == '' )
		$errors->add('empty_username', __(AFF_EMPTY_USERNAME_MSG));
	elseif ( !validate_username( $user_login ) ) {
		$errors->add('invalid_username', __(AFF_USERNAME_INVALID_MSG));
		$user_login = '';
	} elseif ( username_exists( $user_login ) )
		$errors->add('username_exists', __(AFF_USERNAME_EXISTS_MSG));

	// Check the e-mail address
	if ($user_email == '') {
		$errors->add('empty_email', __(AFF_EMPTY_EMAIL_MSG));
	} elseif ( !is_email( $user_email ) ) {
		$errors->add('invalid_email', __(AFF_EMAIL_NOT_CORRECT_MSG));
		$user_email = '';
	} elseif ( email_exists( $user_email ) )
		$errors->add('email_exists', __(AFF_EMAIL_ALREADY_EXIST_MSG));

	do_action('register_post', $user_login, $user_email, $errors);

	$errors = apply_filters( 'registration_errors', $errors );
	foreach($errors as $errorsObj)
	{
		foreach($errorsObj as $key=>$val)
		{
			for($i=0;$i<count($val);$i++)
			{
				echo "<div class=error_msg>".$val[$i].'</div>';	
			}
		} 
	}
	

	if ( $errors->get_error_code() )
		return $errors;


	$user_pass = wp_generate_password(12,false);
	$user_id = wp_create_user( $user_login, $user_pass, $user_email );
	
	$user_add1 = $_POST['user_add1'];
	$user_add2 = $_POST['user_add2'];
	$user_city = $_POST['user_city'];
	$user_state = $_POST['user_state'];
	$user_country = $_POST['user_country'];
	$user_postalcode = $_POST['user_postalcode'];
	$is_affiliate = $_POST['is_affiliate'];
	$user_address_info = array(
						"user_add1"		=> $user_add1,
						"user_add2"		=> $user_add2,
						"user_city"		=> $user_city,
						"user_state"	=> $user_state,
						"user_country"	=> $user_country,
						"user_postalcode"=> $user_postalcode,
						);
	update_usermeta($user_id, 'user_address_info', serialize($user_address_info)); // User Address Information Here
	$userName = $_POST['user_fname'].'  '.$_POST['user_lname'];
	$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
	$wpdb->query($updateUsersql);
	
	if ( !$user_id ) {
		$errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
		return $errors;
	}

	if ( $user_id ) 
	{
		////AFFILIAGE START//
		if($General->is_active_affiliate())
		{
			if($is_affiliate)
			{
				$user_role = get_usermeta($user_id,'wp_capabilities');
				$user_role['affiliate'] = 1;
				update_usermeta($user_id, 'wp_capabilities', $user_role);
			}
		}
		////AFFILIATE END///
		
		//wp_new_user_notification($user_id, $user_pass);
		///////REGISTRATION EMAIL START//////
		global $General;
		$fromEmail = $General->get_site_emailId();
		$fromEmailName = $General->get_site_emailName();
		$store_name = get_option('blogname');
		$order_info = $General->get_order_detailinfo_tableformat($orderInfoArray,1);
		$clientdestinationfile =   ABSPATH . "wp-content/uploads/notification/emails/registration.txt";
		if(!file_exists($clientdestinationfile))
		{
		$client_message = '<p>Dear [#$user_name#],</p>
	<p>You can log in  with the following information:</p>
	<p>Username: [#$user_login#]</p>
	<p>Password: [#$user_password#]</p>
	<br>
	<p>Thanks!</p>
	<p>[#$store_name#]</p>';
		}else
		{
			$client_message = file_get_contents($clientdestinationfile);
		}
		$filecontent_arr1 = explode('[SUBJECT-STR]',$client_message);
		$filecontent_arr2 = explode('[SUBJECT-END]',$filecontent_arr1[1]);
		$subject = $filecontent_arr2[0];
		if($subject == '')
		{
			$subject = "Registration Email";
		}
		$client_message = $filecontent_arr2[1];
		/////////////customer email//////////////
		$search_array = array('[#$user_name#]','[#$user_login#]','[#$user_password#]','[#$store_name#]');
		$replace_array = array($_POST['user_fname'],$user_login,$user_pass,$store_name);
		$client_message = str_replace($search_array,$replace_array,$client_message);	
		$General->sendEmail($fromEmail,$fromEmailName,$user_email,$userName,$subject,$client_message,$extra='');///To clidne email
		//////REGISTRATION EMAIL END////////
	}
	return array($user_id,$user_pass);
}			
?>
<?php 
$affiliate_settings = get_option('affiliate_settings');
$affiliate_login_content_top = $affiliate_settings['affiliate_login_content_top'];
$affiliate_login_content_bottom = $affiliate_settings['affiliate_login_content_bottom'];
$affiliate_terms_conditions = $affiliate_settings['affiliate_terms_conditions'];
?>
<?php get_header(); ?>
<div id="page" class="clearfix">
	<div class="breadcrumb clearfix">
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.AFFILIATE_REG_BREADCUM); } ?>
     </div> <!-- breadcrumbs #end -->
         <div id="content" >
         <h1 class="head"><?php _e(AFFILIATE_LOGIN_PAGE_TITLE); ?></h1>
         
         	 
                <?php
                if($affiliate_login_content_top)
				{
					echo '<p>'.$affiliate_login_content_top.'</p>';
				}
				?>
                
        <?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';
$errors = new WP_Error();

if ( isset($_GET['key']) )
	$action = 'resetpass';

// validate action so as to default to the login screen
if ( !in_array($action, array('logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'register', 'login')) && false === has_filter('login_form_' . $action) )
	$action = 'login';


nocache_headers();

header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));

if ( defined('RELOCATE') ) { // Move flag is set
	if ( isset( $_SERVER['PATH_INFO'] ) && ($_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF']) )
		$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );

	$schema = ( isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ) ? 'https://' : 'http://';
	if ( dirname($schema . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) != get_option('siteurl') )
		update_option('siteurl', dirname($schema . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) );
}

//Set a cookie now to see if they are supported by the browser.
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH )
	setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

// allow plugins to override the default actions, and to add extra actions if they want
do_action('login_form_' . $action);

$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
switch ($action) {
case 'register' :
	if ( !get_option('users_can_register') ) {
		wp_redirect(get_option( 'siteurl' ).'/?page=affiliate&registration=disabled');
		exit();
	}

	$user_login = '';
	$user_email = '';
	if ( $http_post ) {
		//require_once( ABSPATH . WPINC . '/registration.php');

		$user_login = $_POST['user_login'];
		$user_email = $_POST['user_email'];
		$user_fname = $_POST['user_fname'];
		$user_lname = $_POST['user_lname'];		  
		$user_add1 = $_POST['user_add1'];
		$user_add2 = $_POST['user_add2'];
		$user_city = $_POST['user_city'];
		$user_state = $_POST['user_state'];
		$user_country = $_POST['user_country'];
		$user_postalcode = $_POST['user_postalcode'];
		
		$errors = register_new_user($user_login, $user_email);
		
		if ( !is_wp_error($errors) ) 
		{
			$_POST['log'] = $user_login;
			$_POST['pwd'] = $errors[1];
			$_POST['testcookie'] = 1;
			
			$secure_cookie = '';
			// If the user wants ssl but the session is not ssl, force a secure cookie.
			if ( !empty($_POST['log']) && !force_ssl_admin() ) {
				$user_name = sanitize_user($_POST['log']);
				if ( $user = get_userdatabylogin($user_name) ) {
					if ( get_user_option('use_ssl', $user->ID) ) {
						$secure_cookie = true;
						force_ssl_admin(true);
					}
				}
			}
		
			$redirect_to = $_REQUEST['reg_redirect_link'];
			if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
				$secure_cookie = false;
		
			$user = wp_signon('', $secure_cookie);
		
			$redirect_to = apply_filters('login_redirect', $redirect_to, isset( $_REQUEST['reg_redirect_link'] ) ? $_REQUEST['reg_redirect_link'] : '', $user);
		
			if ( !is_wp_error($user) ) 
			{
				wp_safe_redirect($redirect_to);
				exit();
			}
			exit();
		}
	}
	//login_header(__('Registration Form'), '<p class="message register">' . __('Register For This Site') . '</p>', $errors);
break;

case 'login' :
default:
	$secure_cookie = '';

	// If the user wants ssl but the session is not ssl, force a secure cookie.
	if ( !empty($_POST['log']) && !force_ssl_admin() ) {
		$user_name = sanitize_user($_POST['log']);
		if ( $user = get_userdatabylogin($user_name) ) {
			if ( get_user_option('use_ssl', $user->ID) ) {
				$secure_cookie = true;
				force_ssl_admin(true);
			}
		}
	}

	if ( isset( $_REQUEST['redirect_to'] ) ) {
		$redirect_to = $_REQUEST['redirect_to'];
		// Redirect to https if user wants ssl
		if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
			$redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
	} else {
		$redirect_to = admin_url();
	}

	if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
		$secure_cookie = false;

	$user = wp_signon('', $secure_cookie);

	$redirect_to = apply_filters('login_redirect', $redirect_to, isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '', $user);

	if ( !is_wp_error($user) ) {
		// If the user can't edit posts, send them to their profile.
		if ( !$user->has_cap('edit_posts') && ( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() ) )
			$redirect_to = admin_url('profile.php');
		wp_safe_redirect($redirect_to);
		exit();
	}

	$errors = $user;
	// Clear errors if loggedout is set.
	if ( !empty($_GET['loggedout']) )
		$errors = new WP_Error();

	// If cookies are disabled we can't log in even with a valid user+pass
	if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
		$errors->add('test_cookie', __("<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to use WordPress."));

	// Some parts of this script use the main login form to display a message
	if( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] )
	{
		$successmsg = '<div class="sucess_msg">'.AFFILIATE_LOGIN_LOGOUT_MSG.'</div>';
	}
	elseif( isset($_GET['registration']) && 'disabled' == $_GET['registration'] )
	{
		$successmsg = AFFILIATE_LOGIN_REG_NOT_ALLOW_MSG;
	}
	elseif( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] )
	{
		$successmsg = AFFILIATE_LOGIN_CONFIRM_LINK_MSG;
	}
	elseif( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )
	{
		$successmsg = AFFILIATE_LOGIN_NEWPW_EMAIL_MSG;
	}
	elseif( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] )
	{
		$successmsg = AFFILIATE_LOGIN_REG_COMPLETED_MSG;
	}

echo "<p style=\"color:green\">".$successmsg.'</p>';	
//	login_header(__('Log In'), '', $errors);
?>
        <script type="text/javascript" >
<?php if ( $user_login ) { ?>
setTimeout( function(){ try{
d = document.getElementById('user_pass');
d.value = '';
d.focus();
} catch(e){}
}, 200);
<?php } else { ?>
try{document.getElementById('user_login').focus();}catch(e){}
<?php } ?>
</script>
        <?php

break;
} // end action switch
?>
        <?php
if($error_message)
{
	echo "<div class=error_msg>".$error_message.'</div>';
}
if($message)
{
	echo "".$message.'';
}
?>
		<p><span class="forgot_password fr"> <?php _e(ALREADY_MEMBER_TEXT);?><a href="<?php echo get_option('siteurl');?>/?page=affiliate"><u><?php _e(ALREADY_MEMBER_LINK);?></u></a></span></p>
        <div class="clearfix"></div>
         <form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ).'/?page=affiliate&amp;action=register&amp;type=reg';//echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
        <?php
		if(strstr($_SESSION['redirect_page'],'page=checkout'))
		{
			$reg_redirect_link = get_option( 'siteurl' ).'/?page=checkout';
		}else
		{
			$reg_redirect_link = get_option( 'siteurl' ).'/?page=affiliate&action=register';
		}
		?>
        <input type="hidden" name="reg_redirect_link" value="<?php echo $reg_redirect_link;?>" />
        <div class="form form_col_2  ">
          <p class="mandatory"> <span class="indicates">*</span> Indicates mandatory fields</p>
        
            <div class="reg_row fl">
              <label>
              <?php _e('Username') ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_login" id="user_login1reg" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20"/>
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e('E-mail') ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_email" id="user_email" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" />
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e('First Name') ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_fname" id="user_fname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25"  />
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e('Last Name') ?>
              </label>
              <input type="text" name="user_lname" id="user_lname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_lname)); ?>" size="25"  />
            </div>
            
             
              <label>
                <input type="checkbox" name="termandconditons" id="termandconditons">     
			<?php 
			if($affiliate_terms_conditions)
			{
				$term_and_conditions = $affiliate_terms_conditions;
			}else
			{
				 $term_and_conditions = TERMS_CONDITIONS_TITLE;
			}
			 $store_name = get_option('blogname');
			$search_array = array('[#$store_name#]');
			$replace_array = array($store_name);
			$term_and_conditions = str_replace($search_array,$replace_array,$term_and_conditions);	
			  _e($term_and_conditions) ?>   </label>            
             
           
            <div class="fix"></div>
           
            <input type="hidden" name="is_affiliate" value="1" />
            <?php do_action('register_form'); ?>
            <div id="reg_passmail">
              <?php _e(AFFILIATE_LOGIN_REG_PAGE_INSTRUCTION) ?>
            </div>
           <!-- <a  href="javascript:void(0);" onclick="return chk_form_reg();" class="highlight_button fr " >Register Now </a>-->
           <input type="submit" name="registernow" value="<?php _e('Create Account') ?>" onClick="return chk_form_reg();" class="highlight_input_btn" />
           &nbsp;
           
        </div>
           </form>
        <script  type="text/javascript" >
function chk_form_reg()
{
	if(document.getElementById('user_login1reg').value == '')
	{
		alert("<?php _e('Please enter Username') ?>");
		document.getElementById('user_login1reg').focus();
		return false;
	}
	if(document.getElementById('user_email').value == '')
	{
		alert("<?php _e('Please enter E-mail') ?>");
		document.getElementById('user_email').focus();
		return false;
	}
	if(document.getElementById('user_fname').value == '')
	{
		alert("<?php _e('Please enter First Name') ?>");
		document.getElementById('user_fname').focus();
		return false;
	}
	if(document.getElementById('termandconditons').checked)
	{
		
	}else
	{
		alert("<?php _e('Please accept Terms and Conditions') ?>");
		document.getElementById('termandconditons').focus();
		return false;
	}
	document.registerform.submit();
}

try{document.getElementById('user_login').focus();}catch(e){}
</script>
      
     	<?php
        if($affiliate_login_content_bottom)
		{
			echo '<p>'.$affiliate_login_content_bottom.'</p>';
		}
		?>
        	 
  			  </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
 <?php get_footer(); ?>