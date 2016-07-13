<h3><?php echo lang('photos.new_gallery_label'); ?></h3>

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
			echo form_dropdown('category_id', $category_options, $album->category_id, 'id="category_id" class="required"');
			?>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="title"><?php echo lang('photos.title_label'); ?></label>
			<input type="text" id="title" name="title" maxlength="255" value="<?php echo $album->title; ?>" />
			<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="slug"><?php echo lang('photos.slug_label'); ?></label>
			<?php echo form_input('slug', $album->slug, 'class="width-15"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
		</li>

		<li  class="<?php echo alternator('', 'even'); ?> description">
			<label for="description"><?php echo lang('photos.description_label'); ?></label>
			<?php echo form_textarea(array('id'=>'description', 'name'=>'description', 'value' => $album->description, 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
		</li>
        
        <li class="<?php echo alternator('', 'even'); ?>">
			<label for="thumbnail">Thumbnail</label>
			<div class="input"><input type="file" name="thumbnail" id="thumbnail" value=""/></div>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="comments"><?php echo lang('photos.comments_label'); ?></label>
			<?php echo form_dropdown('enable_comments', array('1'=>lang('photos.comments_enabled_label'), '0'=>lang('photos.comments_disabled_label')), '0'); ?>
		</li>

		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="published"><?php echo lang('photos.published_label'); ?></label>
			<?php echo form_dropdown('published', array('1'=>lang('photos.published_yes_label'), '0'=>lang('photos.published_no_label')), 1); ?>
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