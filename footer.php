
  </div>
</div> <!-- wrapper #end -->



<div id="footer-old" class="row">
  <div class="small-12 columns">
<!--   common tools -->
    <hr>
    <div class="row">
        <div class="small-12 columns">
            <ul class="inline-list" style="margin-bottom:0;">
                <li><a href="page-about.html">Profil</a></li>
                <li><a href="page-testimoni.html">Testimoni</a></li>
                <li><a href="page-pemesanan.html">Cara Pesan</a></li>
            </ul>
        </div>
    </div>
    <hr>
  
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
</div><!-- footer #end -->


<?php wp_footer(); ?>
<?php global $shortname; ?>
<?php if ( get_option($shortname . "_google_analytics") <> "" ) { echo stripslashes(get_option($shortname . "_google_analytics")); } ?>


<script src="<?php bloginfo('template_directory'); ?>/bower_components/jquery/jquery.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bower_components/foundation/js/foundation.min.js"></script>
<script type="text/javascript">
  $(document).foundation();
</script>

<script src="<?php bloginfo('template_directory'); ?>/javascripts/app.js"></script>

</body>

</html>
