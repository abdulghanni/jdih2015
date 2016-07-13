<?php echo form_open('admin/photo_activity/deletecategory');?>

<?php if ( ! empty($categories)): ?>

	<table border="0" class="table-list">
		<thead>
			<tr>
				<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php echo lang('photos.album_label'); ?></th>
				<th><?php echo lang('photos.num_albums_label'); ?></th>
				<th><?php echo lang('photos.num_photos_label'); ?></th>
				<th><?php echo lang('photos.actions_label'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach( $categories as $category ): ?>
			<tr>
				<td><?php echo form_checkbox('action_to[]', $category->id); ?></td>
				<td><?php echo $category->title; ?></td>
				<td><?php echo $category->total_album; ?></td>
				<td><?php echo $category->total_photo; ?></td>
				<td>
					<?php echo
					anchor('admin/photo_activity/editcategory/' . $category->id, lang('photos.edit_label')) . ' | ' .
					anchor('admin/photo_activity/deletecategory/' . $category->id, lang('photos.delete_label'), array('class'=>'confirm')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
	</div>

<?php else: ?>
	<div class="blank-slate">
		<img src="<?php echo base_url().'addons/modules/galleries/img/album.png' ?>" />
		
		<h2><?php echo lang('photos.no_galleries_error'); ?></h2>
	</div>
<?php endif;?>

<?php echo form_close(); ?>