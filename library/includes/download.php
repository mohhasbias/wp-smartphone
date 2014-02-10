<?php
global $General,$wpdb;
$userInfo = $General->getLoginUserInfo();
$orderId = $_REQUEST['id'];
$product_id = $_REQUEST['pid'];
$order_number = preg_replace('/([0-9]*([_]))/','',$orderId);
$userId = preg_replace('/([_])([0-9]*)/','',$orderId);
if($userInfo['ID'] == $userId)
{	
	$data = get_post_meta($product_id, 'key', true );
	$product_image = $data['productimage'];
	$digital_product = $data['digital_product'];
	if($digital_product == '' || !file_exists(WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$digital_product)))
	{
		?>
<?php get_header(); ?>
<div class="breadcrumb clearfix">
	 <h1 class="head"><?php _e("Download Page");?></h1>
    <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; Download Page'); } ?>
 </div> <!-- breadcrumbs #end -->


<div id="page" class="clearfix">

            
            
     <div id="content">      
 
           
  
      <table>
        <tr>
          <td><h2 style="color:#FF0000;"><?php _e("Sorry, The file you are trying to Download is not available right now.");?></h2></td>
        </tr>
      </table>
 	                    
      </div> <!-- content #end -->
 <?php get_sidebar(); ?>
</div> <!-- page #end -->
<?php get_footer(); ?>
<?php
	}else
	{
		$filesize =  filesize(WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$digital_product));
		$dlfilename_arr = explode('/',$digital_product);
		$dlfilename = $dlfilename_arr[count($dlfilename_arr)-1];
		$_GET['f'] = $dlfilename;
		$digital_phy_path = WP_CONTENT_DIR.str_replace(get_option( 'siteurl' ).'/wp-content','',$digital_product);
		$dlfilename_arr = explode('/',$digital_phy_path);
		unset($dlfilename_arr[count($dlfilename_arr)-1]);
		$digital_base_path =  implode('/',$dlfilename_arr);
		include(TEMPLATEPATH . '/library/includes/download_class.php');
	}
}else
{
	?>
  <?php get_header(); ?>
<div id="page" class="clearfix">

<div class="breadcrumb clearfix">
    <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; Download Page'); } ?>
 </div> <!-- breadcrumbs #end -->
            
            
     <div id="content">      
 
            <h1 class="head"><?php _e("Download Page");?></h1>
      <table>
        <tr>
          <td><h2 style="color:#FF0000;"><?php _e("The link you are trying to download is not a Valid link. Please Check once.");?></h2></td>
        </tr>
      </table>
 	                    
      </div> <!-- content #end -->
 <?php get_sidebar(); ?>
</div> <!-- page #end -->
<?php get_footer(); ?>
<?php
}
?>
