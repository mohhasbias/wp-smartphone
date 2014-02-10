<?php
  error_reporting(E_ERROR);
  global $Cart,$General;
  $itemsInCartCount = $Cart->cartCount();
  $cartAmount = $Cart->getCartAmt();
  global $current_user;
?>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11"> -->

<!DOCTYPE HTML>
<html>
</head>

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
  <!-- <link href="<?php bloginfo('template_directory'); ?>/library/css/slider.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php bloginfo('template_directory'); ?>/library/css/dropdownmenu.css" rel="stylesheet" type="text/css" />    -->
  
    <?php // Addition (15 March 2013)?>  
    <?php /*
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/modernizr.foundation.js"></script>
    <!-- Included JS Files (Uncompressed) -->
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.cookie.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.event.move.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.event.swipe.js"></script>
    <!--<script src="javascripts/foundation/jquery.foundation.accordion.js"></script>-->
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.alerts.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.buttons.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.clearing.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.forms.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.joyride.js"></script>
    <!-- <script src="javascripts/foundation/jquery.foundation.magellan.js"></script> -->
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.mediaQueryToggle.js"></script>
    <!--<script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.navigation.js"></script>-->
    <!--<script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.orbit.js"></script>-->
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.reveal.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.tabs.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.tooltips.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.foundation.topbar.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/jquery.placeholder.js"></script>
    <!-- Application Javascript, safe to override -->
    <script src="<?php print JAVASCRIPT_PATH; ?>/foundation/app.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.foundation.accordion.modified.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.foundation.orbit.modified.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.foundation.navigation.modified.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.menu-aim.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.accordion.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/holder.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.lazyload.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/spin.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.spin.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/jquery.scrollto.min.js"></script>
    <script src="<?php print JAVASCRIPT_PATH; ?>/site.js"></script>
    */ ?>
    <script src="<?php print JAVASCRIPT_PATH; ?>/all.min.js"></script>
     
  <!--For Menu -->
  <?php wp_head(); ?>

  <!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/stylesheets/app.css" media="all" /> -->
</head>
<body>

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