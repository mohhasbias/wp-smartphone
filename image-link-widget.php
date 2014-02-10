<?php 
/**
* Menampilkan kategory produk sebagai accordion
*/
class Image_Link_Widget extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
			'image_link_widget',
			'Image Link',
			array('description' => __('Display image based link'))
			);
	}

	public function form($instance){
		$image_src = $instance['image_src'];
		$link = $instance['link'];

?>
		<p>
			<?php if (isset($instance['image_src']) && strlen($image_src) > 0): ?>
				<img src="holder.js/185x130" data-src="<?php echo $image_src; ?>" height=130>
			<?php else: ?>
				<img src="holder.js/185x137">
			<?php endif; ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image_src');?>">
				<?php _e('Image URL:'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('image_src');?>"
				name="<?php echo $this->get_field_name('image_src'); ?>"
				type="text" value="<?php echo esc_attr($image_src); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('link');?>">
				<?php _e('Link URL:'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('link');?>"
				name="<?php echo $this->get_field_name('link'); ?>"
				type="text" value="<?php echo esc_attr($link); ?>" />
		</p>
<?php
	}

	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['image_src'] = strip_tags($new_instance['image_src']);
		$instance['link'] = strip_tags($new_instance['link']);
		return $instance;
	}

	public function widget($args, $instance){
		extract($args);
		$image_src = $instance['image_src'];
		$link = $instance['link'];
		echo $before_widget;
?>
		<a href="<?php echo esc_attr($link); ?>">
			<?php if (isset($instance['image_src']) && strlen($image_src) > 0): ?>
				<img src="<?php echo $image_src; ?>"><!-- height=130> -->
			<?php else: ?>
				<img src="holder.js/185x137">
			<?php endif; ?>
		</a>
<?php
        echo $after_widget;
	}
}

function holderjs_script(){
	wp_enqueue_script("holderjs", JAVASCRIPT_PATH . "/holder.js");
}
add_action('admin_print_scripts', holderjs_script);

register_widget('Image_Link_Widget');

?>