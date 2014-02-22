<div class="breadcrumbs">
	<?php if ( get_option( 'ptthemes_breadcrumbs' )): ?> 
		<?php yoast_breadcrumb('',''); ?>
		<?php if (isset($page_name)): ?>
			<?php echo $page_name; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>