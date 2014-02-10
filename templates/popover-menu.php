<?php $supported_depth = 3; ?>
<?php if( $maintainHover): ?>
  <div id="popover-menu" class="maintain-hover">
    <button class="button large-radius expand">
      Kategori Produk <i class="icon-caret-down right"></i>
    </button>
  </div>
  <div id="megamenu">
    <?php wp_nav_menu(array(
                  'theme_location' => 'main',
                  'container' => '',
                  'menu_class' => 'nav-bar vertical',
                  'walker' => new R_Main_Walker_Nav_Menu,
                  'depth' => $supported_depth,
                  'fallback_cb' => 'r_missing_mega_menu'
                  )); ?>
  </div>
<?php else: ?>
  <div id="popover-menu">
    <button class="button large-radius expand">
      Kategori Produk <i class="icon-caret-down right"></i>
    </button>
    <div id="megamenu">
      <?php 
        wp_nav_menu(array(
              'theme_location' => 'main',
              'container' => '',
              'menu_class' => 'nav-bar vertical',
              'walker' => new R_Main_Walker_Nav_Menu,
              'depth' => $supported_depth,
              'fallback_cb' => 'r_missing_mega_menu'
              )); 
      ?>
    </div>
  </div>
<?php endif; ?>

