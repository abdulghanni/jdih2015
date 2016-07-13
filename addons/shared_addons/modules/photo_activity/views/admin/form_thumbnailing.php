<h3><?php echo lang('photos.thumbnailing_label'); ?> <?php echo $photo->title; ?></h3>

<?php echo form_open(uri_string(), 'class="crud"'); ?>
	<ul>
		<li class="<?php echo alternator('', 'even'); ?>">
			<label for="current_thumbnail"><?php echo lang('photos.current_photo_label'); ?></label>
			<img id="current_thumbnail" src="<?php echo BASE_URL.'uploads/files/' . $photo->file->filename; ?>" alt="<?php echo $photo->title; ?>" width="400" />
			<input type="hidden" id="thumb_width" name="thumb_width" />
			<input type="hidden" id="thumb_height" name="thumb_height" />
			<input type="hidden" id="thumb_x" name="thumb_x" />
			<input type="hidden" id="thumb_y" name="thumb_y" />
			<input type="hidden" id="scaled_height" name="scaled_height" />
			<br />
			<label for="crop-button"></label>
			<a class="colorbox button" name="crop-button" href="<?php echo BASE_URL.'uploads/files/' . $photo->file->filename; ?>"><?php echo lang('photos.crop_label'); ?></a>
			<br />
			<br />
			<span class="crop_options" style="display:none;">
				<label for="apply_to"><?php echo lang('photos.options_label'); ?></label>
				<?php echo form_checkbox('ratio', '1', TRUE); ?><span  class="crop_checkbox"><?php echo lang('photos.ratio_label').'<br /><strong>'.lang('photos.crop.save_label'); ?></strong></span>
			</span>
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