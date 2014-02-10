<?php
global $General;
if($_POST)
{
	$frnd_yourname = $_POST['frnd_yourname'];
	$frnd_youremail = $_POST['frnd_youremail'];
	$frnd_name = $_POST['frnd_name'];
	$frnd_email = $_POST['frnd_email'];
	$frnd_subject = $_POST['frnd_subject'];
	$frnd_comments = $_POST['frnd_comments'];
	$productid = $_POST['productid'];
	
	$message1 = '
	<html>
	<head>
	  <title>'.$frnd_subject.'</title>
	</head>
	<body>
	 <table width="80%" align=center>';
	$message1 .=	'<tr>
		  <td>Dear '.$frnd_name.',<Br><br></td>
		</tr>';
	$message1 .= '<tr><td>'.$frnd_comments.'</td></tr>';
	echo $message1 .='
	<tr><td>Your can see the following link <a href="'.get_option('siteurl').'/?p='.$productid.'">Click Here</a>.</td></tr>
	<tr>
		  <td><Br><br>Thank you,<Br>'.$frnd_yourname.'</td>
		</tr>
	  </table>
	</body>
	</html>
	';
	$General->sendEmail($frnd_youremail,$frnd_yourname,$frnd_email,$frnd_name,$frnd_subject,$message1,$extra='');///To friend email
	echo '<script>alert(document.getElementById("tellfrnddiv").innerHTML);</script>';
	wp_redirect(get_option('siteurl')."/?page=tellafriend");
}
else
{
?>
<style type="text/css">
	#info { width:600px; }
</style>

<li class="emailtofriend-old"><span style="text-decoration: underline;" class="more-old" title="tellafrnd_div"><?php _e(EMAIL_TO_FRIEND_TEXT);?></span> </li>

<span id="tellafrnd_success_msg_span"></span>
<div style="display: none;" id="tellfrnddiv" class="tellafrnd_div hide">
  <iframe src="<?php echo get_option('siteurl')."/?page=tellafriend_form&pid=".$post->ID;?>" height="550" width="600"  frameborder="0" marginheight="0" marginwidth="0"   ></iframe>
</div>
<?php
}
?>
