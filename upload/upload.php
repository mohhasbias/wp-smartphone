<?php /*926013d9d070fdd2cf71619f1a81ea4f*/ ?>
<?php
global $General;
$load = '../../../../wp-config.php';
if (file_exists($load)){  //if it's >WP-2.6
  require_once($load);
  }
  else {
 wp_die('Error: Config file not found');
 }
 
         
 $today = getdate();
if ($today['month'] == "January"){
  $today['month'] = "01";
}
elseif ($today['month'] == "February"){
  $today['month'] = "02";
}
elseif  ($today['month'] == "March"){
  $today['month'] = "03";
}
elseif  ($today['month'] == "April"){
  $today['month'] = "04";
}
elseif  ($today['month'] == "May"){
  $today['month'] = "05";
}
elseif  ($today['month'] == "June"){
  $today['month'] = "06";
}
elseif  ($today['month'] == "July"){
  $today['month'] = "07";
}
elseif  ($today['month'] == "August"){
  $today['month'] = "08";
}
elseif  ($today['month'] == "September"){
  $today['month'] = "09";
}
elseif  ($today['month'] == "October"){
  $today['month'] = "10";
}
elseif  ($today['month'] == "November"){
  $today['month'] = "11";
}
elseif  ($today['month'] == "December"){
  $today['month'] = "12";
}

   // Edit upload location here
  	$imagepath = $General->get_product_imagepath();
	if($imagepath == '')
	{
		$imagepath = 'products_img';
	}
	
	//$destination_path = ABSPATH . "wp-content/uploads/".$today['year']."/".$today['month']."/";
   $destination_path = ABSPATH . "wp-content/uploads/".$imagepath."/";
   if (!file_exists($destination_path)){
      $imagepatharr = explode('/',$imagepath);
	   $upload_path = ABSPATH . "wp-content/uploads/";
	  if (!file_exists($upload_path)){
		mkdir($upload_path, 0777);
	  }
	  for($i=0;$i<count($imagepatharr);$i++)
	  {
		  if($imagepatharr[$i])
		  {
			  $year_path = ABSPATH . "wp-content/uploads/".$imagepatharr[$i]."/";
			  if (!file_exists($year_path)){
				  mkdir($year_path, 0777);
			  }     
			  mkdir($destination_path, 0777);
	 		}
	  }
	  
   }
   $result = 0;
   
   $digital_product_path = $General->get_digital_productpath();
	if($digital_product_path == '')
	{
		$digital_product_path = 'digital_products';
	}
	$digital_destination_path = ABSPATH . "wp-content/uploads/".$digital_product_path."/";
	
	$imagepatharr = array();
	if (!file_exists($digital_destination_path)){
      $imagepatharr = explode('/',$digital_product_path);
	   $upload_path = ABSPATH . "wp-content/uploads/";
	  if (!file_exists($upload_path)){
		mkdir($upload_path, 0777);
	  }
	  for($i=0;$i<count($imagepatharr);$i++)
	  {
		  if($imagepatharr[$i])
		  {
			  $year_path = ABSPATH . "wp-content/uploads/".$imagepatharr[$i]."/";
			  if (!file_exists($year_path)){
				  mkdir($year_path, 0777);
			  }     
			  mkdir($digital_product_path, 0777);
	 		}
	  }
   }
   $result = 0;
	
   
   $name = $_FILES['myfile']['name'];
   $name = strtolower($name);

   if(strstr($_GET['img'],'digital_product')) // digital products
   {
   		$target_path = $digital_destination_path . $name;
		$user_path = get_option( 'siteurl' ) ."/wp-content/uploads/".$digital_product_path."/".$name;
   }else
   {
   		$target_path = $destination_path . $name;
		$user_path = get_option( 'siteurl' ) ."/wp-content/uploads/".$imagepath."/".$name;
   }

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      $result = 1;
   }
   sleep(1);
   
   /* creates a compressed zip file */
   $imgNumb = "image".$_GET['img'];
?>
<script language="javascript" type="text/javascript">window.parent.window.noUpload(<?php echo $result.", '".$user_path."', '".$_GET['img']."'"; ?>);</script>
