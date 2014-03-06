<?php global $is_home; ?>

<?php /*
<script type="text/javascript">var slider_image_path = '<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/slider.js"></script>
<script type="text/javascript">
<?php
if(get_option('ptthemes_homepage_sliderstop_flag'))
{
?>
var slider_speed = 7000;
<?php
}elseif(get_option('ptthemes_sliderspeed_homepage'))
{
?>
var slider_speed = <?php echo get_option('ptthemes_sliderspeed_homepage');?>;
<?php }else
{
?>
var slider_speed = 1800;
<?php
}
?>
</script>
*/?>

<!-- promo slider -->
<?php
global $shortname;
$category = get_option($shortname . '_slide_ctr');
$post_number = get_option($shortname . '_slide_no');

global $post;
$latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');

$promos = array();
foreach($latest_menus as $post){
  setup_postdata($post);

  $imagearray = $General->get_post_image($post->ID);
  $price = $Product->get_product_price_only($post->ID);
  if($price > 0){
  	$price = "Rp " . number_format($Product->get_product_price_only($post->ID), 0);
  } else {
  	$price = "";
  }
  
  
  $sale = $Product->get_product_price_sale($post->ID);
  if ($sale > 0) {
  	$sale = "Rp " . number_format($Product->get_product_price_sale($post->ID), 0);
  } else {
  	$sale = "";
  }
  
  $promos[] = array(
  		"title" => get_the_title(),
		"url" => get_permalink(),
		"img_src" => theme_thumb($imagearray[0], 320, 240),
		"price" => $price,
		"sale" => $sale
  	);
}
?>

  <div class="row">
    <div class="small-12 columns">
      <ul class="promos" data-orbit>
	  	<?php foreach($promos as $promo): ?>
			<li>
				<img src="<?= $promo['img_src'] ?>" alt="<?= $promo['title'] ?>" style="margin:auto;"/>	
				<div class="orbit-caption">
					<a href="<?= $promo['url'] ?>" style="color: white;"><?= $promo['title'] ?></a>
					<?php if (!empty($promo['sale'])) : ?>
						<a href="<?= $promo['url'] ?>" style="color: white;"><s>(<?= $promo['price'] ?>)</s></a>
						<a href="<?= $promo['url'] ?>" style="color: white;">(<?= $promo['sale'] ?>)</a>
					<?php else: ?>
						<a href="<?= $promo['url'] ?>" style="color: white;">(<?= $promo['price'] ?>)</a>
					<?php endif; ?>
					
					<?php /*
					<?php if !empty($promo['price']): ?>
						<a href="<?= $promo['url'] ?>"><?= $promo['price'] ?></a>
					<?php endif; ?>
					*/ ?>
				</div>
			</li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

<!-- kategori produk -->
	<br>
	<div class="row">
		<div class="small-12 columns">
			<dl class="accordion" data-accordion>
				
					
						<dd>
							
							<a href="#jam-original">
								Jam Original
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="jam-original" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd>
							
							<a href="#alexandre-christie">
								Alexandre Christie
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="alexandre-christie" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Alexandre Christie Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Alexandre Christie Ladies</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Alexandre Christie Couple</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#casio">
								Casio
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="casio" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Casio Couple</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Casio Ladies &amp; Baby-G</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Casio Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Edifice</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">G-Shock</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Protrek</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">Caterpillar</a></div></dd>
					
				
					
						<dd>
							
							<a href="#citizen">
								Citizen
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="citizen" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Citizen Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Citizen Women</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Citizen Couple</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">DKNY</a></div></dd>
					
				
					
						<dd>
							
							<a href="#esprit">
								Esprit
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="esprit" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Esprit Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Esprit Ladies</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">Expedition</a></div></dd>
					
				
					
						<dd>
							
							<a href="#fossil">
								Fossil
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="fossil" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Fossil Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Fossil Ladies</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">Giordano</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">GUESS</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Jacque Martin</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Jam Original &lt; 500.000</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Levi’s</a></div></dd>
					
				
					
						<dd>
							
							<a href="#luminox">
								Luminox
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="luminox" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Luminox Air</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Luminox Land</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Luminox Sea</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">Nautica</a></div></dd>
					
				
					
						<dd>
							
							<a href="#puma">
								Puma
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="puma" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Puma Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Puma Ladies</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">PUMA Unisex</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#revel">
								Revel
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="revel" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Revel Men</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Revel Ladies</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd><div class="link"><a href="category.html">Royal Army</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Seiko</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Swatch</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Swiss Army</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Timex</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#kacamata">
								Kacamata
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="kacamata" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd>
							
							<a href="#sunglass">
								Sunglass
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="sunglass" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Chanel – Dior – Gucci – LV</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Oakley</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Rayban</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Police – Tag Heuer – Ferrari</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#frame">
								Frame
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="frame" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Oakley</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Tag Heuer</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Brand Lain</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#jaket---kaos-sport">
								Jaket &amp; Kaos Sport
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="jaket---kaos-sport" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Kaos Bola</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Kaos Sleeveless/Singlet Bola</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Jersey Klub Bola</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Jaket Bola</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sweater Bola</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Jaket &amp; Sweater Original</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#sepatu">
								Sepatu
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="sepatu" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Sepatu Pantofel Murah</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sneakers Murah</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sepatu Nike – Adidas – Puma</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sepatu Basket</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Futsal Adidas Original</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Futsal Nike Original</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sepatu Bola Adidas Original</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Sepatu Bola Nike Original</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#tas">
								Tas
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="tas" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Oakley</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
					
						<dd>
							
							<a href="#defense-tools">
								Defense Tools
								<i class="fa fa-chevron-down pull-right"></i>
								<i class="fa fa-chevron-up pull-right"></i>
							</a>
							<div id="defense-tools" class="content">
								<dl class="accordion" data-accordion>
									
					
						<dd><div class="link"><a href="category.html">Baton Stick</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Senter LED / Flashlight</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Knuckle</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Pisau – Shuriken – Kunai</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Stun Gun / Kejut Listrik</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Katana – Golok</a></div></dd>
					
				
					
						<dd><div class="link"><a href="category.html">Borgol – Powerview – Pepper Spray</a></div></dd>
					
				
								</dl>
							</div>
						</dd>
					
				
			</dl>
		</div>
	</div>

