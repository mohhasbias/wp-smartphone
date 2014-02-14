
</div> <!-- wrapper #end -->

<div id="footer-old" class="row">
  <div class="small-12 columns">
    <!--  customer support -->
    <div class="row">
      <div class="small-12 columns">
        <ul class="fa-ul" style="font-size: smaller;padding-left: 11px;">
          <li style="margin-bottom: 7px;">
            <i class="fa-li fa fa-phone fa-2x pull-left"></i>
            <span>
            IM3 - 081.559.18618<br>
            XL - 0857.8543.3965
            </span>
          </li>
          <li style="margin-bottom: 7px;">
            <i class="fa-li fa fa-comments fa-2x pull-left"></i>
            <span>
            PIN BBM - 2B144E98 | 24C3B2A7<br>
            WhatsApp - -
            </span>
          </li>
          <li style="margin-bottom: 7px;">
            <i class="fa-li fa fa-map-marker fa-2x pull-left"></i>
            <span>
            Alamat:<br>
            Jln. Karimata 105-D Jember Jatim.
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>


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
        <img src="<?php echo IMAGE_PATH; ?>/bca.png" alt="BCA">
        <p>
          200 026 3404<br/>
          An. M. Fiqy Zamani
        </p>
      </dd>
      <dd>
        <img src="<?php echo IMAGE_PATH; ?>/mandiri.png" alt="Mandiri">
        <p>
          143 000 9880 954<br/>
          An. M. Fiqy Zamani
        </p>
      </dd>
    </dl>
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

<script src="<?php bloginfo("template_directory"); ?>/bower_components/jquery/jquery.js"></script>
<script src="<?php bloginfo("template_directory"); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php bloginfo("template_directory"); ?>/bower_components/foundation/js/foundation.min.js"></script>
<script type="text/javascript">
  $(document).foundation();
</script>

</body>

</html>
