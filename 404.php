<?php get_header(); ?>

<div id="page-404" class="ten columns">
  <div class="row">
    <div class="ten columns">
      <h3>Mohon maaf, halaman yang anda maksud tidak ada</h3>
      <p>Coba cari lagi menggunakan kata kunci yang berbeda</p>
      <div class="row">
        <div class="three columns">
          <?php get_search_form(); ?>
        </div>
      </div>
      <p>atau silahkan mampir ke <br/>
          <a class="small radius button" href="<?php echo home_url(); ?>">
            <i class="icon-large icon-home"></i> HALAMAN DEPAN
          </a>
      </p>
    </div>
  </div>
  <hr/>
</div>

<?php get_footer(); ?>
