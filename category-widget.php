<?php 
/**
* Menampilkan kategory produk sebagai accordion
*/
class Accordion_Menu_Widget extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'accordion_menu_widget',
			'Accordion Menu',
			array('description' => __('Display menu as accordion'))
			);
	}

	public function form($instance){
		$title = (isset($instance['title'])) ? 
			$instance['title'] : 'Kategori Produk';
		$menu = $instance['menu'];

		$nav_menus = wp_get_nav_menus();
?>
		<p>
			<label for="<?php echo $this->get_field_id('title');?>">
				<?php _e('Title:'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title');?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('menu');?>">
				<?php _e('Menu:'); ?>
			</label>
        	<select class="widefat" id="<?php echo $this->get_field_id('menu');?>"
				name="<?php echo $this->get_field_name('menu'); ?>"
				type="text">
				<?php foreach($nav_menus as $menu_item): ?>
					<option value="<?php echo $menu_item->term_id; ?>"
						<?php echo ($menu == $menu_item->term_id? "selected" : "");?> >
						<?php echo $menu_item->name; ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
<?php
	}

	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['menu'] = strip_tags($new_instance['menu']);
		return $instance;
	}

	public function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$menu = $instance['menu'];
		echo $before_widget;
		if( !empty($title) ){
			echo $before_title . $title . $after_title;
		}
		wp_nav_menu(array(
          'menu' => $menu,
          'container' => '',
          'depth' => 2,
          'fallback_cb' => 'r_missing_mega_menu',
          'menu_class' => 'nav-accordion'
        ));
        echo $after_widget;
	}
}

register_widget('Accordion_Menu_Widget');

?>