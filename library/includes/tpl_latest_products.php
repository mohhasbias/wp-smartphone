<?php 
global $Product,$Cart;
?>
<?php
if ($_GET['page']=='store')
{
	include (TEMPLATEPATH . "/store.php");
}else
{
	include (TEMPLATEPATH . "/library/includes/latest_products.php");
}
?>