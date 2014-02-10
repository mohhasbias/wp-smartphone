<script language="javascript">
 function setAttributeVal()
 {
 	var postformflag = 1;
	if(eval(document.getElementById('size')))
	{
		var size = document.getElementById('size').value;
		if(size == '')
		{
			alert('<?php _e("Please select size");?>');
			postformflag = 0;
		}
	}else
	{
		var size = '';
	}
	if(postformflag)
	{
		if(eval(document.getElementById('color')))
		{
			var color = document.getElementById('color').value;
			if(color == '')
			{
				alert('<?php _e("Please select color");?>');
				postformflag = 0;
			}
		}else
		{
			var color = 0;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('cart_information_span')))
		{
			document.getElementById('cart_information_span').innerHTML = 'processing ...';
		}
		if(eval(document.getElementById('addtocartformspan')))
		{
			document.getElementById('addtocartformspan').innerHTML = 'processing ...';
		}
		if(eval(document.getElementById('cart_information_header_span')))
		{
			document.getElementById('cart_information_header_span').innerHTML = 'processing ...';
		}
		var attstr = '';
		if(size != '' && color != '')
		{
			attstr = size+','+color;
		}else
		if(size != '' && color == '')
		{
			attstr = size;
		}else
		if(size == '' && color != '')
		{
			attstr = color;
		}
		document.getElementById('product_att').value = attstr;
		postform();
	}
 }

function postform()
{
	dataString = $("#shopingcartfrm").serialize();
	$.ajax({
		url: '<?php echo get_option('siteurl'); ?>/?page=cart&'+dataString,
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			chekc_stock();
			if(eval(document.getElementById('cart_content_sidebar')))
			{
				refresh_cartinfo_sidebar();
			}
			if(eval(document.getElementById('cart_information_span')))
			{
				document.getElementById('cart_information_span').innerHTML=html;
			}
			if(eval(document.getElementById('cart_information_header_span')))
			{
				document.getElementById('cart_information_header_span').innerHTML=html;
			}	
			if(eval(document.getElementById('addtocartformspan')))
			{
				// document.getElementById('addtocartformspan').innerHTML = '<strong>Added To Cart Successfully<Br><a href="<?php echo get_option('siteurl'); ?>/?page=cart">View Cart Detail</a> or <a href="<?php echo get_option('siteurl'); ?>/?page=cart">Checkout &raquo;</a></strong>';
				document.getElementById('addtocartformspan').innerHTML = '<strong>Added To Cart Successfully<Br><a class="reveal" href="<?php echo get_option('siteurl'); ?>/?page=cart #page-old">View Cart Detail</a></strong>';
			}
		
			attachRevealButton();
		}
	});
	return false;
}
function refresh_cartinfo_sidebar()
{
	$.ajax({
		url: '<?php echo get_option('siteurl'); ?>/?page=cart&cartact=cart_refresh',
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(eval(document.getElementById('cart_content_sidebar')))
			{
				document.getElementById('cart_content_sidebar').innerHTML=html;
			}
			attachRevealButton();
		}
	});
	return false;
}
function chekc_stock()
{
	$.ajax({
		url: '<?php echo get_option('siteurl'); ?>/?page=cart&cartact=stock_chk&pid=<?php echo $post->ID?>',
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(html=='unlimited')
			{
				
			}else
			if(html>0)
			{
				//alert(html);	
			}else
			{
				window.location.href='<?php echo $_SERVER['REQUEST_URI'];?>';	
			}
		}
	});
}
function checkstock(attval)
{
	if(eval('document.getElementById("shoppingcart_button_1")'))
	{
		document.getElementById("shoppingcart_button_1").style.display="";
	}
	if(eval('document.getElementById("shoppingcart_outofstock_msg1")'))
	{
		document.getElementById("shoppingcart_outofstock_msg1").innerHTML="";
	}
	if(eval('document.getElementById("shoppingcart_button_2")'))
	{
		document.getElementById("shoppingcart_button_2").style.display="";
	}
	if(eval('document.getElementById("shoppingcart_outofstock_msg2")'))
	{
		document.getElementById("shoppingcart_outofstock_msg2").innerHTML="";

	}
	<?php
	$product_color_js = $Product->get_product_custom_dl($post->ID,'size','',1);
	echo $product_color_js .= $Product->get_product_custom_dl($post->ID,'color','',1);
	?>
}
</script>

<form id="shopingcartfrm" name="shopingcartfrm">
  <input type="hidden" name="cartact" value="addtocart" />
  <input type="hidden" name="product_id" id="product_id" value="<?php the_ID(); ?>" />
  <div>
    <input name="product_qty" id="product_qty" type="hidden" value="1" class="textbox" />
  </div>
  <input type="hidden" name="product_att" id="product_att" value="" />
  <input type="hidden" name="product_price" id="product_price" value="<?php echo $product_cart_price;?>" />
  <input type="hidden" name="product_istaxable" id="product_istaxable" value="<?php echo $data['istaxable'];?>" />
  <input type="hidden" name="product_weight" id="product_weight" value="<?php echo $data[ 'weight']; ?>" />
<?php
global $General;
$chk_stock = $General->check_stock($post->ID);
if($data['isshowstock'])
{
	$General->display_stock_text($chk_stock);
}
if($chk_stock=='out_of_stock')
{
	if(!$data['isshowstock'])
	{
		$General->get_out_of_stock_text();
	}
}
else
{
?>
  <div class="b_addtocart-old" id="shoppingcart_button_1"><a href="javascript:void(0);" onclick="setAttributeVal();" class="button radius expand"> <?php _e("Add to Shopping Cart");?> &raquo;  </a></div>
  <span id="shoppingcart_outofstock_msg1"></span>
<?php }?>
</form>
<span id="addtocartformspan">
<?php if($Cart->is_product_in_cart($post->ID)){ _e('<b>Already Added in the cart<br/><a class="reveal" href="'.get_option('siteurl').'/?page=cart #page-old">View Cart Detail</a></b>');} ?>
</span>
