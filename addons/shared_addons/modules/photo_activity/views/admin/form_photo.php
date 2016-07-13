<h3><?php echo lang('photos.new_photo_label'); ?></h3>

<?php echo form_open_multipart(uri_string(), 'class="crud"'); ?>
	<ul>

		<li class="<?php echo alternator('', 'even'); ?>">
			<?php echo form_label(lang('photos.category_label'). ':', 'category_id'); ?>
			<?php
			$category_options[''] = 'Select Category';
			foreach($categories as $row)
			{
				$category_options[$row->id] = $row->title;
			}
			echo form_dropdown('category_id', $category_options, $photo->category_id, 'id="category_id" class="required"');
			?>
		</li>

      <li class="<?php echo alternator('', 'even'); ?>">
			<?php echo form_label(lang('photos.album_label'). ':', 'album_id'); ?>
			<?php
			$album_options[''] = 'Select Album';
			foreach($albums as $row)
			{
				$album_options[$row->id] = $row->title;
			}
			echo form_dropdown('album_id', $album_options, $photo->album_id, 'id="album_id"');
			?>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="title"><?php echo lang('photos.title_label'); ?></label>
			<input type="text" id="title" name="title" maxlength="255" value="<?php echo $photo->title; ?>" />
			<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="slug"><?php echo lang('photos.slug_label'); ?></label>
			<?php echo form_input('slug', $photo->slug, 'class="width-15"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
		</li>

		<li  class="<?php echo alternator('', 'even'); ?> description">
			<label for="caption"><?php echo lang('photos.caption_label'); ?></label>
			<?php echo form_textarea(array('id'=>'caption', 'name'=>'caption', 'value' => $photo->caption, 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
		</li>
        
        <li class="<?php echo alternator('', 'even'); ?>">
			<label for="photo">Photo</label>
			<div class="input"><input type="file" name="photo" id="photo" value=""/></div>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="comments"><?php echo lang('photos.comments_label'); ?></label>
			<?php echo form_dropdown('enable_comments', array('1'=>lang('photos.comments_enabled_label'), '0'=>lang('photos.comments_disabled_label')), $photo->enable_comments); ?>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="published"><?php echo lang('photos.published_label'); ?></label>
			<?php echo form_dropdown('published', array('1'=>lang('photos.published_yes_label'), '0'=>lang('photos.published_no_label')), $photo->published); ?>
		</li>
	</ul>

	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>

<?php echo form_close(); ?>

<script type="text/javascript">

jQuery(function($){
	$('select#folder_id').change(function(){
		$.get(BASE_URI + 'index.php/admin/galleries/ajax_select_folder/' + this.value.toString(), function(data) {

			if (data) {
				$('input[name=title]').val(data.name);
				$('input[name=slug]').val(data.slug);
			}
			else {
				$('input[name=title]').val('');
				$('input[name=slug]').val('');
			}

		}, 'json');
	});
});

</script>