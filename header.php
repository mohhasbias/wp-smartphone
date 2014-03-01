<?php
  error_reporting(E_ERROR);
  global $Cart,$General;
  $itemsInCartCount = $Cart->cartCount();
  $cartAmount = $Cart->getCartAmt();
  global $current_user;
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="google-site-verification" content="ZPBN5GdotDknn-fuILNEUd-kKLebh7_QI_3J1NFHb9A" />
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11832432-2']);
    if (!/\.dev|xip\.io/.test(window.location.hostname)) _gaq.push(['_trackPageview']);
<!--     _gaq.push(['_trackPageview']); -->

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
<!--   <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" /><?php if ( get_option($shortname . '_customcss') ) { ?> -->
  <link href="<?php bloginfo('template_directory'); ?>/custom.css" rel="stylesheet" type="text/css">
  <?php } ?><?php if ( get_option($shortname . '_favicon') <> "" ) { ?>
  <link rel="icon" type="image/png" href="<?php echo get_option($shortname . '_favicon'); ?>" /><?php } ?>
<!--   <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option($shortname . '_feedburner_url') <> "" ) { echo get_option($shortname . '_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" /> -->
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/print.css" media="print" />
  <!--[if lt IE 7]>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/pngfix.js"></script>

  <SCRIPT src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js" 
  type=text/javascript></SCRIPT>

  <SCRIPT src="<?php bloginfo('template_directory'); ?>/library/js/jquery.helper.js" 
  type=text/javascript></SCRIPT>

  <![endif]-->
  <?php if ( get_option($shortname . '_scripts_header') <> "" ) { echo stripslashes(get_option($shortname . '_scripts_header')); } ?>
 
  <!-- <script src="<?php bloginfo('template_directory'); ?>/bower_components/modernizr/modernizr.js"></script> -->
     
  <!--For Menu -->
  <?php wp_head(); ?>

</head>
<body>

<!--     top bar -->

    <div class="fixed">
    <nav class="top-bar" data-topbar data-options="scrolltop:false;">
      <ul class="title-area">
        <li class="name">
          <a href="<?= home_url() ?>">
            <img style="height:100%;max-width:80%;padding: 3px;" 
             src="<?php echo get_option($shortname . '_logo_url'); ?>">
          </a>
        </li>
        <li class="toggle-topbar"><a href="#"><i class="fa fa-bars fa-2x" style="line-height:inherit;"></i></a></li>
      </ul>
      
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <?php
          $options = array(
            'theme_location' => 'main',
            'container' => false,
            'depth' => 2,
            'items_wrap' => '<ul id="%1$s" class="right %2$s">%3$s</ul>',
            'walker' => new GC_walker_nav_menu()
          );
          wp_nav_menu($options); 
        ?>
      </section>
    </nav>
  </div>
  
  <br/>
  <?php get_search_form() ?>


  <div id="wrapper-old" class="row">
    <div class="small-12 columns">