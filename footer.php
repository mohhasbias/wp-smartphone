
</div> <!-- wrapper #end -->

<div id="footer-old" class="row">
  <div class="two mobile-two columns">
    <?php print get_nav_menu_items_from_theme_location('customer_services'); ?>
  </div>
  <div class="two mobile-two columns">
    <?php print get_nav_menu_items_from_theme_location('about'); ?>
  </div>
  <div class="two mobile-four columns">
    <dl>
      <dt>Metode Pembayaran</dt>
      <dd>
        <!-- <img src="<?php echo IMAGE_PATH; ?>/bca.png" alt="BCA"> -->
        <img src="http://i39.tinypic.com/2l9l05d.jpg" alt="BCA">
        <p>
          200 026 3404<br/>
          An. M. Fiqy Zamani
        </p>
      </dd>
      <dd>
        <!-- <img src="<?php echo IMAGE_PATH; ?>/mandiri.png" alt="Mandiri"> -->
        <img src="http://i39.tinypic.com/ern6rl.jpg" alt="Mandiri">
        <p>
          143 000 9880 954<br/>
          An. M. Fiqy Zamani
        </p>
      </dd>
    </dl>
  </div>
  <div class="two columns hide-for-small">
    <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fmurahgrosircom&amp;width=196&amp;height=243&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:196px; height:243px;" allowTransparency="true"></iframe>
  </div>
  <div class="two columns hide-for-small">
    <!-- <img src="<?php echo IMAGE_PATH; ?>/tweet_timeline.png"/> -->
    <a class="twitter-timeline" width="220" height="245" data-chrome="nofooter" href="https://twitter.com/murahgrosir" data-widget-id="318580508386795520">Tweets by @murahgrosir</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </div>
</div><!-- footer #end -->

</div><!-- round-shadow end -->


<?php wp_footer(); ?>
<?php global $shortname; ?>
<?php if ( get_option($shortname . "_google_analytics") <> "" ) { echo stripslashes(get_option($shortname . "_google_analytics")); } ?>


<?php

//{
?>
<!--<script type="text/javascript" src="<?php bloginfo("template_directory"); ?>/library/js/jquery-1.2.6.min.js"></script>-->
<!--<script type="text/javascript">
$().ready(function() {
// $("#coda-slider-1").codaSlider();
});	
jQuery.noConflict(); var $j = jQuery;
</script>-->
<?php
//}
?>
<?php if($_REQUEST["p"]){?><script>jQuery.noConflict(); var $j = jQuery;</script><?php }?>


</body>

</html>
