<?php
  error_reporting(E_ERROR);
  global $Cart,$General;
  $itemsInCartCount = $Cart->cartCount();
  $cartAmount = $Cart->getCartAmt();
  global $current_user;
?>

<!DOCTYPE HTML>
<html>
</head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-site-verification" content="ZPBN5GdotDknn-fuILNEUd-kKLebh7_QI_3J1NFHb9A" />
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11832432-2']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>

  <title>
    <?php if ( is_home() ) { ?><?php bloginfo('description'); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
    <?php if ( is_search() ) { ?>Search Results&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
    <?php if ( is_author() ) { ?>Author Archives&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
    <?php if ( is_single() ) { ?><?php wp_title(''); ?><?php } ?>
    <?php if ( is_page() ) { ?><?php wp_title(''); ?><?php } ?>
    <?php if ( is_category() ) { ?><?php single_cat_title(); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
    <?php if ( is_month() ) { ?><?php the_time('F'); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
    <?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php single_tag_title("", true); } } ?>
  </title>

  <?php global $shortname; ?>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php if (is_home()) { ?><?php if ( get_option($shortname . '_meta_description') <> "" ) { ?>
  <meta name="description" content="<?php echo stripslashes(get_option($shortname . '_meta_description')); ?>" />
  <?php } ?><?php if ( get_option($shortname . '_meta_keywords') <> "" ) { ?>
  <meta name="keywords" content="<?php echo stripslashes(get_option($shortname . '_meta_keywords')); ?>" />
  <?php } ?><?php if ( get_option($shortname . '_meta_author') <> "" ) { ?>
  <meta name="author" content="<?php echo stripslashes(get_option($shortname . '_meta_author')); ?>" /><?php } ?><?php } ?>
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" /><?php if ( get_option($shortname . '_customcss') ) { ?>
  <link href="<?php bloginfo('template_directory'); ?>/custom.css" rel="stylesheet" type="text/css">
  <?php } ?><?php if ( get_option($shortname . '_favicon') <> "" ) { ?>
  <link rel="icon" type="image/png" href="<?php echo get_option($shortname . '_favicon'); ?>" /><?php } ?>
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option($shortname . '_feedburner_url') <> "" ) { echo get_option($shortname . '_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" /><link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/print.css" media="print" />
  <!--[if lt IE 7]>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/pngfix.js"></script>

  <SCRIPT src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js" 
  type=text/javascript></SCRIPT>

  <SCRIPT src="<?php bloginfo('template_directory'); ?>/library/js/jquery.helper.js" 
  type=text/javascript></SCRIPT>

  <![endif]-->
  <?php if ( get_option($shortname . '_scripts_header') <> "" ) { echo stripslashes(get_option($shortname . '_scripts_header')); } ?>
 
     
  <!--For Menu -->
  <?php wp_head(); ?>

</head>
<body>

<!--     top bar -->

    <div class="fixed">
    <nav class="top-bar" data-topbar data-options="scrolltop:false;">
      <ul class="title-area">
        <li class="name">
          <a href="index.html">
            <img style="height:100%;max-width:80%;padding: 3px;" 
             src="<?php echo get_option($shortname . '_logo_url'); ?>">
          </a>
        </li>
        <li class="toggle-topbar"><a href="#"><i class="fa fa-bars fa-2x" style="line-height:inherit;"></i></a></li>
      </ul>
      
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          
            
              <li class="has-dropdown">
                <a href="#">Jam Original</a>
                <ul class="dropdown">
                  
            
              <li class="has-dropdown">
                <a href="#">Alexandre Christie</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Alexandre Christie Men</a></li>
            
          
            
              <li><a href="category.html">Alexandre Christie Ladies</a></li>
            
          
            
              <li><a href="category.html">Alexandre Christie Couple</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Casio</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Casio Couple</a></li>
            
          
            
              <li><a href="category.html">Casio Ladies &amp; Baby-G</a></li>
            
          
            
              <li><a href="category.html">Casio Men</a></li>
            
          
            
              <li><a href="category.html">Edifice</a></li>
            
          
            
              <li><a href="category.html">G-Shock</a></li>
            
          
            
              <li><a href="category.html">Protrek</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">Caterpillar</a></li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Citizen</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Citizen Men</a></li>
            
          
            
              <li><a href="category.html">Citizen Women</a></li>
            
          
            
              <li><a href="category.html">Citizen Couple</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">DKNY</a></li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Esprit</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Esprit Men</a></li>
            
          
            
              <li><a href="category.html">Esprit Ladies</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">Expedition</a></li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Fossil</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Fossil Men</a></li>
            
          
            
              <li><a href="category.html">Fossil Ladies</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">Giordano</a></li>
            
          
            
              <li><a href="category.html">GUESS</a></li>
            
          
            
              <li><a href="category.html">Jacque Martin</a></li>
            
          
            
              <li><a href="category.html">Jam Original &lt; 500.000</a></li>
            
          
            
              <li><a href="category.html">Levi’s</a></li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Luminox</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Luminox Air</a></li>
            
          
            
              <li><a href="category.html">Luminox Land</a></li>
            
          
            
              <li><a href="category.html">Luminox Sea</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">Nautica</a></li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Puma</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Puma Men</a></li>
            
          
            
              <li><a href="category.html">Puma Ladies</a></li>
            
          
            
              <li><a href="category.html">PUMA Unisex</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Revel</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Revel Men</a></li>
            
          
            
              <li><a href="category.html">Revel Ladies</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li><a href="category.html">Royal Army</a></li>
            
          
            
              <li><a href="category.html">Seiko</a></li>
            
          
            
              <li><a href="category.html">Swatch</a></li>
            
          
            
              <li><a href="category.html">Swiss Army</a></li>
            
          
            
              <li><a href="category.html">Timex</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Kacamata</a>
                <ul class="dropdown">
                  
            
              <li class="has-dropdown">
                <a href="#">Sunglass</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Chanel – Dior – Gucci – LV</a></li>
            
          
            
              <li><a href="category.html">Oakley</a></li>
            
          
            
              <li><a href="category.html">Rayban</a></li>
            
          
            
              <li><a href="category.html">Police – Tag Heuer – Ferrari</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Frame</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Oakley</a></li>
            
          
            
              <li><a href="category.html">Tag Heuer</a></li>
            
          
            
              <li><a href="category.html">Brand Lain</a></li>
            
          
                </ul>
              </li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Jaket &amp; Kaos Sport</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Kaos Bola</a></li>
            
          
            
              <li><a href="category.html">Kaos Sleeveless/Singlet Bola</a></li>
            
          
            
              <li><a href="category.html">Jersey Klub Bola</a></li>
            
          
            
              <li><a href="category.html">Jaket Bola</a></li>
            
          
            
              <li><a href="category.html">Sweater Bola</a></li>
            
          
            
              <li><a href="category.html">Jaket &amp; Sweater Original</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Sepatu</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Sepatu Pantofel Murah</a></li>
            
          
            
              <li><a href="category.html">Sneakers Murah</a></li>
            
          
            
              <li><a href="category.html">Sepatu Nike – Adidas – Puma</a></li>
            
          
            
              <li><a href="category.html">Sepatu Basket</a></li>
            
          
            
              <li><a href="category.html">Futsal Adidas Original</a></li>
            
          
            
              <li><a href="category.html">Futsal Nike Original</a></li>
            
          
            
              <li><a href="category.html">Sepatu Bola Adidas Original</a></li>
            
          
            
              <li><a href="category.html">Sepatu Bola Nike Original</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Tas</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Oakley</a></li>
            
          
                </ul>
              </li>
            
          
            
              <li class="has-dropdown">
                <a href="#">Defense Tools</a>
                <ul class="dropdown">
                  
            
              <li><a href="category.html">Baton Stick</a></li>
            
          
            
              <li><a href="category.html">Senter LED / Flashlight</a></li>
            
          
            
              <li><a href="category.html">Knuckle</a></li>
            
          
            
              <li><a href="category.html">Pisau – Shuriken – Kunai</a></li>
            
          
            
              <li><a href="category.html">Stun Gun / Kejut Listrik</a></li>
            
          
            
              <li><a href="category.html">Katana – Golok</a></li>
            
          
            
              <li><a href="category.html">Borgol – Powerview – Pepper Spray</a></li>
            
          
                </ul>
              </li>
            
          
        </ul>
        </section>
    </nav>
  </div>

<div class="round-shadow row">
  <div id="header" class="row">
    <div id="tools" class="ten columns text-right hide-for-small">
      <?php wp_nav_menu( array(
                        'theme_location' => 'tools',
                        'container' => '',
                        'menu_class' => 'inline-list right',
                        'fallback_cb' => 'r_missing_tools_menu' )); ?>
    </div>
    <div id="logo" class="three mobile-three columns">
   	  <?php if ( get_option($shortname . '_show_blog_title') ) : ?>
        <div class="blog-title">
          <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a> 
          <p class="blog-description hide-for-small">
            <?php bloginfo('description'); ?>
          </p>
        </div>
      <?php else : ?>
        <a href="<?php echo get_option('home'); ?>/">
          <img src="<?php if ( get_option($shortname . '_logo_url') <> "" ) { echo get_option($shortname . '_logo_url'); } else { echo get_bloginfo('template_directory').'/images/logo.png'; } ?>" alt="<?php bloginfo('name'); ?>" class="logo"  />
          <p class="blog-description hide-for-small">
            <?php bloginfo('description'); ?>
          </p> 
        </a>   
      <?php endif; ?>
    </div>
    <div class="seven columns hide-for-small">
      <div class="row collapse">
        <div id="perks" class="ten columns">
          <ul class="inline-list">
            <li>
              <i class="icon-money icon-2x pull-left"></i>
              <span class="has-tip"
                data-width="150"
                title="Barang cacat/rusak, kami tukar dengan yang baru">
                <strong>MONEY BACK<br/>GUARANTEE</strong>
              </span>
            </li>
            <li>
              <i class="icon-lock icon-2x pull-left"></i>
              <span class="has-tip"
                data-width="150"
                title="Transaksi dijamin aman 100%. Bahkan tersedia COD">
                <strong>SECURE</strong>
              </span>
            </li>
            <li>
              <i class="icon-time icon-2x pull-left"></i>
              <span class="has-tip"
                data-width="150"
                title="Barang tiba dalam 1 hari (Jabodetabek).
                  2-3 hari untuk luar Jabodetabek.">
                <strong>FAST<br/>DELIVERY</strong>
              </span>
            </li>
            <li>
              <i class="icon-exclamation-sign icon-2x pull-left"></i>
              <span class="has-tip"
                data-width="150"
                title="Barang hilang diperjalanan, kami ganti dengan yang baru">
                <strong>LOST<br/>INSURANCE</strong>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div id="customer-service" class="seven columns">
      <ul class="inline-list">
        <li>
          <i class="icon-phone icon-2x pull-left"></i>
          <span>
            IM3 - 0857.8543.3965<br/>
            XL - 0878.5752.263
          </span>
        </li>
        <li>
          <i class="icon-comments-alt icon-2x pull-left"></i>
          <span>
            PIN BBM - 26461746 | 29D59339<br/>
            WhatsApp - 0878.5752.6263
          </span>
        </li>
      </ul>
    </div>
  </div>
  <div id="wrapper-old" class="row">

    <div class="submenu hide" class="clearfix"  >
      <?php
		/*
		* displaying sup pages
		*/
		$current_post=$post->ID;
		$children = wp_list_pages("title_li=&child_of=".$current_post."&echo=0&depth=1");
		if ($children) 
		{ ?>

		<!-- sub link-->

			<ul id="sub_menu">
			<?php echo $children; ?>
			</ul>

		<!-- /sub link-->
<div class="clearfix"></div>
		<?php 
		} ?></div>

<?php //shailan_dropdown_menu(); ?>