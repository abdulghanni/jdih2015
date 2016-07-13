<nav id="shortcuts">
	<h6><?php echo lang('cp_shortcuts_title'); ?></h6>
	<?php $colorbox = ''; if(!empty($galleries)) $colorbox = 'upload_colorbox'; ?>
	<ul>
        <li><?php echo anchor('admin/photo_activity/createalbum', lang('photos.new_album_label'), 'class="add"') ?></li>
		<li><?php echo anchor('admin/photo_activity', lang('photos.list_album_label')); ?></li>
        <li><?php echo anchor('admin/photo_activity/create', lang('photos.new_photo_label'), 'class="add"') ?></li>
		<li><?php echo anchor('admin/photo_activity/photos', lang('photos.list_label')); ?></li>
		<li><?php echo anchor('admin/photo_activity/createcategory', lang('photos.new_category_label'), 'class="add"') ?></li>
		<li><?php echo anchor('admin/photo_activity/categories', lang('photos.list_categories_label')); ?></li>
	</ul>
	<br class="clear-both" />
</nav>
