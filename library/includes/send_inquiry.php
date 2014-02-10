<?php
global $General;
if($_POST)
{
	$yourname = $_POST['yourname'];
	$youremail = $_POST['youremail'];
	$frnd_subject = $_POST['frnd_subject'];
	$frnd_comments = $_POST['frnd_comments'];
	$productid = $_POST['productid'];
	$to_email = $General->get_site_emailId();
	$to_name = $General->get_site_emailName();
	
	if($_REQUEST['productid'])
	{
		$productinfosql = "select ID,post_title from $wpdb->posts where ID =".$_REQUEST['productid'];
		$productinfo = $wpdb->get_results($productinfosql);
		foreach($productinfo as $productinfoObj)
		{
			$post_title = $productinfoObj->post_title; 
		}
	}
	$message1 = '
	<html>
	<head>
	  <title>'.$frnd_subject.'</title>
	</head>
	<body>
	 <table width="80%" align=center>';
	$message1 .=	'<tr>
		  <td>Dear Administrator,<Br><br></td>
		</tr>';
	$message1 .= '<tr><td>'.INQUIRY_EMAIL_MSG1.' <b>'.$post_title.'</b> :<br><br>'.$frnd_comments.'</td></tr>';
	$message1 .='
	<tr>
		  <td><Br><br>Thank you,<Br>'.$yourname.'</td>
		</tr>
	  </table>
	</body>
	</html>
	';
	$General->sendEmail($youremail,$yourname,$to_email,$to_name,$frnd_subject,$message1,$extra='');///To friend email
	wp_redirect(get_option('siteurl')."/?p=".$productid."&msg=inqsuccess");
}
else
{
?>
<?php
if($_REQUEST['pid'])
{
	$productinfosql = "select ID,post_title from $wpdb->posts where ID =".$_REQUEST['pid'];
	$productinfo = $wpdb->get_results($productinfosql);
	foreach($productinfo as $productinfoObj)
	{
		$post_title = $productinfoObj->post_title; 
	}
}
?>
<?php get_header(); ?>

<div id="page" class="clearfix">
<div class="breadcrumb clearfix">
		<h1 class="head">Send Inquiry</h1>
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.SEND_INQUIRY); } ?>
     </div> <!-- breadcrumbs #end -->
 


         <div id="content">      
     
				
  
<form name="enquiryfrm" action="<?php echo get_option('siteurl')."/?page=sendenquiry";?>" method="post" >
<input type="hidden" name="productid" value="<?php echo $_REQUEST['pid'];?>" />

<div class="form  ">
    <div class="inquiry_row ">
      <label> <?php _e('Your Name');?> <span class="indicates">*</span></label>
      <input type="text" name="yourname" value="" id="yourname" class="reg_row_textfield" />
    </div>
                
    <div class="inquiry_row ">
      <label> <?php _e('Email Address');?> :  <span class="indicates">*</span></label>
      <input type="text" name="youremail" value="" id="youremail" class="reg_row_textfield" />
    </div>
    
     <div class="inquiry_row ">
      <label> <?php _e('Subject');?> :  <span class="indicates">*</span></label>
       <input type="text" readonly="readonly" name="frnd_subject" value="<?php echo $post_title.' '. INQUIRY_TITLE;?>" id="frnd_subject" class="reg_row_textfield" />
    </div>
    
    <div class="inquiry_row ">
      <label> <?php _e('Comments');?> :  <span class="indicates">*</span></label>
       <textarea name="frnd_comments" id="frnd_comments" cols="20" rows="5" class="reg_row_textarea" >Hello, 
     </textarea>
    </div>
    
     <div class="inquiry_row ">
      
      		<a href="javascript:void(0)" class="highlight_button fl send_inquiry" onclick="check_enquery_frm()"> <?php _e('Send Email');?> </a>
       
       <div class="row_hide"> <input type="text" readonly="readonly" name="frnd_subject" value="<?php echo $post_title. ' '. INQUIRY_TITLE;?>" id="frnd_subject"  /></div>
       
       <a href="<?php echo get_option('siteurl')."/?p=".$_REQUEST['pid'];?>" class="normal_button fl"> <?php _e('Back to Product Detail');?></a>
       
    </div>
            
            
</div>

</form> 		
        
 	                    
  			  </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
<!-- wrapper #end -->

 <?php get_footer(); ?>
 <script>
 function check_enquery_frm()
 {
 	if(document.getElementById('yourname').value == '')
	{
		alert("<?php _e('Please enter Your Name');?>");
		document.getElementById('yourname').focus();
		return false;
	}
	if(document.getElementById('youremail').value == '')
	{
		alert("<?php _e('Please enter Your Email Address');?>");
		document.getElementById('youremail').focus();
		return false;
	}
	if(document.getElementById('frnd_subject').value == '')
	{
		alert("<?php _e('Please enter Subject');?>");
		document.getElementById('frnd_subject').focus();
		return false;
	}
	document.enquiryfrm.submit();
	return true;
 }
 </script>
<?php
}
?>