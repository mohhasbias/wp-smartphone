<?php

// Register widgetized areas
if ( function_exists('register_sidebar') ) {
    register_sidebars(1,array('name' => 'Front Page Slider','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Front Page 3 in 1','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Front Page Sidebar','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
    register_sidebars(1,array('name' => 'Sidebar','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	    register_sidebars(1,array('name' => 'Welcome Note','before_widget' => '<div class="welcome">','after_widget' => '</div>','before_title' => '<h4><span>','after_title' => '</span></h4>'));
}
	
// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return (isset($sidebars[$key]));
}


// =============================== Feedburner Subscribe widget ======================================
function subscribeWidget()
{
	$settings = get_option("widget_subscribewidget");

	$id = $settings['id'];
	$title = $settings['title'];
	$text = $settings['text'];	

?>
	
     

	<div class="widget subscribe_spacer" >	
    	<div class="subscribe" >
         <h3><?php echo $title; ?></h3>
        
		<p><?php echo $text; ?></p>
		 <form  action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow"  onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">    
     <input type="text" class="field" onFocus="if (this.value == 'Your Email Address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Your Email Address';}" name="email"/>
     <input type="hidden" value="<?php echo $id; ?>" name="uri"/><input type="hidden" name="loc" value="en_US"/>
                <button class="replace" type="submit" name="submit">Subscribe</button>
           </form>
		</div>	 
 	</div>

<?php
}

function subscribeWidgetAdmin() {

	$settings = get_option("widget_subscribewidget");

	// check if anything's been sent
	if (isset($_POST['update_subscribe'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['subscribe_id']));
		$settings['title'] = strip_tags(stripslashes($_POST['subscribe_title']));
		$settings['text'] = strip_tags(stripslashes($_POST['subscribe_text']));		

		update_option("widget_subscribewidget",$settings);
	}

	echo '<p>
			<label for="subscribe_title">Title:
			<input id="subscribe_title" name="subscribe_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="subscribe_text">Text Under Title:
			<input id="subscribe_text" name="subscribe_text" type="text" class="widefat" value="'.$settings['text'].'" /></label></p>';
	echo '<p>
			<label for="subscribe_id">Feedburner ID: (example:- cepoko/eKPs)
			<input id="subscribe_id" name="subscribe_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';			
	echo '<input type="hidden" id="update_subscribe" name="update_subscribe" value="1" />';

}

register_sidebar_widget('PT &rarr; Subscribe', 'subscribeWidget');
register_widget_control('PT &rarr; Subscribe', 'subscribeWidgetAdmin', 400, 200);


 // =============================== Advt Widget ======================================
class TextWidget extends WP_Widget {
	function TextWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Advt 330pxx120px', 'description' => 'Front Page Text Widget' );		
		$this->WP_Widget('widget_text', 'PT &rarr; Advt 330pxx120px', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$advt1 = empty($instance['advt1']) ? '' : apply_filters('widget_advt1', $instance['advt1']);
		$advt_link1 = empty($instance['advt_link1']) ? '' : apply_filters('widget_advt_link1', $instance['advt_link1']);
		 ?>						

 
      		<!--<h3><?php // echo $title; ?> </h3>-->
         
         <div class="special_offers fr">
        	<?php if ( $advt1 <> "" ) { ?>	
         <a href="<?php echo $advt_link1; ?>"><img src="<?php echo $advt1; ?> " alt="<?php the_title(); ?>" /></a>
         <?php } ?>
        </div>
              
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['advt1'] = ($new_instance['advt1']);
		$instance['advt_link1'] = ($new_instance['advt_link1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'advt1' => '', 'advt_link1' => '', 'advt2' => '', 'advt_link2' => '' ) );		
		$title = strip_tags($instance['title']);
		$advt1 = ($instance['advt1']);
		$advt_link1 = ($instance['advt_link1']);
?>
<!--<p><label for="<?php // echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php // echo $this->get_field_id('title'); ?>" name="<?php // echo $this->get_field_name('title'); ?>" type="text" value="<?php // echo attribute_escape($title); ?>" /></label></p>-->
     
 <p> <label for="<?php echo $this->get_field_id('advt1'); ?>">Advt 1 Image Path (ex.http://pt.com/images/banner.jpg)
    <input class="widefat" id="<?php echo $this->get_field_id('advt1'); ?>" name="<?php echo $this->get_field_name('advt1'); ?>" type="text" value="<?php echo attribute_escape($advt1); ?>" />
  </label> </p>
<p>  <label for="<?php echo $this->get_field_id('advt_link1'); ?>">Advt 1 link 
    <input class="widefat" id="<?php echo $this->get_field_id('advt_link1'); ?>" name="<?php echo $this->get_field_name('advt_link1'); ?>" type="text" value="<?php echo attribute_escape($advt_link1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('TextWidget');

// =============================== sidebar Advt Widget ======================================
class sidebar_advt extends WP_Widget {
	function sidebar_advt() {
	//Constructor
		$widget_ops = array('classname' => 'widget Advt 195x200px', 'description' => 'Sidebar Advt' );		
		$this->WP_Widget('widget_advt', 'PT &rarr; Advt 195x200px', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$advt1 = empty($instance['advt1']) ? '' : apply_filters('widget_advt1', $instance['advt1']);
		$advt_link1 = empty($instance['advt_link1']) ? '' : apply_filters('widget_advt_link1', $instance['advt_link1']);
		 ?>						

 
      		<!--<h3><?php // echo $title; ?> </h3>-->
         
         <div class="widget">
			
            <div class="ad-box">
        	<?php if ( $advt1 <> "" ) { ?>	
             <a href="<?php echo $advt_link1; ?>"><img src="<?php echo $advt1; ?> " alt="<?php the_title(); ?>" /></a>
             <?php } ?>
             </div>
        </div>
              
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['advt1'] = ($new_instance['advt1']);
		$instance['advt_link1'] = ($new_instance['advt_link1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'advt1' => '', 'advt_link1' => '', 'advt2' => '', 'advt_link2' => '' ) );		
		$title = strip_tags($instance['title']);
		$advt1 = ($instance['advt1']);
		$advt_link1 = ($instance['advt_link1']);
?>
<!--<p><label for="<?php // echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php // echo $this->get_field_id('title'); ?>" name="<?php // echo $this->get_field_name('title'); ?>" type="text" value="<?php // echo attribute_escape($title); ?>" /></label></p>-->
     
 <p> <label for="<?php echo $this->get_field_id('advt1'); ?>">Advt 1 Image Path (ex.http://pt.com/images/banner.jpg)
    <input class="widefat" id="<?php echo $this->get_field_id('advt1'); ?>" name="<?php echo $this->get_field_name('advt1'); ?>" type="text" value="<?php echo attribute_escape($advt1); ?>" />
  </label> </p>
<p>  <label for="<?php echo $this->get_field_id('advt_link1'); ?>">Advt 1 link 
    <input class="widefat" id="<?php echo $this->get_field_id('advt_link1'); ?>" name="<?php echo $this->get_field_name('advt_link1'); ?>" type="text" value="<?php echo attribute_escape($advt_link1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('sidebar_advt');




// =============================== Flickr widget ======================================

function flickrWidget()
{
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];

?>

<div class="widget flickr">
			
        <h3>flick photostream</h3>
             			
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>  
		
		<div class="fix"></div>
		
</div>		

<?php
}
function flickrWidgetAdmin() {

	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

register_sidebar_widget('PT &rarr; Flickr Photos', 'flickrWidget');
register_widget_control('PT &rarr; Flickr Photos', 'flickrWidgetAdmin', 250, 200);



// =============================== Latest Posts Widget (particular category) ======================================

class LatestPosts extends WP_Widget {
	function LatestPosts() {
	//Constructor
		$widget_ops = array('classname' => 'widget latest posts', 'description' => 'List of latest posts in particular category' );
		$this->WP_Widget('widget_posts1', 'PT &rarr; Latest Slider Posts', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		global $General;
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		$post_number = empty($instance['post_number']) ? '&nbsp;' : apply_filters('widget_post_number', $instance['post_number']);
		$post_link = empty($instance['post_link']) ? '&nbsp;' : apply_filters('widget_post_link', $instance['post_link']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<div class="coda-slider-wrapper"><div class="coda-slider preload" id="coda-slider-1">';

		        ?>
				<?php 
			        global $post;
			        $latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');
                    foreach($latest_menus as $post) :
                    setup_postdata($post);
			    ?>
               
                
                <div class="panel">
                <div class="panel-wrapper">
                
                
                <?php 
				$imagearray = $General->get_post_image($post->ID);
				if ( $imagearray[0] ) { ?> 
                <a href="<?php the_permalink() ?>" title="<?php echo $post_title; ?>" class="featured_pro" > 
                <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $imagearray[0]; ?>&amp;w=475&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>"   /></a> <?php } else { echo '';} ?>
                
              <h3><a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>   </h3>
                     
                  <p class="featured-excerpt"><?php echo bm_better_excerpt(350, ' ... '); ?> </p>
                 
                 
                 
      				<div ><a  href="<?php the_permalink(); ?>"  class="btn_viewdetail fl" > View Details </a> </div>
		    
                  
                </div>
                </div>
                
                <?php endforeach; ?>
                <?php

	    echo '</div></div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['post_link'] = strip_tags($new_instance['post_link']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
		$post_number = strip_tags($instance['post_number']);
		$post_link = strip_tags($instance['post_link']);

?>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>">Categories (<code>IDs</code> separated by commas):
    <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_number'); ?>">Number of posts:
    <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
  </label>
</p>
<?php
	}

}

register_widget('LatestPosts');




// =============================== highlight_product  Widget (particular category) ======================================

class highlight_product extends WP_Widget {
	function highlight_product() {
	//Constructor
		$widget_ops = array('classname' => 'widget Highlight Products', 'description' => 'List of Highlight Products in particular category' );
		$this->WP_Widget('widget_posts2', 'PT &rarr; Highlight Products', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		global $General;
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		//$post_number = empty($instance['post_number']) ? '&nbsp;' : apply_filters('widget_post_number', $instance['post_number']);
		$post_link = empty($instance['post_link']) ? '&nbsp;' : apply_filters('widget_post_link', $instance['post_link']);
		$post_number = 2;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '';

		        ?>
				<?php 
			        global $post;
			        $latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');
                    foreach($latest_menus as $post) :
                    setup_postdata($post);
			    ?>
               
               
               
               <div class="special_product">
               
               <?php 
				$imagearray = $General->get_post_image($post->ID);
				if ( $imagearray[0] ) { ?> 
                <a href="<?php the_permalink() ?>" title="<?php echo $post_title; ?>" class="special_img"  > 
                <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $imagearray[0]; ?>&amp;w=100&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>"   /></a> <?php } else { echo '';} ?>
               
        	<p class="title"><a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>   </p> 
          <p> <span class="price"> 
           <?php
			global $General,$Product;
			if($Product->get_product_price_sale($post->ID)>0)
			{
			?>
			 <s> <?php echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); ?></s>&nbsp;
			<?php echo $General->get_currency_symbol() . $Product->get_product_price_sale($post->ID); 
			}else
			{
				echo $General->get_currency_symbol() . number_format($Product->get_product_price_only($post->ID),2); 
			}
			?>
       </span>  <br /> 
            
            <a href="<?php the_permalink(); ?>" class="detail">&raquo; View Detail</a></p> 
            
          </div> <!--special_product end -->
          
          
             <?php endforeach; ?>
                <?php

	    echo '';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		//$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['post_link'] = strip_tags($new_instance['post_link']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
		//$post_number = strip_tags($instance['post_number']);
		$post_link = strip_tags($instance['post_link']);

?>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>">Categories (<code>IDs</code> separated by commas):
    <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<?php /*?><p>
  <label for="<?php echo $this->get_field_id('post_number'); ?>">Number of posts:
    <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
  </label>
</p><?php */?>
<?php
	}

}

register_widget('highlight_product');



// =============================== Special Product  Widget (particular category) ======================================

class special_product extends WP_Widget {
	function special_product() {
	//Constructor
		$widget_ops = array('classname' => 'widget Special Product', 'description' => 'List of Special Product in particular category' );
		$this->WP_Widget('widget_posts3', 'PT &rarr; Special Product', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		global $General;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		$post_number = empty($instance['post_number']) ? '&nbsp;' : apply_filters('widget_post_number', $instance['post_number']);
		$post_link = empty($instance['post_link']) ? '&nbsp;' : apply_filters('widget_post_link', $instance['post_link']);

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '';

		        ?>
                
                <div class="widget">
               
                
				<?php 
			        global $post;
			        $latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');
                    foreach($latest_menus as $post) :
                    setup_postdata($post);
			    ?>
               
               
               
               <div class="sidebar_speical_products">
               
               <p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>   </p> 
               
              	 <?php 
				$imagearray = $General->get_post_image($post->ID);
				if ( $imagearray[0] ) { ?> 
                <a href="<?php the_permalink() ?>" title="<?php echo $post_title; ?>" class="special_pro"  > 
                <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $imagearray[0]; ?>&amp;w=195&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>"   /></a> <?php } else { echo '';} ?>
               
        	
         <!--<p class="price">  </p> -->
            
            <a href="<?php the_permalink(); ?>" class="highlight_button">&raquo; View Detail</a> 
            
          </div> <!--special_product end -->
          
          
             <?php endforeach; ?>
                <?php

	    echo '</div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['post_link'] = strip_tags($new_instance['post_link']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
		$post_number = strip_tags($instance['post_number']);
		$post_link = strip_tags($instance['post_link']);

?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>">Categories (<code>IDs</code> separated by commas):
    <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_number'); ?>">Number of posts:
    <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
  </label>
</p>
<?php
	}

}

register_widget('special_product');



// =============================== Popular Posts Widget ======================================

function PopularPostsSidebar()
{

    $settings_pop = get_option("widget_popularposts");

	$name = $settings_pop['name'];
	$number = $settings_pop['number'];
	if ($name <> "") { $popname = $name; } else { $popname = 'Popular Posts'; }
	if ($number <> "") { $popnumber = $number; } else { $popnumber = '10'; }

?>

<div class="widget popular">

	<h3 class="hl"><span><?php echo $popname; ?></span></h3>
	
		<ul>
			 
			<?php
			global $wpdb;
            $now = gmdate("Y-m-d H:i:s",time());
            $lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
            $popularposts = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT $popnumber";
            $posts = $wpdb->get_results($popularposts);
            $popular = '';
            if($posts){
                foreach($posts as $post){
	                $post_title = stripslashes($post->post_title);
		               $guid = get_permalink($post->ID);
					   
					      $first_post_title=substr($post_title,0,26);
            ?>
		        <li>
                    <a href="<?php echo $guid; ?>" title="<?php echo $post_title; ?>"><?php echo $first_post_title; ?></a>
                    <br style="clear:both" />
                </li>
            <?php } } ?>

		</ul>
</div>

<?php
}
function PopularPostsAdmin() {

	$settings_pop = get_option("widget_popularposts");

	// check if anything's been sent
	if (isset($_POST['update_popular'])) {
		$settings_pop['name'] = strip_tags(stripslashes($_POST['popular_name']));
		$settings_pop['number'] = strip_tags(stripslashes($_POST['popular_number']));

		update_option("widget_popularposts",$settings_pop);
	}

	echo '<p>
			<label for="popular_name">Title:
			<input id="popular_name" name="popular_name" type="text" class="widefat" value="'.$settings_pop['name'].'" /></label></p>';
	echo '<p>
			<label for="popular_number">Number of popular posts:
			<input id="popular_number" name="popular_number" type="text" class="widefat" value="'.$settings_pop['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_popular" name="update_popular" value="1" />';

}

register_sidebar_widget('PT &rarr; Popular Posts', 'PopularPostsSidebar');
register_widget_control('PT &rarr; Popular Posts', 'PopularPostsAdmin', 250, 200);


// =============================== Twitter widget ======================================
// Plugin Name: Twitter Widget
// Plugin URI: http://seanys.com/2007/10/12/twitter-wordpress-widget/
// Description: Adds a sidebar widget to display Twitter updates (uses the Javascript <a href="http://twitter.com/badges/which_badge">Twitter 'badge'</a>)
// Version: 1.0.3
// Author: Sean Spalding
// Author URI: http://seanys.com/
// License: GPL

function widget_Twidget_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_Twidget($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_Twidget');
		$account = $options['account'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$follow = $options['follow'];  // # of Updates to show

        // Output
		echo $before_widget ;

		// start
		echo '<div class="widget"> <h3><a href="http://www.twitter.com/'.$account.'/" title="'.$follow.'">'.$title.' </a></h3>';              
		echo '<div class="twitter_post"><div id="twitter">';
		echo '<ul id="twitter_update_list"><li></li></ul>
		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';
		echo '</div></div></div>';
			
				
		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'rbhavesh', 'title'=>'Twitter Updates', 'show'=>'3');

        // form posted?
		if ( $_POST['Twitter-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['Twitter-show']));
			$options['follow'] = strip_tags(stripslashes($_POST['Twitter-follow']));
			$options['linkedin'] = strip_tags(stripslashes($_POST['Twitter-linkedin']));
			$options['facebook'] = strip_tags(stripslashes($_POST['Twitter-facebook']));
			update_option('widget_Twidget', $options);
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$follow = htmlspecialchars($options['follow'], ENT_QUOTES);

		// The form fields
		echo '<p style="text-align:left;">
				<label for="Twitter-account">' . __('Twitter Account ID:') . '
				<input style="width: 280px;" id="Twitter-account" name="Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:left;">
				<label for="Twitter-title">' . __('Title:') . '
				<input style="width: 280px;" id="Twitter-title" name="Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:left;">
				<label for="Twitter-show">' . __('Show Twitter Posts:') . '
				<input style="width: 280px;" id="Twitter-show" name="Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="Twitter-submit" name="Twitter-submit" value="1" />';
	}


	// Register widget for use
	register_sidebar_widget(array('PT &rarr; Twitter', 'widgets'), 'Widget_Twidget');

	// Register settings for use, 300x200 pixel form
	register_widget_control(array('PT &rarr; Twitter', 'widgets'), 'Widget_Twidget_control', 300, 200);
	
}

// Run code and init
add_action('widgets_init', 'widget_Twidget_init');
?>