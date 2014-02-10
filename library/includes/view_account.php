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
<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
	 <h1 class="head"><?php _e(VIEW_ACCOUNT_PAGE_TITLE);?></h1>
     <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.VIEW_ACCOUNT_PAGE_TITLE); } ?>
 </div> <!-- breadcrumbs #end -->



     <div id="content">      
           
            <div class="fr"><a href="<?php echo get_option('siteurl'); ?>/?page=login&amp;action=logout" class="fr"><b><u><?php _e("Logout");?></u></b></a></div>
		
        <?php  //AFFILIATE START
		if($General->is_active_affiliate())
		{
			global $current_user;
			get_currentuserinfo();
			$user_id = $current_user->data->ID;
			$user_role = get_usermeta($user_id,'wp_capabilities');
			if(!$user_role['affiliate'])
			{
			?>
				<h6><b><?php _e(WANT_TO_BECOME_AFF_TEXT);?> <a href="<?php echo get_option('siteurl');?>/?page=setasaff"><u>Click here &raquo;</u></a></b> </h6>
				<?php
			} 
			
		} //AFFILIATE END
		?>
        
 		<?php
         if($_REQUEST['type']=="editprofile")
		 {
		 	include_once(TEMPLATEPATH . '/library/includes/edit_profile.php');
		}else
		{
			if(!$General->is_storetype_catalog())
			 {
				 include_once(TEMPLATEPATH . '/library/includes/view_orders.php');
				 echo "<br />";
				 if($General->is_storetype_digital())
				 {
				 	 include_once(TEMPLATEPATH . '/library/includes/view_downloads.php');
				}
			 }
			$userInfo = $General->getLoginUserInfo();
			$user_address_info = unserialize(get_user_option('user_address_info', $userInfo['ID']));
			?>
       
        <table width="100%" class="table">
          <tr>
            <td colspan="2" class="title1"><h3><?php _e(MY_PERSONAL_INFO_TEXT);?></h3> </td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(NAME_TEXT);?> : </td>
            <td class="row1" ><?php echo $userInfo['display_name'];?></td>
          </tr>
          <tr>
            <td class="row1"  ><?php _e(EMAIL_ADDRESS_TEXT);?> : </td>
            <td class="row1" ><?php echo $userInfo['user_email'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(ADDRESS1_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_add1'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(ADDRESS2_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_add2'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(CITY_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_city'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(STATE_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_state'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(COUNTRY_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_country'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(POSTAL_CODE_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_postalcode'];?></td>
          </tr>
          <tr>
            <td  ></td>
            <td><a href="<?php echo get_option('siteurl'); ?>/?page=account&type=editprofile" class="highlight_button fr" ><?php _e(EDIT_PROFILE_TEXT);?></a></td>
          </tr>
        </table>
        <?php
			////////AFFILIATE CODING//////////
			if($General->is_active_affiliate())
			{
				@include_once(TEMPLATEPATH . '/library/includes/affiliates/affiliate_account.php');		
			}		
		}
		 ?>

 </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
 <?php get_footer(); ?>