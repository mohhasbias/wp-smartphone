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
          <?php wp_nav_menu(array(
             'theme_location' => 'main',
             'items_wrap'      => '<dl id="%1$s" class="accordion" data-accordion>%3$s</dl>',
             'walker' => new R_Accordion_Walker_Nav_Menu()
             )); ?>
        </div>
    </div>
	