<div id="page-old" class="clearfix-old row hide-for-small">
  <div id="content-old" class="ten columns"  >
             	
<?php  
if ( function_exists('dynamic_sidebar') && (is_sidebar_active(1)) ) { // Show on the front page 
  dynamic_sidebar(5); 
} 
?>                
  
      <div class="ten columns">
        <div class="options">
          <h1 class="clearboth-old">
            <a href="<?php echo home_url(); ?>/?page=store">
              &raquo; Produk Terbaru
            </a>
          </h1> 
        </div>
 			</div> 	
        <div class="ten columns products_box">  
          <?php //r_render(TEMPLATEPATH . '/library/includes/tpl_latest_products.php')?>
          <?php 
            $categories = str_replace(',',',-',get_inc_categories("cat_exclude_"));
            r_render(TEMPLATEPATH . "/templates/product-slider.php", array(
              'categories' => $categories,
              'include_artikel' => true,
              'include_sticky_post' => true
              )); 
          ?>
      </div>

<?php global $shortname; ?>
<?php if ( get_option($shortname . '_show_cat_home') ) : ?>             	
  <?php for($i = 0;$i < 10;$i++): ?> 
    <?php $categories = get_option($shortname . '_ctr' . ($i+1)); ?>
    <?php 
    $args = array(
      'include'   => $categories,
    	'title_li'  => __( '' ),
    	'style'     => 'none',
      'echo'      => '0'
    );
    $list_categories = get_categories($args);
    ?>
    <?php if (strlen($categories) > 0 && 
            $categories != -1 && 
            $categories != 1 &&
            $categories != 0 && 
            !empty($list_categories)): ?>
      <div class="ten columns">
        <div class="options">
				  <h1 class="clearboth-old">
            &raquo;
            <?php 
              $list = wp_list_categories($args);
              // $list = ucwords(strtolower($list));
              $list = str_replace(
                  '<br />', ', ', $list);
                  
              $list = rtrim(trim($list), ', ');
              echo $list;
            ?>
          </h1>
        </div>
	    </div>
      <div class="ten columns products_box">  
        <?php //$template = "/library/includes/latest_products" . ($i+1) . ".php"; ?>
        <?php //echo $template; ?>
        <?php 
          r_render(TEMPLATEPATH . "/templates/product-slider.php", 
            array(
              'categories' => $categories,
              'orderby' => 'rand'
                ));
        ?>
      </div>
    <?php //else: echo "template " . ($i+1) . " is hidden<br/>"; ?>
    <?php endif; ?>
  <?php endfor; ?>
<?php endif; ?>
                
                
                
                
              </div>          
              
<!--For Slider -->
 </div>        
 

<div id="seo-text" class="ten columns hide-for-small">
  <?php wp_nav_menu(array(
     'theme_location' => 'seo_texts',
     'depth' => 1,
     'menu_class' => 'accordion',
     'container' => '',
     'walker' => new R_Seo_Text_Walker_Nav_Menu,
     'fallback_cb' => 'r_missing_seo_texts_menu'
     )); ?>
 </div> 
